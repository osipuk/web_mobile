
// import '/pages/login.dart';
// import '/providers/ionic.dart';
import 'package:Enjoy/welcome.dart';
import 'package:flutter/material.dart';
import '../account.dart';
import '../constants/global_data.dart';
// import '../pages/login.dart';
import '../signin.dart';
import 'auth.dart';
double lat=0;
double lng=0;
String? address='';

void logoutConfirmation(context) {
  // set up the buttons
  Widget cancelButton = TextButton(

    child: Text("Cancel"),
    onPressed:  () {
      Navigator.pop(context);
    },
  );
  Widget continueButton = TextButton(
    child: Text("Logout"),
    onPressed:  () async  {
      await logout();

      if(callingApiServices.agoraCheckCallingTimer!=null){
        callingApiServices.agoraCheckCallingTimer!.cancel();
      }

      Navigator.of(context).pushAndRemoveUntil(MaterialPageRoute(builder: (context) =>
          AccountPage()), (Route<dynamic> route) => false);
      // setRoot(context, 'login', {});


    },
  );
  // set up the AlertDialog
  AlertDialog alert = AlertDialog(
    title: Text("Alert!"),
    content: Text("Are you sure you want to logout?"),
    actions: [
      cancelButton,
      continueButton,
    ],
  );
  // show the dialog
  showDialog(
    context: context,
    builder: (BuildContext context) {
      return alert;
    },
  );
}


Future showPopupMenu(context) async {
  return  await showMenu(
    context: context,
    position: RelativeRect.fromLTRB(200, 80, 10, 100),
    items: [
      PopupMenuItem<String>(
          padding:EdgeInsets.fromLTRB(16, 0, 16, 0),
          height:36,
          child: const Text('Edit Profile'), value: 'editprofile'),
      PopupMenuItem<String>(
          padding:EdgeInsets.fromLTRB(16, 0, 16, 0),
          height:36,
          child: const Text('Change Password'), value: 'changepassword'),
      PopupMenuItem<String>(
          padding:EdgeInsets.fromLTRB(16, 0, 16, 0),
          height:36,
          child: const Text('Logout'), value: 'logout'),
    ],
    elevation: 8.0,
  );
}


Future profileimage(context,String p) async {
  return  await showMenu(
    context: context,
    // position: RelativeRect.fromLTRB(50.0, 200.0, 20.0, 0.0),
    position: (p=='left') ? RelativeRect.fromLTRB(20.0, 250.0, 20.0, 0.0) : RelativeRect.fromLTRB(50.0, 200.0, 20.0, 0.0),
    // positionAnchor: MenuPosition.Origin,
    items: [
      PopupMenuItem<String>(

          padding:EdgeInsets.fromLTRB(16, 0, 16, 0),
          height:36,
          child: const Text('Camera'), value: 'camera'),
      PopupMenuItem<String>(
          padding:EdgeInsets.fromLTRB(16, 0, 16, 0),
          height:36,
          child: const Text('Gallery'), value: 'gallery'),
    ],
    elevation: 8.0,
  );

}
