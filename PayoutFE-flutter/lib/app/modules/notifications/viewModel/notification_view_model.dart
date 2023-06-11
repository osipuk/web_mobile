import 'dart:async';

import 'package:collection/collection.dart';
import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:pay_out/app/modules/notifications/repository/notifications_repository.dart';

class NotificationScreenViewModel extends PayOutViewModel {
  NotificationScreenViewModel(BuildContext context) : super(context);

  final NotificationsRepository repository = NotificationsRepository();

  List<NotificationModel> newNotifications = [];
  List<NotificationModel> oldNotifications = [];
  List<NotificationModel> items = [];

  bool load = false;
  bool showedList = false;
  bool canNewChangeHeigth = true;
  bool canOldChangeHeigth = true;

  //MARK: Get notifications list
  void getNotifications(
      String userID, Function() onComplete, Function(String) onError) async {
    repository.getNotifications(userID).then(
      (response) {
        setNotifications(response);
        onComplete();
      },
    ).catchError(error);
  }

  void setNotifications(List<NotificationModel> list) {
    items = list;
    // new notificatios
    newNotifications = items
        .where((e) =>
            e.status == NotificationModel.NEW_NOTIFICATION &&
            e.isActive == NotificationModel.IS_ACTIVE &&
            !(e.type == NotificationType.TIME_TO_PAY &&
                e.notificationOwnerID == e.userID))
        .toList();

    // old and Showed notificatios
    oldNotifications = items
        .where((e) =>
            e.status == NotificationModel.SHOW_NOTIFICATION &&
            e.isActive == NotificationModel.IS_ACTIVE &&
            !(e.type == NotificationType.TIME_TO_PAY &&
                e.notificationOwnerID == e.userID))
        .toList();

    load = true;
    Timer(Duration(seconds: 2), () {
      showedList = true;
      notify();
    });
  }

  void getPayoutDetail(
      String poolID, Function(PayOut) onComplete, Function(String) onError,
      {bool ommitedJoined = true}) async {
    repository.getPayOutDetail(poolID).then(
      (response) async {
        if (response.status) {
          final isJoined = await isJoinedInPayOut(response.data);
          if (isJoined && !ommitedJoined) {
            navToPayOutDetail(response.data);
          } else {
            onComplete(response.data);
          }
        } else {
          onError(response.message);
        }
      },
    ).catchError(error);
  }

  Future<bool> isJoinedInPayOut(PayOut payOut) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    return payOut.members!.firstWhereOrNull(
          (e) => e.joinStatus == 1 && e.userID == userID,
        ) !=
        null;
  }

  void notificationActionFlow(NotificationModel? notification) async {
    final poolID = notification!.poolID.toString();

    switch (notification.type) {
      case NotificationType.INVITATION:
        showLoader();
        getPayoutDetail(poolID, (payOut) {
          navToInvitationPayOut(payOut);
        }, (error) => print(error), ommitedJoined: false);
        break;
      case NotificationType.REJECT:
        getPayoutDetail(poolID, (payOut) {
          navToInvitationRejected(payOut);
        }, (error) => print(error));
        break;
      case NotificationType.TIME_TO_PAY:
        getPayoutDetail(poolID, (payOut) {
          final member = PayoutMember(userID: notification.userToPay);
          navToPaymentType(payOut, member, () {
            back();
          });
        }, (error) => print(error));
        break;
      case NotificationType.TRADE:
        getPayoutDetail(poolID, (payOut) {
          navToResponseRequestATrade(
            payOut,
            requestedUserID: notification.userID,
            notID: notification.id,
          );
        }, (error) => print(error));
        break;
      case NotificationType.TRADE_ADMIN:
        getPayoutDetail(poolID, (payOut) {
          navToPayOutDetail(payOut);
        }, (error) => print(error));
        break;
      case NotificationType.SPLIT:
        getPayoutDetail(poolID, (payOut) async {
          navToInviteSplit(
            payOut,
            requestedUserID: notification.userID,
            requestedID: notification.request,
            notID: notification.id,
          );
        }, (error) => print(error));
        break;
      default:
        getPayoutDetail(poolID, (payOut) {
          navToPayOutDetail(payOut);
        }, (error) => print(error));
        break;
    }
  }

  String dateToNotifications(NotificationModel? not) {
    DateTime date = DateTime.parse(not?.createdAt ?? '');
    final newDate = DateTime.now().difference(date);

    switch (newDate.inDays) {
      case 0:
        return "Today";
      case 1:
        return "Yesterday";

      default:
        if (newDate.inDays <= 6) {
          final days = newDate.inDays;
          return "${days.toInt()} ${days == 1 ? " Day" : " Days"}";
        }
        if (newDate.inDays >= 365) {
          final years = newDate.inDays ~/ 365;
          return "$years ${years == 1 ? " Year" : " Years"}";
        }
        if (newDate.inDays >= 30) {
          final months = newDate.inDays ~/ 30;
          return "$months ${months == 1 ? " Month" : " Months"}";
        }
        if (newDate.inDays >= 7) {
          final weeks = newDate.inDays ~/ 7;
          return "$weeks ${weeks == 1 ? " Week" : " Weeks"}";
        }
    }

    return newDate.inDays.toString();
  }
}
