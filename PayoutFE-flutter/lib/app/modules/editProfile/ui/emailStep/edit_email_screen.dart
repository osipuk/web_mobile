import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/editProfile/ui/emailStep/edit_email_widget.dart';
import 'package:pay_out/app/modules/editProfile/viewModel/edit_profile_view_model.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

// ignore: must_be_immutable
class EditEmailProfileUserScreen extends GeneralScreen {
  EditProfileUserViewModel? model;

  User? user;

  EditEmailProfileUserScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam this.user,
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
      child: Column(
        children: [
          Expanded(
            flex: 1,
            child: ConstrainedBox(
              constraints: BoxConstraints(
                minHeight: 100.0,
                maxHeight: 650.0,
              ),
              child: Container(
                width: MediaQuery.of(context).size.width,
                padding: EdgeInsets.only(right: 16, left: 16, top: 16),
                margin: marginBottomBody(),
                child: NotificationListener<OverscrollIndicatorNotification>(
                  onNotification: (OverscrollIndicatorNotification overScroll) {
                    return false;
                  },
                  child: onBodyScrollView(context),
                ),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: borderBottomBody(),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.2),
                      spreadRadius: 3,
                      blurRadius: 60,
                      offset: Offset(0, -5), // changes position of shadow
                    ),
                  ],
                ),
              ),
            ),
          ),
          tabBarView(),
        ],
      ),
    );
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32, bottom: 24),
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
          flex: 1,
          child: SingleChildScrollView(
            child: EditEmailWidget(
              user?.email ?? "",
              onChangeEmail: (email) {
                user?.email = email;
                model?.notify();
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
          alignment: Alignment.center,
          height: 80,
          margin: EdgeInsets.only(top: 8, bottom: 16, left: 8, right: 24),
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
                    if (user?.email?.isValidEmail() ?? false) {
                      model?.editProfileUser({
                        "email": user?.email,
                      }, successfull: (message) {
                        this.showOptionsDialog(
                          context,
                          "Confirm your email.",
                          message,
                          SVGImage.checkSuccessIcon,
                          onAceptClick: () {
                            Navigator.of(context, rootNavigator: true).pop();
                            model?.getProfileUser();
                            model?.back();
                          },
                        );
                      }, onError: (error) {
                        model?.showErrorDialog(
                          context,
                          "Update email request declined.",
                          error,
                        );
                      });
                    }
                  },
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget tabBarView() {
    return Container(
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
    return EdgeInsets.only(bottom: 6, right: 20, left: 20);
  }

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(35));
  }
}
