import axios from 'axios'
import CONFIG from '../constants/config'
import * as CONSTS from '../constants/const'
import { getUserData } from './auth.action'
axios.defaults.headers.post['Content-Type'] = 'application/json'
export const sendMessage = (
  toNumber,
  fromNumber,
  text,
  sender,
  uploadImgName,
) => {
  return async dispatch => {
    const URL = `${CONFIG.corsURL}${CONFIG.Mssgae_URL}/users/${CONFIG.accountId}/messages`
    let data = null
    if (uploadImgName) {
      data = {
        to: [toNumber],
        from: fromNumber,
        text: text,
        applicationId: CONFIG.applicationId,
        media: [`${CONFIG.serverURL}/mms_images/${uploadImgName}`],
        tag: 'test message',
      }
    } else {
      data = {
        to: [toNumber],
        from: fromNumber,
        text: text,
        applicationId: CONFIG.applicationId,
        tag: 'test message',
      }
    }

    await axios({
      url: URL,
      method: 'post',
      headers: { 'content-type': 'application/json' },
      auth: {
        username: CONFIG.apiToken,
        password: CONFIG.apiSecret,
      },
      data: data,
    })
      .then(res => {
        console.log(res,' this is callback from bandwidth api');
        if (res && res.statusText === 'Accepted' && res.status === 202) {
          let sendMsgData = null
          if (res.data.media) {
            sendMsgData = {
              from_number: fromNumber,
              to_number: toNumber,
              text: text,
              direction: 'out',
              message_id: res.data.id,
              sender: sender,
              media: res.data.media[0],
            }
          } else {
            sendMsgData = {
              from_number: fromNumber,
              to_number: toNumber,
              text: text,
              direction: 'out',
              message_id: res.data.id,
              sender: sender,
            }
          }

          axios
            .post(`${CONFIG.serverURL}/sendmessage`, {
              sendMsgData,
            })
            .then(res1 => {
              dispatch({ type: CONSTS.GET_ALL_MESSAGES, payload: res1.data })
            })
        }
      })
      .catch(error => {
        console.log(error)
      })
  }
}
export const getMessage = (toNumber, fromNumber) => {
  return async dispatch => {
    if (toNumber && fromNumber) {
      const msgData = {
        fromNumber: fromNumber,
        toNumber: toNumber,
      }
      await axios
        .post(`${CONFIG.serverURL}/getmessages`, {
          msgData,
        })
        .then(res => {
          dispatch({ type: CONSTS.GET_ALL_MESSAGES, payload: res.data })
          dispatch({
            type: CONSTS.SMS_NOTIFICATION,
            payload: { state: false, fromNumber: '' },
          })
        })
    }
  }
}
export const getPrintMessage = (toNumber, fromNumber, startDate, endDate) => {
  return async dispatch => {
    const msgData = {
      fromNumber: fromNumber,
      toNumber: toNumber,
      startDate: startDate,
      endDate: endDate,
    }

    await axios
      .post(`${CONFIG.serverURL}/getprintmessages`, {
        msgData,
      })
      .then(res => {
        dispatch({ type: CONSTS.GET_ALL_MESSAGES, payload: res.data })
      })
  }
}

export const getAllNumbers = (userNumber, email) => {
  return async dispatch => {
    await axios
      .post(`${CONFIG.serverURL}/getnumbers`, {
        userNumber: userNumber,
        email: email,
      })
      .then(res => {
        dispatch({ type: CONSTS.GET_ALL_USERS, payload: res.data })
      })
  }
}
export const saveUserNumber = (userNumber, userEmail) => {
  return async dispatch => {
    await axios
      .post(`${CONFIG.serverURL}/saveusernumber`, {
        phoneNumber: userNumber,
        email: userEmail,
      })
      .then(res => {
        if (res.status === 200) dispatch(getUserData())
      })
  }
}
export const saveStyleMode = (mode, userEmail) => {
  return async dispatch => {
    await axios
      .post(`${CONFIG.serverURL}/savestylemode`, {
        styleMode: mode,
        email: userEmail,
      })
      .then(res => {
        if (res.status === 200) dispatch(getUserData())
      })
  }
}
export const saveEmailAlert = (state, userEmail) => {
  return async dispatch => {
    await axios
      .post(`${CONFIG.serverURL}/savemailalert`, {
        emailAlert: state,
        email: userEmail,
      })
      .then(res => {
        if (res.status === 200) dispatch(getUserData())
      })
  }
}
export const sendContact = data => {
  axios.post(`${CONFIG.serverURL}/sendcontact`, data).then(res => {
    console.log(res)
  })
}

