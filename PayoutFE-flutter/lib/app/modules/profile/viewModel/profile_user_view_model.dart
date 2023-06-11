import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';
import 'package:auto_route/auto_route.dart';

class ProfileUserViewModel extends PayOutViewModel {
  final ProfileRepository repository = ProfileRepository();

  User? profileUser = User();
  int indexSelected = 2;

  String querySearch = "";
  List<User>? users = [];

  ProfileUserViewModel(BuildContext context) : super(context);

  void getProfileUser() async {
    int userID = await SharedPreferencesManager.get.getUserID();
    repository.getProfileUser(userID.toString()).then(
      (response) {
        if (response.status) {
          profileUser = response.data;
          DatabaseManager.get.saveUser(profileUser);
          notify();
        }
      },
    );
  }

  void searchUsers() async {
    int userID = await SharedPreferencesManager.get.getUserID();
    repository.postSearchUsers(userID.toString(), querySearch).then(
      (response) {
        if (response.status) {
          users = response.data;
          notify();
        }
      },
    );
  }

  ///MARK: Navigate functions
  void navToEditProfileUser(
    Function editProfileComplete, {
    VoidCallback? onBackCallback,
  }) {
    context.router.navigate(EditProfileUserScreenRoute(
      onBackCallback: onBackCallback,
      editProfileComplete: editProfileComplete,
    ));
  }
}
