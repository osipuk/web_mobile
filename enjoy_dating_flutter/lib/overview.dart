import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:flutter/material.dart';

import 'constants/colors.dart';

class OverviewPage extends StatefulWidget {
  const OverviewPage({Key? key}) : super(key: key);

  @override
  _OverviewPageState createState() => _OverviewPageState();
}

class _OverviewPageState extends State<OverviewPage> {

  bool load = true;
  Map todayData = {};
  Map weeklyData = {};
  getStatistics()async{
    // setState(() {
    //   load = true;
    // });
    Map tempData = await Webservices.getMap(ApiUrls.callHistoryDashBoard + 'user_id=${userData!.id}');
    todayData = tempData['data_today'];
    weeklyData = tempData['data_weekly'];
    setState(() {
      load = false;
    });
  }
  @override
  void initState() {
    // TODO: implement initState
    getStatistics();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load?CustomLoader():Stack(
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
                    title: Text('Overview', style: TextStyle(color: Colors.white, fontSize: 16),),
                    centerTitle: true,
                    shadowColor: Colors.transparent,
                    shape: Border(
                        bottom: BorderSide(
                            color: Colors.white.withOpacity(0.50),
                            width: 0.5
                        )
                    ),
                  ),
                  SizedBox(height: 40,),

                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 16),
                    child: Column(
                      children: [
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Container(
                              padding: EdgeInsets.symmetric(vertical: 25, horizontal: 16),
                              decoration: BoxDecoration(
                                  boxShadow: [BoxShadow(
                                    color: Colors.black.withOpacity(0.3),
                                    offset: Offset(0, 3),
                                    spreadRadius: 0,
                                    blurRadius: 5

                                  )],
                                  borderRadius: BorderRadius.circular(16),
                                  gradient: LinearGradient(
                                    begin: Alignment.topCenter,
                                    end: Alignment.bottomCenter,
                                    colors: [
                                      Color(0xFE1CDBC1),
                                      Color(0xFE12C7AE)
                                    ],
                                  )
                              ),
                              child: Column(
                                children: [
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Text('Today', style: TextStyle(fontSize: 26, fontFamily: 'extrabold', color: Colors.white),),
                                    ],
                                  ),
                                  SizedBox(height: 15,),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                                    children: [
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Active Calls', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${todayData['active_calls']}', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Total Calls', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${todayData['video_calls']}', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                    ],
                                  ),
                                  SizedBox(height: 25,),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                                    children: [
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Duration', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${todayData['call_duration']} min', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Avg Rate', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${todayData['avg_rate']}%', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                            SizedBox(height: 15,),
                            Container(
                              padding: EdgeInsets.symmetric(vertical: 25, horizontal: 16),
                              decoration: BoxDecoration(
                                  boxShadow: [BoxShadow(
                                      color: Colors.black.withOpacity(0.3),
                                      offset: Offset(0, 3),
                                      spreadRadius: 0,
                                      blurRadius: 5

                                  )],
                                  borderRadius: BorderRadius.circular(16),
                                  gradient: LinearGradient(
                                    begin: Alignment.topCenter,
                                    end: Alignment.bottomCenter,
                                    colors: [
                                      Color(0xFE1CDBC1),
                                      Color(0xFE12C7AE)
                                    ],
                                  )
                              ),
                              child: Column(
                                children: [
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Text('Weekly', style: TextStyle(fontSize: 26, fontFamily: 'extrabold', color: Colors.white),),
                                    ],
                                  ),
                                  SizedBox(height: 15,),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                                    children: [
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Active Calls', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${weeklyData['active_calls']}', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Total Calls', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${weeklyData['video_calls']}', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                    ],
                                  ),
                                  SizedBox(height: 25,),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                                    children: [
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Duration', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${weeklyData['call_duration']} mins', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                      Column(
                                        crossAxisAlignment: CrossAxisAlignment.start,
                                        children: [
                                          Text('Avg Rate', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 16),),
                                          Text('${weeklyData['avg_rate']}%', style: TextStyle(fontFamily: 'bold', color: Colors.white, fontSize: 26),),
                                        ],
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ],
                        )
                      ],
                    ),
                  )

                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
