
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

import '../services/alert.dart';

class Address {
  String country;
  String city;
  String state;
  double latitude;
  double longitude;
  String formattedAddress;
  String route;
  String zipcode;
  Address(
      {required this.country,
      required this.city,
      required this.state,
      required this.latitude,
      required this.longitude,
      required this.formattedAddress,
      required this.route,
      required this.zipcode});
}

Future<Address> getAddress(String placeId, String googleApiKey) async {
  Map<String, dynamic> result = await getFunction(
    body: {
      'place_id': placeId,
      'key': googleApiKey,
    },
    endPoint: 'https://maps.googleapis.com/maps/api/place/details/json',
    errorAlert: false,
    successAlert: false,
  );
  String city = '';
  String country = '';
  String state = '';
  String route = '';
  String zipcode = '';
  (result['result']['address_components'] as List).forEach((addressComponent) {
    if ((addressComponent['types'] as List).contains('locality')) {
      city = addressComponent['long_name'];
    }
    if ((addressComponent['types'] as List)
        .contains('administrative_area_level_1')) {
      state = addressComponent['long_name'];
    }
    if ((addressComponent['types'] as List).contains('country')) {
      country = addressComponent['long_name'];
    }
    if ((addressComponent['types'] as List).contains('route')) {
      route = addressComponent['long_name'];
    }
    if ((addressComponent['types'] as List).contains('route')) {
      route = addressComponent['long_name'];
    }
    if ((addressComponent['types'] as List).contains('postal_code')) {
      zipcode = addressComponent['long_name'];
    }
  });

  double latitude = result['result']['geometry']['location']['lat'];
  double longitude = result['result']['geometry']['location']['lng'];
  String address = result['result']['formatted_address'];

  return Address(
      country: country,
      city: city,
      state: state,
      latitude: latitude,
      longitude: longitude,
      formattedAddress: address,
      route: route,
      zipcode: zipcode);
}

Future<Map<String, dynamic>> getFunction(
    {required Map<String, dynamic> body,
    required String endPoint,
    bool successAlert = false,
    bool errorAlert = true}) async {
  var str = "?";
  body.forEach((key, value) {
    str = str + key + "=" + value + "&";

// request.fields[key]=value;
// print(value2);
  });

  str = str + "m=1";
  var url = Uri.parse(endPoint + str);
  final response = await http.get(url);
  if (response.statusCode == 200) {
    var jsonResponse = convert.jsonDecode(response.body);
    print('the data is $jsonResponse');
    if (jsonResponse['status'] == 1) {
      if (successAlert) {
        presentToast(jsonResponse['message']);
      }
    } else {
      if (errorAlert) {
        presentToast(jsonResponse['message']);
      }
    }
    return jsonResponse;
  }
  return {};
}
