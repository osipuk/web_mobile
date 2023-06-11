import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/survey_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class AuthorizeInvitePayoutScreen extends GeneralStatelessWidget {
  AuthorizeInvitePayoutScreen({required this.payout});

  final PayOut? payout;
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
      height: MediaQuery.of(context).size.height / 1.8,
      alignment: Alignment.center,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          headerView(context),
          payDetailView(),
          //authorizeDetailView(),
        ],
      ),
    );
  }

  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Confirm',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Monthly Amount',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, right: 32, bottom: 18, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            textColor: PayPOutColors.PrimaryAssentColor,
            maxLines: 6,
            fontSize: 12,
            content:
                'This is the amount you will send monthly to other members when it is their Payout month. When it is yout Payout month, all members will send you this amount each.',
          ),
        )
      ],
    );
  }

  Widget payDetailView() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        SeparateLine(),
        Container(
          padding: EdgeInsets.only(top: 42, bottom: 32),
          child: Center(
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "Pay monthly",
                        align: TextAlign.center,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 12),
                      child: PoppinsText(
                        content:
                            "\$ ${payout?.amountPerDeduction?.toStringAsFixed(2)}",
                        fontSize: 28,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                )
              ],
            ),
          ),
        ),
        SeparateLine(),
      ],
    );
  }

  Widget authorizeDetailView() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        SeparateLine(),
        Container(
          padding: EdgeInsets.only(bottom: 16),
          child: Column(
            children: [
              Row(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    padding: EdgeInsets.only(
                        left: 16, right: 16, top: 32, bottom: 22),
                    child: PoppinsText(
                      content: "Authorize payment through",
                      align: TextAlign.left,
                      fontSize: 12,
                      textColor: Colors.black,
                    ),
                  )
                ],
              ),
              Row(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Expanded(
                    child: Container(
                      margin: EdgeInsets.only(right: 4),
                      child: PoppinsButton(
                        shadowColor: Colors.white,
                        margin: 0,
                        image: SVGImage.faceIdIcon,
                        content: "Face ID",
                        onTap: () {},
                      ),
                    ),
                  ),
                  Expanded(
                    child: Container(
                      margin: EdgeInsets.only(left: 4),
                      child: PoppinsButton(
                        margin: 0,
                        shadowColor: Colors.white,
                        image: SVGImage.touchIdIcon,
                        content: "Touch ID",
                        onTap: () {},
                      ),
                    ),
                  )
                ],
              )
            ],
          ),
        )
      ],
    );
  }
}
