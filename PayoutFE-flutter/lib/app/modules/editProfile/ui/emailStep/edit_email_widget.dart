// ignore_for_file: must_be_immutable

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';

class EditEmailWidget extends GeneralStatelessWidget {
  final Function(String) onChangeEmail;
  final String email;

  EditEmailWidget(this.email, {required this.onChangeEmail});

  PayOutTextFieldEditingController emailController =
      new PayOutTextFieldEditingController();

  @override
  Widget build(BuildContext context) {
    return onBodyInitView(context);
  }

  Widget onBodyInitView(BuildContext context) {
    return GestureDetector(
      behavior: HitTestBehavior.opaque,
      onPanStart: (_) {
        unFocus();
      },
      onTap: () {
        unFocus();
      },
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          headerView(),
          entryTextFieldPassword(),
        ],
      ),
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.emailImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Email',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword() {
    emailController.text = email;
    print(emailController.text);
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 8),
          child: PoppinsText(
            align: TextAlign.left,
            content:
                emailController.text.isValidEmail() ? 'Email' : 'Invalid email',
            textColor: getStatusColor(),
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 12, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: getStatusColor(), width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            children: <Widget>[
              Expanded(
                child: Container(
                  margin: EdgeInsets.only(top: 22),
                  child: TextField(
                    controller: emailController,
                    onChanged: (email) {
                      onChangeEmail(email);
                    },
                    textAlignVertical: TextAlignVertical.center,
                    decoration: InputDecoration(
                      hintText: "Email",
                      border: InputBorder.none,
                      hintStyle: TextStyle(
                        fontFamily: GeneralConstants.poppinsFont,
                        color: Colors.black54,
                        fontSize: 15,
                      ),
                    ),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Color getStatusColor() {
    final email = emailController.text;
    return email.isValidEmail()
        ? PayPOutColors.PrimaryColor
        : PayPOutColors.ErrorColor;
  }
}
