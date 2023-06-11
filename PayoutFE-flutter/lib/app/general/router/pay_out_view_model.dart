import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:stacked/stacked.dart';

class PayOutViewModel extends BaseViewModel {
  final BuildContext context;

  PayOutViewModel(this.context);

  //MARK: - Dialogs
  void showErrorDialog(BuildContext context, String title, String message,
      {String? icon}) {
    hideLoader();
    context.router.push(ErrorDialogScreenRoute(
      cTitle: title,
      cMessage: message,
      cIcon: icon ?? SVGImage.warningDialogIcon,
    ));
  }

// Es un dialog con navegacion.
  void dialogScreen(
      BuildContext context, String title, String message, String icon,
      {Function? onAceptClick,
      Function? onCancelClick,
      VoidCallback? onBackCallback}) {
    hideLoader();
    context.router.navigate(
      SuccessfulDialogScreenRoute(
        onBackCallback: onBackCallback,
        cTitle: title,
        cMessage: message,
        cIcon: icon,
        onAceptClick: onAceptClick,
        onCancelClick: onCancelClick,
      ),
    );
  }

  void showOptionsDialog(
      BuildContext context, String title, String message, String icon,
      {String aceptTitleBtn = "Ok",
      String cancelTitleBtn = "",
      Function? onAceptClick,
      Function? onCancelClick}) {
    final dialog = GeneralPopUpScreen(() => {});
    dialog.cTitle = title;
    dialog.cMessage = message;
    dialog.cIcon = icon;
    dialog.cButtonTitle = aceptTitleBtn;
    dialog.cnlButtonTitle = cancelTitleBtn;
    dialog.onAceptClick = onAceptClick;
    dialog.onCancelClick = onCancelClick;
    showDialog(
      context: context,
      useSafeArea: false,
      barrierColor: Colors.transparent,
      builder: (_) => dialog,
    );
  }

  //MARK: - Navegacion Principal
  void back({Function? onValue}) {
    context.router.pop().then((value) {
      onValue?.call();
    });
  }

  void dissmis(BuildContext context) {
    Navigator.pop(context);
  }

  void notify() {
    notifyListeners();
  }

  ///MARK: Navigate functions
  void navToPayOutDetail(PayOut payOut, {VoidCallback? onBackCallback}) {
    context.router.push(PayOutDetailScreenRoute(
      onBackCallback: onBackCallback,
      payOut: payOut,
    ));
  }

  void navToCreatePayOut({PayOut? payOutToEdit, VoidCallback? onBackCallback}) {
    context.router.navigate(CreatePayoutMainScreenRoute(
      onBackCallback: onBackCallback,
      payOutToEdit: payOutToEdit,
    ));
  }

  void navToInvitationPayOut(PayOut payOut, {VoidCallback? onBackCallback}) {
    context.router.navigate(InvitePayoutMainScreenRoute(
      onBackCallback: onBackCallback,
      payOut: payOut,
    ));
  }

  void navToLoginHome({VoidCallback? onBackCallback}) {
    hideLoader();
    context.router.navigate(LoginScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToPayOutHome({VoidCallback? onBackCallback, bool deleteAll = true}) {
    hideLoader();
    context.router.navigate(HomeScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToNotifications(
      {VoidCallback? onBackCallback,
      List<NotificationModel>? notificationLoaded}) {
    context.router.push(NotificationScreenRoute(
      onBackCallback: onBackCallback,
      notificationLoaded: notificationLoaded,
    ));
  }

  void navToUserDetails(String id, {VoidCallback? onBackCallback}) {
    if (id != "null") {
      // context.router.navigate(UserScreenRoute(id: id));
    }
  }

  void navToRequestATrade(PayOut? payOut, {VoidCallback? onBackCallback}) {
    context.router.navigate(RequestAtradeScreenRoute(
      onBackCallback: onBackCallback,
      payOut: payOut,
    ));
  }

  void navToResponseRequestATrade(PayOut? payOut,
      {int? notID, int? requestedUserID, VoidCallback? onBackCallback}) {
    context.router.navigate(InviteTradeScreenRoute(
      notID: notID,
      onBackCallback: onBackCallback,
      requestedUserID: requestedUserID,
      payOut: payOut,
    ));
  }

  void navToRequestSplit(PayOut? payOut, {VoidCallback? onBackCallback}) {
    context.router.navigate(RequestSplitScreenRoute(
      onBackCallback: onBackCallback,
      payOut: payOut,
    ));
  }

  void navToInviteSplit(PayOut? payOut,
      {int? notID,
      int? requestedID,
      int? requestedUserID,
      VoidCallback? onBackCallback}) {
    context.router.navigate(InviteSplitScreenRoute(
      notID: notID,
      onBackCallback: onBackCallback,
      requestedUserID: requestedUserID,
      requestedID: requestedID,
      payOut: payOut,
    ));
  }

  void navToInvitationRejected(PayOut? payOut, {VoidCallback? onBackCallback}) {
    context.router.navigate(InviteRejectedPayoutScreenRoute(
      onBackCallback: onBackCallback,
      payOut: payOut,
    ));
  }

  void navToValidateCode({VoidCallback? onBackCallback}) {
    context.router.navigate(
      ValidateCodeUserScreenRoute(onBackCallback: onBackCallback),
    );
  }

  void navToPaymentType(
    PayOut payOut,
    PayoutMember? member,
    Function onPaymentComplete, {
    VoidCallback? onBackCallback,
  }) {
    context.router.push(
      SelectPaymentTypeScreenRoute(
        onBackCallback: onBackCallback,
        payOut: payOut,
        member: member,
        onPaymentComplete: onPaymentComplete,
      ),
    );
  }
}
