import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationTrade/repository/invitation_trade_repository.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';

class InviteRequestTradeViewModel extends PayOutViewModel {
  InviteRequestTradeViewModel(BuildContext context) : super(context);

  final InviteTradeRepository repository = InviteTradeRepository();
  NotificationModel? notificationModel;

  ///MARK Functions
  void acceptedInvitationTrade(int? notID, PayOut? payOut,
      PayoutMember? requestInvUser, Function() onComplete) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository
        .postResponseInvitation(
      userID,
      payOut,
      requestInvUser,
      PayOut.ACCEPTED_INVITATION,
    )
        .then(
      (response) {
        onComplete();
        repository.changeNotificationStatus(notID);
      },
    );
  }

  void declineInvitationTrade(int? notID, PayOut? payOut,
      PayoutMember? requestInvUser, Function() onComplete) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository
        .postResponseInvitation(
      userID,
      payOut,
      requestInvUser,
      PayOut.DECLINE_INVITATION,
    )
        .then(
      (response) {
        onComplete();
        repository.changeNotificationStatus(notID);
      },
    );
  }
}
