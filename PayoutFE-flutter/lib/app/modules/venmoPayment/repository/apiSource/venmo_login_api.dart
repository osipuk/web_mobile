import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_request.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_response.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class VenmoAPI extends API {
  final postVenmoPayment = '${API.venmoBaseUrl}/payments';
  final postMaikPaid = '${API.serverUrl}/markPayment';

  Future<VenmoPaymentResponse> sentVenmoPayment(
      VenmoPaymentRequest request) async {
    final response = await http.post(
      Uri.parse(postVenmoPayment),
      body: request.toMap(),
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      VenmoPaymentResponse responseUser =
          VenmoPaymentResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $postVenmoPayment');
    }
  }

  Future<PaymentResponse> markVenmoPaidSuccesfull(
      PaymentRequest paymentRequest) async {
    final response = await http.post(
      Uri.parse(postMaikPaid),
      body: paymentRequest.toMap(),
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      PaymentResponse responseUser =
          PaymentResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $postVenmoPayment');
    }
  }
}
