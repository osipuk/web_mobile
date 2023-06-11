import React, { useState } from 'react'
import { connect } from 'react-redux'
import './Home.css'
import {
  addFavoriteMessage,
  deleteFavoriteMessage,
  addUserLabel,
} from '../../actions/message.action'

import {
  Dropdown,
  DropdownToggle,
  DropdownMenu,
  DropdownItem,
  Button,
  Modal,
  ModalHeader,
  ModalBody,
  ModalFooter,
} from 'reactstrap'
const DropMenu = props => {
  const {
    addFavoriteMessage,
    deleteFavoriteMessage,
    addUserLabel,
    deleteHistory,
    tab,
    fromNumber,
    toNumber,
    email,
    styleMode,
    contactID,
    labelName,
  } = props
  const [consDropdown, setconsDropdown] = useState(false)
  const [addLabelDialog, setAddLabelDialog] = useState(false)
  const [labelValue, updatelabelValue] = useState(labelName)
  const consToggle = () => setconsDropdown(prevState => !prevState)

  const addFavorite = () => {
    addFavoriteMessage(fromNumber, toNumber, email)
  }

  const deleteFavorite = () => {
    deleteFavoriteMessage(fromNumber, toNumber, email)
  }
  const addLabel = () => {
    setAddLabelDialog(true)
  }
  const toggleAddLabel = () => {
    setAddLabelDialog(!addLabelDialog)
  }
  const changeLabelValue = e => {
    updatelabelValue(e.target.value)
  }
  const changeLabel = () => {
    addUserLabel(email, toNumber, labelValue, contactID, fromNumber)
    setAddLabelDialog(!addLabelDialog)
  }
  return (
    <div>
      <Dropdown isOpen={consDropdown} toggle={consToggle}>
        <DropdownToggle>
          <i className="ti-more"></i>
        </DropdownToggle>
        <DropdownMenu right>
          {tab === 'favTab1' && (
            <span>
              <DropdownItem onClick={() => addFavorite()}>
                Add Favorite
              </DropdownItem>
              <DropdownItem onClick={() => deleteHistory()}>
                Delete Conversation
              </DropdownItem>
            </span>
          )}
          {tab === 'favTab2' && (
            <DropdownItem onClick={() => deleteFavorite()}>
              Remove from Favorites
            </DropdownItem>
          )}
          <DropdownItem onClick={() => addLabel()}>
            {contactID === '' ? ' Add Contact Name' : 'Change Contact Name'}
          </DropdownItem>
        </DropdownMenu>
      </Dropdown>
      <Modal
        isOpen={addLabelDialog}
        toggle={toggleAddLabel}
        className={`${styleMode}-modal modal-dialog modal-dialog-centered modal-dialog-zoom`}
      >
        <ModalHeader toggle={toggleAddLabel}>
          <i className="ti-pencil-alt"></i> Add Name
        </ModalHeader>
        <ModalBody>
          <div className="contact">
            <div className="input-group">
              <input
                type="text"
                name="label"
                className="form-control"
                placeholder="Please Enter Contact Name"
                value={labelValue}
                onChange={changeLabelValue}
              />
            </div>
          </div>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={changeLabel}>
            {contactID === '' ? 'Add' : 'Change'}
          </Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}
const mapStateToProps = state => ({
  auth: state.auth,
  styleMode: state.message.numbers.styleMode,
})
const mapDispatchToProps = dispatch => ({
  addFavoriteMessage: (fromNumber, toNumber, email) =>
    dispatch(addFavoriteMessage(fromNumber, toNumber, email)),

  deleteFavoriteMessage: (fromNumber, toNumber, email) =>
    dispatch(deleteFavoriteMessage(fromNumber, toNumber, email)),
  addUserLabel: (email, toNumber, label, contactID, fromNumber) =>
    dispatch(addUserLabel(email, toNumber, label, contactID, fromNumber)),
})
export default connect(mapStateToProps, mapDispatchToProps)(DropMenu)
