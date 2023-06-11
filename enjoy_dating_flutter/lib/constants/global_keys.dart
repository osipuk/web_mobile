import 'package:flutter/material.dart';

import '../search.dart';
import '../services/incoming_call_screen.dart';


class MyGlobalKeys{


  static final GlobalKey<NavigatorState> navigatorKey = new GlobalKey<NavigatorState>();
  static final GlobalKey<SearchPageState> searchPageKey = new GlobalKey<SearchPageState>();
  static final GlobalKey<IncomingScreenFromNotificationPageState> incomingCallPageKey = new GlobalKey<IncomingScreenFromNotificationPageState>();



}