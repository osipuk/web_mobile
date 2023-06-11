import 'package:flutter/material.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';
import 'package:pay_out/app/modules/register/repository/register_repository.dart';

class ValidateCodeViewModel extends PayOutViewModel {
  final RegisterRepository repository = RegisterRepository();
  final LoginRepository loginRepository = LoginRepository();

  String code = "";

  ValidateCodeViewModel(BuildContext context) : super(context);

  ///  API Functions
  void sendSMSCode(String? phoneUser, Function(GeneralResponse) onSuccess,
      Function(String) onError) {
    final number = '+$phoneUser';
    repository.sendSMSCode(number).then((response) {
      if (response.status) {
        onSuccess(response);
      } else {
        onError(response.message);
      }
    });
  }

  void verifySMSCode(String? phoneUser, int idUser,
      Function(GeneralResponse) onSuccess, Function(String) onError) {
    final number = '+$phoneUser';
    repository.verifySMSCode(idUser, code, number).then((response) {
      if (response.status) {
        onSuccess(response);
      } else {
        onError(response.message);
      }
    });
  }

  bool isValidCodeData() {
    bool validCode = code.isNotEmpty;
    return validCode;
  }
}
