import 'dart:convert';
import 'dart:io';
import 'package:dio/dio.dart';
import 'package:http/http.dart' as http;
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/editProfile/model/edit_profile_model.dart';
import 'package:pay_out/app/service/api.dart';

class EditProfileAPI extends API {
  final uploadProfileApi = '${API.baseUrl}/updateUserPhoto';
  final editProfileApi = '${API.baseUrl}/updateUserDetails';
  final editPasswordApi = '${API.baseUrl}/updatePassword';

  Future<GeneralResponse?> uploadProfileImage(EditUser user, int userID) async {
    final api = '$uploadProfileApi/$userID';

    FormData data = FormData.fromMap(
      {
        "profile_image": await MultipartFile.fromFile(
          user.profileImage!.path,
          filename: DateTime.now().toString(), // fileName,
        ),
      },
    );

    final response = await Dio().post(
      api,
      data: data,
      options: Options(
        responseType: ResponseType.json,
        headers: {
          HttpHeaders.authorizationHeader:
              await SharedPreferencesManager.get.authToken(),
        },
      ),
    );

    GeneralResponse responseUser = GeneralResponse.fromJson(response.data);
    return responseUser;
  }

  Future<GeneralResponse> editProfileUser(
      Map<String, dynamic> data, int userID) async {
    final response = await http.post(
      Uri.parse('$editProfileApi/$userID'),
      body: data,
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $editProfileApi');
    }
  }

  Future<GeneralResponse> editPasswordUser(
      String newPass, String oldPass) async {
    final response = await http.post(
      Uri.parse(editPasswordApi),
      body: {
        'current_password': oldPass,
        'new_password': newPass,
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $editProfileApi');
    }
  }
}