export const setMemberNum = data => {
  return async dispatch => {
    dispatch({ type: CONSTS.SET_MEM_NUMBER, payload: data })
  }
}
export const newMssage = (data, email) => {
  return (dispatch, getState) => {
    const { message } = getState()
    const { mem_number, numbers } = message
    const { savedNumber } = numbers
    if (savedNumber && data.toNumber === savedNumber) {
      dispatch(getAllNumbers(data.toNumber, email))
      const notifiations = { state: true, fromNumber: data.toNumber }
      dispatch({ type: CONSTS.SMS_NOTIFICATION, payload: notifiations })
      dispatch(getUserData())
      setTimeout(() => {
        if (data.fromNumber === mem_number) {
          dispatch(getMessage(data.fromNumber, data.toNumber))
          dispatch(getUserData())
        }
      }, 2000)
    }
  }
}

export const deleteConversation = (toNumber, fromNumber, email) => {
 
  
  return async dispatch => {
    console.log(toNumber, fromNumber, email,' this is delete conversation')
    //if (toNumber!=="" && fromNumber!=="") {
      console.log(toNumber, fromNumber, email,' this is delete conversation')
      const msgData = {
        fromNumber: fromNumber,
        toNumber: toNumber,
      }
     
      await axios
        .post(`${CONFIG.serverURL}/deleteconversation`, {
          msgData,
        })
        .then(res => {
          if (res.status === 200) {
            dispatch(getAllNumbers(fromNumber, email))
            dispatch(getMessage(fromNumber, toNumber))
          }
        })
   // }
  }
}
export const addFavoriteMessage = (fromNumber, toNumber, email) => {
  return async dispatch => {
    if (toNumber && fromNumber) {
      const msgData = {
        fromNumber: fromNumber,
        toNumber: toNumber,
        email: email,
      }
      await axios
        .post(`${CONFIG.serverURL}/addfavorite`, {
          msgData,
        })
        .then(res => {
          if (res.status === 200) {
            dispatch(getAllNumbers(fromNumber, email))
          }
        })
    }
  }
}

export const deleteFavoriteMessage = (fromNumber, toNumber, email) => {
  return async dispatch => {
    if (toNumber && fromNumber) {
      const msgData = {
        fromNumber: fromNumber,
        toNumber: toNumber,
        email: email,
      }
      await axios
        .post(`${CONFIG.serverURL}/deletefavorite`, {
          msgData,
        })
        .then(res => {
          if (res.status === 200) {
            dispatch(getAllNumbers(fromNumber, email))
          }
        })
    }
  }
}
export const addUserLabel = (email, number, label, contactID, fromNumber) => {
  return async dispatch => {
    const msgData = {
      userID: email,
      phoneNumber: number,
      labelName: label,
      contactID: contactID,
    }
    await axios
      .post(`${CONFIG.serverURL}/adduserlabel`, {
        msgData,
      })
      .then(res => {
        if (res.status === 200) {
          dispatch(getAllNumbers(fromNumber, email))
        }
      })
  }
}
export const getCallForward = () => {
  return async dispatch => {
    const account_id = localStorage.getItem('account_id')
    const owner_id = localStorage.getItem('user_id')

    const getCall = `${CONFIG.API_URL}/accounts/${account_id}/users/${owner_id}`
    await axios.get(getCall).then(res => {
      if (res.data)
        dispatch({
          type: CONSTS.GET_CALL_FORWARD,
          payload: res.data.data,
        })
    })
  }
}
export const saveCallForward = updateData => {
  return async (dispatch, getState) => {
    const { call_forward } = getState().message
    call_forward.call_forward = updateData
    const account_id = localStorage.getItem('account_id')
    const owner_id = localStorage.getItem('user_id')
    const getCall = `${CONFIG.API_URL}/accounts/${account_id}/users/${owner_id}`
    await axios.post(getCall, { data: call_forward }).then(res => {
      console.log(res.data)
    })
  }
}
