import 'dart:convert';

import 'package:http/http.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../constants/global_data.dart';
import '../modals/user_modal.dart';
late SharedPreferences sharedPreferences;


class MyLocalServices{
  static updateUserData(Map<String, dynamic> data){
    sharedPreferences.setString('user_details',jsonEncode(data));
    userData = UserModal.fromJson(data);
  }

  static Future<void> updateUserDataFromServer({required String userId, required String apiUrl, String responseParameterName = 'data'})async{

    var request = {
      'id': userId,
      'user_id': userId,
    };
    try{
      var response = await post(Uri.parse(apiUrl), body: request);
      if (response.statusCode == 200) {
        var jsonResponse = jsonDecode(response.body);
        updateUserData(jsonResponse['$responseParameterName']);
      } else {
        try {
          // showSnackbar(MyGlobalKeys.navigatorKey.currentContext!,
          //     'Error in updating user details');
        } catch (e) {
          print('Error in catch block localServices ec1 $e');
        }
      }
    }catch(e){
      print('Error in catch block localServices ec2 $e');
    }
  }
}