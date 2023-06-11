import React from 'react'
import { withRouter } from 'react-router-dom'
import { connect } from 'react-redux'

export default function authenticate(Component) {
  class AuthenticatedComponent extends React.Component {
    componentDidMount() {
      this.checkAuth()
    }

    checkAuth() {
      if (!this.props.auth_token && !localStorage.getItem('token')) {
        this.props.history.push('/')
      }
    }

    render() {
      return this.props.auth_token || localStorage.getItem('token') ? (
        <Component {...this.props} />
      ) : null
    }
  }

  const mapStateToProps = state => state.auth
  return withRouter(connect(mapStateToProps)(AuthenticatedComponent))
}
