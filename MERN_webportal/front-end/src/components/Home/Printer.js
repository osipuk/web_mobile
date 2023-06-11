import React from 'react'
import DatePicker from 'react-datepicker'
import 'react-datepicker/dist/react-datepicker.css'
import './Home.css'

import { Button, Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap'

const Printer = props => {
  const {
    printerToogle,
    printerModal,
    startDate,
    endDate,
    startDateChange,
    endDateChange,
    exportPDF,
    styleMode,
  } = props
  return (
    <div>
      <Modal
        isOpen={printerToogle}
        toggle={printerModal}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={printerModal}>
          <i className="ti-printer"></i> Print Conversation
        </ModalHeader>
        <ModalBody className="printer-modal">
          <span className="tab-title">Please select a period of time.</span>
          <div className="mt-2 row">
            <div className="col-md-5">
              <DatePicker
                className="form-control calendar"
                onChange={startDateChange}
                maxDate={endDate}
                selected={startDate}
                placeholderText="Start Date"
              />
            </div>
            <div className="col-md-7">
              <DatePicker
                className="form-control calendar"
                onChange={endDateChange}
                selected={endDate}
                minDate={startDate}
                maxDate={new Date()}
              />
            </div>
          </div>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={exportPDF}>
            Print
          </Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}
export default Printer
