import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/invitationPayout/ui/invite_payout_screen.dart';
import 'package:pay_out/app/modules/invitationPayout/viewModel/invite_payout_view_model.dart';
import 'package:percent_indicator/linear_percent_indicator.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class InvitePayoutMainScreen extends GeneralScreen {
  InvitePayoutViewModel? model;

  InvitePayoutScreen? payOutScreen;
  final PayOut? payOut;

  InvitePayoutMainScreen({
    @queryParam required this.payOut,
    VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  Widget builderView(
      BuildContext context, InvitePayoutViewModel model, RouteData routeData) {
    this.model = model;
    return Stack(
      children: [
        backgroundImage(context),
        bodyView(context),
      ],
    );
  }

  @override
  Widget mainBuild(BuildContext context) {
    var routeData = RouteData.of(context);
    return ViewModelBuilder<InvitePayoutViewModel>.reactive(
      builder: (context, model, child) =>
          builderView(context, model, routeData),
      viewModelBuilder: () => InvitePayoutViewModel(context),
    );
  }

  Widget bodyView(BuildContext context) {
    return Container(
      child: Stack(
        children: [
          SafeArea(
            child: navBar(context),
          ),
          Container(
            child: contentPayOut(context),
          ),
        ],
      ),
    );
  }

  Widget contentPayOut(BuildContext context) {
    double bottomInsets = MediaQuery.of(context).viewInsets.bottom;

    payOutScreen = InvitePayoutScreen(
      onBackCallback,
      payOut,
      stepValues: (currentStep, totalSteps) {
        updateStepView(
          currentStep,
          totalSteps,
        );
      },
    );

    return Container(
      padding: EdgeInsets.only(
        bottom: bottomInsets >= 40 ? bottomInsets - 40 : bottomInsets,
      ),
      child: ListView(
        children: [
          SafeArea(
            child: GestureDetector(
              onTap: () => onBackPressed(context),
              child: Container(
                color: Colors.transparent,
                height: 80,
                width: 80,
              ),
            ),
          ),
          payOutScreen ?? Container(),
          //tabBarView(),
        ],
      ),
    );
  }

  void updateStepView(int currentStep, List<InvitePayOutSteps> totalSteps) {
    model?.step = totalSteps[currentStep - 1];
    model?.currentStep = currentStep;
    model?.totalStep = totalSteps.length;
    model?.notify();
  }

  Widget navBar(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 32, right: 40, left: 16),
      child: createPayoutStatusBar(context),
    );
  }

  Widget createPayoutStatusBar(BuildContext context) {
    return Container(
      height: 25,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          IconButton(
              padding: EdgeInsets.zero,
              icon: Icon(Icons.arrow_back, color: Colors.white),
              onPressed: () => onBackPressed(context)),
          Visibility(
            visible: true,
            child: Expanded(
              child: Container(
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
            ),
          )
        ],
      ),
    );
  }

  Widget tabBarView() {
    return Container(
      padding: EdgeInsets.only(
        top: 32,
        bottom: 16,
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(model?.indexSelected, onClick: (id) {
            model?.indexSelected = id;
            model?.notify();
          })
        ],
      ),
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    super.onBackPressed(context);
    if (model?.currentStep == 1) {
      model?.back();
    } else {
      payOutScreen?.previewsPage(context, (model?.currentStep ?? 1) - 1);
    }
  }
}
