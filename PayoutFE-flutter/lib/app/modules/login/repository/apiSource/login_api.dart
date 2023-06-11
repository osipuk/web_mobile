import 'dart:convert';
import 'dart:io';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/login/model/login_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class LoginAPI extends API {
  final loginUserApi = '${API.baseUrl}/login';
  final loginSocialUserApi = '${API.baseUrl}/loginViaSocial';
  final forgotPasswordApi = '${API.baseUrl}/forgotPassword';

  Future<LoginResponse> loginUser(String email, String password) async {
    final response = await http.post(
      Uri.parse(loginUserApi),
      body: {
        'email': email,
        'password': password,
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        "AuthorizationType": "jwt"
      },
    );

    if (response.statusCode == 200) {
      LoginResponse responseUser =
          LoginResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $loginUserApi');
    }
  }

  Future<LoginResponse> loginSocialUser(String socialID) async {
    String bearer = await FirebaseAuth.instance.currentUser!.getIdToken();

    final response = await http.post(
      Uri.parse(loginSocialUserApi),
      body: {
        'social_id': socialID,
        'token': bearer,
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
        "AuthorizationType": "jwt"
      },
    );

    if (response.statusCode == 200) {
      LoginResponse responseUser =
          LoginResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $loginUserApi');
    }
  }

  Future<GeneralResponse> forgotPassword(String email) async {
    final response = await http.post(
      Uri.parse(forgotPasswordApi),
      body: {'email': email},
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $forgotPasswordApi');
    }
  }
}
