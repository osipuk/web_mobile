import 'dart:async';
import 'dart:io';

import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/modals/message_modal.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/pages/story_preview_page.dart';
import 'package:Enjoy/pages/view_story_page.dart';
import 'package:Enjoy/services/image.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:Enjoy/widget/play_video_page.dart';
import 'package:Enjoy/widget/record_audio_bottom_sheet.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/global_data.dart';
import '../constants/global_functions.dart';
import '../constants/global_keys.dart';
import '../constants/navigation_functions.dart';
import '../constants/sized_box.dart';
import '../dialogs/showFeedbackDialog.dart';
import '../services/alert.dart';
import '../services/api_urls.dart';
import '../services/auth.dart';
import '../services/common_functions.dart';
import '../services/localServices.dart';
import '../services/video_call_page.dart';
import '../services/webservices.dart';
import '../widget/CustomTexts.dart';
import '../widget/chat_bubble.dart';
import '../widget/custom_text_field.dart';
import '../widget/record_video_screen.dart';
import '../widget/round_edged_button.dart';
import '../widget/show_custom_modal_sheet.dart';
import '../widget/solidBtn.dart';
import 'package:audio_waveforms/audio_waveforms.dart';
import 'package:video_player/video_player.dart';

class ChatPage extends StatefulWidget {
  final Map info;
  const ChatPage({Key? key, required this.info}) : super(key: key);

  @override
  State<ChatPage> createState() => _ChatPageState();
}

class _ChatPageState extends State<ChatPage> {
  bool load = false;
  bool addStoryLoad = false;
  Map? selectedMessage = reportReasonsList[0];
  List<MessageModal> messages = [];
  TextEditingController messageController = TextEditingController();
  ScrollController messageScrollController = ScrollController();
  disposeEverything() async {
    messages.forEach((element) {
      if (element.playerController != null) {
        try {
          element.playerController!.dispose();
          element.playerController = null;
        } catch (e) {
          print('nothing happened $e');
        }
      }
    });
  }

  getMessages({bool isFirst = false}) async {
    if (isFirst)
      setState(() {
        load = true;
      });
    try {
      var request = {'sender': userData!.id, 'receiver': widget.info['id']};
      List messageList = await Webservices.getListFromRequestParameters(
          ApiUrls.getChat, request);
      messages = [];
      messageList.forEach((element) {
        messages.add(MessageModal.fromJson(element));
      });
    } catch (e) {
      print('Error in catch block 348 $e');
    }
    setState(() {
      load = false;
    });
  }

  sendMessage(
      {File? file, String? message, required String messageType}) async {
    print(
        'sending message............----------${message}---------- ${messageType}.......${file}');
    var request = {
      'sender': userData!.id,
      'receiver': widget.info['id'],
    };
    Map<String, File> files = {};
    if (file != null) {
      request['message_type'] = messageType;
      files = {'message': file};
    } else {
      request['message'] = message;
      request['message_type'] = messageType;
    }

    print('sending message...........${request} and ${files}');

    if (messageType == kMessageType[2] || messageType == kMessageType[3]) {
      VideoPlayerController controller = VideoPlayerController.file(file!);
      await controller.initialize();
      request['duration'] = controller.value.duration.toString();
    }
    if (messageType == kMessageType[0]) {
      print('helll');
      MessageModal newMessage = MessageModal(
          id: '-1',
          message: messageController.text,
          dateTime: DateTime.now(),
          senderId: userData!.id,
          recieverId: widget.info['id'],
          isRead: true,
          messageType: messageType,
          timeAgo: 'timeAgo',
          thumbnail: null,
          duration: 0);
      messages = [newMessage, ...messages];
      setState(() {});
    }
    print('sending message.---..........${request} and ${files}');
    var jsonResponse = await Webservices.postDataWithImageFunction(
        body: request,
        files: files,
        context: context,
        endPoint: ApiUrls.sendMessage);
    List messageList = await Webservices.getListFromRequestParameters(
        ApiUrls.getChat, request);
    messages = [];
    messageList.forEach((element) {
      messages.add(MessageModal.fromJson(element));
    });
    setState(() {});
  }

