import 'package:pay_out/app/modules/home/model/payout_invitation.dart';

class PayoutDetailResponse {
  final bool status;
  final String message;
  final PayOut data;

  PayoutDetailResponse(
      {required this.status, required this.message, required this.data});

  factory PayoutDetailResponse.fromJson(Map<String, dynamic> json) {
    return PayoutDetailResponse(
      status: json['status'],
      message: json['message'],
      data: PayOut.fromJson(json['pool_data']),
    );
  }
}
