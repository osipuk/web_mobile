import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class HomeEmptyScreen extends GeneralStatelessWidget {
  PayOutViewModel? model;

  Function createPayOutClick;
  Function interastedClick;
  int? status;
  bool withFilter;

  HomeEmptyScreen({
    required this.createPayOutClick,
    required this.interastedClick,
    required this.status,
    this.withFilter = false,
  });

  Widget builderView(BuildContext context, PayOutViewModel model) {
    this.model = model;
    return Stack(
      children: [bodyView(context)],
    );
  }

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<PayOutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => PayOutViewModel(context),
    );
  }

  Widget bodyView(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 20, left: 50, right: 40),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [titleLabel(), createPayOutBtn(), interestWidget()],
      ),
    );
  }

  Widget titleLabel() {
    return PoppinsText(
      content: withFilter
          ? "There's no Payouts here."
          : "Hi,\nCreate your\nfirst PayOut",
      fontWeight: FontWeight.bold,
      textColor: Colors.white,
      maxLines: 4,
      fontSize: 40,
    );
  }

  Widget createPayOutBtn() {
    return Container(
      margin: EdgeInsets.only(top: 62, right: 30, left: 10),
      child: PoppinsButton(
        fontSize: 16,
        color: PayPOutColors.pink,
        content: "Create Payout",
        fontWeight: FontWeight.bold,
        onTap: () => createPayOutClick(),
      ),
    );
  }

  Widget interestWidget() {
    return Visibility(
      visible: false,
      child: Container(
        margin: EdgeInsets.only(top: 68),
        child: Column(
          children: [
            PoppinsText(
              content: "Or check the",
              textColor: PayPOutColors.darkPink,
            ),
            GestureDetector(
              onTap: () => interastedClick(),
              child: PoppinsText(
                content: "Interest Rate Comparison Tool",
                textColor: PayPOutColors.darkPink,
                decoration: TextDecoration.underline,
              ),
            )
          ],
        ),
      ),
    );
  }
}
