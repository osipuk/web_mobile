import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'package:pay_out/app/service/api.dart';

class RegisterAPI extends API {
  final registerUserApi = '${API.baseUrl}/createUser';
  final registerSocialUserApi = '${API.baseUrl}/createUserViaSocial';
  final sendCodeApi = '${API.baseUrl}/sendOTP';
  final verifyCodeApi = '${API.baseUrl}/verifyOTP';
  final uploadPhotoApi = '${API.baseUrl}/uploadPhotoId';
  final activeRegisterUserApi = '${API.baseUrl}/updateUserDetails';

  Future<RegisterResponse> registerUser(
      Register register, bool isSocial) async {
    final api = isSocial ? registerSocialUserApi : registerUserApi;

    var request = http.MultipartRequest("POST", Uri.parse(api));
    request.fields.addAll(register.toMap());

    var multipartFile = await register.getFiles();
    if (multipartFile != null) {
      request.files.add(multipartFile);
    }

    final response = await request.send();
    final value = await response.stream.transform(utf8.decoder).first;

    if (response.statusCode == 200) {
      RegisterResponse responseUser =
          RegisterResponse.fromJson(jsonDecode(value));
      return responseUser;
    } else {
      throw Exception('API ERROR: $registerUserApi');
    }
  }

  Future<GeneralResponse> sendSMSCode(String number) async {
    final response = await http.post(
      Uri.parse(sendCodeApi),
      body: {'mobile_number': number},
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $sendCodeApi');
    }
  }

  Future<GeneralResponse> verifySMSCode(
      int idUser, String code, String number) async {
    final response = await http.post(
      Uri.parse('$verifyCodeApi/$idUser'),
      body: {'mobile_number': number, 'otp': code},
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $verifyCodeApi');
    }
  }

  Future<GeneralResponse> activeRegisterUser(int userID) async {
    final response = await http.post(
      Uri.parse('$activeRegisterUserApi/$userID'),
      body: {
        "is_account_active": "1",
        "is_bank_account_verify": "1",
        "is_stripe_connected_account": "1",
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
      throw Exception('API ERROR: $activeRegisterUserApi');
    }
  }
}
