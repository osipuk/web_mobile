import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_card_stack_widget.dart';
import 'package:pay_out/app/modules/register/viewModel/userData/register_email_screen_view_model.dart';
import 'package:percent_indicator/percent_indicator.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class RegisterUserDataScreen extends GeneralScreen {
  RegisterUserDataScreenViewModel? model;
  late RegisterCardWidget cardsWidget;

  RegisterUserDataScreen({
    @queryParam this.onBackCallback,
    @QueryParam('email') this.email = "",
    @QueryParam('user') this.registerUser,
  }) : super(onBackCallback);

  //queryParams
  Register? registerUser = Register();
  String email;
  final VoidCallback? onBackCallback;

  Widget builderView(
      BuildContext context, RegisterUserDataScreenViewModel model) {
    this.model = model;
    this.model?.setRouteData(email, registerUser);
    return WillPopScope(
      onWillPop: () async => false,
      child: generalView(context),
    );
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<RegisterUserDataScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterUserDataScreenViewModel(context),
    );
  }

  @override
  Widget bodyBackground(BuildContext context) {
    cardsWidget = RegisterCardWidget(
        register: model!.registerUser,
        onCompleteRegister: (registerUser) {
          createUserService(context, registerUser);
        },
        stepValues: (currentStep, totalSteps) {
          updateStepView(currentStep, totalSteps);
        });
    return Expanded(child: Container(child: cardsWidget));
  }

  /// MARK: - Se sobre escribe navBar generica
  Widget onNavBarView(BuildContext context) {
    return Container(
      height: 80,
      padding: EdgeInsets.only(left: 16, bottom: 8),
      alignment: Alignment.bottomLeft,
      child: Visibility(
        visible: model?.showBackNav() ?? false,
        child: Row(
          children: <Widget>[
            IconButton(
              icon: Icon(Icons.arrow_back, color: Colors.white),
              onPressed: () => onBackPressed(context),
            ),
            Expanded(
              child: Container(
                margin: EdgeInsets.only(right: 50),
                child: LinearPercentIndicator(
                  lineHeight: 5.0,
                  percent: (model?.currentStep ?? 0) / (model?.totalStep ?? 0),
                  backgroundColor: Colors.grey.withAlpha(70),
                  animateFromLastPercent: true,
                  animationDuration: 600,
                  progressColor: PayPOutColors.pink,
                  leading: PoppinsText(
                    content: '${model?.currentStep} / ${model?.totalStep}',
                    textColor: Colors.white,
                  ),
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  void updateStepView(int currentStep, List<RegisterDataUser> totalSteps) {
    model?.step = totalSteps[currentStep - 1];
    model?.currentStep = currentStep;
    model?.totalStep = totalSteps.length;
    model?.notify();
  }

  /// API Functions
  void createUserService(BuildContext context, Register? registerUser) {
    model?.setRegisterUserModel(registerUser);
    model?.createUser((response) {
      onCreateUserSuccess(context);
    }, (error) {
      model?.showErrorDialog(context, "Error", error);
    });
  }

  void onCreateUserSuccess(BuildContext context) {
    hideLoader();
    cardsWidget.lastStepInitPage();
    model?.sendSMSCode();
  }

  @override
  void onBackPressed(BuildContext context) {
    if (model?.currentStep == 1) {
      // model?.back(onValue: onBackCallback);
      model?.dissmis(context);
    } else {
      cardsWidget.previewsPage(context, (model?.currentStep ?? 0) - 1);
    }
  }
}
