import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/venmoPayment/viewModel/venmo_form_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:collection/collection.dart';

// ignore: must_be_immutable
class VenmoPaymentFormScreen extends GeneralScreen {
  VenmoFormViewModel? model;

  final PayOut? payOut;
  final Function(String? user, String? note) onButtonTapped;
  final Function onBackTapped;

  PayOutTextFieldEditingController notePayoutController =
      new PayOutTextFieldEditingController();

  VenmoPaymentFormScreen({
    required VoidCallback? onBackCallback,
    required this.payOut,
    required this.onButtonTapped,
    required this.onBackTapped,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<VenmoFormViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => VenmoFormViewModel(context),
      onModelReady: (model) async {
        model.userID = await SharedPreferencesManager.get.getUserID();
        model.notify();
      },
    );
  }

  Widget builderView(BuildContext context, VenmoFormViewModel model) {
    this.model = model;
    return formPaymentData(context);
  }

  Widget formPaymentData(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(right: 16, left: 16, top: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Expanded(
              child: SingleChildScrollView(
            child: Column(
              children: [
                titleName(),
                amountView(),
                userNameText(context),
                noteTextField(context),
              ],
            ),
          )),
          nextButton(context),
        ],
      ),
    );
  }

  Widget titleName() {
    return Container(
      padding: EdgeInsets.only(
        left: 25,
        right: 25,
        top: 60,
        bottom: 20,
      ),
      alignment: Alignment.topLeft,
      child: PoppinsText(
        content: "Send Money\nThru Venmo",
        fontWeight: FontWeight.bold,
        fontSize: 28,
        align: TextAlign.start,
        maxLines: 5,
      ),
    );
  }

  Widget amountView() {
    num amount = payOut?.amountPerDeduction ?? 0;
    final me =
        payOut?.members!.firstWhereOrNull((e) => e.userID == model?.userID);
    if (me?.isShared == 1) {
      amount = amount / 2;
    }

    return Container(
      padding: EdgeInsets.symmetric(vertical: 24),
      color: Colors.white,
      width: double.infinity,
      child: Column(
        children: [
          PoppinsText(
            content: "Amount",
            textColor: PayPOutColors.lightGrey,
            fontWeight: FontWeight.w300,
          ),
          PoppinsText(
            content: amount.toCurrency(),
            textColor: PayPOutColors.PrimaryColor,
            fontSize: 28,
            fontWeight: FontWeight.bold,
          )
        ],
      ),
    );
  }

  Widget userNameText(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Venmo Username',
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12, bottom: 16),
          padding: EdgeInsets.only(left: 24, right: 8),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: PoppinsText(
                  content: "Nombre de usuario venmo", // model?.userName ,
                  fontSize: 15,
                  fontFamily: GeneralConstants.poppinsFont,
                  textColor: Colors.black54,
                  fontWeight: FontWeight.w200,
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget noteTextField(BuildContext context) {
    notePayoutController.text = model?.note ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Note',
          ),
        ),
        Container(
          height: 100,
          alignment: Alignment.topLeft,
          margin: EdgeInsets.only(top: 12, bottom: 16),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.lightGrey, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Container(
            child: ConstrainedBox(
              constraints: BoxConstraints(maxHeight: 300),
              child: TextFormField(
                textAlign: TextAlign.start,
                maxLengthEnforcement: MaxLengthEnforcement.enforced,
                controller: notePayoutController,
                autocorrect: false,
                enableSuggestions: false,
                onChanged: (value) {
                  model?.note = value;
                },
                textAlignVertical: TextAlignVertical.center,
                keyboardType: TextInputType.multiline,
                textInputAction: TextInputAction.done,
                style: TextStyle(
                  fontSize: 15,
                  fontFamily: GeneralConstants.poppinsFont,
                  color: PayPOutColors.PrimaryColor,
                  fontWeight: FontWeight.w600,
                ),
                decoration: InputDecoration(
                  hintText: "Note",
                  border: InputBorder.none,
                  hintStyle: TextStyle(
                    fontSize: 15,
                    color: Colors.black54,
                    fontFamily: GeneralConstants.poppinsFont,
                    fontWeight: FontWeight.w200,
                  ),
                ),
              ),
            ),
          ),
        )
      ],
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
                  onTap: () => onBackPressed(context),
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
                    onTap: () => onButtonTapped(model?.userName, model?.note),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    super.onBackPressed(context);
    onBackTapped.call();
  }
}
