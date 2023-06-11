import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:flutter/material.dart';

import '../constants/global_keys.dart';
import '../constants/sized_box.dart';
import 'CustomTexts.dart';

Future<bool?>  showCustomConfirmationDialog(
{
  String headingMessage = 'Are you sure?',
  String? description,

}
)async{
  return await showDialog(
      context: MyGlobalKeys.navigatorKey.currentContext!,
      builder: (context) {
        return Dialog(
          insetPadding: EdgeInsets.symmetric(horizontal: 24),
          child: Container(
            padding: EdgeInsets.symmetric(horizontal: 16, vertical: 24),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                vSizedBox,
                SubHeadingText(
                 headingMessage,
                  color: Colors.red,
                ),
                vSizedBox,
                if(description!=null)
                ParagraphText( description!),
                if(description!=null)
                vSizedBox2,
                Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    RoundEdgedButton(
                      text: 'No',
                      verticalPadding: 0,
                      // height: 36,
                      width: 100,
                      onTap: () {
                        Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!);
                      },
                    ),
                    hSizedBox2,
                    RoundEdgedButton(
                      text: 'Yes',
                      verticalPadding: 0,
                      // height: 36,
                      width: 80,
                      // color: Colors.red,
                      onTap: () {
                        Navigator.pop(MyGlobalKeys.navigatorKey.currentContext!, true);
                      },
                    ),
                  ],
                )
              ],
            ),
          ),
        );
      });
}