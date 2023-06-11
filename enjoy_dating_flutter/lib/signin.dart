import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/pages/terms_and_conditions.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/firebase_push_notifications.dart';
import 'package:Enjoy/services/location.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/tabs.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';
import 'forgot.dart';
import 'modals/user_modal.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController email = TextEditingController();
  final TextEditingController pass = TextEditingController();

  bool isPassVisible = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
     resizeToAvoidBottomInset: false,
     // extendBody: true,
     appBar:AppBar(
       elevation: 0,
        backgroundColor: Colors.transparent,
        title: Text('Login', style: TextStyle(color: Colors.white, fontSize: 16),),
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
                      Text('Welcome Back!', style: TextStyle(color: Colors.white, fontSize: 26, fontWeight: FontWeight.bold, letterSpacing: 1)),
                      Text('Sign in to continue', style: TextStyle(color: Colors.white.withOpacity(0.8), fontSize: 16),),
                      SizedBox(height: 50,),
                      roundedInput(
                        controler_: email,
                          placeholder: 'Email'

                      ),
                      SizedBox(height: 20,),
                      roundedInput(
                          controler_: pass,
                          placeholder: 'Password',
                        obscuretext: isPassVisible,
                        suffix: IconButton(onPressed: (){
                          setState(() {
                            isPassVisible = !isPassVisible;
                            setState(() {

                            });
                          });
                        },icon: Icon(isPassVisible?Icons.visibility_off:Icons.visibility, color: Colors.white,)),

                      ),
                      SizedBox(height: 15,),
                      GestureDetector(
                        onTap: ()=>{
                        Navigator.of(context).push(MaterialPageRoute(builder: (context) =>
                        ForgotPage()))
                        },
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            Text('Forgot Password', style: TextStyle(color: Colors.white, fontSize: 16),),
                          ],
                        ),
                      ),
                      SizedBox(height: 30,),
                      SolidBtn(BtnText: 'Log in',
                          funcTap: () async {
                        FocusScope.of(context).requestFocus(new FocusNode());
                            if (validateEmail(email.text) == null && validatePassword(pass.text) == null) {
                              Map data = {
                                'email': email.text,
                                'password': pass.text,
                              };
                              loadingShow(context);
                              var position = await determinePosition();
                              if(position!=null){
                                data['lat'] = position.latitude.toString();
                                data['lng'] = position.longitude.toString();
                              }

                              Map res = await postData(data, 'login', 0, 0);
                              loadingHide(context);
                              print('login----------$res');
                              if (res['status'].toString() == '1') {
                                updateUserDetails(res['data']);
                                userData=UserModal.fromJson(res['data']);
                                String? token = await FirebasePushNotifications.getToken();
                                if(token!=null){
                                  await Webservices.updateDeviceToken(userId: userData!.id, token: token);
                                }else{
                                  print('device token is null');
                                }
                                // Navigator.of(context)
                                //     .pushAndRemoveUntil(tabs_second_page(), (Route<dynamic> route) => false);


                                Navigator.of(context).pushAndRemoveUntil(MaterialPageRoute(builder: (context) =>
                                    TabsScreen()), (Route<dynamic> route) => false);
                              // push(context: context, screen: UploadPicPage());
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

                    ],
                  ),
                ),
              ],
            ),
          ),
          Align(
            alignment: Alignment.bottomCenter,
            child:   Padding(
              padding: const EdgeInsets.all(16.0),
              child: GestureDetector(
                onTap: ()=>{
                push(context: context, screen: TermsAndConditions()),
                },
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
