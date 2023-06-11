import 'package:flutter/material.dart';
import 'package:flutter_datetime_picker/flutter_datetime_picker.dart';
import 'package:flutter_svg/svg.dart';
import 'package:numberpicker/numberpicker.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class RegisterConnectInfoWidget extends GeneralStatelessWidget {
  BaseViewModel? model;

  final Function(DateTime) onDobChangeValue;
  final Function(String) onSsnChangeValue;

  RegisterConnectInfoWidget(this.dob, this.ssn,
      {required this.onDobChangeValue, required this.onSsnChangeValue});

  PayOutTextFieldEditingController ssnController =
      PayOutTextFieldEditingController();
  FocusNode ssnFocusNode = FocusNode();

  DateTime dob;
  final String ssn;

  int monthValue = DateTime.now().month;
  int yearValue = DateTime.now().year;
  int dayValue = DateTime.now().day;

  @override
  Widget build(BuildContext context) {
    // WidgetsBinding.instance?.removeObserver(this);
    // WidgetsBinding.instance?.addObserver(this);
    return ViewModelBuilder<BaseViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => BaseViewModel(),
    );
  }

  Widget builderView(BuildContext context, BaseViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  Widget onBodyInitView(BuildContext context) {
    return GestureDetector(
      behavior: HitTestBehavior.opaque,
      onPanStart: (_) {
        unFocus();
      },
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          headerView(),
          dobDateWidget(context),
          ssnTextField(context)
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
          child: SvgPicture.asset(SVGImage.creditCardIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
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

  Widget dobDateWidget(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 32, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Date of birthday',
          ),
        ),
        Container(
            child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            dobDate(context),
          ],
        ))
      ],
    );
  }

  Widget dobDate(BuildContext context) {
    return Expanded(
      child: Container(
          height: 45,
          padding: EdgeInsets.only(left: 24, right: 24),
          alignment: Alignment.center,
          child: GestureDetector(
            onTap: () => openDobPicker(context),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.start,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                Expanded(
                    child: PoppinsText(
                  content: '${dob.day}/${dob.month}/${dob.year}',
                  textColor: Colors.black54,
                )),
                Container(
                    width: 10,
                    height: 10,
                    child: SvgPicture.asset(SVGImage.arrowDown)),
              ],
            ),
          ),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          )),
    );
  }

  void openDobPicker(BuildContext context) {
    unFocus();
    DatePicker.showDatePicker(context,
        showTitleActions: true,
        minTime: DateTime(1950, 1, 1),
        maxTime: DateTime.now(), onConfirm: (date) {
      dob = date;
      model?.notifyListeners();
      onDobChangeValue(date);
    }, currentTime: DateTime.now(), locale: LocaleType.en);
  }

  Widget ssnTextField(BuildContext context) {
    ssnController.text = ssn;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'SSN',
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
                    controller: ssnController,
                    onChanged: onSsnChangeValue,
                    focusNode: ssnFocusNode,
                    onSubmitted: (value) {
                      hideKeyboard();
                    },
                    textAlignVertical: TextAlignVertical.center,
                    decoration: InputDecoration(
                        hintText: 'SSN',
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

  // Fecha de expedicion no usadab por ahora
  Widget expirationDateWidget(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Date of birthday',
          ),
        ),
        Container(
            child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            monthExpiration(context),
            Container(width: 10),
            yearExpiration(context)
          ],
        ))
      ],
    );
  }

  Widget monthExpiration(BuildContext context) {
    return Expanded(
      child: Container(
          height: 45,
          padding: EdgeInsets.only(left: 24, right: 24),
          alignment: Alignment.center,
          child: Row(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Expanded(
                  child: GestureDetector(
                      child: PoppinsText(
                        content: monthValue.toString(),
                        textColor: Colors.black54,
                      ),
                      onTap: () => openMonthPicker(context))),
              Container(
                  width: 10,
                  height: 10,
                  child: SvgPicture.asset(SVGImage.arrowDown)),
            ],
          ),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          )),
    );
  }

  Widget yearExpiration(BuildContext context) {
    return Expanded(
      child: Container(
          height: 45,
          padding: EdgeInsets.only(left: 24, right: 24),
          alignment: Alignment.center,
          child: Row(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Expanded(
                  child: GestureDetector(
                child: PoppinsText(
                  content: yearValue.toString(),
                  textColor: Colors.black54,
                ),
                onTap: () => openYearPicker(context),
              )),
              Container(
                  width: 10,
                  height: 10,
                  child: SvgPicture.asset(SVGImage.arrowDown)),
            ],
          ),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          )),
    );
  }

  void openMonthPicker(BuildContext context) {
    showDialog(context, 1, 12, monthValue, onChange: (newValue) {
      monthValue = newValue.toInt();
      model?.notifyListeners();
    }, onAccept: () {
      Navigator.pop(context);
      openYearPicker(context);
    });
  }

  void openYearPicker(BuildContext context) {
    showDialog(context, DateTime.now().year, DateTime.now().year + 5, yearValue,
        onChange: (newValue) {
      yearValue = newValue.toInt();
      model?.notifyListeners();
    }, onAccept: () {
      ssnFocusNode.requestFocus();
    });
  }

  //  Picker dialog
  void showDialog(BuildContext context, int min, int max, int initValue,
      {required Function(int) onChange, Function? onAccept}) {
    showModalBottomSheet<int>(
        context: context,
        builder: (BuildContext context) {
          return Stack(
            alignment: Alignment.center,
            children: <Widget>[
              Wrap(
                alignment: WrapAlignment.center,
                children: <Widget>[
                  Container(
                    height: 30,
                    padding: EdgeInsets.only(right: 16, top: 8),
                    alignment: Alignment.centerRight,
                    child: GestureDetector(
                      onTap: () {
                        onAccept?.call();
                        Navigator.pop(context);
                      },
                      child: PoppinsText(
                        content: 'Aceptar',
                      ),
                    ),
                  ),
                  NumberPicker(
                    value: initValue,
                    minValue: min,
                    maxValue: max,
                    selectedTextStyle: TextStyle(
                      fontSize: 16,
                    ),
                    textStyle: TextStyle(fontSize: 16),
                    onChanged: onChange,
                  )
                ],
              ),
              Container(
                height: 1,
                width: 30,
                color: PayPOutColors.PrimaryColor,
                margin: EdgeInsets.only(top: 60),
              )
            ],
          );
        });
  }
}
