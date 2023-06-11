import 'package:Enjoy/constants/colors.dart';
import 'package:flutter/material.dart';

// import '../constants/colors.dart';
import 'CustomTexts.dart';

class CustomTextField extends StatelessWidget {
  final TextEditingController controller;
  final String hintText;
  final Color? textColor;
  final BoxBorder? border;
  final bool horizontalPadding;
  final bool obscureText;
  final int? maxLines;
  final Color? bgColor;
  final Color? hintcolor;
  final double verticalPadding;
  final double fontsize;
  final double borderRadius;
  final String? errorText;
  final Function(String)? onChanged;
  final String? headingText;
  final Function()? onTap;
  final Widget? suffix;
  final Widget? preffix;
  final String? prefixText;
  TextInputType? keyboardType;
  final bool enabled;
  final String? suffixText;
  final bool enableInteractiveSelection;
  final bool textalign;
  CustomTextField({
    Key? key,
    required this.controller,
    required this.hintText,
    this.border,
    this.maxLines,
    this.preffix,
    this.horizontalPadding = false,
    this.obscureText = false,
    this.hintcolor = Colors.white,
    this.bgColor = Colors.white,
    this.verticalPadding = 8,
    this.fontsize = 15,
    this.borderRadius = 18,
    this.keyboardType,
    this.onChanged,
    this.errorText,
    this.headingText,
    this.enabled = true,
    this.suffix,
    this.suffixText,
    this.textColor,
    this.prefixText,
  this.enableInteractiveSelection = true,
    this.onTap,
    this.textalign = false
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.symmetric(
          horizontal: horizontalPadding ? 16 : 0, vertical: 0),
      decoration: BoxDecoration(
          color:headingText!=null?Colors.transparent: bgColor,
          border:headingText!=null?null:border,
          // border: border,
          borderRadius: BorderRadius.circular(borderRadius)),
      padding:headingText!=null?null: EdgeInsets.symmetric(horizontal: 16, vertical: verticalPadding),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          if(headingText!=null)
          SubHeadingText( headingText!),
          TextField(
            maxLines: maxLines ?? 1,

            textAlign: textalign? TextAlign.center: TextAlign.left,
            controller: controller,
            obscureText: obscureText,
            keyboardType: keyboardType,
            style: TextStyle(color: textColor, fontSize: fontsize),
            autofocus: false,
            enableInteractiveSelection: false,
            enabled: enabled,
            decoration: InputDecoration(
              suffixIcon: suffix,
              prefixIcon: preffix,
              hintText: hintText,
              suffixText: suffixText,
              prefixText: prefixText,
              prefixStyle: TextStyle(
                fontSize: 16
              ),
              hintStyle: TextStyle(
                color: hintcolor,
                fontSize: fontsize,
              ),
              // MyGlobalConstants.textFieldHintTextStyle,
              // labelStyle: MyGlobalConstants.textFieldTextStyle,
              border:headingText!=null?null: InputBorder.none,
              errorText: errorText,
            ),
            onChanged: onChanged,
            onTap: onTap,
          ),
        ],
      ),
    );
  }
}

