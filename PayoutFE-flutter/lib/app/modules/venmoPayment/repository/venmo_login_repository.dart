import 'package:pay_out/app/modules/home/model/venmo_payment_request.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_response.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/modules/venmoPayment/repository/apiSource/venmo_login_api.dart';

class VenmoRepository {
  final VenmoAPI api = VenmoAPI();

  Future<VenmoPaymentResponse> sentVenmoPayment(VenmoPaymentRequest request) {
    return api.sentVenmoPayment(request).then((response) {
      return response;
    });
  }

  Future<PaymentResponse> markVenmoPaidSuccesfull(
      PaymentRequest paymentRequest) {
    return api.markVenmoPaidSuccesfull(paymentRequest).then((response) {
      return response;
    });
  }
}
