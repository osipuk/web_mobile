import 'package:pay_out/app/modules/login/model/user.dart';

class SearchUsersResponse {
  final bool status;
  final String message;
  final int totalRecords;
  final List<User>? data;

  SearchUsersResponse(
      {required this.status,
      required this.message,
      this.data,
      required this.totalRecords});

  factory SearchUsersResponse.fromJson(Map<String, dynamic> json) {
    print(json);
    return SearchUsersResponse(
      status: json['status'],
      message: json['message'],
      totalRecords: json['totalRecords'],
      data: User.toList(
        json,
      ),
    );
  }
}
