// import 'package:exchange/services/common.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:geocoding/geocoding.dart';

import '../constants/global_data.dart';

Future<Position> determinePosition() async {
  // print('je;;o');
  var position;
  // var address;
  try{
    bool serviceEnabled;
    LocationPermission permission;

    // Test if location services are enabled.
    print('checking location service');
    serviceEnabled = await Geolocator.isLocationServiceEnabled();
    // serviceEnabled =true;
    print('the ser is $serviceEnabled');
    if (!serviceEnabled) {
      // Location services are not enabled don't continue
      // accessing the position and request users of the
      // App to enable the location services.
      print('Error in getting location: Location services are disabled.');
      return Position(longitude: 75.8577, latitude: 22.7196, timestamp: DateTime.now(), accuracy: 10, altitude: 10, heading: 10, speed: 10, speedAccuracy: 10);
      return Future.error('Location services are disabled.');
    }

    permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) {
        // Permissions are denied, next time you could try
        // requesting permissions again (this is also where
        // Android's shouldShowRequestPermissionRationale
        // returned true. According to Android guidelines
        // your App should show an explanatory UI now.
        return Future.error('Location permissions are denied');
      }
    }

    if (permission == LocationPermission.deniedForever) {
      // Permissions are denied forever, handle appropriately.
      return Future.error(
          'Location permissions are permanently denied, we cannot request permissions.');
    }

    // When we reach here, permissions are granted and we can
    // continue accessing the position of the device.
    position =  await Geolocator.getCurrentPosition();
    return  position;
    // lat = position.latitude;
    // lng = position.longitude;
    // List<Placemark> placemarks = await placemarkFromCoordinates(position.latitude, position.longitude);
    // print('address----$placemarks');

  }catch(e){
    // Geolocator.openAppSettings();
    print('Error in getting current location : $e');
    position =  Position(longitude: 75, latitude: 22, timestamp: DateTime.now(), accuracy: 10, altitude: 10, heading: 10, speed: 10, speedAccuracy: 10);
    return position;
  }
}