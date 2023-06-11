import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';

class UserScreenViewModel extends PayOutViewModel {
  UserScreenViewModel(BuildContext context) : super(context);
  final ProfileRepository repository = ProfileRepository();

  int indexSelected = 2;

  bool loadUser = false;
  User? user = User();

  void getProfileUser(String userID) {
    if (!loadUser) {
      repository.getProfileUser(userID.toString()).then(
        (response) {
          if (response.status) {
            user = response.data;
            loadUser = true;
            notify();
          }
        },
      );
    }
  }
}
