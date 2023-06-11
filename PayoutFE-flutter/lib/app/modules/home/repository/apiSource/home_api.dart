import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/home/model/home_invitations_response.dart';
import 'package:pay_out/app/modules/home/model/payout_detail_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class HomeAPI extends API {
  final getPayoutsInvitationsApi = '${API.baseUrl}/inviteJoinPoolRequest';
  final getPayoutsApi = '${API.baseUrl}/getPendingPoolHistory';
  final getPayoutDetailApi = '${API.baseUrl}/getPoolDetails';

  Future<PayoutDetailResponse> getPayOutDetail(String poolID) async {
    final response = await http.post(
      Uri.parse(getPayoutDetailApi),
      body: {'pool_id': poolID},
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      PayoutDetailResponse responseUser =
          PayoutDetailResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getPayoutsApi');
    }
  }

  Future<PayoutInvitationsResponse> getMyPayOuts(String userID) async {
    final response = await http.post(
      Uri.parse(getPayoutsApi),
      body: {'user_id': userID},
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      PayoutInvitationsResponse responseUser =
          PayoutInvitationsResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getPayoutsApi');
    }
  }

  Future<PayoutInvitationsResponse> invitations(String userID) async {
    final response = await http.post(
      Uri.parse(getPayoutsInvitationsApi),
      body: {'user_id': userID},
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      PayoutInvitationsResponse responseUser =
          PayoutInvitationsResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getPayoutsInvitationsApi');
    }
  }
}
