import React from 'react'
import { connect } from 'react-redux'
import _ from 'lodash'
import { parsePhoneNumber } from 'libphonenumber-js'
import PerfectScrollbar from 'react-perfect-scrollbar'
import VoicemailsTable from './VoicemailsTable'
import Sidebar from '../Sidebar/Sidebar'
import Dialog from '../Sidebar/Dialog'
import { getallvmboxes } from '../../actions/voicemails.action'
import * as CONSTS from '../../constants/const'
import './voicemails.css'

class VoicemailsList extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      messages: null,
      checkVoiceMail: null,
      checkedMail: null,
      makeStateMail: null,
      searchKey: '',
      new: 0,
      total: 0,
      dropdownOpen1: false,
      dropdownOpen2: false,
      itemView: false,
      vmbox_id: '',
      checkKey: '',
      view: 0,
      perPage: 10,
      currentPage: 0,
      account_id: localStorage.getItem('account_id'),
      user_id: localStorage.getItem('user_id'),
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
      let vmbox_id = this.props.match.params.vmbox_id
      const vmbox = _.find(voicemails, message => message.vmbox.id === vmbox_id)
      const messages = vmbox.messages
      this.setState({
        messages,
        new: vmbox.vmbox.newcount,
        total: vmbox.vmbox.messages,
        title: vmbox.vmbox.name,
        vmbox_id: vmbox_id,
      })
    }
  }
  contactUsModal = () => {
    this.setState({ contactToogle: !this.state.contactToogle })
  }
  changeSetNumberModal = () => {
    this.setState({ setNumberToogle: !this.state.setNumberToogle })
  }
  toggle1 = () => {
    this.setState({
      dropdownOpen1: !this.state.dropdownOpen1,
    })
  }
  toggle2 = () => {
    this.setState({
      dropdownOpen2: !this.state.dropdownOpen2,
    })
  }
  onhandleChange = e => {
    var value = e.target.value
    this.setState({ searchKey: value })
  }

  selectPerPage = e => {
    this.setState({ perPage: e.target.value })
  }
  setCountLabel = total => {
    if (this.state.perPage * (this.state.currentPage + 1) < total)
      return this.state.perPage * (this.state.currentPage + 1)
    else return total
  }
  prev = () => {
    let tmp = this.state.currentPage
    this.setState({
      currentPage: tmp - 1,
    })
  }

  next = () => {
    let tmp = this.state.currentPage
    this.setState({
      currentPage: tmp + 1,
    })
  }
  getallVmboxes = () => {
    this.props.getallvmboxes()
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
      <div className={this.props.styleMode}>
        <div className="layout">
          <Sidebar
            history={this.props.history}
            contactUsModal={this.contactUsModal}
            changeSetNumberModal={this.changeSetNumberModal}
          />
          <Dialog
            contactUsModal={this.contactUsModal}
            contactToogle={this.state.contactToogle}
            changeSetNumberModal={this.changeSetNumberModal}
            setNumberToogle={this.state.setNumberToogle}
          />
          <div className="content">
            <div className="voicemails">
              <PerfectScrollbar>
                <div className="text-left main-container">
                  {this.state.vmbox_id && (
                    <div
                      className="back-box"
                      onClick={() => this.props.history.push('/voicemails')}
                    >
                      <i
                        className="fa fa-arrow-circle-left mr-1"
                        aria-hidden="true"
                      />
                      Back to voicemail list
                    </div>
                  )}
                  <div className="text-left vmbox-title">
                    {this.state.title}
                  </div>
                  <div className="row">
                    <div className="col-md-12 voicemail-top-wrap">
                      <div
                        className={
                          this.state.new > 0
                            ? 'voicemails-top-1 voicemails-top'
                            : 'voicemails-top-2 voicemails-top'
                        }
                      >
                        <h1 className={this.state.new > 0 ? 'newcount' : ''}>
                          {this.state.new}
                        </h1>
                        <span className="num-title">New</span>
                      </div>
                      <div className="voicemails-top voicemails-top-2">
                        <h1 className="totalcount">{this.state.total}</h1>
                        <span className="num-title">Total</span>
                      </div>
                    </div>
                  </div>
                  <div className="row">
                    <div className="col-md-6"></div>
                    <div className="col-md-6">
                      <div className="text-right voicemail-search">
                        <input
                          className="form-control"
                          type="text"
                          placeholder="Search"
                          onChange={this.onhandleChange}
                        />
                      </div>
                    </div>
                  </div>
                  <VoicemailsTable
                    allmessages={this.state.messages}
                    history={this.props.history}
                    auth={this.props.auth.auth}
                    auth_token={this.props.auth_token}
                    checkboxChange={this.checkboxChange}
                    itemState={this.state}
                    vmbox_id={this.state.vmbox_id}
                    perPage={this.state.perPage}
                    currentPage={this.state.currentPage}
                    searchKey={this.state.searchKey}
                    getallVmboxes={this.getallVmboxes}
                  />
                  {this.state.view === 0 ? (
                    <nav className="bottom-nav">
                      <label>Views</label>
                      <select onChange={this.selectPerPage}>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                      <label>Page</label>
                      <span className="page-num">
                        {this.state.perPage * this.state.currentPage + 1}-
                        {this.setCountLabel(this.state.total)} of{' '}
                        {this.state.total}
                      </span>
                      {this.state.currentPage === 0 ? (
                        <button
                          onClick={this.prev}
                          className="button-disable"
                          disabled
                        >
                          &#60;
                        </button>
                      ) : (
                        <button onClick={this.prev} className="button-disable">
                          &#60;
                        </button>
                      )}
                      {(this.state.currentPage + 1) * this.state.perPage >=
                      this.state.total ? (
                        <button
                          onClick={this.next}
                          className="button-disable"
                          disabled
                        >
                          &#62;
                        </button>
                      ) : (
                        <button onClick={this.next} className="button-disable">
                          &#62;
                        </button>
                      )}
                    </nav>
                  ) : null}
                </div>
              </PerfectScrollbar>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  auth: state.auth,
  voicemails: state.voicemails,
  styleMode: state.message.numbers.styleMode,
})
const mapDispatchToProps = dispatch => ({
  resetAuth: () => dispatch({ type: CONSTS.RESET_AUTH_TOKEN }),
  getallvmboxes: () => dispatch(getallvmboxes()),
})
export default connect(mapStateToProps, mapDispatchToProps)(VoicemailsList)
