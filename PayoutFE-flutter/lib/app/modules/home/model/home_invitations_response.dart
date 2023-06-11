import 'package:pay_out/app/modules/home/model/payout_invitation.dart';

class PayoutInvitationsResponse {
  final bool status;
  final String message;
  final List<PayOut>? data;

  PayoutInvitationsResponse(
      {required this.status, required this.message, this.data});

  factory PayoutInvitationsResponse.fromJson(Map<String, dynamic> json) {
    return PayoutInvitationsResponse(
        status: json['status'],
        message: json['message'],
        data: PayOut.toList(json));
  }
}
