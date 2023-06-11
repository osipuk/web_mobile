import React, { Component } from 'react'
import { connect } from 'react-redux'
import axios from 'axios'
import { Route, withRouter,Switch } from 'react-router-dom'
import IdleTimer from 'react-idle-timer';
import Login from './Login/Login'
import Home from './Home/Home'
import History from './CallHistory/History'
import Voicemails from './Voicemails/Voicemails'
import VoicemailsList from './Voicemails/VoicemailsList'
import authenticate from './common/Authenticate'
import './App.css'

class App extends Component {
  constructor(props) {
    super(props)
    this.state = {
      auth_token: '',
      autoLogout: false,
    }
    this.idleTimer = null;
    this.onActive = this._onActive.bind(this);
    this.onAction = this._onAction.bind(this);
     this.onIdle = this._onIdle.bind(this);
     this.logOut = this.logOut.bind(this);
  }
  _onActive(e) {
    console.log(e,'this is active')
    //this.setState({autoLogout: false});
    // console.log('user is active', e);
    // console.log('time remaining', this.idleTimer.getRemainingTime());
  }
  _onAction(e){  
    //this.setState({autoLogout: false});
  }
  logOut() {
    console.log('this is logout');
  }
  _onIdle(e) {
     
    
  
    window.onblur = () => {
      console.log('Blurred');
      this.setState({autoLogout: true});
    } 
    window.onfocus = () => {
      console.log('Focused');
      this.setState({autoLogout: false});
    }
    console.log('user is idle after 30 secs', this.state.autoLogout);
    const isTimedOut = this.state.autoLogout
    if (isTimedOut) {
      localStorage.clear()
        this.props.history.push('/')
    } else {
      this.idleTimer.reset();
      this.setState({autoLogout: true})
    }
  }
  componentDidUpdate(preProps) {
    const { auth_token } = this.props.auth
    if (auth_token !== preProps.auth.auth_token) {
      this.setState({
        auth_token: auth_token,
      })
      axios.defaults.headers.common['X-AUTH-TOKEN'] = auth_token
    }
  }
  render() {
    return (
      <IdleTimer
      tabIndex="1"
      ref={ref => { this.idleTimer = ref }}
      element={document}
      onActive={this.onActive}
      onIdle={this.onIdle}
      onAction={this.onAction}
      timeout={1000 * 60*5}
    >
      <div>
      <Switch>
        <Route exact path="/" component={Login} />
        <Route exact path="/home" component={authenticate(Home)} />
        <Route exact path="/callhistory" component={authenticate(History)} />

        <Route
          exact
          path="/voicemails/list/:vmbox_id"
          component={authenticate(VoicemailsList)}
        />
        <Route exact path="/voicemails" component={authenticate(Voicemails)} />
        </Switch>
      </div>
       </IdleTimer>
    )
  }
}
const mapStateToProps = state => ({ auth: state.auth })
export default withRouter(connect(mapStateToProps)(App))
