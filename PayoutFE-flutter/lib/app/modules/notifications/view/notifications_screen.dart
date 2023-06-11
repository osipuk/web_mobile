// ignore_for_file: must_be_immutable
import 'package:flutter/material.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_html_text.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/notifications/model/Notification_model.dart';
import 'package:pay_out/app/modules/notifications/viewModel/notification_view_model.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';

class NotificationScreen extends GeneralScreen {
  NotificationScreenViewModel? model;

  var _controller = ScrollController();
  var _isTop = true;
  double _notificationsListHeigth = 0;

  NotificationScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam this.notificationLoaded,
  }) : super(onBackCallback);

  List<NotificationModel>? notificationLoaded;

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<NotificationScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => NotificationScreenViewModel(context),
        onModelReady: (model) => this.onModelReady(context, model));
  }

  ///MARK: Inicializador de vista - vista modelo
  void onModelReady(
      BuildContext context, NotificationScreenViewModel model) async {
    PushNotificationsManager.isPendingNotifications = false;
    _isTop = model.items.isNotEmpty;
    _controller.addListener(() {
      if (_controller.position.atEdge) {
        _isTop = _controller.position.pixels == 0;
        model.notify();
      }
    });

    // Primera llamada de notificaciones
    _getNotifications(context, model);
    PushNotificationsManager.get.onClickedNotificationInCenter = (not) {
      // Llamada de notificaciones al clickear
      PushNotificationsManager.isPendingNotifications = false;
      _getNotifications(context, model);
    };

    PushNotificationsManager.get.onArriveNotification = () {
      PushNotificationsManager.isPendingNotifications = true;
      model.notify();
    };
  }

  void _getNotifications(
      BuildContext context, NotificationScreenViewModel model) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    if (notificationLoaded == null) {
      model.getNotifications(userID.toString(), () {
        model.notify();
      }, (error) => {model.showErrorDialog(context, "Error", error)});
    } else {
      model.setNotifications(notificationLoaded!);
      model.notify();
    }
  }

  Widget builderView(BuildContext context, NotificationScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return Container(
      height: 50,
      padding: EdgeInsets.only(left: 16, bottom: 8),
      alignment: Alignment.bottomLeft,
      child: Row(
        children: <Widget>[
          IconButton(
            icon: Icon(Icons.arrow_back, color: Colors.white),
            onPressed: () => onBackPressed(context),
          )
        ],
      ),
    );
  }

  Widget generalChidView(BuildContext context) {
    return Stack(
      alignment: Alignment.bottomCenter,
      children: [
        tabBarView(),
        bodyBackground(context),
        separatorTabbar(),
      ],
    );
  }

  @override
  Widget bodyBackground(BuildContext context) {
    return SingleChildScrollView(
      controller: _controller,
      child: Column(
        children: <Widget>[
          SafeArea(
            child: Container(
              width: MediaQuery.of(context).size.width,
              padding: EdgeInsets.only(right: 16, left: 16, top: 16),
              margin: marginBottomBody(),
              child: onBodyScrollView(context),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: borderBottomBody(),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.1),
                    spreadRadius: 3,
                    blurRadius: 60,
                    offset: Offset(0, -5),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  @override
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(right: 21, left: 21, top: 64, bottom: 127);
  }

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(30));
  }

  @override
  Widget onBodyScrollView(BuildContext context) {
    final nots = model?.items ?? [];
    final emptyNotifications = nots.isEmpty;
    final emptyNewNotifications = model?.newNotifications.isEmpty ?? false;
    final emptyOldNotifications = model?.oldNotifications.isEmpty ?? false;

    final isLoaded = model?.load ?? false;
    final isshowedList = model?.showedList ?? false;

    print(nots);

    return AnimatedSize(
      duration: Duration(milliseconds: 1000),
      curve: Curves.decelerate,
      child: Container(
        height: _getScrollHeigth(context, isLoaded, emptyNotifications),
        child: Wrap(
          children: [
            headerView(context),
            if (!isLoaded || !isshowedList) loadNotifications(context),
            if (isLoaded && emptyNotifications)
              emptyNotificationAlertWidget(context),
            if (!emptyNewNotifications) newNotificationsList(),
            if (!emptyNewNotifications && !emptyOldNotifications)
              separateNotificationLists(),
            if (!emptyOldNotifications) notificationsList(),
          ],
        ),
      ),
    );
  }

  double _getScrollHeigth(
      BuildContext context, bool isLoaded, bool emptyNotifications) {
    final minHeigth = MediaQuery.of(context).size.height / 1.625;
    final listHeigth = _notificationsListHeigth + 120;

    return !isLoaded
        ? minHeigth
        : emptyNotifications
            ? minHeigth
            : _notificationsListHeigth == 0
                ? minHeigth
                : listHeigth < minHeigth
                    ? minHeigth
                    : listHeigth;
  }

  Widget loadNotifications(BuildContext context) {
    return Center(
      child: SizedBox(
        height: MediaQuery.of(context).size.height / 2,
        child: Center(
          child: CircularProgressIndicator(
            backgroundColor: PayPOutColors.PrimaryColor.withOpacity(0.5),
            strokeWidth: 2,
            valueColor: AlwaysStoppedAnimation<Color>(
              Colors.white,
            ),
          ),
        ),
      ),
    );
  }

  Widget notificationsList() {
    return MeasuredSize(
      onChange: (size) {
        if (model?.canOldChangeHeigth ?? false) {
          model?.canOldChangeHeigth = false;
          _notificationsListHeigth += (size.height);
          model?.notify();
        }
      },
      child: Padding(
        padding: const EdgeInsets.only(bottom: 24),
        child: ListView.builder(
          physics: NeverScrollableScrollPhysics(),
          itemCount: model?.oldNotifications.length,
          primary: false,
          shrinkWrap: true,
          itemBuilder: (context, index) {
            final not = model?.oldNotifications[index];
            return notificationCard(not);
          },
        ),
      ),
    );
  }

  Widget newNotificationsList() {
    return MeasuredSize(
      onChange: (size) {
        if (model?.canNewChangeHeigth ?? false) {
          model?.canNewChangeHeigth = false;
          _notificationsListHeigth += (size.height);
          model?.notify();
        }
      },
      child: Padding(
        padding: const EdgeInsets.symmetric(vertical: 4),
        child: ListView.builder(
          physics: NeverScrollableScrollPhysics(),
          itemCount: model?.newNotifications.length,
          primary: false,
          shrinkWrap: true,
          itemBuilder: (context, index) {
            final not = model?.newNotifications[index];
            return notificationCard(not, newNot: true);
          },
        ),
      ),
    );
  }

  Widget notificationCard(
    NotificationModel? notification, {
    bool newNot = false,
  }) {
    double _heigth = 100;
    final isShowedList = model?.showedList ?? false;
    return GestureDetector(
      onTap: () => model?.notificationActionFlow(notification),
      child: MeasuredSize(
        onChange: (size) {
          _heigth = size.height;
        },
        child: Container(
          margin: EdgeInsets.symmetric(vertical: 8, horizontal: 2),
          height: _heigth,
          decoration: BoxDecoration(
            color: isShowedList ? Colors.white : Colors.transparent,
            borderRadius: BorderRadius.all(Radius.circular(15)),
            border: Border.all(
              color: isShowedList
                  ? newNot
                      ? PayPOutColors.PrimaryColor
                      : Colors.white
                  : Colors.transparent,
            ),
            boxShadow: [
              BoxShadow(
                color: isShowedList
                    ? Colors.black.withOpacity(0.05)
                    : Colors.transparent,
                spreadRadius: 0.5,
                blurRadius: 5,
                offset: Offset(0, 8), // changes position of shadow
              ),
            ],
          ),
          child: Visibility(
            visible: isShowedList,
            child: Padding(
              padding: EdgeInsets.symmetric(horizontal: 16),
              child: Row(
                children: [
                  Padding(
                    padding: const EdgeInsets.only(right: 8, bottom: 32),
                    child: Image.network(
                      notification?.icon ?? '',
                      height: 30,
                      width: 25,
                    ),
                  ),
                  Expanded(
                    child: PoppinsHtmlText(
                      content: notification?.content,
                    ),
                  ),
                  Padding(
                    padding: EdgeInsets.only(top: 8),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      crossAxisAlignment: CrossAxisAlignment.end,
                      children: [
                        PoppinsText(
                          content: model?.dateToNotifications(notification),
                          fontSize: 10,
                          textColor: newNot
                              ? PayPOutColors.PrimaryColor
                              : PayPOutColors.lightGrey,
                        ),
                        Expanded(
                          child: Icon(
                            Icons.arrow_forward_ios,
                            color: newNot
                                ? PayPOutColors.PrimaryColor
                                : PayPOutColors.lightGrey,
                            size: 20,
                          ),
                        )
                      ],
                    ),
                  )
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  // Separador entre las dos listas
  Widget separateNotificationLists() {
    return SeparateLine();
  }

// Vista cuando no tienen notificaciones
  Widget emptyNotificationAlertWidget(BuildContext context) {
    return Center(
      child: Container(
        height: MediaQuery.of(context).size.height / 2,
        padding: EdgeInsets.only(bottom: 120),
        child: Center(
          child: PoppinsText(
            align: TextAlign.center,
            content:
                'You don\'t have any notifications.\nStart by creating a Payout',
          ),
        ),
      ),
    );
  }

//MARK: Header and footer -----
  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 32, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Notifications',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
      ],
    );
  }

  Widget separatorTabbar() {
    return Visibility(
      visible: !_isTop,
      child: Container(
        height: 150,
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
                model?.notify();
              },
              child: Container(
                width: 60,
                color: Colors.transparent,
              ),
            ),
            GestureDetector(
              onTap: () {
                model?.navToCreatePayOut();
              },
              child: Container(
                width: 60,
                color: Colors.transparent,
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget tabBarView() {
    return Container(
      padding: EdgeInsets.only(
        top: 32,
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(2, onClick: (id) {
            switch (id) {
              case 1: // HOME
                model?.navToPayOutHome();
                break;
              case 2: // Notificaciones
                break;
              case 3: // Create payout
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

  @override
  void onBackPressed(BuildContext context) {
    super.onBackPressed(context);
    model?.back();
  }
}
