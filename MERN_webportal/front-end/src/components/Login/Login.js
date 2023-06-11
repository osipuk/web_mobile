import React from 'react'
import { connect } from 'react-redux'
import { getNewAuthToken } from '../../actions/auth.action'
import { ToastContainer, toast } from 'react-toastify'
import './Login.css'

class Login extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      username: '',
      password: '',
      accountname: '',
    }
  }

  componentDidUpdate(preProps) {
     localStorage.setItem('token', "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImQ2ZGZjNjBkZjk4OGNkYTkzM2U4YmNmYjQwYTNkNjU0In0.eyJpc3MiOiJrYXpvbyIsImlkZW50aXR5X3NpZyI6IlgtRWI2QzhhRi00a0JzR2R1WVVKSGE5M084RWw0WHd6cTRqdkFJejV0elUiLCJhY2NvdW50X2lkIjoiM2E1Zjg2ZTFkZDVhMGQ1YmM3NTEzZjU3YWFmYjFjOGUiLCJvd25lcl9pZCI6Ijc2ODQxYzBiMzY5NTI4MWM5NGM5MGRkODk1ODNmMDQzIiwibWV0aG9kIjoiY2JfdXNlcl9hdXRoIiwiZXhwIjoxNjAxOTU4MjM3fQ.Tlkg5ZTAYB4ibHAzmzKaE0NSMGGQQJMp--lU3IZvxEO0TdtYsKftXizqAYICBLxYCoVj-eAZeo90cwmBUzH10siWw34ul2Ip9C7oZIBViQFm9kqxj_YhtcbefQhroVPm_dSKZydR7IA5FmA4gSLzB_03w8uJ8uflzIHzizoqApDXcu0tTURE18YikSZWVGjus9VUOB6XTvrdBzPILqcnnF_QLzuQM_OWQUDPfNa7bwb5Qk4xGBeC61cH-huvJxgR59seLVam996iQ-4ndKRjmRUCKDvIj7dIGxkEsy6fATX1JA0ATDHzNYg8gItB0JdTInA5mSY8TB0UXDnnojXnow")
     localStorage.setItem('account_id', "3a5f86e1dd5a0d5bc7513f57aafb1c8e")
    localStorage.setItem('user_id', "76841c0b3695281c94c90dd89583f043")
    this.props.history.push('/home')
	/**
    let { auth_token, auth_fail, auth } = this.props.auth
    if (auth_token !== preProps.auth.auth_token) {
      if (auth_token) {
        let account_id = auth.data.account_id
        let user_id = auth.data.owner_id
        localStorage.setItem('token', auth_token)
        localStorage.setItem('account_id', account_id)
        localStorage.setItem('user_id', user_id)

        this.props.history.push('/home')
      }
    }

    if (this.props !== preProps) {
      if (auth_fail) {
        this.loginFail()
      }
    }
	**/
  }

  handleChange = e => {
    if (e.key === 'Enter') {
      this.submit()
    } else {
      this.setState({
        [e.target.name]: e.target.value,
      })
    }
  }
  submit = () => {
    this.props.getNewAuthToken(
      this.state.username,
      this.state.password,
      this.state.accountname,
    )
  }
  loginFail = () => {
    toast.error('Please check login information !', {
      position: toast.POSITION.TOP_RIGHT,
    })
  }
  render() {
    return (
      <div className="form-membership">
        <ToastContainer autoClose={5000} />
        <div className="form-wrapper">
          <div className="logo"></div>
          <h5>Sign in</h5>
          <div className="form-group input-group-lg">
            <input
              type="text"
              name="username"
              className="form-control"
              placeholder="Username or email"
              onChange={this.handleChange}
              required
              autoFocus
            />
          </div>
          <div className="form-group input-group-lg">
            <input
              type="password"
              name="password"
              className="form-control"
              placeholder="Password"
              onChange={this.handleChange}
              required
            />
          </div>
          <div className="form-group input-group-lg">
            <input
              type="text"
              name="accountname"
              className="form-control"
              placeholder="Account Name"
              onKeyPress={this.handleChange}
              onChange={this.handleChange}
              required
            />
          </div>
          <div className="form-group d-flex justify-content-between">
            <div className="custom-control custom-checkbox">
              <input
                type="checkbox"
                className="custom-control-input"
                id="customCheck1"
              />
              <label className="custom-control-label" htmlFor="customCheck1">
                Remember me
              </label>
            </div>
          </div>
          <button
            className="btn btn-primary btn-lg btn-block"
            onClick={this.submit}
          >
            Sign in
          </button>
        </div>
      </div>
    )
  }
}
const mapStateToProps = state => ({ auth: state.auth })
const mapDispatchToProps = dispatch => ({
  getNewAuthToken: (username, password, accountname) =>
    dispatch(getNewAuthToken(username, password, accountname)),
})
export default connect(mapStateToProps, mapDispatchToProps)(Login)
