import React from 'react'
import PerfectScrollbar from 'react-perfect-scrollbar'
import Sidebar from '../Sidebar/Sidebar'
import Dialog from '../Sidebar/Dialog'
import './voicemails.css'
class VoicemailBox extends React.Component {
  render() {
    return (
      <div className={this.props.styleMode}>
        <div className="layout">
          <Sidebar
            history={this.props.history}
            contactUsModal={this.props.contactUsModal}
            changeSetNumberModal={this.props.changeSetNumberModal}
          />
          <Dialog
            contactUsModal={this.props.contactUsModal}
            contactToogle={this.props.contactToogle}
            changeSetNumberModal={this.props.changeSetNumberModal}
            setNumberToogle={this.props.setNumberToogle}
          />
          <div className="content">
            <div className="voicemailbox-container">
              <PerfectScrollbar>
                <div className="voicemail-list">
                  {this.props.allmessages &&
                    this.props.allmessages.map((box, index) => (
                      <div className="col-md-4 mb-3 main-container" key={index}>
                        <MailboxContainer
                          {...box.vmbox}
                          history={this.props.history}
                          styleMode={this.props.styleMode}
                          index={index}
                        />
                      </div>
                    ))}
                </div>
              </PerfectScrollbar>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default VoicemailBox

const MailboxContainer = props => {
  return (
    <div className="voicemailbox">
      <div
        className={
          props.newcount > 0
            ? `${props.styleMode}-voicemailbox-wrapper voicemailbox-wrapper voicemails-top-1`
            : `${props.styleMode}-voicemailbox-wrapper voicemailbox-wrapper voicemails-top-2`
        }
        onClick={() => props.history.push('/voicemails/list/' + props.id)}
      >
        <div className="pb-4">
          <h2>{props.name}</h2>
        </div>
        <div className="voicemail-mailbox">
          <div>
            <h1 className={props.newcount > 0 ? 'newcount' : ''}>
              {props.newcount}
            </h1>
            <span className="num-title">New</span>
          </div>
          <div>
            <h1 className="totalcount">{props.messages}</h1>
            <span className="num-title">Total</span>
          </div>
        </div>
      </div>
    </div>
  )
}
