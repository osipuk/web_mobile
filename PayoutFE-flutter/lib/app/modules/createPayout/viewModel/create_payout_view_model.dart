import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_response_model.dart';
import 'package:pay_out/app/modules/createPayout/repository/create_payout_respository.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

enum CreatePayOutSteps {
  SURVEY,
  BASIC_INFO,
  INVITE_FRIENDS,
  FEES,
  GROUP_DETAIL,
  BANK_INFO,
  DISCLAIMER,
  AUTHORIZE
}

class CreatePayoutViewModel extends PayOutViewModel {
  CreatePayoutViewModel(
    BuildContext context, {
    this.payoutToEdit,
  }) : super(context);

  final CreatePayOutRepository repository = CreatePayOutRepository();
  final PayOut? payoutToEdit;

  int? indexSelected = 1;
  int? surveyIndexSelected = 0;
  var cardIndexSelected = 0; // Indice de la carta seleccionada de payOuts

  int currentStep = 1;
  int totalStep = 6;
  CreatePayOutSteps? step;

  bool isSearching = false;
  int? currentInviteUserSelected;
  List<User> searchUsersList = []; // Lista de usuarios de una busqueda
  List<User> inviteUsersList =
      []; // Lista de usuarios de han seran invitados al payout
  String queryFriendSearch = "";
  List<double> heigths = [900, 900, 900, 900, 900, 900];

  PayOutCreate payoutCreate = PayOutCreate();

  final List<CreatePayOutSteps> _formSteps = [
    CreatePayOutSteps.SURVEY,
    CreatePayOutSteps.BASIC_INFO,
    CreatePayOutSteps.INVITE_FRIENDS,
    //CreatePayOutSteps.FEES,
    CreatePayOutSteps.GROUP_DETAIL,
    //CreatePayOutSteps.BANK_INFO,
    CreatePayOutSteps.DISCLAIMER,
    CreatePayOutSteps.AUTHORIZE
  ];

  final List<CreatePayOutSteps> _editFormSteps = [
    CreatePayOutSteps.INVITE_FRIENDS,
    // CreatePayOutSteps.GROUP_DETAIL,
    // CreatePayOutSteps.DISCLAIMER,
    // CreatePayOutSteps.AUTHORIZE
  ];

  List<CreatePayOutSteps> getSteps() {
    return payoutToEdit != null ? _editFormSteps : _formSteps;
  }

  ///MARK: API functions
  void createPayOut(Function(PayOutCreateResponse response) onComplete,
      Function(String) onError) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    payoutCreate.userID = userID.toString();
    repository.postCreatePayout(payoutCreate).then((response) {
      if (response.status) {
        acceptedPayoutInvitation(response, () {
          onComplete(response);
        }, (error) {
          onError(error);
        });
      } else {
        onError(response.message);
      }
      notifyListeners();
    }).catchError(error);
  }

  void updatePayOut(Function() onComplete, Function(String) onError) {
    payoutCreate.inviteUsers.forEach((e) async {
      final response = await repository.addUserInPayOut(e.id, payoutToEdit);
      if (payoutCreate.inviteUsers.last.id == e.id) {
        if (response.status) {
          onComplete();
        } else {
          onError(response.message);
        }
      }
    });
  }

  void acceptedPayoutInvitation(PayOutCreateResponse payOut,
      Function() onComplete, Function(String) onError) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.postAcceptedAgreementPayOut(userID, payOut.data.id).then(
      (aggrementResponse) {
        if (aggrementResponse.status) {
          onComplete();
        } else {
          onError(aggrementResponse.message);
        }
      },
    );
  }

  void searchUsers(
    String querySearch,
    bool isSummited, {
    Function(String)? onNewEmail,
  }) async {
    if ((querySearch != queryFriendSearch) || isSummited) {
      int userID = await SharedPreferencesManager.get.getUserID();
      queryFriendSearch = querySearch;
      repository.postSearchUsers(userID.toString(), querySearch).then(
        (response) {
          if (response.status) {
            searchUsersList =
                querySearch.isNotEmpty ? (response.data ?? []) : [];

            if (searchUsersList.isEmpty && isSummited && payoutToEdit == null) {
              if (querySearch.isNotEmpty && querySearch.isValidEmail()) {
                onNewEmail!(querySearch);
              }
            }
            notify();
          }
        },
      );
    }
  }

  void startSearchFriends() {
    searchUsersList.clear();
    isSearching = true;
    queryFriendSearch = "";
    notify();
  }

  void removeUserHowInvite(int index) {
    inviteUsersList.removeAt(index);
    notify();
  }

  void addUserHowInvite(User? user) {
    if (!inviteUsersList.contains(user)) {
      inviteUsersList.add(user!);
    } else {
      showErrorDialog(
          context, "Hold on!", "Can't invite the same person twice.");
    }
    notify();
  }

  //MARK: Navigation functions
  void goToCreatePayoutSuccesfull({VoidCallback? onBackCallback}) {
    dialogScreen(
      context,
      "Payout Created",
      "The invitations to join the payout have been sent. Once everyone has confirmed, the payout cycle will begin",
      SVGImage.explosionIcon,
      onAceptClick: () {
        navToPayOutHome(onBackCallback: onBackCallback);
      },
    );
  }

  //MARK: Navigation functions
  void goToAddUserPayoutSuccesfull({VoidCallback? onBackCallback}) {
    dialogScreen(
      context,
      "Invitation send",
      "The invitations to join the payout have been sent. Once everyone has confirmed, the payout cycle will begin",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        navToPayOutHome(onBackCallback: onBackCallback);
      },
    );
  }
}
