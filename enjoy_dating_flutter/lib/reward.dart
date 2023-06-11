import 'dart:convert';

import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_data.dart';

import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:Enjoy/widget/play_video_page.dart';
import 'package:flutter/material.dart';

import 'constants/image_urls.dart';
import 'package:http/http.dart' as http;
class Rewards extends StatefulWidget {
  const Rewards({Key? key}) : super(key: key);

  @override
  _RewardsState createState() => _RewardsState();
}

class _RewardsState extends State<Rewards> {

  bool load = false;


  bool everdayCoinsLoad = false;
  bool otherRewardsLoad = false;
  List everyDayCoins = [];
  List otherRewards = [];
  late http.Response randomVideoResponse;
  String nextNumber = '0';
  // int streak = 0;

  // DateTime lastUpdated = DateTime.now().subtract(Duration(days: 1));

  participateInVideoWatch()async{
    var request = {
      'user_id': userData!.id,
      'activity_id': '2'
    };
    loadingShow(context);
    var jsonResponse =  await Webservices.postData(apiUrl: ApiUrls.participateExtraActivityEarning, request: request,  showSuccessMessage: true);
    loadingHide(context);
  }
  getEveryDayCoins()async{
    // String? dateString = sharedPreferences.getString("last_update");
    // if(dateString==null){
    //   setState(() {
    //     streak = 0;
    //   });
    // }else{
    //   streak = sharedPreferences.getInt('streak')??0;
    //   lastUpdated = DateTime.parse(dateString!);
    // }

    setState(() {
      everdayCoinsLoad = true;
      otherRewardsLoad = true;
    });

    randomVideoResponse = await Webservices.getData(ApiUrls.rendomVideo);
    var response = await Webservices.getData(ApiUrls.everyDayCoinsList + '?user_id=${userData!.id}');
    if(response.statusCode==200){
      var jsonResponse = jsonDecode(response.body);
      if(jsonResponse['status']==1){
        everyDayCoins = jsonResponse['data'];
        nextNumber = jsonResponse['next_number'].toString();
      }
    }

    setState((){
      everdayCoinsLoad = false;
    });
    // everyDayCoins = await Webservices.getList(ApiUrls.everyDayCoinsList + '?user_id=${userData!.id}');
    otherRewards = await Webservices.getList(ApiUrls.extraActivityEarnings + '?user_id=${userData!.id}');
    setState((){
      otherRewardsLoad = false;
    });
    print('the everyDay Coins are $everyDayCoins');
    setState(() {


    });
  }

