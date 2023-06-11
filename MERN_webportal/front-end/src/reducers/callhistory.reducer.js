// @flow
import * as CONSTS from '../constants/const';

let defaultState = { call_flow: [], systemAuth: null }

export default (state = defaultState, action) => {
  switch (action.type) {
    case CONSTS.GET_ALL_CALLFLOW:
      return { ...state, call_flow: action.payload }
    case CONSTS.FAIL_AUTH_REQUEST:
      return { ...state, call_flow: [], systemAuth: action.payload }
    default:
      return state
  }
}
