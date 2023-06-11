import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/survey_view_model.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';

// ignore: must_be_immutable
class AuthorizeCreatePayoutScreen extends GeneralStatelessWidget {
  AuthorizeCreatePayoutScreen({required this.payout});

  final PayOutCreate? payout;
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
      alignment: Alignment.center,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        mainAxisAlignment: MainAxisAlignment.center,
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
            content: 'Confirm Monthly Amount',
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
            maxLines: 10,
            fontSize: 12,
            content:
                'This is the amount you will send monthly to other members when it is their PayOut month. When it is your PayOut month, each member will send you this amount.',
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
          padding: EdgeInsets.only(top: 32),
          child: Center(
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Row(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Container(
                          child: PoppinsText(
                            content: "Pay monthly",
                            align: TextAlign.left,
                            fontSize: 12,
                            textColor: Colors.black,
                          ),
                        ),
                        Container(
                          child: PoppinsText(
                            content: " on the ${payout?.initDate?.day}",
                            textColor: PayPOutColors.PrimaryColor,
                            fontSize: 12,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                    Row(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Container(
                          child: PoppinsText(
                            content: "from ",
                            align: TextAlign.left,
                            fontSize: 12,
                            textColor: Colors.black,
                          ),
                        ),
                        Container(
                          child: PoppinsText(
                            content:
                                "${payout?.initDate?.getDateString("MMM dd, yyyy")}",
                            fontSize: 12,
                            fontWeight: FontWeight.bold,
                            textColor: PayPOutColors.PrimaryColor,
                          ),
                        ),
                        Container(
                          child: PoppinsText(
                            content: " to ",
                            align: TextAlign.left,
                            fontSize: 12,
                            textColor: Colors.black,
                          ),
                        ),
                        Container(
                          child: PoppinsText(
                            content:
                                "${payout?.endDate()?.getDateString("MMM dd, yyyy")}",
                            fontSize: 12,
                            fontWeight: FontWeight.bold,
                            textColor: PayPOutColors.PrimaryColor,
                          ),
                        ),
                      ],
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 16),
                      child: PoppinsText(
                        content: "${payout?.pricePerMember?.toCurrency()}",
                        fontSize: 28,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                )
              ],
            ),
          ),
        )
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
