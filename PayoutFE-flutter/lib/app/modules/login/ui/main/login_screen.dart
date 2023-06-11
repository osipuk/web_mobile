import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/main/login_screen_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class LoginScreen extends GeneralScreen {
  LoginScreenViewModel? model;

  LoginScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  ///MARK: Inicializador de vista - vista modelo
  void onModelReady(LoginScreenViewModel model) {
    model.setBiometricsAuth();
  }

  Widget builderView(BuildContext context, LoginScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<LoginScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => LoginScreenViewModel(context),
        onModelReady: (model) => this.onModelReady(model));
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      children: <Widget>[headerLogin(), bodyLogin(context)],
    );
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(left: 40, right: 20),
      alignment: Alignment.bottomCenter,
      height: 160,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.end,
        children: <Widget>[
          Expanded(
              child: Stack(
            alignment: Alignment.bottomCenter,
            children: <Widget>[
              Container(
                child: Image.asset(SVGImage.payOutIconShadow, fit: BoxFit.fill),
                padding: EdgeInsets.only(top: 90, left: 60),
                width: 160,
              ),
              Container(
                child: SvgPicture.asset(SVGImage.payOutIcon),
                padding: EdgeInsets.only(bottom: 40),
              )
            ],
          )),
          GestureDetector(
              onTap: () {
                _showPopupMenu(context);
              },
              child: Container(
                color: Colors.transparent,
                padding:
                    EdgeInsets.only(left: 30, right: 30, bottom: 50, top: 30),
                child: SvgPicture.asset(SVGImage.menu),
              ))
        ],
      ),
    );
  }

  /// Custom Views
  Widget headerLogin() {
    return Container(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Container(
            margin: EdgeInsets.only(top: 32, left: 16, bottom: 64),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                PoppinsText(
                  content: "Welcome, login",
                  fontSize: 28,
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsText(
                  content: "with:",
                  fontSize: 28,
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                )
              ],
            ),
          ),
          PoppinsButton(
              content: "Login With Email",
              color: Colors.white,
              borderColor: PayPOutColors.lightPurple,
              textColor: PayPOutColors.PrimaryColor,
              fontWeight: FontWeight.bold,
              onTap: () => model?.navToEmailLogin())
        ],
      ),
    );
  }

  Widget bodyLogin(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(top: 32),
      child: Column(
        children: <Widget>[
          biometricButtons(context),
          orTitleLabel(),
          providersLoginButtons(context),
          footer(context)
        ],
      ),
    );
  }

  Widget orTitleLabel() {
    return PoppinsText(
      content: "Or:",
      fontSize: 14,
      textColor: PayPOutColors.PrimaryAssentColor,
    );
  }

  Widget biometricButtons(BuildContext context) {
    return Visibility(
      visible: (model?.userLocalLogged ?? false) &&
          ((model?.fingerPrintAvailable ?? false) ||
              (model?.faceIdAvailable ?? false)),
      child: Column(
        children: <Widget>[
          PoppinsText(
            content: "Or use:",
            fontSize: 14,
            textColor: PayPOutColors.PrimaryAssentColor,
          ),
          Container(
            padding: EdgeInsets.only(top: 20, bottom: 40),
            alignment: Alignment.center,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[faceIDButton(context), touchIDButton(context)],
            ),
          )
        ],
      ),
    );
  }

  ///MARK: - Inicio de sesion con FACE ID
  Widget faceIDButton(BuildContext context) {
    final button = PoppinsButton(
        image: SVGImage.faceIdIcon,
        content: 'Face ID',
        fontWeight: FontWeight.bold,
        onTap: () async {
          var completeLogin = await model?.faceIDLogin((message) {
            showErrorDialog('Error al iniciar sesion', message, context);
          });
          if (completeLogin ?? false) {
            // LLEVAR AL USUARIO AL HOME
            model?.navToPayOutHome();
          }
        });

    if (model?.faceIdAvailable ?? false) {
      if (model?.fingerPrintAvailable ?? false) {
        return Expanded(child: button);
      }
      return Container(width: 150, child: button);
    }
    return Container();
  }

  ///MARK: - Inicio de sesion con TOUCH ID
  Widget touchIDButton(BuildContext context) {
    final button = PoppinsButton(
        image: SVGImage.touchIdIcon,
        content: 'Touch ID',
        fontWeight: FontWeight.bold,
        onTap: () async {
          var completeLogin = await model?.touchIDLogin((message) {
            showErrorDialog('Error al iniciar sesion', message, context);
          });

          if (completeLogin ?? false) {
            // LLEVAR AL USUARIO AL HOME
            model?.navToPayOutHome();
          }
        });

    if (model?.fingerPrintAvailable ?? false) {
      if (model?.faceIdAvailable ?? false) {
        return Expanded(child: button);
      }
      return Container(width: 150, child: button);
    }
    return Container();
  }

  Widget providersLoginButtons(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(top: 20),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          if (Platform.isIOS)
            Expanded(
                child: PoppinsButton(
                    image: SVGImage.appleIcon,
                    onTap: () => loginWithApple(context))),
          Expanded(
              child: PoppinsButton(
                  image: SVGImage.googleIcon,
                  onTap: () => loginWithGoogle(context))),
          Expanded(
              child: PoppinsButton(
                  image: SVGImage.facebookIcon,
                  onTap: () => loginWithFacebook(context)))
        ],
      ),
    );
  }

  Widget footer(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(top: 52, bottom: 40),
      child: Column(
        children: <Widget>[
          Container(
            margin: EdgeInsets.only(bottom: 20),
            child: PoppinsText(
              content: "Don't have an account?",
              fontSize: 14,
              textColor: PayPOutColors.PrimaryAssentColor,
            ),
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: Container(
                  margin: EdgeInsets.only(left: 32, right: 32),
                  child: PoppinsButton(
                    content: "Create account",
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () => model?.navToRegisterUser(),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  void loginWithGoogle(BuildContext context) {
    model?.getGoogleCredential().then((socialID) {
      if (socialID != null || socialID!.isNotEmpty) {
        model?.socialLogIn(socialID, () {
          model?.navToPayOutHome();
        }, (error) {
          model?.showErrorDialog(context, "Error", error);
        });
      }
    });
  }

  void loginWithFacebook(BuildContext context) {
    model?.getFacebookCredential().then((socialID) {
      if (socialID != null || socialID!.isNotEmpty) {
        model?.socialLogIn(socialID, () {
          model?.navToPayOutHome();
        }, (error) {
          model?.showErrorDialog(context, "Error", error);
        });
      }
    });
  }

  void loginWithApple(BuildContext context) {
    model?.getAppleCredential().then((socialID) {
      if (socialID != null || socialID!.isNotEmpty) {
        model?.socialLogIn(socialID, () {
          model?.navToPayOutHome();
        }, (error) {
          model?.showErrorDialog(context, "Error", error);
        });
      }
    });
  }

  void _showPopupMenu(BuildContext context) async {
    await showMenu(
        context: context,
        position: RelativeRect.fromLTRB(400, 100, 50, 100),
        items: [
          PopupMenuItem(
              height: 30,
              child: Container(
                alignment: Alignment.centerRight,
                child: SvgPicture.asset(SVGImage.close,
                    color: PayPOutColors.PrimaryColor),
              )),

          /// CloseButton
          PopupMenuItem(
              height: 30,
              child: Container(
                width: double.infinity,
                padding: EdgeInsets.only(left: 16),
                child: GestureDetector(
                    onTap: model?.navToFaqs,
                    child: Container(
                      child: PoppinsText(content: "FAQ's"),
                    )),
              )),
          PopupMenuItem(
            height: 10,
            child: Container(
              margin: EdgeInsets.only(top: 12),
              height: 0.5,
              width: double.infinity,
              color: Colors.grey.withOpacity(0.5),
            ),
          ),
          PopupMenuItem(
              height: 60,
              child: Container(
                width: double.infinity,
                padding: EdgeInsets.only(left: 16),
                child: GestureDetector(
                    onTap: model?.navToPreviewApp,
                    child: Container(
                      child: PoppinsText(content: "Preview app"),
                    )),
              ))
        ],
        elevation: 8.0,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(18.0),
        ));
  }
}
