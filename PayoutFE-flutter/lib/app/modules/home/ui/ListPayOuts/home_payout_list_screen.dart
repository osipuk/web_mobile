// ignore_for_file: import_of_legacy_library_into_null_safe

import 'dart:async';

import 'package:dots_indicator/dots_indicator.dart';
import 'package:flutter/material.dart';
import 'package:flutter_stack_card/flutter_stack_card.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/home/viewModel/home_view_model.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_stack_cards.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class HomePayOutListScreen extends GeneralStatelessWidget {
  HomePayOutListScreen({
    required this.payOuts,
    required this.onPayOutSelected,
    required this.onPaymentComplete,
    required this.reset,
  });
  //
  final Function(PayOut) onPayOutSelected;
  final List<PayOut> payOuts;
  final Function onPaymentComplete;
  bool reset;

  HomeViewModel? model;
  var stackCards = StackSingleCard.builder();

  Widget builderView(BuildContext context, HomeViewModel model) {
    if (reset) {
      Timer(Duration(milliseconds: 300), () {
        reset = false;
        stackCards.initPage(false);
      });
    }

    this.model = model;
    return Stack(
      alignment: Alignment.topCenter,
      children: [
        dotsIndicator(),
        Container(
          padding: EdgeInsets.only(top: 12),
          child: bodyView(context),
        )
      ],
    );
  }

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<HomeViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => HomeViewModel(context),
      onModelReady: (_) {
        DatabaseManager.get.getUser().then((value) {
          model?.user = value;
          model?.notifyListeners();
        });
      },
    );
  }

  Widget dotsIndicator() {
    double position = (model?.cardIndexSelected ?? 0) >= payOuts.length
        ? 0
        : payOuts.length > 0
            ? (model?.cardIndexSelected.toDouble() ?? 0)
            : 0;
    return SingleChildScrollView(
      scrollDirection: Axis.horizontal,
      child: Container(
        margin: EdgeInsets.symmetric(horizontal: 16),
        height: 18,
        alignment: Alignment.center,
        child: DotsIndicator(
          dotsCount: payOuts.length,
          position: position,
          decorator: DotsDecorator(
            color: PayPOutColors.lightGrey,
            activeColor: PayPOutColors.pink,
          ),
        ),
      ),
    );
  }

  Widget bodyView(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    final width = MediaQuery.of(context).size.width;

    stackCards = StackSingleCard.builder(
      isSwipeActive: true,
      itemCount: payOuts.length,
      stackOffset: Offset(70, 200),
      scrollPhysics: BouncingScrollPhysics(),
      onSwap: (index) {
        model?.cardIndexSelected = index;
        model?.isSwipeActive = true;
        model?.notify();
      },
      dimension: StackDimension(
        height: height - ((width + height) * 0.14),
        width: width,
      ),
      itemBuilder: (context, index) {
        return bodyCard(context, index);
      },
    );
    PayOut payOut = payOuts[model?.cardIndexSelected ?? 0];

    return Container(
      child: Stack(
        children: [
          stackCards,
          Container(
            child: Stack(
              children: [
                Container(
                  child: Visibility(
                    visible: payOuts.length == 1
                        ? true
                        : model?.isSwipeActive ?? false,
                    child: GestureDetector(
                      onTap: () {
                        int poolID =
                            (payOuts[model?.cardIndexSelected ?? 0].poolID);
                        showLoader();

                        model?.getPayoutDetail(poolID.toString(), (payOut) {
                          hideLoader();
                          onPayOutSelected(payOut);
                        }, (error) {});
                      },
                      onPanStart: (_) {
                        model?.isSwipeActive = false;
                        model?.notify();
                      },
                    ),
                  ),
                ),
                Visibility(
                  visible: payOut.userToPay != null &&
                      (model?.isUserHavePay(payOut) ?? false),
                  child: Center(
                    child: Container(
                      margin: EdgeInsets.only(bottom: 20, left: 120),
                      height: 50,
                      width: 180,
                      color: Colors.transparent,
                      child: GestureDetector(
                        onTap: () {
                          if (payOut.poolStatus == PayOut.progressStatus) {
                            final member = model?.getNextMemberToPay(payOut);
                            selectPaymentType(context, payOut, member);
                          }
                        },
                      ),
                    ),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget bodyCard(BuildContext context, int index) {
    return Container(
      margin: EdgeInsets.only(top: 24),
      child: contentCard(context, index),
      alignment: Alignment.center,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(40.0),
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.1),
            spreadRadius: 3,
            blurRadius: 60,
            offset: Offset(0, -5),
          ),
        ],
      ),
    );
  }

  Widget contentCard(BuildContext context, int index) {
    final payOut = payOuts[index];
    return Container(
      child: Column(
        children: [
          dataPayoutWidget(context, index, payOut),
          membersWidget(context, index, payOut),
          perMonthValueWidget(context, index, payOut)
        ],
      ),
    );
  }

  Widget dataPayoutWidget(BuildContext context, int index, PayOut payOut) {
    return Expanded(
      child: Container(
        width: double.infinity,
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.only(
            topLeft: Radius.circular(30.0),
            topRight: Radius.circular(30.0),
          ),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withAlpha(90).withOpacity(0.1),
              spreadRadius: 0,
              blurRadius: 20,
              offset: Offset(0, 30), // changes position of shadow
            ),
          ],
        ),
        child: Container(
          child: Wrap(
            crossAxisAlignment: WrapCrossAlignment.center,
            alignment: WrapAlignment.spaceAround,
            runAlignment: WrapAlignment.spaceAround,
            children: [
              Visibility(
                visible: index - (model?.cardIndexSelected ?? 0) <= 1,
                child: Container(
                  margin: EdgeInsets.only(
                    left: 16,
                    right: 16,
                    top: MediaQuery.of(context).size.height / 20,
                  ),
                  child: PoppinsText(
                    content: payOut.poolName,
                    textColor: PayPOutColors.PrimaryColor,
                    fontWeight: FontWeight.w500,
                    align: TextAlign.center,
                    maxLines: 2,
                    fontSize: 14,
                  ),
                ),
              ),
              Visibility(
                visible: index - (model?.cardIndexSelected ?? 0) <= 1,
                child: Container(
                  width: double.infinity,
                  margin: EdgeInsets.only(top: 4),
                  child: PoppinsText(
                    content: model?.statusTitleLabel(payOut),
                    textColor: Colors.black,
                    align: TextAlign.center,
                    maxLines: 2,
                    fontSize: 12,
                  ),
                ),
              ),
              Visibility(
                visible: index - (model?.cardIndexSelected ?? 0) <= 1,
                child: Container(
                  width: double.infinity,
                  margin: EdgeInsets.only(top: 8),
                  child: PoppinsText(
                    content: model?.statusLabel(payOut),
                    textColor: model?.statusColor(payOut),
                    align: TextAlign.center,
                    fontWeight: FontWeight.w900,
                    maxLines: 2,
                    fontSize: 40,
                  ),
                ),
              ),
              Visibility(
                visible: payOut.userToPay != null &&
                    index - (model?.cardIndexSelected ?? 0) <= 1,
                child: Container(
                  child: PoppinsText(
                    content: model?.dateAndCreateLabel(payOut),
                    textColor: Colors.black,
                    align: TextAlign.center,
                    maxLines: 2,
                    fontSize: 12,
                  ),
                ),
              ),
              Container(
                width: MediaQuery.of(context).size.width,
                alignment: Alignment.center,
                child: Visibility(
                  visible: payOut.userToPay != null &&
                      index == (model?.cardIndexSelected ?? 0),
                  child: Container(
                    margin:
                        EdgeInsets.only(top: 16, bottom: 8, right: 8, left: 8),
                    child: SingleChildScrollView(
                      scrollDirection: Axis.horizontal,
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Container(
                            height: 30,
                            margin: EdgeInsets.only(right: 8),
                            color: Colors.transparent,
                            child: ProfileImage(
                              size: 30,
                              pathProfile: model
                                  ?.getUserCreated(payOut)
                                  ?.getProfileImage(),
                              secondPathProfile: model
                                  ?.getUserCreated(payOut)
                                  ?.getSecondProfileImage(payOut.members),
                            ),
                          ),
                          Container(
                            constraints:
                                BoxConstraints(minWidth: 50, maxWidth: 140),
                            margin: EdgeInsets.only(right: 8),
                            // height: 30,
                            child: PoppinsText(
                              content: model?.getNameUserCreated(payOut),
                              textColor: PayPOutColors.PrimaryColor,
                              align: TextAlign.center,
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                              maxLines: 1,
                            ),
                          ),
                          Visibility(
                            visible: model?.isUserHavePay(payOut) ?? false,
                            child: Container(
                              height: 40,
                              margin: EdgeInsets.only(bottom: 8),
                              alignment: Alignment.centerRight,
                              child: AspectRatio(
                                aspectRatio: 4 / 1,
                                child: PoppinsButton.icon(
                                  content: "Make a payment",
                                  textColor: PayPOutColors.PrimaryColor,
                                  width: 16,
                                  fontSize: 13,
                                  imageView: ClipOval(
                                    child: Container(
                                      color: PayPOutColors.rose,
                                      height: 8,
                                    ),
                                  ),
                                  borderColor: PayPOutColors.PrimaryColor,
                                  fontWeight: FontWeight.bold,
                                  shadowColor: Colors.white,
                                  margin: 0,
                                  onTap: () {},
                                ),
                              ),
                            ),
                          )
                        ],
                      ),
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget membersWidget(BuildContext context, int index, PayOut payOut) {
    return Container(
      color: (model?.cardIndexSelected ?? 0) == index
          ? Colors.transparent
          : Colors.white,
      width: double.maxFinite,
      height: (model?.cardIndexSelected ?? 0) == index
          ? MediaQuery.of(context).size.height / 7
          : 0,
      alignment: Alignment.center,
      padding: EdgeInsets.only(left: 8, right: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          PoppinsRichText(
            contents: model?.isAllPaidInMonth(payOut),
            align: TextAlign.center,
          ),
          PoppinsText(
            content: payOut.poolStatus == PayOut.pengingStatus
                ? "joined the payout"
                : "",
            textColor: Colors.black,
            align: TextAlign.center,
            maxLines: 2,
            fontSize: 12,
          ),
          Container(
            margin: EdgeInsets.only(top: 16, left: 20, right: 20),
            child: Row(
              children: [
                PoppinsText(
                  content: model?.membersTitle(payOut),
                  textColor: Colors.black,
                  fontWeight: FontWeight.bold,
                  maxLines: 2,
                  fontSize: 12,
                ),
                memberListWidget(context, payOut),
                mermberListTitle(payOut)
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget mermberListTitle(PayOut payOut) {
    return PoppinsText(
      content: model?.membersCounterTitle(payOut),
      textColor: PayPOutColors.PrimaryColor,
      fontWeight: FontWeight.bold,
      fontSize: 12,
    );
  }

  Widget memberListWidget(BuildContext context, PayOut payOut) {
    var memberCount = model!.mermbersList(payOut).length <= 4
        ? model?.mermbersList(payOut).length
        : 4;

    if (memberCount == 0) {
      return Container();
    }

    return Container(
      child: Expanded(
        child: Container(
          color: Colors.white,
          height: 20,
          margin: EdgeInsets.only(right: 30),
          child: GridView.count(
            cacheExtent: 1,
            reverse: true,
            crossAxisCount: 1,
            childAspectRatio: 1 / 1,
            scrollDirection: Axis.horizontal,
            padding: EdgeInsets.zero,
            mainAxisSpacing: 5,
            children: List<Widget>.generate(
              memberCount ?? 0,
              (index) {
                return memberCard(
                  context,
                  model?.mermbersList(payOut)[index],
                  payOut,
                );
              },
            ),
          ),
        ),
      ),
    );
  }

  Widget memberCard(BuildContext context, PayoutMember? member, PayOut payOut) {
    return Container(
      child: ProfileImage(
        size: 25,
        pathProfile: member?.getProfileImage(),
        secondPathProfile: member?.getSecondProfileImage(payOut.members),
        onProfileTap: () {
          model?.navToUserDetails(member?.userID.toString() ?? '');
        },
      ),
    );
  }

  Widget perMonthValueWidget(BuildContext context, int index, PayOut payOut) {
    Widget peroMonthValueW = Container(
      width: MediaQuery.of(context).size.width,
      decoration: BoxDecoration(
        color: (model?.cardIndexSelected ?? 0) == index
            ? PayPOutColors.mediumPink
            : PayPOutColors.mediumPink.withOpacity(0.1),
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(30.0),
          bottomRight: Radius.circular(30.0),
        ),
        boxShadow: [
          BoxShadow(
            color: PayPOutColors.PrimaryColor.withOpacity(0.2),
            spreadRadius: 2,
            blurRadius: 5,
            offset: Offset(0, 5), // changes position of shadow
          ),
        ],
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Visibility(
            visible: (model?.cardIndexSelected ?? 0) == index,
            child: PoppinsText(
              content: payOut.totalToUserPayment(),
              textColor: (model?.cardIndexSelected ?? 0) == index
                  ? payOut.poolStatus == PayOut.pengingStatus
                      ? PayPOutColors.PrimaryColor.withOpacity(0.4)
                      : PayPOutColors.PrimaryColor
                  : Colors.transparent,
              fontSize: 30,
              fontWeight: FontWeight.bold,
            ),
          ),
          Visibility(
            visible: (model?.cardIndexSelected ?? 0) == index,
            child: PoppinsText(
              content: "Per Month",
              textColor: (model?.cardIndexSelected ?? 0) == index
                  ? PayPOutColors.PrimaryColor
                  : Colors.transparent,
              fontSize: 12,
            ),
          ),
        ],
      ),
    );

    if (index - (model?.cardIndexSelected ?? 0) >= 2) {
      return Expanded(
        child: peroMonthValueW,
      );
    }

    return AspectRatio(
      aspectRatio: 4 / 1,
      child: peroMonthValueW,
    );
  }

// VENMO FUNCTIONS

  void selectPaymentType(
      BuildContext context, PayOut payOut, PayoutMember? member) {
    model?.navToPaymentType(payOut, member, () {
      onPaymentComplete.call();
    });
  }
}
