import 'package:pay_out/app/modules/register/model/bank_stripe_customer.dart';

class RegisterAddBankAccountResponse {
  final bool status;
  final String message;
  final StripeCustomer? data;

  RegisterAddBankAccountResponse(
      {required this.status, required this.message, this.data});

  factory RegisterAddBankAccountResponse.fromJson(Map<String, dynamic> json) {
    return RegisterAddBankAccountResponse(
        status: json['status'],
        message: json['message'],
        data: (json['data'] is String)
            ? StripeCustomer()
            : StripeCustomer.fromJson(json['data']));
  }
}
