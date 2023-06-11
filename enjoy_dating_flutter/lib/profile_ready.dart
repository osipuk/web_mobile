import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/widget/permission.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';

class ProfileReadyPage extends StatefulWidget {
  const ProfileReadyPage({Key? key}) : super(key: key);

  @override
  _ProfileReadyPageState createState() => _ProfileReadyPageState();
}

class _ProfileReadyPageState extends State<ProfileReadyPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView (
        child: Container(
            height: MediaQuery.of(context).size.height,
            width: MediaQuery.of(context).size.width,
            padding: EdgeInsets.all(16),
            decoration: BoxDecoration(
                image: DecorationImage(
                  image: AssetImage("assets/welcome-bg.png"),
                  fit: BoxFit.cover,
                ),
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFF7D44CF),
                    Color(0xFF7D44CF)
                  ],
                )
            ),
            child: Container(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  SizedBox(height: 80,),
                  Container(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Text('Getting your profile Ready!', textAlign: TextAlign.center, style: TextStyle(color: Colors.white, fontSize: 32, fontWeight: FontWeight.bold, letterSpacing: 1)),
                        SizedBox(height: 10,),
                        Container(
                            width: 250,
                            child: Text('Please wait a second meet getting your profile ready.', textAlign: TextAlign.center, style: TextStyle(color: Colors.white.withOpacity(0.8), fontSize: 16),)
                        ),
                        SizedBox(height: 60,),
                        Container(
                            height:250,
                            width:250,
                            // clipBehavior: Clip.hardEdge,

                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(150),
                              border: Border.all(color: MyColors.active, width: 10, style: BorderStyle.solid),
                              image: DecorationImage(image:NetworkImage(userData!.imageUrl))

                            ),
                            // child: Image.network(user_data!['image'], width: 250,)
                        ),

                        SizedBox(height: 60,),
                        Container(
                      height: 55,
                      width: 100,
                      padding: EdgeInsets.all(0),
                      decoration: BoxDecoration(
                        boxShadow: [BoxShadow(
                            color: Color(0xFE1CDBC1).withOpacity(0.5),
                            offset: Offset(0, 0),
                            spreadRadius: 8
                        )],
                        borderRadius: BorderRadius.circular(15),
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
                        onPressed: () => {
                          pushReplacement(context: context, screen: PermissionPage())
                        },
                        style: ElevatedButton.styleFrom(
                            primary: Colors.transparent,
                            onSurface: Colors.transparent,
                            shadowColor: Colors.transparent,
                            shape: StadiumBorder()
                        ),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            RichText(
                              text: TextSpan(
                                children: [
                                  WidgetSpan(
                                    child: Padding(
                                      padding: const EdgeInsets.symmetric(horizontal: 2.0),
                                      child: Icon(Icons.arrow_right_alt, size: 45,),
                                    ),
                                  ),
                                ],
                              ),
                            )
                          ],
                        ),
                      ),
                    )

                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
      ),
    );
  }
}
