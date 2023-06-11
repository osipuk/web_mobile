import 'dart:developer';

import 'package:Enjoy/cards/user_search_card.dart';
import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/single.dart';
import 'package:Enjoy/video_call.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/block_layout.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

import 'constants/global_data.dart';

class Search_Tab_Page extends StatefulWidget {
  const Search_Tab_Page({Key? key}) : super(key: key);
  @override
  _Search_Tab_PageState createState() => _Search_Tab_PageState();
}

class _Search_Tab_PageState extends State<Search_Tab_Page> {
  List tranding = [];
  List New = [];
  List popular = [];
  String type='trending';
  bool load=false;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    get_list(type);
  }

  get_list(String type) async {
    setState(() {
      load=true;
    });
    Map data = {
      'user_id':  userData?.id,
      'filter':type,
      // 'lat': '',
      // 'lng': '',
      // 'distance': '',
    };
    Map res = await getData(data, 'searchUser', 0, 0);
    setState(() {
      load=false;
    });
    if(res['status'].toString()=='1'){
      tranding=res['data'];
      setState(() {

      });
    } else {
      tranding=[];
      setState(() {

      });
    }
    print('res-----$res');
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Container(
            height: MediaQuery.of(context).size.height,
            decoration: BoxDecoration(
                gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
            )),
            child: SingleChildScrollView(
              child: Container(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    vSizedBox6,
                    Container(
                      padding: EdgeInsets.symmetric(horizontal: 50),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Column(
                            children: [
                              GestureDetector(
                                onTap: () {
                                  type='trending';
                                  get_list(type);
                                  setState(() {

                                  });
                                },
                                child: ParagraphText(
                                  'Trending',
                                  color: type=='trending'?Colors.white:Colors.white.withOpacity(0.50),
                                  fontSize: 16,
                                ),
                              ),
                              if(type=='trending')
                              Container(
                                height: 2,
                                width: 25,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(2),
                                    color: Colors.white),
                              )
                            ],
                          ),
                          hSizedBox4,
                          Column(
                            children: [
                              GestureDetector(
                                onTap: () {
                                  type='newest';
                                  setState(() {

                                  });
                                  get_list(type);
                                },
                                child: ParagraphText(
                                  'New',
                                  color: type=='newest'?Colors.white:Colors.white.withOpacity(0.50),
                                  fontSize: 16,
                                ),
                              ),
                              if(type=='newest')
                              Container(
                                height: 2,
                                width: 25,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(2),
                                    color: Colors.white),
                              )
                            ],
                          ),
                          hSizedBox4,
                          Column(
                            children: [
                              GestureDetector(
                                onTap: () {
                                  type='popular';
                                  setState(() {

                                  });
                                  get_list(type);
                                },
                                child: ParagraphText(
                                  'Popular',
                                  color: type=='popular'?Colors.white:Colors.white.withOpacity(0.50),
                                  fontSize: 16,
                                ),
                              ),
                              if(type=='popular')
                              Container(
                                height: 2,
                                width: 25,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(2),
                                    color: Colors.white),
                              )
                            ],
                          ),
                        ],
                      ),
                    ),
                    vSizedBox4,
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16.0),
                      child: Column(
                        children: [
                          // for(var i=0; i<tranding.length; i=i+2)
                          //   Column(
                          //     children: [
                          //       Row(
                          //         children: [
                          //           Expanded(
                          //               child: GestureDetector(
                          //                 onTap:(){
                          //                   push(context: context, screen: Single_Page(user_id:tranding[i]['id']));
                          //                 },
                          //                 behavior: HitTestBehavior.translucent,
                          //                 child: UserSearchCard(user: UserModal.fromJson(tranding[i]),),
                          //               )
                          //           ),
                          //           hSizedBox2,
                          //           if(tranding.length==1)
                          //             Expanded(child: Container()),
                          //           if((i+1)<tranding.length)
                          //           Expanded(
                          //               child: GestureDetector(
                          //                 onTap:(){
                          //                   push(context: context, screen: Single_Page(user_id:tranding[i+1]['id']));
                          //                 },
                          //                 child: Container(
                          //                   height: 210,
                          //                   decoration: BoxDecoration(
                          //                       borderRadius: BorderRadius.circular(20),
                          //                       color: Colors.white,
                          //                       border: Border.all(color: Colors.white,)
                          //                   ),
                          //                   child: Stack(
                          //                     children: [
                          //
                          //                       ClipRRect(
                          //                         child: Image.asset('assets/chat_person.png',
                          //                           height: 210,
                          //                           fit: BoxFit.cover,
                          //                         ),
                          //                         borderRadius: BorderRadius.circular(20),
                          //                       ),
                          //                       Container(
                          //                         height: MediaQuery.of(context).size.height,
                          //                         width: MediaQuery.of(context).size.width,
                          //                         decoration: BoxDecoration(
                          //                             gradient: LinearGradient(
                          //                               begin: Alignment.topCenter,
                          //                               end: Alignment.bottomCenter,
                          //                               colors: [
                          //                                 Colors.transparent,
                          //                                 Color(0xFF7D44CF)
                          //                               ],
                          //                             ),
                          //                             borderRadius: BorderRadius.circular(20)
                          //                         ),
                          //                         child: Column(
                          //                           mainAxisAlignment: MainAxisAlignment.end,
                          //                           crossAxisAlignment: CrossAxisAlignment.center,
                          //                           children: [
                          //                             Padding(
                          //                               padding: const EdgeInsets.all(8.0),
                          //                               child: ParagraphText('${tranding[i+1]['name']}, ${calculateAge(tranding[i+1]['date_of_birth'])}',
                          //                                 fontSize: 16,
                          //                                 fontFamily: 'bold',
                          //                                 color: Colors.white,
                          //                               ),
                          //                             ),
                          //                             Row(
                          //                               mainAxisAlignment: MainAxisAlignment.center,
                          //                               children: [
                          //                                 GestureDetector(
                          //                                   onTap: (){
                          //                                     push(context: context, screen: VideoCallPage());
                          //                                   },
                          //                                   child: Image.asset('assets/video_sec.png', width: 35, height: 35,),
                          //                                 ),
                          //                                 SizedBox(width: 20,),
                          //                                 GestureDetector(
                          //                                   onTap: (){
                          //                                     push(context: context, screen: Chat_Detail_Page());
                          //                                   },
                          //                                   child: Image.asset('assets/chat_sec.png', width: 35, height: 35,),
                          //                                 )
                          //                               ],
                          //                             ),
                          //                             SizedBox(height: 10,)
                          //                           ],
                          //                         ),
                          //                       ),
                          //                       Positioned(
                          //                           right: 10,
                          //                           top: 10,
                          //                           child: Container(
                          //                             width: 35,
                          //                             height: 18,
                          //                             decoration: BoxDecoration(
                          //                                 color: MyColors.secondary,
                          //                                 borderRadius: BorderRadius.circular(20)
                          //                             ),
                          //                             child: Row(
                          //                               mainAxisAlignment: MainAxisAlignment.center,
                          //                               children: [
                          //                                 Row(
                          //                                   children: [
                          //                                     Image.asset('assets/eye.png', height: 10,),
                          //                                     SizedBox(width: 2,),
                          //                                     ParagraphText('${tranding[i+1]['viwers']}', color: Colors.white,fontSize: 8,)
                          //                                   ],
                          //                                 ),
                          //                               ],
                          //                             ),
                          //                           )
                          //                       ),
                          //                       Positioned(
                          //                           left: 10,
                          //                           top: 10,
                          //                           child: Row(
                          //                             mainAxisAlignment: MainAxisAlignment.center,
                          //                             children: [
                          //                               Row(
                          //                                 children: [
                          //                                   Image.asset('assets/coin.png', width: 15,),
                          //                                   SizedBox(width: 3,),
                          //                                   Text('${tranding[i+1]['coins']}', style: TextStyle(fontSize: 16, color: Colors.white, fontWeight: FontWeight.bold),),
                          //                                   SizedBox(width: 16,)
                          //                                 ],
                          //                               ),
                          //
                          //                             ],
                          //                           )
                          //                       ),
                          //
                          //                     ],
                          //                   ),
                          //                 ),
                          //               )
                          //           ),
                          //         ],
                          //       ),
                          //       vSizedBox2,
                          //     ],
                          //   ),

                          Wrap(
                            children: [
                              for(int i = 0;i<tranding.length;i++)
                              Container(
                                width: (MediaQuery.of(context).size.width-40)/2,
                                padding: EdgeInsets.symmetric(horizontal: 4),
                                child:  UserSearchCard(user: UserModal.fromJson(tranding[i]),
                                ),
                              ),
                            ],
                          ),
                          if(tranding.length==0&&!load)
                          Center(
                            child: new Text('No data found',style:TextStyle(color: Colors.white)),
                          ),
                          SizedBox(
                            height: 60,
                          )
                        ],
                      ),
                    ),

                  ],
                ),
              ),
            ),
          ),
          if(load)
            CustomLoader(),
        ],
      ),
    );
  }
  String calculateAge(String birthDateString) {
    log('check-----date---'+birthDateString);
    String datePattern = "yyyy-MM-dd";

    DateTime birthDate = DateFormat(datePattern).parse(birthDateString);
    DateTime currentDate = DateTime.now();
    int age = currentDate.year - birthDate.year;
    int month1 = currentDate.month;
    int month2 = birthDate.month;
    if (month2 > month1) {
      age--;
    } else if (month1 == month2) {
      int day1 = currentDate.day;
      int day2 = birthDate.day;
      if (day2 > day1) {
        age--;
      }
    }
    return age.toString()+"";
  }

}
