// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/material.dart';
import 'package:flutter_stack_card/flutter_stack_card.dart';
import 'package:load/load.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/router/step_widget.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/authorize_create_payout_scree.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/disclaimer_create_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/fees_create_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/group_details_crate_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/create_payout_view_model.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/basic_info_create_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/invite_friends_create_payout_screen.dart';
import 'package:pay_out/app/modules/createPayout/ui/steps/survey_create_payout_screen.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_stack_cards.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';

// ignore: must_be_immutable
class CreatePayoutScreen extends GeneralScreen {
  CreatePayoutViewModel? model;
  var stackCards = StackSingleCard.builder();

  final PayOut? payoutToEdit;
  final Function(int, List<CreatePayOutSteps>) stepValues;

  CreatePayoutScreen(
    VoidCallback? onBackCallback, {
    required this.stepValues,
    this.payoutToEdit,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<CreatePayoutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () =>
          CreatePayoutViewModel(context, payoutToEdit: payoutToEdit),
      onModelReady: (_) {
        delay(Duration(seconds: 2), () {
          hideLoader();
        });
      },
    );
  }

  Widget builderView(BuildContext context, CreatePayoutViewModel model) {
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
          steps[index] == CreatePayOutSteps.AUTHORIZE
              ? "Create Payout"
              : "Next",
          isShowCard
              ? MeasuredSize(
                  onChange: (size) {
                    model!.heigths[index] = (size.height + 360);
                    if (index == 2) {
                      int users = model?.payoutCreate.inviteUsers.length ?? 0;
                      model!.heigths[index] =
                          (size.height + 360) + (users * 20);
                    }
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
          enableFooter: enableNextButton(index),
        );
      },
    );
    return stackCards;
  }

  Widget contentCard(BuildContext context, CreatePayOutSteps step) {
    switch (step) {
      case CreatePayOutSteps.SURVEY: // Razon del payout
        return SurveyCreatePayoutScreen(
          optionSelected: model?.surveyIndexSelected,
          otherOption: model?.payoutCreate.reason,
          optionChangeValue: (reason, index) {
            model?.surveyIndexSelected = index;
            model?.payoutCreate.reason = reason;
            model?.notify();
          },
          otherOptionChangeValue: (reason) {
            model?.payoutCreate.reason = reason;
            model?.surveyIndexSelected = null;
            //model?.notify();
          },
        );
      case CreatePayOutSteps.BASIC_INFO: // Nombre, precio y fecha.
        return BasicInfoCreatePayoutScreen(
          onBackCallback,
          dateOptionChangeValue: (initDate, tempDate) {
            model?.payoutCreate.tempInitDate = tempDate;
            model?.payoutCreate.initDate = initDate;
            model?.notify();
          },
          nameOptionChangeValue: (name) {
            model?.payoutCreate.name = name;
            model?.notify();
          },
          priceOptionChangeValue: (price) {
            model?.payoutCreate.pricePerMember = price;
            model?.notify();
          },
          name: model?.payoutCreate.name,
          pricePerMember: model?.payoutCreate.pricePerMember,
          tempDate: model?.payoutCreate.tempInitDate,
          date: model?.payoutCreate.initDate,
        );
      case CreatePayOutSteps.INVITE_FRIENDS:
        return InviteFriendsCreatePayoutScreen(
          onBackCallback,
          orderChangeValue: (value) {
            model?.payoutCreate.randomOrder = value;
            model?.notify();
          },
          selectUsersChangeValue: (users) {
            model?.payoutCreate.inviteUsers = users ?? [];
            model?.notify();
          },
          random: model?.payoutCreate.randomOrder,
          querySearch: "",
          payOutToEdit: payoutToEdit,
          initDate: model?.payoutCreate.initDate,
        );

      case CreatePayOutSteps.FEES:
        return FeesCreatePayoutScreen(
          otherOptionChangeValue: (value) {
            model?.payoutCreate.isDeduct = value;
          },
          payOut: model?.payoutCreate,
          payOutToEdit: payoutToEdit,
        );

      case CreatePayOutSteps.GROUP_DETAIL:
        return GroupDetailsCreatePayoutScreen(payout: model?.payoutCreate);

      case CreatePayOutSteps.DISCLAIMER:
        return DisclaimerCreatePayoutScreen(validateDisclaimer: false);

      case CreatePayOutSteps.AUTHORIZE:
        return AuthorizeCreatePayoutScreen(payout: model?.payoutCreate);
      default:
        return Container(color: Colors.white, height: 100);
    }
  }

  bool enableNextButton(int currentIndex) {
    final steps = model?.getSteps();
    switch (steps?[currentIndex]) {
      case CreatePayOutSteps.BASIC_INFO:
        var emptyName = model?.payoutCreate.name?.isEmpty ?? true;
        var emptyPrice = (model?.payoutCreate.pricePerMember ?? 0) <= 0;
        var emptydate = model?.payoutCreate.initDate == null;
        return !emptyName && !emptyPrice && !emptydate;
      default:
        return true;
    }
  }

  void nextPage(BuildContext context, int currentIndex) async {
    final nextPage = currentIndex + 1;
    final steps = model?.getSteps();

    if (steps?[currentIndex] == CreatePayOutSteps.BASIC_INFO) {
      if ((model?.payoutCreate.name?.isEmpty ?? true)) {
        model?.showErrorDialog(
            context, "Error creating payout", "Enter your name.");
        return;
      }
      if ((model?.payoutCreate.pricePerMember ?? 0) <= 0.0) {
        model?.showErrorDialog(
            context, "Error creating payout", "Enter a price greater than 0.");
        return;
      }
      if (model?.payoutCreate.initDate == null) {
        model?.showErrorDialog(context, "Error creating PayOut",
            "Select the initial date of the payout.");
        return;
      }
    }

    //invite Friends
    if (steps?[currentIndex] == CreatePayOutSteps.INVITE_FRIENDS) {
      if (payoutToEdit == null) {
        if ((model?.payoutCreate.inviteUsers.length ?? 0) <= 1) {
          model?.showErrorDialog(context, "Invite more friends",
              "to create a PayOut you must add at least a friend.");
          return;
        }
      } else {
        if ((model?.payoutCreate.inviteUsers.length ?? 0) < 1) {
          model?.showErrorDialog(context, "Invite more friends",
              "to create a PayOut you must add at least a friend.");
          return;
        }
        model?.updatePayOut(() {
          hideLoadingDialog();
          model?.goToAddUserPayoutSuccesfull();
        }, (error) {
          hideLoadingDialog();
          model?.showErrorDialog(context, "Error updating PayOut", error);
        });
        return;
      }
    }

    //Creacion del payOut
    if (steps?[currentIndex] == CreatePayOutSteps.AUTHORIZE) {
      showLoader();
      model?.createPayOut((payoutCreated) {
        model?.acceptedPayoutInvitation(payoutCreated, () {
          hideLoadingDialog();
          model?.goToCreatePayoutSuccesfull();
        }, (error) {
          hideLoadingDialog();
          model?.showErrorDialog(context, "Error creating PayOut", error);
        });
      }, (error) {
        hideLoadingDialog();
        model?.showErrorDialog(context, "Error creating PayOut", error);
      });
      return;
    }

    changePageTo(nextPage);
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
