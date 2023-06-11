import 'dart:async';

import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/pages/chat_page.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/tabs.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/block_layout.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';


class ChatListPage extends StatefulWidget {
  const ChatListPage({Key? key}) : super(key: key);

  @override
  _ChatListPageState createState() => _ChatListPageState();
}

class _ChatListPageState extends State<ChatListPage> with AutomaticKeepAliveClientMixin {

  bool load = false;
  List userList = [];


  Timer? chatTimer;


  reloadMessages()async{
    await Future.delayed(Duration(seconds: 5));
    getUserMessages();
    reloadMessages();

  }
  getUserMessages({bool shouldLoad = false})async{
    // sets
   if(shouldLoad){
     setState((){
       load = true;
     });
   }
    try{
      userList = await Webservices.getList(ApiUrls.getChatList + '?user_id=${userData!.id}');
    }catch(e){
     print('Error in catch block 9485 $e');
    }
   if(shouldLoad){
     load = false;
   }
   try{
     setState(() {

     });
   }catch(e){
     print('Error in catch block x9485 $e');
   }

  }

  @override
  void initState() {
    // TODO: implement initState
    getUserMessages(shouldLoad: true);
    reloadMessages();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load?CustomLoader(): Stack(
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
                    // leading: IconButton(
                    //   icon: Icon(Icons.check_box_outline_blank, color: Colors.white,),
                    //   onPressed: () => {},
                    // ),
                    title: Text('Messages', style: TextStyle(color: Colors.white, fontSize: 16),),
                    centerTitle: true,
                    shadowColor: Colors.transparent,
                    shape: Border(
                        bottom: BorderSide(
                            color: Colors.white.withOpacity(0.50),
                            width: 0.2
                        )
                    ),

                  ),
                  SizedBox(height: 40,),

                  // RoundEdgedButton(text: 'change to profile', onTap: (){
                  //   selectedIndex = 0;
                  //   print('hiiiiii');
                  //
                  //   this.setState(() {
                  //
                  //   });
                  // },),
                  Expanded(
                    child:userList.length==0?Center(child: ParagraphText('No Users Found', color: Colors.white, textAlign: TextAlign.center,),):ListView.builder(
                      itemCount: userList.length,
                      itemBuilder: (context, index){
                        return Padding(
                          padding: const EdgeInsets.only(bottom: 20),
                          child: GestureDetector(
                            onTap: (){
                              push(context: context, screen: ChatPage(info: userList[index]['sender_data']));
                            },
                            child: BlockLayout(
                              PersonName: userList[index]['sender_data']['name'],
                              Chat: userList[index]['message_type']!='text'?userList[index]['message_type']: userList[index]['last_message'],
                              ImagePath: userList[index]['sender_data']['image'],
                              unreadCount: int.parse(userList[index]['unread_count']??'0'),
                            ),
                          ),
                        );
                      },
                    ),
                  ),

                  // GestureDetector(
                  //   onTap: (){
                  //     push(context: context, screen: Chat_Detail_Page());
                  //   },
                  //   child: BlockLayout(
                  //     PersonName: 'Rosella William',
                  //     Chat: 'How are you?',
                  //     ImagePath: 'assets/chat_person.png',
                  //   ),
                  // ),
                  // SizedBox(height: 20,),
                  // BlockLayout(PersonName: 'Rosella William', Chat: 'How are you?', ImagePath: 'assets/chat_person.png',),
                  // SizedBox(height: 20,),
                  // BlockLayout(PersonName: 'Rosella William', Chat: 'How are you?', ImagePath: 'assets/chat_person.png',),

                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  @override
  // TODO: implement wantKeepAlive
  bool get wantKeepAlive => true;
}
