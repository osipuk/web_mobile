import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/password/password_login_screen_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class RegisterPasswordWidget extends GeneralStatelessWidget {
  final Function(String) onPasswordChangeValue;

  PasswordLoginScreenViewModel? model;

  PayOutTextFieldEditingController passwordController =
      PayOutTextFieldEditingController();

  String? savePassword;
  String? firstName;
  String? lastName;

  RegisterPasswordWidget(this.savePassword, this.firstName, this.lastName,
      {required this.onPasswordChangeValue});

  Widget builderView(BuildContext context, PasswordLoginScreenViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PasswordLoginScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => PasswordLoginScreenViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        entryTextFieldPassword(),
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
          child: SvgPicture.asset(SVGImage.phoneIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Password',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            content:
                'Hi $firstName $lastName. Please, set your password with at least eight characters, a capital letter, a number, and a special character to protect your data.',
            textColor: PayPOutColors.PrimaryAssentColor,
            align: TextAlign.left,
            maxLines: 10,
            fontSize: 12,
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword() {
    passwordController.text = savePassword ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Password',
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: TextField(
                  controller: passwordController,
                  onChanged: onPasswordChangeValue,
                  textAlignVertical: TextAlignVertical.center,
                  obscureText: model?.hidePassword ?? false,
                  decoration: InputDecoration(
                    hintText: "Password",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont),
                  ),
                ),
              ),
              PoppinsButton(
                image: SVGImage.viewPasswordIcon,
                iconColor: PayPOutColors.lightGrey,
                borderColor: Colors.white,
                shadowColor: Colors.white,
                onTap: changePasswordViewed,
              )
            ],
          ),
        )
      ],
    );
  }

  void changePasswordViewed() {
    savePassword = passwordController.text;
    model?.hidePassword = !(model?.hidePassword ?? false);
    model?.notifyListeners();
  }
}
