import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/survey_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class DisclaimerCreatePayoutScreen extends GeneralStatelessWidget {
  DisclaimerCreatePayoutScreen({required this.validateDisclaimer});

  final bool validateDisclaimer;
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
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Disclaimer',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        disclaimerTextView(context)
      ],
    );
  }

  Widget disclaimerTextView(BuildContext context) {
    return Container(
      height: MediaQuery.of(context).size.height / 2.2,
      width: double.infinity,
      margin: EdgeInsets.only(left: 16, right: 16, top: 20),
      child: ListView(
        children: [
          PoppinsText(
            align: TextAlign.left,
            maxLines: 999,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 14,
            content:
                'The information contained in this document is for general information purposes only. PayOut, LLC (“we”, “us”, or “our”) assumes no responsibilities for errors or omissions in the contents of this document.\n\nAll users need to take into consideration and heavily weigh the repercussions of entering a PayOut group. It is our recommendation that you, as the user, engage in fiduciary or monetary exchanges ONLY with people that you personally know and trust.\n\nPayOut, LLC has enacted many legal precautions to protect itself and its users from anyone who may try to take advantage of our system. Even though we have set up legal precautions, we would like to inform our users that engaging in groups with people you do not know can lead to severe consequences including, but not limited to: (1) loss of monetary funds, (2) loss of privilege to use PayOut, LLC’s services, etc.\n\nPayOut, LLC assumes no liability for any monies lost due to another user’s actions (exiting group, closing bank account, missing payment due dates, etc.). We choose to reserve our right to pursue legal action and that decision solely lies on us. PayOut makes no representations or warranties of any kind, express or implied about the completeness, accuracy, reliability, suitability, or availability with respect to the services provided, products, or related graphics contained on our application for any purpose. Any reliance you place on such material is therefore strictly at your own risk.',
          )
        ],
      ),
    );
  }
}
