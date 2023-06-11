import 'package:flutter/material.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
import 'package:pay_out/app/general/constants/constants.dart';

class PoppinsRichContent {
  final String? content;
  final FontWeight? fontWeight;
  final Color? textColor;
  final double? fontSize;

  PoppinsRichContent({
    this.content,
    this.fontWeight = FontWeight.normal,
    this.textColor = PayPOutColors.PrimaryColor,
    this.fontSize = 14,
  });
}

class PoppinsRichText extends StatelessWidget {
  final List<PoppinsRichContent>? contents;
  final String fontFamily;
  final TextAlign align;
  final int maxLines;
  final TextDecoration decoration;
  final TextOverflow overflow;
  final Function(LinkableElement)? linkOpen;
  final bool forceFontSize;

  PoppinsRichText(
      {required this.contents,
      this.fontFamily = GeneralConstants.poppinsFont,
      this.align = TextAlign.left,
      this.maxLines = 4,
      this.decoration = TextDecoration.none,
      this.overflow = TextOverflow.visible,
      this.forceFontSize = false,
      this.linkOpen});

  @override
  Widget build(BuildContext context) {
    return RichText(
      text: TextSpan(
        style: TextStyle(
          fontSize: 14.0,
          color: Colors.black,
        ),
        children: texts(context),
      ),
    );
  }

  List<InlineSpan> texts(BuildContext context) {
    List<InlineSpan> newTexts = [];
    contents?.forEach(
      (content) {
        final span = TextSpan(
          text: content.content,
          style: TextStyle(
            fontStyle: FontStyle.normal,
            color: content.textColor,
            fontSize: forceFontSize
                ? content.fontSize
                : (content.fontSize! / 100) *
                    (MediaQuery.of(context).size.height / 8),
            fontFamily: fontFamily,
            fontWeight: content.fontWeight,
            decoration: decoration,
          ),
        );
        newTexts.add(span);
      },
    );
    return newTexts;
  }
}
