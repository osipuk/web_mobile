import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';

class PayOutManager {
  static PayOutManager get = PayOutManager();

  void logOut(BuildContext context) {
    SharedPreferencesManager.get.deleteUserID();
    SharedPreferencesManager.get.deleteAuthToken();
    PayOutViewModel _model = PayOutViewModel(context);
    _model.navToLoginHome();
  }
}
