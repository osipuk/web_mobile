import React from 'react'

import Audioplayer from './Audioplayer'
import axios from 'axios'
import { parsePhoneNumber } from 'libphonenumber-js'
import './voicemails.css'
import moment from 'moment'
import telIcon from '../../asset/media/svg/telicon-2.2.0.svg'
import CONFIG from '../../constants/config.json'

const Message = props => {
  let from = props.from
  let to = props.to
  let vmbox_id = props.vmbox_id
  let media_id = props.media_id
  let auth_token = props.auth_token
  let account_id = props.account_id
  let URL = `${CONFIG.API_URL}/accounts/${account_id}/vmboxes/${vmbox_id}/messages/${media_id}/raw?auth_token=${auth_token}`
  return (
    <div
      className={
        props.playStatus.audioPlay && props.audioId !== props.playStatus.audioId
          ? 'voicemail-row disabledbutton voicemail-row-active'
          : 'voicemail-row'
      }
    >
      <div className="col-md-2 row">
        {props.folder === 'new' ? (
          <span className="newstatus">New</span>
        ) : props.folder === 'saved' ? (
          <span className="listenedstatus">Listened</span>
        ) : props.folder === 'deleted' ? (
          <span className="deletedstatus">Deleted</span>
        ) : (
          ''
        )}
      </div>
      <div className="col-md-2">
        <div className="text-left name">
          {getDateTime(props.timestamp).date}
        </div>
        <div className="text-left number">
          {getDateTime(props.timestamp).time}
        </div>
      </div>
      <div className="col-md-2">
        <div className="text-left name">
          {' '}
          {getPhoneNumber(from.split('@')[0])}
        </div>
      </div>
      <div className="col-md-2">
        <div className="text-left name">
          {' '}
          {getPhoneNumber(to.split('@')[0])}
        </div>
      </div>
      <div className="col-md-4">
        {props.playStatus.audioPlay &&
        props.audioId === props.playStatus.audioId ? (
          <div className="row">
            <div className="col-md-10">
              <Audioplayer props={props} />
            </div>
            <div className="col-md-2">
              <button
                className="audio-close"
                onClick={() =>
                  props.audioPlayerEnd(
                    props.audioId,
                    vmbox_id,
                    media_id,
                    props.folder,
                  )
                }
              >
                Close
              </button>
            </div>
          </div>
        ) : (
          <div className="row">
            <div className="col-md-6">
              <div className="text-left name">
                {' '}
                {getDuration(props.length / 1000)}
              </div>
            </div>
            <div className="col-md-6">
              <div className="mailchange">
                <svg
                  className="mr-3 audioplay gray-icon"
                  onClick={() => props.audioPlayer(props.audioId)}
                >
                  <use href={`${telIcon}#play--circle`} />
                </svg>
                <a href={URL}>
                  <svg className="gray-icon">
                    <use href={`${telIcon}#download-cloud`} />
                  </svg>
                </a>
                <svg
                  className="ml-4 delete gray-icon"
                  onClick={() => props.voicemailDelete(vmbox_id, media_id)}
                >
                  <use href={`${telIcon}#trash`} />
                </svg>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}

function getDateTime(timestamp) {
  let stamp = new Date(timestamp * 1000)
  let year = stamp.getFullYear() - 1970
  let month = stamp.getMonth() + 1
  let date = '0' + stamp.getDate()
  let hours = '0' + stamp.getHours()
  let minutes = '0' + stamp.getMinutes()
  let seconds = '0' + stamp.getSeconds()
  let formattedDate = year + '-' + month + '-' + date.substr(-2)
  let formattedTime =
    hours.substr(-2) + ':' + minutes.substr(-2) + ':' + seconds.substr(-2)
  let dateTime1 = formattedDate + ' ' + formattedTime
  let gmtDateTime = moment.utc(dateTime1, 'YYYY-MM-DD HH:mm:ss')
  let local = gmtDateTime.local().format('MM/DD/YYYY HH:mm:ss')
  let dateTime = { date: local.split(' ')[0], time: local.split(' ')[1] }
  return dateTime
}

function getDuration(totalSeconds) {
  let hours = Math.floor(totalSeconds / 3600)
  let minutes = Math.floor((totalSeconds - hours * 3600) / 60)
  let seconds = Math.floor(totalSeconds - hours * 3600 - minutes * 60)
  seconds = Math.round(seconds * 100) / 100

  let result = ''
  if (hours !== 0) {
    result += (hours < 10 ? '0' + hours : hours) + ':'
  }
  result += (minutes < 10 ? '0' + minutes : minutes) + ':'
  result += seconds < 10 ? '0' + seconds : seconds

  return result
}
function getPhoneNumber(number) {
  let phone_number = ''
  if (!number.includes('+')) {
    if (number.length === 11) {
      phone_number = parsePhoneNumber('+' + number)
      let phone_num = phone_number.formatInternational()
      return phone_num
    } else if (number.length === 10) {
      phone_number = parsePhoneNumber('+1' + number)
      let phone_num = phone_number.formatInternational()
      return phone_num
    } else {
      return number
    }
  } else {
    phone_number = parsePhoneNumber(number)
    let phone_num = phone_number.formatInternational()
    return phone_num
  }
}

class VoicemailsTable extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      allmessages: [],
      audioPlay: false,
      audioId: '',
      checkKey: '',
      checkState: false,
      messageRecords: '',
      auth_token: null,
      account_id: null,
      user_id: null,
    }
  }

  componentDidUpdate(preProps) {
    const { allmessages } = this.props

    if (allmessages !== preProps.allmessages) {
      let perPage = this.props.perPage
      let currentPage = this.props.currentPage
      let messageRecords = this.filtermailList(
        allmessages,
        perPage,
        currentPage,
      )

      let account_id = localStorage.getItem('account_id')
      let user_id = localStorage.getItem('user_id')
      const auth_token = localStorage.getItem('token')

      this.setState({
        messageRecords: messageRecords,
        auth_token: auth_token,
        account_id: account_id,
        user_id: user_id,
      })
    }
  }

  getPhoneNumber = number => {
    let phone_number = ''
    if (!number.includes('+')) {
      if (number.length === 11) {
        phone_number = parsePhoneNumber('+' + number)
        let phone_num = phone_number.formatInternational()
        return phone_num
      } else if (number.length === 10) {
        phone_number = parsePhoneNumber('+1' + number)
        let phone_num = phone_number.formatInternational()
        return phone_num
      } else {
        return number
      }
    } else {
      phone_number = parsePhoneNumber(number)
      let phone_num = phone_number.formatInternational()
      return phone_num
    }
  }

  filtermailList = (messageRecords, perPage, currentPage, search) => {
    let subMessageRecords = []
    if (messageRecords && messageRecords.length > 0) {
      for (
        var index = perPage * currentPage;
        index < perPage * (currentPage + 1);
        index++
      ) {
        if (messageRecords[index]) {
          if (!search) {
            subMessageRecords.push(messageRecords[index])
          } else {
            let searchKey = search.trim()
            let from = this.getPhoneNumber(
              messageRecords[index].from.split('@')[0],
            )
            let to = this.getPhoneNumber(messageRecords[index].to.split('@')[0])
            if (
              from.includes(searchKey) ||
              to.includes(searchKey) ||
              messageRecords[index].caller_id_name.includes(searchKey)
            )
              subMessageRecords.push(messageRecords[index])
          }
        }
      }
    }
    return subMessageRecords
  }

  audioPlayer = key => {
    this.setState({
      audioId: key,
      audioPlay: !this.state.audioPlay,
    })
  }

  voicemailDelete = (vmbox_id, media_id) => {
    if (window.confirm('Are you sure wish to delete this Voicemail?')) {
      let URL = `${CONFIG.API_URL}/accounts/${this.state.account_id}/vmboxes/${vmbox_id}/messages/${media_id}`
      axios
        .delete(URL)
        .then(res => {
          this.props.getallVmboxes()
        })
        .catch(error => {
          console.log(error)
        })
    }
  }

  audioPlayerEnd = (key, vmbox_id, media_id, state) => {
    if (state === 'new') {
      let url = `${CONFIG.API_URL}/accounts/${this.state.account_id}/vmboxes/${vmbox_id}/messages/${media_id}`
      axios
        .post(url)
        .then(res => {
          this.props.getallVmboxes()
        })
        .catch(error => {
          console.log(error)
        })
    }
    this.setState({
      audioId: key,
      audioPlay: !this.state.audioPlay,
    })
  }

  render() {
    const { allmessages, perPage, currentPage, searchKey } = this.props

    let messageRecords = this.filtermailList(
      allmessages,
      perPage,
      currentPage,
      searchKey,
    )
    return (
      <div className="row text-left">
        <div className="voicemailtable">
          <div className="mb-2 row1">
            <div className="col-md-2 row">STATUS</div>
            <div className="col-md-2">DATE TIME</div>
            <div className="col-md-2">FROM</div>
            <div className="col-md-2">TO</div>
            <div className="col-md-2">DURATION</div>
            <div className="col-md-2" />
          </div>
          {messageRecords && messageRecords.length > 0 ? (
            messageRecords.map((message, index) => (
              <Message
                audioPlayer={this.audioPlayer}
                audioPlayerEnd={this.audioPlayerEnd}
                voicemailDelete={this.voicemailDelete}
                auth_token={this.state.auth_token}
                account_id={this.state.account_id}
                user_id={this.state.user_id}
                itemState={this.props.itemState}
                checkboxChange={this.props.checkboxChange}
                vmbox_id={this.props.vmbox_id}
                playStatus={this.state}
                audioId={message.media_id}
                key={index}
                {...message}
              />
            ))
          ) : (
            <div className="col-md-12 text-center">
              <h2>No Results!</h2>
            </div>
          )}
        </div>
      </div>
    )
  }
}

export default VoicemailsTable
