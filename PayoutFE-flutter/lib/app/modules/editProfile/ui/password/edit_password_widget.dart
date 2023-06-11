// ignore_for_file: must_be_immutable

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';

class EditPasswordlWidget extends GeneralStatelessWidget {
  final Function(String) onNewChangePassworld;
  final Function(String) onOldChangePassworld;

  final Function(bool) onChangeNewShowedPass;
  final Function(bool) onChangeOldShowedPass;

  final String newPassword;
  final String oldPassword;

  final String userName;
  final bool newHidePassword;
  final bool oldHidePassword;

  EditPasswordlWidget(
    this.userName,
    this.newHidePassword,
    this.oldHidePassword,
    this.newPassword,
    this.oldPassword, {
    required this.onNewChangePassworld,
    required this.onOldChangePassworld,
    required this.onChangeNewShowedPass,
    required this.onChangeOldShowedPass,
  });

  String _newPassword = '';
  String _oldPassword = '';

  PayOutTextFieldEditingController oldPasswordController =
      new PayOutTextFieldEditingController();

  PayOutTextFieldEditingController newPasswordController =
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
          _infoTextView(),
          entryOldTextFieldPassword(),
          entryNewTextFieldPassword(),
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
          child: SvgPicture.asset(SVGImage.passwordImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Edit password',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        )
      ],
    );
  }

  Widget _infoTextView() {
    return Container(
      width: double.infinity,
      child: PoppinsText(
        content:
            'Hi $userName! Set a password with at least 8 characters, a number and a special character to protect your data.',
        textColor: PayPOutColors.PrimaryAssentColor,
        align: TextAlign.left,
        maxLines: 5,
        fontSize: 12,
      ),
    );
  }

  Widget entryOldTextFieldPassword() {
    oldPasswordController.text = oldPassword;
    print(oldPassword);
    return Padding(
      padding: const EdgeInsets.only(
        bottom: 32,
        top: 32,
      ),
      child: Column(
        children: <Widget>[
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 24, top: 8),
            child: PoppinsText(
              align: TextAlign.left,
              content: (oldPassword.isEmpty || oldPassword.isValidPassword())
                  ? 'Old Password'
                  : 'Invalid password',
              textColor: getOldStatusColor(),
            ),
          ),
          Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 12, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: getOldStatusColor(), width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: Row(
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: oldPasswordController,
                    textAlignVertical: TextAlignVertical.center,
                    obscureText: oldHidePassword,
                    onChanged: (pass) {
                      _oldPassword = pass;
                      onOldChangePassworld(_oldPassword);
                    },
                    decoration: InputDecoration(
                      hintText: "Old password",
                      border: InputBorder.none,
                      hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont,
                      ),
                    ),
                  ),
                ),
                PoppinsButton(
                  image: SVGImage.viewPasswordIcon,
                  iconColor: PayPOutColors.lightGrey,
                  borderColor: Colors.white,
                  shadowColor: Colors.white,
                  onTap: () => changeOldPasswordViewed(),
                ),
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget entryNewTextFieldPassword() {
    newPasswordController.text = newPassword;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 8),
          child: PoppinsText(
            align: TextAlign.left,
            content: (newPassword.isEmpty || newPassword.isValidPassword())
                ? 'New Password'
                : 'Invalid password',
            textColor: getNewStatusColor(),
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 12, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: getNewStatusColor(), width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            children: <Widget>[
              Expanded(
                child: TextField(
                  controller: newPasswordController,
                  textAlignVertical: TextAlignVertical.center,
                  obscureText: newHidePassword,
                  onChanged: (pass) {
                    _newPassword = pass;
                    onNewChangePassworld(_newPassword);
                  },
                  decoration: InputDecoration(
                    hintText: "New password",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      fontSize: 15,
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont,
                    ),
                  ),
                ),
              ),
              PoppinsButton(
                image: SVGImage.viewPasswordIcon,
                iconColor: PayPOutColors.lightGrey,
                borderColor: Colors.white,
                shadowColor: Colors.white,
                onTap: () => changeNewPasswordViewed(),
              ),
            ],
          ),
        )
      ],
    );
  }

  Color getNewStatusColor() {
    final pass = newPasswordController.text;
    return pass.isEmpty || pass.isValidPassword()
        ? PayPOutColors.PrimaryColor
        : PayPOutColors.ErrorColor;
  }

  Color getOldStatusColor() {
    final pass = oldPasswordController.text;
    return pass.isEmpty || pass.isValidPassword()
        ? PayPOutColors.PrimaryColor
        : PayPOutColors.ErrorColor;
  }

  void changeNewPasswordViewed() {
    onChangeNewShowedPass(!this.newHidePassword);
  }

  void changeOldPasswordViewed() {
    onChangeOldShowedPass(!this.oldHidePassword);
  }
}
