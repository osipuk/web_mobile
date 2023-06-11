import React from 'react'
import '../Home/Home.css'

const Sidebar = props => {
  const {
    history,
    changeSidebar,
    toogleSidebar,
    contactUsModal,
    changeSetNumberModal,
    userKazooPanelModal,
  } = props

  const logout = () => {
    localStorage.removeItem('token')
    localStorage.removeItem('account_id')
    localStorage.removeItem('user_id')
    history.push('/')
  }
  const reload = () => {
    window.location.reload(true)
  }
  return (
    <nav className="navigation">
      <div className="nav-group">
        <ul>
          <li>
            <span className="logo"></span>
          </li>
          <li className="nav-menu">
            <span
              data-navigation-target="chats"
              onClick={changeSidebar}
              className={toogleSidebar ? 'active' : ''}
            >
              <i className="ti-menu-alt"></i>
            </span>
          </li>
          <li>
            <span onClick={() => history.push('/home')}>
              <i className="ti-comment-alt"></i>
            </span>
          </li>

          <li>
            <span onClick={() => history.push('/callhistory')}>
              <i className="ti-notepad"></i>
            </span>
          </li>
          <li className="brackets">
            <span onClick={() => history.push('/voicemails')}>
              <i className="ti-email"></i>
            </span>
          </li>

          <li>
            <span onClick={contactUsModal}>
              <i className="ti-envelope"></i>
            </span>
          </li>
          <li>
            <span onClick={changeSetNumberModal}>
              <i className="ti-settings"></i>
            </span>
          </li>
          <li>
            <span onClick={userKazooPanelModal}>
              <i className="ti-panel"></i>
            </span>
          </li>

          <li>
            <span onClick={reload}>
              <i className="ti-reload"></i>
            </span>
          </li>
          <li onClick={logout}>
            <span>
              <i className="ti-power-off"></i>
            </span>
          </li>
        </ul>
      </div>
    </nav>
  )
}
export default Sidebar
