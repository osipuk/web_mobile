import 'dart:async';

import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/match_found.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/packages/ripple_animation.dart';
import 'package:Enjoy/pages/CallToMatchedUser.dart';
import 'package:Enjoy/reward.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/location.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/single.dart';
import 'package:Enjoy/video_call.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';
import 'package:audioplayers/audioplayers.dart';

class SearchPage extends StatefulWidget {
  const SearchPage({required Key key}) : super(key: key);

  @override
  SearchPageState createState() => SearchPageState();
}

class SearchPageState extends State<SearchPage>
    with SingleTickerProviderStateMixin {
  List lists = [];
  bool load = false;
  bool onlineStatus = false;

  showTodaysOfferDialog() async {
    await Future.delayed(Duration(seconds: 1));
    showDialog(
        context: context,
        builder: (context) => SimpleDialog(
              backgroundColor: Colors.transparent,
              children: [
                Container(
                  // height: 450,
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
                  child: Stack(
                    clipBehavior: Clip.none,
                    children: [
                      Positioned(
                        top: -120,
                        left: 20,
                        child: Image.asset(
                          'assets/chest.png',
                          width: 230,
                          height: 220,
                        ),
                      ),
                      Container(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.end,
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            vSizedBox8,
                            vSizedBox6,
                            Row(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Text(
                                  'Enjoy our today’s offer',
                                  style: TextStyle(
                                      fontSize: 21,
                                      fontFamily: 'semibold',
                                      color: Colors.white),
                                )
                              ],
                            ),
                            SizedBox(
                              height: 10,
                            ),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Image.asset('assets/coin.png'),
                                hSizedBox2,
                                Text(
                                  '1100',
                                  style: TextStyle(
                                      fontSize: 60,
                                      fontFamily: 'bold',
                                      color: Colors.white),
                                )
                              ],
                            ),
                            SizedBox(
                              height: 40,
                            ),
                            SolidBtn(
                              BtnText: '\$ 19.99 Purchase',
                              funcTap: () async {
                                await push(
                                    context: context, screen: Get_Coins_Page());
                                setState(() {});
                              },
                              BgColorTop: Color(0xFEB8E43B),
                              BgColorBottom: Color(0xFEB8E43B),
                              ShadowColor: Color(0xFEB8E43B).withOpacity(0.5),
                            ),
                            SizedBox(
                              height: 20,
                            ),
                            GestureDetector(
                              onTap: () {
                                Navigator.of(context, rootNavigator: true)
                                    .pop();
                              },
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Text(
                                    'Not Now',
                                    style: TextStyle(
                                        fontFamily: 'regular',
                                        color: Colors.white),
                                  )
                                ],
                              ),
                            ),
                            SizedBox(
                              height: 15,
                            ),
                          ],
                        ),
                      )
                    ],
                  ),
                )
              ],
            ));
  }

  late AnimationController _controller;

  Widget _buildBody() {
    return AnimatedBuilder(
      animation:
          CurvedAnimation(parent: _controller, curve: Curves.fastOutSlowIn),
      builder: (context, child) {
        return Stack(
          alignment: Alignment.center,
          children: <Widget>[
            _buildContainer(150 * _controller.value),
            _buildContainer(200 * _controller.value),
            _buildContainer(250 * _controller.value),
            _buildContainer(300 * _controller.value),
            _buildContainer(350 * _controller.value),
            Align(
                child: Icon(
              Icons.phone_android,
              size: 44,
            )),
          ],
        );
      },
    );
  }

  Widget _buildContainer(double radius) {
    return Container(
      width: radius,
      height: radius,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: Colors.blue.withOpacity(1 - _controller.value),
      ),
    );
  }

  @override
  void initState() {
    // TODO: implement initState

    onlineStatus = userData!.isOnline;
    _controller = AnimationController(
      vsync: this,
      lowerBound: 0.5,
      duration: Duration(seconds: 3),
    )..repeat();
    // if(userData!.gender==UserGender.male) {
    //   showTodaysOfferDialog();
    // }
    super.initState();
    get_GPS_Position();
    // get_users();
  }

  // get_users() async {
  //   // setState(() {
  //   //   load=true;
  //   // });
  //   Map data = {
  //     'user_id': userData!.id,
  //     'lat': lat.toString(),
  //     'lng': lng.toString(),
  //     'limit': '5'
  //   };
  //   Map res = await getData(data, 'searchUser', 0, 0);
  //   setState(() {
  //     load=false;
  //   });
  //   print('near user-----$res');
  //   if(res['status'].toString()=='1'){
  //     lists=res['data'];
  //     setState(() {
  //
  //     });
  //   }
  // }

  bool matching = false;
  AudioPlayer audioPlayer = AudioPlayer();

  Future<Map?> getMatch() async {
    try {
      setState(() {
        matching = true;
      });
      await audioPlayer.play(
        // AssetSource('userSearch.mp3'),
        AssetSource('user_search_new.mp3'),
      );
      Map<String, dynamic> data = {
        'user_id': userData!.id,
        // 'lat': lat.toString(),
        // 'lng': lng.toString(),
        'limit': '1',
        'filter': 'video_call_random',
      };
      print('the request is data $data');
      await Future.delayed(Duration(seconds: 2));
      List temp = await Webservices.getListFromRequestParameters(
          ApiUrls.searchUser, data);
      print('the response is data $temp');
      await audioPlayer.dispose();
      audioPlayer = AudioPlayer();


      if (temp.length == 1 && matching) {
        setState(() {
          matching = false;
        });
        // return temp[0];
        UserModal matchedUser = UserModal.fromJson(temp[0]);
        print('the matched user is ${temp[0]}');
        ;
        bool? resultTemp = await push(
            context: context,
            screen: CallToMatchedUserPage(matchedUser: matchedUser));
        if (resultTemp == true) {
          print('1------------------aaa');
          getMatch();
        }
      } else {
        print('Error in getting match 5337 $temp');
        if(matching){
          print('2------------------aaa');
          getMatch();
        }

      }
    } catch (e) {
      print('Error in catch block $e');
    }
  }

  get_GPS_Position() async {
    print('------enter------');
    dynamic position = await determinePosition();
    print('current position------${position}');
    if (position != null) {
      lat = position.latitude;
      lng = position.longitude;
      setState(() {});
    }
    // get_users();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load
          ? CustomLoader()
          : Stack(
              children: [
                Container(
                  decoration: BoxDecoration(
                      gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [Color(0xFE7D44CF), Color(0xFE1F66BA)],
                  )),
                  child: Container(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Container(
                          margin: EdgeInsets.only(top: 30),
                          padding: EdgeInsets.symmetric(vertical: 5, horizontal: 12),
                          decoration: BoxDecoration(color: Colors.white),
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              if (userData!.gender == UserGender.male)
                                GestureDetector(
                                  onTap: () async {
                                    await push(
                                        context: context, screen: Rewards());
                                    setState(() {});
                                  },
                                  child: Container(
                                    padding: EdgeInsets.only(left: 16),
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Image.asset(
                                          'assets/free-coin.png',
                                          width: 130,
                                        )
                                      ],
                                    ),
                                  ),
                                ),
                              Image.asset(
                                'assets/logo.png',
                                width: 50,
                              ),
                              SizedBox(
                                width: 60,
                              ),
                              if (userData!.gender == UserGender.male)
                                GestureDetector(
                                  onTap: () async {
                                    await push(
                                        context: context,
                                        screen: Get_Coins_Page());
                                    setState(() {});
                                  },
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.end,
                                    children: [
                                      Image.asset(
                                        MyImages.coins,
                                        width: 15,
                                      ),
                                      SizedBox(
                                        width: 3,
                                      ),
                                      Text(
                                        userData!.coins.toString(),
                                        style: TextStyle(
                                            fontSize: 16,
                                            color: Colors.black,
                                            fontWeight: FontWeight.bold),
                                      ),
                                      SizedBox(
                                        width: 16,
                                      )
                                    ],
                                  ),
                                )
                              else
                                GestureDetector(
                                  onTap: () async {
                                    await push(
                                        context: context,
                                        screen: Get_Coins_Page());
                                    setState(() {});
                                  },
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.end,
                                    children: [
                                      Image.asset(
                                        MyImages.diamond,
                                        width: 15,
                                      ),
                                      SizedBox(
                                        width: 3,
                                      ),
                                      Text(
                                        userData!.diamonds.toString(),
                                        style: TextStyle(
                                            fontSize: 16,
                                            color: Colors.black,
                                            fontWeight: FontWeight.bold),
                                      ),
                                      SizedBox(
                                        width: 16,
                                      )
                                    ],
                                  ),
                                ),
                            ],
                          ),
                        ),
                        vSizedBox4,
                        Container(
                          height: 300,
                          padding:
                              EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                          decoration: BoxDecoration(
                              // borderRadius: BorderRadius.circular(20.2)
                              ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              if (lists.length > 0)
                                Expanded(
                                  child: Stack(
                                    children: [
                                      // for(int i=0;i<lists.length;i++)
                                    ],
                                  ),
                                ),
                              Stack(
                                children: [
                                  if (matching)
                                    Center(
                                      child: Container(
                                        height: 300,
                                        width: 300,
                                        child: _buildBody(),
                                      ),
                                    ),
                                  Center(
                                    child: Container(
                                      decoration: BoxDecoration(
                                        color: MyColors.primaryColor
                                            .withOpacity(0.2),
                                        borderRadius:
                                            BorderRadius.circular(150),
                                      ),
                                      padding: EdgeInsets.all(30),
                                      child: Container(
                                        decoration: BoxDecoration(
                                          color: MyColors.primaryColor
                                              .withOpacity(0.30),
                                          borderRadius:
                                              BorderRadius.circular(150),
                                        ),
                                        padding: EdgeInsets.all(25),
                                        child: Container(
                                          decoration: BoxDecoration(
                                            color: MyColors.primaryColor
                                                .withOpacity(0.50),
                                            borderRadius:
                                                BorderRadius.circular(100),
                                          ),
                                          padding: EdgeInsets.all(20),
                                          child: Container(
                                            decoration: BoxDecoration(
                                              color: MyColors.primaryColor
                                                  .withOpacity(0.70),
                                              borderRadius:
                                                  BorderRadius.circular(100),
                                            ),
                                            padding: EdgeInsets.all(15),
                                            child: Container(
                                              decoration: BoxDecoration(
                                                color: MyColors.primaryColor,
                                                borderRadius:
                                                    BorderRadius.circular(70),
                                              ),
                                              height: 120,
                                              width: 120,
                                              padding: EdgeInsets.all(10),
                                              child: ClipRRect(
                                                borderRadius:
                                                    BorderRadius.circular(70),
                                                child: Image.network(
                                                  userData!.imageUrl,
                                                  height: 100,
                                                  width: 100,
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                  if (lists.length >= 1)
                                    Positioned(
                                      child: GestureDetector(
                                        onTap: () async {
                                          await push(
                                              context: context,
                                              screen: Single_Page(
                                                  user_id: lists[0]['id']));
                                          setState(() {});
                                        },
                                        behavior: HitTestBehavior.translucent,
                                        child: ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          child: Image.network(
                                            lists[0]['image'],
                                            height: 50,
                                            width: 50,
                                          ),
                                        ),
                                      ),
                                      top: 70,
                                      left: 10.0,
                                    ),
                                  if (lists.length >= 2)
                                    Positioned(
                                      right: 10.0,
                                      top: 0,
                                      child: GestureDetector(
                                        onTap: () async {
                                          await push(
                                              context: context,
                                              screen: Single_Page(
                                                  user_id: lists[1]['id']));
                                          setState(() {});
                                        },
                                        behavior: HitTestBehavior.translucent,
                                        child: ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          child: Image.network(
                                            lists[1]['image'],
                                            height: 50,
                                            width: 50,
                                          ),
                                        ),
                                      ),
                                    ),
                                  if (lists.length >= 3)
                                    Positioned(
                                      right: 150.0,
                                      top: 0,
                                      child: GestureDetector(
                                        onTap: () async {
                                          await push(
                                              context: context,
                                              screen: Single_Page(
                                                  user_id: lists[2]['id']));
                                          setState(() {});
                                        },
                                        behavior: HitTestBehavior.translucent,
                                        child: ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          child: Image.network(
                                            lists[2]['image'],
                                            height: 50,
                                            width: 50,
                                          ),
                                        ),
                                      ),
                                    ),
                                  if (lists.length >= 4)
                                    Positioned(
                                      right: 150.0,
                                      bottom: 0,
                                      child: GestureDetector(
                                        onTap: () async {
                                          await push(
                                              context: context,
                                              screen: Single_Page(
                                                  user_id: lists[3]['id']));
                                          setState(() {});
                                        },
                                        behavior: HitTestBehavior.translucent,
                                        child: ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          child: Image.network(
                                            lists[3]['image'],
                                            height: 50,
                                            width: 50,
                                          ),
                                        ),
                                      ),
                                    ),
                                  if (lists.length >= 5)
                                    Positioned(
                                      right: 10.0,
                                      bottom: 0,
                                      child: GestureDetector(
                                        onTap: () async {
                                          await push(
                                              context: context,
                                              screen: Single_Page(
                                                  user_id: lists[4]['id']));
                                          setState(() {});
                                        },
                                        behavior: HitTestBehavior.translucent,
                                        child: ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          child: Image.network(
                                            lists[4]['image'],
                                            height: 50,
                                            width: 50,
                                          ),
                                        ),
                                      ),
                                    ),
                                ],
                              ),
                            ],
                          ),
                        ),
                        vSizedBox6,
                        if (!matching)
                          Container(
                            height: 42,
                            margin: EdgeInsets.symmetric(
                                horizontal: 50, vertical: 0),
                            padding: EdgeInsets.all(0),
                            decoration: BoxDecoration(
                              boxShadow: [
                                BoxShadow(
                                    color: Color(0xFE1CDBC1)
                                        .withOpacity(0.5),
                                    offset: Offset(0, 0),
                                    spreadRadius: 8)
                              ],
                              borderRadius: BorderRadius.circular(100),
                              gradient: LinearGradient(
                                begin: Alignment.topCenter,
                                end: Alignment.bottomCenter,
                                stops: [0.0, 1.0],
                                colors: [
                                  Color(0xFE1CDBC1),
                                  Color(0xFE12C7AE),
                                ],
                              ),
                            ),
                            child: ElevatedButton(
                              onPressed: () async {
                                bool? result = await showDialog(
                                  context: context,
                                  builder: (BuildContext context) =>
                                      SimpleDialog(
                                    backgroundColor: Colors.transparent,
                                    // title:const Text('GeeksforGeeks'),
                                    children: [
                                      Container(
                                        // height: 450,
                                        width: 350,
                                        padding: EdgeInsets.all(25),
                                        decoration: BoxDecoration(
                                            borderRadius:
                                                BorderRadius.circular(
                                                    20),
                                            color: Color(0xFE1CDBC1),
                                            boxShadow: [
                                              BoxShadow(
                                                  color: Color(
                                                          0xFE1CDBC1)
                                                      .withOpacity(0.5),
                                                  spreadRadius: 10)
                                            ]),
                                        child: Column(
                                          children: [
                                            Row(
                                              children: [
                                                Image.asset(
                                                  'assets/warn.png',
                                                  width: 50,
                                                ),
                                                SizedBox(
                                                  width: 10,
                                                ),
                                                Expanded(
                                                  flex: 9,
                                                  child: Column(
                                                    crossAxisAlignment:
                                                        CrossAxisAlignment
                                                            .start,
                                                    children: [
                                                      Text('PROHIBITED',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  25,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w800,
                                                              letterSpacing:
                                                                  3)),
                                                      Text(
                                                          'In matching',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  20,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600)),
                                                    ],
                                                  ),
                                                )
                                              ],
                                            ),
                                            SizedBox(
                                              height: 30,
                                            ),
                                            Row(
                                              children: [
                                                Expanded(
                                                  flex: 6,
                                                  child: Column(
                                                    mainAxisAlignment:
                                                        MainAxisAlignment
                                                            .center,
                                                    children: [
                                                      Image.asset(
                                                        'assets/knife.png',
                                                        width: 60,
                                                      ),
                                                      SizedBox(
                                                        height: 5,
                                                      ),
                                                      Text('No Knife',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  20,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600)),
                                                    ],
                                                  ),
                                                ),
                                                Expanded(
                                                  flex: 6,
                                                  child: Column(
                                                    mainAxisAlignment:
                                                        MainAxisAlignment
                                                            .center,
                                                    children: [
                                                      Image.asset(
                                                        'assets/abuse.png',
                                                        width: 60,
                                                      ),
                                                      SizedBox(
                                                        height: 5,
                                                      ),
                                                      Text('No Abuse',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  20,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600)),
                                                    ],
                                                  ),
                                                ),
                                              ],
                                            ),
                                            SizedBox(
                                              height: 25,
                                            ),
                                            Row(
                                              children: [
                                                Expanded(
                                                  flex: 6,
                                                  child: Column(
                                                    mainAxisAlignment:
                                                        MainAxisAlignment
                                                            .center,
                                                    children: [
                                                      Image.asset(
                                                        'assets/face.png',
                                                        width: 60,
                                                      ),
                                                      SizedBox(
                                                        height: 5,
                                                      ),
                                                      Text('Show Face',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  20,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600)),
                                                    ],
                                                  ),
                                                ),
                                                Expanded(
                                                  flex: 6,
                                                  child: Column(
                                                    mainAxisAlignment:
                                                        MainAxisAlignment
                                                            .center,
                                                    children: [
                                                      Image.asset(
                                                        'assets/xxx.png',
                                                        width: 60,
                                                      ),
                                                      SizedBox(
                                                        height: 5,
                                                      ),
                                                      Text('Ban Porn',
                                                          style: TextStyle(
                                                              color: Colors
                                                                  .white,
                                                              fontSize:
                                                                  20,
                                                              fontWeight:
                                                                  FontWeight
                                                                      .w600)),
                                                    ],
                                                  ),
                                                ),
                                              ],
                                            ),
                                            SizedBox(
                                              height: 35,
                                            ),
                                            SolidBtn(
                                                BtnText: 'I Understand',
                                                BgColorTop:
                                                    Color(0xFE7D44CF),
                                                BgColorBottom:
                                                    Color(0xFE7D44CF),
                                                TextColor: Colors.white,
                                                ShadowColor:
                                                    Color(0xFE7D44CF),
                                                funcTap: () async {
                                                  // loadingShow(context);

                                                  // await push(
                                                  //     context: context,
                                                  //     screen:
                                                  //     MatchFoundPage());
                                                  Navigator.pop(
                                                      context, true);
                                                  // loadingHide(context);
                                                  // setState(() {
                                                  //
                                                  // });
                                                })
                                          ],
                                        ),
                                      )
                                    ],
                                  ),
                                );
                                if (result == true) {
                                  if (userData!.coins == 0 &&
                                      userData!.gender ==
                                          UserGender.male) {
                                    showSnackbar(
                                        'Please Purchase Coins to continue');
                                    await push(
                                        context: context,
                                        screen: Get_Coins_Page());
                                    setState(() {});
                                  } else {
                                    print('3------------------aaa');
                                    getMatch();
                                  }

                                  // get_users();
                                }
                              },
                              style: ElevatedButton.styleFrom(
                                  primary: Colors.transparent,
                                  onSurface: Colors.transparent,
                                  shadowColor: Colors.transparent,
                                  shape: StadiumBorder()),
                              child: Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.center,
                                children: [
                                  Text(
                                    'Start Match',
                                    style: TextStyle(
                                        fontSize: 17,
                                        fontWeight: FontWeight.w700,
                                        color: Colors.white),
                                  )
                                ],
                              ),
                            ),
                          )
                        else
                          Container(
                            height: 42,
                            margin: EdgeInsets.symmetric(
                                horizontal: 50, vertical: 0),
                            padding: EdgeInsets.all(0),
                            decoration: BoxDecoration(
                              boxShadow: [
                                BoxShadow(
                                    color: Color(0xFE1CDBC1)
                                        .withOpacity(0.5),
                                    offset: Offset(0, 0),
                                    spreadRadius: 8)
                              ],
                              borderRadius: BorderRadius.circular(100),
                              gradient: LinearGradient(
                                begin: Alignment.topCenter,
                                end: Alignment.bottomCenter,
                                stops: [0.0, 1.0],
                                colors: [
                                  Color(0xFE1CDBC1),
                                  Color(0xFE12C7AE),
                                ],
                              ),
                            ),
                            child: ElevatedButton(
                              onPressed: () async {
                                await audioPlayer.dispose();
                                audioPlayer = AudioPlayer();
                                setState(() {
                                  matching = false;
                                });
                              },
                              style: ElevatedButton.styleFrom(
                                  primary: Colors.transparent,
                                  onSurface: Colors.transparent,
                                  shadowColor: Colors.transparent,
                                  shape: StadiumBorder()),
                              child: Row(
                                mainAxisAlignment:
                                MainAxisAlignment.center,
                                children: [
                                  Text(
                                    'Stop Match',
                                    style: TextStyle(
                                        fontSize: 17,
                                        fontWeight: FontWeight.w700,
                                        color: Colors.white),
                                  )
                                ],
                              ),
                            ),
                          )
                      ],
                    ),
                  ),
                ),
                Positioned(
                  top: 96,
                  right: 16,
                  child: Row(
                    children: [
                      SubHeadingText('Online Status: ', color: Colors.white,),
                      Switch(
                        value: onlineStatus,
                        onChanged: (value)async{
                          onlineStatus = !onlineStatus;
                          setState(() {

                          });
                          var request= {
                            'user_id': userData!.id,
                            'is_online': onlineStatus?'1':'2',
                          };
                          var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.editProfile, request: request);
                          MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);
                          setState(() {
                            
                          });
                        },
                        splashRadius: 80,
                        activeColor: MyColors.primaryColor,
                      ),
                    ],
                  ),
                )
              ],
            ),
    );
  }
}
