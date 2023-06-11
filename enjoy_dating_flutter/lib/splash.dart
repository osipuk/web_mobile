
// import 'package:exchange/constants/global_data.dart';
// import 'package:exchange/constants/image_urls.dart';
// import 'package:exchange/pages/login.dart';
// import 'package:exchange/pages/tab.dart';
// import 'package:exchange/services/auth.dart';
import 'dart:async';

import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/firebase_push_notifications.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/tabs.dart';
import 'package:Enjoy/upload.dart';
import 'package:Enjoy/welcome.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_foreground_task/flutter_foreground_task.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'constants/global_data.dart';
import 'constants/navigation_functions.dart';

// import '../functions/global_push_notification_constants.dart';

class SplashScreenPage extends StatefulWidget {
  static const String id="splash";
  const SplashScreenPage({Key? key}) : super(key: key);

  @override
  State<SplashScreenPage> createState() => _SplashScreenPageState();
}

class _SplashScreenPageState extends State<SplashScreenPage>  with WidgetsBindingObserver{
  AppLifecycleState? _notification;
  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    print('the app has changed the lifecycle state from ${_notification?.name} to .... ${state.name}');
    setState(() {
      _notification = state;
    });
  }



  // initializeApplifecycleLisner()async{
  //   Timer.periodic(Duration(seconds: 4), (timer) {
  //     print('the app lifecycle state is ${_notification?.name}');
  //   });
  // }

  getReportReasons()async{
    reportReasonsList = await Webservices.getList(ApiUrls.reportReasons);
    await getAgentList();
    await getGifts();
    check_session();
  }
  getAgentList()async{
    agentList = await Webservices.getList(ApiUrls.agentList);
  }
  @override
  void initState() {
    // initializeApplifecycleLisner();
    getReportReasons();
    // getGifts();

    super.initState();
  }


  getGifts()async{
    sharedPreferences =await  SharedPreferences.getInstance();
    giftsList = await Webservices.getList(ApiUrls.getGiftsUrl);
  }


  check_session() async{
    print('check session-----');
    if (!await FlutterForegroundTask.canDrawOverlays) {
      final isGranted =
      await FlutterForegroundTask.openSystemAlertWindowSettings();

    }
    var is_session=await isUserLoggedIn();
    if(is_session==true){


      userData=await getUserDetails();
      await FirebasePushNotifications.firebaseSetup();
      print('user-data----$userData');
      if(userData!.galleryImages.length!=0){
        // tabs_second_page
        Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(
                builder: (context) => TabsScreen()),
                (Route<dynamic> route) => false);
      } else {
        Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(
                builder: (context) => UploadPicPage()),
                (Route<dynamic> route) => false);
        // pushReplacement(context: context, screen: UploadPicPage());
      }
      // FirebasePushNotifications.update_device_token(true);
      // Navigator.of(context).pushAndRemoveUntil(
      //     MaterialPageRoute(
      //         builder: (context) => TabsPage()),
      //         (Route<dynamic> route) => false);
    } else {
      // Navigator.pushNamed(context, LoginPage.id);
      Navigator.of(context).pushAndRemoveUntil(
          MaterialPageRoute(
              builder: (context) => WelcomeScreen()),
              (Route<dynamic> route) => false);
    }
  }

  Widget build(BuildContext context) {
    return  Scaffold(
      backgroundColor: Colors.white,
      body: new Image(
        image: AssetImage('assets/splash.png'),
        fit: BoxFit.cover,
        height: double.infinity,
        width: double.infinity,
        alignment: Alignment.center,
      ),
    );
    // return Container(
    //   child: Image.asset(
    //     'assets/splash.png',
    //     height: MediaQuery.of(context).size.height,
    //     width: MediaQuery.of(context).size.width,
    //     fit: BoxFit.cover,
    //   ),
    // );
  }
}


// import 'package:flutter/material.dart';
//
// class splashScreen extends StatefulWidget {
//   const splashScreen({Key? key}) : super(key: key);
//
//   @override
//   _splashScreenState createState() => _splashScreenState();
// }
//
// class _splashScreenState extends State<splashScreen> {
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       body: new Image(
//         image: AssetImage('assets/splash.png'),
//         fit: BoxFit.cover,
//         height: double.infinity,
//         width: double.infinity,
//         alignment: Alignment.center,
//       ),
//     );
//   }
// }
