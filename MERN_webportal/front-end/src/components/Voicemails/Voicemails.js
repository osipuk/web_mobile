// @flow
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { parsePhoneNumber } from 'libphonenumber-js'
import './voicemails.css'
import VoicemailBox from './VoicemailBox'
import { getallvmboxes } from '../../actions/voicemails.action'

class Voicemails extends Component {
  constructor(props) {
    super(props)
    this.state = {
      allmessages: [],
      contactToogle: false,
      setNumberToogle: false,
    }
  }
  componentDidMount() {
    this.props.getallvmboxes()
  }
  componentDidUpdate(preProps) {
    let { voicemails } = this.props.voicemails
    if (voicemails !== preProps.voicemails.voicemails) {
      this.setState({
        allmessages: voicemails,
      })
    }
  }
  contactUsModal = () => {
    this.setState({ contactToogle: !this.state.contactToogle })
  }
  changeSetNumberModal = () => {
    this.setState({ setNumberToogle: !this.state.setNumberToogle })
  }
  phoneParse(number) {
    if (number.includes('+')) {
      let callNumber = parsePhoneNumber(number).formatNational()
      return callNumber
    } else if (number.length === 10) {
      let callNumber = parsePhoneNumber(`+1${number}`).formatNational()
      return callNumber
    }
  }
  render() {
    return (
      <VoicemailBox
        allmessages={this.state.allmessages}
        history={this.props.history}
        styleMode={this.props.styleMode}
        contactUsModal={this.contactUsModal}
        contactToogle={this.state.contactToogle}
        changeSetNumberModal={this.changeSetNumberModal}
        setNumberToogle={this.state.setNumberToogle}
      />
    )
  }
}
const mapStateToProps = state => ({
  auth: state.auth,
  voicemails: state.voicemails,
  styleMode: state.message.numbers.styleMode,
})
const mapDispatchToProps = dispatch => ({
  getallvmboxes: () => dispatch(getallvmboxes()),
})
export default connect(mapStateToProps, mapDispatchToProps)(Voicemails)
