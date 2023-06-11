import 'dart:async';
import 'dart:convert';
import 'dart:developer';
import 'dart:typed_data';

import 'package:audioplayers/audioplayers.dart';
import 'package:Enjoy/BottomSheets/purchase_coins_inside_video_call.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_functions.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/pages/DialerScreen.dart';
import 'package:Enjoy/pages/videoCallAnimationPage.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/custom_text_field.dart';
import 'package:Enjoy/widget/show_custom_modal_sheet.dart';
import 'package:flutter/material.dart';

import 'package:permission_handler/permission_handler.dart';
import 'package:agora_rtc_engine/rtc_engine.dart';
import 'package:agora_rtc_engine/rtc_engine.dart' as abc;
import 'package:agora_rtc_engine/rtc_local_view.dart' as RtcLocalView;
import 'package:agora_rtc_engine/rtc_remote_view.dart' as RtcRemoteView;

import '../constants/global_data.dart';
import '../constants/global_keys.dart';
import '../widget/CustomTexts.dart';
import '../widget/Customeloader.dart';
import '../widget/custom_circular_image.dart';
import '../widget/round_edged_button.dart';
import '../widget/showSnackbar.dart';
import 'alert.dart';
import 'api_urls.dart';
import 'auth.dart';
import 'calling_services.dart';
import 'common_functions.dart';
import 'localServices.dart';
import 'package:wakelock/wakelock.dart';
// const token =
//     '006ddbba166ad844f609413dedd53a01253IABcwDPCbMCU2TcOTpZinGUDvJ73Z/9BmfC63ymHhh5b11Aq764AAAAAEACXhJCZnnmtYgEAAQCfea1i';

class VideoCallScreen extends StatefulWidget {
  final String userId;
  final String name;
  final bool isPickingCall;
  String isFollow;
  String? callingId;

  final String image;
  final String age;
  // static const String id = 'video_call_screen';
  VideoCallScreen(
      {Key? key,
      required this.userId,
      required this.name,
      this.isPickingCall = false,
      this.callingId,
      required this.age,
      required this.image,
      required this.isFollow})
      : super(key: key);

  @override
  State<VideoCallScreen> createState() => _VideoCallScreenState();
}

