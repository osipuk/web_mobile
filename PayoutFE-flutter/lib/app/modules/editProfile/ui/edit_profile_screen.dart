import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/payout_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/editProfile/viewModel/edit_profile_view_model.dart';
import 'package:stacked/stacked.dart';

enum EditOptions { Mail, Phone, Name, Address, Password, BankInfo }

// ignore: must_be_immutable
class EditProfileUserScreen extends GeneralScreen {
  EditProfileUserViewModel? model;

  Function? editProfileComplete;
  EditProfileUserScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam required this.editProfileComplete,
  }) : super(onBackCallback);

  @override
  Widget mainBuild(BuildContext context) {
    var routeData = RouteData.of(context);
    return ViewModelBuilder<EditProfileUserViewModel>.reactive(
        builder: (context, model, child) =>
            builderView(context, model, routeData),
        viewModelBuilder: () => EditProfileUserViewModel(context));
  }

  Widget builderView(BuildContext context, EditProfileUserViewModel model,
      RouteData routeData) {
    this.model = model;
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
            // onMailWidget(context),
          ],
        ),
      ),
    );
  }

  Widget onHeaderMainCorner() {
    return Container(
      height: 30,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(30.0),
          topRight: Radius.circular(30.0),
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
              icon: Icon(Icons.arrow_back, color: Colors.white),
              onPressed: () => model?.back(),
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
              margin: EdgeInsets.only(right: 20, left: 20, bottom: 32),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  separatorNavBar(),
                  onHeaderMainCorner(),
                  editProfileLabel(),
                  uploadPhotoButton(context),
                  separatorWidget(),
                  friendsListWidget(),
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

  Widget editProfileLabel() {
    return Container(
      width: double.infinity,
      color: Colors.white,
      alignment: Alignment.centerLeft,
      padding: EdgeInsets.only(left: 27),
      child: PoppinsText(
        content: "Edit profile",
        fontSize: 28,
        fontWeight: FontWeight.bold,
      ),
    );
  }

  Widget uploadPhotoButton(BuildContext context) {
    return Container(
      width: double.infinity,
      color: Colors.white,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            alignment: Alignment.centerLeft,
            width: MediaQuery.of(context).size.width / 1.5,
            padding: EdgeInsets.only(top: 26, left: 20, bottom: 20),
            child: PoppinsButton(
              content: "Upload new image",
              imageView: ProfileImage(
                fileProfile: model?.editUser.profileImage,
                size: 32,
              ),
              onTap: () => showUploadImageModal(context),
            ),
          )
        ],
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

  Widget friendsListWidget() {
    return Expanded(
      child: Container(
        padding: EdgeInsets.only(bottom: 16),
        child: GridView.count(
          crossAxisCount: 2,
          childAspectRatio: 1.2 / 1,
          scrollDirection: Axis.vertical,
          padding: EdgeInsets.all(20),
          mainAxisSpacing: 24,
          crossAxisSpacing: 24,
          children: List<Widget>.generate(
            model?.menu.length ?? 0,
            (index) {
              return optionMenuCard(model?.menu[index]);
            },
          ),
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.only(
            bottomLeft: Radius.circular(30.0),
            bottomRight: Radius.circular(30.0),
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
      ),
    );
  }

  Widget optionMenuCard(EditOptions? option) {
    return GestureDetector(
      onTap: () => model?.navRouteByOption(option, editProfileComplete),
      child: Container(
        alignment: Alignment.center,
        padding: EdgeInsets.only(right: 8, left: 8, bottom: 20, top: 20),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Container(
              height: 50,
              child: SvgPicture.asset(
                model?.getImageByOption(option) ?? "",
              ),
              padding: EdgeInsets.only(bottom: 16),
            ),
            PoppinsText(
              content: model?.getTitleByOption(option) ?? "",
              fontSize: 12,
            )
          ],
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.all(Radius.circular(30.0)),
          boxShadow: [
            BoxShadow(
              color: PayPOutColors.PrimaryAssentColor.withOpacity(0.1),
              spreadRadius: 3,
              blurRadius: 15,
              offset: Offset(0, 0), // changes position of shadow
            ),
          ],
        ),
      ),
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
              model?.navToPayOutHome();
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
          PayOutTabBar(model?.indexSelected ?? 0, onClick: (id) {
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

  void showUploadImageModal(BuildContext context) {
    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      builder: (BuildContext bc) {
        return Container(
          padding: EdgeInsets.only(left: 56, right: 30, top: 32, bottom: 52),
          child: Wrap(
            children: <Widget>[
              Container(
                child: Row(
                  children: <Widget>[
                    Expanded(
                      child: PoppinsText(
                        content: 'Upload pic',
                        fontWeight: FontWeight.bold,
                        fontSize: 23,
                      ),
                    ),
                    PoppinsButton(
                      image: SVGImage.close,
                      borderColor: Colors.transparent,
                      color: Colors.transparent,
                      shadowColor: Colors.white,
                      onTap: () => Navigator.pop(context),
                    )
                  ],
                ),
              ),
              SeparateLine(),
              GestureDetector(
                onTap: () {
                  Navigator.pop(context);
                  showLoader();
                  model?.openGallery().then((value) {
                    if (value?.status ?? false) {
                      uploadImageSuccesfull(context);
                    } else {
                      uploadImageFailed(context, value);
                    }
                  });
                },
                child: Container(
                  height: 60,
                  child: Row(
                    children: <Widget>[
                      Container(
                        margin: EdgeInsets.only(right: 32),
                        alignment: Alignment.centerLeft,
                        child: SvgPicture.asset(SVGImage.galleryIcon),
                      ),
                      PoppinsText(
                        content: 'Open gallery',
                        textColor: PayPOutColors.PrimaryAssentColor,
                        fontSize: 16,
                      )
                    ],
                  ),
                ),
              ),
              SeparateLine(),
              GestureDetector(
                onTap: () {
                  Navigator.pop(context);
                  showLoader();
                  model?.openCamera().then((value) {
                    if (value?.status ?? false) {
                      uploadImageSuccesfull(context);
                    } else {
                      uploadImageFailed(context, value);
                    }
                  });
                },
                child: Container(
                  height: 60,
                  child: Row(
                    children: <Widget>[
                      Container(
                        margin: EdgeInsets.only(right: 32),
                        alignment: Alignment.centerLeft,
                        child: SvgPicture.asset(SVGImage.cameraIcon),
                      ),
                      PoppinsText(
                        content: 'Open camera',
                        textColor: PayPOutColors.PrimaryAssentColor,
                        fontSize: 16,
                      )
                    ],
                  ),
                ),
              )
            ],
          ),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.only(
                topRight: Radius.circular(30.0),
                topLeft: Radius.circular(30.0)),
          ),
        );
      },
    );
  }

  void uploadImageSuccesfull(BuildContext context) {
    model?.dialogScreen(
      context,
      "Saved correctly",
      "We have updated your profile correctly",
      SVGImage.checkSuccessIcon,
    );
    SharedPreferencesManager.get.savePendingRefreshUserData(true);
    hideLoader();
  }

  void uploadImageFailed(BuildContext context, GeneralResponse? value) {
    model?.showErrorDialog(
      context,
      "Error trying to upload the image",
      (value?.message.isEmpty ?? false)
          ? "Try uploading your profile picture again"
          : value?.message ?? "",
    );
    hideLoader();
  }
}
