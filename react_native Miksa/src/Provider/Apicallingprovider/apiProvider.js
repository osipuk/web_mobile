import NetInfo from '@react-native-community/netinfo';

class ApiContainer {
  getApi = async (url,loding_status=0) => {
    return new Promise((resolve, reject) => {
      NetInfo.fetch().then(state => {
        if (state.isConnected == true) {
          if(loding_status==0){
            global.props.showLoader();
          }
          fetch(url, {
            method: 'GET',
            headers: {
              'Cache-Control': 'no-cache, no-store, must-revalidate',
              'Pragma': 'no-cache',
              'Expires': 0,
               Accept: 'application/json',
              'Content-Type': 'multipart/form-data'
             },
           }).then((response) => response.json())
            .then((obj) => {
              console.log('i am line no 20')
              if(loding_status==0){
                global.props.hideLoader();
              }
              console.log('i am line no 22')
              resolve(obj);
            })
            .catch((error) => {
              console.log('i am line no 26')
              if(loding_status==0){
                global.props.hideLoader();
              }
              reject(error);
            });
        }else {
          if(loding_status==0){
            global.props.hideLoader();
          }
          reject('noNetwork');
        }
      })
    })
  }

  getNoLodingApi = async (url) => {
    return new Promise((resolve, reject) => {
      NetInfo.fetch().then(state => {
        if (state.isConnected == true) {
          fetch(url, {
            method: 'GET',
            headers: {
              'Cache-Control': 'no-cache, no-store, must-revalidate',
              'Pragma': 'no-cache',
              'Expires': 0,
               Accept: 'application/json',
              'Content-Type': 'multipart/form-data'
             },
           }).then((response) => response.json())
            .then((obj) => {
              resolve(obj);
            })
            .catch((error) => {
              reject(error);
            });
        }else {
          reject('noNetwork');
        }
      })
    })
  }

  postApi = async (url,data) => {
    return new Promise((resolve, reject) => {
      NetInfo.fetch().then(state => {
        if (state.isConnected == true) {
          global.props.showLoader();
          fetch(url, {
            method: 'POST',
            headers: {
              'Cache-Control': 'no-cache, no-store, must-revalidate',
              'Pragma': 'no-cache',
              'Expires': 0,
               Accept: 'application/json',
              'Content-Type': 'multipart/form-data'
             },
             body:data
           }).then((response) => response.json())
            .then((obj) => {
              global.props.hideLoader();
              resolve(obj);
            })
            .catch((error) => {
              global.props.hideLoader();
              reject(error);
            });
        }else {
          global.props.hideLoader();
          reject('noNetwork');
        }
      })
    })
  }

  postNoLoadingApi = async (url,data) => {
    return new Promise((resolve, reject) => {
      NetInfo.fetch().then(state => {
        if (state.isConnected == true) {
          fetch(url, {
            method: 'POST',
            headers: {
              'Cache-Control': 'no-cache, no-store, must-revalidate',
              'Pragma': 'no-cache',
              'Expires': 0,
               Accept: 'application/json',
              'Content-Type': 'multipart/form-data'
             },
             body:data
           }).then((response) => response.json())
            .then((obj) => {
              resolve(obj);
            })
            .catch((error) => {
              reject(error);
            });
        }else {
          reject('noNetwork');
        }
      })
    })
  }
}

//--------------------------- Config Provider End -----------------------
export const apifuntion = new ApiContainer();
