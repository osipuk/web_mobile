// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_masked_text2/flutter_masked_text2.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/survey_view_model.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';
import 'package:intl/intl.dart';

// ignore: must_be_immutable
class BasicInfoCreatePayoutScreen extends GeneralScreen {
  BasicInfoCreatePayoutScreen(
    VoidCallback? onBackCallback, {
    required this.dateOptionChangeValue,
    required this.nameOptionChangeValue,
    required this.priceOptionChangeValue,
    required this.name,
    required this.pricePerMember,
    required this.tempDate,
    required this.date,
  }) : super(onBackCallback);

  final Function(DateTime, DateTime) dateOptionChangeValue;
  final Function(String) nameOptionChangeValue;
  final Function(double) priceOptionChangeValue;

  final String? name;
  final double? pricePerMember;
  DateTime? date;
  DateTime? tempDate;

  PayOutTextFieldEditingController namePayoutController =
      new PayOutTextFieldEditingController();
  MoneyMaskedTextController pricePayoutController =
      new MoneyMaskedTextController(
          leftSymbol: '(\$) ', decimalSeparator: ".", thousandSeparator: ",");
  PayOutTextFieldEditingController datePayoutController =
      new PayOutTextFieldEditingController();

  FocusNode namePayoutFocusNode = FocusNode();
  FocusNode pricePayoutFocusNode = FocusNode();
  FocusNode datePayoutFocusNode = FocusNode();

  SurveyViewModel? model;

