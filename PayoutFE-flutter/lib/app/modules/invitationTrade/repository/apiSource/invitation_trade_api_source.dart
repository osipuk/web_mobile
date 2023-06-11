import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class InviteTradeAPI extends API {
  final postResponseInviteApi = '${API.baseUrl}/acceptRejectJoinPool';
  final changeNotiStatus = '${API.baseUrl}/changeNotificationStatus';

  Future<GeneralResponse> postResponseInvitation(int userID, PayOut? payOut,
      PayoutMember? requestInvUser, int responseJoin) async {
    final response = await http.post(
      Uri.parse(postResponseInviteApi),
      body: {
        'pool_id': payOut?.poolID.toString(),
        'pool_owner_id': payOut?.userID.toString(),
        'user_id': userID.toString(),
        'join_status': responseJoin.toString(),
        'request_type': PayOut.WANTS_TO_SWAP_REQUEST.toString(),
        'sender_id': requestInvUser?.userID.toString(),
        'receiver_id': userID.toString(),
      },
      headers: {
        HttpHeaders.contentTypeHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $postResponseInviteApi');
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
