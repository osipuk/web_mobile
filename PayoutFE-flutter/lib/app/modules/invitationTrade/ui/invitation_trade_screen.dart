// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_masked_text2/flutter_masked_text2.dart';
import 'package:flutter_svg/svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationTrade/viewModel/invitation_trade_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:collection/collection.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';

// ignore: must_be_immutable
class InviteTradeScreen extends GeneralScreen {
  InviteRequestTradeViewModel? model;

  InviteTradeScreen(
    VoidCallback? onBackCallback, {
    @queryParam required this.payOut,
    @queryParam required this.notID,
    @queryParam required this.requestedUserID,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;
  int? notID;
  int? requestedUserID;
  Size? columnSize;
  int? userID;

  MoneyMaskedTextController pricePayoutController =
      new MoneyMaskedTextController(
          leftSymbol: '(\$) ', decimalSeparator: ".", thousandSeparator: ",");

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<InviteRequestTradeViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => InviteRequestTradeViewModel(context),
      onModelReady: (model) {
        SharedPreferencesManager.get.getUserID().then((value) {
          userID = value;
          model.notify();
        });
      },
    );
  }

  Widget builderView(BuildContext context, InviteRequestTradeViewModel model) {
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
        descriptionInvite(),
        friendsListWidget(),
        changeOrderDetailView(context),
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
              content: "Trade",
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
              content: "Requested",
              fontWeight: FontWeight.bold,
              maxLines: 3,
              fontSize: 28,
            ),
          ),
        ],
      ),
    );
  }

  Widget friendsListWidget() {
    final filtersUsers = payOut?.members
        ?.where((e) =>
            e.isShared == 0 ||
            e.isShared == null ||
            (e.isShared == 1 && e.isSlave == 0))
        .toList();

    var items = filtersUsers?.length ?? 0;

    return Container(
      color: Colors.white,
      height: 90,
      child: GridView.builder(
        gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
          crossAxisCount: 1,
          childAspectRatio: 1 / 1,
          mainAxisSpacing: items > 0 ? 10 : 0,
        ),
        itemCount: items,
        itemBuilder: (context, index) {
          final user = filtersUsers?[index];
          final isMe = user?.userID == userID;
          return membersCard(user, isMe);
        },
        scrollDirection: Axis.horizontal,
        padding: items > 0 ? EdgeInsets.all(24) : EdgeInsets.zero,
      ),
    );
  }

  Widget membersCard(PayoutMember? user, bool selected) {
    return Container(
      color: Colors.white,
      child: Stack(
        alignment: Alignment.center,
        children: [
          Visibility(
            visible: selected,
            child: ClipOval(
              child: Container(
                height: 50,
                decoration: BoxDecoration(
                  border: Border.all(
                    color: PayPOutColors.PrimaryColor,
                    width: 1,
                  ),
                  borderRadius: BorderRadius.circular(40),
                ),
              ),
            ),
          ),
          Container(
            padding: EdgeInsets.all(4),
            child: ProfileImage(
              pathProfile: user?.getProfileImage(),
              secondPathProfile: user?.getSecondProfileImage(payOut?.members),
              size: 40,
            ),
          ),
        ],
      ),
    );
  }

  Widget descriptionInvite() {
    final requesterUser =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
    final requestDate = payOut?.nextPaymentDateWithMember(requesterUser);

    final _user = payOut?.members?.firstWhereOrNull((e) => e.userID == userID);
    final userDate = payOut?.nextPaymentDateWithMember(_user);

    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 24, right: 32, top: 8),
      child: PoppinsRichText(
        contents: [
          PoppinsRichContent(
            content: 'The ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: "${requesterUser?.allName()} ",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
          PoppinsRichContent(
            content: 'asked for an order trade to receive the Payout on ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: "${userDate?.getDateString("MMM dd, yyyy")}. ",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
          PoppinsRichContent(
            content: 'If you accept, you will receive your Payout on ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: "${requestDate?.getDateString("MMM dd, yyyy")}.",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
        ],
        maxLines: 5,
      ),
    );
  }

  Widget changeOrderDetailView(BuildContext context) {
    final requesterUser =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
    final _user = payOut?.members?.firstWhereOrNull((e) => e.userID == userID);

    return Container(
      color: Colors.white,
      height: 192,
      padding: EdgeInsets.only(left: 24, right: 24, top: 16, bottom: 32),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          inviteCard(requesterUser, "(Requester)", context),
          Container(
            margin: EdgeInsets.symmetric(vertical: 16),
            child: SvgPicture.asset(SVGImage.tradeActionIcon),
          ),
          inviteCard(_user, "(Requested)", context),
        ],
      ),
    );
  }

  // Card de usuarios invitados al payOut
  Widget inviteCard(
      PayoutMember? user, String complement, BuildContext context) {
    return GestureDetector(
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          PoppinsText(
            textColor: PayPOutColors.PrimaryAssentColor,
            content: "${user?.payoutOrder}.",
            fontWeight: FontWeight.w600,
            fontSize: 14,
          ),
          Expanded(
            child: Container(
              height: 45,
              margin: EdgeInsets.only(left: 12),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.all(Radius.circular(27.0)),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.2),
                    spreadRadius: 0,
                    blurRadius: 10,
                    offset: Offset(0, 5),
                  ),
                ],
              ),
              child: Stack(
                alignment: Alignment.bottomLeft,
                children: [
                  Container(
                    height: 45,
                    child: ListView(
                      scrollDirection: Axis.horizontal,
                      children: [
                        Container(
                          height: 30,
                          width: 30,
                          alignment: Alignment.center,
                          child: ProfileImage(
                            pathProfile: user?.getProfileImage(),
                            secondPathProfile:
                                user?.getSecondProfileImage(payOut?.members),
                            size: 30,
                          ),
                          margin: EdgeInsets.only(right: 8, left: 16),
                        ),
                        Container(
                          height: 30,
                          alignment: Alignment.center,
                          child: PoppinsText(
                            content:
                                "${user?.getFirstName(payOut?.members)} $complement",
                            fontWeight: FontWeight.w600,
                            fontSize: 13,
                          ),
                        ),
                      ],
                    ),
                  )
                ],
              ),
            ),
          ),
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
            onTap: () {
              model?.navToPayOutHome();
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
              model?.back();
            },
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
    final requesterUser =
        payOut?.members?.firstWhereOrNull((e) => e.userID == requestedUserID);
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
                    content: 'Deny trade',
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: Colors.white,
                    borderColor: PayPOutColors.pink,
                    onTap: () {
                      model?.declineInvitationTrade(
                        notID,
                        payOut,
                        requesterUser,
                        () {
                          showTradeDeclineDialog(context);
                        },
                      );
                    },
                  ),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: 'Accept trade',
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
    showOptionsDialog(
      context,
      "Confirm trade",
      "Just to be clear. You are accepting this trade request, correct?",
      SVGImage.deleteSignalIcon,
      aceptTitleBtn: "Confirm",
      cancelTitleBtn: "Cancel",
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        showLoader();
        model?.acceptedInvitationTrade(
          notID,
          payOut,
          requesterUser,
          () {
            showTradeSuccessDialog(context, requesterUser);
          },
        );
      },
      onCancelClick: () {
        Navigator.of(context, rootNavigator: true).pop();
      },
    );
  }

  void showTradeSuccessDialog(BuildContext context, PayoutMember? user) {
    final place = user?.payoutOrder?.ordinal();
    hideLoader();
    model?.dialogScreen(
      context,
      'Trade accepted',
      'You are now in $place place to receive the Payout.',
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.back();
      },
    );
  }

  void showTradeDeclineDialog(BuildContext context) {
    final _user = payOut?.members?.firstWhereOrNull((e) => e.userID == userID);
    final place = _user?.payoutOrder?.ordinal();

    hideLoader();
    model?.dialogScreen(
      context,
      'Trade Denied',
      'You keep your $place place to receive the Payout.',
      SVGImage.failedIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.back();
      },
    );
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
