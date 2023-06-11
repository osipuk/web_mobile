

import 'dart:convert';
import 'dart:developer';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../constants/global_data.dart';
import '../modals/user_modal.dart';
import 'callingServices.dart';
import 'calling_services.dart';
import 'firebase_push_notifications.dart';
// import '../functions/global_push_notification_constants.dart';

Future<void> updateUserDetails(Map details) async{
  SharedPreferences shared_User = await SharedPreferences.getInstance();
  userData=UserModal.fromJson(details);
  String user = jsonEncode(details);
  shared_User.setString('user_details', user);
  try{
    print('updating user details------------------------');
    MyGlobalKeys.navigatorKey.currentState!.setState(() {

    });
    print('user details updated------------------------');
  }catch(e){
    print('Error in catch block 3451 $e');
  }
}

Future<UserModal> getUserDetails() async{
  SharedPreferences shared_User = await SharedPreferences.getInstance();
  String userMap = await shared_User.getString('user_details')!;
  String userS = (userMap==null)?'':userMap;
  // log('this is uer'+userMap!);
  // if(userMap==null){
  //     return 0.toString();
  // }
  // else{
  // userMap;
  //  log('this is one '+userS);
  Map<String , dynamic> user = jsonDecode(userS) as  Map<String, dynamic>;
  // log('this is '+user['user_id']);
  return UserModal.fromJson(user);//.toString();
  // }
}

Future getCurrentUserId() async{
  SharedPreferences shared_User = await SharedPreferences.getInstance();
  String? userMap = await shared_User.getString('user_details');
  String userS = (userMap==null)?'':userMap;
  // log('this is uer'+userMap!);
  // if(userMap==null){
  //     return 0.toString();
  // }
  // else{
  // userMap;
  //  log('this is one '+userS);
  Map<String , dynamic> user = jsonDecode(userS) as  Map<String, dynamic>;
  // log('this is '+user['user_id']);
  return user['id'].toString();//.toString();
  // }
}
void updateUserId(id) async{
  // await FlutterSession().set("user_id", id);
}

Future isUserLoggedIn() async{
  // log("checking 124");
  // // SharedPreferences? sharedUser = null;
  final  sharedUser = await SharedPreferences.getInstance();
  //
  // return false;


  String? user = await sharedUser.getString('user_details');
  log(user.toString());
  // var d = jsonDecode(user);
  if(user==null){
    return false;
  }
  else{
    return true;
    log('user is already logged in '+user);
  }
  // await FlutterSession().get("user_details", details);
}

Future logout() async{
  if(callingApiServices.agoraCheckCallingTimer!=null){
    callingApiServices.agoraCheckCallingTimer!.cancel();
    callingApiServices.agoraCheckCallingTimer = null;
  }
  print('logout-----');

  await Webservices.updateDeviceToken(userId: userData!.id, token: '');
  userData= null;
   new Future.delayed(const Duration(milliseconds: 5),() async{
     SharedPreferences shared_User = await SharedPreferences.getInstance();
     await shared_User.clear();
     return true;
   });
}