import 'dart:async';

import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/video_call_page.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/material.dart';
import 'package:audioplayers/audioplayers.dart';
import 'package:flutter_foreground_task/flutter_foreground_task.dart';

import '../dialogs/showFeedbackDialog.dart';
import 'incoming_call_screen.dart';

bool isAvailableToTakeCalls = true;
class CallingApiServices{
  AudioPlayer audioPlayer = AudioPlayer();
  int count = 0;

  Timer? agoraCheckCallingTimer;

  Map? incomingCall;

  /// Initialize this timer in the home page
  /// Before that make sure the service instance is created

  Future pickVideoCall()async{

  }


  Future<Map> startVideoCall({
  required Map request,
    required String apiUrl,
})async{
    return await Webservices.postData(apiUrl: apiUrl, request: request);
  }

  Future endVideoCall()async{

  }

  Future callCostTimer()async{

  }




  Future<void> checkIncomingCalls()async{
    print('Checking Incoming Calls');
   try{
     if(userData==null){
       return;
     }
     var request = {
       "receiver_id":userData!.id
     };
     var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.checkIncomingCall, request: request, showErrorMessage: false);
     if(jsonResponse['status']==1){
       incomingCall = jsonResponse['data'];
       print('the count is $count and incoming call is $incomingCall');
       if(count!=0 && incomingCall == null){
         print('popping------1');
         Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
       }

       if(count==0 && isAvailableToTakeCalls){
         count++;
         // await audioPlayer.setSourceAsset(MyImages.baseAssetUrl + 'calling.mp3');
         print('the audio is about to play');

         // await audioPlayer.play(AssetSource('calling.mp3'),);
         await audioPlayer.play(AssetSource('callertune.mp3'),);
         // audioPlayer.sp
         print('tjjjjj');
         print('the count is set to show dialog ${incomingCall}');
         // if(await FlutterForegroundTask.isAppOnForeground){
         //   FlutterForegroundTask.launchApp(IncomingScreenFromNotificationPage.id);
         // }
         try{
           FlutterForegroundTask.launchApp(IncomingScreenFromNotificationPage.id);
         }catch(e){
           print('Error in catch block 76675 $e');
         }
         showDialog(context: MyGlobalKeys.navigatorKey.currentContext!, builder: (context){
           return WillPopScope(
             onWillPop: ()async=>false,
             child: Dialog(
               insetPadding: EdgeInsets.all(0),
               backgroundColor: MyColors.primaryColor,
               child: IncomingCallScreen(incomingCall: incomingCall!,audioPlayer: audioPlayer,),
             ),
           );
         },

         ).then((value)async{
           await audioPlayer.dispose();
           // await Future.delayed(Duration(seconds: 20));
           count = 0;
           print('the count is set to zero');
         });

         // Future.delayed(Duration(seconds: 40)).then((value){
         //
         // });
         // await audioPlayer.dispose();
         // count = 0;
       }
     }else{
       incomingCall = jsonResponse['data'];
       print('the count is $count and incoming call is ${jsonResponse['data']}');
       if(count!=0 && jsonResponse['data'] == null){
         print('popping------4');
         count = 0;
         Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
       }
     }
     await Future.delayed(Duration(seconds: 4));
     await checkIncomingCalls();
   }catch(e){
     print('Error in catch block $e');
     await checkIncomingCalls();
   }
  }


  // Future<void> initializeTimer()async{
  //   var request = {
  //     "receiver_id":userData!.id
  //   };
  //   agoraCheckCallingTimer = Timer.periodic(Duration(seconds: 5), (timer) async{
  //     var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.checkIncomingCall, request: request, showErrorMessage: false);
  //     if(jsonResponse['status']==1){
  //       incomingCall = jsonResponse['data'];
  //       print('the count is $count and incoming call is $incomingCall');
  //       if(count!=0 && incomingCall == null){
  //         Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
  //       }
  //
  //       if(count==0){
  //         count++;
  //         // await audioPlayer.setSourceAsset(MyImages.baseAssetUrl + 'calling.mp3');
  //         print('the audio is about to play');
  //
  //         await audioPlayer.play(AssetSource('calling.mp3'),);
  //         // audioPlayer.sp
  //         print('tjjjjj');
  //         await showDialog(context: MyGlobalKeys.navigatorKey.currentContext!, builder: (context){
  //           return WillPopScope(
  //             onWillPop: ()async=>false,
  //             child: Dialog(
  //               insetPadding: EdgeInsets.all(0),
  //               backgroundColor: MyColors.primaryColor,
  //               child: Container(
  //                 padding: EdgeInsets.symmetric( vertical: 32),
  //                 child: Column(
  //                   mainAxisAlignment: MainAxisAlignment.center,
  //                   children: [
  //                     CustomCircularImage(imageUrl: incomingCall!['sender']['image']??''),
  //                     vSizedBox,
  //                     SubHeadingText('${incomingCall!['sender']['name']}'),
  //                     Expanded(
  //                       child: vSizedBox,
  //                     ),
  //                     Column(
  //                       children: [
  //                         GestureDetector(
  //                           onTap: ()async{
  //                             await audioPlayer.pause();
  //                             await push(context: context, screen: VideoCallScreen(userId: incomingCall!['sender']['id'], name: incomingCall!['sender']['name'], callingId: incomingCall!['id'],isPickingCall: true,isFollow: incomingCall!['sender']['is_follow']??'1',));
  //                             Navigator.pop(context);
  //                           },
  //                           child: Container(
  //                             padding: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
  //                             decoration: BoxDecoration(
  //                               color: Colors.green,
  //                             ),
  //                             child: Center(
  //                               child: ParagraphText('Accept', color: MyColors.whiteColor,),
  //                             ),
  //                           ),
  //                         ),
  //                         vSizedBox,
  //                         GestureDetector(
  //                           onTap: ()async{
  //                             await audioPlayer.pause();
  //                             var request = {
  //                               // "sender_id": incomingCall!['sender']['id'],
  //                               // "receiver_id":userData!.id,
  //                               "calling_id":  incomingCall!['id'],
  //                             };
  //                             var jsonResponse = await Webservices.postData(apiUrl:ApiUrls.endCall, request: request, );
  //                             Navigator.pop(context);
  //                           },
  //                           child: Container(
  //                             padding: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
  //                             decoration: BoxDecoration(
  //                               color: Colors.red,
  //                             ),
  //                             child: Center(
  //                               child: ParagraphText('Reject', color: MyColors.whiteColor,),
  //                             ),
  //                           ),
  //                         ),
  //                       ],
  //                     )
  //                   ],
  //                 ),
  //               ),
  //             ),
  //           );
  //         },
  //
  //         );
  //         await audioPlayer.dispose();
  //         count = 0;
  //       }
  //     }else{
  //       incomingCall = jsonResponse['data'];
  //       print('the count is $count and incoming call is ${jsonResponse['data']}');
  //       if(count!=0 && jsonResponse['data'] == null){
  //         Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
  //       }
  //     }
  //   });
  // }
}


