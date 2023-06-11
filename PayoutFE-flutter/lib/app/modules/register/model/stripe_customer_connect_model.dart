import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/register/model/register_bank_info_model.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';

class StripeConnectCustomer {
  final String? bankToken;
  final Register? register;
  final User? user;
  final RegisterBankInfoRequest? request;

  StripeConnectCustomer(
    this.bankToken,
    this.register,
    this.user,
    this.request,
  );

  Map<String, dynamic> toMap() {
    return {
      'bankToken': bankToken.toString(),
      'first_name': user?.firstName.toString(),
      'last_name': user?.lastName.toString(),
      'email': user?.email.toString(),
      'phone': register?.phone.toString(),
      'ssn_last_4': request?.ssn.toString(),
      'state': register?.state.toString(),
      'city': register?.city.toString(),
      'address': register?.address.toString(),
      'postal_code': register?.postalCode.toString(),
      'dob_year': request?.dob?.year.toString(),
      'dob_month': request?.dob?.month.toString(),
      'dob_day': request?.dob?.day.toString(),
    };
  }
}

class StripeCustomerResponse {
  final bool status;
  final String message;
  final String stripeAccountId;

  StripeCustomerResponse(
      {required this.status,
      required this.message,
      required this.stripeAccountId});

  factory StripeCustomerResponse.fromJson(Map<String, dynamic> json) {
    return StripeCustomerResponse(
        status: json['status'] ?? json['success'],
        message: json['message'],
        stripeAccountId: json['stripeAccountId']);
  }
}
