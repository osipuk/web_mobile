import 'dart:developer';

import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';

class ChangePassword extends StatefulWidget {
  const ChangePassword({Key? key}) : super(key: key);

  @override
  ChangePasswordState createState() => ChangePasswordState();
}

class ChangePasswordState extends State<ChangePassword> {

  bool currentPassword = true;
  bool newPassword = true;
  bool confirmPassword = true;
  final TextEditingController password = TextEditingController();
  final TextEditingController new_pass = TextEditingController();
  final TextEditingController confirm_pass = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
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
                  AppBar(
                    backgroundColor: Colors.transparent,
                    leading: IconButton(
                      icon: Icon(Icons.arrow_back_ios_new_rounded, color: Colors.white,),
                      onPressed: () => {
                        Navigator.pop(context)
                      },
                    ),
                    title: Text('Change Password', style: TextStyle(color: Colors.white, fontSize: 16),),
                    centerTitle: true,
                    shadowColor: Colors.transparent,
                    shape: Border(
                        bottom: BorderSide(
                            color: Colors.white,
                            width: 1
                        )
                    ),
                  ),
                  SizedBox(height: 40,),

                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        roundedInput(
                            controler_: password,
                            placeholder: 'Current Password',
                          obscuretext: currentPassword,
                          suffix: IconButton(onPressed: (){
                            setState(() {
                              currentPassword = !currentPassword;
                              setState(() {

                              });
                            });
                          },icon: Icon(currentPassword?Icons.visibility_off:Icons.visibility, color: Colors.white,)),
                        ),
                        SizedBox(height: 20,),
                        roundedInput(
                            controler_: new_pass,
                            placeholder: 'New Password',
                          obscuretext: newPassword,
                          suffix: IconButton(onPressed: (){
                            setState(() {
                              newPassword = !newPassword;
                              setState(() {

                              });
                            });
                          },icon: Icon(newPassword?Icons.visibility_off:Icons.visibility, color: Colors.white,)),
                        ),
                        SizedBox(height: 20,),
                        roundedInput(
                          controler_: confirm_pass,
                            placeholder: 'Confirm Password',
                          obscuretext: confirmPassword,
                          suffix: IconButton(onPressed: (){
                            setState(() {
                              confirmPassword = !confirmPassword;
                              setState(() {

                              });
                            });
                          },icon: Icon(confirmPassword?Icons.visibility_off:Icons.visibility, color: Colors.white,)),
                        ),
                        SizedBox(height: 50,),
                        SolidBtn(BtnText: 'Update',    funcTap: () async {

                          if (validatePassword(password.text) == null && ValidatepasswordMetch(new_pass.text,confirm_pass.text)==null) {
                            Map data = {
                              "user_id":userData!.id,
                               "email":userData!.emailId,
                               "old_password":password.text,
                              "new_password":new_pass.text
                              // 'email': email.text
                            };
                            log("chacekk------"+data.toString());
                            loadingShow(context);

                            Map res = await postData(data, 'change_password', 0, 0);
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
                        },),

                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }





}
