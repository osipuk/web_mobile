import 'package:flutter/material.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
import 'package:pay_out/app/general/constants/constants.dart';

class PoppinsText extends StatelessWidget {
  final String? content;
  final Color? textColor;
  final Color linkTextColor;
  final double fontSize;
  final String fontFamily;
  final FontWeight fontWeight;
  final TextAlign align;
  final int maxLines;
  final TextDecoration decoration;
  final TextOverflow overflow;
  final Function(LinkableElement)? linkOpen;
  final bool forceFontSize;

  PoppinsText(
      {this.content,
      this.textColor = PayPOutColors.PrimaryColor,
      this.linkTextColor = PayPOutColors.PrimaryColor,
      this.fontSize = 14,
      this.fontFamily = GeneralConstants.poppinsFont,
      this.fontWeight = FontWeight.normal,
      this.align = TextAlign.left,
      this.maxLines = 2,
      this.decoration = TextDecoration.none,
      this.overflow = TextOverflow.visible,
      this.forceFontSize = false,
      this.linkOpen});

  @override
  Widget build(BuildContext context) {
    return Linkify(
      text: content ?? "",
      overflow: TextOverflow.ellipsis,
      textAlign: align,
      maxLines: maxLines,
      style: TextStyle(
        fontStyle: FontStyle.normal,
        color: textColor,
        fontSize: forceFontSize
            ? fontSize
            : (fontSize / 100) * (MediaQuery.of(context).size.height / 8),
        fontFamily: fontFamily,
        fontWeight: fontWeight,
        decoration: decoration,
      ),
      linkStyle: TextStyle(
        fontStyle: FontStyle.normal,
        color: linkTextColor,
        fontSize: fontSize,
        fontFamily: fontFamily,
        fontWeight: fontWeight,
        decoration: decoration,
      ),
      onOpen: linkOpen,
    );
  }
}
