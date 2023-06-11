import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/selectPayment/viewModel/payout_select_payment_type_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class SelectPaymentTypeScreen extends GeneralScreen {
  SelectPaymentTypeViewModel? model;

  SelectPaymentTypeScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam required this.member,
    @queryParam required this.payOut,
    @queryParam required this.onPaymentComplete,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;
  PayoutMember? member;
  Function? onPaymentComplete;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<SelectPaymentTypeViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => SelectPaymentTypeViewModel(context),
    );
  }

  Widget navBar(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32, left: 8),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [
            onBackWidget(context),
          ],
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

  Widget builderView(BuildContext context, SelectPaymentTypeViewModel model) {
    this.model = model;
    return Container(
      child: Stack(
        children: [
          backgroundImage(context),
          SafeArea(
            child: Column(
              children: [
                navBar(context),
                backgroundBody(context),
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget backgroundBody(BuildContext context) {
    return Expanded(
      child: Container(
        margin: EdgeInsets.only(
          left: 16,
          right: 16,
          top: 30,
          bottom: 30,
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.all(
            Radius.circular(30.0),
          ),
        ),
        child: bodyView(context),
      ),
    );
  }

  Widget bodyView(BuildContext context) {
    return Column(
      children: [
        titleName(),
        optionsButtons(context),
        nextButton(context),
      ],
    );
  }

  Widget titleName() {
    return Container(
      padding: EdgeInsets.only(
        left: 25,
        right: 25,
        top: 60,
        bottom: 30,
      ),
      alignment: Alignment.topLeft,
      child: PoppinsText(
        content: "Select\nTransfer Method",
        fontWeight: FontWeight.bold,
        fontSize: 28,
        align: TextAlign.start,
        maxLines: 5,
      ),
    );
  }

  Widget optionsButtons(BuildContext context) {
    return Expanded(
      child: Container(
        margin: EdgeInsets.symmetric(horizontal: 16),
        child: Column(
          children: [
            inviteCard(0, context),
            inviteCard(1, context),
          ],
        ),
      ),
    );
  }

  Widget inviteCard(int index, BuildContext context) {
    return Column(
      children: [
        SeparateLine(),
        Container(
          margin: EdgeInsets.symmetric(vertical: 16),
          child: Stack(
            alignment: Alignment.center,
            children: [
              Container(
                child: PoppinsButton(
                  borderColor: model?.optionSelected == index
                      ? PayPOutColors.PrimaryColor
                      : Colors.transparent,
                  height: 64,
                  cornerRadius: 32,
                  shadowColor: PayPOutColors.PrimaryAssentColor,
                  onTap: () => optionChangeValue(index),
                ),
              ),
              checkButton(index, context),
            ],
          ),
        ),
      ],
    );
  }

  Widget checkButton(int index, BuildContext context) {
    return GestureDetector(
      onTap: () => optionChangeValue(index),
      child: Row(
        children: [
          Container(
            margin: EdgeInsets.only(left: 24, right: 8),
            child: PoppinsButton.icon(
              borderColor: model?.optionSelected == index
                  ? PayPOutColors.PrimaryColor
                  : PayPOutColors.lightGrey,
              imageView: Icon(Icons.check,
                  size: 20,
                  color: model?.optionSelected == index
                      ? PayPOutColors.PrimaryColor
                      : Colors.white),
              height: 30,
              width: 30,
              cornerRadius: 15,
              onTap: () => optionChangeValue(index),
            ),
          ),
          Column(
            mainAxisAlignment: MainAxisAlignment.start,
            children: [
              SizedBox(
                width: MediaQuery.of(context).size.width / 2,
                child: FittedBox(
                  alignment: Alignment.centerLeft,
                  fit: BoxFit.scaleDown,
                  child: PoppinsText(
                    maxLines: 1,
                    align: TextAlign.left,
                    textColor: model?.optionSelected == index
                        ? PayPOutColors.PrimaryColor
                        : PayPOutColors.lightGrey,
                    content: model?.options[index],
                    fontWeight: FontWeight.bold,
                    fontSize: 14,
                  ),
                ),
              )
            ],
          )
        ],
      ),
    );
  }

  Widget nextButton(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(40.0),
        ),
      ),
      child: Column(
        children: <Widget>[
          SeparateLine(),
          Container(
            alignment: Alignment.topCenter,
            height: 80,
            margin: EdgeInsets.only(bottom: 24, top: 8, right: 32),
            child: Row(
              children: <Widget>[
                GestureDetector(
                  onTap: () => model?.back(), // onBackPressed(context),
                  child: Container(
                      width: 50,
                      margin: EdgeInsets.only(left: 16, right: 12),
                      child: SvgPicture.asset(SVGImage.backRound)),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: "Next",
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () => onSelectType(context),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  void optionChangeValue(int index) {
    model?.optionSelected = index;
    model?.notify();
  }

  void onSelectType(BuildContext context) async {
    switch (model?.optionSelected) {
      case 0:
        showLoader();

        model?.markCashPaymentSuccessfull(payOut, (response, amount) {
          model?.dialogScreen(
            context,
            "Successful payment",
            "Payment of $amount has been successfully sent to ${member?.firstName}",
            SVGImage.checkSuccessIcon,
            onAceptClick: () {
              onPaymentComplete?.call();
              Navigator.of(context).pop();
              model?.navToPayOutHome();
            },
          );
        }, (error) {
          _showPaymentErrorl(context, error);
        });

        break;
      case 1:
        model?.navToVenmoLogin(context, payOut, member, () {});
        break;
      default:
    }
  }

  void _showPaymentErrorl(BuildContext context, String? error) {
    model?.showErrorDialog(
      context,
      "Failed payment",
      error ?? "Payment could not be completed, please try again later.",
    );
  }
}
