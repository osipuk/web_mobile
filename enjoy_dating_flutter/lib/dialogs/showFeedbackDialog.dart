import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:flutter/material.dart';
import 'package:in_app_review/in_app_review.dart';

import '../constants/sized_box.dart';
import '../services/api_urls.dart';

showCustomDialog(Widget child) async {
  return showDialog(
      context: MyGlobalKeys.navigatorKey.currentContext!,
      builder: (context) {
        return Dialog(
          insetPadding: EdgeInsets.symmetric(horizontal: 16, vertical: 48),
          backgroundColor: Colors.transparent,
          child: Container(
            decoration: BoxDecoration(
                color: Colors.white, borderRadius: BorderRadius.circular(20)),
            child: child,
          ),
        );
      });
}

class FeedBackDialog extends StatelessWidget {
  const FeedBackDialog({Key? key}) : super(key: key);

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
                SubHeadingText(
                  'Do You Like Our App?',
                ),
                vSizedBox05,
                ParagraphText(
                  'Please rate us five stars or give us a feedback.',
                  textAlign: TextAlign.center,
                ),
                vSizedBox,
              ],
            ),
          ),
          Divider(),
          GestureDetector(
            onTap: ()async{
              print('HEllo');
              final InAppReview inAppReview = InAppReview.instance;
              print('HEllo1');
              if (await inAppReview.isAvailable()) {
                var request = {
                  'user_id': userData!.id
                };

                print('HEllo2');
                inAppReview.requestReview();
                var jsonResponse = await Webservices.getMap(ApiUrls.changeReviewStatus + '?user_id=${userData?.id}');
              }
              print('HEllo3');
            },
            child: MainHeadingText(
              'Praise',
              color: Colors.red,
            ),
          ),
          // Divider(),
          // MainHeadingText(
          //   'Negative',
          //   color: Colors.grey,
          // ),
          Divider(),
          GestureDetector(
            onTap: (){
              Navigator.pop(context);

            },
            child: MainHeadingText(
              'Cancel',
              color: Colors.grey,
            ),
          ),
          vSizedBox2,
        ],
      ),
    );
  }
}
