import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/common.dart';
import 'package:Enjoy/services/video_call_page.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/video_call.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';
import 'dialogs/showFeedbackDialog.dart';

class MatchFoundPage extends StatefulWidget {
  const MatchFoundPage({Key? key}) : super(key: key);

  @override
  _MatchFoundPageState createState() => _MatchFoundPageState();
}

class _MatchFoundPageState extends State<MatchFoundPage> {



  bool load = false;
  List glog = [];
  getNearByUsers()async{
    setState(() {
      load= true;
    });
    Map<String, dynamic> data = {
      'user_id': userData!.id,
      'lat': lat.toString(),
      'lng': lng.toString(),
      'limit': '1'
    };
    glog = await Webservices.getListFromRequestParameters(ApiUrls.searchUser, data);
    setState(() {
      load= false;
    });
  }
  @override
  void initState() {
    // TODO: implement initState
    getNearByUsers();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body:load?CustomLoader(): Stack(
        children: [
          Container(
            decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFE7D44CF),
                    Color(0xFE1F66BA)
                  ],
                )
            ),
            child: Container(
              width: MediaQuery.of(context).size.width,
              margin: EdgeInsets.only(top: 16),
              padding: EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  SizedBox(height: 35,),
                  Text('Match Found!', style: TextStyle(fontSize: 27, color: Colors.white, fontWeight: FontWeight.bold, letterSpacing: 2),),
                  SizedBox(height: 25,),
                  Expanded(
                    child: ListView.builder(
                      itemCount:glog.length ,

                      itemBuilder: (context, index){
                        return GestureDetector(
                          onTap: ()async{
                            // push(context: context, screen: VideoCallPage());

                            await push(context: context, screen: VideoCallScreen(name: glog[index]['name'],userId: glog[index]['id'],isFollow: glog[index]['is_follow'],age: glog[index]['age'].toString(),image: glog[index]['image'],));
                            if(!userData!.hasRated){
                            showCustomDialog(FeedBackDialog());
                            }
                          },
                          child: Container(
                            padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                            margin: EdgeInsets.symmetric(vertical: 8),
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(16),
                                color: Color(0xFE4AB5E1)
                            ),
                            child: Row(
                              children: [
                                CustomCircularImage(imageUrl: glog[index]['image'], height: 80,width: 80,),
                                SizedBox(width: 20,),
                                Expanded(
                                  flex: 8,
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Text('${glog[index]['name']}', style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20, color: Colors.white),),
                                      SizedBox(height: 5,),
                                      Row(
                                        children: [
                                          // Image.asset('assets/usa.png', width: 18,),
                                          SizedBox(width: 5,),
                                          Text('${glog[index]['gender']}, ${glog[index]['age']}', style: TextStyle(fontSize: 14, fontWeight: FontWeight.w300, color: Colors.white),)
                                        ],
                                      )
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          ),
                        );
                      },
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
