// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/material.dart';
import 'package:flutter_stack_card/flutter_stack_card.dart';
import 'package:load/load.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/step_widget.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/disclaimer_create_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/survey_create_payout_screen.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/invitationPayout/ui/steps/authorize_invite_payout_screen.dart';
import 'package:pay_out/app/modules/invitationPayout/ui/steps/info_invite_payout_screen.dart';
import 'package:pay_out/app/modules/invitationPayout/viewModel/invite_payout_view_model.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_stack_cards.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class InvitePayoutScreen extends GeneralScreen {
  InvitePayoutViewModel? model;
  var stackCards = StackSingleCard.builder();

  final Function(int, List<InvitePayOutSteps>) stepValues;

  InvitePayoutScreen(
    VoidCallback? onBackCallback,
    @queryParam this.payout, {
    required this.stepValues,
  }) : super(onBackCallback);

  final PayOut? payout;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<InvitePayoutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => InvitePayoutViewModel(context),
      onModelReady: (_) {
        delay(Duration(seconds: 2), () {
          hideLoader();
        });
      },
    );
  }

  Widget builderView(BuildContext context, InvitePayoutViewModel model) {
    this.model = model;
    final currentCardHeigth = model.heigths[model.cardIndexSelected];
    return Container(
      height: currentCardHeigth - (currentCardHeigth * 0.1),
      child: Stack(
        alignment: Alignment.topCenter,
        children: [
          Container(
            padding: EdgeInsets.only(top: 24),
            child: bodyView(context),
          )
        ],
      ),
    );
  }

  Widget bodyView(BuildContext context) {
    final width = MediaQuery.of(context).size.width;
    var steps = model?.getSteps() ?? [];

    stackCards = StackSingleCard.builder(
      isSwipeActive: false,
      itemCount: steps.length,
      stackOffset: Offset(60, 180),
      scrollPhysics: NeverScrollableScrollPhysics(),
      onSwap: (index) {
        model?.cardIndexSelected = index;
        stepValues(index + 1, steps);
      },
      dimension: StackDimension(
        height: model?.heigths[model!.cardIndexSelected] ?? 0,
        width: width,
      ),
      itemBuilder: (context, index) {
        final bool isShowCard = index - (model?.cardIndexSelected ?? 0) <= 3;
        return StepWidget(
          _getTitleStepView(steps[index]),
          isShowCard
              ? MeasuredSize(
                  onChange: (size) {
                    model!.heigths[index] = (size.height + 360);
                    model?.notify();
                  },
                  child: contentCard(context, steps[index]),
                )
              : Container(),
          onButtonTapped: () => nextPage(context, index),
          onBackButtonTapped: () => previewsPage(context, index),
          onBackActive: true,
          showContentFooter: model?.cardIndexSelected == index,
          isAlwaysShowFooter: isShowCard,
          enableFooter: true,
          footer: newFooter(context, steps[index], index),
        );
      },
    );
    return stackCards;
  }

  // Sobre escrito para algunas vistas que tienen diferente footer al generico
  Widget? newFooter(BuildContext context, InvitePayOutSteps type, int index) {
    switch (type) {
      case InvitePayOutSteps.INFO:
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
                      content: 'Decline',
                      fontWeight: FontWeight.bold,
                      fontSize: 16,
                      color: Colors.white,
                      borderColor: PayPOutColors.pink,
                      onTap: () => showDeclineInviteDialog(context),
                    ),
                  ),
                  Expanded(
                    child: PoppinsButton(
                        content: 'Accept',
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: PayPOutColors.pink,
                        borderColor: PayPOutColors.pink,
                        onTap: () => nextPage(context, index)),
                  )
                ],
              ),
            )
          ],
        );

      default:
        return null;
    }
  }

  Widget contentCard(BuildContext context, InvitePayOutSteps step) {
    switch (step) {
      case InvitePayOutSteps.INFO: // Nombre, precio y fecha.
        return DetailInvitePayoutScreen(
          payOut: payout,
        );

      case InvitePayOutSteps.SURVEY: // Razon del payout
        return SurveyCreatePayoutScreen(
          optionSelected: model?.surveyIndexSelected,
          otherOption: model?.reason,
          optionChangeValue: (reason, index) {
            model?.reason = reason;
            model?.surveyIndexSelected = index;
            model?.notify();
          },
          otherOptionChangeValue: (reason) {
            model?.reason = reason;
            model?.surveyIndexSelected = null;
            // model?.notify();
          },
        );

      case InvitePayOutSteps.DISCLAIMER:
        return DisclaimerCreatePayoutScreen(validateDisclaimer: false);

      case InvitePayOutSteps.AUTHORIZE:
        return AuthorizeInvitePayoutScreen(payout: payout);

      default:
        return Container(color: Colors.white, height: 100);
    }
  }

  String _getTitleStepView(InvitePayOutSteps step) {
    switch (step) {
      case InvitePayOutSteps.INFO:
      case InvitePayOutSteps.DISCLAIMER:
        return 'Accept';
      case InvitePayOutSteps.SURVEY:
        return 'Next';
      case InvitePayOutSteps.AUTHORIZE:
        return 'Join Payout';
    }
  }

  void declineInvitation(BuildContext context) {
    showLoader();
    model?.declinePayoutInvitation(payout!, () {
      hideLoadingDialog();
      model?.goToDeclinePayoutSuccesfull(payout!);
    }, (error) {
      hideLoadingDialog();
      model?.showErrorDialog(context, "Error declien to PayOut", error);
    });
  }

  void nextPage(BuildContext context, int currentIndex) async {
    final nextPage = currentIndex + 1;
    final steps = model?.getSteps();

    //Aceptacion de la invitacion del payOut
    if (steps?[currentIndex] == InvitePayOutSteps.AUTHORIZE) {
      showLoader();
      model?.acceptedPayoutInvitation(payout!, () {
        hideLoadingDialog();
        model?.goToAcceptedPayoutSuccesfull(payout!);
      }, (error) {
        hideLoadingDialog();
        model?.showErrorDialog(context, "Error accepting to PayOut", error);
      });
    }
    changePageTo(nextPage);
  }

  void showDeclineInviteDialog(BuildContext context) {
    showOptionsDialog(
      context,
      "Decline Payout",
      "Are you sure you want to decline?",
      SVGImage.deleteSignalIcon,
      aceptTitleBtn: "Decline",
      cancelTitleBtn: "Cancel",
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        declineInvitation(context);
      },
      onCancelClick: () {
        Navigator.of(context, rootNavigator: true).pop();
      },
    );
  }

  void previewsPage(BuildContext context, int currentIndex) async {
    final nextPage = currentIndex - 1;
    if (nextPage < 0) {
      model?.back();
      return;
    }
    changePageTo(nextPage);
  }

  void changePageTo(int nextPage) {
    stackCards.pageController.animateToPage(nextPage,
        duration: Duration(milliseconds: 500), curve: Curves.decelerate);
    hideKeyboard();
  }
}
