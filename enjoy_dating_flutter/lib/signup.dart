import 'dart:developer';

import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/packages/lib/utils/google_search/place.dart';
import 'package:Enjoy/packages/lib/widget/search_widget.dart';
import 'package:Enjoy/pages/terms_and_conditions.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/firebase_push_notifications.dart';
import 'package:Enjoy/services/location.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/upload.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'modals/address_modal.dart';
import 'package:date_time_picker/date_time_picker.dart';

class SignupPage extends StatefulWidget {
  const SignupPage({Key? key}) : super(key: key);

  @override
  _SignupPageState createState() => _SignupPageState();
}

class _SignupPageState extends State<SignupPage> {
  final TextEditingController name = TextEditingController();
  final TextEditingController email = TextEditingController();
  final TextEditingController pass = TextEditingController();
  final TextEditingController c_pass = TextEditingController();
  // final TextEditingController address = TextEditingController();
  final TextEditingController dob = TextEditingController();
  String day = '';
  String month = '';
  String year = '';
  // String lat = '';
  // String lng = '';
  bool is_male = true;
  String gender='male';
  Map? selectedAgent;
  // String gender_interest='female';
  DateTime selectedDateTime = DateTime(DateTime.now().year-19);

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
            gradient: LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
        )),
        height: MediaQuery.of(context).size.height,
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              AppBar(
                backgroundColor: Colors.transparent,
                leading: IconButton(
                  icon: Icon(
                    Icons.arrow_back_ios_new_rounded,
                    color: Colors.white,
                  ),
                  onPressed: () => {
                    Navigator.pop(context),
                  },
                ),
                title: Text(
                  'Create new account',
                  style: TextStyle(color: Colors.white, fontSize: 16),
                ),
                centerTitle: true,
                shadowColor: Colors.transparent,
              ),
              SizedBox(
                height: 10,
              ),
              Container(
                padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Create an account',
                        style: TextStyle(
                            color: Colors.white,
                            fontSize: 26,
                            fontWeight: FontWeight.bold,
                            letterSpacing: 1)),
                    Text(
                      'Sign up to continue',
                      style: TextStyle(
                          color: Colors.white.withOpacity(0.8),
                          fontSize: 16),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    roundedInput(
                      placeholder: 'Name',
                      controler_: name,
                    ),
                    SizedBox(
                      height: 15,
                    ),
                    roundedInput(
                      placeholder: 'Email',
                      controler_: email,
                    ),
                    SizedBox(
                      height: 15,
                    ),
                    // SearchLocation(
                    //
                    //   placeholder: 'Search Country',
                    //   bgColor: Color(0xFE4AB5E1),
                    //   darkMode: true,
                    //   apiKey: 'AIzaSyABk-0Al27H9Ap_Rtti2t0ePxOLvl5QFzk',
                    //   iconColor: MyColors.whiteColor,
                    //   onSelected: (Place place) async {
                    //     Address addressClass = await getAddress(
                    //         place.placeId,
                    //         'AIzaSyABk-0Al27H9Ap_Rtti2t0ePxOLvl5QFzk');
                    //     print('get location${addressClass.toString()}');
                    //     lat = addressClass.latitude.toString();
                    //     lng = addressClass.longitude.toString();
                    //     log("checking countr------"+addressClass.country);
                    //     address.text = addressClass.country;
                    //     // address.text =
                    //     //     addressClass.formattedAddress.toString();
                    //   },
                    // ),
                    // SizedBox(
                    //   height: 15,
                    // ),
                    roundedInput(
                      placeholder: 'Password',
                      controler_: pass,
                      obscuretext: true,
                    ),
                    SizedBox(
                      height: 15,
                    ),
                    roundedInput(
                      placeholder: 'Confirm Password',
                      controler_: c_pass,
                      obscuretext: true,
                    ),
                    SizedBox(
                      height: 15,
                    ),



                    DateTimePicker(
                      style: TextStyle(color: Colors.white, fontWeight: FontWeight.w400),
                      decoration:  InputDecoration(
    fillColor: Color(0xFE4AB5E1),
    filled: true,
    focusedBorder: OutlineInputBorder(
    borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
    borderRadius: BorderRadius.circular(100),

    ),
    border: OutlineInputBorder(
    borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
    borderRadius: BorderRadius.circular(100),
    ),
    enabledBorder: OutlineInputBorder(
    borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
    borderRadius: BorderRadius.circular(100),
    ),
    hintText: 'Date Of Birth',
    hintStyle: TextStyle(color: Color(0xFEFFFFFF).withOpacity(0.8), fontWeight: FontWeight.w300),
    contentPadding: EdgeInsets.symmetric(vertical: 0, horizontal: 16),
    ),
                      initialValue: '',

                      firstDate: DateTime(DateTime.now().year-150),
                      lastDate:DateTime(DateTime.now().year-18),
                      initialDate: selectedDateTime,
                      dateLabelText: 'Date of birth',
                      onChanged: (val) => {
                        dob.text = val.toString(),
                      },
                      validator: (val) {
                        print(val);
                        return null;
                      },
                    ),
                    // GestureDetector(
                    //   onTap: () {
                    //     print('prasoon----');
                    //
                    //   },
                    //     child: roundedInput(placeholder: 'Date of birth',controler_: dob,inputEnable: false,)),
                    // Row(
                    //   children: [
                    //     Expanded(
                    //       flex: 4,
                    //       child: GestureDetector(
                    //         onTap: () {
                    //
                    //         },
                    //           child: roundedInput(placeholder: 'Day',))
                    //     ),
                    //     SizedBox(width: 15,),
                    //     Expanded(
                    //         flex: 4,
                    //         child: roundedInput(placeholder: 'Month')
                    //     ),
                    //     SizedBox(width: 15,),
                    //     Expanded(
                    //         flex: 5,
                    //         child: roundedInput(placeholder: 'Year')
                    //     )
                    //   ],
                    // ),
                    SizedBox(height: 25),
                    // GestureDetector(
                    //   onTap: () => {},
                    //   child: Row(
                    //     mainAxisAlignment: MainAxisAlignment.end,
                    //     children: [
                    //       Text(
                    //         'Newly Birth!',
                    //         style: TextStyle(
                    //             color: Colors.white, fontSize: 16),
                    //       ),
                    //     ],
                    //   ),
                    // ),
                    SizedBox(
                      height: 0,
                    ),

                    Text(
                      'Gender',
                      style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          fontSize: 16),
                    ),
                    Row(
                      children: [
                        RoundEdgedButton(
                          text: 'Male',
                          color: gender=='male'
                              ? MyColors.active
                              : Color(0xFFFFFFFF).withOpacity(0.70),
                          width: 100,
                          fontfamily: 'regular',
                          fontSize: 16,
                          shadow: 0,
                          textColor:
                          gender=='male' ? MyColors.whiteColor : Colors.black,
                          onTap: () {
                            setState(() {
                              gender = 'male';
                            });
                          },
                        ),
                        hSizedBox2,
                        RoundEdgedButton(
                          text: 'Female',
                          color: gender=='male'
                              ? Color(0xFFFFFFFF).withOpacity(0.70)
                              : MyColors.active,
                          width: 150,
                          textColor:
                          gender=='male' ? MyColors.blackColor : Colors.white,
                          fontSize: 16,
                          fontfamily: 'regular',
                          shadow: 0,
                          onTap: () {
                            setState(() {
                              gender = 'female';
                            });
                          },
                        ),
                      ],
                    ),

                    if(gender=='female')
                      Container(
                        child: DropdownButtonHideUnderline(
                          child: DropdownButton(
                            hint: Text('Select Agent (Optional)', style: TextStyle(color: Colors.white70),),
                            value: selectedAgent,
                            dropdownColor: MyColors.primaryColor,
                            icon: const Icon(Icons.keyboard_arrow_down_rounded),
                            elevation: 16,
                            style: const TextStyle(color: Colors.white),
                            onChanged: (Map? newValue) {
                              setState(() {
                                selectedAgent = newValue!;
                              });
                            },
                            items: List.generate(agentList.length, (index) => DropdownMenuItem<Map>(
                              value: agentList[index],
                              child: Text(agentList[index]['name'], style: TextStyle(color: Colors.white),),
                            ),),
                            isExpanded: true,
                          ),
                        ),
                        padding: EdgeInsets.symmetric(vertical: 5, horizontal: 10),
                        decoration: ShapeDecoration(
                          color:Color(0xFE4AB5E1),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.all(Radius.circular(100)),
                          ),
                        ),
                      ),
                    // Text(
                    //   'Looking For...',
                    //   style: TextStyle(
                    //       color: Colors.white,
                    //       fontWeight: FontWeight.bold,
                    //       fontSize: 16),
                    // ),
                    // Row(
                    //   children: [
                    //     RoundEdgedButton(
                    //       text: 'Male',
                    //       color: gender_interest=='male'
                    //           ? MyColors.active
                    //           : Color(0xFFFFFFFF).withOpacity(0.70),
                    //       width: 100,
                    //       fontfamily: 'regular',
                    //       fontSize: 16,
                    //       shadow: 0,
                    //       textColor:
                    //       gender_interest=='male' ? MyColors.whiteColor : Colors.black,
                    //       onTap: () {
                    //         setState(() {
                    //           gender_interest = 'male';
                    //         });
                    //       },
                    //     ),
                    //     hSizedBox2,
                    //     RoundEdgedButton(
                    //       text: 'Female',
                    //       color: gender_interest=='male'
                    //           ? Color(0xFFFFFFFF).withOpacity(0.70)
                    //           : MyColors.active,
                    //       width: 150,
                    //       textColor:
                    //       gender_interest=='male' ? MyColors.blackColor : Colors.white,
                    //       fontSize: 16,
                    //       fontfamily: 'regular',
                    //       shadow: 0,
                    //       onTap: () {
                    //         setState(() {
                    //           gender_interest = 'female';
                    //         });
                    //       },
                    //     ),
                    //   ],
                    // ),



                    SizedBox(
                      height: 20,
                    ),
                    SolidBtn(
                      BtnText: 'Next',
                      funcTap: () async {
                        if (validateName(name.text) == null &&
                            validateEmail(email.text) == null &&
                            // validateCountry(address.text) == null &&
                            ValidatepasswordMetch(pass.text, c_pass.text) ==
                                null && validateGender(gender)==null&&
                            validateBirthDate(dob.text) == null) {
                          Map data = {
                            'name': name.text,
                            'email': email.text,
                            // 'country': address.text,
                            'password': pass.text,
                            'date_of_birth': dob.text,
                            'gender_interest': gender=='male'?'female':'male',

                            // 'gender_interest': gender_interest,
                            'gender':gender,
                          };

                          loadingShow(context);
                          var position = await determinePosition();
                          if(position!=null){
                            data['lat'] = position.latitude.toString();
                            data['lng'] = position.longitude.toString();
                          }
                          if(selectedAgent!=null){
                            data['agent_id']= selectedAgent!['id'];
                          }

                          Map res = await postData(data, 'signup', 0, 0);
                          loadingHide(context);
                          print('signup-----$res');
                          if (res['status'].toString() == '1') {
                            updateUserDetails(res['data']);
                            userData=UserModal.fromJson(res['data']);
                            String? token = await FirebasePushNotifications.getToken();
                            if(token!=null){
                              await Webservices.updateDeviceToken(userId: userData!.id, token: token);
                            }else{
                              print('device token is null');
                            }
                            Navigator.popUntil(context, (route) => route.isFirst);

                            pushReplacement(context: context, screen: UploadPicPage());

                            // Navigator.pushAndRemoveUntil(, newRoute, (route) => false)



                          } else {
                            presentToast(res['message']);
                          }
                        }
                        // push(context: context, screen: UploadPicPage());
                      },
                    ),
                  ],
                ),
              ),
              Padding(
                padding: const EdgeInsets.only(top: 20.0),
                child: GestureDetector(
                  onTap: () => {
                    push(context: context, screen: TermsAndConditions()),
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        'Terms and Conditions',
                        style: TextStyle(fontSize: 16, color: Colors.white),
                      )
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
