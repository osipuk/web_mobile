import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/tabs.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

class PermissionPage extends StatefulWidget {
  const PermissionPage({Key? key}) : super(key: key);

  @override
  _PermissionPageState createState() => _PermissionPageState();
}

class _PermissionPageState extends State<PermissionPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView (
        child: Container(

          height: MediaQuery.of(context).size.height,
          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.symmetric(horizontal: 40),
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
          child: Column(
            children: [
              SizedBox(height: 60,),
              RichText(
                textAlign: TextAlign.center,
                text: TextSpan(
                  children: [
                    TextSpan(text: 'Ok!',
                        style: TextStyle(
                            fontSize: 25,
                            fontFamily: 'bold',
                            color: MyColors.primaryColor,
                        )
                    ),
                    TextSpan(
                      text:' we need some access to make a Videocalls',
                      style: TextStyle(color: Colors.white, fontSize: 25, fontFamily: 'regular'),
                    ),
                  ],
                ),
              ),
              SizedBox(height: 60,),
              Row(
                children: [
                  Image.asset('assets/camera.png',height: 50,),
                  SizedBox(width: 20,),
                  Expanded(
                    flex: 8,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Camera', style: TextStyle(fontSize: 18, fontWeight: FontWeight.w700, color: Colors.white),),
                        Text('We need camera access to give you access to add stories, and call.', style: TextStyle(fontSize: 12, color: Colors.white),)
                      ],
                    ),
                  )
                ],
              ),
              SizedBox(height: 35,),
              Row(
                children: [
                  Expanded(
                    flex: 8,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Microphone', style: TextStyle(fontSize: 18, fontWeight: FontWeight.w700, color: Colors.white),),
                        // SizedBox(height: 5,),
                        Text('We need camera access to record your stories and for video calling.', style: TextStyle(fontSize: 12, color: Colors.white),)
                      ],
                    ),
                  ),
                  SizedBox(width: 20,),
                  Image.asset('assets/mic.png', height: 50,),
                ],
              ),
              SizedBox(height: 35,),
              Row(
                children: [
                  Image.asset('assets/bell.png', height: 50,),
                  SizedBox(width: 20,),
                  Expanded(
                    flex: 8,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Notification', style: TextStyle(fontSize: 18, fontWeight: FontWeight.w700, color: Colors.white),),
                        Text('We need notification access to always get you notified on every update.', style: TextStyle(fontSize: 12, color: Colors.white),)
                      ],
                    ),
                  )
                ],
              ),
              SizedBox(height: 35,),
              Row(
                children: [
                  Expanded(
                    flex: 8,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Locations', style: TextStyle(fontSize: 18, fontWeight: FontWeight.w700, color: Colors.white),),
                        SizedBox(height: 5,),
                        Text('We need your location access to find nearby matches', style: TextStyle(fontSize: 12, color: Colors.white),)
                      ],
                    ),
                  ),
                  SizedBox(width: 20,),
                  Image.asset('assets/location.png', height: 40,),

                ],
              ),
              SizedBox(height: 60,),
              SolidBtn(BtnText: 'Allow All Access', funcTap: () => {
                Navigator.popUntil(context, (route) => route.isFirst),
                pushReplacement(context: context, screen: TabsScreen(fromSignup: true,))
              },)
            ],
          ),
        ),
      ),
    );
  }
}
