import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';


import '../constants/colors.dart';
import '../services/api_urls.dart';
import '../services/webservices.dart';


class TermsAndConditions extends StatefulWidget {
  const TermsAndConditions({Key? key}) : super(key: key);

  @override
  State<TermsAndConditions> createState() => _TermsAndConditionsState();
}

class _TermsAndConditionsState extends State<TermsAndConditions> {
  @override
  void initState() {
    // TODO: implement initState
    getData();
    super.initState();
  }
  bool load = false;
  String result = "";
  getData()async{
    setState(() {
      load = true;
    });
    result = (await Webservices.getMap(ApiUrls.termsAndConditions))['content']??'';
    setState(() {
      load = false;
    });
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        title: Text('Terms And Conditions', style: TextStyle(color: Colors.black),),
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.black,),
          onPressed: (){
            Navigator.pop(context);
          },
        ),
        automaticallyImplyLeading: false,
      ),
      body:
      load?
      Center(child: CircularProgressIndicator(color: MyColors.primaryColor,)):
      SingleChildScrollView(
        child: Container(
          padding: EdgeInsets.symmetric(horizontal: 20),
          child: Html(
            data: """$result""",
          ),
        ),
      ),
    );
  }
}
