import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:collection/collection.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/payoutDetail/repository/payout_detail_repository.dart';

class DetailPayOutViewModel extends PayOutViewModel {
  DetailPayOutViewModel(BuildContext context) : super(context);

  User? user;
  final PayOutDetailRepository repository = PayOutDetailRepository();
  int indexSelected = 2;

  ///MARK Functions
  void deletePayOut(
      String poolID, Function() onComplete, Function() onError) async {
    repository.deletePayOut(poolID).then(
      (response) {
        if (response.status == 'success') {
          onComplete();
        } else {
          onError();
        }
      },
    ).catchError(error);
  }

  PayoutMember? getPhotoUserCreated(PayOut? payOut) {
    switch (payOut?.poolStatus) {
      case PayOut.pengingStatus:
        return getCreatorMemberToPay(payOut);
      case PayOut.progressStatus:
        return getNextMemberToPay(payOut);
      default:
        return null;
    }
  }

  String? getNameUserCreated(PayOut? payOut) {
    switch (payOut?.poolStatus) {
      case PayOut.pengingStatus:
        var user = getCreatorMemberToPay(payOut);

        return this.user?.id == user?.userID
            ? "You,"
            : user?.getFirstName(payOut?.members) ?? "";
      case PayOut.progressStatus:
        var user = getNextMemberToPay(payOut);

        return this.user?.id == user?.userID
            ? "You,"
            : user?.getFirstName(payOut?.members) ?? "";
      default:
        return "";
    }
  }

  String? isPayedIcon(PayOut? payOut, PayoutMember? member) {
    final memberIsPayable = payOut?.members!.firstWhereOrNull(
        (e) => e.userID == member?.userID && e.userID == payOut.userToPay);
    return memberIsPayable == null
        ? SVGImage.circlePinkCheckIcon
        : SVGImage.receiveCheckIcon;
  }

  bool isPayedInThisMonth(PayOut? payOut, PayoutMember? member) {
    final memberIsPayable = payOut?.members!.firstWhereOrNull(
        (e) => e.userID == member?.userID && e.userID == payOut.userToPay);

    if (memberIsPayable == null && member?.isShared == 1) {
      final shareUser = payOut?.members!.firstWhereOrNull((e) =>
          e.userID != member?.userID && e.payoutOrder == member?.payoutOrder);
      return (member?.isPaid == 1) && (shareUser?.isPaid == 1);
    }
    return memberIsPayable == null ? member?.isPaid == 1 : true;
  }

  bool isUserHavePay(PayOut? payOut) {
    var userToPayed =
        payOut?.members?.firstWhereOrNull((e) => e.userID == payOut.userToPay);

    final _user = payOut?.members
        ?.firstWhereOrNull((element) => element.userID == user?.id);

    //validaciones
    final isPayoutMembersNulls = payOut?.members != null;
    final isPayoutStatusProgress = payOut?.poolStatus == PayOut.progressStatus;
    final isUserDiffToMe = userToPayed?.userID != _user?.userID;
    final isMePayed = payOut?.members!
            .firstWhereOrNull((element) => element.userID == user?.id)
            ?.isPaid ==
        0;

    return isPayoutMembersNulls &&
        isPayoutStatusProgress &&
        isUserDiffToMe &&
        isMePayed;
  }

  List<PoppinsRichContent>? isAllPaidInMonth(PayOut? payOut) {
    var isNotPaidUser = payOut?.members?.firstWhereOrNull(
        (e) => e.payoutOrder != payOut.currentMonth() && e.isPaid == 0);

    switch (payOut?.poolStatus) {
      case PayOut.pengingStatus:
      case PayOut.cancelledStatus:
      case PayOut.completedStatus:
        final list = payOut?.members
            ?.where((element) => element.joinStatus == PayoutMember.joined);
        final allJoined = list?.length == payOut?.members?.length;

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
            content: "have joined the payout",
            fontSize: 12,
            textColor: Colors.black,
          )
        ];
      case PayOut.progressStatus:
        var a = payOut?.endDate?.date();
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
      default:
        return [];
    }
  }

  PayoutMember? getCreatorMemberToPay(PayOut? payOut) {
    return payOut?.members
        ?.firstWhereOrNull((element) => element.userID == payOut.userID);
  }

  PayoutMember? getNextMemberToPay(PayOut? payOut) {
    return payOut?.members?.firstWhereOrNull((e) =>
        e.userID == payOut.userToPay &&
        (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0)));
  }

  int? allDurationInMonths(PayOut? payOut) {
    return payOut?.members
            ?.where(
                (e) => (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0)))
            .length ??
        0;
  }
}
