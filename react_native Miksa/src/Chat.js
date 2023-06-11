import React from 'react';
import Colors from './Colors'
import { Text, View, Image, Platform, Modal, Alert, StyleSheet, FlatList, TextInput, StatusBar, KeyboardAvoidingView, Dimensions, TouchableOpacity, SafeAreaView, Keyboard, BackHandler } from 'react-native'
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, notification, mobileH } from './Provider/utilslib/Utils';
import Icon from 'react-native-vector-icons/AntDesign'
import firebase from './Config1';
import Firebase from 'firebase';
import color1 from './Colors'
import styles1 from './Style'
import ImageZoom from 'react-native-image-pan-zoom';
import ImagePicker from 'react-native-image-picker';
import { firebaseprovider } from './Provider/FirebaseProvider';
import OneSignal from 'react-native-onesignal';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view'
const BannerHieght = Dimensions.get('window').height;
const BannerWidth = Dimensions.get('window').width;
global.userChatIdGlobal = '';
global.blockinbox = 'no';
global.messagedata = []
const windowWidth = Dimensions.get('window').width;
const windowHeighht = Dimensions.get('window').height;
export default class Chat extends React.Component {
  _didFocusSubscription;
  _willBlurSubscription;
  constructor(props) {
    super(props)
    this.state = {
      modalVisible: false,
      optionmsg: '',
      data1: [],
      user_id: '',
      chatmsg: '',
      other_user_name: '',
      data: this.props.route.params.chatdata,
      name: '',
      message_type: 'text',
      filePath: {},
      messages: [],
      isVisible: false,
      modalVisible: false,
      fileData: '',
      fileUri: '',
      user_image: '',
      imgBlob: '',
      isConnected: true,
      loading: false,
      behavior: 'position',
      bottom: 5,
      onlinestatus: false,
      image_path: '',
      imageModal: false,
      user_type: 0
    }
    this._didFocusSubscription = props.navigation.addListener('focus', payload =>
      BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
    );
    OneSignal.init(config.onesignalappid, {
      kOSSettingsKeyAutoPrompt: true,
    });
    OneSignal.setLogLevel(6, 0);

    this.show_user_message_chat = this.show_user_message_chat.bind(this);
  }




