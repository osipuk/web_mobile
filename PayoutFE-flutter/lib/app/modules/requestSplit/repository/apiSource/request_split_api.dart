import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class RequestSplitAPI extends API {
  final requestSplitApi = '${API.baseUrl}/splitPayout';

  Future<GeneralResponse> splitWithUserRegister(
      PayOut? payOut, int senderID, int receiverID) async {
    final response = await http.post(
      Uri.parse(requestSplitApi),
      body: {
        'pool_id': payOut?.poolID.toString(),
        'pool_owner_id': payOut?.userID.toString(),
        'sender_id': senderID.toString(),
        'receiver_id': receiverID.toString(),
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse deleteResponse =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return deleteResponse;
    } else {
      throw Exception('API ERROR: $requestSplitApi');
    }
  }

  Future<GeneralResponse> splitWitNotUserRegister(
      PayOut? payOut, int senderID, String email) async {
    final response = await http.post(
      Uri.parse(requestSplitApi),
      body: {
        'pool_id': payOut?.poolID.toString(),
        'pool_owner_id': payOut?.userID.toString(),
        'sender_id': senderID.toString(),
        'non_registered_user': email,
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse deleteResponse =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return deleteResponse;
    } else {
      throw Exception('API ERROR: $requestSplitApi');
    }
  }
}
