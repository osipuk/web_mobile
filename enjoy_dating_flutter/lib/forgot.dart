import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/pages/terms_and_conditions.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/tabs.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';

class ForgotPage extends StatefulWidget {
  const ForgotPage({Key? key}) : super(key: key);

  @override
  _ForgotPageState createState() => _ForgotPageState();
}

class _ForgotPageState extends State<ForgotPage> {
  final TextEditingController email = TextEditingController();
  // final TextEditingController pass = TextEditingController();


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
     // extendBody: true,
     appBar:AppBar(
       elevation: 0,
        backgroundColor: Colors.transparent,
        // leading: IconButton(
        //   icon: Icon(Icons.arrow_back_ios_new_rounded, color: Colors.white,),
        //   onPressed: () => {},
        // ),
        title: Text('', style: TextStyle(color: Colors.white, fontSize: 16),),
        centerTitle: true,
        shadowColor: Colors.transparent,
      ),
      body: Stack(
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
                  SizedBox(height: 40,),

                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        vSizedBox8,
                        Text('Forgot Password!', style: TextStyle(color: Colors.white, fontSize: 26, fontWeight: FontWeight.bold, letterSpacing: 1)),
                        Text('Enter your email to continue', style: TextStyle(color: Colors.white.withOpacity(0.8), fontSize: 16),),
                        SizedBox(height: 50,),
                        roundedInput(
                          controler_: email,
                            placeholder: 'Email'

                        ),
                        SizedBox(height: 20,),



                        SizedBox(height: 30,),
                        SolidBtn(BtnText: 'Submit',
                            funcTap: () async {
                              if (validateEmail(email.text) == null) {
                                Map data = {
                                  'email': email.text
                                };
                                  loadingShow(context);
                                Map res = await postData(data, 'forgot_password', 0, 0);
                                loadingHide(context);
                                print('login----------$res');
                                if (res['status'].toString() == '1') {
                                  presentToast(res['message']);
                                  Navigator.pop(context);
                                } else {
                                  presentToast(res['message']);
                                }
                              }
                              // push(context: context, screen: UploadPicPage());
                            },
                        //      funcTap: ()=>{
                        //  push(context: context, screen: tabs_second_page())
                        // }
                        ),
                        SizedBox(height:30),

                        GestureDetector(
                            onTap: (){Navigator.pop(context);},
                            child: Center(child: Text('back to login?', textAlign:TextAlign.center,style: TextStyle(color: Colors.white, fontSize: 14, fontWeight: FontWeight.bold, letterSpacing: 1)))),

                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
          Align(
            alignment: Alignment.bottomCenter,
            child:   Padding(
              padding: const EdgeInsets.all(16.0),
              child: GestureDetector(
                onTap: ()=>{push(context: context, screen: TermsAndConditions()),},
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text('Terms and Conditions', style: TextStyle(fontSize: 16, color: Colors.white),)
                  ],
                ),
              ),
            ),
          )
        ],
      ),
    );
  }
}
