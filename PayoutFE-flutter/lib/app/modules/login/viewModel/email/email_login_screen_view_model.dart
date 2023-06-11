import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';

class EmailLoginScreenViewModel extends PayOutViewModel {
  bool isValidEmail = true;
  String emailCurrent = "";

  EmailLoginScreenViewModel(BuildContext context) : super(context);

  void setValidEmail(bool validEmail) {
    isValidEmail = validEmail;
    notifyListeners();
  }

  String getTitleMessage() {
    return isValidEmail ? 'Email' : 'Invalid email';
  }

  Color getStatusColor() {
    return isValidEmail ? PayPOutColors.PrimaryColor : PayPOutColors.ErrorColor;
  }

  void navToPasswordLogin(
    BuildContext context,
    String email, {
    VoidCallback? onBackCallback,
  }) {
    context.router.push(PasswordLoginScreenRoute(
      email: email,
      onBackCallback: onBackCallback,
    ));
  }
}
