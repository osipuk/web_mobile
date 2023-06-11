import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class InvitationRejectedAPI extends API {
  final sendNewInvitationApi = '${API.baseUrl}/replaceUserInPayout';

  Future<GeneralResponse> sendInvitation(
    String? poolID,
    String? newUserId,
    String? oldUserId,
    bool isRegistered,
  ) async {
    final response = await http.post(
      Uri.parse(sendNewInvitationApi),
      body: {
        'pool_id': poolID,
        if (isRegistered) 'new_user_id': newUserId,
        if (!isRegistered) 'non_registered_new_user_email': newUserId,
        'old_user_id': oldUserId,
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $sendNewInvitationApi');
    }
  }
}
