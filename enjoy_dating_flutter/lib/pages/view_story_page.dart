import 'dart:developer';

import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:flutter/material.dart';
import 'package:story_view/story_view.dart';

import '../constants/colors.dart';
import '../constants/global_data.dart';
import '../constants/image_urls.dart';
import '../constants/sized_box.dart';
import '../services/alert.dart';
import '../services/api_urls.dart';
import '../services/common_functions.dart';
import '../services/localServices.dart';
import '../services/webservices.dart';
import '../widget/custom_circular_image.dart';
import '../widget/round_edged_button.dart';
import '../widget/solidBtn.dart';

class ViewStoryPage extends StatefulWidget {
  final List stories;
  final String userId;

  final int selectedIndex;
  const ViewStoryPage({Key? key, required this.selectedIndex, required this.stories, required this.userId}) : super(key: key);

  @override
  _ViewStoryPageState createState() => _ViewStoryPageState();
}

class _ViewStoryPageState extends State<ViewStoryPage> with SingleTickerProviderStateMixin {


  final storyController = StoryController();
  late TabController tabController;
  Map? selectedMessage = reportReasonsList[0];
  List<Widget> myTabs = [];
  // final List<Tab> myTabs = <Tab>[
  //   Tab(text: 'LEFT'),
  //   Tab(text: 'RIGHT'),
  // ];


  List myStories = [];


  @override
  void initState() {
    // TODO: implement initState
    tabController = TabController(length: widget.stories.length, vsync: this,initialIndex: widget.selectedIndex);
    widget.stories.forEach((element) {
      myTabs.add(
          Stack(
            children: [
              StoryView(
                controller: storyController,
                storyItems: [
                  StoryItem.pageVideo(element['file'], controller: storyController, duration: Duration(milliseconds: int.parse(element['seconds']??'0')),)
                ],
                // storyItems: [
                //
                //   StoryItem.pageVideo(
                //     'https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/20_8768455791657797560.mp4',
                //       controller: storyController
                //   )
                //   // for(int i=0;i<widget.stories!.length;i++)
                //    // StoryItem.pageVideo(
                //     //  shown: true,
                //    // url:'https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/20_8768455791657797560.mp4',
                //     // caption: Text(
                //     //   "",
                //     //   style: TextStyle(
                //     //     color: Colors.white,
                //     //     backgroundColor: Colors.black54,
                //     //     fontSize: 17,
                //     //   ),
                //     // ),
                //    // controller: storyController,
                //  // ),
                //   // StoryItem.inlineImage(
                //   //   url:
                //   //   "https://image.ibb.co/cU4WGx/Omotuo-Groundnut-Soup-braperucci-com-1.jpg",
                //   //   controller: storyController,
                //   //   caption: Text(
                //   //     "Omotuo & Nkatekwan; You will love this meal if taken as supper.",
                //   //     style: TextStyle(
                //   //       color: Colors.white,
                //   //       backgroundColor: Colors.black54,
                //   //       fontSize: 17,
                //   //     ),
                //   //   ),
                //   // ),
                //   // StoryItem.inlineImage(
                //   //   url:
                //   //   "https://media.giphy.com/media/5GoVLqeAOo6PK/giphy.gif",
                //   //   controller: storyController,
                //   //   caption: Text(
                //   //     "Hektas, sektas and skatad",
                //   //     style: TextStyle(
                //   //       color: Colors.white,
                //   //       backgroundColor: Colors.black54,
                //   //       fontSize: 17,
                //   //     ),
                //   //   ),
                //   // )
                // ],
                onStoryShow: (s) {
                  print("Showing a story");
                },
                onComplete: () {
                  print("Completed a cycle");
                  try{
                    tabController.animateTo(tabController.index+1);
                    // DefaultTabController.of(this.context)!.animateTo(DefaultTabController.of(this.context!)!.index+1);
                  }catch(e){
                    Navigator.pop(context);
                    print('Error in catch block34 $e');
                  }
                },
                progressPosition: ProgressPosition.top,
                onVerticalSwipeComplete: (f){
                  print('fdklhfdlk');
                  Navigator.pop(context);
                },
                repeat: false,
                inline: true,
              ),
              Positioned(
                bottom: 8,
                right: 0,
                left: 0,
                child: Container(
                  padding: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  // color: Colors.black.withOpacity(0.4),
                  color: Colors.black,
                  // color:Colors.transparent.withOpacity(0.7),
                  child: ParagraphText(element['title'] , color: Colors.white,textAlign: TextAlign.center,),
                ),
              )
            ],
          )
      );
    });
    super.initState();
  }


