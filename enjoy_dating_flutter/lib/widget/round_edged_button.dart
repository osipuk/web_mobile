import 'package:flutter/material.dart';

import '../constants/colors.dart';
class RoundEdgedButton extends StatelessWidget {
  final Color color;
  final String text;
  final String fontfamily;
  final Function()? onTap;
  final double horizontalMargin;
  final double verticalPadding;
  final double verticalMargin;
  // final Gradient? gradient;
  final bool isSolid;
  final bool isWhite;
  final Color? textColor;
  final double? borderRadius;
  final bool isBold;
  final double shadow;
  final double? fontSize;
  final Color ShadowColor;
  final double? width;

  const RoundEdgedButton(
      {Key? key,
        this.color = MyColors.primaryColor,
      required this.text,
        this.isWhite = false,
        this.fontfamily = 'medium',
      this.onTap,
        this.horizontalMargin=0,
        this.textColor,
        this.borderRadius,
        this.isBold = false,
        this.verticalMargin = 12,
        this.verticalPadding = 5,
        this.width,
        this.fontSize,
        this.shadow = 8,
        this.ShadowColor = const Color(0xFE1CDBC1),
        // required this.hasGradient,
      this.isSolid=true})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        height: 43,
        margin: EdgeInsets.symmetric(horizontal: horizontalMargin,vertical: verticalMargin),
        width: width??(MediaQuery.of(context).size.width),
        padding: EdgeInsets.symmetric(horizontal: 8, vertical: verticalPadding),
        decoration: BoxDecoration(
          color:isWhite?Colors.white:isSolid? color:Colors.transparent,
          // gradient: hasGradient?gradient ??
          //     LinearGradient(
          //       colors: <Color>[
          //         Color(0xFF064964),
          //         Color(0xFF73E4D9),
          //       ],
          //     ):null,
          boxShadow:[BoxShadow(
              color: ShadowColor.withOpacity(0.5),
              offset: Offset(0, 0),
              spreadRadius: shadow
          )],
          borderRadius: BorderRadius.circular(borderRadius??30),
          border:isSolid?null: Border.all(color: color),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              text,
              textAlign: TextAlign.center,
              style: TextStyle(
                color:textColor??(isWhite?MyColors.primaryColor:isSolid? Colors.white:color),
                fontSize: fontSize??17,
                fontWeight:isBold?FontWeight.w700: FontWeight.w500,

                // letterSpacing: 2,
                fontFamily: fontfamily,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
