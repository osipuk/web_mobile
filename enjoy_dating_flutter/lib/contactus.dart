import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

class ContactUs extends StatefulWidget {
  const ContactUs({Key? key}) : super(key: key);

  @override
  ContactUsState createState() => ContactUsState();
}

class ContactUsState extends State<ContactUs> {

  TextEditingController nameController = TextEditingController();
  TextEditingController phoneNumberController = TextEditingController();
  TextEditingController messageController = TextEditingController();
  initializeData()async{
    phoneNumberController.text = userData!.mobileNumber;
    nameController.text = userData!.name;
    setState(() {

    });
  }
  @override
  void initState() {
    // TODO: implement initState

    initializeData();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
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
                    title: Text('Contact us', style: TextStyle(color: Colors.white, fontSize: 16),),
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
                        roundedInput(placeholder: 'Enter name', controler_: nameController,),
                        vSizedBox,
                        roundedInput(placeholder: 'Enter phone number', controler_: phoneNumberController,keyboardType: TextInputType.number,),
                        vSizedBox,
                        roundedInput(placeholder: 'Enter something here...', maxLength: 10, borderRadius: 20, controler_: messageController,),
                        SizedBox(height: 50,),
                        SolidBtn(BtnText: 'Send', funcTap: ()async{
                          FocusScope.of(context).requestFocus(new FocusNode());
                          var request = {
                            'name': nameController.text,
                            'phone': phoneNumberController.text,
                            'message': messageController.text,
                          };
                          loadingShow(context);
                          var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.contact_us, request: request, showSuccessMessage: true);
                          loadingHide(context);
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
