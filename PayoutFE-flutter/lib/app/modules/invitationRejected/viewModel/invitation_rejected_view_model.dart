import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/modules/createPayout/repository/create_payout_respository.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationRejected/repository/invitation_rejected_repository.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

class InviteRejectedViewModel extends PayOutViewModel {
  InviteRejectedViewModel(
    BuildContext context, {
    this.payout,
  }) : super(context);

  final CreatePayOutRepository repository = CreatePayOutRepository();
  final PayOut? payout;

  int? indexSelected = 1;

  bool isSearching = false;
  int? currentInviteUserSelected;
  List<User> searchUsersList = []; // Lista de usuarios de una busqueda
  Map<int, User> inviteUsersList =
      {}; // Lista de usuarios de han seran invitados al payout
  String queryFriendSearch = "";
  List<double> heigths = [900, 900, 900, 900, 900, 900];

  PayOutCreate payoutCreate = PayOutCreate();

  final InvitationRejectedRepository inviteRepository =
      InvitationRejectedRepository();

  ///MARK: API functions
  ///

  void sendInviteUser(Function() onComplete) {
    inviteUsersList.forEach((key, value) async {
      final oldUser = payout?.members?[key];

      final isRegistered = value.registered ?? false;

      final response = await inviteRepository.sendInvitation(
        payout?.poolID.toString(),
        isRegistered ? value.id.toString() : value.email,
        oldUser?.userID.toString(),
        isRegistered,
      );
      onComplete();
      goToSendInvitationtSuccesfull();
      print(response);
    });
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

            if (searchUsersList.isEmpty && isSummited) {
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

  List<PayoutMember> getUsers() {
    return payout?.members?.where((e) {
          return (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0));
        }).toList() ??
        [];
  }

  void startSearchFriends() {
    searchUsersList.clear();
    isSearching = true;
    queryFriendSearch = "";
    notify();
  }

  void removeUserHowInvite(int index) {
    inviteUsersList.remove(index);
    notify();
  }

  void addUserHowInvite(User? user) {
    final newUser = <int, User>{
      currentInviteUserSelected!: user!,
    };
    inviteUsersList.addEntries(newUser.entries);
    currentInviteUserSelected = null;
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
  void goToSendInvitationtSuccesfull({VoidCallback? onBackCallback}) {
    dialogScreen(
      context,
      "Invitation send",
      "The invitations to join the payout has been sent. Once everyone has confirmed the payout cycle will begin.",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        navToPayOutHome(onBackCallback: onBackCallback);
      },
    );
  }
}
