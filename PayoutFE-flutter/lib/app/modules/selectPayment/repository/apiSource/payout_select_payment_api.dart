import 'dart:convert';
import 'dart:io';

import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_request.dart';
import 'package:pay_out/app/modules/selectPayment/model/payment_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class SelectPaymentAPI extends API {
  final markPaymentApi = '${API.baseUrl}/markPayment';

  Future<PaymentResponse> markPaymentSuccesfull(
      PaymentRequest paymentRequest) async {
    final response = await http.post(
      Uri.parse(markPaymentApi),
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
      throw Exception('API ERROR: $markPaymentApi');
    }
  }
}
