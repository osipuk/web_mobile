import 'dart:async';
import 'dart:io';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

class PushNotificationsManager {
  static final get = PushNotificationsManager();

  Function(String?)? onClickedNotification;
  Function(String?)? onClickedNotificationInCenter;
  Function? onArriveNotification;

  static bool isPendingNotifications = false;

  final _fcm = FirebaseMessaging.instance;
  final flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();

  late NotificationSettings permission;

  Future<AuthorizationStatus> requestPermissions() async {
    if (Platform.isIOS) {
      permission = await _fcm.requestPermission();
      return permission.authorizationStatus;
    }
    return AuthorizationStatus.authorized;
  }

  void onCallbackNewMessageListener() {
    _settingsLocalNotifications();
    FirebaseMessaging.onMessage.listen((event) async {
      PushNotificationsManager.isPendingNotifications = true;
      onArriveNotification!();
      await flutterLocalNotificationsPlugin.show(
        0,
        event.notification?.title,
        event.notification?.body,
        getDetails(),
        payload: "",
      );
    });
  }

  Future<String?> getNotificationToken() async {
    await requestPermissions();
    final token = await _fcm.getToken();
    return token;
  }

  ///MARK: - Settings local notifications
  void _settingsLocalNotifications() {
    const initializationSettingsAndroid =
        AndroidInitializationSettings('launch_background');
    final initializationSettingsIOS = IOSInitializationSettings(
        onDidReceiveLocalNotification: onDidReceiveLocalNotification);
    final initializationSettings = InitializationSettings(
      android: initializationSettingsAndroid,
      iOS: initializationSettingsIOS,
    );
    flutterLocalNotificationsPlugin.initialize(
      initializationSettings,
      onSelectNotification: (not) {
        onClickedNotification!(not);
        onClickedNotificationInCenter!(not);
      },
    );
  }

  NotificationDetails? getDetails() {
    const AndroidNotificationDetails androidPlatformChannelSpecifics =
        AndroidNotificationDetails(
      '1',
      'main',
      channelDescription: 'main channel',
      //sound: RawResourceAndroidNotificationSound('slow_spring_board'),
    );
    const IOSNotificationDetails iOSPlatformChannelSpecifics =
        IOSNotificationDetails();
    // IOSNotificationDetails(sound: 'slow_spring_board.aiff');
    return NotificationDetails(
      android: androidPlatformChannelSpecifics,
      iOS: iOSPlatformChannelSpecifics,
    );
  }

  void onDidReceiveLocalNotification(
      int id, String? title, String? body, String? payload) async {
    print('onDidReceiveLocalNotification');
  }
}
