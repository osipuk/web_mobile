import 'package:flutter/material.dart';

class SolidBtn extends StatelessWidget {
  final String BtnText;
  final Color BgColorTop;
  final Color BgColorBottom;
  final Color ShadowColor;
  final Color TextColor;
  final Function() funcTap;

  const SolidBtn({Key? key,
    required this.BtnText,
    this.BgColorTop = const Color(0xFE1CDBC1),
    this.BgColorBottom = const Color(0xFE12C7AE),
    this.ShadowColor = const Color(0xFE1CDBC1),
    this.TextColor = Colors.white,
    required this.funcTap,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 42,
      padding: EdgeInsets.all(0),
      decoration: BoxDecoration(
        boxShadow: [BoxShadow(
            color: ShadowColor.withOpacity(0.5),
            offset: Offset(0, 0),
            spreadRadius: 8
        )],
        borderRadius: BorderRadius.circular(100),
        gradient: LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          stops: [0.0, 1.0],
          colors: [
            BgColorTop,
            BgColorBottom,
          ],
        ),
      ),
      child: ElevatedButton(
        onPressed:funcTap,
        style: ElevatedButton.styleFrom(
            primary: Colors.transparent,
            onSurface: Colors.transparent,
            shadowColor: Colors.transparent,
            shape: StadiumBorder()
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(BtnText, style: TextStyle(fontSize: 17, fontWeight: FontWeight.w700, color: TextColor),)
          ],
        ),
      ),
    );
  }
}
