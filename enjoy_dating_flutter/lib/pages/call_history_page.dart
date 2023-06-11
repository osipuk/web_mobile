import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/global_functions.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/image_urls.dart';
import '../modals/user_modal.dart';
import '../services/video_call_page.dart';
import '../single.dart';
class CallHistoryPage extends StatefulWidget {
  final String apiUrl;
  const CallHistoryPage({Key? key, required this.apiUrl}) : super(key: key);

  @override
  _CallHistoryPageState createState() => _CallHistoryPageState();
}

class _CallHistoryPageState extends State<CallHistoryPage> {
  
  bool load = false;
  List callHistory = [];
  getCallHistory()async{


    setState(() {
      load = true;
    });
    callHistory = await Webservices.getList(widget.apiUrl + '?user_id=${userData!.id}');
    setState(() {
      load = false;
    });

  }
  @override
  void initState() {
    // TODO: implement initState
    getCallHistory();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return load?CustomLoader(): Container(
      child:callHistory.length==0?Center(child: ParagraphText('No Calls Found', color: Colors.white,),): ListView.builder(
          itemCount: callHistory.length,
          itemBuilder: (context, index){
            bool isIncoming = callHistory[index]['sender_id']==userData!.id?false:true;
            String duration = '';
            // if()
            Duration d = DateTime.parse(callHistory[index]['duration']??DateTime.now().toString()).difference(DateTime.parse(callHistory[index]['attempt_time']??DateTime.now().toString()));
            if(callHistory[index]['attempt_time']==null || callHistory[index]['duration']==null){
              print('hello world');
              d = Duration.zero;
            }else{
              duration = secondsInTimerFormat(d.inSeconds-2);
            }
            print('attempt time isss ${callHistory[index]['attempt_time']}and  ${callHistory[index]['duration']}');
            // duration = '${d.inMinutes}:${d.inSeconds%60}';

            return Container(
              padding: EdgeInsets.symmetric(horizontal: 16,vertical: 6),
              decoration: BoxDecoration(
                color: Colors.white,
                border: Border(bottom: BorderSide(color: Colors.black54)),
              ),
              child: Row(
                children: [
                  GestureDetector(onTap: (){
                    push(context: context, screen: Single_Page(user_id: isIncoming?callHistory[index]['user_data']['id']:callHistory[index]['user_data']['id'],));
                  },child: CustomCircularImage(imageUrl: isIncoming?callHistory[index]['user_data']['image']:callHistory[index]['user_data']['image'])),
                  hSizedBox,
                  Expanded(
                    child: GestureDetector(
                      behavior: HitTestBehavior.opaque,
                      onTap: (){
                        push(context: context, screen: VideoCallScreen(name:isIncoming?callHistory[index]['user_data']['name']:callHistory[index]['user_data']['name'],userId: isIncoming?callHistory[index]['user_data']['id']:callHistory[index]['user_data']['id'],isFollow: isIncoming?callHistory[index]['user_data']['is_follow']??'0':callHistory[index]['user_data']['is_follow']??'0',age:isIncoming?(callHistory[index]['user_data']['age']??'21').toString():(callHistory[index]['user_data']['age']??'21').toString(),image: isIncoming?callHistory[index]['user_data']['image']??'':callHistory[index]['user_data']['image']??'',));
                      },
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          SubHeadingText(isIncoming?callHistory[index]['user_data']['name']:callHistory[index]['user_data']['name'],color: isIncoming?d==Duration.zero?Colors.red:Colors.green: MyColors.backcolor,),
                          vSizedBox05,
                          Row(
                            children: [
                              Icon(Icons.videocam),
                              hSizedBox05,
                              ParagraphText(isIncoming?d==Duration.zero?'Missed':'Incoming': 'Outgoing',color: isIncoming?d==Duration.zero?Colors.red:Colors.green: MyColors.primaryColor),
                            ],
                          )


                        ],
                      ),
                    ),
                  ),
                  hSizedBox05,
                  Column(
                    // crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      ParagraphText(duration),
                      if(userData!.gender==UserGender.female)
                        Row(
                          crossAxisAlignment: CrossAxisAlignment.end,
                          children:[
                            ParagraphText('${callHistory[index]['female_earnings']}', fontSize: 20,),
                            hSizedBox05,
                            CustomCircularImage(imageUrl:MyImages.diamond, height: 30,width: 30,fileType: CustomFileType.asset,),

                            
                          ]
                        )
                    ],
                  ),
                ],
              ),
            );
          }

      ),
    );
  }
}
