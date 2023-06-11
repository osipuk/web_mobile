// ignore_for_file: test_types_in_equals

import 'package:floor/floor.dart';
import 'package:pay_out/app/service/api.dart';

@entity
class User {
  @primaryKey
  int? id;
  String? firstName;
  String? lastName;
  String? email;
  String? userName;
  String? phone;
  String? dateOfBirth;
  String? password;
  String? socialID;
  String? profilePicture;
  int? deviceType;
  String? deviceToken;
  double? latitude;
  double? longitude;
  int? rating;
  String? stripeCustomerID;
  String? stripeBankAccountID;
  String? stripeConnectAccountID;
  int? numberVerify;
  int? emailVerify;
  int? bankVerify;
  int? accountVerify;
  int? stripeConnectAccount;
  int? subscribed;
  int? accountDeleted;
  int? totalSuccessPool;
  int? totalSaving;
  int? historyID;
  int? planID;
  String? planName;
  int? planAmount;
  int? planDuration;
  bool? registered;

  User({
    this.id,
    this.firstName,
    this.lastName,
    this.email,
    this.userName,
    this.phone,
    this.dateOfBirth,
    this.password,
    this.socialID,
    this.profilePicture,
    this.deviceType,
    this.deviceToken,
    this.latitude,
    this.longitude,
    this.rating,
    this.stripeCustomerID,
    this.stripeBankAccountID,
    this.stripeConnectAccountID,
    this.numberVerify,
    this.emailVerify,
    this.bankVerify,
    this.accountVerify,
    this.stripeConnectAccount,
    this.subscribed,
    this.accountDeleted,
    this.totalSuccessPool,
    this.totalSaving,
    this.historyID,
    this.planID,
    this.planName,
    this.planAmount,
    this.planDuration,
    this.registered,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      firstName: json['first_name'],
      lastName: json['last_name'],
      email: json['email'],
      userName: json['user_name'],
      phone: json['mobile_number'],
      dateOfBirth: json['date_of_birth'],
      password: json['password'],
      socialID: json['social_id'],
      profilePicture: json['profile_picture'],
      deviceType: json['device_type'],
      deviceToken: json['device_token'],
      // latitude: json['latitude'],
      // longitude: json['longitude'],
      rating: json['rating'],
      stripeCustomerID: json['stripe_customer_id'],
      stripeBankAccountID: json['stripe_bank_account_id'],
      stripeConnectAccountID: json['stripe_connected_account_id'],
      numberVerify: json['is_mobile_number_verify'],
      emailVerify: json['is_email_verify'],
      bankVerify: json['is_bank_account_verify'],
      stripeConnectAccount: json['is_stripe_connected_account'],
      accountVerify: json['is_account_active'],
      subscribed: json['is_subscribed'],
      accountDeleted: json['is_account_deleted'],
      totalSuccessPool: json['total_success_pool'],
      totalSaving: json['total_saving'],
      historyID: json['history_id'],
      planID: json['plan_id'],
      planName: json['plan_name'],
      planAmount: json['plan_amount'],
      planDuration: json['plan_duration'],
      registered: json['registered'],
    );
  }

  static List<User> toList(Map<String, dynamic> json) {
    List<User> users = [];
    json['data'].forEach((faq) {
      users.add(User.fromJson(faq));
    });
    return users;
  }

  Map<String, dynamic> toMap() {
    return {
      'first_name': firstName,
      'last_name': lastName,
      'email': email,
      'user_name': userName,
      'mobile_number': phone,
      'date_of_birth': dateOfBirth,
      'password': password,
      'social_id': socialID,
      'profile_picture': profilePicture,
      'device_type': deviceType,
      'device_token': deviceToken,
      'latitude': latitude,
      'longitude': longitude,
      'is_mobile_number_verify': numberVerify,
      'is_email_verify': emailVerify,
      'is_bank_account_verify': bankVerify,
      'is_account_active': accountVerify,
    };
  }

  String fullName() {
    return "$firstName $lastName";
  }

  String? getProfileImage() {
    if (profilePicture != null) {
      return "${API.baseUrlImages}/$profilePicture";
    } else {
      return "${API.baseUrlImages}/defult_ads_image.png";
    }
  }

  @override
  bool operator ==(Object other) {
    return id == (other as User).id;
  }

  @override
  int get hashCode => id.hashCode;

  //Constantes
  static const DEVICE_TOKEN = "device_token";
}

@dao
abstract class UserAdb {
  @Query('SELECT * FROM User')
  Future<List<User>> findAllUsers();

  @Query('SELECT * FROM User WHERE id = :id')
  Stream<User?> findUserById(int id);

  @insert
  Future<void> insertUser(User? user);

  @Query('DELETE FROM User')
  Future<void> deleteAllUsers();
}
