// ignore_for_file: must_be_immutable

import 'dart:async';

import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/modules/splash/viewModel/splash_view_model.dart';
import 'package:stacked/stacked.dart';

class SplashScreen extends GeneralScreen {
  SplashScreen({
    VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<SplashScreenViewModel>.reactive(
      builder: (context, model, child) => generalView(context),
      viewModelBuilder: () => SplashScreenViewModel(context),
      onModelReady: (model) => this.initView(context, model),
    );
  }

  @override
  Widget bodyBackground(BuildContext context) {
    return Container();
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return Center();
  }

  void initView(BuildContext context, SplashScreenViewModel model) {
    //Timer para espera de inicializacion de Main.dart (Firebase y demas)
    Timer(Duration(seconds: 2), () {
      PushNotificationsManager.get.onClickedNotification = (not) {
        model.navToNotifications();
      };
    });

    model.navToInitRoute(context);
  }
}
