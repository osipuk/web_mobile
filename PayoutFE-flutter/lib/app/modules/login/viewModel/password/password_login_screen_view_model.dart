import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/login/model/login_response.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';

class PasswordLoginScreenViewModel extends PayOutViewModel {
  final LoginRepository repository = LoginRepository();

  bool isLoginError = false;
  bool hidePassword = true;
  String errorMessage = "";

  String passwordCurrent = "";

  PasswordLoginScreenViewModel(BuildContext context) : super(context);

  void changePasswordViewed() {
    this.hidePassword = !this.hidePassword;
    notifyListeners();
  }

  String getTitleMessage() {
    return isLoginError ? errorMessage : 'Password';
  }

  void enableLoginIntent(String error) {
    isLoginError = true;
    errorMessage = error;
    notifyListeners();
  }

  void disableLoginIntent() {
    isLoginError = false;
  }

  ///MARK: API functions
  void postLogin(String email, String password,
      Function(LoginResponse) onSuccess, Function(String) onError) {
    repository.loginUser(email, password).then((response) {
      hideLoader();
      if (response.status) {
        SharedPreferencesManager.get.saveAuthToken(response.authToken);
        onSuccess(response);
      } else {
        onError(response.message);
      }
      notifyListeners();
    }).catchError(error);
  }

  void onSaveUserLogged(User? user) {
    DatabaseManager.get.saveUser(user);
    SharedPreferencesManager.get.saveUserID(user?.id);
    navToPayOutHome();
  }

  ///MARK: Navigate functions
  void navToForgotPassword(BuildContext context, String email) {
    context.router.push(ForgotPasswordLoginScreenRoute(email: email));
  }
}
