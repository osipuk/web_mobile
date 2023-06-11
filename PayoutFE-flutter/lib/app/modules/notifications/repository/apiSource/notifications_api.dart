import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/home/model/payout_detail_response.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class NotificationsAPI extends API {
  final getNotificationsCenterApi = '${API.baseUrl}/notifications';
  final getPayoutDetailApi = '${API.baseUrl}/getPoolDetails';

  Future<List<NotificationModel>> getNotifications(String userID) async {
    final response = await http.post(
      Uri.parse(getNotificationsCenterApi),
      body: {'user_id': userID},
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      List<NotificationModel> notifications =
          (json.decode(response.body) as List)
              .map((data) => NotificationModel.fromJson(data))
              .toList();
      return notifications;
    } else {
      throw Exception('API ERROR: $getNotificationsCenterApi');
    }
  }

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
      throw Exception('API ERROR: $getPayoutDetailApi');
    }
  }
}
