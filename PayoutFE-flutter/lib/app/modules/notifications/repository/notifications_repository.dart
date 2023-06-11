import 'package:pay_out/app/modules/home/model/payout_detail_response.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:pay_out/app/modules/notifications/repository/apiSource/notifications_api.dart';

class NotificationsRepository {
  final NotificationsAPI api = NotificationsAPI();

  Future<List<NotificationModel>> getNotifications(String userID) {
    return api.getNotifications(userID).then((response) {
      return response;
    });
  }

  Future<PayoutDetailResponse> getPayOutDetail(String poolID) {
    return api.getPayOutDetail(poolID).then((response) {
      return response;
    });
  }
}
