import 'package:flutter/material.dart';
import '../constants/colors.dart';
class MainHeadingText extends StatelessWidget {
  final String text;
  final Color? color;
  final double? fontSize;
  final FontWeight? fontWeight;
  final String? fontFamily;
  final TextAlign? textAlign;
  final double? height;
  const MainHeadingText(this.text,{
    Key? key,
    this.color,
    this.fontSize,
    this.fontWeight,
    this.fontFamily,
    this.textAlign,
    this.height
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Text(
      text,
      textAlign: textAlign,
      style: TextStyle(
        color: color,
        fontWeight:fontWeight??FontWeight.w600,
        fontSize: fontSize??28,
        // letterSpacing: 1,
        // wordSpacing: 1,
        // fontFamily:
        fontFamily: fontFamily,
        height: height
      ),
    );
  }
}



class AppBarHeadingText extends StatelessWidget {
  final String text;
  final Color? color;
  final double? fontSize;
  final FontWeight? fontWeight;
  final String? fontFamily;
  final TextAlign? textAlign;
  const AppBarHeadingText({
    Key? key,
    required this.text,
    this.color,
    this.fontSize,
    this.fontWeight,
    this.fontFamily,
    this.textAlign,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Text(
      text,
      style: TextStyle(
        overflow: TextOverflow.ellipsis,
          color: color??MyColors.whiteColor,
          fontWeight:fontWeight??FontWeight.w400,
          fontSize: fontSize??22,
          // fontFamily:
          fontFamily: fontFamily
      ),
    );
  }
}

class SubHeadingText extends StatelessWidget {
  final String text;
  final Color? color;
  final double? fontSize;
  final FontWeight? fontWeight;
  final String fontFamily;
  final TextAlign textAlign;
  final bool underlined;
  const SubHeadingText(this.text,{
    Key? key,
    this.color,
    this.fontSize,
    this.fontWeight,
    this.fontFamily ='Poppins-Medium',
    this.textAlign=TextAlign.start,
    this.underlined = false,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Text(
      text,
      style: TextStyle(
          color: color,
          fontWeight:fontWeight??FontWeight.w500,
          fontSize: fontSize??18,
          // fontFamily:
          fontFamily: fontFamily,
        decoration:underlined? TextDecoration.underline:null,
      ),
    );
  }
}


class ParagraphText extends StatelessWidget {
  final String text;
  final Color? color;
  final double? fontSize;
  final FontWeight? fontWeight;
  final String? fontFamily;
  final TextAlign? textAlign;
  final bool underlined;
  final double? lineHeight;
  const ParagraphText(this.text,{
    Key? key,

    this.color,
    this.fontSize,
    this.fontWeight,
    this.fontFamily,
    this.textAlign,
    this.underlined = false,
    this.lineHeight,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Text(
      text,
      textAlign: textAlign??TextAlign.start,
      style: TextStyle(
          color: color,
          fontWeight:fontWeight??FontWeight.w400,
          fontSize: fontSize??14,
          height: lineHeight,
          // fontFamily:
          fontFamily: fontFamily,
        // letterSpacing: 1,
        // wordSpacing: 1,
        decoration:underlined? TextDecoration.underline:null,
      ),
    );
  }
}




// class TextFieldTextStyle extends StatelessWidget {
//   const TextFieldTextStyle({Key? key}) : super(key: key);
//
//   @override
//   Widget build(BuildContext context) {
//     return TextStyle();
//   }
// }
