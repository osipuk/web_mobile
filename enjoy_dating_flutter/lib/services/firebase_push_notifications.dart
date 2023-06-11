import 'dart:async';
import 'dart:convert';
import 'dart:developer';

import 'package:Enjoy/services/calling_services.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

import '../constants/global_data.dart';
import '../constants/global_keys.dart';
import '../constants/navigation_functions.dart';
import '../tabs.dart';
import '../widget/withdrawal_history.dart';
import 'api_urls.dart';
import 'incoming_call_screen.dart';
import 'webservices.dart';
import 'package:flutter_foreground_task/flutter_foreground_task.dart';
// {receiver: 51, sender: 55, screen: chat_page}
FirebaseMessaging messaging = FirebaseMessaging.instance;
const AndroidNotificationChannel channel = AndroidNotificationChannel('high_importance_channel',  'High Importance Notifications', importance: Importance.high, playSound: true);

final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();
InitializationSettings initializationSettings = InitializationSettings(
  android: AndroidInitializationSettings('@mipmap/ic_launcher'),
  iOS: IOSInitializationSettings(),
);
@pragma('vm:entry-point')
Future<void> firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();
  print('A bg message just showed up :  ${message.messageId}');
  try{
    print('${message.data}');
    if(message.data['screen']=='booking'){
      print('firebase notification is called now callled ');

      try{
        // MyGlobalKeys.navigatorKey.currentState!.setState(() {
        //
        // });
        // Map bookingInformation = await Webservices.getMap(ApiUrls.getBookingById + '${message.data['other']['booking_id']}');
        // push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: BookingInformationPage(bookingInformation: bookingInformation));
      }catch(e){
        print('error in updating notifications count');
      }
    }
    else if(message.data['screen']=='redeem_request'){
      push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: WithdrawalPage());

    }
    else  if(message.data['screen_name']=='incoming_call'){
      print(' i am here......................background ${await FlutterForegroundTask.canDrawOverlays}');
      // {screen_name: incoming_call, receiver_id: 687, calling_id: 154, sender_id: 2}
      print('${message.data}');
      // if (!await FlutterForegroundTask.canDrawOverlays) {
      //   final isGranted =
      //   await FlutterForegroundTask.openSystemAlertWindowSettings();
      //   if (!isGranted) {
      //     print('SYSTEM_ALERT_WINDOW permission denied!');
      //     showSnackbar('text: ${isGranted}');
      //   }else{
      //     FlutterForegroundTask.launchApp(IncomingScreenFromNotificationPage.id);
      //   }
      // }
      // FlutterForegroundTask.launchApp(IncomingScreenFromNotificationPage.id);

      ///
      // Webservices.postData(apiUrl: ApiUrls.checkIncomingCall, request: request, showErrorMessage: false).then((jsonResponse){
      //   if(jsonResponse['status']==1){
      //     CallingApiServices callingApiServices = CallingApiServices();
      //     callingApiServices.checkIncomingCalls();
      //     FlutterForegroundTask.launchApp(IncomingScreenFromNotificationPage.id);
      //     Future.delayed(Duration(seconds: 4)).then((value){
      //       try{
      //         print('incoming call page processing .............1');
      //         MyGlobalKeys.incomingCallPageKey.currentState!.incomingCallData = jsonResponse['data'];
      //         print('incoming call page processing .............2');
      //         MyGlobalKeys.incomingCallPageKey.currentState!.setState(() {
      //
      //         });
      //       }catch(e){
      //         print('Error in catch block 3456 $e');
      //       }
      //     });
      //   }
      //
      // });

    }
  }catch(e){
    print('Error in catch block 37896 $e');
  }
}

@pragma('vm:entry-point')
class FirebasePushNotifications{




  //   WidgetsFlutterBinding.ensureInitialized();
  //   await Firebase.initializeApp();
  // FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);
  // await flutterLocalNotificationsPlugin
  //     .resolvePlatformSpecificImplementation<AndroidFlutterLocalNotificationsPlugin>()
  //     ?.createNotificationChannel(channel);
  //
  // await FirebaseMessaging.instance.setForegroundNotificationPresentationOptions(
  // alert: true,
  // badge: true,
  // sound: true,
  // );
  ///step 1: Add this to main

  // WidgetsFlutterBinding.ensureInitialized();
  // await Firebase.initializeApp();
  // FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);
//   await flutterLocalNotificationsPlugin.initialize(initializationSettings,
//   onSelectNotification: (payload)async{
//   print('the notification is selected $payload');
//   // {booking_id: 8, user_type: 3, user_id: 9, screen: booking}
//   if(payload!=null){
//   try{
//   Map data = jsonDecode(payload);
//   if(data['screen']=='booking'){
//   Map bookingInformation = await Webservices.getMap(ApiUrls.getBookingById + '${data['booking_id']}');
//   push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: BookingInformationPage(bookingInformation: bookingInformation));
//   }
//   }catch(e){
//   print('Error in catch block 332 $e');
//   }
//
//   }
// }
// await flutterLocalNotificationsPlugin
  //     .resolvePlatformSpecificImplementation<AndroidFlutterLocalNotificationsPlugin>()
  //     ?.createNotificationChannel(channel);
  //
  // await FirebaseMessaging.instance.setForegroundNotificationPresentationOptions(
  // alert: true,
  // badge: true,
  // sound: true,
  //
  // );
  // await FirebasePushNotifications.firebaseSetup();
  /// step 2:
  ///Create certificate Key from here
  /// https://console.firebase.google.com/project/cycle-up-338208/settings/cloudmessaging

