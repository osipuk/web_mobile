import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/password/forgot_password_scree_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';

// ignore: must_be_immutable
class ForgotPasswordLoginScreen extends GeneralScreen {
  ForgotPasswordLoginScreenViewModel? model;

  ForgotPasswordLoginScreen({
    @queryParam VoidCallback? onBackCallback,
    @QueryParam('email') this.email = "",
  }) : super(onBackCallback);
  //
  String email;

  Widget builderView(
      BuildContext context, ForgotPasswordLoginScreenViewModel model) {
    this.model = model;
    this.model?.setRouteData(email);
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<ForgotPasswordLoginScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => ForgotPasswordLoginScreenViewModel(context),
      onModelReady: (model) {
        delay(Duration(seconds: 1), () => sendCodeForgotPassword(context));
      },
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        entryTextFieldPassword(),
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
          child: SvgPicture.asset(SVGImage.brokenPasswordIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Forgot password',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 3,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content: 'We have sent a code so that you can identify',
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 3,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content: 'yourself and reset your password,',
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 3,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content: 'Enter the code',
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword() {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Code',
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
                    textAlignVertical: TextAlignVertical.center,
                    obscureText: true,
                    decoration: InputDecoration(
                        hintText: "Entry code",
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                ),
                PoppinsButton(
                  image: SVGImage.viewPasswordIcon,
                  iconColor: PayPOutColors.lightGrey,
                  borderColor: Colors.white,
                  shadowColor: Colors.white,
                  onTap: () => model?.changePasswordViewed,
                )
              ],
            ))
      ],
    );
  }

  Widget nextButtonView(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 75, bottom: 32),
      child: Row(
        children: <Widget>[
          Expanded(
            child: PoppinsButton(
              content: "Send again",
              fontWeight: FontWeight.bold,
              fontSize: 16,
              onTap: () {
                sendCodeForgotPassword(context);
              },
            ),
          ),
          Expanded(
            child: PoppinsButton(
              content: "Confirm",
              fontWeight: FontWeight.bold,
              fontSize: 16,
              color: PayPOutColors.pink,
              borderColor: PayPOutColors.pink,
              onTap: () => model?.navToNewPassword,
            ),
          )
        ],
      ),
    );
  }

  void sendCodeForgotPassword(BuildContext context) {
    model?.forgotPassword(onSuccess: (response) {
      model?.dialogScreen(
        context,
        'Send code',
        response.message,
        SVGImage.checkSuccessIcon,
      );
    }, onError: (error) {
      model?.showErrorDialog(context, "Error", error);
    });
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
