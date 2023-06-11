import axios from 'axios'
import * as CONSTS from '../constants/const'
import CONFIG from '../constants/config'
import _ from 'lodash'

export const getallvmboxes = () => {
  return dispatch => {
    let account_id = localStorage.getItem('account_id')
    let user_id = localStorage.getItem('user_id')
    const auth_token = localStorage.getItem('token')
    axios.defaults.headers.common['X-AUTH-TOKEN'] = auth_token

    const voicemails = `${CONFIG.API_URL}/accounts/${account_id}/vmboxes?filter_owner_id=${user_id}`
    axios
      .get(voicemails)
      .then(res => {
        let promises = []
        const vmboxes = res.data.data
        vmboxes.forEach(function(vmbox) {
          let url = `${CONFIG.API_URL}/accounts/${account_id}/vmboxes/${vmbox.id}/messages?paginate=false`
          promises.push(axios.get(url))
        })
        let allmessages = []
        axios.all(promises).then(function(promise) {
          promise.forEach(function(res) {
            let messages = res.data.data
            let newmsgs = messages.filter(message => message.folder === 'new')
            let vmbox_id = res.request.responseURL.split('/')[7]
            let vmbox = _.find(vmboxes, box => box.id === vmbox_id)
            vmbox.newcount = newmsgs ? newmsgs.length : 0
            vmbox.messages = messages.length
            allmessages.push({ vmbox, messages })
          })
          if (vmboxes.length === 0) {
            allmessages.push({
              vmbox: { newcount: 0, messages: 0 },
              messages: [],
            })
          }
          dispatch({ type: CONSTS.GET_ALL_VOICEMAILS, payload: allmessages })
        })
      })
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
