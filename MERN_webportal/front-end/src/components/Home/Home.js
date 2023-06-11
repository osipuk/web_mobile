import React, { useState, useEffect, useRef } from 'react'
import { connect } from 'react-redux'
import { parsePhoneNumberFromString } from 'libphonenumber-js'
import PerfectScrollbar from 'react-perfect-scrollbar'
import { ToastContainer, toast } from 'react-toastify'
import jsPDF from 'jspdf'
import html2canvas from 'html2canvas'
import Sidebar from '../Sidebar/Sidebar'
import Dialog from '../Sidebar/Dialog'
import Printer from './Printer'
import DropMenu from './DropMenu'
import Notifications from './Notifications'
import _ from 'lodash'
import {
  sendMessage,
  getMessage,
  getAllNumbers,
  getPrintMessage,
  setMemberNum,
  newMssage,
  deleteConversation,
  getCallForward,
} from '../../actions/message.action'

import {
  Button,
  Modal,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Tooltip,
  TabContent,
  TabPane,
  Nav,
  NavItem,
  NavLink,
} from 'reactstrap'

import './Home.css'
import axios from 'axios'
import CONFIG from '../../constants/config'
import sms from '../../asset/media/img/sms.png'
import silhoutte from '../../asset/media/img/silhoutte.png'
import alertSound from '../../asset/media/mp3/drop.mp3'
import openSocket from 'socket.io-client'
import { getUserData } from '../../actions/auth.action'
import classnames from 'classnames'

