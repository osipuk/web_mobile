import 'package:flutter/material.dart';

import 'colors.dart';

class MyGlobalConstants{
  static const String kGoogleApiKey = 'AIzaSyABk-0Al27H9Ap_Rtti2t0ePxOLvl5QFzk';
  static const double appHorizontalPadding = 16.0;
  static const double cardElevation = 3.0;
  static const double appHorizontalPaddingBig = 32.0;
  static const double kborderRadius = 18.0;

  static ShapeBorder cardShape = RoundedRectangleBorder(borderRadius: BorderRadius.circular(14));


  static  TextStyle textFieldHintTextStyle = TextStyle(
    // color: MyColors.blackColor,
    color: MyColors.hintcolor,
    fontSize: 15,
  );

  static const TextStyle textFieldTextStyle = TextStyle(
    // color: MyColors.blackColor,
    color: Colors.black,
    fontSize: 13,
  );
}