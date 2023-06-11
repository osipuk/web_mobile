import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/register/viewModel/bank/register_bank_info_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class RegisterBankInfoWidget extends GeneralStatelessWidget {
  RegisterBankInfoViewModel? model;

  final Function(String) onAccountNameChangeValue;
  final Function(String) onRoutingChangeValue;
  final Function(String) onCheckNumberChangeValue;

  RegisterBankInfoWidget(this.accountName, this.routing, this.checkingNumber,
      {required this.onAccountNameChangeValue,
      required this.onCheckNumberChangeValue,
      required this.onRoutingChangeValue});

  PayOutTextFieldEditingController accountNameController =
      PayOutTextFieldEditingController();
  PayOutTextFieldEditingController routingController =
      PayOutTextFieldEditingController();
  PayOutTextFieldEditingController checkNumberController =
      PayOutTextFieldEditingController();

  FocusNode accountNameFocusNode = FocusNode();
  FocusNode routingFocusNode = FocusNode();
  FocusNode checkingNumberFocusNode = FocusNode();

  final String accountName;
  final String routing;
  final String checkingNumber;

  Widget builderView(BuildContext context, RegisterBankInfoViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    // WidgetsBinding.instance.removeObserver(this);
    // WidgetsBinding.instance.addObserver(this);
    return ViewModelBuilder<RegisterBankInfoViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterBankInfoViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return GestureDetector(
      behavior: HitTestBehavior.opaque,
      onPanStart: (_) {
        unFocus();
      },
      onTap: () {
        unFocus();
      },
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          headerView(),
          accountNameTextField(),
          routingTextField(),
          checkNumberTextField()
        ],
      ),
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.bankInfoIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Bank info',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        )
      ],
    );
  }

  Widget accountNameTextField() {
    accountNameController.text = accountName;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Account name',
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: accountNameController,
                    focusNode: accountNameFocusNode,
                    onChanged: onAccountNameChangeValue,
                    onSubmitted: (value) {
                      accountNameFocusNode.unfocus();
                      routingFocusNode.requestFocus();
                    },
                    decoration: InputDecoration(
                        hintText: 'Account name',
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                )
              ],
            )),
      ],
    );
  }

  Widget routingTextField() {
    routingController.text = routing;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Bank routing',
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: routingController,
                    focusNode: routingFocusNode,
                    onChanged: onRoutingChangeValue,
                    keyboardType: TextInputType.phone,
                    onSubmitted: (value) {
                      accountNameFocusNode.unfocus();
                      routingFocusNode.unfocus();
                      checkingNumberFocusNode.requestFocus();
                    },
                    decoration: InputDecoration(
                        hintText: 'Bank routing',
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                )
              ],
            )),
      ],
    );
  }

  Widget checkNumberTextField() {
    checkNumberController.text = checkingNumber;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Checking numbers',
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: checkNumberController,
                    onChanged: onCheckNumberChangeValue,
                    focusNode: checkingNumberFocusNode,
                    keyboardType: TextInputType.phone,
                    onSubmitted: (value) {
                      unFocus();
                    },
                    textAlignVertical: TextAlignVertical.center,
                    decoration: InputDecoration(
                        hintText: 'Checking numbers',
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                )
              ],
            ))
      ],
    );
  }
}
