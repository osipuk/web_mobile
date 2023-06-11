import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class InvitationSplitAPI extends API {
  final requestSplitApi = '${API.baseUrl}/acceptDeclineSplit';
  final changeNotiStatus = '${API.baseUrl}/changeNotificationStatus';

  Future<GeneralResponse> responseInvitationSplit(
      int? requestID, int userID, bool accepted) async {
    final response = await http.post(
      Uri.parse(requestSplitApi),
      body: {
        'request': requestID.toString(),
        'user_id': userID.toString(),
        'join_status': accepted ? "1" : "2",
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

  Future<GeneralResponse> changeNotificationStatus(int? notID) async {
    final response = await http.post(
      Uri.parse(changeNotiStatus),
      body: {
        'notification_id': notID.toString(),
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
      throw Exception('API ERROR: $changeNotiStatus');
    }
  }
}
