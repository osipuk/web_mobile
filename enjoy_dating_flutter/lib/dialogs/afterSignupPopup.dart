import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:flutter/material.dart';
import 'package:in_app_review/in_app_review.dart';

import '../constants/sized_box.dart';
import '../services/api_urls.dart';

class InitialSignupPopup extends StatelessWidget {
  const InitialSignupPopup({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      // height: 400,
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Padding(
            padding: EdgeInsets.symmetric(horizontal: 36, vertical: 16),
            child: Column(
              children: [
                Image.asset(MyImages.rewardIcon, height: 100,),
                vSizedBox2,
                MainHeadingText(
                  'Congratulations!!!',
                ),
                vSizedBox05,
                ParagraphText(
                  'You are rewarded with 60 coins as \nsignup bonus',
                  textAlign: TextAlign.center,
                ),
                vSizedBox4,
                RoundEdgedButton(text: 'Continue', onTap: (){
                  Navigator.pop(context);
                },
                  verticalMargin: 0,
                ),
              ],
            ),
          ),
          vSizedBox2,
        ],
      ),
    );
  }
}