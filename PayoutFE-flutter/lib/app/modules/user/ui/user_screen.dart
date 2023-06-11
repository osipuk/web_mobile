import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/user/viewModel/user_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class UserScreen extends GeneralScreen {
  UserScreenViewModel? model;

  UserScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam this.id = "",
  }) : super(onBackCallback);

  // Params
  String id;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<UserScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => UserScreenViewModel(context));
  }

  Widget builderView(BuildContext context, UserScreenViewModel model) {
    this.model = model;
    this.model?.getProfileUser(id);
    return Stack(
      alignment: Alignment.topCenter,
      children: [
        backgroundImage(context),
        navBar(context),
        tabBarView(),
        bodyCard(context),
      ],
    );
  }

  Widget separatorNavBar() {
    return Container(
      height: 80,
      color: Colors.transparent,
      child: GestureDetector(
        onTap: () => model?.back(),
        child: Container(
          width: 80,
          color: Colors.transparent,
        ),
      ),
    );
  }

  Widget navBar(BuildContext context) {
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

  Widget onHeaderMainCorner() {
    return Container(
      height: 40,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(40.0),
          topRight: Radius.circular(40.0),
        ),
        boxShadow: [
          BoxShadow(
            color: PayPOutColors.PrimaryColor.withOpacity(0.3),
            spreadRadius: 2,
            blurRadius: 10,
            offset: Offset(0, 15), // changes position of shadow
          ),
        ],
      ),
    );
  }

  Widget onBackWidget(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back, color: Colors.white),
      onPressed: () => model?.back(),
    );
  }

  Widget bodyCard(BuildContext context) {
    return SafeArea(
      child: Stack(
        alignment: Alignment.center,
        children: [
          Container(
            child: Container(
              alignment: Alignment.center,
              margin: EdgeInsets.only(
                top: 80,
                right: 20,
                left: 20,
                bottom: 150,
              ),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(40.0),
                  topRight: Radius.circular(40.0),
                ),
              ),
            ),
          ),
          Container(
            child: Container(
              margin: EdgeInsets.only(right: 20, left: 20, bottom: 42),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  separatorNavBar(),
                  onHeaderMainCorner(),
                  profileImage(),
                  scrollAutoSizeFriendsWidget(),
                  separatorWidget(),
                  buttonsWidget(context),
                  separatorTabbar()
                ],
              ),
              alignment: Alignment.topCenter,
            ),
          ),
        ],
      ),
    );
  }

  Widget profileImage() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.center,
      child: Container(
        alignment: Alignment.center,
        child: ProfileImage(
          pathProfile: model?.user?.getProfileImage(),
          size: 70,
        ),
      ),
    );
  }

  Widget nameUserLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.center,
      padding: EdgeInsets.only(top: 20),
      child: PoppinsText(
        content: model?.user?.userName,
        fontSize: 28,
        fontWeight: FontWeight.bold,
      ),
    );
  }

  Widget emailUserLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.center,
      padding: EdgeInsets.only(top: 8),
      child: PoppinsText(
        content: model?.user?.email,
        linkTextColor: PayPOutColors.PrimaryAssentColor,
        fontSize: 12,
        fontWeight: FontWeight.w100,
      ),
    );
  }

  Widget separatorWidget() {
    return Container(
      color: Colors.white,
      height: 10,
      padding: EdgeInsets.only(left: 16, right: 16, top: 1.5),
      child: SeparateLine(),
    );
  }

  Widget scrollAutoSizeFriendsWidget() {
    return Expanded(
      child: Container(
        color: Colors.white,
        child: SingleChildScrollView(
          child: Column(
            children: [
              nameUserLabel(),
              emailUserLabel(),
              separatorWidget(),
              friendsLabel(),
              friendsListWidget(),
            ],
          ),
        ),
      ),
    );
  }

  Widget friendsLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.centerLeft,
      padding: EdgeInsets.only(top: 30, left: 38),
      child: PoppinsText(
        content: "Friends in common",
        fontSize: 14,
      ),
    );
  }

  Widget friendsListWidget() {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(right: 32, left: 32, top: 22, bottom: 24),
      height: 80,
      child: GridView.count(
        crossAxisCount: 1,
        childAspectRatio: 1 / 1,
        scrollDirection: Axis.horizontal,
        padding: EdgeInsets.zero,
        mainAxisSpacing: 24,
        children: List<Widget>.generate(
          20,
          (index) {
            return invitatorCard();
          },
        ),
      ),
    );
  }

  Widget invitatorCard() {
    return Container(
      child: ProfileImage(),
    );
  }

  Widget buttonsWidget(BuildContext context) {
    return Container(
        padding: EdgeInsets.only(right: 8, left: 8, bottom: 37, top: 20),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: [
            Expanded(
              child: PoppinsButton(
                content: "Add",
                color: PayPOutColors.darkPink,
                borderColor: PayPOutColors.pink,
                fontWeight: FontWeight.bold,
                onTap: () => showAddedUserDialog(context),
              ),
            ),
            Expanded(
              child: PoppinsButton(
                content: "Message",
                color: PayPOutColors.darkPink,
                borderColor: PayPOutColors.pink,
                fontWeight: FontWeight.bold,
                onTap: () {},
              ),
            )
          ],
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.only(
            bottomLeft: Radius.circular(40.0),
            bottomRight: Radius.circular(40.0),
          ),
          boxShadow: [
            BoxShadow(
              color: PayPOutColors.PrimaryColor.withOpacity(0.3),
              spreadRadius: 2,
              blurRadius: 10,
              offset: Offset(0, 15), // changes position of shadow
            ),
          ],
        ));
  }

  Widget separatorTabbar() {
    return Container(
      height: 80,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () {
              model?.navToPayOutHome();
            },
            child: Container(
              width: 80,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
              model?.navToPayOutHome();
              model?.navToNotifications();
            },
            child: Container(
              width: 80,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () => model?.navToCreatePayOut(),
            child: Container(
              width: 80,
              color: Colors.transparent,
            ),
          )
        ],
      ),
    );
  }

  Widget tabBarView() {
    return Container(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(
            model?.indexSelected ?? 0,
            onClick: (id) {
              model?.indexSelected = id;
              model?.notify();
            },
          )
        ],
      ),
    );
  }

  void showAddedUserDialog(BuildContext context) {
    model?.dialogScreen(
      context,
      "Added correctly",
      "User name 2 was successfully addded to your friend list",
      SVGImage.checkSuccessIcon,
    );
  }
}
