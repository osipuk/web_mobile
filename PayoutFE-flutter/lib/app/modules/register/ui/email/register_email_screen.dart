import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/register/viewModel/userData/register_email_screen_view_model.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class RegisterEmailScreen extends GeneralScreen {
  RegisterUserDataScreenViewModel? model;
  PayOutTextFieldEditingController emailController =
      PayOutTextFieldEditingController();
  FocusNode emailFocus = FocusNode();

  RegisterEmailScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  Widget builderView(
      BuildContext context, RegisterUserDataScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<RegisterUserDataScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterUserDataScreenViewModel(context),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        emailTextFieldView(context),
        providersLoginButtons(context),
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
          child: SvgPicture.asset(SVGImage.emailImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Create account',
            fontWeight: FontWeight.bold,
            fontSize: 30,
          ),
        )
      ],
    );
  }

  Widget emailTextFieldView(BuildContext context) {
    emailController.text = model?.registerUser.email ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: model?.getTitleMessage() ?? "",
            textColor: model?.getStatusColor() ?? PayPOutColors.PrimaryColor,
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(
                  color: model?.getStatusColor() ?? PayPOutColors.PrimaryColor,
                  width: 1),
              borderRadius: BorderRadius.all(
                Radius.circular(15.0),
              ),
            ),
            child: TextField(
              autocorrect: false,
              enableSuggestions: false,
              controller: emailController,
              focusNode: emailFocus,
              textAlignVertical: TextAlignVertical.center,
              keyboardType: TextInputType.emailAddress,
              onChanged: (value) {
                model?.registerUser.email = value;
                if (!(model?.isValidEmail ?? false)) {
                  model?.setValidEmail(true);
                }
              },
              onSubmitted: (_) =>
                  sendEmailRegister(emailController.text, context),
              decoration: InputDecoration(
                  hintText: "Create with email",
                  border: InputBorder.none,
                  hintStyle: TextStyle(
                      fontSize: 15,
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont)),
            ))
      ],
    );
  }

  Widget nextButtonView(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(left: 32, right: 32, top: 40, bottom: 32),
      child: PoppinsButton(
          content: "Next",
          fontWeight: FontWeight.bold,
          fontSize: 16,
          color: PayPOutColors.pink,
          borderColor: PayPOutColors.pink,
          onTap: () => sendEmailRegister(emailController.text, context)),
    );
  }

  void sendEmailRegister(String email, BuildContext context) {
    bool validEmail = email.isValidEmail();
    model?.setValidEmail(validEmail);
    if (validEmail) {
      unFocus();
      showLoader();
      delay(Duration(seconds: 1), () {
        hideLoader();
        emailFocus.unfocus();
        model?.navToRegisterEmailData(context, emailController.text);
      });
    }
  }

  void sendUserRegister(String email, BuildContext context) {
    bool validEmail = email.isValidEmail();
    model?.setValidEmail(validEmail);
    if (validEmail) {
      emailFocus.unfocus();
      showLoader();
      delay(Duration(seconds: 1), () {
        hideLoader();
        emailFocus.unfocus();
        model?.navToRegisterUserData(context);
      });
    }
  }

  Widget providersLoginButtons(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          padding: EdgeInsets.only(top: 30),
          child: PoppinsText(
            content: "Or:",
            fontSize: 14,
            textColor: PayPOutColors.PrimaryAssentColor,
          ),
        ),
        Container(
          padding: EdgeInsets.only(top: 20),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              if (Platform.isIOS)
                Expanded(
                    child: PoppinsButton(
                  image: SVGImage.appleIcon,
                  onTap: () {
                    emailFocus.unfocus();
                    registerWithApple(context);
                  },
                )),
              Expanded(
                  child: PoppinsButton(
                      image: SVGImage.googleIcon,
                      onTap: () {
                        emailFocus.unfocus();
                        registerWithGoogle(context);
                      })),
              Expanded(
                  child: PoppinsButton(
                      image: SVGImage.facebookIcon,
                      onTap: () {
                        emailFocus.unfocus();
                        registerWithFacebook(context);
                      }))
            ],
          ),
        )
      ],
    );
  }

  void registerWithGoogle(BuildContext context) {
    showLoader();
    model?.getTokenGoogleCredential().then((socialID) {
      if (socialID != null) {
        model?.socialLogIn(socialID, () {
          hideLoader();
          model?.dialogScreen(
            context,
            "Registered user",
            "We have logged in with the previous account",
            SVGImage.checkSuccessIcon,
            onAceptClick: () => model?.navToPayOutHome(),
          );
        }, (error) {
          String email = model?.registerUser.email ?? "";
          sendUserRegister(email, context);
          hideLoader();
        });
      } else {
        hideLoader();
      }
    });
  }

  void registerWithFacebook(BuildContext context) {
    showLoader();
    model?.getTokenFacebookCredential().then((socialID) {
      if (socialID != null) {
        model?.socialLogIn(socialID, () {
          hideLoader();
          model?.dialogScreen(
            context,
            "Registered user",
            "We have logged in with the previous account",
            SVGImage.checkSuccessIcon,
            onAceptClick: () => model?.navToPayOutHome(),
          );
        }, (error) {
          String email = model?.registerUser.email ?? "";
          sendUserRegister(email, context);
          hideLoader();
        });
      } else {
        hideLoader();
      }
    });
  }

  void registerWithApple(BuildContext context) {
    showLoader();
    model?.getTokenAppleCredential().then((socialID) {
      if (socialID != null) {
        model?.socialLogIn(socialID, () {
          hideLoader();
          model?.dialogScreen(
            context,
            "Registered user",
            "We have logged in with the previous account",
            SVGImage.checkSuccessIcon,
            onAceptClick: () => model?.navToPayOutHome(),
          );
        }, (error) {
          String email = model?.registerUser.email ?? "";
          sendUserRegister(email, context);
          hideLoader();
        });
      } else {
        hideLoader();
      }
    });
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
