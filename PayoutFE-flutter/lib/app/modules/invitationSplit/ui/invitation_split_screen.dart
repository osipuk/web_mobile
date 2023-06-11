// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationSplit/viewModel/invitation_split_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:collection/collection.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

// ignore: must_be_immutable
class InviteSplitScreen extends GeneralScreen {
  InvitationSplitViewModel? model;

  InviteSplitScreen(
    VoidCallback? onBackCallback, {
    @queryParam required this.payOut,
    @queryParam required this.requestedID,
    @queryParam required this.requestedUserID,
    @queryParam required this.notID,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;
  int? requestedUserID;
  int? requestedID;
  int? notID;

  Size? columnSize;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<InvitationSplitViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => InvitationSplitViewModel(context),
    );
  }

  Widget builderView(BuildContext context, InvitationSplitViewModel model) {
    this.model = model;
    return Stack(
      alignment: Alignment.topCenter,
      children: [
        backgroundImage(context),
        navBar(context),
        tabBarView(),
        bodyCard(context),
      ],
    );
  }

  Widget separatorNavBar() {
    return Container(
      height: 120,
      color: Colors.transparent,
      child: GestureDetector(
        onTap: () => model?.back(),
        child: Container(
          width: 80,
          color: Colors.transparent,
        ),
      ),
    );
  }

