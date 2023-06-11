import 'dart:io';
import 'dart:math';
import 'package:floor/floor.dart';
import 'package:path/path.dart';
import 'package:http/http.dart' as http;
import 'package:path_provider/path_provider.dart';

class RegisterResponse {
  final bool status;
  final String message;
  final RegisterID data;

  RegisterResponse(
      {required this.status, required this.message, required this.data});

  factory RegisterResponse.fromJson(Map<String, dynamic> json) {
    return RegisterResponse(
        status: json['status'],
        message: json['message'],
        data: (json['data'] is String)
            ? RegisterID()
            : RegisterID.fromJson(json['data']));
  }
}

@entity
class Register {
  int? id;
  String? firstName;
  String? lastName;
  String? email;
  String? userName;
  String? codePhone;
  String? phone;
  String? dateOfBirth;
  String? password;
  String? socialID;
  int? deviceType = 1;
  String? deviceToken = '';
  double? latitude;
  double? longitude;
  File? profileImage;
  String? city;
  String? state;
  String? address;
  String? postalCode;

  Future<http.MultipartFile?>? getFiles() async {
    if (profileImage?.path.contains("http") ?? false) {
      var file = await urlToFile(profileImage!.path);
      var stream = http.ByteStream(Stream.castFrom(file.openRead()));
      var length = await file.length();

      return http.MultipartFile('profile_image', stream, length,
          filename: basename(profileImage!.path));
    } else {
      if (profileImage != null) {
        var stream = http.ByteStream(Stream.castFrom(profileImage!.openRead()));
        var length = await profileImage?.length();
        return http.MultipartFile('profile_image', stream, length ?? 0,
            filename: basename(profileImage!.path));
      }
      return null;
    }
  }

  Future<File> urlToFile(String imageUrl) async {
    var rng = new Random();
    Directory tempDir = await getTemporaryDirectory();

    String tempPath = tempDir.path;
    File file = new File('$tempPath' + (rng.nextInt(100)).toString() + '.png');
    http.Response response = await http.get(Uri.parse(imageUrl));

    await file.writeAsBytes(response.bodyBytes);
    return file;
  }

  Register(
      {this.id,
      this.firstName,
      this.lastName,
      this.email,
      this.userName,
      this.phone,
      this.dateOfBirth,
      this.password,
      this.socialID,
      this.deviceType,
      this.deviceToken,
      this.latitude,
      this.longitude,
      this.profileImage,
      this.city,
      this.state,
      this.address,
      this.postalCode});

  factory Register.fromJson(Map<String, dynamic> json) {
    return Register(
        firstName: json['first_name'] ?? "",
        lastName: json['last_name'] ?? "",
        userName: json['user_name'] ?? "",
        email: json['email'] ?? "",
        socialID: json['social_id'] ?? "",
        profileImage:
            json['profileImage'] != null ? File(json['profileImage']) : null);
  }

  Map<String, String?> toCreateSocialMap() {
    return {
      'first_name': firstName ?? "",
      'last_name': lastName ?? "",
      'email': email ?? "",
      'user_name': userName ?? "",
      'social_id': socialID ?? "",
      'device_token': deviceToken ?? "",
      'profileImage': profileImage?.path,
    };
  }

  Map<String, String> toMap() {
    return {
      'first_name': firstName ?? "",
      'last_name': lastName ?? "",
      'email': email ?? "",
      'user_name': userName ?? "",
      'mobile_number': (codePhone ?? "") + (phone ?? ""),
      'date_of_birth': dateOfBirth ?? "",
      'password': password ?? "",
      'social_id': socialID ?? "",
      'device_type': deviceType.toString(),
      'device_token': deviceToken ?? "",
      'latitude': latitude.toString(),
      'longitude': longitude.toString(),
    };
  }
}

class RegisterID {
  final int? id;
  RegisterID({this.id});

  factory RegisterID.fromJson(Map<String, dynamic> json) {
    return RegisterID(
      id: json['id'],
    );
  }
}
