import 'dart:async';

import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/ui/EmptyPayOuts/home_empty_screen.dart';
import 'package:pay_out/app/modules/home/ui/ListPayOuts/home_payout_list_screen.dart';
import 'package:pay_out/app/modules/home/viewModel/home_view_model.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class HomeScreen extends GeneralScreen {
  HomeViewModel? model;

  var isSwitch = false;

  HomeScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  Widget builderView(
      BuildContext context, HomeViewModel model, RouteData routeData) {
    if (this.model == null) {
      this.model = model;
      delay(Duration(seconds: 1), () => this.model?.getUser());
    }
    return WillPopScope(
      onWillPop: () async {
        return false;
      },
      child: Stack(
        children: [backgroundImage(context), bodyView(context)],
      ),
    );
  }

  @override
  Widget mainBuild(BuildContext context) {
    var routeData = RouteData.of(context);
    return ViewModelBuilder<HomeViewModel>.reactive(
      builder: (context, model, child) =>
          builderView(context, model, routeData),
      viewModelBuilder: () => HomeViewModel(context),
      onModelReady: (model) => onModelReady(model),
    );
  }

  void onModelReady(HomeViewModel model) {
    model.setUpApp();
    timerPeriodic(Duration(seconds: 10), (timer) {
      getPayOuts();
    });
    PushNotificationsManager.get.onArriveNotification = () {
      PushNotificationsManager.isPendingNotifications = true;
      model.notify();
    };
  }

  Widget bodyView(BuildContext context) {
    return SafeArea(
      child: Column(
        children: [
          navBar(context),
          contentPayOutCards(context),
          tabBarView(),
        ],
      ),
    );
  }

  //MARK: - Validar si tiene o no payOuts.
  Widget contentPayOutCards(BuildContext context) {
    if (model?.payOuts == null) {
      getPayOuts();
      showLoader();
      return Expanded(
        child: Center(),
      );
    }

    if (model?.payOuts?.isEmpty ?? false) {
      //MARK: - Empty Screen
      return Expanded(
        child: Container(
          margin: EdgeInsets.only(bottom: 16),
          child: HomeEmptyScreen(
            withFilter: model?.isShowEmptyPayoutsWithFilters() ?? false,
            createPayOutClick: () {
              model?.navToCreatePayOut();
            },
            interastedClick: () {
              print("interested tool");
            },
            status: model?.status,
          ),
        ),
      );
    }

    //MARK: - ALL PAYOUTS LIST
    return Expanded(
      child: Container(
        child: HomePayOutListScreen(
          reset: model?.isReset() ?? false,
          payOuts: model?.payOuts ?? [],
          onPayOutSelected: (payOut) {
            model?.navToPayOutDetail(payOut);
          },
          onPaymentComplete: () {
            getPayOuts();
          },
        ),
      ),
    );
  }

  Widget navBar(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 16, bottom: 16, right: 32, left: 32),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          filterIconButton(context),
          profileImageButton(context),
        ],
      ),
    );
  }

  Widget filterIconButton(BuildContext context) {
    return GestureDetector(
      child: Container(
        alignment: Alignment.centerLeft,
        color: Colors.transparent,
        width: 40,
        child: SvgPicture.asset(SVGImage.menu),
      ),
      onTap: () => _showFilterPayotusPopupMenu(context),
    );
  }

  void _showFilterPayotusPopupMenu(BuildContext context) async {
    await showMenu(
      context: context,
      position: RelativeRect.fromLTRB(10, 110, 20, 0),
      items: [
        PopupMenuItem(
          onTap: () {
            getPayoutsWithFilter(null);
          },
          height: 40,
          child: Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 8),
            child: GestureDetector(
              child: Container(
                child: PoppinsText(
                  content: "All",
                  textColor: model?.status == null
                      ? PayPOutColors.PrimaryColor
                      : PayPOutColors.lightGrey,
                ),
              ),
            ),
          ),
        ),
        PopupMenuItem(
          onTap: () {
            getPayoutsWithFilter(PayOut.pengingStatus);
          },
          height: 40,
          child: Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 8),
            child: GestureDetector(
              child: Container(
                child: PoppinsText(
                  content: "Pending",
                  textColor: model?.status == PayOut.pengingStatus
                      ? PayPOutColors.PrimaryColor
                      : PayPOutColors.lightGrey,
                ),
              ),
            ),
          ),
        ),
        PopupMenuItem(
          onTap: () {
            getPayoutsWithFilter(PayOut.progressStatus);
          },
          height: 40,
          child: Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 8),
            child: Container(
              child: PoppinsText(
                content: "In Progress",
                textColor: model?.status == PayOut.progressStatus
                    ? PayPOutColors.PrimaryColor
                    : PayPOutColors.lightGrey,
              ),
            ),
          ),
        ),
        PopupMenuItem(
          onTap: () {
            getPayoutsWithFilter(PayOut.completedStatus);
          },
          height: 40,
          child: Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 8),
            child: Container(
              child: PoppinsText(
                content: "Completed",
                textColor: model?.status == PayOut.completedStatus
                    ? PayPOutColors.PrimaryColor
                    : PayPOutColors.lightGrey,
              ),
            ),
          ),
        ),
        PopupMenuItem(
          onTap: () {
            getPayoutsWithFilter(PayOut.cancelledStatus);
          },
          height: 40,
          child: Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 8),
            child: Container(
              child: PoppinsText(
                content: "Canceled",
                textColor: model?.status == PayOut.cancelledStatus
                    ? PayPOutColors.PrimaryColor
                    : PayPOutColors.lightGrey,
              ),
            ),
          ),
        )
      ],
      elevation: 8.0,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(18.0),
      ),
    );
  }

  void getPayoutsWithFilter(int? status) {
    model?.setFiltersStatus(status);
    getPayOuts();
    Timer(Duration(milliseconds: 50), () {
      showLoader();
    });
  }

  Widget profileImageButton(BuildContext context) {
    return Column(
      children: [
        Visibility(
          visible: false,
          child: Container(
            alignment: Alignment.bottomRight,
            child: Container(
              margin: EdgeInsets.only(left: 30),
              child: CircleAvatar(
                backgroundColor: PayPOutColors.rose,
                radius: 4,
              ),
            ),
          ),
        ),
        GestureDetector(
          onTap: () => model?.navToProfileUser(
              onBackCallback: () => model?.getProfileUser()),
          child: CircleAvatar(
            backgroundColor: Colors.white,
            radius: 22,
            child: CircleAvatar(
              backgroundColor: PayPOutColors.bluePurple,
              radius: 20,
              child: ProfileImage(
                pathProfile: model?.pathProfile,
                onProfileTap: () => model?.navToProfileUser(),
                size: 32,
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget tabBarView() {
    return Container(
      margin: EdgeInsets.only(top: 16),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(1, onClick: (id) {
            isSwitch = false;
            switch (id) {
              case 1: // HOME
                isSwitch = true;
                model?.notify();
                break;
              case 2: // Notificaciones
                model?.navToNotifications();
                break;
              case 3: // Create payout
                showLoader();
                model?.navToCreatePayOut();
                break;
              default:
                break;
            }
            model?.notify();
          })
        ],
      ),
    );
  }

  void getPayOuts() {
    SharedPreferencesManager.get.getUserID().then(
      (userID) {
        model?.getPayouts(
          userID.toString(),
          (payOuts) {
            Timer(Duration(milliseconds: 300), () {
              hideLoader();
            });
            model?.payOuts = payOuts;
            model?.notify();
          },
          (error) {
            hideLoader();
          },
        );
      },
    );
  }
}