  @override
  void initState() {
    // TODO: implement initState
    getEveryDayCoins();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      extendBody: true,
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              // height: MediaQuery.of(context).size.height,
              width: MediaQuery.of(context).size.width,
              padding: EdgeInsets.symmetric(horizontal: 16),
              decoration: BoxDecoration(
                  image: DecorationImage(
                    image: AssetImage('assets/coins-bg.png'),
                    alignment: Alignment.topRight
                  ),
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Color(0xFE7D44CF),
                      Color(0xFE00B199)
                    ],
                  ),
              ),
              child: Column(
                children: [
                  SizedBox(height: 50,),

                  SizedBox(height: 50,),
                  Text('Earn Free Coins', style: TextStyle(fontSize: 26, fontFamily: 'extrabold', color: Colors.white),),
                  SizedBox(height: 25,),
                  Container(
                    padding: EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Color(0xFE1CDBC1),
                      borderRadius: BorderRadius.circular(10)
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [

                        SizedBox(height: 20,),
                        if(everdayCoinsLoad)
                          Container(
                            height: 200,
                            child: CustomLoader(color: Colors.white,),
                          )else
                        Wrap(
                          children: [
                            for(int i = 0;i<everyDayCoins.length;i++)
                              GestureDetector(
                                onTap:nextNumber==everyDayCoins[i]['day_number'] &&everyDayCoins[i]['check_in']==1?()async{
                                  print('helkdslfs');
                                  var request = {
                                    'user_id': userData!.id,
                                    'day_number': everyDayCoins[i]['day_number']
                                  };
                                  setState(() {
                                    everdayCoinsLoad = true;
                                  });
                                  var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.participateDailyActivityEarning, request: request, );
                                  await getEveryDayCoins();
                                  setState(() {
                                    everdayCoinsLoad = false;
                                  });
                                  await showDialog(context: context, builder: (context){
                                    return Dialog(
                                      insetPadding: EdgeInsets.symmetric(horizontal: 24, vertical: 32),
                                      child: Container(
                                        child: Column(
                                          mainAxisSize: MainAxisSize.min,
                                          children: [
                                            vSizedBox,
                                            MainHeadingText('Congratulations!!', color: Colors.green,),
                                            vSizedBox2,
                                            Image.asset(MyImages.coinsTakenIcon, height: 100,),
                                            vSizedBox2,
                                            SubHeadingText('You have earned ${everyDayCoins[i]['coins']} coins'),
                                            vSizedBox2,
                                            vSizedBox,
                                          ],
                                        ),
                                      ),
                                    );
                                  });

                                }:(){
                                  print('kdfls');
                                },
                                // onTap: (),
                                child: Container(
                                  padding: EdgeInsets.all(12),
                                  margin: EdgeInsets.symmetric(horizontal: 4, vertical: 8),

                                  decoration: BoxDecoration(
                                      color: Color(0xFE1FB7A5),
                                      borderRadius: BorderRadius.circular(10),
                                    border:nextNumber==everyDayCoins[i]['day_number'] &&everyDayCoins[i]['check_in']==1? Border.all(color: MyColors.secondary):null,
                                  ),
                                  child: Column(
                                    children: [
                                      Text('Day ${everyDayCoins[i]['day_number']} ', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                                      SizedBox(height: 5,),
                                      Image.asset(everyDayCoins[i]['check_in']==2?MyImages.coinsTakenIcon:MyImages.coinsIcon, width: 30,),
                                      SizedBox(height: 10,),
                                      Text(everyDayCoins[i]['coins'], style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                                    ],
                                  ),
                                ),
                              ),
                          ],
                        ),
                        // Row(
                        //   mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        //   children: [
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //         color: Color(0xFE1FB7A5),
                        //         borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 1', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/check-coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 10', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //         color: Color(0xFE1FB7A5),
                        //         borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 2', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 20', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //         color: Color(0xFE1FB7A5),
                        //         borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 3', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 30', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //         color: Color(0xFE1FB7A5),
                        //         borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 4', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 40', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //
                        //   ],
                        // ),
                        // SizedBox(height: 20,),
                        // Row(
                        //   mainAxisAlignment: MainAxisAlignment.start,
                        //   children: [
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //           color: Color(0xFE1FB7A5),
                        //           borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 5', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/check-coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 50', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //     SizedBox(width: 17,),
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //           color: Color(0xFE1FB7A5),
                        //           borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 6', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 60', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //     SizedBox(width: 17,),
                        //     Container(
                        //       padding: EdgeInsets.all(16),
                        //       decoration: BoxDecoration(
                        //           color: Color(0xFE1FB7A5),
                        //           borderRadius: BorderRadius.circular(10)
                        //       ),
                        //       child: Column(
                        //         children: [
                        //           Text('Day 7', style: TextStyle(fontFamily: 'semibold', fontSize: 14, color: Colors.white),),
                        //           SizedBox(height: 5,),
                        //           Image.asset('assets/coin.png', width: 30,),
                        //           SizedBox(height: 10,),
                        //           Text('+ 70', style: TextStyle(fontSize: 12, fontFamily: 'extrabold', color: Color(0xFEFFCC4D)),)
                        //         ],
                        //       ),
                        //     ),
                        //   ],
                        // ),
                        SizedBox(height: 50,),
                        if(!otherRewardsLoad)
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Text('Complete tasks to get coins', style: TextStyle(fontFamily: 'bold', fontSize: 20, color: Colors.white,),)
                          ],
                        ),
                        SizedBox(height: 30,),
                        if(otherRewardsLoad)
                            Container(
                                height: 200,
                                child: CustomLoader(color: Colors.white,))else
                        for(int i = 0;i<otherRewards.length;i++)
                        GestureDetector(
                          behavior: HitTestBehavior.opaque,
                          onTap: ()async{
                            if(otherRewards[i]['earn_activity_type_id']=='2'){

                              if(randomVideoResponse.statusCode==200){
                                var jsonResponse = jsonDecode(randomVideoResponse.body);
                                if(jsonResponse['status']==1){
                                  push(context: context, screen: PlayVideoPage(url: jsonResponse['data']));
                                }
                              }
                            }else{
                              print('the id is ${otherRewards[i]['earn_activity_type_id']}');
                            }
                          },
                          child: Container(
                            margin: EdgeInsets.only(bottom: 15),
                            child: Row (
                              mainAxisAlignment: MainAxisAlignment.start,
                              crossAxisAlignment: CrossAxisAlignment.center,
                              children: [
                                Expanded(
                                  flex: 9,
                                  child: Row(
                                    children: [
                                      CustomCircularImage(imageUrl: otherRewards[i]['image'], height: 50,width: 50,),

                                      SizedBox(width: 15,),
                                      Expanded(
                                          flex: 10,
                                          child: Column(
                                            crossAxisAlignment: CrossAxisAlignment.start,
                                            children: [
                                              Text('${otherRewards[i]['title']}', style: TextStyle(fontFamily: 'extrabold', fontSize: 20, color: Colors.white),),
                                              Text('${otherRewards[i]['description']}', style: TextStyle(fontFamily: 'regular', fontSize: 12, color: Colors.white),)
                                            ],
                                          )
                                      )
                                    ],
                                  ),
                                ),
                                Expanded(
                                  flex: 3,
                                  child: Container(
                                    padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                                    decoration: BoxDecoration(
                                        color: Colors.white,
                                        borderRadius: BorderRadius.circular(10)
                                    ),
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.center,
                                      children: [
                                        Text('${otherRewards[i]['participate_count']}/${otherRewards[i]['max_content']??1}', style: TextStyle(fontFamily: 'bold', fontSize: 18),)
                                      ],
                                    ),
                                  ),
                                )
                              ],
                            ),
                          ),
                        ),
                        SizedBox(height: 15,),
                        // Container(
                        //   child: Row (
                        //     mainAxisAlignment: MainAxisAlignment.start,
                        //     crossAxisAlignment: CrossAxisAlignment.center,
                        //     children: [
                        //       Expanded(
                        //         flex: 9,
                        //         child: Row(
                        //           children: [
                        //             Expanded(
                        //               flex: 3,
                        //               child: Image.asset('assets/confession.png', width: 50,),
                        //             ),
                        //             SizedBox(width: 15,),
                        //             Expanded(
                        //                 flex: 10,
                        //                 child: Column(
                        //                   crossAxisAlignment: CrossAxisAlignment.start,
                        //                   children: [
                        //                     Text('Confession', style: TextStyle(fontFamily: 'extrabold', fontSize: 20, color: Colors.white),),
                        //                     Text('Send gift 3 times to get 400 coins', style: TextStyle(fontFamily: 'regular', fontSize: 12, color: Colors.white),)
                        //                   ],
                        //                 ),
                        //             ),
                        //           ],
                        //         ),
                        //       ),
                        //       Expanded(
                        //         flex: 3,
                        //         child: Container(
                        //           padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                        //           decoration: BoxDecoration(
                        //               color: Colors.white,
                        //               borderRadius: BorderRadius.circular(10)
                        //           ),
                        //           child: Row(
                        //             mainAxisAlignment: MainAxisAlignment.center,
                        //             children: [
                        //               Text('0/3', style: TextStyle(fontFamily: 'bold', fontSize: 18),)
                        //             ],
                        //           ),
                        //         ),
                        //       )
                        //     ],
                        //   ),
                        // ),
                        // SizedBox(height: 15,),
                        // Container(
                        //   child: Row (
                        //     mainAxisAlignment: MainAxisAlignment.start,
                        //     crossAxisAlignment: CrossAxisAlignment.center,
                        //     children: [
                        //       Expanded(
                        //         flex: 9,
                        //         child: Row(
                        //           children: [
                        //             Expanded(
                        //               flex: 3,
                        //               child: Image.asset('assets/videocalls.png', width: 50,),
                        //             ),
                        //             SizedBox(width: 15,),
                        //             Expanded(
                        //                 flex: 10,
                        //                 child: Column(
                        //                   crossAxisAlignment: CrossAxisAlignment.start,
                        //                   children: [
                        //                     Text('Video Call', style: TextStyle(fontFamily: 'extrabold', fontSize: 20, color: Colors.white),),
                        //                     Text('Video chat 300 to get 500 coins', style: TextStyle(fontFamily: 'regular', fontSize: 12, color: Colors.white),)
                        //                   ],
                        //                 )
                        //             )
                        //           ],
                        //         ),
                        //       ),
                        //       Expanded(
                        //         flex: 3,
                        //         child: Container(
                        //           padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                        //           decoration: BoxDecoration(
                        //               color: Colors.white,
                        //               borderRadius: BorderRadius.circular(10)
                        //           ),
                        //           child: Row(
                        //             mainAxisAlignment: MainAxisAlignment.center,
                        //             children: [
                        //               Text('0/300', style: TextStyle(fontFamily: 'bold', fontSize: 18),)
                        //             ],
                        //           ),
                        //         ),
                        //       )
                        //     ],
                        //   ),
                        // ),
                        // SizedBox(height: 15,),
                        // Container(
                        //   child: Row (
                        //     mainAxisAlignment: MainAxisAlignment.start,
                        //     crossAxisAlignment: CrossAxisAlignment.center,
                        //     children: [
                        //       Expanded(
                        //         flex: 9,
                        //         child: Row(
                        //           children: [
                        //             Expanded(
                        //               flex: 3,
                        //               child: Image.asset('assets/purchase.png', width: 50,),
                        //             ),
                        //             SizedBox(width: 15,),
                        //             Expanded(
                        //                 flex: 10,
                        //                 child: Column(
                        //                   crossAxisAlignment: CrossAxisAlignment.start,
                        //                   children: [
                        //                     Text('First Purchase', style: TextStyle(fontFamily: 'extrabold', fontSize: 20, color: Colors.white),),
                        //                     Text('First Purchase to get 200 coins', style: TextStyle(fontFamily: 'regular', fontSize: 12, color: Colors.white),)
                        //                   ],
                        //                 )
                        //             )
                        //           ],
                        //         ),
                        //       ),
                        //       Expanded(
                        //         flex: 3,
                        //         child: Container(
                        //           padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                        //           decoration: BoxDecoration(
                        //               color: Colors.white,
                        //               borderRadius: BorderRadius.circular(10)
                        //           ),
                        //           child: Row(
                        //             mainAxisAlignment: MainAxisAlignment.center,
                        //             children: [
                        //               Text('0/1', style: TextStyle(fontFamily: 'bold', fontSize: 18),)
                        //             ],
                        //           ),
                        //         ),
                        //       )
                        //     ],
                        //   ),
                        // ),
                        // SizedBox(height: 15,),
                      ],
                    ),
                  ),
                  SizedBox(height: 30,),
                ],
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 64),
            child: GestureDetector(
              onTap: () => {
                Navigator.pop(context)
              },
              child: Row(
                children: [
                  Icon(Icons.arrow_back_ios_new, color: Colors.white,),
                ],
              ),
            ),
          ),


        ],
      ),
    );
  }
}
