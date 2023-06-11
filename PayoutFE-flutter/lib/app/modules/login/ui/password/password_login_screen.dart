import 'package:auto_route/annotations.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/password/password_login_screen_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class PasswordLoginScreen extends GeneralScreen {
  PasswordLoginScreenViewModel? model;
  PayOutTextFieldEditingController passwordController =
      new PayOutTextFieldEditingController();

  final email;

  PasswordLoginScreen({
    @queryParam VoidCallback? onBackCallback,
    @QueryParam('email') this.email = "",
  }) : super(onBackCallback);

  Widget builderView(BuildContext context, PasswordLoginScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PasswordLoginScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => PasswordLoginScreenViewModel(context),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        entryTextFieldPassword(context),
        nextButtonView(context)
      ],
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 95,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.passwordImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Password',
            fontWeight: FontWeight.bold,
            fontSize: 30,
            maxLines: 10,
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword(BuildContext context) {
    passwordController.text = model?.passwordCurrent ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 10,
            content: model?.getTitleMessage(),
            textColor: model?.isLoginError ?? false
                ? PayPOutColors.ErrorColor
                : PayPOutColors.PrimaryColor,
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(
                color: model?.isLoginError ?? false
                    ? PayPOutColors.ErrorColor
                    : PayPOutColors.PrimaryColor,
                width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: TextField(
                  autofocus: true,
                  controller: passwordController,
                  onChanged: (value) {
                    model?.passwordCurrent = value;
                    model?.disableLoginIntent();
                  },
                  textAlignVertical: TextAlignVertical.center,
                  obscureText: model?.hidePassword ?? false,
                  decoration: InputDecoration(
                    hintText: "Entry password",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont,
                      fontSize: 15,
                    ),
                  ),
                ),
              ),
              PoppinsButton(
                image: SVGImage.viewPasswordIcon,
                iconColor: PayPOutColors.lightGrey,
                borderColor: Colors.white,
                shadowColor: Colors.white,
                onTap: () => model?.changePasswordViewed(),
              )
            ],
          ),
        ),
        Container(
          alignment: Alignment.centerRight,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: GestureDetector(
            onTap: () {
              model?.navToForgotPassword(context, email);
            },
            child: PoppinsText(
              align: TextAlign.left,
              content: 'Forgot password?',
              textColor: PayPOutColors.PrimaryAssentColor,
            ),
          ),
        )
      ],
    );
  }

  Widget nextButtonView(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(left: 32, right: 32, top: 75, bottom: 32),
      child: PoppinsButton(
        content: "Next",
        fontWeight: FontWeight.bold,
        fontSize: 16,
        color: PayPOutColors.pink,
        borderColor: PayPOutColors.pink,
        onTap: intentLogin,
      ),
    );
  }

  void intentLogin() {
    showLoader();
    model?.postLogin(email, passwordController.text, (response) {
      // Login completado
      model?.onSaveUserLogged(response.data);
    }, (error) {
      model?.enableLoginIntent(error);
    });
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
