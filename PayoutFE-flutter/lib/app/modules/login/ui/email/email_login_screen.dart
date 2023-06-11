import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/email/email_login_screen_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class EmailLoginScreen extends GeneralScreen {
  EmailLoginScreenViewModel? model;

  PayOutTextFieldEditingController emailController =
      PayOutTextFieldEditingController();
  FocusNode emailFocusNode = FocusNode();

  EmailLoginScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  Widget builderView(BuildContext context, EmailLoginScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<EmailLoginScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => EmailLoginScreenViewModel(context),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        emailTextFieldView(),
        nextButtonView(context)
      ],
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 95,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.emailImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Login with email',
            fontWeight: FontWeight.bold,
            fontSize: 30,
          ),
        )
      ],
    );
  }

  Widget emailTextFieldView() {
    emailController.text = model?.emailCurrent ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 16),
          child: PoppinsText(
            align: TextAlign.left,
            textColor: model?.getStatusColor(),
            content: model?.getTitleMessage(),
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(
              color: model?.getStatusColor() ?? PayPOutColors.PrimaryColor,
              width: 1,
            ),
            borderRadius: BorderRadius.all(
              Radius.circular(15.0),
            ),
          ),
          child: TextFormField(
            autofocus: true,
            autocorrect: false,
            enableSuggestions: false,
            controller: emailController,
            textAlignVertical: TextAlignVertical.center,
            onChanged: (value) {
              model?.emailCurrent = value;
              if (!(model?.isValidEmail ?? false)) {
                model?.setValidEmail(true);
              }
            },
            decoration: InputDecoration(
              hintText: "Login with email",
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
    );
  }

  Widget nextButtonView(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(left: 32, right: 32, top: 75),
      child: PoppinsButton(
        content: "Next",
        fontWeight: FontWeight.bold,
        fontSize: 16,
        color: PayPOutColors.pink,
        borderColor: PayPOutColors.pink,
        onTap: () {
          print(emailController.text);
          final valid = emailController.text.isValidEmail();
          if (valid) {
            model?.navToPasswordLogin(context, emailController.text);
          }
          model?.setValidEmail(valid);
        },
      ),
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
