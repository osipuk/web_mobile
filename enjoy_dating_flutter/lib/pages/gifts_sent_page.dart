import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
class GiftsReceivedPage extends StatefulWidget {
  final String? userId;
  const GiftsReceivedPage({Key? key, this.userId}) : super(key: key);

  @override
  _GiftsReceivedPageState createState() => _GiftsReceivedPageState();
}

class _GiftsReceivedPageState extends State<GiftsReceivedPage> {

  bool load = false;
  List giftsReceived = [];
  getReceivedGifts()async{


    setState(() {
      load = true;
    });
    if(widget.userId!=null){
      giftsReceived = await Webservices.getList((ApiUrls.giftsSent)+ '?user_id=${widget.userId}');
    }else{
      giftsReceived = await Webservices.getList((userData!.gender==UserGender.male?ApiUrls.giftsSent:ApiUrls.giftsReceived )+ '?user_id=${userData!.id}');
    }
    setState(() {
      load = false;
    });

  }
  @override
  void initState() {
    // TODO: implement initState
    getReceivedGifts();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // appBar: appBar(context: context, title: 'Gifts Sent', ),
      body: SafeArea(
        child: load?CustomLoader(): Container(
          // padding: EdgeInsets.only(top: 30),
          child: Column(
            children: [
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Row(
                  children: [
                    GestureDetector(child: Icon(Icons.arrow_back), onTap: (){
                      Navigator.pop(context);
                    },),
                    hSizedBox2,
                    SubHeadingText(userData!.gender==UserGender.male || widget.userId!=null?'Gifts Sent':'Gifts Received')
                  ],
                ),
              ),
              vSizedBox,
              Expanded(
                child:giftsReceived.length==0?Center(child: ParagraphText('No Gifts sent yet.'),): ListView.builder(
                    itemCount: giftsReceived.length,
                    itemBuilder: (context, index){
                      // bool isIncoming = giftsReceived[index]['sender_id']==userData!.id?false:true;
                      // String duration = '';
                      // Duration d = DateTime.parse(giftsReceived[index]['updated_at']??DateTime.now().toString()).difference(DateTime.parse(giftsReceived[index]['attempt_time']??DateTime.now().toString()));
                      // duration = '${d.inMinutes}:${d.inSeconds%60}';
                      return Container(
                        padding: EdgeInsets.symmetric(horizontal: 16,vertical: 6),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          border: Border(bottom: BorderSide(color: Colors.black54)),
                        ),
                        child: Row(
                          children: [
                            CustomCircularImage(imageUrl:userData!.gender==UserGender.male  || widget.userId!=null?giftsReceived[index]['send_to']['image']:giftsReceived[index]['send_by']['image']),
                            hSizedBox,
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  SubHeadingText(userData!.gender==UserGender.male  || widget.userId!=null?giftsReceived[index]['send_to']['name']:giftsReceived[index]['send_by']['name'],),
                                  vSizedBox05,
                                  Row(
                                    children: [
                                      ParagraphText(userData!.gender==UserGender.male  || widget.userId!=null?'sent':'Sent you',),
                                      hSizedBox05,
                                      CustomCircularImage(imageUrl:giftsReceived[index]['gift_details']['image'], height: 30,width: 30,),


                                    ],
                                  )


                                ],
                              ),
                            ),
                            hSizedBox05,
                            ParagraphText(userData!.gender==UserGender.male || widget.userId!=null?'${giftsReceived[index]['gift_details']['coin_value']}': 'Received ${giftsReceived[index]['diamonds']}'),
                            CustomCircularImage(imageUrl:userData!.gender==UserGender.male || widget.userId!=null?MyImages.coins:MyImages.diamond,fileType: CustomFileType.asset, height: 22,width: 22,),

                          ],
                        ),
                      );
                    }

                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
