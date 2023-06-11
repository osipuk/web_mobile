import React, { useState, useEffect } from 'react'
import {
  sendContact,
  saveUserNumber,
  saveStyleMode,
  saveEmailAlert,
  saveCallForward,
} from '../../actions/message.action'
import { getUserData } from '../../actions/auth.action'
import { parsePhoneNumberFromString } from 'libphonenumber-js'
import { connect } from 'react-redux'
import classnames from 'classnames'
import {
  Button,
  Modal,
  ModalHeader,
  ModalBody,
  ModalFooter,
  TabContent,
  TabPane,
  Nav,
  NavItem,
  NavLink,
} from 'reactstrap'
import '../Home/Home.css'

const Dialog = props => {
  const {
    numbers,
    getUserData,
    styleMode,
    emailAlert,
    saveUserNumber,
    saveStyleMode,
    saveEmailAlert,
    userName,
    setNumberToogle,
    changeSetNumberModal,
    setKazooPanelToggle,
    userKazooPanelModal,
    contactUsModal,
    contactToogle,
    callForward,
    saveCallForward,
  } = props

  const [contacts, updateContactInfo] = useState({
   toMail: 'userrequest@zellatech.com',
    //toMail: 'pavel.kalganov.00@bk.ru',
    fromMail: '',
    subject: 'Zella SMS Suggestion',
    text: '',
  })

  const [settingTab, setSettingTab] = useState('settingTab1')
  const [kazooTab, setKazooTab] = useState('settingTab1')

  const [callMode, updateCallMode] = useState(false)
  const [failoverMode, updateFailoverMode] = useState(false)

  const [curPhoneNum, updateSwitchPhoneNum] = useState('')
  const [userPhoneNum, updatePhoneNum] = useState([])
  const [curStyleMode, setCurStyleMode] = useState('')
  const [mailAlert, setMailAlert] = useState(false)
  const [thisNumber, updateThisNumber] = useState('')
  // const [forwardCalls, updateForwardCalls] = useState('')
  const [leave, updateLeave] = useState(false)
  const [forward, updateForward] = useState(false)
  const [keep, updateKeep] = useState(false)

  const settingTabToggole = tab => {
    if (settingTab !== tab) setSettingTab(tab)
  }
  const kazooTabToggole = tab => {
    if (kazooTab !== tab) setKazooTab(tab)
  }
  const onhandleContacts = e => {
    updateContactInfo({
      ...contacts,
      [e.target.name]: e.target.value,
    })
  }
  const sendContacts = () => {
    if (
      contacts.toMail &&
      contacts.fromMail &&
      contacts.subject &&
      contacts.text
    ) {
    
      
      sendContact(contacts)
    }
    contactUsModal()
    updateContactInfo({
      ...contacts,
      toMail: 'userrequest@zellatech.com',
     // toMail: 'pavel.kalganov.00@bk.ru',
      fromMail: '',
      subject: 'ZellaTech SMS Suggestion',
      text: '',
    })
  }
  const selectPhoneNumber = e => {
    updateSwitchPhoneNum(e.target.id)
  }

  const changeStyleNode = e => {
    setCurStyleMode(e.target.id)
  }

  const phoneNumFormat = number => {
    if (number) {
      const phone_number = parsePhoneNumberFromString(number)
      const phoneNumber = phone_number.formatNational()
      return phoneNumber
    } else return number
  }
  const saveUserPhoneNum = () => {
    saveUserNumber(curPhoneNum, userName.userEmail)
    changeSetNumberModal()
  }
  const saveUserStyleMode = () => {
    saveStyleMode(curStyleMode, userName.userEmail)
    changeSetNumberModal()
  }
  const saveEmailAlertState = () => {
    saveEmailAlert(mailAlert, userName.userEmail)
    changeSetNumberModal()
  }
  const changeMailAlert = () => {
    setMailAlert(!mailAlert)
  }
  const changeForwardMode = mode => {
    if (mode === 'off') {
      updateCallMode(false)
    } else if (mode === 'failover') {
      updateCallMode(true)
      updateFailoverMode(true)
    } else if (mode === 'on') {
      updateFailoverMode(false)
      updateCallMode(true)
    }
  }
  const changeCallForward = () => {
    const forwardData = {
      number: thisNumber,
      require_keypress: leave,
      direct_calls_only: forward,
      keep_caller_id: keep,
      enabled: callMode,
      failover: failoverMode,
      ignore_early_media: true,
      substitute: true,
    }
    saveCallForward(forwardData)
    userKazooPanelModal(false)
  }
  const changeForwardCall = e => {
    // updateForwardCalls(e.target.value)
  }
  const changeThisNumber = e => {
    updateThisNumber(e.target.value)
  }
  const changeLeave = () => {
    updateLeave(!leave)
  }
  const changeForward = () => {
    updateForward(!forward)
  }
  const changeKeep = () => {
    updateKeep(!keep)
  }

  useEffect(() => {
    if (numbers && numbers.savedNumber) {
      updateSwitchPhoneNum(numbers.savedNumber)
    }
    if (numbers && numbers.numberList) {
      updatePhoneNum(numbers.numberList)
    }
    setCurStyleMode(styleMode)
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [numbers])
  useEffect(() => {
    if (callForward) {
      // const { call_forward } = callForward
      const call_forward=callForward;
      updateCallMode(call_forward.enabled)
      updateFailoverMode(call_forward.failover)
      updateThisNumber(call_forward.number)
      updateLeave(call_forward.require_keypress)
      updateForward(call_forward.direct_calls_only)
      updateKeep(call_forward.keep_caller_id)
    }
  }, [callForward])
  useEffect(() => {
    getUserData()
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])

  useEffect(() => {
    setMailAlert(emailAlert)
  }, [emailAlert])

  return (
    <div>
      <Modal
        isOpen={setNumberToogle}
        toggle={changeSetNumberModal}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={changeSetNumberModal}>
          <i className="ti-settings"></i> Settings
        </ModalHeader>
        <ModalBody>
          <div>
            <Nav tabs>
              <NavItem>
                <NavLink
                  className={classnames({
                    active: settingTab === 'settingTab1',
                  })}
                  onClick={() => {
                    settingTabToggole('settingTab1')
                  }}
                >
                  User PhoneNumber
                </NavLink>
              </NavItem>
              <NavItem>
                <NavLink
                  className={classnames({
                    active: settingTab === 'settingTab2',
                  })}
                  onClick={() => {
                    settingTabToggole('settingTab2')
                  }}
                >
                  User Setting
                </NavLink>
              </NavItem>
              <NavItem>
                <NavLink
                  className={classnames({
                    active: settingTab === 'settingTab3',
                  })}
                  onClick={() => {
                    settingTabToggole('settingTab3')
                  }}
                >
                  Email Alert
                </NavLink>
              </NavItem>
            </Nav>
            <TabContent activeTab={settingTab}>
              <TabPane tabId="settingTab1">
                <span className="tab-title">Please select default number.</span>
                <div className="tab-content">
                  <div
                    className="tab-pane show active"
                    id="account"
                    role="tabpanel"
                  >
                    {userPhoneNum &&
                      userPhoneNum.map((num, i) => (
                        <div
                          className="form-item custom-control custom-switch"
                          key={i}
                        >
                          <input
                            type="checkbox"
                            className="custom-control-input"
                            id={num.number}
                            checked={num.number === curPhoneNum}
                            onChange={selectPhoneNumber}
                          />
                          <label
                            className="custom-control-label"
                            htmlFor={num.number}
                          >
                            {phoneNumFormat(num.number)}
                          </label>
                          {num.msgCount > 0 && (
                            <div className="unread-message-count ml-5">
                              {num.msgCount}
                            </div>
                          )}
                        </div>
                      ))}
                  </div>
                </div>
                <div className="text-right">
                  <Button color="primary" onClick={saveUserPhoneNum}>
                    Save
                  </Button>
                </div>
              </TabPane>
              <TabPane tabId="settingTab2">
                <div className="form-item custom-control custom-switch">
                  <input
                    type="checkbox"
                    className="custom-control-input"
                    checked={curStyleMode === 'dark'}
                    id="dark"
                    onChange={changeStyleNode}
                  />
                  <label className="custom-control-label" htmlFor="dark">
                    Dark Mode
                  </label>
                </div>
                <div className="form-item custom-control custom-switch">
                  <input
                    type="checkbox"
                    className="custom-control-input"
                    id="light"
                    checked={curStyleMode === 'light'}
                    onChange={changeStyleNode}
                  />
                  <label className="custom-control-label" htmlFor="light">
                    Light Mode
                  </label>
                </div>
                <div className="text-right">
                  <Button color="primary" onClick={saveUserStyleMode}>
                    Save
                  </Button>
                </div>
              </TabPane>
              <TabPane tabId="settingTab3">
                <div className="form-item custom-control custom-switch">
                  <input
                    type="checkbox"
                    className="custom-control-input"
                    checked={mailAlert === true}
                    id="emailalert"
                    onChange={changeMailAlert}
                  />
                  <label className="custom-control-label" htmlFor="emailalert">
                    Diable / Enable
                  </label>
                </div>
                <div className="text-right">
                  <Button color="primary" onClick={saveEmailAlertState}>
                    Save
                  </Button>
                </div>
              </TabPane>
            </TabContent>
          </div>
        </ModalBody>
      </Modal>
      <Modal
        isOpen={setKazooPanelToggle}
        toggle={userKazooPanelModal}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={userKazooPanelModal}>
          <i className="ti-panel"></i> Call Forwarding and Follow me
        </ModalHeader>
        <ModalBody>
          <div>
            <Nav tabs>
              <NavItem>
                <NavLink
                  className={classnames({
                    active: kazooTab === 'settingTab1',
                  })}
                  onClick={() => {
                    kazooTabToggole('settingTab1')
                  }}
                >
                  Call Forwarding
                </NavLink>
              </NavItem>
              {/* <NavItem>
                <NavLink
                  className={classnames({
                    active: kazooTab === 'settingTab2',
                  })}
                  onClick={() => {
                    kazooTabToggole('settingTab2')
                  }}
                >
                  Fine me, Follow me
                </NavLink>
              </NavItem> */}
            </Nav>
            <TabContent activeTab={kazooTab}>
              <TabPane tabId="settingTab1">
                <span className="tab-title">User Call Forwarding Settings</span>
                <div className="tab-content">
                  <div className="tab-pane show active" role="tabpanel">
                    <div className="call-forward-btns">
                      <div
                        className={`btn call-forward-${styleMode}`}
                        onClick={() => changeForwardMode('off')}
                      >
                        Off
                      </div>
                      <div
                        className={`btn call-forward-${styleMode}`}
                        onClick={() => changeForwardMode('failover')}
                      >
                        Failover Mode
                      </div>
                      <div
                        className={`btn call-forward-${styleMode}`}
                        onClick={() => changeForwardMode('on')}
                      >
                        On
                      </div>
                    </div>
                    {callMode && (
                      <div className="mt-3">
                        {failoverMode && (
                          <span>
                            In "Failover Mode", the call-forward settings will
                            only apply when none of this user's devices are
                            registered.
                          </span>
                        )}
                        <div>
                          <label htmlFor="allcalls" className="col-form-label">
                            Forward all calls to
                          </label>
                          <select
                            className="form-control"
                            id="allcalls"
                            onChange={changeForwardCall}
                          >
                            <option value="1">A Mobile Phone</option>
                            <option value="2">A Desk Phone</option>
                          </select>
                        </div>
                        <div>
                          <label
                            htmlFor="thisnumber"
                            className="col-form-label"
                          >
                            This Number
                          </label>
                          <input
                            type="text"
                            className="form-control"
                            id="thisnumber"
                            placeholder="+120812345678"
                            value={thisNumber}
                            onChange={changeThisNumber}
                          />
                        </div>
                        <div className="mt-3">
                          <div className="form-item custom-control custom-switch">
                            <input
                              type="checkbox"
                              className="custom-control-input"
                              id="leave"
                              checked={leave === false}
                              onChange={changeLeave}
                            />
                            <label
                              className="custom-control-label"
                              htmlFor="leave"
                            >
                              Leave voicemails on forwarded numbers
                            </label>
                          </div>
                          <div className="form-item custom-control custom-switch">
                            <input
                              type="checkbox"
                              className="custom-control-input"
                              id="forward"
                              checked={forward === true}
                              onChange={changeForward}
                            />
                            <label
                              className="custom-control-label"
                              htmlFor="forward"
                            >
                              Forward direct calls only
                            </label>
                          </div>
                          <div className="form-item custom-control custom-switch">
                            <input
                              type="checkbox"
                              className="custom-control-input"
                              id="keep"
                              checked={keep === true}
                              onChange={changeKeep}
                            />
                            <label
                              className="custom-control-label"
                              htmlFor="keep"
                            >
                              Keep Original Caller-ID
                            </label>
                          </div>
                        </div>
                      </div>
                    )}
                  </div>
                </div>
                <div className="text-right">
                  <Button color="primary" onClick={changeCallForward}>
                    Save
                  </Button>
                </div>
              </TabPane>
              {/* <TabPane tabId="settingTab2">
                <span className="tab-title">Find me, Follow me Settings</span>
                <div className="tab-content">
                  <div
                    className="tab-pane show active"
                    id="account"
                    role="tabpanel"
                  >
                    Find me, Follow me Settings
                  </div>
                </div>
                <div className="text-right">
                  <Button color="primary">Save</Button>
                </div>
              </TabPane> */}
            </TabContent>
          </div>
        </ModalBody>
      </Modal>
      <Modal
        isOpen={contactToogle}
        toggle={contactUsModal}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={contactUsModal}>
          <i className="ti-pencil-alt"></i> Feature Request
        </ModalHeader>
        <ModalBody>
          <div className="contact">
            <span>
              We welcome your feedback and suggestions to make this app and your
              business communications better. Please let us know of features or
              suggestions that would help make this product better. We'll do our
              best to make it possible. We're building our services around our
              clients needs, and so your feedback and suggestions are very
              important to us!
            </span>

            <div className="input-group mt-2">
              <div className="input-group mt-2">
                <input
                  type="text"
                  name="fromMail"
                  value={contacts.fromMail}
                  className="form-control"
                  placeholder="Your Mail Address"
                  onChange={onhandleContacts}
                />
              </div>
            </div>
            <div className="input-group mt-2">
              <textarea
                className="form-control"
                id="about-text"
                name="text"
                value={contacts.text}
                placeholder="Text"
                onChange={onhandleContacts}
              ></textarea>
            </div>
          </div>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={sendContacts}>
            Send
          </Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}
const mapStateToProps = state => ({
  auth: state.auth,
  numbers: state.message.numbers,
  userName: state.message.userName,
  styleMode: state.message.numbers.styleMode,
  emailAlert: state.message.numbers.emailAlert,
  callForward: state.message.call_forward,
})
const mapDispatchToProps = dispatch => ({
  getUserData: () => dispatch(getUserData()),
  sendContact: data => {
    dispatch(sendContact(data))
  },
  saveUserNumber: (fromNumber, email) => {
    dispatch(saveUserNumber(fromNumber, email))
  },
  saveStyleMode: (mode, email) => {
    dispatch(saveStyleMode(mode, email))
  },
  saveEmailAlert: (state, email) => {
    dispatch(saveEmailAlert(state, email))
  },
  saveCallForward: data => {
    dispatch(saveCallForward(data))
  },
})
export default connect(mapStateToProps, mapDispatchToProps)(Dialog)