  /// step 3 :
  /// get permission
  /// step 4 :
  /// get token and then store it to database, so that we can send notification to that specific
  /// android token.

  static const String webPushCertificateKey = 'BPE6NfMirgOcbGrnJJ-NvlXwMpRnWm_Df0UNwLSxFXshKgAUNF-HjNmbgye_knKsbZxmTEOQz6w10Mm9TVcibO4';
  /// this token is used to send notification // use the returned token to send messages to users from your custom server
  static String? token;



  static Future<NotificationSettings> getPermission()async{
    NotificationSettings settings = await messaging.requestPermission(
      alert: true,
      announcement: false,
      badge: true,
      carPlay: false,
      criticalAlert: false,
      provisional: false,
      sound: true,
    );
    print('User granted permission: ${settings.authorizationStatus}');
    return settings;
  }


  static Future<String?> getToken()async{
    try{
      token = await messaging.getToken(vapidKey: webPushCertificateKey);
      return token;
    }catch(e){
      print('Error in catch block 57894 $e');
    }
  }


  static Future<void> firebaseSetup()async {
    // FirebaseMessaging.onBackgroundMessage((message)async{
    //   print)
    // })
    FirebaseMessaging.onMessage.listen((RemoteMessage message)async {
      print('firebase messaging is being listened');
      try{
        RemoteNotification? notification = message.notification;
        var data = message.data;

        // log('notidata+--'+data.toString());
        AndroidNotification? android = message.notification?.android;
        log('this is notification bb bb ---  ');
        print('___________${notification.toString()}');
        print('________________');
        print(message.data);
        print('________________');
        if (notification != null && android != null) {
          if(message.data['screen']=='booking'){

            //
            // try{
            //   push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: IndexPage(selectedIndex: 2,));
            // }catch(e){
            //   print('error in updating notifications count');
            // }
          }else if(message.data['screen_name']=='incoming_call'){
            print(' i am here......................');
            // CallingApiServices callingApiServices = CallingApiServices();
            // callingApiServices.checkIncomingCalls();
            // FlutterForegroundTask.launchApp(TabsScreen.id);
          }
          // }else if(message.data['screen']=='tour_request_accepted'){
          //   int count = int.parse(tourRequestCount);
          //   count++;
          //   newAcceptedToursCount = count.toString();
          //
          //   try{
          //     MyGLobalKeys.navigatorKey.currentState!.setState(() {
          //
          //     });
          //   }catch(e){
          //     print('error in updating notifications count');
          //   }
          // }

          // FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin = flutterLocalNotificationsPlugin;
          await flutterLocalNotificationsPlugin.show(
              notification.hashCode,
              // null,
              notification.title,
              notification.body,

              NotificationDetails(
                android: AndroidNotificationDetails(
                  channel.id,
                  channel.name,
                  color: Colors.blue,
                  playSound: true,
                  icon: '@mipmap/ic_launcher',
                ),
              ),
              payload:jsonEncode(data)
          );
          print('the payLoad is $data');
        }
      }catch(e){
        print('error in listening notifications $e');
      }
    });

    FirebaseMessaging.onMessageOpenedApp.listen((RemoteMessage message) async{
      print('A new onMessageOpenedApp event was published!');
      print(message.data);
      RemoteNotification? notification = message.notification;
      AndroidNotification? android = message.notification?.android;
      String title = "";
      log('this is notification aa aa ---  ');

      if(notification!=null){
        title = notification.title.toString();
      }
      if (notification != null && android != null) {
        log('this is notification ---  ');

        try{
          BuildContext context = MyGlobalKeys.navigatorKey.currentContext!;
          // {booking_id: 6, user_type: 3, user_id: 9, screen: booking}
          if(message.data['screen']=='booking'){
            // Map bookingInformation = await Webservices.getMap(ApiUrls.getBookingById + message.data['booking_id']);
            // push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: BookingInformationPage(bookingInformation: bookingInformation));
            // push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: BookingInformationPage(bookingInformation: bookingInformation));
          }

          else{
        print('Some other screen');
        print(message.data);
      }
        }catch(e){
          print('Error in Inside catch block $e');
        }

      }
    });

    FirebaseMessaging.instance.getToken().then((value)async{
      if(value!=null){

        print('the device token is $value');
        if(userData!=null) {
          await Webservices.updateDeviceToken(
              userId: userData!.id, token: value);
        }else{
          print('device token not updated');
        }
      }

      // log("token-------"+value.toString());
    });

  }



}