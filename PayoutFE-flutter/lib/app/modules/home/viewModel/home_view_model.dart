import 'dart:async';
import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/modules/editProfile/repository/edit_profile_repository.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/home/repository/home_repository.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:collection/collection.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:pay_out/app/modules/notifications/repository/notifications_repository.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';

class HomeViewModel extends PayOutViewModel {
  String? pathProfile;
  var isSwipeActive = true;
  var cardIndexSelected = 0; // Indice de la carta seleccionada de payOuts
  var reset = false;

  int? status = PayOut.progressStatus;
  User? user;

  List<PayOut>? allPayOuts;
  List<PayOut>? payOuts; // payouts con o sin filtro

  final HomeRepository repository = HomeRepository();
  final ProfileRepository profileRepository = ProfileRepository();
  final NotificationsRepository notRepository = NotificationsRepository();
  final EditProfileRepository edtiProfileRepository = EditProfileRepository();

  final PushNotificationsManager notManager = PushNotificationsManager.get;

  HomeViewModel(BuildContext context) : super(context);

  // validar permisos y demas
  void setUpApp() async {
    final userID = await SharedPreferencesManager.get.getUserID();
    _updateTokenDevice(userID);
    _getNotificationsList(userID);
  }

  /// MARK : SETTINGS App Functions
  void _updateTokenDevice(int userID) async {
    final token = await notManager.getNotificationToken();
    edtiProfileRepository.editProfileUser({User.DEVICE_TOKEN: token}, userID);
  }

  void _getNotificationsList(int userID) async {
    final notificationList =
        await notRepository.getNotifications(userID.toString());
    PushNotificationsManager.isPendingNotifications = notificationList
        .where((e) => e.status == NotificationModel.NEW_NOTIFICATION)
        .toList()
        .isNotEmpty;
    if (PushNotificationsManager.isPendingNotifications) {
      navToNotifications(
        notificationLoaded: notificationList,
      );
    }
  }