  @override
  void dispose() {
    // TODO: implement dispose
    tabController.dispose();
    super.dispose();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: DefaultTabController(
        length: myTabs.length,
        initialIndex: widget.selectedIndex,
        child: Scaffold(
          body: Stack(
            children: [
              TabBarView(
                controller: tabController,
                children: myTabs.map((Widget tab) {
                  return tab;
                }).toList(),
              ),
              if(userData!.id!=widget.userId)
              Positioned(
                top: 60,
                right: 16,
                child: PopupMenuButton(
                  // initialValue: '1',
                  child: Center(
                      child:Icon(Icons.flag,color: Colors.white,)),
                  itemBuilder: (context) {
                    return [
                      PopupMenuItem(
                        value: '1',
                        child: Text('Report this Story',style: TextStyle(color: Colors.red),),
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
                                          'report_to': userData!.id,
                                          'report_by': userData!.id,
                                          'message': selectedMessage!['message'],
                                          'report_type': '2',
                                          'content_id': widget.selectedIndex.toString(),
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
              // Positioned(
              //   bottom: 60,
              //   right: 16,
              //   child: GestureDetector(
              //     onTap: (){
              //       showModalBottomSheet(context: context,isScrollControlled: true, builder: (context){
              //         return Container(
              //           padding: EdgeInsets.all(16),
              //           height: 375,
              //           child: Column(
              //             children: [
              //               vSizedBox,
              //               SubHeadingText('If you send gifts, abc will see your messages first'),
              //               vSizedBox2,
              //               Expanded(
              //                 child: Container(
              //                   width: MediaQuery.of(context).size.width,
              //                   child: GridView(
              //                     gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 2, childAspectRatio: 1.2),
              //                     scrollDirection: Axis.horizontal,
              //                     children: [
              //                       for(int index = 0;index<giftsList.length;index++)
              //                         GestureDetector(
              //                           onTap: ()async{
              //                             var request = {
              //                               // 'user_id': userData!['id'],
              //                               'send_by': userData!.id,
              //                               'send_to': widget.userId,
              //                               'gift_id': giftsList[index]['id'],
              //                               'coins': giftsList[index]['coin_value'],
              //                             };
              //                             loadingShow(context);
              //                             var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.sendGifts, request: request, );
              //                             loadingHide(context);
              //                             if(jsonResponse['status'].toString()=='1'){
              //                               presentToast(jsonResponse['message']);
              //                               Navigator.pop(context);
              //                               MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);
              //                               setState(() {
              //
              //                               });
              //                             }else{
              //
              //                             }
              //                           },
              //                           child: Padding(
              //                             padding: const EdgeInsets.all(8.0),
              //                             child: Column(
              //                               children: [
              //                                 CustomCircularImage(imageUrl: giftsList[index]['image'], height: 65, width: 65,),
              //                                 vSizedBox05,
              //                                 ParagraphText('${giftsList[index]['coin_value']}')
              //                               ],
              //                             ),
              //                           ),
              //                         ),
              //                       //   ClipRRect(
              //                       //   borderRadius: BorderRadius.circular(70),
              //                       //   child: Image.asset(
              //                       //     'assets/gift.png',
              //                       //     height: 50,
              //                       //     width: 50,
              //                       //   ),
              //                       // ),Text('jdfg')
              //
              //                     ],
              //                   ),
              //                 ),
              //               ),
              //               Row(
              //                 mainAxisAlignment: MainAxisAlignment.spaceBetween,
              //                 children: [
              //                   Row(
              //                     children: [
              //                       Icon(Icons.circle, color: MyColors.yelloew),
              //                       hSizedBox05,
              //                       ParagraphText(userData!.coins.toString()),
              //                     ],
              //                   ),
              //                   RoundEdgedButton(text: 'Get more coins', width: 120,)
              //                 ],
              //               )
              //             ],
              //           ),
              //         );
              //       });
              //     },
              //     child: ClipRRect(
              //       borderRadius: BorderRadius.circular(70),
              //       child: Image.asset(
              //         MyImages.giftIcon,
              //         height: 30,
              //         width: 30,
              //       ),
              //     ),
              //   ),
              // ),
            ],
          ),
        ),
      ),
    );
  }
}