  Timer? chatTimer;
  @override
  void initState() {
    // TODO: implement initState
    getMessages(isFirst: true);
    chatTimer = Timer.periodic(Duration(seconds: 5), (timer) async {
      await getMessages();
    });
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    chatTimer!.cancel();
    disposeEverything();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.secondary,
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        leading: IconButton(
          icon: Icon(
            Icons.arrow_back_ios_new,
            color: Colors.white,
          ),
          onPressed: () => {Navigator.pop(context)},
        ),
        title: Text(
          '${widget.info['name']}',
          style: TextStyle(
              color: Colors.white, fontSize: 16, fontFamily: 'semibold'),
        ),
        centerTitle: true,
        shadowColor: Colors.transparent,
        shape: Border(
            bottom:
                BorderSide(color: Colors.white.withOpacity(0.50), width: 0.2)),
        actions: [
          IconButton(
              onPressed: ()async {
                await push(
                    context: context,
                    screen: VideoCallScreen(
                      name: widget.info['name'],
                      userId: widget.info['id'],
                      isFollow: widget.info['is_follow']??'0',
                      image: widget.info['image'],
                      age: widget.info['age'].toString(),
                    ));
                if(!userData!.hasRated){
                  showCustomDialog(FeedBackDialog());
                }
              },
              icon: Icon(Icons.videocam_outlined)),
          PopupMenuButton(
            // initialValue: '1',
            child: Center(
                child: Icon(
              Icons.more_vert,
              color: Colors.white,
            )),
            itemBuilder: (context) {
              return [
                PopupMenuItem(
                  value: '1',
                  child: Text(
                    widget.info['is_blocked'].toString() == '1'
                        ? 'Unblock'
                        : 'Block',
                    style: TextStyle(color: Colors.red),
                  ),
                  onTap: () async {
                    String api = widget.info['is_blocked'].toString() == '1'
                        ? 'unblockUser'
                        : 'blockUser';
                    Map data = {
                      'blocked_by': userData?.id,
                      'blocked_to': widget.info['id'],
                    };
                    loadingShow(context);
                    Map res = await getData(data, api, 0, 0);
                    loadingHide(context);
                    print('----$res');
                    if (res['status'].toString() == '1') {
                      Navigator.pop(context);
                    }
                  },
                ),
                PopupMenuItem(
                  value: '2',
                  child: Text(
                    'Report',
                    style: TextStyle(color: Colors.red),
                  ),
                  onTap: () async {
                    // Navigator.pop(context);
                    await Future.delayed(Duration(milliseconds: 10));

                    await Future.delayed(Duration(milliseconds: 100));
                    showDialog(
                      context: MyGlobalKeys.navigatorKey.currentContext!,
                      builder: (BuildContext context) => SimpleDialog(
                        backgroundColor: Colors.transparent,
                        // title:const Text('GeeksforGeeks'),
                        children: [
                          Container(
                            width: 350,
                            padding: EdgeInsets.all(25),
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(20),
                                color: Color(0xFE1CDBC1),
                                boxShadow: [
                                  BoxShadow(
                                      color: Color(0xFE1CDBC1).withOpacity(0.5),
                                      spreadRadius: 10)
                                ]),
                            child: Column(
                              children: [
                                Row(
                                  children: [
                                    Text(
                                      'Report',
                                      style: TextStyle(
                                          fontFamily: 'extrabold',
                                          color: Colors.white,
                                          fontSize: 35),
                                    )
                                  ],
                                  mainAxisAlignment: MainAxisAlignment.center,
                                ),
                                vSizedBox4,
                                Row(
                                  children: [
                                    Text(
                                      'Select Reason: ',
                                      style: TextStyle(
                                          fontFamily: 'regular',
                                          color: Colors.white,
                                          fontSize: 12),
                                    ),
                                  ],
                                  mainAxisAlignment: MainAxisAlignment.start,
                                ),
                                vSizedBox,
                                Container(
                                  child: DropdownButtonHideUnderline(
                                    child: DropdownButton(
                                      value: selectedMessage,
                                      icon: const Icon(
                                          Icons.keyboard_arrow_down_rounded),
                                      elevation: 16,
                                      style:
                                          const TextStyle(color: Colors.black),
                                      onChanged: (Map? newValue) {
                                        setState(() {
                                          selectedMessage = newValue!;
                                        });
                                      },
                                      items: List.generate(
                                        reportReasonsList.length,
                                        (index) => DropdownMenuItem<Map>(
                                          value: reportReasonsList[index],
                                          child: Text(reportReasonsList[index]
                                              ['message']),
                                        ),
                                      ),
                                      isExpanded: true,
                                    ),
                                  ),
                                  padding: EdgeInsets.symmetric(
                                      vertical: 5, horizontal: 10),
                                  decoration: ShapeDecoration(
                                    color: Colors.white,
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.all(
                                          Radius.circular(100)),
                                    ),
                                  ),
                                ),
                                vSizedBox4,
                                SolidBtn(
                                    BtnText: 'Submit Report',
                                    BgColorTop: Colors.redAccent,
                                    BgColorBottom: Colors.red,
                                    ShadowColor: Color(0xFE1CDBC1),
                                    funcTap: () async {
                                      setState(() {});
                                      var request = {
                                        'report_to': widget.info['id'],
                                        'report_by': userData!.id,
                                        'message': selectedMessage!['message'],
                                        'report_type': '0',
                                      };
                                      Navigator.pop(context);
                                      var jsonResponse =
                                          await Webservices.postData(
                                              apiUrl: ApiUrls.reportUser,
                                              request: request,
                                              showSuccessMessage: true);
                                    }),
                                vSizedBox2,
                                GestureDetector(
                                  onTap: () {
                                    Navigator.of(context, rootNavigator: true)
                                        .pop();
                                  },
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Text(
                                        'Cancel',
                                        style: TextStyle(
                                            fontFamily: 'regular',
                                            fontSize: 14,
                                            color: Colors.white),
                                      )
                                    ],
                                  ),
                                )
                              ],
                            ),
                          )
                        ],
                      ),
                    );

                    // await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
                    //   return StatefulBuilder(
                    //     builder: (context, setState) {
                    //       return Container(
                    //         height: 500,
                    //         // padding: EdgeInsets.symmetric(horizontal: 16),
                    //         decoration: BoxDecoration(
                    //           color: MyColors.secondary,
                    //           borderRadius: BorderRadius.circular(14),
                    //         ),
                    //         child: Column(
                    //           children: [
                    //             vSizedBox2,
                    //             Padding(
                    //               padding: EdgeInsets.symmetric(horizontal: 16),
                    //               child: SubHeadingText('Please select why you are reporting this user.', color: Colors.white,),
                    //             ),
                    //             vSizedBox2,
                    //             Expanded(
                    //               child: ListView.builder(
                    //                 itemCount: reportReasonsList.length,
                    //                 itemBuilder: (context, index){
                    //                   return GestureDetector(
                    //                     onTap: ()async{
                    //                       selectedMessage = reportReasonsList[index];
                    //                       setState((){});
                    //                       var request = {
                    //                         'report_to': userData!.id,
                    //                         'report_by': userData!.id,
                    //                         'message': selectedMessage!['message'],
                    //                       };
                    //                       Navigator.pop(context);
                    //                       var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.reportUser, request: request, context: MyGlobalKeys.navigatorKey.currentContext!,showSuccessMessage: true );
                    //                     },
                    //                     child: Container(
                    //                       height: 80,
                    //                       color:selectedMessage==reportReasonsList[index]? MyColors.primaryColor: null,
                    //                       margin: EdgeInsets.symmetric(vertical: 4),
                    //                       child: Center(
                    //                         child: ParagraphText(reportReasonsList[index]['message'], color: Colors.white,fontWeight: selectedMessage==reportReasonsList[index]? FontWeight.w700:null,),
                    //                       ),
                    //                     ),
                    //                   );
                    //                 },
                    //               ),
                    //             )
                    //           ],
                    //         ),
                    //       );
                    //     }
                    //   );
                    // });
                  },
                ),
              ];
            },
          ),
        ],
      ),
      body: load
          ? CustomLoader()
          : Stack(
              children: [
                Container(
                  padding: EdgeInsets.only(left: 16, right: 16, bottom: 64),
                  decoration: BoxDecoration(
                      gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
                  )),
                  child: messages.length == 0
                      ? Center(
                          child: ParagraphText(
                            'Send your first message to ${widget.info['name']}',
                            color: Colors.white,
                            textAlign: TextAlign.center,
                          ),
                        )
                      : ListView.builder(
                          itemCount: messages.length,
                          reverse: true,
                          controller: messageScrollController,
                          itemBuilder: (context, index) {
                            bool isOwner =
                                messages[index].senderId == userData!.id;
                            return Padding(
                              padding: const EdgeInsets.only(bottom: 12),
                              child: Stack(
                                clipBehavior: Clip.none,
                                children: [
                                  Row(
                                    mainAxisAlignment: isOwner
                                        ? MainAxisAlignment.end
                                        : MainAxisAlignment.start,
                                    children: [
                                      Container(
                                        margin: EdgeInsets.only(
                                            left: isOwner ? 40 : 12, right: 9),
                                        // width: MediaQuery.of(context).size.width - 60,
                                        padding: messages[index].messageType ==
                                                kMessageType[0]
                                            ? EdgeInsets.only(
                                                left: 16,
                                                right: 16,
                                                top: 4,
                                                bottom: 4)
                                            : EdgeInsets.only(
                                                left: 3,
                                                right: 3,
                                                top: 4,
                                                bottom: 4),
                                        // height: 20,
                                        decoration: BoxDecoration(
                                            color: isOwner
                                                ? Color(0xFF14CBB2)
                                                : Colors.white,
                                            borderRadius: BorderRadius.only(
                                                topLeft: Radius.circular(16),
                                                topRight: Radius.circular(16),
                                                bottomRight: isOwner
                                                    ? Radius.circular(0)
                                                    : Radius.circular(16),
                                                bottomLeft: !isOwner
                                                    ? Radius.circular(0)
                                                    : Radius.circular(16))),
                                        child: messages[index].messageType ==
                                                kMessageType[0]
                                            ? ParagraphText(
                                                '${messages[index].message}',
                                                color: isOwner
                                                    ? MyColors.whiteColor
                                                    : MyColors.primaryColor,
                                                fontSize: 18,
                                              )
                                            : messages[index].messageType ==
                                                    kMessageType[1]
                                                ? CustomCircularImage(
                                                    imageUrl:
                                                        messages[index].message,
                                                    height:
                                                        MediaQuery.of(context)
                                                                .size
                                                                .width -
                                                            120,
                                                    width:
                                                        MediaQuery.of(context)
                                                                .size
                                                                .width -
                                                            120,
                                                    borderRadius: 20)
                                                : messages[index].messageType ==
                                                        kMessageType[2]
                                                    ? Row(
                                                        children: [
                                                          IconButton(
                                                            onPressed:
                                                                () async {
                                                              print(
                                                                  'kjhgkljdshfgkljdsflgjdlf');
                                                              messages[index]
                                                                  .load = true;
                                                              setState(() {});
                                                              File temp = await urlToFile(
                                                                  Uri.parse(messages[
                                                                          index]
                                                                      .message));
                                                              print(
                                                                  'the temp file is cresated ${temp.path}');
                                                              PlayerController
                                                                  abc =
                                                                  PlayerController();
                                                              await abc
                                                                  .preparePlayer(
                                                                      temp.path);

                                                              setState(() {
                                                                messages[index]
                                                                        .load =
                                                                    false;
                                                              });
                                                              await showCustomBottomSheet(
                                                                  context,
                                                                  color: Colors
                                                                      .black,
                                                                  child: StatefulBuilder(
                                                                      builder:
                                                                          (context,
                                                                              setState) {
                                                                return Container(
                                                                  padding: EdgeInsets.symmetric(
                                                                      horizontal:
                                                                          16,
                                                                      vertical:
                                                                          16),
                                                                  height: 120,
                                                                  width: 170,
                                                                  child:
                                                                      WaveBubble(
                                                                    playerController:
                                                                        abc,
                                                                    isPlaying: abc
                                                                            .playerState ==
                                                                        PlayerState
                                                                            .playing,
                                                                    onTap:
                                                                        () async {
                                                                      playOrPlausePlayer(
                                                                          abc);
                                                                      setState(
                                                                          () {});
                                                                    },
                                                                  ),
                                                                );
                                                              }), height: null);
                                                              abc.dispose();
                                                              // abc= null;
                                                            },
                                                            icon: messages[
                                                                        index]
                                                                    .load
                                                                ? CustomLoader()
                                                                : Icon(
                                                                    Icons
                                                                        .play_arrow,
                                                                    color: isOwner
                                                                        ? Colors
                                                                            .white
                                                                        : Colors
                                                                            .black,
                                                                  ),
                                                          ),
                                                          // hSizedBox,
                                                          // Container(
                                                          //   width:180 ,
                                                          //   child: LinearProgressIndicator(
                                                          //     value: 0.5,
                                                          //   ),
                                                          // ),
                                                          // hSizedBox,
                                                          ParagraphText(
                                                            isOwner
                                                                ? 'You sent a audio message  '
                                                                : '${widget.info['name']} sent you a audio message  ',
                                                            color: isOwner
                                                                ? Colors.white
                                                                : MyColors
                                                                    .primaryColor,
                                                          ),
                                                        ],
                                                      )
                                                    : messages[index]
                                                                .messageType ==
                                                            kMessageType[3]
                                                        ? GestureDetector(
                                                            onTap: () {
                                                              push(
                                                                  context:
                                                                      context,
                                                                  screen: PlayVideoPage(
                                                                      url: messages[
                                                                              index]
                                                                          .message));
                                                              // push(
                                                              //     context: context,
                                                              //     screen: ViewStoryPage(
                                                              //       stories: my_stories,
                                                              //       selectedIndex: i, userId: userData!.id,
                                                              //     ));
                                                            },
                                                            child: Stack(
                                                              children: [
                                                                CustomCircularImage(
                                                                    imageUrl:
                                                                        messages[index].thumbnail ??
                                                                            '',
                                                                    height: MediaQuery.of(context)
                                                                            .size
                                                                            .width -
                                                                        120,
                                                                    width: MediaQuery.of(context)
                                                                            .size
                                                                            .width -
                                                                        120,
                                                                    borderRadius:
                                                                        20),
                                                                Positioned(
                                                                  top: 0,
                                                                  right: 0,
                                                                  left: 0,
                                                                  bottom: 0,
                                                                  child: Center(
                                                                    child:
                                                                        Container(
                                                                      padding:
                                                                          EdgeInsets.all(
                                                                              8),
                                                                      decoration: BoxDecoration(
                                                                          color: Colors
                                                                              .white,
                                                                          borderRadius:
                                                                              BorderRadius.circular(50)),
                                                                      child:
                                                                          Icon(
                                                                        Icons
                                                                            .play_arrow,
                                                                        size:
                                                                            40,
                                                                        color: Colors
                                                                            .grey,
                                                                      ),
                                                                    ),
                                                                  ),
                                                                )
                                                              ],
                                                            ),
                                                          )
                                                        :
                                                        // ParagraphText('this is my video'):
                                                        Column(
                                                            mainAxisSize:
                                                                MainAxisSize
                                                                    .min,
                                                            children: [
                                                              CustomCircularImage(
                                                                  imageUrl: messages[
                                                                              index]
                                                                          .giftData![
                                                                      'image'],
                                                                  height: 80,
                                                                  width: 80,
                                                                  borderRadius:
                                                                      20),
                                                              vSizedBox05,
                                                              ParagraphText(
                                                                isOwner
                                                                    ? 'You sent a gift'
                                                                    : '${widget.info['name']} sent you a gift',
                                                                color: isOwner
                                                                    ? Colors
                                                                        .white
                                                                    : MyColors
                                                                        .primaryColor,
                                                              ),
                                                            ],
                                                          ),
                                      ),
                                    ],
                                  ),
                                  Positioned(
                                      right: isOwner ? 1 : null,
                                      left: !isOwner ? 1 : null,
                                      bottom: -0.10,
                                      child: Image.asset(
                                        isOwner
                                            ? MyImages.ownerChatSideIcon
                                            : MyImages.notOwnerChatSideIcon,
                                        height: 20,
                                      )),
                                ],
                              ),
                            );
                          },
                        ),
                ),
                Positioned(
                  bottom: 16,
                  right: 16,
                  left: 16,
                  child: Row(
                    children: [
                      IconButton(
                        onPressed: () async {
                          showCustomBottomSheet(
                            context,
                            height: null,
                            child: Padding(
                              padding:
                                  const EdgeInsets.symmetric(horizontal: 32),
                              child: Column(
                                mainAxisSize: MainAxisSize.min,
                                children: [
                                  GestureDetector(
                                    onTap: () async {
                                      File? file = await pickImage(false);
                                      if (file != null) {
                                        Navigator.pop(context);
                                        setState(() {
                                          load = true;
                                        });
                                        await sendMessage(
                                            file: file,
                                            messageType: kMessageType[1]);
                                        setState(() {
                                          load = false;
                                        });
                                      }
                                    },
                                    child: Row(
                                      children: [
                                        Icon(Icons.camera_alt),
                                        hSizedBox,
                                        SubHeadingText('Open Camera'),
                                      ],
                                    ),
                                  ),
                                  vSizedBox,
                                  Divider(),
                                  vSizedBox,
                                  GestureDetector(
                                      onTap: () async {
                                        File? file = await pickImage(true);
                                        if (file != null) {
                                          Navigator.pop(context);
                                          setState(() {
                                            load = true;
                                          });
                                          await sendMessage(
                                              file: file,
                                              messageType: kMessageType[1]);
                                          setState(() {
                                            load = false;
                                          });
                                        }
                                      },
                                      child: Row(
                                        children: [
                                          Icon(Icons.image),
                                          hSizedBox,
                                          SubHeadingText('Select From Gallery'),
                                        ],
                                      )),
                                  vSizedBox,
                                  Divider(),
                                  vSizedBox,
                                  GestureDetector(
                                      onTap: () async {
                                        File? videoFile;
                                        int duration = 0;

                                        // videoFile = await pickVideo(isGallery: false);
                                        videoFile = await push(
                                            context: context,
                                            screen: RecordVideoScreen());
                                        if (videoFile != null) {
                                          setState(() {
                                            addStoryLoad = true;
                                          });
                                          VideoPlayerController controller =
                                              VideoPlayerController.file(
                                                  videoFile);
                                          await controller.initialize();
                                          duration = controller
                                              .value.duration.inSeconds;
                                          print(
                                              'the duration iss is $duration');

                                          // try{
                                          //   controller.dispose();
                                          // }catch(e){
                                          //   print('Error in catch block $e');
                                          // }
                                          if (duration < 5) {
                                            presentToast(
                                                'Video Length too short');
                                          } else if (duration > 30) {
                                            presentToast(
                                                'Video Length must be less than 30 secs');
                                          } else {
                                            var request = {
                                              'sender': userData!.id,
                                              'receiver': widget.info['id'],
                                            };

                                            await push(
                                                context: context,
                                                screen: StoryPreviewPage(
                                                  storyFile: videoFile,
                                                  controller: controller,
                                                  request: request,
                                                  fromChatPage: true,
                                                ));
                                            // get_my_stories();
                                          }

                                          controller.dispose();
                                          setState(() {
                                            addStoryLoad = false;
                                          });
                                        } else {
                                          print('the selected video is null');
                                        }
                                        Navigator.pop(context);
                                        // showCustomBottomSheet(
                                        //   context,
                                        //   height: null,
                                        //   child: Padding(
                                        //     padding: const EdgeInsets.symmetric(horizontal: 32),
                                        //     child: Column(
                                        //       mainAxisSize: MainAxisSize.min,
                                        //       children: [
                                        //         GestureDetector(
                                        //           onTap: () async{
                                        //             File? file = await pickVideo(isGallery: false);
                                        //             if(file!=null){
                                        //               Navigator.pop(context);
                                        //               setState(() {
                                        //                 load = true;
                                        //               });
                                        //               await sendMessage(file: file, messageType: kMessageType[3]);
                                        //               setState(() {
                                        //                 load = false;
                                        //               });
                                        //             }
                                        //           },
                                        //           child: Row(
                                        //
                                        //             children: [
                                        //               Icon(Icons.camera_alt),
                                        //               hSizedBox,
                                        //               SubHeadingText(
                                        //                   'Open Camera'),
                                        //             ],
                                        //           ),
                                        //         ),
                                        //         vSizedBox,
                                        //         Divider(),
                                        //         vSizedBox,
                                        //         GestureDetector(
                                        //             onTap: () async{
                                        //               File? file = await pickVideo(isGallery: true);
                                        //               if(file!=null){
                                        //                 Navigator.pop(context);
                                        //                 setState(() {
                                        //                   load = true;
                                        //                 });
                                        //                await sendMessage(file: file, messageType: kMessageType[3]);
                                        //                setState(() {
                                        //                  load = false;
                                        //                });
                                        //
                                        //               }
                                        //             },
                                        //             child: Row(
                                        //               children: [
                                        //                 Icon(Icons.image),
                                        //                 hSizedBox,
                                        //                 SubHeadingText(
                                        //                     'Select From Gallery'),
                                        //               ],
                                        //             )),
                                        //       ],
                                        //     ),
                                        //   ),
                                        // );
                                      },
                                      child: Row(
                                        children: [
                                          Icon(Icons.video_camera_back_sharp),
                                          hSizedBox,
                                          SubHeadingText('Select Video'),
                                        ],
                                      )),
                                ],
                              ),
                            ),
                          );
                        },
                        icon: Icon(
                          Icons.camera_alt,
                          color: Colors.white,
                        ),
                      ),

                      // IconButton(
                      //   onPressed: ()
                      //   icon: Icon(Icons.video_camera_back_sharp,
                      //     color: Colors.white,
                      //   ),
                      // ),

                      Expanded(
                          child: CustomTextField(
                        preffix: userData!.gender == UserGender.female
                            ? null
                            : Padding(
                                padding: const EdgeInsets.symmetric(
                                    vertical: 10.0, horizontal: 0),
                                child: GestureDetector(
                                  onTap: () {
                                    showModalBottomSheet(
                                        context: context,
                                        isScrollControlled: true,
                                        builder: (context) {
                                          return Container(
                                            padding: EdgeInsets.all(16),
                                            height: 420,
                                            child: Column(
                                              children: [
                                                vSizedBox,
                                                SubHeadingText(
                                                    'If you send gifts, abc will see your messages first'),
                                                vSizedBox2,
                                                Expanded(
                                                  child: Container(
                                                    width:
                                                        MediaQuery.of(context)
                                                            .size
                                                            .width,
                                                    child: GridView(
                                                      gridDelegate:
                                                          SliverGridDelegateWithFixedCrossAxisCount(
                                                              crossAxisCount: 2,
                                                              childAspectRatio:
                                                                  1.2),
                                                      scrollDirection:
                                                          Axis.horizontal,
                                                      children: [
                                                        for (int index = 0;
                                                            index <
                                                                giftsList
                                                                    .length;
                                                            index++)
                                                          GestureDetector(
                                                            onTap: () async {
                                                              var request = {
                                                                // 'user_id': userData!['id'],
                                                                'send_by':
                                                                    userData!
                                                                        .id,
                                                                'send_to':
                                                                    widget.info[
                                                                        'id'],
                                                                'gift_id':
                                                                    giftsList[
                                                                            index]
                                                                        ['id'],
                                                                'coins': giftsList[
                                                                        index][
                                                                    'coin_value'],
                                                              };
                                                              loadingShow(
                                                                  context);
                                                              var jsonResponse =
                                                                  await Webservices
                                                                      .postData(
                                                                apiUrl: ApiUrls
                                                                    .sendGifts,
                                                                request:
                                                                    request,
                                                              );
                                                              loadingHide(
                                                                  context);
                                                              if (jsonResponse[
                                                                          'status']
                                                                      .toString() ==
                                                                  '1') {
                                                                showSnackbar(
                                                                    jsonResponse[
                                                                        'message']);
                                                                Navigator.pop(
                                                                    context);
                                                                MyLocalServices.updateUserDataFromServer(
                                                                    userId:
                                                                        userData!
                                                                            .id,
                                                                    apiUrl: ApiUrls
                                                                        .getUserData);
                                                                setState(() {});
                                                              } else {}
                                                            },
                                                            child: Padding(
                                                              padding:
                                                                  const EdgeInsets
                                                                      .all(8.0),
                                                              child: Column(
                                                                children: [
                                                                  CustomCircularImage(
                                                                    imageUrl: giftsList[
                                                                            index]
                                                                        [
                                                                        'image'],
                                                                    height: 65,
                                                                    width: 65,
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
                                                        Icon(Icons.circle,
                                                            color: MyColors
                                                                .yelloew),
                                                        hSizedBox05,
                                                        ParagraphText(userData!
                                                            .coins
                                                            .toString()),
                                                      ],
                                                    ),
                                                    RoundEdgedButton(
                                                      text: 'Get more coins',
                                                      width: 155,
                                                      onTap: (){
                                                        push(context: context, screen: Get_Coins_Page());
                                                      },
                                                    ),
                                                  ],
                                                )
                                              ],
                                            ),
                                          );
                                        });
                                  },
                                  child: ClipRRect(
                                    borderRadius: BorderRadius.circular(70),
                                    child: Image.asset(
                                      MyImages.giftIcon,
                                      height: 30,
                                      width: 30,
                                    ),
                                  ),
                                ),
                              ),
                        verticalPadding: 0,
                        controller: messageController,
                        fontsize: 14,
                        bgColor: Colors.white,
                        hintText: 'Type a message',
                        hintcolor: Colors.black,
                        borderRadius: 30,
                        border: Border.all(color: Color(0xFF7D44CF)),
                      )),
                      // hSizedBox,
                      IconButton(
                        onPressed: () async {
                          // if(messageController.text==''){
                          //   showSnackbar('Please type something');
                          // }else{
                          //   sendMessage(message: messageController.text);
                          //   messageController.clear();
                          // }

                          FocusScope.of(context).requestFocus(new FocusNode());

                          try {
                            File? file = await showCustomBottomSheet(context,
                                child: RecordAudioBottomSheet(), height: null);
                            if (file != null) {
                              PlayerController playerController =
                                  PlayerController();
                              await playerController.preparePlayer(file.path);

                              Navigator.pop(context);
                              setState(() {
                                load = true;
                              });
                              await sendMessage(
                                  file: file, messageType: kMessageType[2]);
                              setState(() {
                                load = false;
                              });
                              // myQuestions[index]['hintText'] = '';
                            }
                          } catch (e) {
                            print('Error in catch block 45 $e');
                          }
                          setState(() {});
                        },
                        icon: Icon(
                          Icons.mic,
                          color: Colors.white,
                        ),
                      ),
                      IconButton(
                        onPressed: () async {
                          if (messageController.text == '') {
                            showSnackbar('Please type something');
                          } else {
                            sendMessage(
                                message: messageController.text,
                                messageType: kMessageType[0]);
                            messageController.clear();
                          }
                        },
                        icon: Icon(
                          Icons.send,
                          color: Colors.white,
                        ),
                      ),
                    ],
                  ),
                )
              ],
            ),
    );
  }
}
