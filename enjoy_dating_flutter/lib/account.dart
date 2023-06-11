import 'dart:async';

import 'package:Enjoy/constants/navigation_functions.dart' as nav;
import 'package:Enjoy/pages/terms_and_conditions.dart';
import 'package:Enjoy/signin.dart';
import 'package:Enjoy/signup.dart';
import 'package:Enjoy/widget/solidBtn.dart';

import 'package:flutter/material.dart';
import 'package:flutter_foreground_task/flutter_foreground_task.dart';

import 'dialogs/afterSignupPopup.dart';
import 'dialogs/showFeedbackDialog.dart';

class AccountPage extends StatefulWidget {
  const AccountPage({Key? key}) : super(key: key);

  @override
  _AccountPageState createState() => _AccountPageState();
}
class ResumeResult {
  dynamic data;
  String? source;
}
class _AccountPageState extends State<AccountPage> with WidgetsBindingObserver{
  void _initForegroundTask() {
    FlutterForegroundTask.init(

      androidNotificationOptions: AndroidNotificationOptions(
        channelId: 'notification_channel_id',
        channelName: 'Foreground Notification',
        channelDescription: 'This notification appears when the foreground service is running.',
        channelImportance: NotificationChannelImportance.LOW,
        priority: NotificationPriority.LOW,
        iconData: const NotificationIconData(
          resType: ResourceType.mipmap,
          resPrefix: ResourcePrefix.ic,
          name: 'launcher',
        ),
        buttons: [
          const NotificationButton(id: 'sendButton', text: 'Send'),
          const NotificationButton(id: 'testButton', text: 'Test'),
        ],
      ),
      iosNotificationOptions: const IOSNotificationOptions(
        showNotification: true,
        playSound: false,
      ),
      foregroundTaskOptions: const ForegroundTaskOptions(
        interval: 5000,
        isOnceEvent: false,
        autoRunOnBoot: true,
        allowWakeLock: true,
        allowWifiLock: true,
      ),
    );
  }


  @override
  void initState() {
    // TODO: implement initState
    _initForegroundTask();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    print('I am heree');
    return Scaffold(
        body: Stack(
      children: [
        SingleChildScrollView(
          child: Container(
            padding: const EdgeInsets.all(16),
            width: MediaQuery.of(context).size.width,
            height: MediaQuery.of(context).size.height,
            decoration: BoxDecoration(
              image: DecorationImage(
                image: AssetImage("assets/account.png"),
                fit: BoxFit.cover,
              ),
            ),
            child: Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Image.asset(
                    'assets/logo.png',
                    width: 115,
                  ),
                  SizedBox(
                    height: 45,
                  ),
                  GestureDetector(
                    onTap: (){

                    },
                    child: Text(
                      'Get Perfect',
                      textAlign: TextAlign.center,
                      style: TextStyle(
                          fontSize: 40,
                          color: Colors.white,
                          fontFamily: 'Nunito',
                          fontWeight: FontWeight.w900),
                    ),
                  ),
                  const Text(
                    'Match Today!',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                        fontSize: 40,
                        color: Colors.white,
                        fontFamily: 'Nunito',
                        fontWeight: FontWeight.w900),
                  ),
                  SizedBox(
                    height: 40,
                  ),
                  SolidBtn(
                    funcTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => const LoginPage()));
                    },
                    BtnText: 'Login',
                    TextColor: Colors.white,
                    BgColorBottom: const Color(0xFE1CDBC1),
                    BgColorTop: Color(0xFE12C7AE),
                    ShadowColor: const Color(0xFE12C7AE),
                  ),
                  const SizedBox(
                    height: 35,
                  ),
                  SolidBtn(
                    funcTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => const SignupPage()));
                    },
                    BtnText: 'Sign up',
                    TextColor: const Color(0xFE1CDBC1),
                    BgColorBottom: Colors.white,
                    BgColorTop: Colors.white,
                    ShadowColor: Colors.white,
                  ),
                  const SizedBox(
                    height: 30,
                  ),
                  // Row(
                  //     children: [
                  //       SizedBox(width: 30,),
                  //       Expanded(
                  //           child: Divider(color: Colors.white.withOpacity(0.5)),
                  //       ),
                  //       SizedBox(width: 12,),
                  //       Text("or", style: TextStyle(color: Colors.white, fontSize: 16),),
                  //       SizedBox(width: 12,),
                  //       Expanded(
                  //           child: Divider(color: Colors.white.withOpacity(0.5),)
                  //       ),
                  //       SizedBox(width: 30,),
                  //     ]
                  // ),
                  SizedBox(
                    height: 30,
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      // GestureDetector(
                      //   onTap: ()=>{},
                      //   child: Image.asset('assets/snapchat.png', width: 50,),
                      // ),
                      // SizedBox(width: 30,),
                      // GestureDetector(
                      //   onTap: ()=>{},
                      //   child: Image.asset('assets/facebook.png', width: 50,),
                      // ),
                      // SizedBox(width: 30,),
                      // GestureDetector(
                      //   onTap: ()=>{},
                      //   child: Image.asset('assets/google.png',  width: 50,),
                      // )
                    ],
                  ),
                  SizedBox(
                    height: 20,
                  ),
                ],
              ),
            ),
          ),
        ),
        Align(
          alignment: Alignment.bottomCenter,
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: GestureDetector(
              onTap: () => {
                nav.push(context: context, screen: TermsAndConditions()),
              },
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Terms and Conditions',
                    style: TextStyle(fontSize: 16, color: Colors.white),
                  )
                ],
              ),
            ),
          ),
        )
      ],
    ));
  }
}
