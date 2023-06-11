import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/profile/model/profile_response.dart';
import 'package:pay_out/app/modules/profile/model/search_users_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class ProfileAPI extends API {
  final getProfileUserApi = '${API.baseUrl}/getUserDetails';
  final postSearchUsersApi = '${API.baseUrl}/searchUser';

  Future<ProfileResponse> getProfileUserDetail(String userID) async {
    final response = await http.get(
      Uri.parse('$getProfileUserApi/$userID'),
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      ProfileResponse responseUser =
          ProfileResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getProfileUserApi');
    }
  }

  Future<SearchUsersResponse> postSearchUsers(
    String userID,
    String query,
  ) async {
    final response = await http.post(
      Uri.parse('$postSearchUsersApi/$userID'),
      body: {
        "search_key": query,
        "page_no": "1",
        "latitude": "0.0",
        "longitude": "0.0"
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      SearchUsersResponse responseUser =
          SearchUsersResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $postSearchUsers');
    }
  }
}
