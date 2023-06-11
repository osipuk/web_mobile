import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/single.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';

import 'constants/global_data.dart';
import 'constants/navigation_functions.dart';

class UserBlockedPage extends StatefulWidget {
  const UserBlockedPage({Key? key}) : super(key: key);

  @override
  _UserBlockedPageState createState() => _UserBlockedPageState();
}

class _UserBlockedPageState extends State<UserBlockedPage> {
  List lists=[];
  bool load=false;


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    get_lists();
  }

  get_lists() async{
    setState(() {
      load=true;
    });
    Map data = {
      'user_id': userData?.id,
    };
    Map res = await getData(data,'blockedUserList',0,0);
    print('user list===$res');
    if(res['status'].toString()=='1'){
      lists=res['block_users'];
      setState(() {

      });
    } else {
      lists=[];
    }
    setState(() {
      load=false;
    });

  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load?CustomLoader():
      Stack(
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
                    title: Text('Blocked Users', style: TextStyle(color: Colors.white, fontSize: 16),),
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
                        for(int i=0;i<lists.length;i++)
                        Padding(
                          padding: const EdgeInsets.all(10.0),
                          child: GestureDetector(
                            onTap: (){
                              push(context: context, screen: Single_Page(user_id:lists[i]['id']));
                            },
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Row(
                                  children: [
                                    CustomCircleAvatar(
                                        imageUrl: lists[i]['image'],
                                        localImage: false,
                                        assetImage: false,
                                        width: 50, height: 50
                                    ),
                                    hSizedBox2,
                                    Text('${lists[i]['name']}', style: TextStyle(fontFamily: 'Nunito', fontWeight: FontWeight.w500, color: Colors.white),),
                                  ],
                                ),
                                ElevatedButton(
                                  onPressed: () => {
                                    unblock_user(lists[i]['id'].toString())
                                  },
                                  child: Text('Unblock', style: TextStyle(fontFamily: 'Nunito', fontWeight: FontWeight.w400, fontSize: 12, letterSpacing: 1),),
                                  style: ElevatedButton.styleFrom(
                                    shape: StadiumBorder(),
                                    primary: Colors.red.shade500,
                                    elevation: 0
                                  ),
                                )
                              ],
                            ),
                            behavior: HitTestBehavior.translucent,
                          ),
                        ),
                        if(lists.length==0)
                        Center(
                          child: Text('No users blocked.',style: TextStyle(color: Colors.white),),
                        ),
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

  unblock_user(String user_id) async{
    Map data = {
      'blocked_by':  userData?.id,
      'blocked_to':user_id,
    };
    loadingShow(context);
    Map res = await getData(data,'unblockUser',0,0);
    loadingHide(context);
    print('----$res');
    if(res['status'].toString()=='1'){
      Navigator.pop(context);
    }
  }
}
