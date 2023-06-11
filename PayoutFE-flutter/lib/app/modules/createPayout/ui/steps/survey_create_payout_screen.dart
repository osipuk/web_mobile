import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/survey_view_model.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class SurveyCreatePayoutScreen extends GeneralStatelessWidget {
  SurveyCreatePayoutScreen(
      {required this.optionSelected,
      required this.otherOption,
      required this.optionChangeValue,
      required this.otherOptionChangeValue});

  final Function(String, int?) optionChangeValue;
  final Function(String?) otherOptionChangeValue;

  int? optionSelected;
  String? otherOption;

  PayOutTextFieldEditingController otherFieldController =
      new PayOutTextFieldEditingController();

  FocusNode otherFieldFocusNode = FocusNode();

  SurveyViewModel? model;

  Widget builderView(BuildContext context, SurveyViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<SurveyViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => SurveyViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return Container(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          headerView(context),
          optionsButtons(context),
          SeparateLine(),
          firstNameTextField(),
        ],
      ),
    );
  }

  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Survey',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, right: 32),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 10,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content:
                'Please complete this survey so we can improve your experience. Which option best describes what this PayOut will help you with?',
          ),
        )
      ],
    );
  }

  Widget optionsButtons(BuildContext context) {
    return Column(
      children: [
        inviteCard(0, context),
        inviteCard(1, context),
        inviteCard(2, context)
      ],
    );
  }

  Widget inviteCard(int index, BuildContext context) {
    return Column(
      children: [
        SeparateLine(),
        Container(
          margin: EdgeInsets.only(top: 12, bottom: 8),
          child: Stack(
            alignment: Alignment.center,
            children: [
              Container(
                child: PoppinsButton(
                  borderColor: optionSelected == index
                      ? PayPOutColors.PrimaryColor
                      : Colors.transparent,
                  height: 64,
                  cornerRadius: 32,
                  shadowColor: PayPOutColors.PrimaryAssentColor,
                  onTap: () {
                    String option = model?.options[index] ?? "";
                    optionChangeValue(option, index);
                  },
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
      onTap: () {
        String option = model?.options[index] ?? "";
        optionChangeValue(option, index);
      },
      child: Row(
        children: [
          Container(
            margin: EdgeInsets.only(left: 24, right: 8),
            child: PoppinsButton.icon(
              borderColor: optionSelected == index
                  ? PayPOutColors.PrimaryColor
                  : PayPOutColors.lightGrey,
              imageView: Icon(Icons.check,
                  size: 20,
                  color: optionSelected == index
                      ? PayPOutColors.PrimaryColor
                      : Colors.white),
              height: 30,
              width: 30,
              cornerRadius: 15,
              onTap: () {
                String option = model?.options[index] ?? "";
                optionChangeValue(option, index);
              },
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
                    textColor: optionSelected == index
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

  Widget firstNameTextField() {
    if (optionSelected == null) {
      otherFieldController.text = otherOption ?? "";
    }

    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Other',
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12, bottom: 16),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.lightGrey, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: TextField(
                  focusNode: otherFieldFocusNode,
                  controller: otherFieldController,
                  autocorrect: false,
                  enableSuggestions: false,
                  textAlignVertical: TextAlignVertical.center,
                  keyboardType: TextInputType.text,
                  textInputAction: TextInputAction.next,
                  textCapitalization: TextCapitalization.words,
                  onSubmitted: (value) {
                    otherOptionChangeValue(value);
                    otherFieldFocusNode.unfocus();
                    hideKeyboard();
                  },
                  onChanged: (value) {
                    otherOptionChangeValue(value);
                  },
                  decoration: InputDecoration(
                    hintText: "Other",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      fontSize: 15,
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont,
                    ),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }
}
