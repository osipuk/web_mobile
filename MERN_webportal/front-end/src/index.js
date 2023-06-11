import React from 'react'
import ReactDOM from 'react-dom'
import { Router } from 'react-router-dom'

import './index.css'

import App from './components/App'
import registerServiceWorker from './registerServiceWorker'

import { createStore, applyMiddleware } from 'redux'
import { Provider } from 'react-redux'
import thunk from 'redux-thunk'
import { createBrowserHistory } from 'history'
import logger from 'redux-logger'
import reducers from './reducers'
import ReduxPromise from 'redux-promise'

const store = createStore(
  reducers,
  applyMiddleware(thunk, logger, ReduxPromise),
)
const history = createBrowserHistory()

ReactDOM.render(
  <Provider store={store}>
    <Router history={history}>
      <App />
    </Router>
  </Provider>,
  document.getElementById('root'),
)
registerServiceWorker()