class _VideoCallScreenState extends State<VideoCallScreen>
    with TickerProviderStateMixin {
  static const String appId = '19b5c3689459408683d08b11e477c40c';
  // static const String appId = '19b5c3689459408683d08b11e477c40c';
  AudioPlayer audioPlayer = AudioPlayer();
  int? _remoteUid;
  bool? isSpeakerEnabled;
  bool isBackCameraEnabled = true;
  bool isAudioEnabled = true;
  bool isVideoEnabled = false;
  double iconSizeOfVideoCallButtons = 38;
  String bookingId = '';
  TextEditingController messageController = TextEditingController();

  Timer? videoCallTimer;
  int coinsOfMaleUserBeforeCallStart = 0;
  int callCostPerMinute = 0;
  int seconds = 0;
  List purchaseCoinsPackagesList = [];
  Timer? getCallStatusTimer;
  getpurchaseCoinsPackagesList() async {

    purchaseCoinsPackagesList = await Webservices.getList(ApiUrls.purchaseCoinsPackages, );


  }

  bool isPurchaseCoinsDialogOpen = false;
  showPurchaseCoinsDialog() async {
    isPurchaseCoinsDialogOpen = true;
    if(purchaseCoinsPackagesList.length!=0){
     String? coinsAdded =  await showCustomBottomSheet(
        context,
        height: 350,
        child: PurchaseCoinsBottomSheet(purchaseData: purchaseCoinsPackagesList[0],counter: (60-(seconds%60)),),
        margin: EdgeInsets.symmetric(horizontal: 8, vertical: 8),
        padding: EdgeInsets.symmetric(horizontal: 0,vertical: 0),
      );
     if(coinsAdded!=null){
       coinsOfMaleUserBeforeCallStart +=int.parse(coinsAdded);
     }
    }

    isPurchaseCoinsDialogOpen = false;
  }

  List<VideoCallMessageModal> messages = [];
  ScrollController messageScrollController = ScrollController();

  // int? streamId;
  RtcEngine? _engine;

  bool isLayoutPositionChanged = false;
  bool showSmallContainer = true;
  double widgetsOpacity = 1;

  bool load = false;
  String? token;
  String channelName = '';
  Timer? cointsKatneKaTimer;

  double smallContainerDx = 20;
  double smallContainerDy = 70;

  int coinsDeducted = 0;
  bool hideDraggable = false;

  int? dataStreamConfigResponse;

  @override
  void initState() {
    Wakelock.enable();
    getCallCharge();

    // TODO: implement initState\
    if (int.parse(userData!.id) > int.parse(widget.userId)) {
      bookingId = '${userData!.id}_${widget.userId}';
    } else {
      bookingId = '${widget.userId}_${userData!.id}';
    }
    if (userData!.gender == UserGender.male) {
      coinsOfMaleUserBeforeCallStart = userData!.coins;
    }

    initForAgora();
    // Future.delayed(Duration(seconds: 60)).then((value) {
    //   if (_remoteUid == null) {
    //     showSnackbar('No other user is present in the call.');
    //     cutCall();
    //   } else {
    //     // showSnackbar(' user is present in the call.');
    //   }
    // });
    initializeCallPickTimer();
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    try{
      audioPlayer.dispose();
    }catch(e){

    }


    try{
     getCallStatusTimer?.cancel();
    }catch(e){

    }
    Future.delayed(Duration(seconds: 2)).then((value){
      isAvailableToTakeCalls = true;
    });
    Wakelock.disable();
    callPickTimer?.cancel();
    if (cointsKatneKaTimer != null) {
      cointsKatneKaTimer?.cancel();
    }
    if (videoCallTimer != null) {
      videoCallTimer?.cancel();
    }
    if (_engine != null) {
      _engine!.destroy();
    }

    super.dispose();
  }





  @override
  Widget build(BuildContext context) {
    isAvailableToTakeCalls = false;

    return Scaffold(
      // appBar: appBar(context: context, title: 'Manish Talreja'),
      resizeToAvoidBottomInset: false,
      body: WillPopScope(
        onWillPop: () async {
          return false;
        },
        child: _remoteUid == null && userJoined == false
            ? DialerScreen(
                age: widget.age,
                image: widget.image,
                timer: countDown.toString(),
                endCall: endCall,
                name: widget.name,
                callCharge: callCharge)
            : load
                ? CustomLoader()
                : SafeArea(
                    child: Container(
                      child: Container(
                        height: MediaQuery.of(context).size.height,
                        width: MediaQuery.of(context).size.width,
                        color: Colors.black,
                        child: Stack(
                          children: [
                            Container(
                                child: GestureDetector(
                              onTap: () {
                                setState(() {
                                  print('big container clicked');
                                  if (widgetsOpacity == 1) {
                                    widgetsOpacity = 0;
                                  } else {
                                    widgetsOpacity = 1;
                                  }
                                  showSmallContainer = true;
                                  // isLayoutPositionChanged =
                                  //     !isLayoutPositionChanged;
                                });
                              },
                              child: isLayoutPositionChanged
                                  ? _renderLocalPreview()
                                  : _renderRemoteView(),
                            )),
                            // Container(),

                            // Positioned(
                            //   top: 30,
                            //   right: 20,
                            //   child:GestureDetector(
                            //     behavior: HitTestBehavior.opaque,
                            //     onTap: (){
                            //       print('hello world');
                            //       setState(() {
                            //         isLayoutPositionChanged = !isLayoutPositionChanged;
                            //       });
                            //     },
                            //     child: Container(
                            //         height: 160,
                            //         width: 160,
                            //         clipBehavior: Clip.hardEdge,
                            //         decoration: BoxDecoration(
                            //           borderRadius: BorderRadius.circular(20),
                            //         ),
                            //         child: isLayoutPositionChanged?_renderRemoteView(): _renderLocalPreview()),
                            //   ),
                            // ),
                            Positioned(
                              top: 10,
                              right: 16,
                              left: 16,
                              child: AnimatedOpacity(
                                opacity: widgetsOpacity,
                                duration: Duration(seconds: 1),
                                curve: Curves.fastOutSlowIn,
                                child: AppBar(
                                  toolbarHeight: 70,
                                  automaticallyImplyLeading: false,
                                  titleSpacing: 16,
                                  backgroundColor: Colors.transparent,
                                  elevation: 0,
                                  title: AppBarHeadingText(
                                    text: '${widget.name}',
                                    color: Colors.white,
                                  ),
                                  // leading: implyLeading
                                  //     ? IconButton(
                                  //   icon: const Icon(
                                  //     Icons.chevron_left_outlined,
                                  //     color: Colors.black,
                                  //     size: 30,
                                  //   ),
                                  //   onPressed: onBackButtonTap != null
                                  //       ? onBackButtonTap
                                  //       : () {
                                  //     Navigator.pop(context);
                                  //   },
                                  // )
                                  //     : null,
                                ),
                              ),
                            ),
                            // Positioned(
                            //   // bottom: 20,
                            //   top: 64,
                            //   // right: 16,
                            //   left: 16,
                            //   child: Container(
                            //     // height: 100,
                            //     // width: 200,
                            //     margin: EdgeInsets.only(left: 16, right: 16),
                            //     child: Column(
                            //       mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            //       children: [
                            //         Container(
                            //           height: iconSizeOfVideoCallButtons,
                            //           width: iconSizeOfVideoCallButtons,
                            //           decoration: BoxDecoration(
                            //               color: Colors.grey,
                            //               borderRadius: BorderRadius.circular(60)),
                            //           child: IconButton(
                            //             onPressed: () async {
                            //               // await joinChannel();
                            //
                            //               isSpeakerEnabled = await _engine!
                            //                   .isSpeakerphoneEnabled();
                            //               print('the speaker is $isSpeakerEnabled');
                            //               await _engine!.setEnableSpeakerphone(
                            //                   !isSpeakerEnabled!);
                            //               isSpeakerEnabled = await _engine!
                            //                   .isSpeakerphoneEnabled();
                            //               print(
                            //                   'the speaker new  is $isSpeakerEnabled');
                            //               setState(() {});
                            //             },
                            //             icon: Icon(
                            //               isSpeakerEnabled != true
                            //                   ? Icons.volume_off
                            //                   : Icons.volume_down,
                            //               size: iconSizeOfVideoCallButtons - 15,
                            //               color: Colors.white,
                            //             ),
                            //           ),
                            //         ),
                            //         // vSizedBox,
                            //         // Container(
                            //         //   height: iconSizeOfVideoCallButtons,
                            //         //   width: iconSizeOfVideoCallButtons,
                            //         //   decoration: BoxDecoration(
                            //         //       color: Colors.grey,
                            //         //       borderRadius: BorderRadius.circular(60)
                            //         //   ),
                            //         //   child: IconButton(
                            //         //     onPressed: () async{
                            //         //       // await joinChannel();
                            //         //
                            //         //       await _engine!.switchCamera();
                            //         //       isBackCameraEnabled = !isBackCameraEnabled;
                            //         //       setState(() {
                            //         //
                            //         //       });
                            //         //     },
                            //         //     icon: Icon(
                            //         //       // isBackCameraEnabled==true?Icons.video_camera_back_rounded:Icons.video_camera_front_rounded,
                            //         //       Icons.flip_camera_ios,
                            //         //       size: iconSizeOfVideoCallButtons-15,
                            //         //       color: Colors.white,
                            //         //     ),
                            //         //   ),
                            //         // ),
                            //         vSizedBox,
                            //         Container(
                            //           height: iconSizeOfVideoCallButtons,
                            //           width: iconSizeOfVideoCallButtons,
                            //           decoration: BoxDecoration(
                            //               color: Colors.red,
                            //               borderRadius: BorderRadius.circular(60)),
                            //           child: IconButton(
                            //             onPressed: () async {
                            //               bool? result = await showDialog(
                            //                   context: context,
                            //                   builder: (context) {
                            //                     return AlertDialog(
                            //                       insetPadding:
                            //                           EdgeInsets.symmetric(
                            //                               horizontal: 32,
                            //                               vertical: 32),
                            //                       contentPadding:
                            //                           EdgeInsets.symmetric(
                            //                               horizontal: 32,
                            //                               vertical: 32),
                            //                       buttonPadding:
                            //                           EdgeInsets.symmetric(
                            //                         horizontal: 32,
                            //                       ),
                            //                       title: SubHeadingText(
                            //                         'Are you sure?',
                            //                       ),
                            //                       actions: [
                            //                         GestureDetector(
                            //                           child: SubHeadingText('No'),
                            //                           onTap: () {
                            //                             Navigator.pop(context);
                            //                           },
                            //                         ),
                            //                         GestureDetector(
                            //                           child: SubHeadingText('Yes'),
                            //                           onTap: () async {
                            //                             Navigator.pop(
                            //                                 context, true);
                            //                           },
                            //                         ),
                            //                       ],
                            //                     );
                            //                   });
                            //               print('dkllkdfsjdfkljdfs $result');
                            //               if (result == true) {
                            //                 print('dkllkdfsjdfkljdfs ');
                            //                 try {
                            //                   var request = {
                            //                     "calling_id": widget.callingId,
                            //                   };
                            //                   var jsonResponse =
                            //                       await Webservices.postData(
                            //                     apiUrl: ApiUrls.endCall,
                            //                     request: request,
                            //                   );
                            //                   await _engine!.leaveChannel();
                            //                   _remoteUid = null;
                            //                   Navigator.pop(context);
                            //                 } catch (e) {
                            //                   print('Error in catch block34 $e');
                            //                 }
                            //               }
                            //             },
                            //             icon: Icon(
                            //               Icons.call_end,
                            //               size: iconSizeOfVideoCallButtons - 15,
                            //               color: Colors.white,
                            //             ),
                            //           ),
                            //         ),
                            //         vSizedBox,
                            //         Container(
                            //           height: iconSizeOfVideoCallButtons,
                            //           width: iconSizeOfVideoCallButtons,
                            //           decoration: BoxDecoration(
                            //               color: Colors.grey,
                            //               borderRadius: BorderRadius.circular(60)),
                            //           child: IconButton(
                            //             onPressed: () async {
                            //               // await joinChannel();
                            //
                            //               if (!isAudioEnabled) {
                            //                 await _engine!.enableAudio();
                            //                 isAudioEnabled = true;
                            //               } else {
                            //                 await _engine!.disableAudio();
                            //                 isAudioEnabled = false;
                            //               }
                            //               setState(() {});
                            //             },
                            //             icon: Icon(
                            //               isAudioEnabled == true
                            //                   ? Icons.mic_none
                            //                   : Icons.mic_off,
                            //               size: iconSizeOfVideoCallButtons - 15,
                            //               color: Colors.white,
                            //             ),
                            //           ),
                            //         ),
                            //         vSizedBox,
                            //         Container(
                            //           height: iconSizeOfVideoCallButtons,
                            //           width: iconSizeOfVideoCallButtons,
                            //           decoration: BoxDecoration(
                            //               color: Colors.grey,
                            //               borderRadius: BorderRadius.circular(60)),
                            //           child: IconButton(
                            //             onPressed: () async {
                            //               // await joinChannel();
                            //               print('video enable');
                            //
                            //               if (!isVideoEnabled) {
                            //                 await _engine!.enableVideo();
                            //                 isVideoEnabled = true;
                            //               } else {
                            //                 await _engine!.disableVideo();
                            //                 isVideoEnabled = false;
                            //               }
                            //               setState(() {});
                            //             },
                            //             icon: Icon(
                            //               isVideoEnabled
                            //                   ? Icons.videocam
                            //                   : Icons.videocam_off,
                            //               size: iconSizeOfVideoCallButtons - 15,
                            //               color: Colors.white,
                            //             ),
                            //             // color: Colors.green,
                            //           ),
                            //         ),
                            //         // IconButton(
                            //         //   onPressed: () async {
                            //         //     // await joinChannel();
                            //         //     print('video enable');
                            //         //     await _engine!.enableLocalVideo(true);
                            //         //     await _engine!.enableVideo();
                            //         //     // await _engine!.enableVirtualBackground(true, VirtualBackgroundSource(color:20));
                            //         //     print('video ${_engine}');
                            //         //     // await _engine!.video
                            //         //   },
                            //         //   icon: Icon(
                            //         //     Icons.video_call,
                            //         //     size: 60,
                            //         //   ),
                            //         //   color: Colors.green,
                            //         // ),
                            //       ],
                            //     ),
                            //   ),
                            // ),
                            Positioned(
                              bottom:
                                  8 + MediaQuery.of(context).viewInsets.bottom,
                              left: 16,
                              right: 16,
                              child: AnimatedOpacity(
                                opacity: widgetsOpacity,
                                duration: Duration(seconds: 1),
                                curve: Curves.fastOutSlowIn,
                                child: Container(
                                  child: Row(
                                    children: [
                                      Expanded(
                                          child: Container(
                                        padding:
                                            EdgeInsets.symmetric(horizontal: 8),
                                        decoration: BoxDecoration(
                                            color: MyColors.whiteColor,
                                            borderRadius:
                                                BorderRadius.circular(16)),
                                        child: TextFormField(
                                          controller: messageController,
                                          decoration: InputDecoration(
                                            border: InputBorder.none,
                                            hintText: 'Type a message',
                                          ),
                                          textInputAction: TextInputAction.send,
                                          onFieldSubmitted: (av) async {
                                            print('klndsklf gnkldfjglkdjsgkl');
                                            messageController.clear();
                                            if (av != '') {
                                              await sendMessage(av);
                                              Future.delayed(Duration(milliseconds: 600)).then((value){
                                                print('going to max scroll extent');
                                                messageScrollController
                                                    .jumpTo(messageScrollController.position.maxScrollExtent);
                                              });
                                            }

                                            setState(() {});
                                          },
                                        ),
                                      )),
                                      hSizedBox,
                                      if (userData!.gender == UserGender.male)
                                        GestureDetector(
                                          onTap: () {
                                            print('hellowoore');
                                            log(giftsList.toString());
                                            showModalBottomSheet(
                                                context: context,
                                                isScrollControlled: true,
                                                builder: (context) {
                                                  return Container(
                                                    padding: EdgeInsets.all(16),
                                                    height: 375,
                                                    child: Column(
                                                      children: [
                                                        vSizedBox,
                                                        SubHeadingText(
                                                          'Send gifts',
                                                          color: MyColors
                                                              .primaryColor,
                                                        ),
                                                        vSizedBox2,
                                                        Expanded(
                                                          child: Container(
                                                            width:
                                                                MediaQuery.of(
                                                                        context)
                                                                    .size
                                                                    .width,
                                                            child: GridView(
                                                              gridDelegate:
                                                                  SliverGridDelegateWithFixedCrossAxisCount(
                                                                      crossAxisCount:
                                                                          2,
                                                                      childAspectRatio:
                                                                          1.2),
                                                              scrollDirection:
                                                                  Axis.horizontal,
                                                              children: [
                                                                for (int index =
                                                                        0;
                                                                    index <
                                                                        giftsList
                                                                            .length;
                                                                    index++)
                                                                  GestureDetector(
                                                                    onTap:
                                                                        () async {
                                                                      var request =
                                                                          {
                                                                        // 'user_id': userData!['id'],
                                                                        'send_by':
                                                                            userData!.id,
                                                                        'send_to':
                                                                            widget.userId,
                                                                        'gift_id':
                                                                            giftsList[index]['id'],
                                                                        'coins':
                                                                            giftsList[index]['coin_value'],
                                                                            'call_id': widget.callingId,
                                                                      };

                                                                      Webservices
                                                                          .postData(
                                                                        apiUrl:
                                                                            ApiUrls.sendGifts,
                                                                        request:
                                                                            request,
                                                                      ).then(
                                                                          (jsonResponse) {
                                                                        if (jsonResponse['status'].toString() ==
                                                                            '1') {
                                                                          sendMessage(
                                                                              giftsList[index]['id'],
                                                                              messageType: 'gift');
                                                                          presentToast(
                                                                              jsonResponse['message']);
                                                                          print(
                                                                              'kkkkkkkkkkk ${giftsList[index]['image']}');
                                                                          coinsOfMaleUserBeforeCallStart -=
                                                                              int.parse(giftsList[index]['coin_value'].toString());

                                                                          showDialog(
                                                                              context: MyGlobalKeys.navigatorKey.currentContext!,
                                                                              builder: (context) {
                                                                                return VideoCallAnimationPage(
                                                                                  giftUrl: giftsList[index]['image'],
                                                                                );
                                                                              });
                                                                          Future.delayed(Duration(seconds: 4))
                                                                              .then((value) {
                                                                            print('popping7');
                                                                            Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
                                                                          });

                                                                          MyLocalServices.updateUserDataFromServer(
                                                                              userId: userData!.id,
                                                                              apiUrl: ApiUrls.getUserData);
                                                                          setState(
                                                                              () {});
                                                                        } else {}
                                                                      });
                                                                      print(
                                                                          'popping8');
                                                                      Navigator.pop(
                                                                          MyGlobalKeys.navigatorKey.currentContext!);
                                                                    },
                                                                    child:
                                                                        Padding(
                                                                      padding:
                                                                          const EdgeInsets.all(
                                                                              8.0),
                                                                      child:
                                                                          Column(
                                                                        children: [
                                                                          CustomCircularImage(
                                                                            imageUrl:
                                                                                giftsList[index]['image'],
                                                                            height:
                                                                                65,
                                                                            width:
                                                                                65,
                                                                          ),
                                                                          vSizedBox05,
                                                                          ParagraphText(
                                                                              '${giftsList[index]['coin_value']}')
                                                                        ],
                                                                      ),
                                                                    ),
                                                                  ),
                                                                //   ClipRRect(
                                                                //   borderRadius: BorderRadius.circular(70),
                                                                //   child: Image.asset(
                                                                //     'assets/gift.png',
                                                                //     height: 50,
                                                                //     width: 50,
                                                                //   ),
                                                                // ),Text('jdfg')
                                                              ],
                                                            ),
                                                          ),
                                                        ),
                                                        Row(
                                                          mainAxisAlignment:
                                                              MainAxisAlignment
                                                                  .spaceBetween,
                                                          children: [
                                                            Row(
                                                              children: [
                                                                Icon(
                                                                    Icons
                                                                        .circle,
                                                                    color: MyColors
                                                                        .yelloew),
                                                                hSizedBox05,
                                                                ParagraphText(
                                                                    userData!
                                                                        .coins
                                                                        .toString()),
                                                              ],
                                                            ),
                                                            RoundEdgedButton(
                                                              onTap: () {
                                                                print(
                                                                    'Buy More Coins');
                                                                showCustomBottomSheet(
                                                                    this
                                                                        .context,
                                                                    child:
                                                                        Container(
                                                                      height:
                                                                          600,
                                                                      child:
                                                                          Get_Coins_Page(),
                                                                    ));
                                                              },
                                                              text:
                                                                  'Get more coins',
                                                              width: 140,
                                                            )
                                                          ],
                                                        )
                                                      ],
                                                    ),
                                                  );
                                                });
                                          },
                                          child: Container(
                                            padding: EdgeInsets.all(6),
                                            decoration: BoxDecoration(
                                                color: MyColors.primaryColor,
                                                borderRadius:
                                                    BorderRadius.circular(80)),
                                            child: Center(
                                                child: Image.asset(
                                              MyImages.giftIcon,
                                              height: 40,
                                              width: 40,
                                            )),
                                          ),
                                        )
                                    ],
                                  ),
                                ),
                              ),
                            ),
                            Positioned(
                              bottom:
                                  80 + MediaQuery.of(context).viewInsets.bottom,
                              left: 16,
                              right: 16,
                              child: AnimatedOpacity(
                                opacity: widgetsOpacity,
                                duration: Duration(seconds: 1),
                                curve: Curves.fastOutSlowIn,
                                child: Container(
                                  height: 100,
                                  child: ListView.builder(
                                      controller: messageScrollController,
                                      itemCount: messages.length,
                                      itemBuilder: (context, index) {
                                        return Container(
                                          padding: EdgeInsets.symmetric(
                                              horizontal: 6, vertical: 6),
                                          margin:
                                              EdgeInsets.symmetric(vertical: 8),
                                          // decoration: BoxDecoration(
                                          //   color: Colors.white,
                                          //   borderRadius: BorderRadius.circular(12),
                                          // ),
                                          child: Row(
                                            children: [
                                              ParagraphText(
                                                (messages[index].isOwner
                                                        ? userData!.name
                                                        : widget.name) +
                                                    ':',
                                                color: Colors.white,
                                              ),
                                              hSizedBox,
                                              ParagraphText(
                                                messages[index].message,
                                                color: MyColors.primaryColor,
                                                fontWeight: FontWeight.w500,
                                              ),
                                            ],
                                          ),
                                        );
                                      }),
                                ),
                              ),
                            ),
                            Positioned(
                              top: smallContainerDy,
                              left: smallContainerDx,
                              child: hideDraggable
                                  ? Container()
                                  // :!showSmallContainer?Container()
                                  : Draggable(
                                      feedback: GestureDetector(
                                        behavior: HitTestBehavior.opaque,
                                        onTap: () {
                                          print('hello world');
                                          setState(() {
                                            isLayoutPositionChanged =
                                                !isLayoutPositionChanged;
                                          });
                                        },
                                        child: Container(
                                            height: 160,
                                            width: 160,
                                            clipBehavior: Clip.hardEdge,
                                            decoration: BoxDecoration(
                                              borderRadius:
                                                  BorderRadius.circular(20),
                                            ),
                                            child: isLayoutPositionChanged
                                                ? _renderRemoteView()
                                                : _renderLocalPreview()),
                                      ),
                                      onDragEnd: (details) {
                                        print(
                                            'the details are ${details.offset.dx} ${details.offset.dy}');
                                        smallContainerDy = details.offset.dy;
                                        smallContainerDx = details.offset.dx;
                                        hideDraggable = true;

                                        setState(() {});
                                        Future.delayed(
                                                Duration(milliseconds: 200))
                                            .then((value) {
                                          hideDraggable = false;
                                          setState(() {});
                                        });
                                      },
                                      child: GestureDetector(
                                        behavior: HitTestBehavior.opaque,
                                        onTap: () {
                                          print('hello worlddd');
                                          setState(() {
                                            showSmallContainer = false;
                                            if (widgetsOpacity == 1) {
                                              widgetsOpacity = 0;
                                            } else {
                                              widgetsOpacity = 1;
                                            }
                                            // isLayoutPositionChanged =
                                            //     !isLayoutPositionChanged;
                                          });
                                        },
                                        child: AnimatedOpacity(
                                          opacity: widgetsOpacity,
                                          duration: Duration(seconds: 1),
                                          curve: Curves.fastOutSlowIn,
                                          child: Column(
                                            mainAxisSize: MainAxisSize.min,
                                            children: [
                                              Container(
                                                  height: 160,
                                                  width: 160,
                                                  clipBehavior: Clip.hardEdge,
                                                  decoration: BoxDecoration(
                                                    borderRadius:
                                                        BorderRadius.only(
                                                      topLeft:
                                                          Radius.circular(20),
                                                      topRight:
                                                          Radius.circular(20),
                                                    ),
                                                  ),
                                                  child: isLayoutPositionChanged
                                                      ? _renderRemoteView()
                                                      : _renderLocalPreview()),
                                              GestureDetector(
                                                onTap: () async {
                                                  endCall(
                                                      showConfirmationDialog:
                                                          true);
                                                },
                                                child: Container(
                                                  height: 50,
                                                  width: 160,
                                                  clipBehavior: Clip.hardEdge,
                                                  decoration: BoxDecoration(
                                                    color: Colors.red,
                                                    borderRadius:
                                                        BorderRadius.only(
                                                      bottomLeft:
                                                          Radius.circular(20),
                                                      bottomRight:
                                                          Radius.circular(20),
                                                    ),
                                                  ),
                                                  child: Center(
                                                    child: ParagraphText(
                                                      'End Call',
                                                      color: Colors.white,
                                                    ),
                                                  ),
                                                ),
                                              )
                                            ],
                                          ),
                                        ),
                                      ),
                                    ),
                            ),
                            if (widget.isFollow == '0' &&
                                userData!.id != widget.userId)
                              Positioned(
                                  bottom: 70.0,
                                  right: 24.0,
                                  child: AnimatedOpacity(
                                    opacity: widgetsOpacity,
                                    duration: Duration(seconds: 1),
                                    curve: Curves.fastOutSlowIn,
                                    child: RoundEdgedButton(
                                      text: 'Follow',
                                      shadow: 0,
                                      width: 100,
                                      onTap: () async {
                                        setState(() {
                                          widget.isFollow = '1';
                                          // info['follower']= int.parse(info['follower'].toString()) + 1;
                                        });
                                        Map data = {
                                          'follow_by': userData!.id,
                                          'follow_to': widget.userId,
                                        };
                                        Map res = await getData(
                                            data, 'startFollow', 0, 0);
                                        print('follow------$res');
                                      },
                                    ),
                                  )),
                            if (widget.isFollow == '1' &&
                                userData!.id != widget.userId)
                              Positioned(
                                  bottom: 70.0,
                                  right: 24.0,
                                  child: AnimatedOpacity(
                                    opacity: widgetsOpacity,
                                    duration: Duration(seconds: 1),
                                    curve: Curves.fastOutSlowIn,
                                    child: RoundEdgedButton(
                                      text: 'Unfollow',
                                      shadow: 0,
                                      width: 100,
                                      onTap: () async {
                                        setState(() {
                                          widget.isFollow = '0';
                                          // info['follower']= int.parse(info['follower'].toString()) - 1;
                                        });
                                        Map data = {
                                          'follow_by': userData!.id,
                                          'follow_to': widget.userId,
                                        };
                                        Map res = await getData(
                                            data, 'startUnFollow', 0, 0);
                                        print('follow------$res');
                                      },
                                    ),
                                  )),
                            if (widgetsOpacity == 0)
                              Positioned(
                                top: 0,
                                bottom: 0,
                                left: 0,
                                right: 0,
                                child: GestureDetector(
                                    onTap: () {
                                      FocusScope.of(context)
                                          .requestFocus(new FocusNode());
                                      if (widgetsOpacity == 1) {
                                        widgetsOpacity = 0;
                                      } else {
                                        widgetsOpacity = 1;
                                      }
                                      setState(() {});
                                    },
                                    child: Container(
                                      height:
                                          MediaQuery.of(context).size.height,
                                      width: MediaQuery.of(context).size.width,
                                      color: Colors.transparent,
                                    )),
                              ),
                            Positioned(
                              top: 80,
                              right: 16,
                              child: AnimatedOpacity(
                                  opacity: widgetsOpacity,
                                  duration: Duration(seconds: 1),
                                  curve: Curves.fastOutSlowIn,
                                  child: SubHeadingText(
                                    '${secondsInTimerFormat(seconds)}',
                                    color: Colors.white,
                                  )),
                            ),
                            if (userData!.gender == UserGender.male)
                              Positioned(
                                top: 45,
                                right: 16,
                                child: AnimatedOpacity(
                                    opacity: widgetsOpacity,
                                    duration: Duration(seconds: 1),
                                    curve: Curves.fastOutSlowIn,
                                    child: Row(
                                      children: [
                                        CustomCircularImage(
                                          imageUrl: userData!.gender ==
                                                  UserGender.male
                                              ? MyImages.coins
                                              : MyImages.diamond,
                                          fileType: CustomFileType.asset,
                                          height: 30,
                                          width: 30,
                                        ),
                                        hSizedBox05,
                                        SubHeadingText(
                                          '${coinsOfMaleUserBeforeCallStart}',
                                          color: Colors.white,
                                        ),
                                      ],
                                    )),
                              ),
                          ],
                        ),
                      ),
                      // child: Stack(
                      //   children: [
                      //
                      //
                      //     // Positioned(
                      //     //   bottom: 30,
                      //     //   right: 40,
                      //     //   child: _renderRemoteView(),
                      //     // ),
                      //     Positioned(
                      //       top: 30,
                      //       right: 40,
                      //       child: _renderLocalPreview(),
                      //     ),
                      //     Positioned(
                      //       top: 10,
                      //       right: 16,
                      //       left: 16,
                      //       child:appBar(context: context, title: 'Manish Talreja'),
                      //     ),
                      //     Positioned(
                      //       bottom: 20,
                      //       right: 16,
                      //       left: 16,
                      //       child:Container(
                      //         height: 100,
                      //         width: 200,
                      //         child: Row(
                      //           mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      //           children: [
                      //             IconButton(
                      //               onPressed: () {},
                      //               icon: Icon(
                      //                 Icons.volume_off,
                      //                 size: 60,
                      //               ),
                      //             ),
                      //
                      //             IconButton(
                      //               onPressed: ()async {
                      //                 if(_remoteUid!=null){
                      //                   await _engine!.leaveChannel();
                      //                   _remoteUid = null;
                      //
                      //                 }
                      //                 else{
                      //                   await joinChannel();
                      //                 }
                      //                 // if(_engine.)
                      //                 setState(() {
                      //
                      //                 });
                      //               },
                      //               icon: Icon(
                      //                 Icons.call_end,
                      //                 size: 60,
                      //                 color: Colors.red,
                      //               ),
                      //             ),
                      //
                      //             // IconButton(
                      //             //   onPressed: () async {
                      //             //     await _engine!.leaveChannel();
                      //             //   },
                      //             //   icon: Icon(
                      //             //     Icons.circle,
                      //             //     size: 100,
                      //             //   ),
                      //             //   color: Colors.green,
                      //             // ),
                      //
                      //             IconButton(
                      //               onPressed: () async {
                      //                 // await joinChannel();
                      //                 print('video enable');
                      //                 // await _engine!.enableLocalVideo(true);
                      //                 await _engine!.enableVideo();
                      //                 print('video ${_engine}');
                      //                 // await _engine!.video
                      //               },
                      //               icon: Icon(
                      //                 Icons.video_call,
                      //                 size: 60,
                      //               ),
                      //               color: Colors.green,
                      //             ),
                      //             // IconButton(
                      //             //   onPressed: () async {
                      //             //     // await joinChannel();
                      //             //     print('video enable');
                      //             //     await _engine!.enableLocalVideo(true);
                      //             //     await _engine!.enableVideo();
                      //             //     // await _engine!.enableVirtualBackground(true, VirtualBackgroundSource(color:20));
                      //             //     print('video ${_engine}');
                      //             //     // await _engine!.video
                      //             //   },
                      //             //   icon: Icon(
                      //             //     Icons.video_call,
                      //             //     size: 60,
                      //             //   ),
                      //             //   color: Colors.green,
                      //             // ),
                      //             SizedBox(
                      //               width: 20,
                      //             ),
                      //           ],
                      //         ),
                      //       ),
                      //     ),
                      //
                      //   ],
                      // ),
                    ),
                  ),
      ),
    );
  }

  cutCall() async {
    try {
      var request = {
        "calling_id": widget.callingId,
      };
      var jsonResponse = await Webservices.postData(
        apiUrl: ApiUrls.endCall,
        request: request,
      );
      await _engine!.leaveChannel();
      _remoteUid = null;
      print('popping1');
      Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
    } catch (e) {
      print('Error in catch block34 $e');
    }
  }

  showCoinsDeductionAnimation() async {
    // var controller = AnimationController(vsync: this);
    showDialog(
        context: context,
        builder: (context) {
          return VideoCallAnimationPage();
        });
    Future.delayed(Duration(seconds: 4)).then((value) {
      print('popping2');
      Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
    });
  }

  showDiamondRewardAnimation() async {}
  cutCoinsFromMaleUserAndRewardItToFemale() async {
    cointsKatneKaTimer = Timer.periodic(Duration(seconds: 60), (timer) async {
      print('its time to cut the coins');
      if (userData!.gender == UserGender.male) {
        var request = {
          'call_id': widget.callingId,
          'user_id': userData!.id,
        };
        var jsonResponse = await Webservices.postData(
          apiUrl: ApiUrls.cutCoins,
          request: request,
        );
        if (jsonResponse['status'] == 1) {
          /// COIN DEDUCT ANIMATION FOR MALE USER
          // showCoinsDeductionAnimation();
        } else {
          _engine!.leaveChannel();
          print('popping3');
          if(isPurchaseCoinsDialogOpen){
            Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
          }
          Navigator.maybePop(MyGlobalKeys.navigatorKey.currentContext!);

        }
      } else {
        showCoinsDeductionAnimation();
        // showDiamondRewardAnimation();
      }
    });
  }

  sendMessage(String message, {String messageType = 'text'}) async {
    print('sending message');
    int? streamId = 1;
    try{
      int? streamId = await _engine
          ?.createDataStreamWithConfig(DataStreamConfig(false, false));
    }catch(e){
      print('Error in catch block. could not send message, get stream id failed $e');
    }
    if (streamId != null) {
      print('the stream id is ${streamId}');
      print('dklfl ${dataStreamConfigResponse}');
      Map temp = {'type': messageType, 'message': message};
      String messageString = jsonEncode(temp);
      List<int> list = utf8.encode(messageString);
      Uint8List bytes = Uint8List.fromList(list);
      print('the message is ${bytes}');
      await _engine!.sendStreamMessage(streamId, bytes);
      // ---------
      // ff
      await _engine!.sendMetadata(bytes);
      // await _engine!.
      print('the message is sent $bytes');
      if (messageType == 'text') {
        messages.add(VideoCallMessageModal(message: message, isOwner: true));
      }

      setState(() {});
    } else {
      print('the stream id is null');
    }
  }

  Future<void> initiateCall() async {
    setState(() {
      load = true;
    });
    var request = {
      "sender_id": userData!.id,
      "receiver_id": widget.userId,
    };
    if (widget.isPickingCall) {
      request = {
        "sender_id": widget.userId,
        "receiver_id": userData!.id,
        // "user_id": userData!.id,
        // "client_id": widget.userId,
        // "booking_id": bookingId,
        // // "user_type": userData!.
      };
      request['calling_id'] = widget.callingId!;
      request['call_type'] = '1';
    } else {
      request['call_type'] = '1';
      try{
        await audioPlayer.setReleaseMode(ReleaseMode.loop);
      }catch(e){
        print('Error in catch block 43895 $e');
      }
      await audioPlayer.play(AssetSource(MyImages.ringbackSoundUrl));
      try{
        await audioPlayer.setReleaseMode(ReleaseMode.loop);
      }catch(e){
        print('Error in catch block 43895 1 $e');
      }
    }
    var jsonResponse = await Webservices.postData(
      apiUrl: widget.isPickingCall ? ApiUrls.pickCall : ApiUrls.startCall,
      request: request,
    );

    if (jsonResponse['status'] == 1) {
      token = null;
      if (widget.isPickingCall != true) {
        widget.callingId = jsonResponse['data']['id'];
      }
      channelName = bookingId + '_manish';
    }
    else {
      showSnackbar('${jsonResponse['message']}');
      print('popping4');
      Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
      if (userData!.gender == UserGender.male) {
        await push(
            context: MyGlobalKeys.navigatorKey.currentContext!,
            screen: Get_Coins_Page());
      }

      return;
    }
    if(!widget.isPickingCall){
      getCallStatusTimer = Timer.periodic(Duration(seconds: 3), (timer) {
        var request = {
        'call_id': widget.callingId,
      };
        Webservices.postData(apiUrl: ApiUrls.getCurrentCallStatus, request: request).then((value){
          if(value['status']==1){
            if(value['data']['status']=='2'){
               _engine!.leaveChannel();
          _remoteUid = null;
          print('popping1');
          Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
            }
          }
        });
      });
    }
    await [Permission.microphone, Permission.camera].request();
    setState(() {
      load = false;
    });
  }

  Future<void> initForAgora() async {
    await getpurchaseCoinsPackagesList();
    await initiateCall();
    // creates the engine
    _engine = await RtcEngine.create(appId);

    log('the engine is created');
    _engine!.setEventHandler(
      RtcEngineEventHandler(
        cameraReady: () {
          print('fsdddd');
        },
        streamMessage: (streamId, dusriId, streamMessage) {
          print('incoming message recieved');
          String messageString = utf8.decode(streamMessage);
          Map messageMap = jsonDecode(messageString);
          print('the stream manish message is ${messageMap}');
          if (messageMap['type'] == 'text') {
            messages.add(VideoCallMessageModal(
                message: messageMap['message'], isOwner: false));
            setState(() {});

            Future.delayed(Duration(milliseconds: 600)).then((value){
              print('going to max scroll extent');
              messageScrollController
                  .jumpTo(messageScrollController.position.maxScrollExtent);
            });
          } else if (messageMap['type'] == 'gift') {
            int index = 0;
            for (int i = 0; i < giftsList.length; i++) {
              if (giftsList[i]['id'].toString() ==
                  messageMap['message'].toString()) {
                index = i;
                setState(() {});
              }
            }
            showDialog(
                context: MyGlobalKeys.navigatorKey.currentContext!,
                builder: (context) {
                  return VideoCallAnimationPage(
                    giftUrl: giftsList[index]['image'],
                  );
                });
            Future.delayed(Duration(seconds: 4)).then((value) {
              print('popping5');
              Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
            });
          } else {
            print('the message type does not match');
          }
        },
        localAudioStateChanged: (ss, error) {
          _engine!.isSpeakerphoneEnabled().then((value) {
            isSpeakerEnabled = value;
            try {
              setState(() {});
            } catch (e) {
              print('Error in catch block 2343 $e');
            }
          });
        },
        localVideoStats: (df) {
          print('local video stats');
          print(df.captureBrightnessLevel);
        },
        joinChannelSuccess: (String channel, int uid, int elapsed) {
          print('Local user $uid joined');
          setState(() {});
        },
        rejoinChannelSuccess: (string, int1, int2) {
          print('rejoined fffff');
        },
        userEnableVideo: (a, isenbla) {
          print('The user ghass enabled $a $isenbla');
        },
        userJoined: (int uid, int elapsed) async {
          audioPlayer.dispose();
          print('Remote user $uid joined');
          userJoined = true;
          coinsOfMaleUserBeforeCallStart -= callCostPerMinute;
          callPickTimer?.cancel();
          videoCallTimer = Timer.periodic(Duration(seconds: 1), (timer) {
            seconds++;
            if (seconds % 60 == 0) {
              coinsOfMaleUserBeforeCallStart -= callCostPerMinute;
              // Future.delayed(Duration(seconds: 30)).then((value){
              //   if (coinsOfMaleUserBeforeCallStart < callCostPerMinute && userJoined && _remoteUid!=null) {
              //     showPurchaseCoinsDialog();
              //   }
              // });

            }
            if (coinsOfMaleUserBeforeCallStart < callCostPerMinute && userJoined && _remoteUid!=null && isPurchaseCoinsDialogOpen==false && ((seconds%60)>=30)  && userData!.gender==UserGender.male) {
              showPurchaseCoinsDialog();
            }

            setState(() {});
          });

          setState(() {
            _remoteUid = uid;
          });
          var request = {
            'call_id': widget.callingId,
            'user_id': userData!.id,
          };
          try {
            cutCoinsFromMaleUserAndRewardItToFemale();
          } catch (e) {
            await _engine!.leaveChannel();
            print('popping all ${e}');
            Navigator.popUntil(context, (route) => route.isFirst);
          }
          // if(userData!.gender==UserGender.male){
          //   var jsonResponse = await Webservices.postData(
          //     apiUrl: ApiUrls.cutCoins,
          //     request: request,
          //   );
          //   if (jsonResponse['status'] == 1) {
          //     /// COIN DEDUCT ANIMATION FOR MALE USER
          //     // showCoinsDeductionAnimation();
          //   }
          // }
        },
        userOffline: (int uid, UserOfflineReason reason) async {
          print('bhag gaya yr');
          print('Remote user $uid left');
          _remoteUid = null;
          userJoined = false;

          // await Webservices.postData(apiUrl: ApiUrls.endCall, body: request, context: context);

          await _engine!.leaveChannel();
          print('popping6');
          // if(isPurchaseCoinsDialogOpen){
          //   Navigator.popUntil(context, (route) => route.isFirst);
          // }
          Navigator.popUntil(context, (route) => route.isFirst);
          Navigator.maybePop(MyGlobalKeys.navigatorKey.currentContext!);
          // Navigator.popUntil(context, (route) => route.isFirst);
          setState(() {
            _remoteUid = null;
          });
        },
      ),
    );

    print('about to join channel with name $channelName and token $token');

    await joinChannel();
    await _engine!.enableVideo();
    isVideoEnabled = true;
    await _engine!.enableAudio();
    isAudioEnabled = true;
    await _engine!.setCameraAutoFocusFaceModeEnabled(true);
    await _engine!.setDefaultAudioRouteToSpeakerphone(true);
    await _engine!.setEnableSpeakerphone(true);
    isSpeakerEnabled = true;

    // createDataStreamWithConfig

    // dataStreamConfigResponse =
    //     await _engine!.createDataStreamWithConfig(DataStreamConfig(true, true));

    setState(() {
      load = false;
    });
  }

  Widget _renderRemoteView() {
    if (_remoteUid != null) {
      return RtcRemoteView.SurfaceView(
        uid: _remoteUid!,
        channelId: channelName,
      );
    } else {
      return Center(
        child: ParagraphText(
          'Please Wait Till The Other Member Joins',
          color: Colors.white,
        ),
      );
    }
  }

  Widget _renderLocalPreview() {
    return RtcLocalView.SurfaceView();
  }

  joinChannel() async {
    try {
      await _engine!.joinChannel(
        token,
        channelName,
        null,
        0,
      );
      await _engine!.setCameraAutoFocusFaceModeEnabled(true);
      await _engine!.enableRemoteSuperResolution(_remoteUid!, true);
    } catch (e) {
      print('inside catch block234 $e');
      await _engine!.leaveChannel();
      await _engine!.joinChannel(token, channelName, null, 0);
      await _engine!.setCameraAutoFocusFaceModeEnabled(true);
      await _engine!.setDefaultAudioRouteToSpeakerphone(true);
      // await _engine!.enableRemoteSuperResolution(_remoteUid!, true);
    }
  }

  bool userJoined = false;

  Timer? callPickTimer;
  int countDown = 60;
  Map? callCharge;

  getCallCharge() async {
    var jsonResponse = await Webservices.getMap(ApiUrls.converstionRates);

    callCharge = jsonResponse;
    callCostPerMinute = int.parse(callCharge?['calling_cost'] ?? '60');
    setState(() {});
  }

  initializeCallPickTimer() {
    callPickTimer = Timer.periodic(Duration(seconds: 1), (timer) {
      countDown--;
      if (countDown == 0 && userJoined == false && _remoteUid == null) {
        endCall();
        // Navigator.pop(context);
      }
      setState(() {});
    });
  }

  endCall({bool showConfirmationDialog = false}) async {
    bool? result;

    print('the confir ajjj is $showConfirmationDialog');
    if (showConfirmationDialog) {
      result = await showDialog(
          context: context,
          builder: (context) {
            return AlertDialog(
              insetPadding: EdgeInsets.symmetric(horizontal: 32, vertical: 32),
              contentPadding:
                  EdgeInsets.symmetric(horizontal: 32, vertical: 32),
              buttonPadding: EdgeInsets.symmetric(
                horizontal: 32,
              ),
              title: SubHeadingText(
                'Are you sure?',
              ),
              actions: [
                GestureDetector(
                  child: SubHeadingText('No'),
                  onTap: () {
                    print('popping9');
                    Navigator.maybePop(MyGlobalKeys.navigatorKey.currentContext!);
                  },
                ),
                GestureDetector(
                  child: SubHeadingText('Yes'),
                  onTap: () async {
                    print('popping10');
                    Navigator.pop(context, true);
                    Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
                  },
                ),
              ],
            );
          });
    } else {
      result = true;
    }

    print('dkllkdfsjdfkljdfs $result');
    if (result == true) {
      print('dkllkdfsjdfkljdfs ');
      try {
        var request = {
          "calling_id": widget.callingId,
        };
        setState(() {
          load = true;
        });
        var jsonResponse = await Webservices.postData(
          apiUrl: ApiUrls.endCall,
          request: request,
        );
        await _engine!.leaveChannel();
        _remoteUid = null;
        print('popping11');
        Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
        // Navigator.maybePop(MyGlobalKeys.navigatorKey.currentContext!);
      } catch (e) {
        print('Error in catch block34 $e');
        try {
          await _engine!.leaveChannel();
          Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
        } catch (e) {}
        print('popping12');
        Navigator.popUntil(MyGlobalKeys.navigatorKey.currentContext!, (route) => route.isFirst);
      }
    }

  }
}

class VideoCallMessageModal {
  String message;
  bool isOwner;

  VideoCallMessageModal({
    required this.message,
    required this.isOwner,
  });
}