  PayoutMember? getNextMemberToPay(PayOut? payOut) {
    return payOut?.members?.firstWhereOrNull((e) =>
        e.userID == payOut.userToPay &&
        (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0)));
  }

  /// MARK : API Functions
  void getUser() async {
    final user = await DatabaseManager.get.getUser();
    this.user = user;
    pathProfile = user?.getProfileImage();
    notify();
  }

  //MARK: Get payOut list
  void getPayouts(String userID, Function(List<PayOut>?) onComplete,
      Function(String) onError) async {
    repository.getMyPayOuts(userID).then(
      (response) {
        if (response.status) {
          List<PayOut> list = [];
          response.data?.forEach((e) async {
            var payout = await repository.getPayOutDetail(e.poolID.toString());
            list.add(payout.data);
            if (list.length == response.data?.length) {
              list.sort((a, b) => b.poolID.compareTo(a.poolID));
              allPayOuts = list;
              list = _filterPools(userID, list);
              onComplete(list);
            }
          });
          if (response.data?.length == 0) {
            onComplete(list);
          }
        } else {
          onError(response.message);
        }
      },
    ).catchError(error);
  }

  void getPayoutDetail(String poolID, Function(PayOut) onComplete,
      Function(String) onError) async {
    repository.getPayOutDetail(poolID).then(
      (response) {
        if (response.status) {
          onComplete(response.data);
        } else {
          onError(response.message);
        }
      },
    ).catchError(error);
  }

  //MARK: Utilities

  bool isReset() {
    Timer(Duration(milliseconds: 100), () {
      reset = false;
    });
    return reset;
  }

  void setFiltersStatus(int? status) {
    this.reset = true;
    this.status = status;
    this.notify();
  }

  bool isShowEmptyPayoutsWithFilters() {
    return (allPayOuts?.length ?? 0) > 0;
  }

  List<PayOut> _filterPools(String userID, List<PayOut> oldList) {
    var _newList = oldList
        .where((e) =>
            e.isDeleted != PayOut.DELETE_PAYOUT &&
            e.members!
                    .firstWhere((u) => u.userID.toString() == userID)
                    .joinStatus ==
                PayoutMember.joined)
        .toList();
    if (status != null) {
      _newList = _newList.where((e) => e.poolStatus == status).toList();
    }
    return _newList;
  }

  String statusTitleLabel(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return "Status:";
      case PayOut.progressStatus:
        return "Next payment in:";
      case PayOut.completedStatus:
        return "Status";
      case PayOut.cancelledStatus:
        return "Status";
      default:
        return "";
    }
  }

  String statusLabel(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return "Pending";
      case PayOut.progressStatus:
        return payOut.nextPaymentDateInDays();
      case PayOut.completedStatus:
        return "Completed";
      case PayOut.cancelledStatus:
        return "Canceled";
      default:
        return "";
    }
  }

  Color statusColor(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
      case PayOut.cancelledStatus:
        return PayPOutColors.PrimaryColor.withOpacity(0.4);
      case PayOut.progressStatus:
      case PayOut.completedStatus:
        return PayPOutColors.PrimaryColor;
      default:
        return PayPOutColors.PrimaryColor;
    }
  }

  String? dateAndCreateLabel(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return "Created by";
      case PayOut.progressStatus:
        return "${payOut.nextPaymentDate().getDateString("MMM / dd / yyyy")} , For:";
      case PayOut.completedStatus:
        return "Created by";
      case PayOut.cancelledStatus:
        return "Created by";
      default:
        return "";
    }
  }

  PayoutMember? getUserCreated(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        return payOut.members
            ?.firstWhere((element) => element.userID == payOut.userID);
      case PayOut.progressStatus:
        var user = payOut.members
            ?.firstWhereOrNull((e) => e.userID == payOut.userToPay);
        return user;

      default:
        return null;
    }
  }

  String? getNameUserCreated(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        var user = payOut.members
            ?.firstWhereOrNull((element) => element.userID == payOut.userID);

        return user?.getFirstName(payOut.members) ?? "";
      case PayOut.progressStatus:
        var user = payOut.members
            ?.firstWhereOrNull((e) => e.userID == payOut.userToPay);

        return user?.getFirstName(payOut.members) ?? "";
      default:
        return "";
    }
  }

  bool isUserHavePay(PayOut payOut) {
    var userToPayed =
        payOut.members?.firstWhereOrNull((e) => e.userID == payOut.userToPay);

    final _user = payOut.members
        ?.firstWhereOrNull((element) => element.userID == user?.id);

    final ispaid = payOut.members!
            .firstWhereOrNull((element) => element.userID == _user?.userID)
            ?.isPaid ==
        0;

    return payOut.members != null &&
        payOut.poolStatus == PayOut.progressStatus &&
        userToPayed?.userID != _user?.userID &&
        userToPayed?.payoutOrder != _user?.payoutOrder &&
        ispaid;
  }

  String membersTitle(PayOut payOut) {
    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return "United members:";
      case PayOut.progressStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        return "Members:";
      default:
        return "";
    }
  }

  String membersCounterTitle(PayOut payOut) {
    var members = payOut.members ?? [];
    var unitMembers = members.where((element) => element.joinStatus == 1);

    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return unitMembers.length > 4 ? "+ ${unitMembers.length - 4}" : "";
      case PayOut.progressStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        return members.length > 4 ? "+ ${members.length - 4}" : "";
      default:
        return "";
    }
  }

  List<PayoutMember> mermbersList(PayOut payOut) {
    var members = payOut.members ?? [];
    var filterUsers = members
        .where((e) => (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0)))
        .toList();

    var pendingMembers =
        filterUsers.where((element) => element.joinStatus == 1).toList();

    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
        return pendingMembers;
      case PayOut.progressStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        return filterUsers;
      default:
        return [];
    }
  }

  List<PoppinsRichContent>? isAllPaidInMonth(PayOut payOut) {
    var isNotPaidUser = payOut.members?.firstWhereOrNull(
        (e) => e.userID != payOut.userToPay && e.isPaid == 0);

    switch (payOut.poolStatus) {
      case PayOut.pengingStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        final list = payOut.members
            ?.where((element) => element.joinStatus == PayoutMember.joined);

        final allJoined = list?.length == payOut.members?.length;
        return [
          PoppinsRichContent(
            content: allJoined ? "At the moment " : "At the moment only ",
            fontSize: 12,
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: allJoined
                ? "all members "
                : list?.length == 1
                    ? "${list?.length} member "
                    : "${list?.length} members ",
            fontWeight: FontWeight.bold,
            fontSize: 12,
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: "have",
            fontSize: 12,
            textColor: Colors.black,
          )
        ];
      case PayOut.progressStatus:
        var a = payOut.endDate?.date();
        DateTime now = new DateTime.now();
        DateTime b = new DateTime(now.year, now.month, now.day);
        int? months = a?.difference(b).getMonths();
        int? days = a?.difference(b).getDays();

        return [
          PoppinsRichContent(
            content:
                "The PayOut for this month is ${isNotPaidUser == null ? "complete" : "being collected"} .\nThe PayOut cycle will complete in ",
            fontSize: 12,
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: months == 0 ? "$days" : "$months",
            fontWeight: FontWeight.bold,
            textColor: Colors.black,
            fontSize: 12,
          ),
          PoppinsRichContent(
            content: months != 0
                ? months == 1
                    ? " month"
                    : " months"
                : days == 1
                    ? " day"
                    : " days",
            fontSize: 12,
            textColor: Colors.black,
          )
        ];
    }
  }

  void getProfileUser() async {
    int userID = await SharedPreferencesManager.get.getUserID();
    profileRepository.getProfileUser(userID.toString()).then(
      (response) {
        if (response.status) {
          user = response.data;
          DatabaseManager.get.saveUser(user);
          getUser();
        }
      },
    );
  }

  ///MARK: Navigate functions
  void navToProfileUser({VoidCallback? onBackCallback}) {
    context.router.navigate(ProfileUserScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToUserDetails(String id, {VoidCallback? onBackCallback}) {
    context.router.push(UserScreenRoute(
      onBackCallback: onBackCallback,
      id: id,
    ));
  }
}
