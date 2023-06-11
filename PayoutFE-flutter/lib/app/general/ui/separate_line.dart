import 'package:flutter/cupertino.dart';
import 'package:pay_out/app/general/constants/constants.dart';

class SeparateLine extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 8),
      color: PayPOutColors.lightGrey.withOpacity(0.5),
      height: 0.5,
    );
  }
}
