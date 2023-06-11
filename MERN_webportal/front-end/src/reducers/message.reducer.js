import * as CONSTS from '../constants/const'

let defaultState = {
  numbers: [],
  userName: [],
  messages: [],
  members: [],
  mem_number: '',
  notification: { state: false, fromNumber: '' },
}

export default (state = defaultState, action) => {
  switch (action.type) {
    case CONSTS.GET_USER_NUMBER:
      return { ...state, numbers: action.payload }
    case CONSTS.GET_USER_DATA:
      return { ...state, userName: action.payload }
    case CONSTS.GET_ALL_MESSAGES:
      return { ...state, messages: action.payload }
    case CONSTS.GET_ALL_USERS:
      return { ...state, members: action.payload }
    case CONSTS.SET_MEM_NUMBER:
      return { ...state, mem_number: action.payload }
    case CONSTS.SMS_NOTIFICATION:
      return { ...state, notification: action.payload }
    case CONSTS.GET_CALL_FORWARD:
      return { ...state, call_forward: action.payload }
    default:
      return state
  }
}
