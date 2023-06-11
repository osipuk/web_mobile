import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/requestTrade/model/prepare_trade_model.dart';
import 'package:pay_out/app/modules/requestTrade/viewModel/request_trade_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';
import 'package:collection/collection.dart';

// ignore: must_be_immutable
class RequestAtradeScreen extends GeneralScreen {
  RequestAtradeScreen(
    VoidCallback? onBackCallback, {
    @queryParam required this.payOut,
  }) : super(onBackCallback);

  final PayOut? payOut;
  RequestTradeViewModel? model;
  Size? columnSize;

  int? selectedUserIndex;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<RequestTradeViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RequestTradeViewModel(context),
      onModelReady: (model) {
        showLoader();
        model.prepareATrade(payOut!.poolID.toString(), () {
          model.notify();
          hideLoader();
        });
      },
    );
  }

  Widget builderView(BuildContext context, RequestTradeViewModel model) {
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
        title(),
        subTitle(),
        invitatorsListWidget(context),
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

  Widget title() {
    return Container(
      color: Colors.white,
      child: Container(
        padding: EdgeInsets.only(left: 25, right: 25, bottom: 27),
        alignment: Alignment.topLeft,
        child: PoppinsText(
          content: 'Request a Trade',
          fontWeight: FontWeight.bold,
          fontSize: 28,
          align: TextAlign.start,
          maxLines: 5,
        ),
      ),
    );
  }

  Widget subTitle() {
    final items = model?.prepare?.userList.length ?? 0;

    return Container(
      height: 60,
      color: Colors.white,
      padding: EdgeInsets.only(left: 25, right: 25),
      child: PoppinsText(
        content: "Please select who you want to re quest a trade with:",
        fontSize: 14,
        textColor: items > 0 ? PayPOutColors.lightGrey : Colors.white,
      ),
    );
  }

  Widget invitatorsListWidget(BuildContext context) {
    final items = model?.prepare?.userList.length ?? 0;

    final topPadding = 24.0;
    final cellHeigth = 55.0;
    final barsHeigth = 80.0;

    final listDefaultHeigth = MediaQuery.of(context).size.height / 2.5;
    final newHeigth = barsHeigth + ((cellHeigth + 46) * items);

    if (model?.prepare == null) {
      return Container(
        color: Colors.white,
        padding: EdgeInsets.symmetric(horizontal: 16),
        height: listDefaultHeigth,
        child: Center(
          child: CircularProgressIndicator(
            backgroundColor: PayPOutColors.PrimaryColor.withOpacity(0.5),
            strokeWidth: 2,
            valueColor: AlwaysStoppedAnimation<Color>(
              Colors.white,
            ),
          ),
        ),
      );
    }

    if (items == 0) {
      return Container(
        color: Colors.white,
        padding: EdgeInsets.symmetric(horizontal: 16),
        height: listDefaultHeigth,
        child: Center(
          child: PoppinsText(
            align: TextAlign.center,
            textColor: PayPOutColors.lightGrey,
            content: "There's no available users to request a trade offer.",
            fontWeight: FontWeight.w600,
            fontSize: 14,
          ),
        ),
      );
    }

    return AnimatedSize(
      duration: Duration(seconds: 1),
      child: Container(
        color: Colors.white,
        padding: EdgeInsets.only(left: 24, right: 24),
        height: newHeigth > listDefaultHeigth ? newHeigth : listDefaultHeigth,
        child: ListView.builder(
          padding: EdgeInsets.only(top: topPadding),
          physics: NeverScrollableScrollPhysics(),
          itemCount: items,
          itemBuilder: (context, index) {
            final member = model?.prepare?.userList[index];
            return Container(
              key: Key(index.toString()),
              child: inviteCard(index, member, cellHeigth, context),
            );
          },
        ),
      ),
    );
  }

  // Card de usuarios invitados al payOut
  Widget inviteCard(int index, PrepareTradeUserData? user, double heigth,
      BuildContext context) {
    final member =
        payOut?.members?.firstWhereOrNull((e) => e.userID == user?.userID);
    return GestureDetector(
      onTap: () {
        selectedUserIndex = index;
        model?.notify();
      },
      child: Container(
        color: Colors.white,
        margin: EdgeInsets.only(bottom: 8, top: 2),
        height: heigth + 46,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                PoppinsText(
                  textColor: PayPOutColors.PrimaryAssentColor,
                  content: "${index + 1}.",
                  fontWeight: FontWeight.w600,
                  fontSize: 14,
                ),
                Expanded(
                  child: Container(
                    height: heigth,
                    margin: EdgeInsets.only(left: 12),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      border: Border.all(
                        color: selectedUserIndex == index
                            ? PayPOutColors.PrimaryColor
                            : Colors.white,
                        width: 1,
                      ),
                      borderRadius: BorderRadius.all(Radius.circular(27.0)),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.2),
                          spreadRadius: 0,
                          blurRadius: 10,
                          offset: Offset(0, 5), // changes position of shadow
                        ),
                      ],
                    ),
                    child: Stack(
                      alignment: Alignment.bottomLeft,
                      children: [
                        Container(
                          height: heigth,
                          child: Row(
                            children: [
                              Container(
                                height: 30,
                                width: 30,
                                alignment: Alignment.center,
                                child: ProfileImage(
                                  pathProfile: member?.getProfileImage(),
                                  secondPathProfile: member
                                      ?.getSecondProfileImage(payOut?.members),
                                  size: 30,
                                ),
                                margin: EdgeInsets.only(right: 8, left: 16),
                              ),
                              Expanded(
                                child: PoppinsText(
                                    content:
                                        member?.getFirstName(payOut?.members),
                                    fontWeight: FontWeight.w600,
                                    fontSize: 12,
                                    textColor: selectedUserIndex == index
                                        ? PayPOutColors.PrimaryColor
                                        : Colors.black),
                              ),
                              Visibility(
                                visible: selectedUserIndex == index,
                                child: Container(
                                  height: 30,
                                  width: 30,
                                  alignment: Alignment.center,
                                  child: SvgPicture.asset(
                                      SVGImage.circlePurpleCheckIcon),
                                  margin: EdgeInsets.only(right: 16, left: 16),
                                ),
                              ),
                            ],
                          ),
                        )
                      ],
                    ),
                  ),
                )
              ],
            ),
            Padding(
              padding: const EdgeInsets.only(
                top: 8,
                left: 32,
                bottom: 4,
              ),
              child: PoppinsText(
                content:
                    "Payout date: ${payOut?.nextPaymentDateWithMember(member).getDateString("MMM d, yyyy")}",
                fontSize: 12,
                align: TextAlign.left,
                textColor: PayPOutColors.PrimaryAssentColor,
              ),
            ),
            Visibility(
              visible: !(index == ((model?.prepare?.userList.length ?? 0) - 1)),
              child: SeparateLine(),
            ),
          ],
        ),
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
            margin: EdgeInsets.only(bottom: 24, top: 8, left: 16, right: 32),
            child: Row(
              children: <Widget>[
                GestureDetector(
                  onTap: () => model?.back(),
                  child: Container(
                      width: 50,
                      margin: EdgeInsets.only(left: 16, right: 12),
                      child: SvgPicture.asset(SVGImage.backRound)),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: "Request Trade",
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    textColor: selectedUserIndex != null
                        ? PayPOutColors.PrimaryColor
                        : PayPOutColors.lightGrey.withOpacity(0.5),
                    color: selectedUserIndex != null
                        ? PayPOutColors.pink
                        : Colors.white,
                    borderColor: selectedUserIndex != null
                        ? PayPOutColors.pink
                        : Colors.white,
                    onTap: () {
                      showConfirmationDialog(context);
                    },
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  void showTradeSuccessDialog(BuildContext context, String? userName) {
    hideLoader();
    model?.dialogScreen(
      context,
      'Trade requested',
      'We will notify you if $userName accepts you trade request',
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.back();
      },
    );
  }

  void showConfirmationDialog(BuildContext context) {
    if (selectedUserIndex != null) {
      final user = model?.prepare?.userList[selectedUserIndex!];

      showOptionsDialog(
        context,
        "Confirm trade",
        "Does ${user?.firstName} know you are about to send this trade request?\n\nFeel free to messsage ${user?.firstName} before you send this request. To help yout case and to be polite, you can inform them so they have and understanding of the circumstances of why you are requesting a trade",
        SVGImage.deleteSignalIcon,
        aceptTitleBtn: "Confirm",
        cancelTitleBtn: "Cancel",
        onAceptClick: () {
          Navigator.of(context, rootNavigator: true).pop();
          showLoader();
          model?.requestATrade(
            model?.prepare,
            user?.userID,
            () {
              showTradeSuccessDialog(context, user?.firstName);
            },
            (error) {
              hideLoader();
              print(error);
            },
          );
        },
        onCancelClick: () {
          Navigator.of(context, rootNavigator: true).pop();
        },
      );
    }
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
            onTap: () {
              model?.navToNotifications();
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