  Widget navBar(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [onBackWidget(context)],
        ),
      ),
    );
  }

  Widget onHeaderMainCorner() {
    return Container(
      height: 30,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(30.0),
          topRight: Radius.circular(30.0),
        ),
      ),
    );
  }

  Widget onBackWidget(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back, color: Colors.white),
      onPressed: () => model?.back(),
    );
  }

  Widget bodyCard(BuildContext context) {
    final column = Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        separatorNavBar(),
        onHeaderMainCorner(),
        headerView(context),
        fromUserWidget(),
        descriptionInvite(),
        totalUserPriceDetailView(),
        totalPriceDetailView(),
        footerView(context),
        separatorTabbar(),
      ],
    );

    return SingleChildScrollView(
      child: Container(
        margin: marginBottomBody(),
        child: Stack(
          alignment: Alignment.center,
          children: [
            whiteBackground(context),
            MeasuredSize(
              onChange: (size) {
                if (columnSize == null) {
                  columnSize = size;
                  model?.notify();
                }
              },
              child: column,
            ),
          ],
        ),
      ),
    );
  }

  Widget whiteBackground(BuildContext context) {
    final heigth = columnSize?.height ?? 600;
    return Container(
      height: heigth - 290,
      margin: EdgeInsets.only(bottom: 50),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(30.0),
        ),
      ),
    );
  }

  Widget headerView(BuildContext context) {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 24),
      child: Column(
        children: <Widget>[
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(top: 24),
            child: PoppinsText(
              align: TextAlign.left,
              content: "Request to split",
              fontWeight: FontWeight.bold,
              maxLines: 3,
              fontSize: 28,
            ),
          ),
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(bottom: 16),
            child: PoppinsText(
              align: TextAlign.left,
              content: payOut?.poolName,
              fontWeight: FontWeight.bold,
              maxLines: 3,
              fontSize: 28,
            ),
          ),
        ],
      ),
    );
  }

  Widget fromUserWidget() {
    final member =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 24, right: 24),
      height: 30,
      child: Row(
        children: [
          PoppinsText(
            align: TextAlign.left,
            content: "From:  ",
            textColor: PayPOutColors.PrimaryAssentColor,
          ),
          Container(
            child: ProfileImage(
              pathProfile: member?.getProfileImage(),
              size: 30,
            ),
          ),
          Padding(
            padding: const EdgeInsets.only(left: 8),
            child: PoppinsText(
              align: TextAlign.left,
              content: member?.allName(),
            ),
          ),
        ],
      ),
    );
  }

  Widget descriptionInvite() {
    final member =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);

    final date = payOut?.nextPaymentDateWithMember(member);
    return Container(
      color: Colors.white,
      child: Column(
        children: [
          Padding(
            padding: const EdgeInsets.only(bottom: 32, top: 24),
            child: SeparateLine(),
          ),
          Container(
            padding: EdgeInsets.only(left: 24, right: 32, bottom: 32),
            child: PoppinsRichText(
              contents: [
                PoppinsRichContent(
                  content: "${member?.allName()} ",
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsRichContent(
                  content:
                      'is requesting to split a Payout share with you. Every month, you will split a Payout share with ',
                  textColor: Colors.black,
                ),
                PoppinsRichContent(
                  content: "${member?.allName()}. ",
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsRichContent(
                  content: 'When it ist time to receive your payout on ',
                  textColor: Colors.black,
                ),
                PoppinsRichContent(
                  content: "${date?.getDateString("MMM dd, yyyy")}, ",
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsRichContent(
                  content: 'you will split the whole Payout of ',
                  textColor: Colors.black,
                ),
                PoppinsRichContent(
                  content: payOut?.totalAmount?.toCurrency(),
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsRichContent(
                  content: ' with ',
                  textColor: Colors.black,
                ),
                PoppinsRichContent(
                  content: "${member?.allName()}, ",
                  textColor: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.bold,
                ),
                PoppinsRichContent(
                  content: 'as well.',
                  textColor: Colors.black,
                ),
              ],
              maxLines: 5,
            ),
          ),
        ],
      ),
    );
  }

  Widget totalUserPriceDetailView() {
    final member =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
    return Container(
      color: Colors.white,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          SeparateLine(),
          Container(
            color: Colors.white,
            padding: EdgeInsets.symmetric(vertical: 24),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "Total from ${member?.allName()} each month:",
                        maxLines: 2,
                        align: TextAlign.center,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: ((payOut?.amountPerDeduction ?? 0) / 2.0)
                            .toCurrency(),
                        fontSize: 28,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget totalPriceDetailView() {
    return Container(
      color: Colors.white,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          SeparateLine(),
          Container(
            color: Colors.white,
            padding: EdgeInsets.symmetric(vertical: 24),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "Total from you each month:",
                        maxLines: 2,
                        align: TextAlign.center,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: ((payOut?.amountPerDeduction ?? 0) / 2.0)
                            .toCurrency(),
                        fontSize: 28,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget separatorTabbar() {
    return Container(
      height: 160,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () => model?.navToPayOutHome(),
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () => model?.back(),
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () => model?.navToCreatePayOut(),
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          )
        ],
      ),
    );
  }

  Widget footerView(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(40.0),
          bottomRight: Radius.circular(40.0),
        ),
      ),
      child: Column(
        children: <Widget>[
          SeparateLine(),
          Container(
            alignment: Alignment.topCenter,
            height: 80,
            margin: EdgeInsets.only(bottom: 16, top: 24, left: 16, right: 16),
            child: Row(
              children: <Widget>[
                Expanded(
                  child: PoppinsButton(
                    content: 'Decline',
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: Colors.white,
                    borderColor: PayPOutColors.pink,
                    onTap: () => declineSplit(context),
                  ),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: 'Accept',
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () => showConfirmationDialog(context),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  void showConfirmationDialog(BuildContext context) {
    final requesterUser =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);

    // final user = payOut?.members?.firstWhereOrNull((e) => e.userID == userID);
    final userDate = payOut?.nextPaymentDateWithMember(requesterUser);

    showOptionsDialog(
      context,
      "Are you sure to share\nyour payout?",
      "Just making sure you understand.\n\nYou are agreeing to split a Payout share with ${requesterUser?.allName()}. Each month you will contribute half and ${requesterUser?.allName()} will contribute the other half. On ${userDate?.getDateString("MMM dd, yyyy")}, you will receive ${((payOut?.totalAmount ?? 0) / 2).toCurrency()} and ${requesterUser?.allName()} will receive ${((payOut?.totalAmount ?? 0) / 2).toCurrency()}.",
      SVGImage.deleteSignalIcon,
      aceptTitleBtn: "Confirm",
      cancelTitleBtn: "Cancel",
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        showLoader();
        model?.requestASplit(notID, requestedID, true, () {
          showSplitSuccessDialog(context, requesterUser);
        }, (_) {
          showSplitDeclineDialog(context);
        });
      },
      onCancelClick: () {
        Navigator.of(context, rootNavigator: true).pop();
      },
    );
  }

  void showSplitSuccessDialog(BuildContext context, PayoutMember? user) {
    final requesterUser =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
    hideLoader();
    model?.dialogScreen(
      context,
      'Successfully accepted',
      "${requesterUser?.allName()} has been notified. Feel free to send them a message to remind them about thus in a day or two.",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.navToNotifications();
      },
    );
  }

  void showSplitDeclineDialog(BuildContext context) {
    hideLoader();
    model?.dialogScreen(
      context,
      'Split Denied',
      'You decline to split request in the Payout.',
      SVGImage.failedIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.back();
      },
    );
  }

  void declineSplit(BuildContext context) {
    showLoader();
    model?.requestASplit(notID, requestedID, false, () {
      hideLoader();
      Navigator.of(context).pop();
      model?.back();
    }, (_) {
      showSplitDeclineDialog(context);
    });
  }

  Widget tabBarView() {
    return Container(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(1, onClick: (id) {
            model?.notify();
          })
        ],
      ),
    );
  }
}
