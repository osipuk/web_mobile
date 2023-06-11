import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/invitationPayout/repository/invite_payout_repository.dart';

enum InvitePayOutSteps { INFO, SURVEY, DISCLAIMER, AUTHORIZE }

class InvitePayoutViewModel extends PayOutViewModel {
  InvitePayoutViewModel(BuildContext context) : super(context);

  final InvitePayOutRepository repository = InvitePayOutRepository();

  int? indexSelected = 1;
  int? surveyIndexSelected = 0;
  var cardIndexSelected = 0; // Indice de la carta seleccionada de payOuts
  String? reason = 'other';

  int currentStep = 1;
  int totalStep = 4;
  InvitePayOutSteps? step;

  List<double> heigths = [900, 900, 900, 900];

  final List<InvitePayOutSteps> formSteps = [
    InvitePayOutSteps.INFO,
    InvitePayOutSteps.SURVEY,
    InvitePayOutSteps.DISCLAIMER,
    InvitePayOutSteps.AUTHORIZE
  ];

  List<InvitePayOutSteps> getSteps() {
    return formSteps;
  }

  ///MARK: API functions
  void acceptedPayoutInvitation(
      PayOut payOut, Function() onComplete, Function(String) onError) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.postAcceptedInvitation(userID, payOut).then((response) {
      if (response.status) {
        repository.postAcceptedAggrementPayOut(userID, payOut).then(
          (aggrementResponse) {
            if (aggrementResponse.status) {
              onComplete();
            } else {
              onError(response.message);
            }
          },
        );
      } else {
        onError(response.message);
      }
    });
  }

  void declinePayoutInvitation(
      PayOut payOut, Function() onComplete, Function(String) onError) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.postDeclineInvitation(userID, payOut).then((response) {
      if (response.status) {
        onComplete();
      } else {
        onError(response.message);
      }
    });
  }

  //MARK: Navigation functions
  void goToAcceptedPayoutSuccesfull(PayOut payout,
      {VoidCallback? onBackCallback}) {
    dialogScreen(
      context,
      "Joined successfully",
      "You have joined this payout!, Now we're just waiting for everyone else to join so we can begin this payout cycle.",
      SVGImage.explosionIcon,
      onAceptClick: () {
        Navigator.pop(context);
        back(onValue: () {
          navToPayOutDetail(payout, onBackCallback: onBackCallback);
        });
      },
    );
  }

  void goToDeclinePayoutSuccesfull(PayOut payOut,
      {VoidCallback? onBackCallback}) {
    dialogScreen(
      context,
      "Payout Declined",
      "We will inform the organizer that you have chosen not to join.",
      SVGImage.failedIcon,
      onAceptClick: () {
        Navigator.pop(context);
        back();
      },
    );
  }
}
