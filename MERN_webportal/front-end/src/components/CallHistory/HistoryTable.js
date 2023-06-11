import React from 'react'
import { parsePhoneNumber } from 'libphonenumber-js'
import telIcon from '../../asset/media/svg/telicon-2.2.0.svg'
import './History.css'

export class HistoryTable extends React.Component {
  constructor(props) {
    super(props)

    this.filterCallList = this.filterCallList.bind(this)
    this.getPhoneNumber = this.getPhoneNumber.bind(this)
    this.formatDuration = this.formatDuration.bind(this)
  }

  filterCallList = (callRecords, perPage, currentPage, filter) => {
    let subCallRecords = []
    if (callRecords && callRecords.length > 0) {
      for (
        var index = perPage * currentPage;
        index < perPage * (currentPage + 1);
        index++
      ) {
        if (callRecords[index]) {
          if (!filter) {
            subCallRecords.push(callRecords[index])
          } else {
            if (
              this.getPhoneNumber(callRecords[index].callee_id_number).indexOf(
                filter,
              ) >= 0 ||
              this.getPhoneNumber(callRecords[index].caller_id_number).indexOf(
                filter,
              ) >= 0 ||
              this.getPhoneNumber(callRecords[index].callee_id_name).indexOf(
                filter,
              ) >= 0 ||
              this.getPhoneNumber(callRecords[index].caller_id_name).indexOf(
                filter,
              ) >= 0
            ) {
              subCallRecords.push(callRecords[index])
            }
          }
        }
      }
    }
    return subCallRecords
  }

  getPhoneNumber = number => {
    let phone_number = ''
    var phoneNumber
    if (!number.includes('+')) {
      if (number.length === 11) {
        phone_number = parsePhoneNumber('+' + number)
        let phone_num = phone_number.formatInternational()
        let number_arr = phone_num.split(' ')
        phoneNumber =
          number_arr[0] +
          ' ' +
          number_arr[1] +
          '-' +
          number_arr[2] +
          '-' +
          number_arr[3]
        return phoneNumber
      } else if (number.length === 10) {
        phone_number = parsePhoneNumber('+1' + number)
        let phone_num = phone_number.formatInternational()
        let number_arr = phone_num.split(' ')
        phoneNumber =
          number_arr[0] +
          ' ' +
          number_arr[1] +
          '-' +
          number_arr[2] +
          '-' +
          number_arr[3]
        return phoneNumber
      } else {
        return number
      }
    } else {
      phone_number = parsePhoneNumber(number)
      let phone_num = phone_number.formatInternational()
      let number_arr = phone_num.split(' ')
      phoneNumber =
        number_arr[0] +
        ' ' +
        number_arr[1] +
        '-' +
        number_arr[2] +
        '-' +
        number_arr[3]
      return phoneNumber
    }
  }

  getDateTime = timestamp => {
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
    let dateTime = { date: formattedDate, time: formattedTime }
    return dateTime
  }

  formatDuration = sec => {
    var date = new Date(null)
    date.setSeconds(sec)
    var timeString = date.toISOString().substr(11, 8)
    timeString = timeString.split(':')[1] + ':' + timeString.split(':')[2]
    return timeString
  }

  render() {
    let callRecords = this.props.list
    let perPage = this.props.perPage
    let currentPage = this.props.currentPage
    let filter = this.props.filter
    callRecords = this.filterCallList(callRecords, perPage, currentPage, filter)

    return (
      <div className="call-history-table">
        <div className="row history-table-title">
          <div className="col-md-4">FROM</div>
          <div className="col-md-3">TO</div>
          <div className="col-md-3">DATE TIME</div>
          <div className="col-md-2">DURATION</div>
        </div>
        {callRecords && callRecords.length > 0 ? (
          callRecords.map((call, index) => (
            <div key={index} className="row call-history-row">
              <div className="col-md-4 history-from">
                <div className="mr-3 call-icon">
                  {call.direction === 'inbound' ? (
                    <svg className="outcalls-icon">
                      <use href={`${telIcon}#phone-outbound`} />
                    </svg>
                  ) : call.hangup_cause !== 'NO_ANSWER' ? (
                    <svg className="incalls-icon">
                      <use href={`${telIcon}#phone-inbound`} />
                    </svg>
                  ) : (
                    <svg className="missed-icon">
                      <use href={`${telIcon}#phone-missed`} />
                    </svg>
                  )}
                </div>
                <div>
                  <div className="text-left name">{call.caller_id_name}</div>
                  <div className="text-left number">
                    {this.getPhoneNumber(call.caller_id_number)}
                  </div>
                </div>
              </div>
              <div className="col-md-3">
                <div className="name text-left">{call.callee_id_name}</div>
                <div className="number text-left">
                  {this.getPhoneNumber(call.dialed_number)}
                </div>
              </div>
              <div className="col-md-3">
                <div className="text-left name">
                  {this.getDateTime(call.timestamp).date}
                </div>
                <div className="text-left number">
                  {this.getDateTime(call.timestamp).time}
                </div>
              </div>
              <div className="col-md-2">
                {this.formatDuration(call.duration_seconds)}
              </div>
            </div>
          ))
        ) : (
          <div className="col-md-12 text-center">
            <h2>No Results!</h2>
          </div>
        )}
      </div>
    )
  }
}