const socket = openSocket(CONFIG.socketURL)
const Home = props => {
  const {
    history,
    numbers,
    userName,
    messages,
    members,
    styleMode,
    getMessage,
    getPrintMessage,
    getUserData,
    getAllNumbers,
    setMemberNum,
    newMssage,
    deleteConversation,
    getCallForward,
  } = props

  const mainNums = userName.mainNums
  const [values, updateValues] = useState({
    phoneNum: '',
    msgText: '',
  })
  const [toogleSidebar, updateToggleSidebar] = useState(false)
  // const [printerDropdown, setPrinterDropdown] = useState(false)
  const [printerToogle, updatePrinter] = useState(false)
  const [setNumberToogle, updateSetNumber] = useState(false)
  const [setKazooPanelToggle, updateKazooPanel] = useState(false)
  const [contactToogle, updateContactUs] = useState(false)
  const [conversationToogle, updateConversation] = useState(false)
  const [tooltipOpen, setTooltipOpen] = useState(false)
  const [startDate, updateStartDate] = useState(
    new Date(new Date().setDate(new Date().getDate() - 7)),
  )
  const [endDate, updateEndDate] = useState(new Date())
  const [adminPhoneNum, updateAdminPhoneNum] = useState('')
  const [uploadImgName, updateuploadImgName] = useState('')
  const [userPhoneNum, updatePhoneNum] = useState([])
  const [msgNofications, updateMsgNotifications] = useState([])
  const messagesEndRef = useRef(null)
  const messageScrollRef = useRef(null)
  const uploadInput = useRef(null)
  const [audio] = useState(new Audio(alertSound))
  const [favTab, updateFavTab] = useState('favTab1')

  const toggleTooltip = () => setTooltipOpen(!tooltipOpen)
  const handleChange = e => {
    if (e.target.name === 'phoneNum') {
      updateValues({
        ...values,
        [e.target.name]: parseInt(e.target.value)
          ? parseInt(e.target.value)
          : '',
      })
    } else if (e.target.name === 'msgText') {
      if (e.key === 'Enter') {
        sendMessage()
      } else {
        updateValues({ ...values, [e.target.name]: e.target.value })
      }
    }
  }
  // const printerToggle = () => setPrinterDropdown(prevState => !prevState)

  const changeSetNumberModal = () => {
    updateSetNumber(!setNumberToogle)
  }
  const contactUsModal = () => {
    updateContactUs(!contactToogle)
  }
  const userKazooPanelModal = () => {
    getCallForward()
    updateKazooPanel(!setKazooPanelToggle)
  }
  const changeSidebar = () => {
    updateToggleSidebar(!toogleSidebar)
  }
  const sendMessage = () => {
    if (!adminPhoneNum) {
      changeSetNumberModal()
    } else if (values.phoneNum) {
      props.sendMessage(
        values.phoneNum,
        adminPhoneNum,
        values.msgText,
        userName.fullName,
        uploadImgName,
      )
      uploadInput.current.value = ''
      updateValues({ ...values, msgText: '' })
      updateuploadImgName('')
    }
  }
  const imageUpload = ev => {
    ev.preventDefault()
    const data = new FormData()
    data.append('file', uploadInput.current.files[0])
    axios
      .post(`${CONFIG.serverURL}/fileupload`, data, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      })
      .then(response => {
        updateuploadImgName(response.data.file)
      })
  }
  const setMemNumber = async number => {
    await updateValues({ ...values, msgText: '', phoneNum: number })
    await setMemberNum(number)
    await getMessage(number, adminPhoneNum)
    await getAllNumbers(adminPhoneNum, userName.userEmail)
    await getUserData()
  }
  const convertDateTime = time => {
    const date = new Date(time)
    let year = date.getFullYear()
    let month = date.getMonth() + 1
    let day = date.getDate()
    let hours = date.getHours()
    let minutes = date.getMinutes()
    let ampm = hours >= 12 ? 'pm' : 'am'
    hours = hours % 12
    hours = hours ? hours : 12
    hours = hours < 10 ? '0' + hours : hours
    minutes = minutes < 10 ? '0' + minutes : minutes
    let strTime =
      year + '/' + month + '/' + day + '/' + hours + ':' + minutes + ' ' + ampm
    return strTime
  }
  const changeToNumber = e => {
    if (e.key === 'Enter') {
      e.preventDefault()
      getMessage(values.phoneNum, adminPhoneNum)
    }
  }

  const inComingMssage = data => {
    newMssage(data, userName.userEmail)
  }

  const conversationModal = () => {
    if (!conversationToogle) {
      updateValues({ ...values, phoneNum: '' })
      setMemberNum('')
    }
    updateConversation(!conversationToogle)
  }
  const startConverstaion = async () => {
    if (values.phoneNum) {
      props.sendMessage(
        `+1${values.phoneNum}`,
        adminPhoneNum,
        values.msgText,
        userName.fullName,
        uploadImgName,
      )
      uploadInput.current.value = ''
      await updateValues({
        ...values,
        msgText: '',
        phoneNum: `+1${values.phoneNum}`,
      })
      await setMemberNum(`+1${values.phoneNum}`)
      await updateuploadImgName('')
    }
    conversationModal()
  }

  const phoneNumFormat = number => {
    if (number) {
      const phone_number = parsePhoneNumberFromString(number)
      const phoneNumber = phone_number.formatNational()
      return phoneNumber
    } else return number
  }
  const printerModal = () => {
    updatePrinter(!printerToogle)
    getPrintMessage(
      values.phoneNum,
      numbers.savedNumber,
      setFormatDate(startDate, 'start'),
      setFormatDate(endDate, 'end'),
    )
  }
  const exportPDF = async () => {
    html2canvas(document.getElementsByClassName('messages')[0], {
      scale: 4,
    }).then(canvas => {
      const imgData = canvas.toDataURL('image/jpeg')
      const imgWidth = 204
      const pageHeight = 280
      const imgHeight = (canvas.height * imgWidth) / canvas.width + 1
      let heightLeft = imgHeight
      const doc = new jsPDF('p', 'mm', 'a4')
      let position = 4
      doc.addImage(imgData, 'JPEG', 3, position, imgWidth, imgHeight)
      heightLeft -= pageHeight
      while (heightLeft >= 0) {
        position = heightLeft - imgHeight
        doc.addPage()
        doc.addImage(imgData, 'JPEG', 3, position, imgWidth, imgHeight)
        heightLeft -= pageHeight
      }
      doc.save(`message-${formatDate(startDate)}_${formatDate(endDate)}.pdf`)
    })
    updatePrinter(!printerToogle)
    getMessage(values.phoneNum, adminPhoneNum)
  }
  const startDateChange = date => {
    updateStartDate(date)
    getPrintMessage(
      values.phoneNum,
      numbers.savedNumber,
      setFormatDate(date, 'start'),
      setFormatDate(endDate, 'end'),
    )
  }

  const endDateChange = date => {
    updateEndDate(date)
    getPrintMessage(
      values.phoneNum,
      numbers.savedNumber,
      setFormatDate(startDate, 'start'),
      setFormatDate(date, 'end'),
    )
  }
  const setFormatDate = (date, type) => {
    let formatted_date = null
    if (type === 'start') {
      formatted_date = new Date(
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        0,
        0,
        0,
        0,
      )
    }
    if (type === 'end') {
      formatted_date = new Date(
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        23,
        59,
        59,
        999,
      )
    }
    return formatted_date
  }
  const formatDate = date => {
    const year = date.getFullYear()
    const month = date.getMonth() + 1
    const day = date.getDate()
    let formattedDate = year + '-' + month + '-' + day
    return formattedDate
  }
  const deleteHistory = () => {
    deleteConversation(values.phoneNum, adminPhoneNum, userName.userEmail)
  }

  const favTabToggole = tab => {
    if (favTab !== tab) updateFavTab(tab)
  }

  useEffect(() => {
    if (messages.length > 0) {
      messagesEndRef.current.scrollIntoView()
    }
  }, [messages])

  useEffect(() => {
    if (numbers.numberList) {
      updatePhoneNum(numbers.numberList)
    }
  }, [numbers.numberList])

  useEffect(() => {
    if (numbers.savedNumber) {
      updateAdminPhoneNum(numbers.savedNumber)
      getMessage(values.phoneNum, numbers.savedNumber)
      getAllNumbers(numbers.savedNumber, userName.userEmail)
      updateSetNumber(false)
    } else {
      updateSetNumber(true)
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [numbers.savedNumber])

  useEffect(() => {
    if (members && !members.notifies) {
      updateMsgNotifications([])
    } else {
      const dif = _.differenceWith(members.notifies, msgNofications, _.isEqual)
      if (dif.length > 0) {
        updateMsgNotifications(members.notifies)
      }
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [members.notifies])

  useEffect(() => {
    msgNofications &&
      msgNofications.forEach(notify => {
        toast.success(
          `You have unread ${notify.newMsg} text messages from ${phoneNumFormat(
            notify.number,
          )}!`,
          {
            position: toast.POSITION.TOP_RIGHT,
          },
        )
        audio.play()
      })
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [msgNofications])
  useEffect(() => {
    getCallForward()
    socket.on('incomMessage', data => {
      if (data.state === 'success') {
        inComingMssage(data)
      }
    })
    window.dataLayer = window.dataLayer || []
    function gtag() {
      window.dataLayer.push(arguments)
    }
    gtag('js', new Date())
    gtag('config', 'G-0XVZHXWSXW')
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])

  return (
    <div className={styleMode}>
      <ToastContainer autoClose={8000} />
      <Notifications />
      <Dialog
        setNumberToogle={setNumberToogle}
        setKazooPanelToggle={setKazooPanelToggle}
        changeSetNumberModal={changeSetNumberModal}
        userKazooPanelModal={userKazooPanelModal}
        contactUsModal={contactUsModal}
        contactToogle={contactToogle}
        changeToNumber={changeToNumber}
        values={values}
      />
      <Modal
        isOpen={conversationToogle}
        toggle={conversationModal}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={conversationModal}>
          <i className="ti-comment-alt"></i> New Conversation
        </ModalHeader>
        <ModalBody>
          <div className="contact">
            <div className="input-group">
              <input
                type="text"
                className="form-control"
                placeholder="Input Recipient's PhoneNumber"
                name="phoneNum"
                pattern="0-9"
                value={values.phoneNum}
                onChange={handleChange}
                onKeyPress={changeToNumber}
              />
            </div>
            <div className="input-group mt-3">
              <textarea
                type="text"
                name="msgText"
                className="form-control"
                placeholder="Message"
                onChange={handleChange}
                value={values.msgText}
              />
            </div>
          </div>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={startConverstaion}>
            Start
          </Button>
        </ModalFooter>
      </Modal>
      <div className="layout">
        <Sidebar
          changeSidebar={changeSidebar}
          toogleSidebar={toogleSidebar}
          contactUsModal={contactUsModal}
          changeSetNumberModal={changeSetNumberModal}
          userKazooPanelModal={userKazooPanelModal}
          history={history}
        />
        <div className="content">
          <div className={`sidebar-group ${toogleSidebar ? 'open' : ''}`}>
            <div id="chats" className="sidebar active">
              <button
                type="button"
                className="close"
                aria-label="Close"
                onClick={changeSidebar}
              >
                <span aria-hidden="true">×</span>
              </button>
              <header>
                <span>Conversations</span>
                <ul className="list-inline">
                  <li className="list-inline-item">
                    <div
                      className="btn btn-light"
                      id="newConversatoion"
                      onClick={conversationModal}
                    >
                      <i className="ti-comment"></i>
                    </div>
                    <Tooltip
                      placement="top"
                      isOpen={tooltipOpen}
                      autohide={false}
                      target="newConversatoion"
                      toggle={toggleTooltip}
                    >
                      New Conversation
                    </Tooltip>
                  </li>
                </ul>
              </header>
              <Nav tabs>
                <NavItem>
                  <NavLink
                    className={classnames({
                      active: favTab === 'favTab1',
                    })}
                    onClick={() => {
                      favTabToggole('favTab1')
                    }}
                  >
                    Conversation
                  </NavLink>
                </NavItem>
                <NavItem>
                  <NavLink
                    className={classnames({
                      active: favTab === 'favTab2',
                    })}
                    onClick={() => {
                      favTabToggole('favTab2')
                    }}
                  >
                    Favorites
                  </NavLink>
                </NavItem>
              </Nav>
              <div className="sidebar-body">
                <PerfectScrollbar>
                  <TabContent activeTab={favTab}>
                    <TabPane tabId="favTab1">
                      <ul className="list-group list-group-flush">
                        {members &&
                          members.normalMem &&
                          members.normalMem.map((member, i) => (
                            <li
                              key={i}
                              className={`list-group-item ${
                                member.memberNum === values.phoneNum
                                  ? 'open-chat'
                                  : ''
                              }`}
                            >
                              <figure
                                className="avatar"
                                onClick={() => setMemNumber(member.memberNum)}
                              >
                                <img src={sms} alt="member" />
                              </figure>
                              <div className="users-list-body">
                                <span
                                  onClick={() => setMemNumber(member.memberNum)}
                                >
                                  {member.labelName === '' ? (
                                    <h5>{phoneNumFormat(member.memberNum)}</h5>
                                  ) : (
                                    <span>
                                      <h5>{member.labelName}</h5>
                                      <h6>
                                        {phoneNumFormat(member.memberNum)}
                                      </h6>
                                    </span>
                                  )}
                                  {members.notifies &&
                                    members.notifies.map((notify, i) => {
                                      if (notify.number === member.memberNum) {
                                        return (
                                          <div
                                            key={i}
                                            className="users-list-action"
                                          >
                                            <div className="new-message-count">
                                              {notify.newMsg}
                                            </div>
                                          </div>
                                        )
                                      }
                                      return true
                                    })}
                                </span>
                                {members.notifies.length === 0 && (
                                  <div className="users-list-action">
                                    <div className="action-toggle">
                                      <DropMenu
                                        tab="favTab1"
                                        toNumber={member.memberNum}
                                        fromNumber={adminPhoneNum}
                                        email={userName.userEmail}
                                        deleteHistory={deleteHistory}
                                        contactID={member.contactID}
                                        labelName={member.labelName}
                                      />
                                    </div>
                                  </div>
                                )}
                              </div>
                            </li>
                          ))}
                      </ul>
                    </TabPane>

                    <TabPane tabId="favTab2">
                      <ul className="list-group list-group-flush">
                        {members &&
                          members.favoriteMem &&
                          members.favoriteMem.map((member, i) => (
                            <li
                              key={i}
                              className={`list-group-item ${
                                member.memberNum === values.phoneNum
                                  ? 'open-chat'
                                  : ''
                              }`}
                              onClick={() => setMemNumber(member.memberNum)}
                            >
                              <figure className="avatar">
                                <img src={sms} alt="member" />
                              </figure>
                              <div className="users-list-body">
                                {member.labelName === '' ? (
                                  <h5>{phoneNumFormat(member.memberNum)}</h5>
                                ) : (
                                  <span>
                                    <h5>{member.labelName}</h5>
                                    <h6>{phoneNumFormat(member.memberNum)}</h6>
                                  </span>
                                )}
                                {members.notifies &&
                                  members.notifies.map((notify, i) => {
                                    if (notify.number === member.memberNum) {
                                      return (
                                        <div
                                          key={i}
                                          className="users-list-action"
                                        >
                                          <div className="new-message-count">
                                            {notify.newMsg}
                                          </div>
                                        </div>
                                      )
                                    }
                                    return true
                                  })}
                                {members.notifies.length === 0 && (
                                  <div className="users-list-action">
                                    <div className="action-toggle">
                                      <DropMenu
                                        tab="favTab2"
                                        toNumber={member.memberNum}
                                        fromNumber={adminPhoneNum}
                                        email={userName.userEmail}
                                        contactID={member.contactID}
                                        labelName={member.labelName}
                                      />
                                    </div>
                                  </div>
                                )}
                              </div>
                            </li>
                          ))}
                      </ul>
                    </TabPane>
                  </TabContent>
                </PerfectScrollbar>
              </div>
            </div>
          </div>
          <div className="chat">
            <div className="chat-header">
              <div className="chat-header-user">
                <figure className="avatar avatar-lg">
                  <img src={silhoutte} alt="img" />
                </figure>
                <div>
                  <h5>{userName.fullName}</h5>
                  <small className="text-muted">
                    <i>
                      {adminPhoneNum
                        ? phoneNumFormat(adminPhoneNum)
                        : 'Phone Number'}
                    </i>
                  </small>
                </div>
              </div>
              <div className="chat-header-action">
                <ul className="list-inline">
                  <li className="list-inline-item">
                    <div className="btn btn-light" onClick={printerModal}>
                      <i className="ti-printer"></i>
                    </div>
                    {/* <Dropdown isOpen={printerDropdown} toggle={printerToggle}>
                      <DropdownToggle>
                        <i className="ti-more"></i>
                      </DropdownToggle>

                      {messages.length === 0 ? (
                        <DropdownMenu right>
                          <DropdownItem disabled>Print</DropdownItem>
                        </DropdownMenu>
                      ) : (
                        <DropdownMenu right>
                          <DropdownItem onClick={printerModal}>
                            Print
                          </DropdownItem>
                        </DropdownMenu>
                      )}
                    </Dropdown> */}
                  </li>
                </ul>
              </div>
            </div>
            {printerToogle && (
              <Printer
                printerToogle={printerToogle}
                printerModal={printerModal}
                startDate={startDate}
                endDate={endDate}
                startDateChange={startDateChange}
                endDateChange={endDateChange}
                exportPDF={exportPDF}
                styleMode={styleMode}
              />
            )}
            <div
              className={`chat-body ${
                messages.length === 0 ? 'no-message' : ''
              }`}
            >
              <PerfectScrollbar ref={messageScrollRef}>
                {messages.length === 0 ? (
                  <div className="no-message-container">
                    <i className="fas fa-comments"></i>
                    <p>Select a chat to read messages</p>
                  </div>
                ) : (
                  <div className="messages">
                    {values.phoneNum &&
                      messages &&
                      messages.map((message, index) => {
                        if (
                          values.phoneNum === message.to_number &&
                          adminPhoneNum === message.from_number &&
                          message.direction === 'out'
                        ) {
                          return (
                            <div
                              key={index}
                              className="message-item outgoing-message"
                            >
                              {mainNums.includes(adminPhoneNum) ||
                              mainNums.includes(values.phoneNum) ? (
                                <div className="message-action">
                                  From: {message.sender}
                                </div>
                              ) : (
                                ''
                              )}
                              {message.text ? (
                                <div className="message-content">
                                  {message.text}
                                </div>
                              ) : (
                                ''
                              )}
                              {message.media ? (
                                <div className="message-content mt-2">
                                  <a href={message.media} target="_blank">
                                    <img
                                      src={message.media}
                                      className="img-view"
                                      alt="download"
                                    />
                                  </a>
                                </div>
                              ) : (
                                ''
                              )}

                              {message.state === '1' ? (
                                <div className="message-action">
                                  {convertDateTime(message.createdAt)}
                                  <i className="ti-double-check"></i>
                                </div>
                              ) : (
                                <div className="message-action">
                                  {convertDateTime(message.createdAt)}
                                  <i className="ti-check"></i>
                                </div>
                              )}
                            </div>
                          )
                        } else if (
                          (values.phoneNum === message.from_number &&
                            adminPhoneNum === message.to_number &&
                            message.direction === 'in') ||
                          (message.media &&
                            values.phoneNum === message.from_number &&
                            adminPhoneNum === message.to_number)
                        ) {
                          return (
                            <div key={index} className="message-item">
                              {mainNums.includes(adminPhoneNum) ||
                              mainNums.includes(values.phoneNum) ? (
                                <div className="message-action">
                                  To: {phoneNumFormat(message.to_number)}
                                </div>
                              ) : (
                                ''
                              )}
                              {message.text ? (
                                <div className="message-content">
                                  {message.text}
                                </div>
                              ) : (
                                ''
                              )}
                              {message.media ? (
                                <div className="message-content mt-2">
                                  <a href={message.media} target="_blank">
                                    <img
                                      src={message.media}
                                      className="img-view"
                                      alt="download"
                                    />
                                  </a>
                                </div>
                              ) : (
                                ''
                              )}
                              <div className="message-action">
                                {convertDateTime(message.createdAt)}
                              </div>
                            </div>
                          )
                        }
                        return true
                      })}
                    {!values.phoneNum &&
                      messages &&
                      messages.map(
                        (message, index) =>
                          userPhoneNum &&
                          userPhoneNum.map(userNum => {
                            if (
                              userNum.number === message.from_number &&
                              message.direction === 'out'
                            ) {
                              return (
                                <div
                                  key={index}
                                  className="message-item outgoing-message"
                                >
                                  <div className="message-action">
                                    From: {phoneNumFormat(message.from_number)}
                                  </div>
                                  {message.text ? (
                                    <div className="message-content">
                                      {message.text}
                                    </div>
                                  ) : (
                                    ''
                                  )}
                                  {message.media ? (
                                    <div className="message-content mt-2">
                                      <a href={message.media} target="_blank">
                                        <img
                                          src={message.media}
                                          className="img-view"
                                          alt="download"
                                        />
                                      </a>
                                    </div>
                                  ) : (
                                    ''
                                  )}

                                  {message.state === '1' ? (
                                    <div className="message-action">
                                      {convertDateTime(message.createdAt)}
                                      <i className="ti-double-check"></i>
                                    </div>
                                  ) : (
                                    <div className="message-action">
                                      {convertDateTime(message.createdAt)}
                                      <i className="ti-check"></i>
                                    </div>
                                  )}
                                </div>
                              )
                            } else if (
                              (userNum === message.to_number &&
                                message.direction === 'in') ||
                              (message.media && userNum === message.to_number)
                            ) {
                              return (
                                <div key={index} className="message-item">
                                  <div className="message-action">
                                    To: {phoneNumFormat(message.to_number)}
                                  </div>

                                  {message.text ? (
                                    <div className="message-content">
                                      {message.text}
                                    </div>
                                  ) : (
                                    ''
                                  )}
                                  {message.media ? (
                                    <div className="message-content mt-2">
                                      <a href={message.media} target="_blank">
                                        <img
                                          src={message.media}
                                          className="img-view"
                                          alt="download"
                                        />
                                      </a>
                                    </div>
                                  ) : (
                                    ''
                                  )}
                                  <div className="message-action">
                                    {convertDateTime(message.createdAt)}
                                  </div>
                                </div>
                              )
                            }
                            return true
                          }),
                      )}
                    <div ref={messagesEndRef} id="end-message" />
                  </div>
                )}
              </PerfectScrollbar>
            </div>
            <div className="chat-footer">
              <div className="sender">
                {adminPhoneNum ? (
                  <div>
                    Sending via:
                    <span onClick={changeSetNumberModal}>
                      {phoneNumFormat(adminPhoneNum)}
                    </span>
                  </div>
                ) : (
                  ''
                )}
              </div>
              <div className="chat-footer-form">
                <div className="chat-image-upload">
                  <label id="#bb">
                    <i className="ti-clip"></i>
                    <input
                      type="file"
                      ref={uploadInput}
                      onChange={imageUpload}
                      accept="image/*"
                    />
                  </label>
                </div>
                <input
                  type="text"
                  name="msgText"
                  className="form-control"
                  placeholder="Message"
                  onChange={handleChange}
                  onKeyPress={handleChange}
                  value={values.msgText}
                />
                <div className="form-buttons">
                  <button
                    className="btn btn-primary btn-floating"
                    onClick={sendMessage}
                  >
                    <i className="fas fa-paper-plane"></i>
                  </button>
                </div>
              </div>
              <div className="message-action">{uploadImgName}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

const mapStateToProps = state => ({
  auth: state.auth,
  numbers: state.message.numbers,
  userName: state.message.userName,
  messages: state.message.messages,
  members: state.message.members,
  styleMode: state.message.numbers.styleMode,
})
const mapDispatchToProps = dispatch => ({
  sendMessage: (toNumber, fromNumber, msgText, sender, uploadImgName) =>
    dispatch(sendMessage(toNumber, fromNumber, msgText, sender, uploadImgName)),
  getMessage: (toNumber, fromNumber) => {
    dispatch(getMessage(toNumber, fromNumber))
  },
  getPrintMessage: (toNumber, fromNumber, startDate, endDate) => {
    dispatch(getPrintMessage(toNumber, fromNumber, startDate, endDate))
  },
  getAllNumbers: (userNumber, email) => {
    dispatch(getAllNumbers(userNumber, email))
  },
  setMemberNum: num => {
    dispatch(setMemberNum(num))
  },
  newMssage: (data, email) => {
    dispatch(newMssage(data, email))
  },
  getUserData: () => {
    dispatch(getUserData())
  },
  deleteConversation: (toNumber, fromNumber, email) => {
    dispatch(deleteConversation(toNumber, fromNumber, email))
  },
  getCallForward: () => {
    dispatch(getCallForward())
  },
})
export default connect(mapStateToProps, mapDispatchToProps)(Home)
