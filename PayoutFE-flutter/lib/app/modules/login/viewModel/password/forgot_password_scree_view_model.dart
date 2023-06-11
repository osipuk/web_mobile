import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';

class ForgotPasswordLoginScreenViewModel extends PayOutViewModel {
  final LoginRepository repository = LoginRepository();

  bool hidePassword = true;
  String email = "";

  ForgotPasswordLoginScreenViewModel(BuildContext context) : super(context);

  void changePasswordViewed() {
    this.hidePassword = !this.hidePassword;
    notifyListeners();
  }

  void setRouteData(String email) {
    this.email = email;
    forgotPassword();
  }

  ///MARK: API functions
  void forgotPassword(
      {Function(GeneralResponse)? onSuccess, Function(String)? onError}) {
    repository.forgotPassword(email).then((response) {
      if (response.status) {
        if (onSuccess != null) {
          onSuccess(response);
        }
      } else {
        if (onError != null) {
          onError(response.message);
        }
      }
      notifyListeners();
    }).catchError(error);
  }

  ///MARK: Navigate functions
  void navToNewPassword({VoidCallback? onBackCallback}) {
    context.router.navigate(NewPasswordLoginScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }
}
