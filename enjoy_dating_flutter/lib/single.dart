import 'dart:developer';

import 'package:Enjoy/chat.dart';
import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/follower_list.dart';
import 'package:Enjoy/following_list.dart';
import 'package:Enjoy/modals/media_modal.dart';
import 'package:Enjoy/pages/call_history_page.dart';
import 'package:Enjoy/pages/chat_page.dart';
import 'package:Enjoy/pages/gifts_sent_page.dart';
import 'package:Enjoy/pages/photos_page.dart';
import 'package:Enjoy/pages/view_story_page.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/video_call_page.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/video_call.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/block_layout.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';
import 'dialogs/showFeedbackDialog.dart';
import 'modals/user_modal.dart';

class Single_Page extends StatefulWidget {
  final String user_id;
  const Single_Page({Key? key,required this.user_id}) : super(key: key);
  @override
  _Single_PageState createState() => _Single_PageState();
}

class _Single_PageState extends State<Single_Page> {
  Map info = {};
  bool load = false;
  List my_stories = [];
  Map? selectedMessage = reportReasonsList[0];

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    print('user_id------${widget.user_id}');
    get_info();
    get_stories();
  }

  get_info() async {
    setState(() {
      load = true;
    });
    Map data = {'user_id': widget.user_id,'session_userid': userData?.id};
    Map res = await getData(data, 'get_user_profile', 0, 0);
    print('res--------$res');
    if (res['status'].toString() == '1') {
      info = res['data'];
    }
    setState(() {
      load = false;
    });
  }

  get_stories() async {
    Map data = {
      // 'user_id': await getCurrentUserId(),
      'user_id': widget.user_id,
    };
    Map res = await getData(data, 'myStoryList', 0, 0);
    print('my stories------$res');
    if (res['status'].toString() == '1') {
      my_stories = res['data'];
      setState(() {});
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.secondary,
      body: load
          ? CustomLoader()
          : Stack(
              children: [
                SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Stack(
                        children: [
                          Image.network(
                            info['image'],
                            height: 390,
                            width: MediaQuery.of(context).size.width,
                            fit: BoxFit.cover,
                          ),
                          Positioned(
                              top: 30,
                              child: IconButton(
                                  onPressed: () {
                                    Navigator.pop(context);
                                  },
                                  icon: Icon(
                                    Icons.arrow_back_ios_new,
                                    size: 20,
                                    color: Colors.white,
                                  ))),

                          Positioned(
                              right: 10,
                              top: 30,
                              child: PopupMenuButton(
                                // initialValue: '1',
                                child: Center(
                                    child:Icon(Icons.more_vert,color: Colors.white,)),
                                itemBuilder: (context) {
                                  return [
                                    PopupMenuItem(
                                      value: '1',
                                      child: Text(info['is_blocked'].toString()=='1'?'Unblock':'Block',style: TextStyle(color: Colors.red),),
                                      onTap: () async{
                                        String api = info['is_blocked'].toString()=='1'?'unblockUser':'blockUser';
                                        Map data = {
                                          'blocked_by':  userData?.id,
                                          'blocked_to':widget.user_id,
                                        };
                                        loadingShow(context);
                                        Map res = await getData(data,api, 0, 0);
                                        loadingHide(context);
                                        print('----$res');
                                        if(res['status'].toString()=='1'){
                                          Navigator.pop(context);
                                        }
                                      },
                                    ),
                                    PopupMenuItem(
                                      value: '2',
                                      child: Text('Report',style: TextStyle(color: Colors.red),),
                                      onTap: () async{
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
                                                   boxShadow: [BoxShadow(
                                                       color: Color(0xFE1CDBC1).withOpacity(0.5),
                                                       spreadRadius: 10
                                                   )]
                                               ),
                                               child: Column(
                                                 children: [
                                                   Row(
                                                     children: [
                                                       Text('Report', style: TextStyle(fontFamily: 'extrabold', color: Colors.white, fontSize: 35),)
                                                     ],
                                                     mainAxisAlignment: MainAxisAlignment.center,
                                                   ),
                                                   vSizedBox4,
                                                   Row(
                                                     children: [
                                                       Text('Select Reason: ', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 12),),
                                                     ],
                                                     mainAxisAlignment: MainAxisAlignment.start,
                                                   ),
                                                   vSizedBox,
                                                   Container(
                                                     child: DropdownButtonHideUnderline(
                                                       child: DropdownButton(
                                                         value: selectedMessage,
                                                         icon: const Icon(Icons.keyboard_arrow_down_rounded),
                                                         elevation: 16,
                                                         style: const TextStyle(color: Colors.black),
                                                         onChanged: (Map? newValue) {
                                                           setState(() {
                                                             selectedMessage = newValue!;
                                                           });
                                                         },
                                                         items: List.generate(reportReasonsList.length, (index) => DropdownMenuItem<Map>(
                                                           value: reportReasonsList[index],
                                                           child: Text(reportReasonsList[index]['message']),
                                                         ),),
                                                         isExpanded: true,
                                                       ),
                                                     ),
                                                     padding: EdgeInsets.symmetric(vertical: 5, horizontal: 10),
                                                     decoration: ShapeDecoration(
                                                       color: Colors.white,
                                                       shape: RoundedRectangleBorder(
                                                         borderRadius: BorderRadius.all(Radius.circular(100)),
                                                       ),
                                                     ),
                                                   ),
                                                   vSizedBox4,
                                                   SolidBtn(BtnText: 'Submit Report', BgColorTop: Colors.redAccent, BgColorBottom: Colors.red, ShadowColor: Color(0xFE1CDBC1), funcTap: ()async{
                                                     setState((){});
                                                     var request = {
                                                       'report_to': widget.user_id,
                                                       'report_by': userData!.id,
                                                       'message': selectedMessage!['message'],
                                                       'report_type': '0',
                                                     };
                                                     Navigator.pop(context);
                                                     var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.reportUser, request: request,showSuccessMessage: true );
                                                   }),
                                                   vSizedBox2,
                                                   GestureDetector(
                                                     onTap: (){Navigator.of(context, rootNavigator: true).pop();},
                                                     child: Row(
                                                       mainAxisAlignment: MainAxisAlignment.center,
                                                       children: [
                                                         Text('Cancel', style: TextStyle(fontFamily: 'regular', fontSize: 14, color: Colors.white),)
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

                          ),
                          Positioned(
                            bottom: 5.0,
                              child:Container(
                                padding: EdgeInsets.all(10.0),
                                width: MediaQuery.of(context).size.width,
                                height: 80,
                                color: MyColors.blackColor.withOpacity(0.5),
                              child: Row(
                                children: [
                                  GestureDetector(
                                    behavior: HitTestBehavior.translucent,
                                    onTap:(){
                                      Navigator.push(context, MaterialPageRoute(builder: (context) => (
                                          Following_list(user_id: widget.user_id.toString(),)
                                      )));
                                    },
                                    child:Column(
                                      crossAxisAlignment: CrossAxisAlignment.center,
                                      children: [
                                        ParagraphText('${info['following']}', fontSize: 16, fontFamily: 'bold', color: MyColors.whiteColor,),
                                        vSizedBox05,
                                        ParagraphText('Following',
                                          fontSize: 16,
                                          fontFamily: 'light',
                                          color: Colors.white,),
                                      ],
                                    ),
                                  ),
                                  hSizedBox8,
                                  GestureDetector(
                                    behavior: HitTestBehavior.translucent,
                                    onTap: () {
                                      Navigator.push(context, MaterialPageRoute(builder: (context) => (
                                          Follower_list(user_id: widget.user_id.toString(),)
                                      )));
                                    },
                                    child:Column(
                                      crossAxisAlignment: CrossAxisAlignment.center,
                                      children: [
                                        ParagraphText('${info['follower'].toString()}', fontSize: 16, fontFamily: 'bold', color: MyColors.whiteColor,),
                                        vSizedBox05,
                                        ParagraphText('Followers',
                                          fontSize: 16,
                                          fontFamily: 'light',
                                          color: Colors.white,),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              // decoration: (),
                          )),
                          if(info['is_follow'].toString()=='0'&&userData!.id!=widget.user_id)
                          Positioned(
                              bottom: 15.0,
                              right: 10.0,
                              child: RoundEdgedButton(
                                text: 'Follow',
                                shadow: 0,
                                width: 100,
                                onTap: () async{
                                  setState(() {
                                    info['is_follow']='1';
                                    info['follower']= int.parse(info['follower'].toString()) + 1;
                                  });
                                  Map data = {
                                    'follow_by': userData?.id,
                                    'follow_to':widget.user_id,
                                  };
                                  Map res = await getData(data,'startFollow',0,0);
                                  print('follow------$res');

                                },
                              )),
                          if(info['is_follow'].toString()=='1'&&userData!.id!=widget.user_id)
                            Positioned(
                                bottom: 15.0,
                                right: 10.0,
                                child: RoundEdgedButton(
                                  text: 'Unfollow',
                                  shadow: 0,
                                  width: 100,
                                  onTap: () async{
                                    setState(() {
                                      info['is_follow']='0';
                                      info['follower']= int.parse(info['follower'].toString()) - 1;
                                    });
                                    Map data = {
                                      'follow_by': userData?.id,
                                      'follow_to':widget.user_id,
                                    };
                                    Map res = await getData(data,'startUnFollow',0,0);
                                    print('follow------$res');

                                  },
                                )),


                          /// this is commented as per client feedback sept 19 2022
                          if(userData!.gender==UserGender.male &&userData!.gender!=UserGender.male)
                          Positioned(
                            right: 16,
                              top: 64,
                            child: GestureDetector(
                              onTap: (){
                                print('hellowoore');
                                log(giftsList.toString());
                                showModalBottomSheet(context: context,isScrollControlled: true, builder: (context){
                                  return Container(
                                    padding: EdgeInsets.all(16),
                                    height: 375,
                                    child: Column(
                                      children: [
                                        vSizedBox,
                                        SubHeadingText('If you send gifts, abc will see your messages first'),
                                        vSizedBox2,
                                        Expanded(
                                          child: Container(
                                            width: MediaQuery.of(context).size.width,
                                            child: GridView(
                                              gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 2, childAspectRatio: 1.2),
                                              scrollDirection: Axis.horizontal,
                                              children: [
                                                for(int index = 0;index<giftsList.length;index++)
                                                  GestureDetector(
                                                    onTap: ()async{
                                                      var request = {
                                                        // 'user_id': userData!['id'],
                                                        'send_by': userData!.id,
                                                        'send_to': widget.user_id,
                                                        'gift_id': giftsList[index]['id'],
                                                        'coins': giftsList[index]['coin_value'],
                                                      };
                                                      loadingShow(context);
                                                      var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.sendGifts, request: request, );
                                                      loadingHide(context);
                                                      if(jsonResponse['status'].toString()=='1'){
                                                        presentToast(jsonResponse['message']);
                                                        Navigator.pop(context);
                                                        MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);
                                                        setState(() {

                                                        });
                                                      }else{

                                                      }
                                                    },
                                                    child: Padding(
                                                      padding: const EdgeInsets.all(8.0),
                                                      child: Column(
                                                        children: [
                                                          CustomCircularImage(imageUrl: giftsList[index]['image'], height: 65, width: 65,),
                                                          vSizedBox05,
                                                          ParagraphText('${giftsList[index]['coin_value']}')
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
                                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                          children: [
                                            Row(
                                              children: [
                                                Icon(Icons.circle, color: MyColors.yelloew),
                                                hSizedBox05,
                                                ParagraphText(userData!.coins.toString()),
                                              ],
                                            ),
                                            RoundEdgedButton(text: 'Get more coins', width: 120,)
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
                                  height: 50,
                                  width: 50,
                                ),
                              ),
                            ),
                          ),
                          // if(userData!.gender==UserGender.female)
                          //   Positioned(
                          //     right: 16,
                          //     top: 64,
                          //     child: GestureDetector(
                          //       onTap: (){
                          //        push(context: context, screen: GiftsReceivedPage(userId: widget.user_id,));
                          //       },
                          //       child: ClipRRect(
                          //         borderRadius: BorderRadius.circular(70),
                          //         child: Image.asset(
                          //           MyImages.giftIcon,
                          //           height: 50,
                          //           width: 50,
                          //         ),
                          //       ),
                          //     ),
                          //   ),

                        ],
                      ),
                      Transform.translate(
                        offset: Offset(0, -20),

                        child: Container(
                          // height: MediaQuery.of(context).size.height-100,
                          padding: EdgeInsets.all(16),
                          decoration: BoxDecoration(
                              color: MyColors.secondary,
                              borderRadius: BorderRadius.only(
                                  topLeft: Radius.circular(20),
                                  topRight: Radius.circular(20))),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Row(
                                children: [
                                  Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      ParagraphText(
                                        '${info['name']}',
                                        fontSize: 26,
                                        fontFamily: 'bold',
                                        color: Colors.white,
                                      ),
                                      vSizedBox05,
                                      ParagraphText(
                                        '${info['country'] ?? ''}',
                                        fontSize: 18,
                                        fontFamily: 'regular',
                                        color: Colors.white,
                                      ),
                                    ],
                                  ),
                                  hSizedBox,
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.end,
                                      children: [
                                        GestureDetector(
                                          onTap:()async{
                                            // push(context: context, screen: VideoCallPage());
                                            await push(context: context, screen: VideoCallScreen(name: info['name'],userId: info['id'],isFollow: info['is_follow'].toString(),image: info['image'],age: info['age'].toString(),));
                                            if(!userData!.hasRated){
                                              showCustomDialog(FeedBackDialog());
                                            }
                                  },
                                          child: Image.asset(
                                            'assets/video_sec.png',
                                            height: 42,
                                          ),
                                        ),
                                        // hSizedBox,
                                        // GestureDetector(
                                        //   onTap: ()async{
                                        //     push(context: context, screen: CallHistoryPage());
                                        //
                                        //   },
                                        //   child: Image.asset(
                                        //     'assets/chat_sec.png',
                                        //     height: 42,
                                        //   ),
                                        // ),
                                        hSizedBox,
                                        GestureDetector(
                                          onTap: ()async{
                                            // push(context: context, screen: Chat_Detail_Page());
                                            push(context: context, screen: ChatPage(info: info,));
                                          },
                                          child: Image.asset(
                                            'assets/chat_sec.png',
                                            height: 42,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              vSizedBox2,
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  ParagraphText(
                                    'About',
                                    fontSize: 16,
                                    fontFamily: 'bold',
                                    color: MyColors.primaryColor,
                                  ),
                                  vSizedBox05,
                                  ParagraphText(
                                    '${info['about'] ?? ''}',
                                    fontSize: 16,
                                    fontFamily: 'light',
                                    color: Colors.white,
                                  ),
                                ],
                              ),
                              vSizedBox2,
                              ParagraphText(
                                'Stories',
                                fontSize: 16,
                                fontFamily: 'bold',
                                color: MyColors.primaryColor,
                              ),
                              vSizedBox,
                              Row(
                                children: [
                                  // for (int i = 0; i < my_stories.length; i++)
                                  //   if (my_stories[i]['file_type'] == 'image')
                                  //     Padding(
                                  //       padding: const EdgeInsets.all(8.0),
                                  //       child: Container(
                                  //         decoration: BoxDecoration(
                                  //             borderRadius:
                                  //                 BorderRadius.circular(50),
                                  //             color: Colors.white,
                                  //             border: Border.all(
                                  //                 color:
                                  //                     MyColors.primaryColor,
                                  //                 width: 2)),
                                  //         padding: EdgeInsets.all(2),
                                  //         child: CustomCircleAvatar(
                                  //           imageUrl: my_stories[i]['file'],
                                  //         ),
                                  //       ),
                                  //     ),
                                  if (my_stories.length == 0)
                                    Expanded(
                                      child: Center(
                                        child: Text(
                                          'No stories yet.',
                                          style: TextStyle(color: Colors.white),
                                        ),
                                      ),
                                    )
                                  else
                                  Expanded(
                                    child: Container(
                                      height: 75,
                                      child: ListView(
                                        scrollDirection: Axis.horizontal,
                                        children: <Widget>[
                                          for (int i = 0; i < my_stories.length; i++)
                                            GestureDetector(
                                              onTap: () {
                                                push(context: context, screen: ViewStoryPage(stories: my_stories,selectedIndex: i,userId: info['id'],));
                                                // push(
                                                //     context: context,
                                                //     screen: view_story(
                                                //       stories: my_stories,
                                                //       index: i,
                                                //     )).then((val) => {
                                                //       get_my_stories(),
                                                //     });
                                              },
                                              child: Padding(
                                                padding:
                                                const EdgeInsets.only(left: 5.0),
                                                child: Container(
                                                  width:75 ,
                                                  decoration: BoxDecoration(
                                                      borderRadius:
                                                      BorderRadius.circular(50),
                                                      color: Colors.white,
                                                      border: Border.all(
                                                          color:
                                                          MyColors.primaryColor,
                                                          width: 2)),
                                                  padding: EdgeInsets.all(2),
                                                  child: ClipRRect(
                                                    clipBehavior: Clip.hardEdge,
                                                    child: Image.network(
                                                      my_stories[i]['thumbnail']??'',
                                                      fit: BoxFit.cover,),

                                                    borderRadius:
                                                    BorderRadius.circular(50),
                                                  ),
                                                ),
                                              ),
                                            ),
                                        ],
                                      ),
                                    ),
                                  ),

                                ],
                              ),
                              vSizedBox2,
                              ParagraphText(
                                'All Photos',
                                fontSize: 16,
                                fontFamily: 'bold',
                                color: MyColors.primaryColor,
                              ),
                              vSizedBox,
                         Wrap(
                           children: [
                             for (int i = 0;
                             i < info['gallery'].length;
                             i++)
                               GestureDetector(
                                 onTap: (){
                                   print(info['gallery']);
                                   List<ImageModal> media = [];
                                   (info['gallery'] as List).forEach((element) {
                                     media.add(ImageModal.fromJson(element));
                                   });
                                   push(context: context, screen: PhotosPage(images: media, selectedIndex: i));
                                 },
                                 child: Container(
                                   clipBehavior: Clip.hardEdge,
                                   padding: EdgeInsets.all(4.0),
                                   // width: double.infinity,
                                   height: (MediaQuery.of(context).size.width / 3 - 20),
                                   // height:200,
                                   decoration: BoxDecoration(
                                     // color: Colors.grey,
                                       borderRadius: BorderRadius.circular(24)),
                                   child:  Image.network(
                                     info['gallery'][i]['images'],
                                     fit: BoxFit.cover,
                                     height: 200,
                                     width: 100,
                                   ), ),
                               ),
                           ],
                         ),
                              if (info['gallery'].length == 0)
                                Center(
                                  child: new Text(
                                    'No photos yet.',
                                    style: TextStyle(color: Colors.white),
                                  ),
                                ),
                          // Row(
                          //       children: [
                          //         for (int i = 0;
                          //             i < info['gallery'].length;
                          //             i++)
                          //           Expanded(
                          //             child: Container(
                          //               margin: EdgeInsets.all(10.0),
                          //               decoration: BoxDecoration(
                          //                   borderRadius:
                          //                       BorderRadius.circular(5),
                          //                   color: Colors.white,
                          //                   border: Border.all(
                          //                       color: MyColors.primaryColor,
                          //                       width: 2)),
                          //               // padding: EdgeInsets.all(2),
                          //               child: ClipRRect(
                          //                   borderRadius:
                          //                       BorderRadius.circular(5),
                          //                   child: Image.network(
                          //                     info['gallery'][i]['images'],
                          //                     fit: BoxFit.cover,
                          //                   )),
                          //             ),
                          //           ),
                          //         if (info['gallery'].length == 0)
                          //           Center(
                          //             child: new Text('No photos yet.',
                          //                 style:
                          //                     TextStyle(color: Colors.white)),
                          //           ),
                          //       ],
                          //     ),
                              // vSizedBox,
                              // Row(
                              //   children: [
                              //     Expanded(
                              //       child: Container(
                              //         decoration: BoxDecoration(
                              //             borderRadius: BorderRadius.circular(5),
                              //             color: Colors.white,
                              //             border: Border.all(
                              //                 color: MyColors.primaryColor,
                              //                 width: 2)),
                              //         // padding: EdgeInsets.all(2),
                              //         child: ClipRRect(
                              //             borderRadius: BorderRadius.circular(5),
                              //             child: Image.asset(
                              //               'assets/chat_person.png',
                              //               fit: BoxFit.cover,
                              //             )),
                              //       ),
                              //     ),
                              //     hSizedBox,
                              //     Expanded(
                              //       child: Container(
                              //         decoration: BoxDecoration(
                              //             borderRadius: BorderRadius.circular(5),
                              //             color: Colors.white,
                              //             border: Border.all(
                              //                 color: MyColors.primaryColor,
                              //                 width: 2)),
                              //         // padding: EdgeInsets.all(2),
                              //         child: ClipRRect(
                              //             borderRadius: BorderRadius.circular(5),
                              //             child: Image.asset(
                              //               'assets/chat_person.png',
                              //               fit: BoxFit.cover,
                              //             )),
                              //       ),
                              //     ),
                              //     hSizedBox,
                              //     hSizedBox,
                              //     Expanded(
                              //       child: Container(
                              //         decoration: BoxDecoration(
                              //             borderRadius: BorderRadius.circular(5),
                              //             color: Colors.white,
                              //             border: Border.all(
                              //                 color: MyColors.primaryColor,
                              //                 width: 2)),
                              //         // padding: EdgeInsets.all(2),
                              //         child: ClipRRect(
                              //             borderRadius: BorderRadius.circular(5),
                              //             child: Image.asset(
                              //               'assets/chat_person.png',
                              //               fit: BoxFit.cover,
                              //             )),
                              //       ),
                              //     ),
                              //   Expanded(
                              //       child: Container(
                              //         decoration: BoxDecoration(
                              //             borderRadius: BorderRadius.circular(5),
                              //             color: Colors.white,
                              //             border: Border.all(
                              //                 color: MyColors.primaryColor,
                              //                 width: 2)),
                              //         // padding: EdgeInsets.all(2),
                              //         child: ClipRRect(
                              //             borderRadius: BorderRadius.circular(5),
                              //             child: Image.asset(
                              //               'assets/chat_person.png',
                              //               fit: BoxFit.cover,
                              //             )),
                              //       ),
                              //     ),
                              //     hSizedBox,
                              //     Expanded(
                              //       child: Container(
                              //         decoration: BoxDecoration(
                              //             borderRadius: BorderRadius.circular(5),
                              //             color: Colors.white,
                              //             border: Border.all(
                              //                 color: MyColors.primaryColor,
                              //                 width: 2)),
                              //         // padding: EdgeInsets.all(2),
                              //         child: ClipRRect(
                              //             borderRadius: BorderRadius.circular(5),
                              //             child: Image.asset(
                              //               'assets/chat_person.png',
                              //               fit: BoxFit.cover,
                              //             )),
                              //       ),
                              //     ),
                              //   ],
                              // ),
                            ],
                          ),
                        ),
                      )
                    ],
                  ),
                ),
              ],
            ),

    );
  }



}
