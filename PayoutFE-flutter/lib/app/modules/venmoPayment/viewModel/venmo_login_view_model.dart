import 'package:collection/collection.dart';
import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_request.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_response.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/modules/venmoPayment/repository/venmo_login_repository.dart';
import 'package:pay_out/app/modules/venmoPayment/ui/venmo_login_screen.dart';

class VenmoLoginViewModel extends PayOutViewModel {
  final VenmoRepository repository = VenmoRepository();

  VenmoLoginViewModel(BuildContext context) : super(context);

  final String venmoLoginApi =
      "https://api.venmo.com/v1/oauth/authorize?client_id=1112&scope=access_profile,make_payments&response_type=code";

  bool isLoading = true;
  var status = VenmoLoginState.INIT;

  void postVenmoPayment(
      VenmoPaymentRequest request,
      Function(VenmoPaymentInfoResponse?) complete,
      Function(String) onError) async {
    repository.sentVenmoPayment(request).then(
      (response) {
        if (response.data?.payment != null) {
          complete(response.data?.payment);
        } else {
          onError("No se pudo completar el pago");
        }
      },
    );
  }

  void markVenmoPaymentSuccessfull(PayOut? payOut,
      Function(PaymentResponse) onSuccess, Function(String) onError) async {
    final payer = payOut?.members!
        .firstWhereOrNull((e) => e.payoutOrder == payOut.currentMonth());
    int payedID = await SharedPreferencesManager.get.getUserID();

    final me = payOut?.members!.firstWhereOrNull((e) => e.userID == payedID);
    num amount = payOut?.amountPerDeduction ?? 0;
    if (me?.isShared == 1) {
      amount = amount / 2;
    }

    final paymentRequest = PaymentRequest(
      amount: amount.toDouble(),
      payer: payer?.userID,
      payed: payedID,
      poolID: payOut?.poolID,
      type: PaymentRequest.VENMO,
    );

    repository.markVenmoPaidSuccesfull(paymentRequest).then((response) {
      if (response.status) {
        onSuccess(response);
      } else {
        onError(response.message);
      }
    });
  }
}
