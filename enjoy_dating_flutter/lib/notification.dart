import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

class NotificationPage extends StatefulWidget {
  const NotificationPage({Key? key}) : super(key: key);

  @override
  NotificationPageState createState() => NotificationPageState();
}

class NotificationPageState extends State<NotificationPage> {
  // bool isSwitched = true;
  // var textValue = 'Switch is OFF';

  // bool newFollowers = false;

  // void toggleSwitch(bool value) {
  //
  //   if(isSwitched == false)
  //   {
  //     setState(() {
  //       isSwitched = true;
  //       textValue = 'Switch Button is ON';
  //     });
  //     print('Switch Button is ON');
  //   }
  //   else
  //   {
  //     setState(() {
  //       isSwitched = false;
  //       textValue = 'Switch Button is OFF';
  //     });
  //     print('Switch Button is OFF');
  //   }
  // }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Container(
            decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFE7D44CF),
                    Color(0xFE00B199)
                  ],
                )
            ),
            child: Container(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  AppBar(
                    backgroundColor: Colors.transparent,
                    leading: IconButton(
                      icon: Icon(Icons.arrow_back_ios_new_rounded, color: Colors.white,),
                      onPressed: () => {
                        Navigator.pop(context)
                      },
                    ),
                    title: Text('Notification', style: TextStyle(color: Colors.white, fontSize: 16),),
                    centerTitle: true,
                    shadowColor: Colors.transparent,
                    shape: Border(
                        bottom: BorderSide(
                            color: Colors.white,
                            width: 1
                        )
                    ),
                  ),
                  SizedBox(height: 40,),

                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text('New Followers', style: TextStyle(color: Colors.white, fontSize: 16),),
                            Switch(
                              value: userData!.notificationNewFollowers=='1',
                              onChanged: (val){
                                if(userData!.notificationNewFollowers=='1'){
                                  userData!.notificationNewFollowers='0';
                                }else{
                                  userData!.notificationNewFollowers='1';
                                }
                                setState(() {

                                });
                                var request = {
                                  'user_id': userData!.id,
                                  'new_follower': userData!.notificationNewFollowers
                                };
                                Webservices.getMap(ApiUrls.notificationSetting, request: request,);
                              },
                              activeColor: Color(0xFE1CDBC1)
                            )
                          ],
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text('Direct Message', style: TextStyle(color: Colors.white, fontSize: 16),),
                            Switch(
                                value: userData!.notificationDirectMessage=='1',
                                onChanged: (val){
                                  if(userData!.notificationDirectMessage=='1'){
                                    userData!.notificationDirectMessage='0';
                                  }else{
                                    userData!.notificationDirectMessage='1';
                                  }
                                  setState(() {

                                  });
                                  var request = {
                                    'user_id': userData!.id,
                                    'direct_message': userData!.notificationDirectMessage
                                  };
                                  Webservices.getMap(ApiUrls.notificationSetting, request: request,);
                                },
                                activeColor: Color(0xFE1CDBC1)
                            )
                          ],
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text('Video Calls', style: TextStyle(color: Colors.white, fontSize: 16),),
                            Switch(
                                value: userData!.notificationVideoCalls=='1',
                                onChanged: (val){
                                  if(userData!.notificationVideoCalls=='1'){
                                    userData!.notificationVideoCalls='0';
                                  }else{
                                    userData!.notificationVideoCalls='1';
                                  }
                                  setState(() {

                                  });
                                  var request = {
                                    'user_id': userData!.id,
                                    'video_calls': userData!.notificationVideoCalls,
                                  };
                                  Webservices.getMap(ApiUrls.notificationSetting, request: request,);
                                },
                                activeColor: Color(0xFE1CDBC1)
                            )
                          ],
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text('Add Reminder', style: TextStyle(color: Colors.white, fontSize: 16),),
                            Switch(
                                value: userData!.notificationAddReminders=='1',
                                onChanged: (val){
                                  if(userData!.notificationAddReminders=='1'){
                                    userData!.notificationAddReminders='0';
                                  }else{
                                    userData!.notificationAddReminders='1';
                                  }
                                  setState(() {

                                  });
                                  var request = {
                                    'user_id': userData!.id,
                                    'add_reminder': userData!.notificationAddReminders
                                  };
                                  Webservices.getMap(ApiUrls.notificationSetting, request: request,);
                                },
                                activeColor: Color(0xFE1CDBC1)
                            )
                          ],
                        ),


                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
