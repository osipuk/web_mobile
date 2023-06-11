import 'dart:math';
import 'package:flutter/material.dart';

// ignore: must_be_immutable
class BlurWidget extends StatelessWidget {
  double circleWidth;
  double blurSigma;
  Color color;

  BlurWidget(
      {required this.circleWidth,
      required this.blurSigma,
      required this.color});

  @override
  Widget build(BuildContext context) {
    return CustomPaint(
        foregroundPainter: CircleBlurPainter(
            circleWidth: circleWidth, blurSigma: blurSigma, color: color));
  }
}

class CircleBlurPainter extends CustomPainter {
  CircleBlurPainter(
      {required this.circleWidth,
      required this.blurSigma,
      required this.color});

  double circleWidth;
  double blurSigma;
  Color color;

  @override
  void paint(Canvas canvas, Size size) {
    Paint line = new Paint()
      ..color = color
      ..strokeCap = StrokeCap.round
      ..style = PaintingStyle.stroke
      ..strokeWidth = circleWidth
      ..maskFilter = MaskFilter.blur(BlurStyle.normal, blurSigma);
    Offset center = new Offset(size.width / 2, size.height / 2);
    double radius = min(size.width / 2, size.height / 2);
    canvas.drawCircle(center, radius, line);
  }

  @override
  bool shouldRepaint(CustomPainter oldDelegate) {
    return true;
  }
}
