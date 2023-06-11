import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/register/repository/register_repository.dart';

class RegisterBankInfoViewModel extends PayOutViewModel {
  RegisterBankInfoViewModel(BuildContext context) : super(context);
  final RegisterRepository repository = RegisterRepository();
}
