import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';
import 'package:stacked_services/stacked_services.dart';
import 'app/general/locator/locator.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:load/load.dart';

void main() {
  //enableFlutterDriverExtension();
  initMainApp();
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    title: 'Navigation Basics',
    home: MyApp(),
  ));
}

void initMainApp() {
  WidgetsFlutterBinding.ensureInitialized();

  setFirebase();
  setupLocator();
}

void setFirebase() async {
  await Firebase.initializeApp();
  PushNotificationsManager.get.requestPermissions();
  PushNotificationsManager.get.onCallbackNewMessageListener();
}

final globalScaffoldKey = GlobalKey<ScaffoldState>();

class MyApp extends StatelessWidget with WidgetsBindingObserver {
  @override
  Widget build(BuildContext context) {
    WidgetsBinding.instance?.addObserver(this);
    Get.testMode = true;

    return Material(
      type: MaterialType.transparency,
      child: Scaffold(
        key: globalScaffoldKey,
        resizeToAvoidBottomInset: false,
        body: LoadingProvider(
          themeData: LoadingThemeData(),
          child: GetMaterialApp.router(
            debugShowCheckedModeBanner: false,
            routerDelegate: AppRouter().delegate(
              initialRoutes: [
                SplashScreenRoute(),
              ],
            ),
            routeInformationParser: AppRouter().defaultRouteParser(),
            title: 'Pay Out',
            theme: ThemeData(
              visualDensity: VisualDensity.adaptivePlatformDensity,
            ),
          ),
          loadingWidgetBuilder: (ctx, data) {
            return Container(
              key: Key('loadingWidgetBuilder'),
              color: PayPOutColors.PrimaryColor,
              height: MediaQuery.of(ctx).size.height,
              width: MediaQuery.of(ctx).size.width,
              child: Center(
                child: Container(
                  height: 50,
                  width: 50,
                  child: CircularProgressIndicator(
                    backgroundColor:
                        PayPOutColors.PrimaryColor.withOpacity(0.5),
                    strokeWidth: 2,
                    valueColor: AlwaysStoppedAnimation<Color>(
                      Colors.white,
                    ),
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }

  // @override
  void didChangeMetrics() {
    super.didChangeMetrics();
    delay(Duration(seconds: 2), () {
      final value = WidgetsBinding.instance?.window.viewInsets.bottom;
      if (value == 0) {
        hideKeyboard();
      }
      StatelessExtension.isShowKeyboard = value != 0;
    });
  }

  void dispose() {
    WidgetsBinding.instance?.removeObserver(this);
  }
}
