import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/payoutDetail/model/delete_payout_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class PayOutDetailAPI extends API {
  final deletePayOutDetailApi = '${API.baseUrl}/deletePayout';

  Future<DeletePayoutResponse> deletePayout(String poolID) async {
    final response = await http.post(
      Uri.parse(deletePayOutDetailApi),
      body: {'pool_id': poolID},
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    print(await SharedPreferencesManager.get.authToken());

    if (response.statusCode == 200) {
      DeletePayoutResponse deleteResponse =
          DeletePayoutResponse.fromJson(jsonDecode(response.body));
      return deleteResponse;
    } else {
      throw Exception('API ERROR: $deletePayOutDetailApi');
    }
  }
}
