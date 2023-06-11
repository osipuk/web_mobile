import React from 'react'
import DatePicker from 'react-datepicker'
import './History.css'

export class HistorySearch extends React.Component {
  constructor(props) {
    super(props)
    this.onChange = this.onChange.bind(this)
  }
  onChange = e => {  
    this.props.changeFilter(e.target.value.trim())
  }
  render() {
    return (
      <div className="history-search">
        <div className="state-date">
          <label>START DATE</label>
          <DatePicker
            className="form-control calendar1"
            onChange={this.props.startDateChange}
            maxDate={this.props.state.endDate}
            selected={this.props.state.startDate}
            placeholderText="mm/dd/yyyy"
          />
        </div>
        <div className="end-date">
          <label>END DATE</label>
          <DatePicker
            className="form-control calendar1"
            onChange={this.props.endDateChange}
            selected={this.props.state.endDate}
            minDate={this.props.state.startDate}
            maxDate={new Date()}
            placeholderText="mm/dd/yyyy"
          />
        </div>
        <div>
          <button
            className="btn history-search-button btn-primary"
            onClick={this.props.apply}
          >
            Apply
          </button>
        </div>
        <div className="text-right">
          <input
            className="form-control call-search-text"
            type="text"
            placeholder="Search"
            onChange={this.onChange}
          />
        </div>
      </div>
    )
  }
}
