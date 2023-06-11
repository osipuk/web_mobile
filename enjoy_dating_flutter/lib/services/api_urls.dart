class ApiUrls{
  static const String baseUrl = 'https://enjoyclubpro.com/Api/';
  // static const String baseUrl = 'http://bluediamondresearch.com/WEB01/Normal_Dating/Api/';
  static const String getUserData = baseUrl + 'get_user_profile';
  static const String addStory = baseUrl + 'addMyStory';
  static const String getGiftsUrl = baseUrl + 'getGiftList';
  static const String sendGifts = baseUrl + 'sendGifts';  //?send_by=22&send_to=1&gift_id=3&coins=12
  static const String updateDeviceToken = baseUrl + 'updateDeviceToken';
  static const String reportUser = baseUrl + 'reportUser'; //?report_by=1&report_to=3 message
  static const String reportReasons = baseUrl + 'reportMessageList';
  static const String agentList = baseUrl + 'agentList';
  static const String editProfile = baseUrl + 'edit_profile';
  static const String participateExtraActivityEarning = baseUrl + 'participateExtraActivityEarning';  //?user_id=29&activity_id=2
  static const String participateDailyActivityEarning = baseUrl + 'participateDailyActivityEarning';//user_id=29&day_number=1
  static const String extraActivityEarnings = baseUrl + 'extraActivityEarnings';//?user_id=29
  static const String everyDayCoinsList = baseUrl + 'everyDayCoinsList'; //?user_id=29
  static const String contact_us = baseUrl + 'contact_us'; //?user_id=29
  static const String searchUser = baseUrl + 'searchUser'; //?user_id=29
  static const String rendomVideo = baseUrl + 'rendomVideo'; //?user_id=29
  static const String converstionRates = baseUrl + 'settingsAdmin'; //?user_id=29
  static const String purchaseCoinsPackages = baseUrl + 'coinList'; //?user_id=29



  static const String startCall = baseUrl + 'startVideoCall';
  static const String pickCall = baseUrl + 'pickVideoCall'; //&calling_id=2&call_type=video_call_manual
  static const String endCall = baseUrl + 'endVideoCall';
  static const String cutCoins = baseUrl + 'CallCost';  //call_id,call_type ( 1 = video call random,
  static const String callHistory = baseUrl + 'CallHistory';
  static const String recentMatchCalls = baseUrl + 'recentMatchCalls';
  static const String recentCalls = baseUrl + 'recentCalls';
  static const String recentMissedCalls = baseUrl + 'recentMissedCalls';

  //2 = video call manual,
  //3 = video call popular)
  static const String checkIncomingCall = baseUrl + 'IncomingCall';
  static const String getChat = baseUrl + 'GetChatDataBetweenUsers';//?sender=1&receiver=4
  static const String getChatList = baseUrl + 'chatList';//?user_id=1&time=12132
  static const String sendMessage = baseUrl + 'sendMessage'; //?sender=1&receiver=29&message_type=text&message=hi
  static const String giftsSent = baseUrl + 'SendGiftByMe'; //?user_id=28
  static const String giftsReceived = baseUrl + 'ReceiveGift'; //?user_id=28
  static const String callHistoryDashBoard = baseUrl + 'callStatics?'; //?user_id=28
  static const String notificationSetting = baseUrl + 'notification_setting?'; //?user_id=28
  static const String withdrawalRequest = baseUrl + 'withdrawalRequest'; //?user_id=28
  static const String purchaseCoin = baseUrl + 'purchaseCoin'; //?user_id=28
  static const String settingsAdmin = baseUrl + 'settingsAdmin'; //?user_id=28
  static const String myWithdrawalHistory = baseUrl + 'myWithdrawalHistory'; //?user_id=28
  static const String termsAndConditions = baseUrl + 'terms'; //?user_id=28
  // static const String getStripeKey = 'https://www.webwiders.in/WEB01/tap/Api/getKey'; //?user_id=28
  // static const String getStripeIntent = 'https://www.webwiders.in/WEB01/tap/Api/CreatePaymentIntent'; //?user_id=28
  static const String getStripeKey = baseUrl + 'getKey';
  static const String getStripeIntent = baseUrl + 'CreatePaymentIntent';
  static const String setupStripeIntent = 'https://www.webwiders.in/WEB01/tap/Api/setupStripeIntent'; //?user_id=28
  static const String getpaymentMethodFromSecretKey = 'https://www.webwiders.in/WEB01/tap/Api/setupStripeIntent'; //?user_id=28
  static const String getServerStatus = baseUrl + 'getServerStatus';
  static const String changeReviewStatus = baseUrl + 'ratePlayStore';
  static const String getCurrentCallStatus = baseUrl + 'callStatus';

  // static const String
}



// {
// "publishable_key": "pk_test_393IAsXCfg8dt9UkOGz13zNy",
// "secret_key": "sk_test_BA5v4UfqqAC5aPhdh675ijTd",
// "status": 1,
// "message": "Success!"
// }
//
// {
// "publishable_key": "pk_test_393IAsXCfg8dt9UkOGz13zNy",
// "secret_key": "sk_test_BA5v4UfqqAC5aPhdh675ijTd",
// "status": 1,
// "message": "Success!"
// }