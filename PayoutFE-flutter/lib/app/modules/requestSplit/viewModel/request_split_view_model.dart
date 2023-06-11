import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';
import 'package:pay_out/app/modules/requestSplit/repository/request_split_repository.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

class RequestSplitViewModel extends PayOutViewModel {
  final RequestSplitRepository repository = RequestSplitRepository();
  final ProfileRepository profileRepository = ProfileRepository();

  User? user;
  User? selectedUser;
  int indexSelected = 2;

  String querySearch = "";
  List<User>? users = [];

  RequestSplitViewModel(BuildContext context) : super(context);

  void requestASplit(
      PayOut? payOut, Function() onComplete, Function(String) onFailed) async {
    final userID = await SharedPreferencesManager.get.getUserID();

    if (selectedUser == null && querySearch.isValidEmail()) {
      repository.splitWitNotUserRegister(payOut, userID, querySearch).then(
        (response) {
          if (response.status) {
            onComplete();
          } else {
            onFailed(response.message);
          }
        },
      );
    } else {
      repository
          .splitWithUserRegister(payOut, userID, selectedUser?.id ?? 0)
          .then(
        (response) {
          if (response.status) {
            onComplete();
          } else {
            onFailed(response.message);
          }
        },
      );
    }
  }

  void searchUsers(String value) async {
    querySearch = value;
    if (value.isEmpty) {
      clearUsers();
      return;
    }

    int userID = await SharedPreferencesManager.get.getUserID();
    profileRepository.postSearchUsers(userID.toString(), value).then(
      (response) {
        if (response.status) {
          users = response.data;
          notify();
        }
      },
    );
  }

  void clearUsers() {
    users = [];
    notify();
  }

  bool isActiveSplitAction() {
    return selectedUser != null || querySearch.isValidEmail();
  }
}
