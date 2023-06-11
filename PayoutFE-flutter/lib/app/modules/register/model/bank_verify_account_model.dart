import 'package:pay_out/app/modules/register/model/bank_token_model.dart';

class RegisterVerifyBankAccountResponse {
  final bool status;
  final String message;
  final BankAccount? data;

  RegisterVerifyBankAccountResponse(
      {required this.status, required this.message, this.data});

  factory RegisterVerifyBankAccountResponse.fromJson(
      Map<String, dynamic> json) {
    return RegisterVerifyBankAccountResponse(
      status: json['status'],
      message: json['message'],
      data: (json['data'] is String)
          ? BankAccount()
          : BankAccount.fromJson(json['data']),
    );
  }
}
