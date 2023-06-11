// @flow
import * as CONSTS from '../constants/const'

let defaultState = { voicemails: [] }

export default (state = defaultState, action) => {
  switch (action.type) {
    case CONSTS.GET_ALL_VOICEMAILS:
      return { ...state, voicemails: action.payload }
    case CONSTS.FAIL_AUTH_REQUEST:
      return { ...state, voicemails: [], systemAuth: action.payload }
    default:
      return state
  }
}
