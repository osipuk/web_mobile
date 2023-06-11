import 'package:pay_out/app/modules/login/model/user.dart';

class ProfileResponse {
  final bool status;
  final String message;
  final User? data;

  ProfileResponse({required this.status, required this.message, this.data});

  factory ProfileResponse.fromJson(Map<String, dynamic> json) {
    return ProfileResponse(
      status: json['status'],
      message: json['message'],
      data: (json['data'] is List<dynamic> ||
              json['data'] == null ||
              json['data'] is String)
          ? User()
          : User.fromJson(json['data']),
    );
  }
}
