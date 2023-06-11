import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:auto_route/auto_route.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/modules/selectPayment/repository/payout_select_payment_repository.dart';
import 'package:collection/collection.dart';

class SelectPaymentTypeViewModel extends PayOutViewModel {
  SelectPaymentTypeViewModel(BuildContext context) : super(context);
  final SelectPaymentRepository repository = SelectPaymentRepository();

  int optionSelected = 0;

  final List<String> options = [
    "Cash / Check",
    "Thru Venmo",
  ];

  void markCashPaymentSuccessfull(
      PayOut? payOut,
      Function(PaymentResponse, num) onSuccess,
      Function(String) onError) async {
    final payed = payOut?.members!
        .firstWhereOrNull((e) => e.payoutOrder == payOut.currentMonth());
    int payerID = await SharedPreferencesManager.get.getUserID();

    final me = payOut?.members!.firstWhereOrNull((e) => e.userID == payerID);
    num amount = payOut?.amountPerDeduction ?? 0;
    if (me?.isShared == 1) {
      amount = amount / 2;
    }

    final paymentRequest = PaymentRequest(
      amount: amount.toDouble(),
      payer: payerID,
      payed: payed?.userID,
      poolID: payOut?.poolID,
      type: PaymentRequest.CASH,
    );

    repository.postMarkPaymentSuccesfull(paymentRequest).then((response) {
      if (response.status) {
        onSuccess(response, amount);
      } else {
        onError(response.message);
      }
    });
  }

  ///MARK: Navigate functions
  void navToVenmoLogin(
    BuildContext context,
    PayOut? payOut,
    PayoutMember? member,
    Function onPaymentComplete, {
    VoidCallback? onBackCallback,
  }) {
    context.router.push(
      VenmoLoginScreenRoute(
        onBackCallback: onBackCallback,
        payOut: payOut,
        member: member,
        onPaymentComplete: onPaymentComplete,
      ),
    );
  }
}
