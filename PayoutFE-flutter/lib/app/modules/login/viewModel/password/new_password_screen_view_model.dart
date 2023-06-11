import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:auto_route/auto_route.dart';

class NewPasswordLoginScreenViewModel extends PayOutViewModel {
  bool hidePassword = true;
  NewPasswordLoginScreenViewModel(BuildContext context) : super(context);

  void changePasswordViewed() {
    this.hidePassword = !this.hidePassword;
    notifyListeners();
  }

  void showSuccessChangePasswordDialog({VoidCallback? onBackCallback}) {
    context.router.navigate(ChangeCorrectPassDialogRoute(
      onBackCallback: onBackCallback,
    ));
  }
}
