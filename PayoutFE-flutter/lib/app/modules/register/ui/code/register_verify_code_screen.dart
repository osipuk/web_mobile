import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pin_code_fields/pin_code_fields.dart';

// ignore: must_be_immutable
class RegisterVerifyCodeWidget extends StatelessWidget {
  final Function(String) onCodeChangeValue;
  RegisterVerifyCodeWidget({required this.onCodeChangeValue});

  bool hasError = false;
  String code = "";

  @override
  Widget build(BuildContext context) {
    return onBodyInitView(context);
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        entryTextFieldPassword(context),
      ],
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.verifyIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Verify Code',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            content: 'We have sent a verification code to your cell',
            textColor: PayPOutColors.PrimaryAssentColor,
            align: TextAlign.left,
            maxLines: 3,
            fontSize: 12,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            content: 'phone number, please enter it to verify that it is you',
            textColor: PayPOutColors.PrimaryAssentColor,
            align: TextAlign.left,
            maxLines: 3,
            fontSize: 12,
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword(BuildContext context) {
    return Column(
      children: <Widget>[
        Visibility(
          visible: hasError,
          child: Container(
            margin: EdgeInsets.only(left: 16, right: 16, top: 12),
            width: double.infinity,
            child: PoppinsText(
              content: 'Incorrect code',
              align: TextAlign.start,
              textColor: Colors.red,
            ),
          ),
        ),
        Container(
          margin: EdgeInsets.only(left: 32, right: 32),
          child: PinCodeTextField(
            appContext: context,
            length: 4,
            animationType: AnimationType.fade,
            keyboardType: TextInputType.number,
            pinTheme: PinTheme(
                activeColor:
                    !hasError ? PayPOutColors.PrimaryColor : Colors.red,
                selectedColor:
                    !hasError ? PayPOutColors.PrimaryColor : Colors.red,
                inactiveColor: !hasError ? Colors.grey : Colors.red,
                fieldWidth: 45),
            textStyle: TextStyle(
              color: !hasError ? PayPOutColors.PrimaryColor : Colors.red,
              fontSize: 20,
              fontWeight: FontWeight.bold,
            ),
            onChanged: onCodeChangeValue,
          ),
        )
      ],
    );
  }
}
