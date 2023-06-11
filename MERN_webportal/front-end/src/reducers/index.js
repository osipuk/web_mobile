import { combineReducers } from 'redux'
import auth from './auth.reducer'
import message from './message.reducer'
import callhistory from './callhistory.reducer'
import voicemails from './voicemails.reducer'

const rootReducers = combineReducers({
  auth: auth,
  message: message,
  callhistory: callhistory,
  voicemails,
})

export default rootReducers
