import axios from 'axios'
import md5 from 'md5'
import CONFIG from '../constants/config'
import * as CONSTS from '../constants/const'

axios.defaults.headers.get['Content-Type'] = 'application/json'

export const getNewAuthToken = (username, password, accountname) => {
  return dispatch => {
    const URI = `${CONFIG.API_URL}/user_auth`
    const body = {
      data: {
        credentials: md5(`${username}:${password}`),
        account_name: accountname,
      },
    }
    axios
      .put(URI, body)
      .then(res => {
        dispatch({ type: CONSTS.GET_NEW_TOKEN_SUCCESS, payload: res.data })
      })
      .catch(error => {
        dispatch({ type: CONSTS.FAIL_AUTH_REQUEST, payload: error })
      })
  }
}
export const getUserData = () => {
  return dispatch => {
    const account_id = localStorage.getItem('account_id')
    const owner_id = localStorage.getItem('user_id')
    const auth_token = localStorage.getItem('token')

    axios.defaults.headers.common['X-AUTH-TOKEN'] = auth_token
    //const device_num = `${CONFIG.API_URL}/accounts/${account_id}/callflows?filter_type=mainUserCallflow&filter_owner_id=${owner_id}&paginate=false`
    const device_num = `${CONFIG.API_URL}/accounts/${account_id}/callflows?filter_type=mainUserCallflow`
    const username = `${CONFIG.API_URL}/accounts/${account_id}/users/${owner_id}`
    const callflows = `${CONFIG.API_URL}/accounts/${account_id}/callflows?has_type=type&paginate=false`
    axios
      .all([axios.get(device_num), axios.get(username), axios.get(callflows)])
      .then(
        axios.spread((device_num, userData, callflows) => {
          let mainNums = callflows.data.data.filter(
            nums => nums.type === 'main' && nums.name === 'MainCallflow',
          )[0].numbers

          const phone_num = []
          if (device_num.data.data[0].numbers.length > 1) {
            device_num.data.data[0].numbers.forEach(number => {
              if (number.length > 4) phone_num.push(number)
            })
          }
          let full_name =
            userData.data.data.first_name + ' ' + userData.data.data.last_name
          console.log('this is main number',mainNums);
          mainNums.forEach(num => {
            if (num !== '0' && num !== 'undefinedMainNumber') {
              phone_num.push(num)
            }
          })
          if (mainNums[0] === 'undefinedMainNumber') {
            mainNums = []
          }
          let user_data = {
            fullName: full_name,
            userEmail: userData.data.data.email,
            mainNums: mainNums,
          }
          let num_msg = []
          phone_num.forEach(num => {
            axios
              .post(`${CONFIG.serverURL}/getunreadmessage`, {
                userNumber: num,
              })
              .then(res => {
                num_msg.push({ number: num, msgCount: res.data.count })
              })
          })

          axios
            .post(`${CONFIG.serverURL}/userchk`, {
              email: userData.data.data.email,
            })
            .then(res => {
              let phoneNumbers = {
                savedNumber: res.data.phoneNumber,
                numberList: num_msg,
                styleMode: res.data.style_mode ? res.data.style_mode : 'dark',
                emailAlert: res.data.emailAlert,
              }
              dispatch({
                type: CONSTS.GET_USER_NUMBER,
                payload: phoneNumbers,
              })
            })
          dispatch({ type: CONSTS.GET_USER_DATA, payload: user_data })
        }),
      )
  }
}
