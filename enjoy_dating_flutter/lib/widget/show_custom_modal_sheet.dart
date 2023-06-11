import 'package:flutter/material.dart';

Future<T?> showCustomBottomSheet<T>(
  BuildContext context, {
  double? height = 200,
      EdgeInsets? margin,
      EdgeInsets? padding,
      Color color = Colors.white,
      required Widget child,

}) {
  return showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) {
        return Container(
          clipBehavior: Clip.hardEdge,
          height: height,
          padding:padding?? EdgeInsets.symmetric(horizontal: 16,vertical: 16),
          margin: margin,
          decoration: BoxDecoration(
            color: color,
            borderRadius: BorderRadius.only(
              topLeft: Radius.circular(20),
              topRight: Radius.circular(20),
            ),
          ),
          child: child,
        );
      });
}
