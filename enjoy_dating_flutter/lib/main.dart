
import 'dart:convert';

import 'package:Enjoy/account.dart';
import 'package:Enjoy/changepassword.dart';
import 'package:Enjoy/chat.dart';
import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/contactus.dart';
import 'package:Enjoy/match_found.dart';
import 'package:Enjoy/overview.dart';
import 'package:Enjoy/profile_account.dart';
import 'package:Enjoy/profile_ready.dart';
import 'package:Enjoy/reward.dart';
import 'package:Enjoy/search.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/firebase_push_notifications.dart';
import 'package:Enjoy/services/incoming_call_screen.dart';
import 'package:Enjoy/services/new_stripe_services.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/signup.dart';
import 'package:Enjoy/splash.dart';
import 'package:Enjoy/tabs.dart';
import 'package:http/http.dart' as http;
import 'package:Enjoy/widget/withdrawal_history.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';
import 'constants/global_keys.dart';
import 'dart:io';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:firebase_core/firebase_core.dart';

import 'constants/navigation_functions.dart';

void main() async{
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp();
  serverStatus = await Webservices.getServerStatus();
  FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);
  await flutterLocalNotificationsPlugin.initialize(initializationSettings,


  onSelectNotification: (payload)async{
  print('the notification is selected $payload');
  // {booking_id: 8, user_type: 3, user_id: 9, screen: booking}
  if(payload!=null){
  try{
  Map data = jsonDecode(payload);
  if(data['screen']=='booking'){
  // Map bookingInformation = await Webservices.getMap(ApiUrls.getBookingById + '${data['booking_id']}');
  // push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: BookingInformationPage(bookingInformation: bookingInformation));
  }
  else if(data['screen']=='redeem_request'){
    push(context: MyGlobalKeys.navigatorKey.currentContext!, screen: WithdrawalPage());

  }
  }catch(e){
  print('Error in catch block 332 $e');
  }

  }
});
  try{
    http.Response response = await Webservices.getData(ApiUrls.getStripeKey);
    if (response.statusCode == 200) {
      var jsonResponse = jsonDecode(response.body);
      if (jsonResponse['status'] == 1) {
        publishable_key = jsonResponse['publishable_key'];
        secret_key = jsonResponse['secret_key'];
        headersStripe = {
          'Authorization': 'Bearer ${jsonResponse['secret_key']}',
          'Content-Type': 'application/x-www-form-urlencoded',
        };
        print('initializing stripe  -----------123----${publishable_key}');
        //TODO 1:uncomment when stripe issue is resolved
        // Stripe.publishableKey = publishable_key;
      } else {
        print(
            '_________________________________________invalid keys___________________________________________');
      }
    }else{
      print('could not get keys');
    }

  }catch(e){
    print('Eveerryy thing is  not okay');
  }
await flutterLocalNotificationsPlugin
      .resolvePlatformSpecificImplementation<AndroidFlutterLocalNotificationsPlugin>()
      ?.createNotificationChannel(channel);

  await FirebaseMessaging.instance.setForegroundNotificationPresentationOptions(
  alert: true,
  badge: true,
  sound: true,

  );



  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Enjoy',
      debugShowCheckedModeBanner: false,
      navigatorKey: MyGlobalKeys.navigatorKey,
      theme: ThemeData(
        // This is the theme of your application.
        //
        // Try running your application with "flutter run". You'll see the
        // application has a blue toolbar. Then, without quitting the app, try
        // changing the primarySwatch below to Colors.green and then invoke
        // "hot reload" (press "r" in the console where you ran "flutter run",
        // or simply save your changes to "hot reload" in a Flutter IDE).
        // Notice that the counter didn't reset back to zero; the application
        // is not restarted.
        primarySwatch: Colors.blue,
        fontFamily: 'regular',
      ),
      // home: RecordVideoScreen(),
      home: SplashScreenPage(),
      routes: {
        TabsScreen.id: (context)=>TabsScreen(),
        IncomingScreenFromNotificationPage.id: (context)=>IncomingScreenFromNotificationPage(key: MyGlobalKeys.incomingCallPageKey,),

      },
    );
  }
}


