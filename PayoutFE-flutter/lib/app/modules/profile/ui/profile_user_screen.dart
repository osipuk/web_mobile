import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/payout_manager.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/profile/viewModel/profile_user_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class ProfileUserScreen extends GeneralScreen {
  ProfileUserViewModel? model;

  ScrollController _scrollController = ScrollController();

  Function? periodic;
  double backGroundSize = 0;

  ProfileUserScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    var routeData = RouteData.of(context);
    return ViewModelBuilder<ProfileUserViewModel>.reactive(
      builder: (context, model, child) =>
          builderView(context, model, routeData),
      viewModelBuilder: () => ProfileUserViewModel(context),
      onModelReady: (model) => onModelReady(model),
    );
  }

  void onModelReady(ProfileUserViewModel model) {
    this.model = model;
    model.getProfileUser();
    PushNotificationsManager.get.onArriveNotification = () {
      PushNotificationsManager.isPendingNotifications = true;
      model.notify();
    };
  }

  Widget builderView(
      BuildContext context, ProfileUserViewModel model, RouteData routeData) {
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
        onTap: () => model?.back(onValue: onBackCallback),
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
          children: [
            onBackWidget(context),
            //onMailWidget(context),
          ],
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
      onPressed: () => model?.back(onValue: onBackCallback),
    );
  }

  Widget onMailWidget(BuildContext context) {
    return Expanded(
      child: Container(
        alignment: Alignment.centerRight,
        child: Stack(
          children: [
            Visibility(
              visible: true,
              child: Container(
                width: 40,
                alignment: Alignment.bottomRight,
                child: Container(
                  margin: EdgeInsets.only(bottom: 25),
                  child: CircleAvatar(
                    backgroundColor: PayPOutColors.rose,
                    radius: 4,
                  ),
                ),
              ),
            ),
            IconButton(
              icon: SvgPicture.asset(
                SVGImage.messageNotIcon,
                height: 50,
              ),
              onPressed: () => model?.back(onValue: onBackCallback),
              iconSize: 40,
            )
          ],
        ),
      ),
    );
  }

  Widget bodyCard(BuildContext context) {
    return SafeArea(
      child: Column(
        children: [
          Expanded(
            child: Container(
              margin: EdgeInsets.only(
                right: 20,
                left: 20,
                bottom: 32,
              ),
              child: Stack(
                alignment: Alignment.center,
                children: [
                  Container(
                    height: backGroundSize / 1.5,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(Radius.circular(60.0)),
                      color: Colors.white,
                    ),
                  ),
                  MeasuredSize(
                    onChange: (size) {
                      backGroundSize = size.height;
                      model?.notify();
                    },
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.start,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        separatorNavBar(),
                        onHeaderMainCorner(),
                        profileImage(),
                        scrollAutoSizeFriendsWidget(context),
                        separatorWidget(),
                        buttonsWidget(context),
                        separatorTabbar()
                      ],
                    ),
                  ),
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
      child: Container(
        alignment: Alignment.center,
        child: ProfileImage(
          pathProfile: model?.profileUser?.getProfileImage(),
          size: 72,
        ),
      ),
    );
  }

  Widget nameUserLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.center,
      padding: EdgeInsets.only(left: 20, top: 20),
      child: PoppinsText(
        content: model?.profileUser?.firstName,
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
        content: model?.profileUser?.email,
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

  Widget scrollAutoSizeFriendsWidget(BuildContext context) {
    return Expanded(
      child: Container(
        color: Colors.white,
        child: SingleChildScrollView(
          controller: _scrollController,
          child: Column(
            children: [
              nameUserLabel(),
              emailUserLabel(),
              //separatorWidget(),
              //searchWidget(),
              //friendsLabel(),
              //friendsListWidget(context),
            ],
          ),
        ),
      ),
    );
  }

  Widget searchWidget() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.topLeft,
      padding: EdgeInsets.only(left: 16, right: 16),
      child: entryTextFieldSearch(),
    );
  }

  Widget entryTextFieldSearch() {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Search friends',
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 24, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.lightGrey, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Expanded(
                child: TextField(
                  onChanged: (text) {
                    model?.querySearch = text;
                    model?.searchUsers();
                    _scrollController.animateTo(
                      _scrollController.position.maxScrollExtent,
                      duration: Duration(milliseconds: 500),
                      curve: Curves.ease,
                    );
                  },
                  autocorrect: false,
                  enableSuggestions: false,
                  textAlignVertical: TextAlignVertical.center,
                  decoration: InputDecoration(
                    hintText: "Search friends",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                      fontSize: 15,
                      color: PayPOutColors.PrimaryAssentColor,
                      fontFamily: GeneralConstants.poppinsFont,
                    ),
                  ),
                ),
              ),
              PoppinsButton(
                imageView: Icon(Icons.search),
                margin: 0,
                iconColor: PayPOutColors.lightGrey,
                borderColor: Colors.white,
                shadowColor: Colors.white,
                onTap: () {},
              )
            ],
          ),
        ),
      ],
    );
  }

  Widget friendsLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.centerLeft,
      padding: EdgeInsets.only(top: 40, left: 38),
      child: PoppinsText(
        content: (model?.users?.isNotEmpty ?? false) ? "Recent search" : "",
        fontSize: 14,
      ),
    );
  }

  Widget friendsListWidget(BuildContext context) {
    final users = model?.users?.length ?? 0;

    if (users == 0) {
      return Container();
    }

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
          users,
          (index) {
            return invitatorCard(context, model?.users?[index]);
          },
        ),
      ),
    );
  }

  Widget invitatorCard(BuildContext context, User? user) {
    return Container(
      child: ProfileImage(
        pathProfile: user?.getProfileImage(),
        onProfileTap: () {
          model?.navToUserDetails(user!.id.toString());
        },
      ),
    );
  }

  Widget buttonsWidget(BuildContext context) {
    return Column(
      children: [
        Container(
          padding: EdgeInsets.only(right: 8, left: 8, bottom: 24, top: 20),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              Expanded(
                child: PoppinsButton(
                  content: "Log out",
                  color: PayPOutColors.lightPink,
                  borderColor: PayPOutColors.darkPink,
                  fontWeight: FontWeight.bold,
                  onTap: () => showLogOutDialog(context),
                ),
              ),
              Expanded(
                child: PoppinsButton(
                  content: "Edit",
                  color: PayPOutColors.darkPink,
                  borderColor: PayPOutColors.pink,
                  fontWeight: FontWeight.bold,
                  onTap: () => model?.navToEditProfileUser(() {
                    model?.getProfileUser();
                  }, onBackCallback: () {
                    model?.getProfileUser();
                  }),
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
          ),
        )
      ],
    );
  }

  Widget separatorTabbar() {
    return Container(
      height: 60,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () {
              model?.back(onValue: onBackCallback);
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
              model?.navToPayOutHome();
              model?.navToNotifications();
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () => model?.navToCreatePayOut(),
            child: Container(
              width: 60,
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
          PayOutTabBar(model?.indexSelected, onClick: (id) {
            model?.indexSelected = id;
            model?.notify();
          })
        ],
      ),
    );
  }

  void showLogOutDialog(BuildContext context) {
    showOptionsDialog(
      context,
      "Sign off?",
      "Are you sure you want to logout of your session? You will have to authenticate again.",
      SVGImage.deleteSignalIcon,
      aceptTitleBtn: "Confirm",
      cancelTitleBtn: "Cancel",
      onAceptClick: () {
        Navigator.of(context, rootNavigator: true).pop();
        PayOutManager.get.logOut(context);
      },
      onCancelClick: () {
        Navigator.of(context, rootNavigator: true).pop();
      },
    );
  }
}
