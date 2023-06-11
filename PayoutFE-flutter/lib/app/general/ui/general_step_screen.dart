import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:stacked/stacked.dart';
import 'general_screen.dart';

// ignore: must_be_immutable
class GeneralStepScreen extends GeneralScreen {
  GeneralStepScreen(VoidCallback? onBackCallback) : super(onBackCallback);

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PayOutViewModel>.reactive(
      builder: (context, model, child) => generalView(context),
      viewModelBuilder: () => PayOutViewModel(context),
    );
  }

  @override
  Widget onBodyScrollView(BuildContext context) {
    return Column(
      children: <Widget>[
        headerView(),
        Expanded(child: bodyView()),
        footerView(context)
      ],
    );
  }

  Widget headerView() {
    return Container(
      alignment: Alignment.centerLeft,
      padding: EdgeInsets.only(top: 32, left: 12),
      child: PoppinsText(
        content: title(),
        fontSize: 30,
        fontWeight: FontWeight.bold,
      ),
    );
  }

  Widget bodyView() {
    return Container();
  }

  Widget footerView(BuildContext context) {
    return Column(
      children: <Widget>[
        SeparateLine(),
        Container(
            height: 80,
            child: Row(
              children: <Widget>[
                Container(
                    width: 50,
                    margin: EdgeInsets.only(left: 16, right: 12),
                    child: SvgPicture.asset(SVGImage.backRound)),
                Expanded(
                  child: PoppinsButton(
                    content: buttonTitle(),
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () => onButtonTapped(context),
                  ),
                )
              ],
            ))
      ],
    );
  }

  String title() {
    return '';
  }

  String buttonTitle() {
    return '';
  }

  void onButtonTapped(BuildContext context) {}

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(30));
  }

  @override
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(right: 20, left: 20, bottom: 16);
  }
}
