import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/constants.dart';

import 'package:flutter/material.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';

class PoppinsButton extends StatelessWidget {
  final String? content;
  final Widget? imageView;
  final Function onTap;
  final Color color;
  final Color textColor;
  final Color borderColor;
  final double fontSize;
  final String fontFamily;
  final FontWeight fontWeight;
  final TextAlign align;
  final Color iconColor;
  final Color shadowColor;
  final String? image;
  final double height;
  final double width;
  final double cornerRadius;
  final double margin;

  PoppinsButton(
      {this.content,
      required this.onTap,
      this.image,
      this.imageView,
      this.textColor = PayPOutColors.PrimaryColor,
      this.fontSize = 14,
      this.fontFamily = GeneralConstants.poppinsFont,
      this.fontWeight = FontWeight.normal,
      this.align = TextAlign.center,
      this.color = Colors.white,
      this.borderColor = PayPOutColors.lightPurple,
      this.iconColor = PayPOutColors.PrimaryColor,
      this.margin = 8,
      this.height = 45,
      this.width = 45,
      this.cornerRadius = 25.0,
      this.shadowColor = Colors.black});

  PoppinsButton.icon(
      {this.content,
      required this.onTap,
      this.image,
      this.imageView,
      this.textColor = Colors.transparent,
      this.fontSize = 14,
      this.fontFamily = GeneralConstants.poppinsFont,
      this.fontWeight = FontWeight.normal,
      this.align = TextAlign.center,
      this.color = Colors.white,
      this.borderColor = Colors.transparent,
      this.iconColor = PayPOutColors.PrimaryColor,
      this.height = 45,
      this.width = 45,
      this.margin = 8,
      this.cornerRadius = 25.0,
      this.shadowColor = Colors.white});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        onTap.call();
      },
      child: Container(
        height: height,
        margin: EdgeInsets.all(margin),
        alignment: Alignment.center,
        decoration: BoxDecoration(
            color: color,
            borderRadius: BorderRadius.all(
              Radius.circular(cornerRadius),
            ),
            border: Border.all(color: borderColor),
            boxShadow: [
              BoxShadow(
                color: shadowColor.withOpacity(0.2),
                spreadRadius: 1,
                blurRadius: 20,
                offset: Offset(0, 8),
              )
            ]),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: <Widget>[
            if (imageView != null) onImageView(),
            if (image != null) SvgPicture.asset(image!, color: iconColor),
            if (content != null)
              PoppinsText(
                content: content,
                align: align,
                fontFamily: fontFamily,
                fontWeight: fontWeight,
                fontSize: fontSize,
                textColor: textColor,
              ),
          ],
        ),
      ),
    );
  }

  Widget onImageView() {
    return Container(
      width: width,
      padding: EdgeInsets.all(4),
      child: imageView,
    );
  }
}
