import 'package:pay_out/app/modules/login/model/user.dart';

class LoginResponse {
  final bool status;
  final String message;
  final String? authToken;
  final User? data;

  LoginResponse(
      {required this.status, required this.message, this.authToken, this.data});

  factory LoginResponse.fromJson(Map<String, dynamic> json) {
    return LoginResponse(
        status: json['status'],
        message: json['message'],
        authToken: json['authToken'],
        data: (json['data'] is List<dynamic> ||
                json['data'] == null ||
                json['data'] is String)
            ? User()
            : User.fromJson(json['data']));
  }
}
