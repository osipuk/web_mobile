
import 'dart:async';

import 'package:Enjoy/chat.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/match_found.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/pages/call_history_tab_page.dart';
import 'package:Enjoy/profile.dart';
import 'package:Enjoy/profile_account.dart';
import 'package:Enjoy/recent_tab_page.dart';
import 'package:Enjoy/search.dart';
import 'package:Enjoy/search_tab_page.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/callingServices.dart';
import 'package:Enjoy/services/calling_services.dart';
import 'package:Enjoy/services/common.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/signin.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_native_timezone/flutter_native_timezone.dart';

import 'constants/global_data.dart';
import 'dialogs/afterSignupPopup.dart';
import 'dialogs/showFeedbackDialog.dart';

class TabsScreen extends StatefulWidget {
  final bool fromSignup;
  static final String id = 'tabs_page';
   // int selectedIndex;
   TabsScreen({Key? key,this.fromSignup = false
     // this.selectedIndex = 1,
   }) : super(key: key);


  @override
  _TabsScreenState createState() => _TabsScreenState();
}

class _TabsScreenState extends State<TabsScreen> {

  int selectedIndex = 2;
  static const TextStyle optionStyle =
  TextStyle(fontSize: 30, fontWeight: FontWeight.bold);
  static  List<Widget> _widgetOptions = <Widget>[
    Profile_Account_Page(),
    ChatListPage(),
    SearchPage(key: MyGlobalKeys.searchPageKey,),
    Search_Tab_Page(),
    CallHistoryTabsPage(),
    // Recent_Page()
  ];

  void _onItemTapped(int index) {
    setState(() {
      selectedIndex = index;
    });
  }

  Timer? updateLocationTimer;


  isFromSignup()async{
    if(widget.fromSignup){
      await Future.delayed(Duration(seconds: 2));
      if(userData!.gender==UserGender.male)
      showCustomDialog(InitialSignupPopup());
    }

  }

  interval_api() async {
    print('timer is running...............');
    if(updateLocationTimer!=null){
      updateLocationTimer?.cancel();
    }
    updateLocationTimer = Timer.periodic(
      const Duration(seconds: 5),
          (timer) async {
        // print('working---');
            final String currentTimeZone = await FlutterNativeTimezone.getLocalTimezone();
       try{
         Map data = {
           'user_id': userData!.id,
           'lat': lat.toString(),
           'lng': lng.toString(),
           'timezone': currentTimeZone
         };

         Map res = await getData(data, 'interval', 0, 0);
         if(res['data']!=null)

           if((res['data']['status']??'1').toString()=='0'){
             showSnackbar(res['message']);
             logout();

             Navigator.popUntil(context, (route) => route.isFirst);

             pushReplacement(context: MyGlobalKeys.navigatorKey.currentContext!, screen: LoginPage());
           }else{
             await updateUserDetails(res['data']);
             print('timer is running...............successfull ${res['data']}');
             try{
               MyGlobalKeys.searchPageKey.currentState?.setState(() {

               });
             }catch(e){
               print('Error in catch block. Not in search page ,  so set state is not possible${e}');
             }
           }

       }catch(e){
         print('Error in catch block.6789${e}');
       }
        // print('interval---$res');
        // Update user about remaining time
      },
    );
  }

  @override
  void initState() {
    // TODO: implement initState
    isFromSignup();
    // if(agoraCheckCallingTimer==null){
    CallingApiServices callingApiServices = CallingApiServices();
    callingApiServices.checkIncomingCalls();
    // }
    interval_api();
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    updateLocationTimer?.cancel();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBody: true,
      body: Center(
        child: _widgetOptions.elementAt(selectedIndex),
      ),
      bottomNavigationBar: Container(
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(30)
        ),
        margin: EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        child: BottomNavigationBar(
          backgroundColor: Colors.transparent,
          elevation: 0,
          type: BottomNavigationBarType.fixed,
          // showSelectedLabels: false,
          // showUnselectedLabels: false,
          selectedFontSize: 10,
          selectedLabelStyle: TextStyle(
            fontFamily: 'bold',
          ),
          unselectedFontSize: 0,
          unselectedItemColor: MyColors.blackColor,
          items: <BottomNavigationBarItem>[
            BottomNavigationBarItem(
              icon: Transform.translate(
                offset: Offset(0,8),
                child: ImageIcon(
                  AssetImage("assets/profile_icon.png"),
                  // color: Color(0xFFffffff),
                  size: 22,
                ),
              ),
              activeIcon:  ImageIcon(
                AssetImage("assets/profile_icon.png"),
                // color: Color(0xFFffffff),
                // size: 30,
                size: 22,
              ),
              label: 'Profile',
              backgroundColor: Colors.white,
            ),

            BottomNavigationBarItem(
              icon: Transform.translate(
                offset: Offset(0,8),
                child: ImageIcon(
                  AssetImage("assets/message_icon.png"),
                  // color: Color(0xFFffffff),
                  size: 22,
                ),
              ),
              activeIcon:  ImageIcon(
                AssetImage("assets/message_icon_active.png"),
                // color: Color(0xFFffffff),
                // size: 30,
                size: 22,
              ),
              label: 'Messages',
              backgroundColor: Colors.white,
            ),

            BottomNavigationBarItem(
              icon: Transform.translate(
                offset: Offset(0,8),
                child: ImageIcon(
                  AssetImage("assets/video_icon.png"),
                  // color: Color(0xFFffffff),
                  size: 22,
                ),
              ),
              activeIcon:  ImageIcon(
                AssetImage("assets/video_icon_active.png"),
                // color: Color(0xFFffffff),
                // size: 30,
                size: 22,
              ),
              label: 'Match',
              backgroundColor: Colors.white,
            ),

            BottomNavigationBarItem(
              icon: Transform.translate(
                offset: Offset(0,8),
                child: ImageIcon(
                  AssetImage("assets/search_icon.png"),
                  // color: Color(0xFFffffff),
                  size: 22,
                ),
              ),
              activeIcon:  ImageIcon(
                AssetImage("assets/search_icon_active.png"),
                // color: Color(0xFFffffff),
                // size: 30,
                size: 22,
              ),
              label: 'Search',
              backgroundColor: Colors.white,
            ),

            BottomNavigationBarItem(
              icon: Transform.translate(
                offset: Offset(0,8),
                child: ImageIcon(
                  AssetImage("assets/clock_icon.png"),
                  // color: Color(0xFFffffff),
                  size: 22,
                ),
              ),
              activeIcon:  ImageIcon(
                AssetImage("assets/clock_icon_active.png"),
                // color: Color(0xFFffffff),
                // size: 30,
                size: 22,
              ),
              label: 'Recent',
              backgroundColor: Colors.white,
            ),


          ],
          currentIndex: selectedIndex,
          selectedItemColor: Color(0xFF7D44CF),
          onTap: _onItemTapped,
        ),
      ),
    );
  }
}