  Widget builderView(BuildContext context, SurveyViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<SurveyViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => SurveyViewModel(context),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(context),
        payoutNameTextField(),
        amountPerMemberTextField(context),
        paymentDateTextField(context)
      ],
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
            content: 'Basic info',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          margin: EdgeInsets.only(left: 16, right: 32),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 10,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content:
                'Assign a name to your PayOut, choose the amount, and select the monthly date on which payments will be received.',
          ),
        )
      ],
    );
  }

  Widget payoutNameTextField() {
    namePayoutController.text = name ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 32),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Payout name',
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
                  controller: namePayoutController,
                  onChanged: nameOptionChangeValue,
                  autocorrect: false,
                  enableSuggestions: false,
                  textAlignVertical: TextAlignVertical.center,
                  keyboardType: TextInputType.text,
                  textInputAction: TextInputAction.next,
                  textCapitalization: TextCapitalization.words,
                  onSubmitted: (value) {
                    namePayoutFocusNode.unfocus();
                    pricePayoutFocusNode.requestFocus();
                  },
                  style: TextStyle(
                    fontSize: 15,
                    color: PayPOutColors.PrimaryColor,
                    fontFamily: GeneralConstants.poppinsFont,
                    fontWeight: FontWeight.w600,
                  ),
                  decoration: InputDecoration(
                    hintText: "Payout name",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      fontSize: 15,
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont,
                      fontWeight: FontWeight.w200,
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

  Widget amountPerMemberTextField(BuildContext context) {
    pricePayoutController.updateValue(pricePerMember?.toDouble() ?? 0);
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: '(\$) Amount per member',
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
                  controller: pricePayoutController,
                  autocorrect: false,
                  enableSuggestions: false,
                  onChanged: (value) {
                    priceOptionChangeValue(pricePayoutController.numberValue);
                    // scrollController.animateTo(
                    //   scrollController.position.maxScrollExtent,
                    //   duration: Duration(milliseconds: 500),
                    //   curve: Curves.ease,
                    // );
                  },
                  textAlignVertical: TextAlignVertical.center,
                  keyboardType: TextInputType.number,
                  textInputAction: TextInputAction.next,
                  textCapitalization: TextCapitalization.words,
                  onSubmitted: (value) {
                    pricePayoutFocusNode.unfocus();
                    openYearPicker(context);
                  },
                  style: TextStyle(
                    fontSize: 15,
                    color: pricePayoutController.numberValue == 0
                        ? Colors.black54
                        : PayPOutColors.PrimaryColor,
                    fontFamily: GeneralConstants.poppinsFont,
                    fontWeight: pricePayoutController.numberValue == 0
                        ? FontWeight.w200
                        : FontWeight.w600,
                  ),
                  decoration: InputDecoration(
                    hintText: "(\$) Amount per member",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      fontSize: 15,
                      color: Colors.black54,
                      fontFamily: GeneralConstants.poppinsFont,
                      fontWeight: FontWeight.w200,
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

  Widget paymentDateTextField(BuildContext context) {
    final formatDate =
        DateFormat("MMMM d, yyyy").format(date ?? DateTime.now());
    datePayoutController.text = date == null ? "" : "Starting on $formatDate";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              PoppinsText(
                align: TextAlign.left,
                content: 'Select payment date',
              ),
              GestureDetector(
                onTapUp: (details) {
                  model?.dialogScreen(
                    context,
                    '',
                    'This is the date when the first Payout will take place.',
                    SVGImage.infoIcon,
                  );
                },
                child: Container(
                  padding: EdgeInsets.only(left: 8),
                  child: SvgPicture.asset(SVGImage.infoPurpleIcon),
                ),
              )
            ],
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.lightGrey, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Stack(
            children: <Widget>[
              Container(
                child: Row(
                  children: [
                    Expanded(
                      child: TextField(
                        controller: datePayoutController,
                        autocorrect: false,
                        enableSuggestions: false,
                        textAlignVertical: TextAlignVertical.center,
                        keyboardType: TextInputType.number,
                        textInputAction: TextInputAction.next,
                        textCapitalization: TextCapitalization.words,
                        style: TextStyle(
                          fontSize: 15,
                          color: date == null
                              ? Colors.black54
                              : PayPOutColors.PrimaryColor,
                          fontFamily: GeneralConstants.poppinsFont,
                          fontWeight:
                              date == null ? FontWeight.w200 : FontWeight.w600,
                        ),
                        decoration: InputDecoration(
                          hintText: "Payment date",
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
                    Icon(
                      Icons.calendar_month,
                      color: Colors.black54,
                      size: 25,
                    )
                  ],
                ),
              ),
              Container(
                color: Colors.transparent,
                child: GestureDetector(
                  onTap: () => openYearPicker(context),
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  void openYearPicker(BuildContext context) {
    pricePayoutFocusNode.unfocus();
    namePayoutFocusNode.unfocus();
    datePayoutFocusNode.unfocus();
    hideKeyboard();

    showDialog(context, onChange: (currentDate) {
      tempDate = currentDate;
    }, onAccept: (selectedDate) {
      var date = selectedDate ?? DateTime.now();
      var tempDate = this.tempDate ?? date;

      dateOptionChangeValue(date, tempDate);
      Navigator.pop(context);
    });
  }

  //  Picker dialog
  void showDialog(BuildContext context,
      {required Function(DateTime?) onChange, Function(DateTime?)? onAccept}) {
    showModalBottomSheet<int>(
      context: context,
      builder: (BuildContext context) {
        return StatefulBuilder(
          builder: (context, setState) {
            return SafeArea(
              child: Stack(
                alignment: Alignment.center,
                children: <Widget>[
                  Wrap(
                    alignment: WrapAlignment.center,
                    children: <Widget>[
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Expanded(
                            child: Container(
                              child: Container(
                                margin: EdgeInsets.only(top: 24, left: 50),
                                alignment: Alignment.centerLeft,
                                child: PoppinsText(
                                  content: 'Select date',
                                  fontWeight: FontWeight.bold,
                                  fontSize: 25,
                                ),
                              ),
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.only(top: 24, right: 32),
                            alignment: Alignment.centerLeft,
                            child: PoppinsButton.icon(
                              color: Colors.transparent,
                              image: SVGImage.close,
                              onTap: () {
                                tempDate = null;
                                Navigator.pop(context);
                              },
                            ),
                          ),
                        ],
                      ),
                      Container(
                        height: MediaQuery.of(context).size.width / 2.5,
                        child: CupertinoDatePicker(
                          mode: CupertinoDatePickerMode.date,
                          initialDateTime: date,
                          onDateTimeChanged: (val) {
                            setState(() {
                              date = val;
                              onChange.call(date);
                            });
                          },
                        ),
                      ),
                      Container(
                        margin: EdgeInsets.only(top: 16),
                        alignment: Alignment.center,
                        child: PoppinsText(
                          content:
                              'Selected date is ${DateFormat("MMMM").format(tempDate ?? DateTime.now())} / ${tempDate?.day ?? DateTime.now().day} / ${tempDate?.year ?? DateTime.now().year}',
                          fontSize: 18,
                        ),
                      ),
                      SeparateLine(),
                      Container(
                        margin: EdgeInsets.only(
                          top: 24,
                          bottom: 46,
                          left: 90,
                          right: 90,
                        ),
                        height: 50,
                        child: PoppinsButton(
                          content: "Done",
                          fontWeight: FontWeight.bold,
                          borderColor: PayPOutColors.pink,
                          color: PayPOutColors.pink,
                          fontSize: 18,
                          onTap: () {
                            final today = DateTime(
                              DateTime.now().year,
                              DateTime.now().month,
                              DateTime.now().day,
                            );
                            final _date = date ?? today;
                            final diff = today.difference(_date);

                            if (diff.inDays == 0) {
                              model?.showErrorDialog(
                                context,
                                "Payout date",
                                "Sorry, you can't create a Payout starting today. Please select another date",
                              );
                            } else if (diff.inDays > 0) {
                              model?.dialogScreen(
                                context,
                                'Payout date',
                                'You have selected a start date that is in the past. Keep in mind, this means that you are transitioning an existing group from the real  world in the PayOut.',
                                SVGImage.infoIcon,
                                onAceptClick: () {
                                  Navigator.pop(context);
                                  onAccept?.call(_date);
                                },
                              );
                            } else {
                              onAccept?.call(_date);
                            }
                          },
                        ),
                      )
                    ],
                  )
                ],
              ),
            );
          },
        );
      },
    );
  }

  void validateSelectedDate(BuildContext context, DateTime val,
      {required Function(DateTime?) onChange}) {
    final now = DateTime.now();
    if (val.day != now.day && val.month != now.month) {
      date = val;
      onChange.call(date);
    } else {
      model?.showErrorDialog(
        context,
        "",
        "Sorry, you can't create a Payout starting today. Please select another date",
      );
    }
  }
}
