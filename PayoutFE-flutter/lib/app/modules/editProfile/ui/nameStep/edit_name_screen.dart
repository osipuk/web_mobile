import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/editProfile/ui/nameStep/edit_name_widget.dart';
import 'package:pay_out/app/modules/editProfile/viewModel/edit_profile_view_model.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class EditNameProfileUserScreen extends GeneralScreen {
  EditProfileUserViewModel? model;

  User? user;
  Function? editProfileComplete;

  EditNameProfileUserScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam required this.user,
    @queryParam required this.editProfileComplete,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<EditProfileUserViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => EditProfileUserViewModel(context),
    );
  }

  Widget builderView(BuildContext context, EditProfileUserViewModel? model) {
    this.model = model;
    return super.generalView(context);
  }

  @override
  Widget bodyBackground(BuildContext context) {
    return Expanded(
      child: SafeArea(
        child: Column(
          children: [
            super.bodyBackground(context),
            if (!StatelessExtension.isShowKeyboard) tabBarView(),
          ],
        ),
      ),
    );
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [onBackWidget(context)],
        ),
      ),
    );
  }

  Widget onBackWidget(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back, color: Colors.white),
      onPressed: () => model?.back(),
    );
  }

  @override
  Widget onBodyScrollView(BuildContext context) {
    return Column(
      children: [
        Expanded(
          child: SingleChildScrollView(
            child: EditNamesWidget(
              user?.firstName ?? "",
              user?.lastName ?? "",
              user?.userName ?? "",
              onFirstNameChangeValue: (firstName) {
                user?.firstName = firstName;
              },
              onLastNameChangeValue: (lastName) {
                user?.lastName = lastName;
              },
              onUserNameChangeValue: (userName) {
                user?.userName = userName;
              },
            ),
          ),
        ),
        footerView(context),
      ],
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    super.onBackPressed(context);
    model?.back();
  }

  Widget footerView(BuildContext context) {
    return Column(
      children: <Widget>[
        SeparateLine(),
        Container(
          alignment: Alignment.topCenter,
          height: 80,
          margin: EdgeInsets.only(left: 8, right: 24),
          child: Row(
            children: <Widget>[
              Visibility(
                visible: true,
                child: GestureDetector(
                  onTap: () => onBackPressed(context),
                  child: Container(
                    width: 50,
                    margin: EdgeInsets.only(left: 16, right: 12),
                    child: SvgPicture.asset(SVGImage.backRound),
                  ),
                ),
              ),
              Expanded(
                child: PoppinsButton(
                  content: "Save",
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                  color: PayPOutColors.pink,
                  borderColor: PayPOutColors.pink,
                  onTap: () {
                    model?.editProfileUser({
                      "first_name": user?.firstName,
                      "last_name": user?.lastName,
                      "user_name": user?.userName,
                    }, successfull: (message) {
                      updateProfileSuccesfull(context);
                    }, onError: (error) {
                      model?.showErrorDialog(
                          context, "Update name request declined.", error);
                    });
                  },
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  void updateProfileSuccesfull(BuildContext context) {
    showOptionsDialog(
      context,
      "Saved correctly",
      "We have updated your name correctly",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        SharedPreferencesManager.get.savePendingRefreshUserData(true);
        editProfileComplete?.call();
        model?.getProfileUser();
        model?.back();
      },
    );
    hideLoader();
  }

  Widget tabBarView() {
    return Container(
      margin: EdgeInsets.only(top: 24),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(model?.indexSelected ?? 0, onClick: (id) {
            switch (id) {
              case 1:
                model?.navToPayOutHome();
                break;
              case 2:
                model?.navToNotifications();
                break;
              case 3:
                model?.navToCreatePayOut();
                break;
            }
            model?.indexSelected = id;
            model?.notify();
          })
        ],
      ),
    );
  }

  @override
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(right: 20, left: 20);
  }

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(35));
  }
}
