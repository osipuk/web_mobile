import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/sized_box.dart';
// import 'CustomTexts.dart';


AppBar appBar(
    {String? title,
    bool showLogoutButton = false,
    bool implyLeading = true,
    Function()? onBackButtonTap,
      PreferredSizeWidget? bottom,
    required BuildContext context,
    List<Widget>? actions}) {
  return AppBar(
    // toolbarHeight: 70,
    automaticallyImplyLeading: false,
    titleSpacing: implyLeading ? 0 : 16,
    backgroundColor: Colors.transparent,
    centerTitle: true,
    elevation: 0,
    bottom: bottom,
    title: title == null
        ? null
        : AppBarHeadingText(
            text: title,
            fontSize: 14,
            fontFamily: 'medium',
            color: MyColors.whiteColor,
          ),
    leading: implyLeading
        ? IconButton(
            icon: const Icon(
              Icons.chevron_left_outlined,
              color: Colors.white,
              size: 30,
            ),
            onPressed: onBackButtonTap != null
                ? onBackButtonTap
                : () {
                    Navigator.pop(context);
                  },
          )
        : null,
    actions: showLogoutButton
        ? [
            hSizedBox,
            Center(
              child: GestureDetector(
                onTap: ()async{
                  // await logout();
                  //
                  // Navigator.popUntil(context, (route) => route.isFirst);
                  // Navigator.pushReplacementNamed(context, ChooseCustomerOrMinistryPage.id);

                },
                child: Text(
                  'logout',
                  style: TextStyle(color: Colors.black),
                ),
              ),
            ),
            hSizedBox,
          ]
        : actions,
  );
}

