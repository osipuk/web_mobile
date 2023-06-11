import axios from 'axios'
import CONFIG from '../constants/config'
import * as CONSTS from '../constants/const'

export const getCallFlow = (start, end) => {
  console.log(start,end,'ggggggggdddeeee');
  let startDate = new Date(start)
  let endDate = new Date(end)
  // console.log(startDate,endDate,'ggggggggddd');
  let start_year = startDate.getFullYear() + 1970
  let start_month = startDate.getMonth()
  let start_date = startDate.getDate()
  let end_year = endDate.getFullYear() + 1970
  let end_month = endDate.getMonth()
  let end_date = endDate.getDate()
  
  let start_timestamp =
    Math.round(
      new Date(start_year, start_month, start_date, 0, 0, 0, 0).getTime(),
    ) / 1000
  let end_timestamp =
    Math.round(
      new Date(end_year, end_month, end_date, 23, 59, 59, 999).getTime(),
    ) / 1000
    console.log(start_timestamp,'timestamp',end_timestamp);
  return dispatch => {
    let account_id = localStorage.getItem('account_id')
    let user_id = localStorage.getItem('user_id')
    const auth_token = localStorage.getItem('token')
    axios.defaults.headers.common['X-AUTH-TOKEN'] = auth_token
const calldata = `${CONFIG.API_URL}/accounts/${account_id}/users/${user_id}/cdrs?created_from=${start_timestamp}&created_to=${end_timestamp}&paginate=false`
//const calldata = `${CONFIG.API_URL}/accounts/${account_id}/cdrs?created_from=${start_timestamp}&created_to=${end_timestamp}&paginate=false`

    const username = `${CONFIG.API_URL}/accounts/${account_id}/users/${user_id}`
    axios
      .all([axios.get(calldata), axios.get(username)])
      .then(
        axios.spread((calldata, username) => {
          let call_data = calldata.data.data
          let full_name =
            username.data.data.first_name + ' ' + username.data.data.last_name
          var callData = { call_data, full_name }
          console.log(callData,'this is calldata');
          dispatch({ type: CONSTS.GET_ALL_CALLFLOW, payload: callData })
        }),
      )
      .catch(error => {
        if (
          typeof error !== 'undefined' &&
          typeof error.response !== 'undefined' &&
          error.response.status === 401
        ) {
          dispatch({ type: CONSTS.FAIL_AUTH_REQUEST, payload: 'Auth_Failed' })
        }
      })
  }
}
