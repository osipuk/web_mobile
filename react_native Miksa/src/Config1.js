import Firebase from 'firebase';
let config = {
    apiKey: "AIzaSyBLudEoF0JSEt6I4jlWIm4HGzyz9D0gpv0",
    authDomain: "miksa-e71f2.firebaseapp.com",
    databaseURL: "https://miksa-e71f2-default-rtdb.firebaseio.com",
    projectId: "miksa-e71f2",
    storageBucket: "miksa-e71f2.appspot.com",
    messagingSenderId: "403745672953",
    appId: "1:403745672953:web:2e39b14b521db03a0f5c28"
};
let firebase = Firebase.initializeApp(config);
export default firebase
 