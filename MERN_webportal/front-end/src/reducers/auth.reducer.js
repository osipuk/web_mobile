import * as CONSTS from '../constants/const'

let defaultState = { auth: null, auth_token: null, auth_fail: false }

export default (state = defaultState, action) => {
  switch (action.type) {
    case CONSTS.GET_NEW_TOKEN_SUCCESS:
      return {
        ...state,
        auth: action.payload,
        auth_token: action.payload.auth_token,
        auth_fail: false,
      }
    case CONSTS.RESET_AUTH_TOKEN:
      return { ...state, auth_token: null }
    case CONSTS.FAIL_AUTH_REQUEST:
      return { ...state, auth_fail: true }
    default:
      return state
  }
}
