import React from 'react'
import { connect } from 'react-redux'
import { getCallFlow } from '../../actions/callhistory.action'
import { parsePhoneNumber } from 'libphonenumber-js'
import PerfectScrollbar from 'react-perfect-scrollbar'
import { HistorySearch } from './HistorySearch'
import { HistoryTable } from './HistoryTable'
import Sidebar from '../Sidebar/Sidebar'
import './History.css'
import Dialog from '../Sidebar/Dialog'

class History extends React.Component {
  constructor(props) {
    super(props)
    const day = new Date()
    this.state = {
      account_id: '',
      user_id: '',
      startDate: new Date(day.setDate(day.getDate() - 7)),
      endDate: new Date(),
      filter: '',
      call_list: [],
      perPage: 10,
      currentPage: 0,
      call_low: '',
      total: 0,
      contactToogle: false,
      setNumberToogle: false,
    }
  }

  componentDidMount() {
    this.props.getCallFlow(this.state.startDate, this.state.endDate)
  }
  componentDidUpdate(preProps) {
    let { call_flow } = this.props.callhistory

    if (call_flow !== preProps.callhistory.call_flow) {
      let call_data = call_flow.call_data
      let total = call_data ? call_data.length : 0
      this.setState({ call_flow: call_data, total: total })
    }
  }
  startDateChange = date => {
    console.log(date,'this is date');

    this.setState(
      {
        startDate: date,
      },
      () => {
        var dateDiff = parseInt(
          (this.state.endDate.getTime() - this.state.startDate.getTime()) /
            (24 * 3600 * 1000),
          10,
        )
        if (dateDiff > 30) {
          this.setState({
            endDate: new Date(
              this.state.startDate.getTime() + 30 * 24 * 3600 * 1000,
            ),
          })
        }
      },
    )
  }
  endDateChange = date => {
    this.setState(
      {
        endDate: date,
      },
      () => {
        var dateDiff = parseInt(
          (this.state.endDate.getTime() - this.state.startDate.getTime()) /
            (24 * 3600 * 1000),
          10,
        )
        if (dateDiff > 30) {
          this.setState({
            startDate: new Date(
              this.state.endDate.getTime() - 30 * 24 * 3600 * 1000,
            ),
          })
        }
      },
    )
  }
  changeFilter = data => {
    this.setState({
      filter: data,
    })
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
  apply = () => {
    console.log(this.state.startDate,this.state.endDate);
    this.props.getCallFlow(     
      this.state.startDate,
      this.state.endDate,
      this.state.account_id,
      this.state.user_id
    )
  }
  selectPerPage = e => {
    this.setState({ perPage: e.target.value })
  }
  setCountLabel = total => {
    if (this.state.perPage * (this.state.currentPage + 1) < total)
      return this.state.perPage * (this.state.currentPage + 1)
    else return total
  }
  phoneParse = number => {
    if (number.includes('+')) {
      let callNumber = parsePhoneNumber(number).formatNational()
      return callNumber
    } else if (number.length === 10) {
      let callNumber = parsePhoneNumber(`+1${number}`).formatNational()
      return callNumber
    }
  }
  contactUsModal = () => {
    this.setState({ contactToogle: !this.state.contactToogle })
  }
  changeSetNumberModal = () => {
    this.setState({ setNumberToogle: !this.state.setNumberToogle })
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
            <div className="history">
              <PerfectScrollbar>
                <div className="main-container">
                  <HistorySearch
                    startDateChange={this.startDateChange}
                    endDateChange={this.endDateChange}
                    changeFilter={this.changeFilter}
                    apply={this.apply}
                    state={this.state}
                  />
                  <HistoryTable
                    list={this.state.call_flow}
                    perPage={this.state.perPage}
                    currentPage={this.state.currentPage}
                    filter={this.state.filter}
                  />
                  <nav className="bottom-nav">
                    <label className="mr-2">Views</label>
                    <select onChange={this.selectPerPage}>
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                    <label className="ml-2">Per Page</label>
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
                      <button onClick={this.prev} className="button-enable">
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
                      <button onClick={this.next} className="button-enable">
                        &#62;
                      </button>
                    )}
                  </nav>
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
  callhistory: state.callhistory,
  styleMode: state.message.numbers.styleMode,
})
const mapDispatchToProps = dispatch => ({
  getCallFlow: (start, end) => dispatch(getCallFlow(start, end)),
})
export default connect(mapStateToProps, mapDispatchToProps)(History)