  componentDidMount() {
    this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
      BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
    );
    this.getmessagedata()
  }



  handleBackPress = async () => {
    let result = await localStorage.getItemObject('user_arr');
    var user_id_me = result.user_id
    this.chatRoomIdUpdate(user_id_me, 'no');
    this.props.navigation.goBack()
    return true;
  };

  async goBack() {
    let result = await localStorage.getItemObject('user_arr');
    var user_id_me = result.user_id
    this.chatRoomIdUpdate(user_id_me, 'no');
    this.props.navigation.goBack()
    return true;
  }



  getmessagedata = async () => {
    var userdata = await localStorage.getItemObject('user_arr');
    consolepro.consolelog('getmessagedata')

    this.setState({ user_id: userdata.user_id, })
    var other_user_id = this.state.data.other_user_id
    var user_id_me = userdata.user_id
    this.chatRoomIdUpdate(user_id_me, other_user_id);


    var data = this.state.data
    consolepro.consolelog('data', data)
    var other_user_id = data.other_user_id
    // var item_id = data.item_id;
    consolepro.consolelog('other_user_id', other_user_id);
    // consolepro.consolelog('item_id',item_id);
    consolepro.consolelog('firebaseprovider86', FirebaseUserJson)
    var inbox_count = FirebaseUserJson.findIndex(x => x.user_id == other_user_id);
    consolepro.consolelog("chat name inbox count before", inbox_count);
    if (inbox_count >= 0) {
      consolepro.consolelog("chat name inbox count", inbox_count);
      var jsonData = FirebaseUserJson[inbox_count];
      consolepro.consolelog('jsonData', jsonData);
      if (jsonData.name != 'NA') {

        this.setState({ name: jsonData.name, onlinestatus: jsonData.onlineStatus })
        // alert(jsonData.onlineStatus)
        // if (userProvider.getMe().user_type == 'user') {
        //   $('#chat_name').attr("onclick","redirectChefProfile("+other_user_id+")");
        // }
      } else {
        this.setState({ name: 'Chat' })
      }

    } else {
      this.setState({ name: 'Chat' })
    }
    this.show_user_message_chat()
  }
  sendmessagebtn = async () => {
    consolepro.consolelog('sendmessagebtn')

    let messageType = 'text';
    let message = this.state.chatmsg
    consolepro.consolelog('message', message)
    this.chatmsg.clear();
    this.setState({ chatmsg: '' })
    if (message.length <= 0) {
      alert(Languageprovider.massege_validation[language_key])
      return false
    }
    this.sendmessagecallbtn(messageType, message)
  }
  sendmessagecallbtn = async (messageType, message) => {
    let userdata = await localStorage.getItemObject('user_arr')

    let data1 = this.state.data
    //  jhkfhjkhsdk
    var user_id = userdata.user_id
    var other_user_id = data1.other_user_id
    //  var item_id = data1.item_id;
    var chat_type = 'Item_chat';

    var user_id_send = 'u_' + user_id;
    var other_user_id_send = 'u_' + other_user_id;

    var inbox_id_me = 'u_' + other_user_id;
    var inbox_id_other = 'u_' + user_id;
    consolepro.consolelog('inbox_id', inbox_id_me)
    consolepro.consolelog('inbox_id_other', inbox_id_other)

    //---------------------- this code for create inbox in first time -----------
    consolepro.consolelog('FirebaseInboxJsonChck', FirebaseInboxJson);
    console.log('other_user_id', other_user_id)


    if (FirebaseUserJson.length > 0) {
      var find_inbox_index2 = FirebaseUserJson.findIndex(x => x.user_id == other_user_id);
      console.log('find_inbox_index', find_inbox_index2)

      if (find_inbox_index2 != -1) {
        if ('myInbox' in FirebaseUserJson[find_inbox_index2]) {
          let myinbox2 = FirebaseUserJson[find_inbox_index2].myInbox
          if (myinbox2 != undefined) {
            //  myinbox=myinbox.findIndex(x => x.user_id == other_user_id)
            console.log('myinbox2', myinbox2)
            if (inbox_id_other in myinbox2) {
              let myinboxdata = myinbox2[inbox_id_other]

              console.log('inbox_id_me', inbox_id_me)
              console.log('inbox_id_other', inbox_id_other)
              blockinbox = myinboxdata.block_status

            }
          }
        }
      }
    }
    var find_inbox_index = FirebaseInboxJson.findIndex(x => x.user_id == other_user_id);
    consolepro.consolelog('find_inbox_index chat', find_inbox_index);
    consolepro.consolelog('other_user_id chat', other_user_id);
    if (find_inbox_index == -1) {

      var jsonUserDataMe = {
        count: 0,
        lastMessageType: "",
        lastMsg: "",
        user_id: other_user_id,
        typing_status: 'no',
        block_status: 'no',
        lastMsgTime: Firebase.database.ServerValue.TIMESTAMP,
      };

      var jsonUserDataother = {
        count: 0,
        lastMessageType: "",
        lastMsg: "",
        user_id: user_id,
        typing_status: 'no',
        block_status: 'no',
        lastMsgTime: Firebase.database.ServerValue.TIMESTAMP,

      };

      firebaseprovider.UpdateUserInboxMe(user_id_send, inbox_id_me, jsonUserDataMe);
      if (blockinbox == 'no') {
        firebaseprovider.UpdateUserInboxOther(other_user_id_send, inbox_id_other, jsonUserDataother);
      }

      //  consolepro.consolelog('FirebaseUserJson',FirebaseUserJson);
    }
    //---------------------- this code for create inbox in first time end -----------

    //---------------------- this code for send message to both -----------
    var messageIdME = 'u_' + user_id + '__u_' + other_user_id;
    var messageIdOther = 'u_' + other_user_id + '__u_' + user_id;
    var senderId = user_id;
    var inputId = 'xyz'
    // var timestamp = new Date().getTime();
    var messageJson = {
      message: message,
      messageType: messageType,
      senderId: senderId,
      timestamp: Firebase.database.ServerValue.TIMESTAMP
    }

    this.chatmsg.clear();

    firebaseprovider.SendUserMessage(messageIdME, messageJson, messageType, inputId);
    if (this.state.data.blockstatus == 'no') {
      if (blockinbox == 'no') {
        firebaseprovider.SendUserMessage(messageIdOther, messageJson, messageType, inputId);
      }

    }
    //---------------------- this code for send message to both end -----------


    //----------------update user inbox----------------------------
    var jsonUserDataMe = {
      count: 0,
      lastMessageType: messageType,
      lastMsg: message,
      lastMsgTime: Firebase.database.ServerValue.TIMESTAMP
    };

    firebaseprovider.UpdateUserInboxMe(user_id_send, inbox_id_me, jsonUserDataMe);

    var user_id_me = userdata.user_id
    var chat_room_id = other_user_id;
    this.chatRoomIdUpdate(user_id_me, chat_room_id);

    //------------------------- get other user inbox -------------------

    consolepro.consolelog('other_user_id_send', other_user_id_send);
    consolepro.consolelog('user_id_send', user_id_send);
    var count_new = 0;
    var query = firebase.database().ref('users/' + other_user_id_send + '/myInbox/' + inbox_id_other);
    query.once('value', (data) => {
      consolepro.consolelog("chat_data", data.toJSON());
      // consolepro.consolelog('user inbox data',data.val().count);
      var count_old = data.val() == null ? 0 : data.val().count;
      consolepro.consolelog('count_old_check', count_old);
      count_new = parseInt(count_old) + 1;

      var jsonUserDataOther = {
        count: count_new,
        lastMessageType: messageType,
        lastMsg: message,
        lastMsgTime: Firebase.database.ServerValue.TIMESTAMP
      };
      // alert("dddd");      
      // consolepro.consolelog('jsonUserDataOther',jsonUserDataOther);
      if (blockinbox == 'no') {
        firebaseprovider.UpdateUserInboxOther(other_user_id_send, inbox_id_other, jsonUserDataOther);
      }

    })
    //---------------------- send message notifications ----------------
    var title = 'Miksa';
    var message_send = message;
    var SenderName = userdata.name;
    if (messageType != 'text' && messageType != 'location') {
      message_send = SenderName + ' sent: ' + messageType;
    } else {
      message_send = SenderName + ' ' + message_send;
    }

    var other_user_id = chat_room_id;
    consolepro.consolelog('other_user_id_noti', other_user_id);
    var message_noti = message_send;
    var action_json = {
      user_id: user_id_me,
      other_user_id: other_user_id,
      chat_type: chat_type,

      action_id: 0,
      action: 'chat_single',
      // action_id : user_id_me,
      SenderName: SenderName,
    };
    // alert(user_id_me);  
    this.sendNotificationSignle(title, message_noti, action_json, other_user_id);
    //---------------------- send message notifications end----------------

  }
  sendNotificationSignle = async (title, message, action_json, user_id_member) => {
    let userdata = await localStorage.getItemObject('user_arr')
    consolepro.consolelog('sendNotificationSignle action_json', action_json);
    consolepro.consolelog('sendNotificationSignle message', message);
    consolepro.consolelog('sendNotificationSignle user_id_member', user_id_member);

    consolepro.consolelog('update delete_flag', user_id_member);
    consolepro.consolelog("sendNotificationSignle FirebaseUserJson", FirebaseUserJson);
    var other_user_index = FirebaseUserJson.findIndex(x => x.user_id == user_id_member);
    consolepro.consolelog("other_user_index subuser", other_user_index);
    if (other_user_index >= 0) {
      consolepro.consolelog('FirebaseUserJson subuser', FirebaseUserJson[other_user_index]);
      var player_id_get = FirebaseUserJson[other_user_index].player_id;
      var other_user_chat_room_id = FirebaseUserJson[other_user_index].chat_room_id;
      var notification_status = FirebaseUserJson[other_user_index].notification_status;
      user_id_me = userdata.user_id;
      consolepro.consolelog('other_user_chat_room_id', other_user_chat_room_id + '//' + user_id_me);
      consolepro.consolelog('player_id_get', user_id_member + '//' + player_id_get);
      consolepro.consolelog('notification_status', notification_status);

      if (notification_status == 1) {
        var user_id_me = userdata.user_id;
        consolepro.consolelog('other_user_chat_room_id', other_user_chat_room_id + '!=' + user_id_me);
        if (other_user_chat_room_id != user_id_me) {
          if (player_id_get != 'no' && player_id_get != '123456') {
            var player_id_arr = [];
            player_id_arr.push(player_id_get);
            consolepro.consolelog('player_id_arr', player_id_arr);

            if (player_id_arr.length > 0) {
              consolepro.consolelog('vikas slonakfsdsend notihd');
              notification.oneSignalNotificationSendCalls(message, action_json, player_id_get, title)
            }
          }
        }
      }
    }
  }
  chatRoomIdUpdate = (user_id, other_user_id) => {

    consolepro.consolelog('chatRoomIdUpdate user_id', user_id);
    consolepro.consolelog('chatRoomIdUpdate other_user_id', other_user_id);
    var id = 'u_' + user_id;
    var jsonUserDataMe = {
      chat_room_id: other_user_id,
    };
    firebaseprovider.CreateUser(id, jsonUserDataMe);
  }
  myInboxCountZeroChat = () => {
    consolepro.consolelog('myInboxCountZeroChat');
    var data = this.state.data
    var user_id = this.state.user_id
    var other_user_id = data.other_user_id
    var user_id_send = 'u_' + user_id;
    var other_user_id_send = 'u_' + other_user_id;

    var jsonUserDataOther = {
      count: 0,
      user_id: other_user_id,
    };
    firebaseprovider.UpdateUserInboxOther(user_id_send, other_user_id_send, jsonUserDataOther);
  }

  show_user_message_chat = () => {

    //  var messagedata=[]
    var other_user_id = this.state.data.other_user_id
    var find_inbox_index = FirebaseInboxJson.findIndex(x => x.user_id == other_user_id);
    consolepro.consolelog('find_inbox_index chatshow_user_message_chat', find_inbox_index);
    consolepro.consolelog('other_user_id chatshow_user_message_chat', other_user_id);
    if (find_inbox_index >= 0) {
      consolepro.consolelog('inboxfinguser')
      this.myInboxCountZeroChat()
    }

    consolepro.consolelog('show_user_message');

    // var userdata= await localStorage.getItemObject('user_arr');
    var data = this.state.data
    var user_id = this.state.user_id
    var other_user_id = data.other_user_id
    // var item_id = data.item_id;
    var chat_type = 'Item_chat';

    var userChatId = 'u_' + user_id + '__u_' + other_user_id
    if (userChatIdGlobal == '') {
      userChatIdGlobal = userChatId;
    }
    consolepro.consolelog('userChatIdGlobal', userChatIdGlobal);
    var queryOff = firebase.database().ref('message/').child(userChatIdGlobal);
    queryOff.off('child_added');
    queryOff.off('child_changed');
    // alert('userChatId======'+userChatId);
    var image_index_me = 0;
    var image_index_other = 0;
    userChatIdGlobal = userChatId;
    var query = firebase.database().ref('message/' + userChatId).orderByChild("timestamp");
    query.on('child_added', (data) => {
      consolepro.consolelog('message child_added chat all data', data.toJSON());
      // LoadingEnd();

      var msgKey = data.key;
      var message = data.val().message;
      var messageType = data.val().messageType;
      var senderId = data.val().senderId;
      var timestamp = data.val().timestamp;
      var lastMsgTime = firebaseprovider.convertTimeAllFormat(timestamp, 'date_time_full');
      var messageDataShow = '';
      consolepro.consolelog('senderId', senderId);
      consolepro.consolelog('user_id', user_id);

      if (senderId == user_id) {
        consolepro.consolelog('senderId', senderId);

        if (messageType == 'text') {

          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJoson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })
        } else if (messageType == 'location') {
          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJoson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })
        }
        else if (messageType == 'image') {
          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJoson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })

        }
      } else {
        if (messageType == 'text') {
          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })

        }
        else if (messageType == 'location') {
          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })
        }
        else if (messageType == 'image') {
          var messageJson = {
            'name': message,
            'userid': senderId,
            'messageType': messageType,
            'time': lastMsgTime
          }
          consolepro.consolelog('messageJoson', messageJson)
          let data6 = this.state.data1
          data6.push(messageJson)
          this.setState({ data1: data6 })

        }
      }
      consolepro.consolelog('this.state.data1', this.state.data1)
    });

    // for(let i=0; i<messagedata.length; i++)
    // {
    //   messagedata[i]=messagedata[(messagedata.length-1)-i];
    // }

    consolepro.consolelog('enndshowfunction')
  }


  // componentWillMount() {
  //   this.setState({
  //     messages: [
  //       {
  //           _id: 2,
  //           text: 'My message',
  //           createdAt: new Date(Date.UTC(2016, 5, 11, 17, 20, 0)),
  //           avatar: 'https://homepages.cae.wisc.edu/~ece533/images/airplane.png',

  //           user: {
  //             _id: 2,
  //             name: 'React Native',
  //            avatar: 'https://homepages.cae.wisc.edu/~ece533/images/airplane.png',
  //           },

  //         }
  //     ],
  //   })
  // }


  onSend(messages = []) {
    this.setState(previousState => ({
      messages: GiftedChat.append(previousState.messages, messages),
    }))
  }
  handlePickImage = () => {
    consolepro.consolelog('fjslkfldsjlas')
  }
  renderBubble = (props) => {
    return (
      <Bubble
        {...props}
        textStyle={{
          right: {
            color: 'white',
          },

        }}
        wrapperStyle={{
          right: {
            backgroundColor: Colorss.theme1,
          },
          left: {
            backgroundColor: '#d6d6d6',
          },
        }}
      />
    );
  }
  renderActions = (props) => {
    return (
      <TouchableOpacity onPress={() => { this.goBack() }} style={{ width: '10%', alignItems: 'center', justifyContent: 'center' }}>
        <Image style={{ width: 34, height: 34, resizeMode: 'contain', marginLeft: 9, marginBottom: 9 }} source={require('./icons/user_error.png')}></Image>
      </TouchableOpacity>
    )
  }
  senduserreport = async () => {
    let userdata = await localStorage.getItemObject('user_arr')
    consolepro.consolelog('userdata', userdata)
    let user_id = userdata.user_id
    let data = this.state.data
    var other_user_id = data.other_user_id
    var url = config.baseURL + 'chat_report_submit.php?user_id=' + user_id + '&other_user_id=' + other_user_id + '&report_type=chat';
    consolepro.consolelog('url', url)


    apifuntion.getApi(url).then((obj) => {
      this.setState({ modalVisible: false })
      consolepro.consolelog('boys home data', obj);
      if (obj.success == 'true') {
        msgProvider.alert('', obj.msg[config.language], false);
      } else {
        if (obj.account_active_status == "deactivate") {
          config.checkUserDeactivate(this.props.navigation);
          return false;
        }
        msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
        return false;
      }
    }).catch(err => {
      if (err == "noNetwork") {
        msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
      } else {
        msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
      }
      console.log('err', err);
    });

  }
  clearchatbtn = () => {
    Alert.alert(
      'Are you sure you want to clear chat ?',  // message
      '',
      [
        { text: 'No', onPress: () => consolepro.consolelog('Cancel Pressed'), style: 'cancel' },
        { text: 'Yes', onPress: () => { this.ClearChatConfirm() }, style: 'destructive' },
      ],
      { cancelable: false }
    )
  }
  ClearChatConfirm = async () => {
    this.setState({ modalVisible: false })
    let userdata = await localStorage.getItemObject('user_arr')
    consolepro.consolelog('userdata', userdata)
    let data = this.state.data
    var user_id = userdata.user_id
    var other_user_id = data.other_user_id
    // var item_id = data.item_id;
    var chat_type = 'Item_chat';

    var messageIdME = 'u_' + user_id + '__u_' + other_user_id;
    var id = 'u_' + user_id;
    var otherid = 'u_' + other_user_id;
    let jsonUsesadsssfrData = {};

    firebase.database().ref().child('message' + '/' + messageIdME + '/').remove();
    // messagedata=[] 
    this.setState({ data1: [], modalVisible: false })
    let jsonUserData = {};


    var jsonUserDataMe = {
      count: 0,
      lastMessageType: "",
      lastMsg: "",
      lastMsgTime: "",
      user_id: other_user_id,
    };
    var user_id_send = 'u_' + user_id;
    var other_user_id_send = 'u_' + other_user_id;
    var inbox_id_me = 'u_' + other_user_id;

    firebaseprovider.UpdateUserInboxMe(user_id_send, inbox_id_me, jsonUserDataMe);
    firebaseprovider.getMyInboxAllData();

  }
  btnOpneImageOption = (index) => {
    const options = {
      title: Lang_chg.privacypolicy[config.language],
      takePhotoButtonTitle: Lang_chg.takephot[config.language],
      chooseFromLibraryButtonTitle: Lang_chg.chooselib[config.language],
      cancelButtonTitle: Lang_chg.cancel[config.language],
      storageOptions: {
        skipBackup: true,
        path: 'images',
      },
      maxWidth: 1000,
      maxHeight: 1000,
      quality: 0.8
    };

    ImagePicker.showImagePicker(options, (response) => {
      consolepro.consolelog('Response = ', response);

      if (response.didCancel) {
        consolepro.consolelog('User cancelled image picker');
      } else if (response.error) {
        consolepro.consolelog('ImagePicker Error: ', response.error);
      } else if (response.customButton) {
        consolepro.consolelog('User tapped custom button: ', response.customButton);
      } else {


        this.setState({
          filePath: response,
          fileData: response.data,
          fileUri: response.uri,
          imagedata: true,
          camraon: true,
          loading: true,
          profileimagehide: true,
          openDate: false
        });
        let user_id = this.state.user_id
        consolepro.consolelog('this.state.fileUri', response.uri)
        var url = config.baseURL + 'chat_file_upload.php';
        var data2 = new FormData();

        data2.append('user_id', user_id)
        data2.append('file_type', 'image')
        data2.append('image', {
          uri: response.uri,
          type: 'image/jpg', // or photo.type
          name: 'image.jpg'
        });
        consolepro.consolelog('url', url)
        consolepro.consolelog('data', data2)
        // this.setState({loading:true,})

        apifuntion.postApi(url, data2).then((obj) => {
          consolepro.consolelog('boys home data', obj);
          if (obj.success == 'true') {
            this.sendmessagecallbtn('image', obj.file)
          } else {
            if (obj.account_active_status == "deactivate") {
              config.checkUserDeactivate(this.props.navigation);
              return false;
            }
            msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
            return false;
          }
        }).catch(err => {
          if (err == "noNetwork") {
            msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
          } else {
            msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
          }
          console.log('err', err);
        });
      }
    });

  }

  permmissionsendreport = () => {
    Alert.alert(
      //This is title
      Lang_chg.Confirm[config.language],
      //This is body text
      Lang_chg.reportmessagepopup[config.language],
      [
        { text: Lang_chg.Yes[config.language], onPress: () => this.senduserreport() },
        { text: Lang_chg.No[config.language], onPress: () => consolepro.consolelog('No Pressed'), style: 'cancel' },
      ],
      { cancelable: false }
      //on clicking out side, Alert will not dismiss
    );
  }

  permmissionclearchat = () => {
    Alert.alert(
      //This is title
      Lang_chg.Confirm[config.language],
      //This is body text
      Lang_chg.chatclearpopup[config.language],
      [
        { text: Lang_chg.Yes[config.language], onPress: () => this.ClearChatConfirm() },
        { text: Lang_chg.No[config.language], onPress: () => consolepro.consolelog('No Pressed'), style: 'cancel' },
      ],
      { cancelable: false }
      //on clicking out side, Alert will not dismiss
    );
  }
  render() {
    consolepro.consolelog('this.state.data.other_user_name', this.state.data)
    if (Platform.OS === 'ios') {

      return (
        <KeyboardAvoidingView style={styles.container} behavior='padding'>
          <View activeOpacity={1} style={styles.container}>

            <StatusBar
              hidden={false}
              backgroundColor={color1.theme_color}
              translucent={false}
              networkActivityIndicatorVisible={true}
            />
            <Modal
              animationType="slide"
              transparent={true}
              visible={this.state.modalVisible}
              onRequestClose={() => { this.setState({ modalVisible: false }) }}
            >
              <TouchableOpacity
                style={{ flex: 1 }}
                activeOpacity={1}
                onPressOut={() => { this.setState({ modalVisible: false }) }}
              >
                <View style={{ backgroundColor: '#f5f4f2', height: 'auto', position: 'absolute', bottom: 0, left: 0, right: 0 }}>
                  <View style={{ paddingTop: 15, paddingHorizontal: 20 }}>
                    <Text style={{ paddingVertical: 10, fontSize: 15.5, fontFamily: "Poppins-Bold", textAlign: 'flex-start' }}>{Lang_chg.chataction[config.language]}</Text>
                    <TouchableOpacity onPress={() => { this.permmissionsendreport() }}>
                      <Text style={{ color: 'black', fontSize: 15, fontFamily: "Poppins-Regular" }}>{Lang_chg.chatreport[config.language]}</Text>
                    </TouchableOpacity>
                    <TouchableOpacity style={{ paddingVertical: 16 }} onPress={() => { this.permmissionclearchat() }}>
                      <Text style={{ color: 'black', fontFamily: "Poppins-Regular", fontSize: 14 }}>{Lang_chg.chatclear[config.language]}</Text>
                    </TouchableOpacity>
                    <TouchableOpacity style={{ paddingBottom: 15 }} onPress={() => { this.setState({ modalVisible: false }) }}>
                      <Text style={{ color: color1.theme_color, fontSize: 15, fontFamily: "Poppins-Regular" }}>{Lang_chg.chatcancel[config.language]}</Text>
                    </TouchableOpacity>
                  </View>
                </View>
              </TouchableOpacity>
            </Modal>

            <Modal animationType="slide" transparent visible={this.state.imageModal}
              onRequestClose={() => {
                this.setState({ imageModal: false })
              }}>
              <View style={{ flex: 1 }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: color1.theme_color }} />

                <StatusBar barStyle='light-content' backgroundColor={color1.theme_color} hidden={false} translucent={false}
                  networkActivityIndicatorVisible={true} />



                <View style={{ flexDirection: "row", height: mobileH * 0.071, backgroundColor: '#0088e0', paddingHorizontal: 10 }}>
                  <View style={{ flex: 1, justifyContent: "center" }}>
                    <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                      onPress={() => { this.setState({ imageModal: false }) }}
                    >
                      <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                        source={require('./icons/back2.png')}
                        resizeMode="contain"
                      />
                    </TouchableOpacity>
                  </View>
                  <View style={{ flex: 2, justifyContent: "center", }}>
                    <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold", color: '#fff' }}></Text>
                  </View>
                  <View style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }}>

                  </View>
                </View>




                <View style={{ flex: 1, backgroundColor: 'white' }}>
                  <ImageZoom style={{ justifyContent: "center", alignItems: 'center' }} cropWidth={Dimensions.get('window').width}
                    cropHeight={windowHeighht * 0.95}
                    imageWidth={windowWidth * 0.92}
                    imageHeight={windowWidth * 0.92}>
                    <Image style={{ width: windowWidth * 0.92, height: windowWidth * 0.92 }}
                      source={{ uri: this.state.image_path }} resizeMode="contain" />
                  </ImageZoom>
                </View>
              </View>
            </Modal>
            <View style={{ flexDirection: "row", height: mobileH * 0.071, backgroundColor: '#0088e0', paddingHorizontal: 10 }}>
              <View style={{ flex: 2, justifyContent: "flex-start", flexDirection: "row", alignItems: "center" }}>
                <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                  onPress={() => this.goBack()}
                >
                  <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                    source={require('./icons/back2.png')}
                    resizeMode="contain"
                  />
                </TouchableOpacity>

                {this.state.data.image == undefined ?
                  <Image source={require('./icons/user_error.png')} style={styles.user_img} resizeMode="cover" /> :
                  this.state.data.image == 'NA' ?
                    <Image source={require('./icons/user_error.png')} style={styles.user_img} resizeMode="cover" /> :
                    this.state.data.image == null ?
                      <Image source={require('./icons/user_error.png')} style={styles.user_img} /> :
                      <Image source={{ uri: config.img_url1 + this.state.data.image }} style={styles.user_img} resizeMode="cover" />
                }

                <View style={{ flexDirection: 'column', justifyContent: 'flex-start' }}>
                  <Text style={{ marginLeft: 10, fontFamily: "Poppins-Bold", color: "#fff" }}>{this.state.data.other_user_name}</Text>
                  {/* <Text style={{ marginLeft: 10, fontFamily: "Poppins-Bold", color: "#fff", fontSize: 12, marginTop: -4 }}>{(this.state.onlinestatus==true) ? 'Online' : 'Offline'}</Text> */}
                </View>
              </View>
              <View style={{ flex: 0, justifyContent: "center", }}>
                <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold" }}> </Text>
              </View>





              <TouchableOpacity style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }} onPressOut={() => { this.setState({ modalVisible: true }) }}>
                <Image style={{ width: 20, height: 20, marginRight: 10, tintColor: '#fff', }}
                  source={require('./icons/three_dots.png')}
                  resizeMode="contain"
                />
              </TouchableOpacity>
            </View>



            <View style={{ paddingBottom: 130, width: '95%', paddingTop: 10, alignSelf: 'center' }}>
              <FlatList
                data={this.state.data1}
                showsVerticalScrollIndicator={false}
                ref={ref => (this.FlatListRef = ref)} // assign the flatlist's ref to your component's FlatListRef...
                onContentSizeChange={() => this.FlatListRef.scrollToEnd()} // scroll it
                contentContainerStyle={{ marginBottom: 200 }}
                keyboardDismissMode='interactive'
                keyboardShouldPersistTaps='always'
                renderItem={({ item, index }) => {
                  return (
                    <View style={{ width: '95%', alignSelf: 'center', paddingVertical: 7, }}>
                      {item.userid != this.state.user_id && <View style={{ alignSelf: 'flex-start', width: '70%' }}>
                        <View style={{ backgroundColor: '#d7d7d7', paddingVertical: 1.5, paddingHorizontal: 8, alignSelf: 'flex-start', borderTopStartRadius: 6, borderTopEndRadius: 6, borderBottomLeftRadius: 6 }}>
                          {item.messageType == 'text' && <Text style={{ fontSize: 14, fontFamily: "Poppins-Bold", color: 'black' }}>{item.name}</Text>}
                          {item.messageType == 'image' && <TouchableOpacity onPress={() => { (item.name != null) ? this.setState({ image_path: config.img_url2 + item.name, imageModal: true }) : null }}>
                            <Image source={{ uri: config.img_url2 + item.name }} style={{ width: BannerWidth * 42 / 100, height: BannerHieght * 30 / 100, borderRadius: 5, backgroundColor: '#0088e0' }} />
                          </TouchableOpacity>}
                          <Text style={{ fontSize: 14, fontFamily: "Poppins-Regular", color: 'gray' }}>{item.time}</Text>
                        </View>
                      </View>}
                      {item.userid == this.state.user_id && <View style={{ width: '70%', alignSelf: 'flex-end', }}>
                        <View style={{ backgroundColor: '#0088e0', borderTopStartRadius: 6, borderTopEndRadius: 6, borderBottomLeftRadius: 6, paddingVertical: 1.5, paddingHorizontal: 8, alignSelf: 'flex-end' }}>
                          {item.messageType == 'text' && <Text style={{ fontSize: 14, fontFamily: "Poppins-Regular", color: '#FFFFFF' }}>{item.name}</Text>}
                          {item.messageType == 'image' && <TouchableOpacity onPress={() => { (item.name != null) ? this.setState({ image_path: config.img_url2 + item.name, imageModal: true }) : null }}>
                            <Image source={{ uri: config.img_url2 + item.name }} style={{ width: BannerWidth * 42 / 100, height: BannerHieght * 30 / 100, borderRadius: 5, backgroundColor: '#fff' }} />
                          </TouchableOpacity>}
                          <Text style={{ fontSize: 14, fontFamily: "Popins-Medium", color: '#FFFFFF' }}>{item.time}</Text>
                        </View>
                      </View>}
                    </View>
                  )
                }}
              />

            </View>

            <View style={{ position: 'absolute', borderTopWidth: 0.6, bottom: Platform.OS === 'ios' ? this.state.bottom : 10, left: 0, right: 0, borderTopColor: '#FFFFFF', paddingVertical: 7.5, backgroundColor: "#e3e3e3" }}>
              {this.state.data.blockstatus != 'no' &&
                <TouchableOpacity onPress={() => { null }}>
                  <View style={{ alignSelf: 'center', paddingVertical: 10 }}>
                    <Text style={{ color: color1.theme_color, fontSize: 15, textAlign: 'center', textAlignVertical: 'center' }}>you blocked this user.tap to unblock</Text>
                  </View>
                </TouchableOpacity>
              }
              {(this.state.data.blockstatus == 'no') && <View style={{ paddingHorizontal: 20, width: '100%', alignSelf: 'center', flexDirection: 'row', justifyContent: 'space-between', marginBottom: 10 }}>

                <View style={{ flexDirection: 'row', width: '100%', }}>
                  <TouchableOpacity style={{ height: 30, width: '10%', alignSelf: 'center' }} onPress={() => { this.btnOpneImageOption() }}>
                    {/* <Icon name='camera' size={20} color={Colors.buttoncolor} style={{alignSelf:'center'}}/> */}
                    <Image source={require('./icons/camera.png')} style={{ width: 25, height: 25, resizeMode: 'contain', tintColor: color1.theme_color }} />
                  </TouchableOpacity>

                  <TextInput
                    placeholder={Lang_chg.chattextinputmessage[config.language]}
                    placeholderTextColor={color1.theme_color}
                    ref={(input) => { this.chatmsg = input; }}
                    onChangeText={(txt) => { this.setState({ chatmsg: txt }) }}
                    keyboardType="default"
                    onFocus={() => { this.setState({ Numberbtn: 1, bottom: 43 }); }}
                    blurOnSubmit={true}
                    scrollEnabled={true}
                    onSubmitEditing={() => { this.setState({ bottom: 0 }) }}
                    style={{ width: '77%', paddingRight: 7, fontFamily: "Poppins-Regular", paddingVertical: 8, color: 'black' }}
                  />
                  {this.state.chatmsg.length > 0 && <TouchableOpacity style={{ width: '13%', alignSelf: 'center', alignItems: 'flex-end' }} onPress={() => { this.sendmessagebtn() }}>
                    <Image source={require('./icons/send.png')} style={{ width: 25, height: 15, resizeMode: 'contain' }} />
                  </TouchableOpacity>}

                  {this.state.chatmsg.length <= 0 && <TouchableOpacity style={{ width: '13%', alignSelf: 'center' }}>


                  </TouchableOpacity>}
                </View>

                {/* <TouchableOpacity style={{height:30,width:'10%',alignSelf:'center',paddingTop:4,}} onPress={()=>{this.btnOpneImageOption()}}>
            <Icon name='camera' size={20} color={Colors.buttoncolor} style={{alignSelf:'center'}}/>
            
        </TouchableOpacity> */}
              </View>}

            </View>
          </View
          >
        </KeyboardAvoidingView>

      )
    }
    else {
      return (
        // <KeyboardAvoidingView style={styles.container} behavior='padding'>


        <View style={styles.container}>

          <StatusBar
            hidden={false}
            backgroundColor={color1.theme_color}
            translucent={false}
            networkActivityIndicatorVisible={true}
          />
          <Modal
            animationType="slide"
            transparent={true}
            visible={this.state.modalVisible}
            onRequestClose={() => { this.setState({ modalVisible: false }) }}
          >
            <TouchableOpacity
              style={{ flex: 1 }}
              activeOpacity={1}
              onPressOut={() => { this.setState({ modalVisible: false }) }}
            >
              <View style={{ backgroundColor: '#f5f4f2', height: 'auto', position: 'absolute', bottom: 0, left: 0, right: 0 }}>
                <View style={{ paddingTop: 15, paddingHorizontal: 20 }}>
                  <Text style={{ paddingVertical: 10, fontSize: 16, fontFamily: "Poppins-Bold" }}>{Lang_chg.chataction[config.language]}</Text>
                  <TouchableOpacity onPress={() => { this.permmissionsendreport() }}>
                    <Text style={{ color: 'black', fontSize: 15, fontFamily: "Poppins-Regular" }}>{Lang_chg.chatreport[config.language]}</Text>
                  </TouchableOpacity>
                  <TouchableOpacity style={{ paddingVertical: 16 }} onPress={() => { this.permmissionclearchat() }}>
                    <Text style={{ color: 'black', fontFamily: "Poppins-Regular", fontSize: 14 }}>{Lang_chg.chatclear[config.language]}</Text>
                  </TouchableOpacity>

                  <TouchableOpacity style={{ paddingBottom: 15 }} onPress={() => { this.setState({ modalVisible: false }) }}>
                    <Text style={{ color: 'red', fontSize: 15, fontFamily: "Poppins-Regular" }}>{Lang_chg.chatcancel[config.language]}</Text>
                  </TouchableOpacity>
                </View>

              </View>

            </TouchableOpacity>
          </Modal>


          <Modal animationType="slide" transparent visible={this.state.imageModal}
            onRequestClose={() => {
              this.setState({ imageModal: false })
            }}>
            <View style={{ flex: 1 }}>
              <SafeAreaView style={{ flex: 0, backgroundColor: color1.theme_color }} />

              <StatusBar barStyle='light-content' backgroundColor={color1.theme_color} hidden={false} translucent={false}
                networkActivityIndicatorVisible={true} />



              <View style={{ flexDirection: "row", height: mobileH * 0.071, backgroundColor: '#0088e0', paddingHorizontal: 10 }}>
                <View style={{ flex: 1, justifyContent: "center" }}>
                  <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                    onPress={() => { this.setState({ imageModal: false }) }}
                  >
                    <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                      source={require('./icons/back2.png')}
                      resizeMode="contain"
                    />
                  </TouchableOpacity>
                </View>
                <View style={{ flex: 2, justifyContent: "center", }}>
                  <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold", color: '#fff' }}></Text>
                </View>
                <View style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }}>

                </View>
              </View>




              <View style={{ flex: 1, backgroundColor: 'white' }}>
                <ImageZoom style={{ justifyContent: "center", alignItems: 'center' }} cropWidth={Dimensions.get('window').width}
                  cropHeight={windowHeighht * 0.95}
                  imageWidth={windowWidth * 0.92}
                  imageHeight={windowWidth * 0.92}>
                  <Image style={{ width: windowWidth * 0.92, height: windowWidth * 0.92 }}
                    source={{ uri: this.state.image_path }} resizeMode="contain" />
                </ImageZoom>
              </View>
            </View>
          </Modal>

          <View style={{ flexDirection: "row", height: mobileH * 0.071, backgroundColor: '#0088e0', paddingHorizontal: 10 }}>
            <View style={{ flex: 2, justifyContent: "flex-start", flexDirection: "row", alignItems: "center" }}>
              <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                onPress={() => this.goBack()}
              >
                <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                  source={require('./icons/back2.png')}
                  resizeMode="contain"
                />
              </TouchableOpacity>

              {this.state.data.image == undefined ?
                <Image source={require('./icons/user_error.png')} style={styles.user_img} resizeMode="cover" /> :
                this.state.data.image == 'NA' ?
                  <Image source={require('./icons/user_error.png')} style={styles.user_img} resizeMode="cover" /> :
                  this.state.data.image == null ?
                    <Image source={require('./icons/user_error.png')} style={styles.user_img} /> :
                    <Image source={{ uri: config.img_url1 + this.state.data.image }} style={styles.user_img} resizeMode="cover" />

              }
              <View style={{ flexDirection: 'column', justifyContent: 'flex-start' }}>
                <Text style={{ marginLeft: 10, fontFamily: "Poppins-Bold", color: "#fff" }}>{this.state.data.other_user_name}</Text>
                {/* <Text style={{ marginLeft: 10, fontFamily: "Poppins-Bold", color: "#fff", fontSize: 12, marginTop: -4 }}>{(this.state.onlinestatus==true) ? 'Online' : 'Offline'}</Text> */}
              </View>

            </View>
            <View style={{ flex: 0, justifyContent: "center", }}>
              <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold" }}></Text>
            </View>
            <TouchableOpacity style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }} onPressOut={() => { this.setState({ modalVisible: true }) }}>
              <Image style={{ width: 20, height: 20, marginRight: 10, tintColor: '#fff' }}
                source={require('./icons/three_dots.png')}
                resizeMode="contain"
              />
            </TouchableOpacity>
          </View>
          <View style={{ paddingBottom: 130, width: '95%', alignSelf: 'center', paddingTop: 10 }}>
            <FlatList
              data={this.state.data1}
              showsVerticalScrollIndicator={false}
              ref={ref => (this.FlatListRef = ref)} // assign the flatlist's ref to your component's FlatListRef...
              onContentSizeChange={() => this.FlatListRef.scrollToEnd()} // scroll it
              contentContainerStyle={{ marginBottom: 200 }}
              keyboardDismissMode='interactive'
              keyboardShouldPersistTaps='always'

              renderItem={({ item, index }) => {
                return (
                  <View style={{ width: '97%', alignSelf: 'center', paddingVertical: 7 }}>
                    {item.userid != this.state.user_id && <View style={{ alignSelf: 'flex-start', width: '70%' }}>
                      <View style={{ backgroundColor: "#e7d3f5", paddingVertical: 1.5, paddingHorizontal: 8, alignSelf: 'flex-start', borderTopStartRadius: 6, borderTopEndRadius: 6, borderBottomLeftRadius: 6 }}>
                        {item.messageType == 'text' && <Text style={{ fontSize: 14, fontFamily: "Poppins-Bold", color: 'black' }}>{item.name}</Text>}
                        {item.messageType == 'image' && <TouchableOpacity activeOpacity={0.9} onPress={() => { (item.name != null) ? this.setState({ image_path: config.img_url2 + item.name, imageModal: true }) : null }}>
                          <Image source={{ uri: config.img_url2 + item.name }} style={{ width: BannerWidth * 42 / 100, height: BannerHieght * 30 / 100, borderRadius: 5, backgroundColor: '#fff' }} />
                        </TouchableOpacity>}
                        <Text style={{ fontSize: 14, fontFamily: "Poppins-Regular", color: 'gray' }}>{item.time}</Text>
                      </View>
                    </View>}

                    {item.userid == this.state.user_id && <View style={{ width: '70%', alignSelf: 'flex-end', alignItems: 'flex-end', }}>
                      <View style={{ backgroundColor: color1.theme_color, borderTopStartRadius: 6, borderTopEndRadius: 6, borderBottomLeftRadius: 6, paddingVertical: 1.5, paddingHorizontal: 8, alignSelf: 'flex-end' }}>
                        {item.messageType == 'text' && <Text style={{ fontSize: 14, fontFamily: "Poppins-Regular", color: '#FFFFFF' }}>{item.name}</Text>}
                        {item.messageType == 'image' && <TouchableOpacity activeOpacity={0.9} onPress={() => { (item.name != null) ? this.setState({ image_path: config.img_url2 + item.name, imageModal: true }) : null }}>
                          <Image source={{ uri: config.img_url2 + item.name }} style={{ width: BannerWidth * 42 / 100, height: BannerHieght * 30 / 100, borderRadius: 5, backgroundColor: '#fff' }} />
                        </TouchableOpacity>}
                        <Text style={{ fontSize: 14, fontFamily: "Popins-Medium", color: '#FFFFFF' }}>{item.time}</Text>
                      </View>

                    </View>}
                  </View>
                )
              }}
            />
          </View>
          <View style={{ position: 'absolute', borderTopWidth: 0.6, bottom: Platform.OS === 'ios' ? this.state.bottom : 0, left: 0, right: 0, borderTopColor: '#FFFFFF', backgroundColor: '#e3e3e3', paddingVertical: 7.5 }}>
            {this.state.data.blockstatus != 'no' &&
              <TouchableOpacity onPress={() => { this.props.navigation.navigate('Blockuser') }}>
                <View style={{ alignSelf: 'center', paddingVertical: 10 }}>
                  <Text style={{ color: color1.theme_color, fontSize: 15, textAlign: 'center', textAlignVertical: 'center' }}>you blocked this user.tap to unblock</Text>
                </View>
              </TouchableOpacity>
            }
            {(this.state.data.blockstatus == 'no') && <View style={{ paddingHorizontal: 20, width: '100%', alignSelf: 'center', flexDirection: 'row', backgroundColor: '#e3e3e3', justifyContent: 'space-between' }}>

              <View style={{ flexDirection: 'row', width: '100%' }}>
                <TouchableOpacity style={{ height: 30, width: '10%', alignSelf: 'center' }} onPress={() => { this.btnOpneImageOption() }}>
                  {/* <Icon name='camera' size={20} color={Colors.buttoncolor} style={{alignSelf:'center'}}/> */}
                  <Image source={require('./icons/camera.png')} style={{ width: 25, height: 25, resizeMode: 'contain', tintColor: color1.theme_color }} />
                </TouchableOpacity>

                <TextInput
                  placeholder={Lang_chg.chattextinputmessage[config.language]}
                  placeholderTextColor={color1.theme_color}
                  ref={(input) => { this.chatmsg = input; }}
                  onChangeText={(txt) => { this.setState({ chatmsg: txt }) }}
                  keyboardType="default"
                  onFocus={() => { this.setState({ Numberbtn: 1, bottom: 43 }); }}
                  blurOnSubmit={true}
                  scrollEnabled={true}
                  onSubmitEditing={() => { this.setState({ bottom: 0 }) }}
                  style={{ width: '77%', paddingRight: 6, fontFamily: "Poppins-Regular", paddingVertical: 8, color: 'black' }}
                />
                {this.state.chatmsg.length > 0 && <TouchableOpacity style={{ width: '13%', alignSelf: 'center', alignItems: 'flex-end' }} onPress={() => { this.sendmessagebtn() }}>
                  <Image source={require('./icons/send.png')} style={{ width: 25, height: 15, resizeMode: 'contain' }} />

                </TouchableOpacity>}

                {this.state.chatmsg.length <= 0 && <TouchableOpacity style={{ width: '13%', alignSelf: 'center' }}>
                </TouchableOpacity>}
              </View>
            </View>}
          </View>
        </View>
        // </KeyboardAvoidingView>
      )
    }

  }
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF'
  },
  button: {
    backgroundColor: color1.theme_color,
    width: '90%',
    borderRadius: 8,
    paddingVertical: 8.5,
    marginTop: 7,
    marginTop: 10,
    alignSelf: 'center',
    alignItems: 'center'
  },
  user_img: {
    height: 30,
    width: 30,
    borderRadius: 15,
    marginLeft: 10
  }
})