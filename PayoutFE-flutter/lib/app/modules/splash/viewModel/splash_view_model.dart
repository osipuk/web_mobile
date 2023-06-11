import 'dart:async';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';

class SplashScreenViewModel extends PayOutViewModel {
  SplashScreenViewModel(BuildContext context) : super(context);

  void navToInitRoute(BuildContext context) {
    Timer(Duration(seconds: 1), () {
      validateInitRoot();
    });
  }

  void validateInitRoot() async {
    final token = await SharedPreferencesManager.get.authToken();
    SharedPreferencesManager.get.getUserID().then((userID) {
      if (userID > 0 && token.isNotEmpty) {
        _goToPayOutHome();
      } else {
        _goToLoginHome();
      }
    });
  }

  void _goToPayOutHome() async {
    showLoader();
    final userID = await SharedPreferencesManager.get.getUserID();
    final user = await ProfileRepository().getProfileUser(userID.toString());
    DatabaseManager.get.saveUser(user.data);

    hideLoader();
    final numberValidated = user.data?.numberVerify == 1;
    final emailValidated = user.data?.emailVerify == 1;
    if (!numberValidated) {
      navToValidateCode(
        onBackCallback: () {
          _goToPayOutHome();
        },
      );
      return;
    }

    if (!emailValidated) {
      _showValidatedErrorEmail();
      return;
    }
    navToPayOutHome();
  }

  void _showValidatedErrorEmail() {
    showOptionsDialog(
      context,
      "Please confirm your email.",
      "Please confirm your email to continue using Payout.",
      SVGImage.emailImg,
      aceptTitleBtn: "Verify",
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        _goToPayOutHome();
      },
    );
  }

  void _goToLoginHome() {
    navToLoginHome();
  }

  @override
  void dispose() {
    super.dispose();
  }
}
