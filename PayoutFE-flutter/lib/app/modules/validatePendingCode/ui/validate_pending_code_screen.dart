import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/register/ui/code/register_verify_code_screen.dart';
import 'package:pay_out/app/modules/validatePendingCode/viewModel/validate_pending_code_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class ValidateCodeUserScreen extends GeneralScreen {
  ValidateCodeViewModel? model;

  ValidateCodeUserScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<ValidateCodeViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => ValidateCodeViewModel(context),
    );
  }

  Widget builderView(BuildContext context, ValidateCodeViewModel? model) {
    this.model = model;
    return super.generalView(context);
  }

  @override
  Widget bodyBackground(BuildContext context) {
    return Expanded(
      child: Column(
        children: [
          super.bodyBackground(context),
        ],
      ),
    );
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32, bottom: 24),
      ),
    );
  }

  @override
  Widget onBodyScrollView(BuildContext context) {
    return Column(
      children: [
        Expanded(
          child: SingleChildScrollView(
            child: RegisterVerifyCodeWidget(
              onCodeChangeValue: (code) {
                model?.code = code;
              },
            ),
          ),
        ),
        footerView(context),
      ],
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    super.onBackPressed(context);
    model?.back();
  }

  Widget footerView(BuildContext context) {
    return Column(
      children: <Widget>[
        SeparateLine(),
        Container(
          alignment: Alignment.topCenter,
          height: 80,
          margin: EdgeInsets.only(bottom: 24, top: 8, left: 16, right: 16),
          child: Row(
            children: <Widget>[
              Expanded(
                child: PoppinsButton(
                  content: 'Send Again',
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                  onTap: () => sentSMSCode(context),
                ),
              ),
              Expanded(
                child: PoppinsButton(
                    content: 'Confirm',
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () => verifySMSCode(context)),
              )
            ],
          ),
        )
      ],
    );
  }

  void sentSMSCode(BuildContext context) async {
    final user = await DatabaseManager.get.getUser();
    model?.sendSMSCode(user?.phone, (response) {
      model?.dialogScreen(
          context,
          'Sent again',
          'a new code was sent to your phone you can send another one in two minutes',
          SVGImage.clockIcon);
    }, (error) {
      model?.showErrorDialog(context, 'Error', error);
    });
  }

  void verifySMSCode(BuildContext context) async {
    final user = await DatabaseManager.get.getUser();
    if (model?.isValidCodeData() ?? false) {
      showLoader();
      model?.verifySMSCode(user?.phone, user!.id!, (response) {
        verifySMSCodeSuccessful(context);
      }, (error) {
        model?.showErrorDialog(context, 'Error', error);
      });
    } else {
      model?.showErrorDialog(context, "Error", "Enter a valid code");
    }
  }

  void verifySMSCodeSuccessful(BuildContext context) {
    model?.dialogScreen(
      context,
      'Verified code',
      'Your code was verified successfully',
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.pop(context);
        onBackCallback?.call();
      },
    );
  }

  @override
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(bottom: 60, right: 20, left: 20);
  }

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(35));
  }
}
