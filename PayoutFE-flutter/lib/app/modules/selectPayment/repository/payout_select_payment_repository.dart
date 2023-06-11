import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/modules/selectPayment/repository/apiSource/payout_select_payment_api.dart';

class SelectPaymentRepository {
  final SelectPaymentAPI api = SelectPaymentAPI();

  Future<PaymentResponse> postMarkPaymentSuccesfull(
      PaymentRequest paymentRequest) {
    return api.markPaymentSuccesfull(paymentRequest).then((response) {
      return response;
    });
  }
}
