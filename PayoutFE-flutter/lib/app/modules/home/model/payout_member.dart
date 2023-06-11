import 'package:pay_out/app/service/api.dart';
import 'package:collection/collection.dart';

class PayoutMember {
  int? poolID;
  int? poolMemberID;
  int? userID;
  int? poolUserID;
  int? payoutOrder;
  int? moneyGot;
  int? joinStatus;
  int? isOwner;
  int? isInviteByAdmin;
  int? isPaid;
  int? isPayout;
  int? isUserAgreeStatus;
  String? firstName;
  String? lastName;
  int? rating;
  String? profilePicture;
  num? total;
  int? isShared;
  int? isSlave;

  PayoutMember(
      {this.poolMemberID,
      this.userID,
      this.poolUserID,
      this.poolID,
      this.payoutOrder,
      this.moneyGot,
      this.joinStatus,
      this.isOwner,
      this.isInviteByAdmin,
      this.isPaid,
      this.isPayout,
      this.isUserAgreeStatus,
      this.firstName,
      this.lastName,
      this.rating,
      this.profilePicture,
      this.total,
      this.isShared,
      this.isSlave});

  factory PayoutMember.fromJson(Map<String, dynamic> json) {
    return PayoutMember(
      poolMemberID: json['pool_member_id'],
      userID: json['user_id'],
      poolUserID: json['pool_user_id'],
      poolID: json['pool_id'],
      payoutOrder: json['payout_order'],
      moneyGot: json['money_got'],
      joinStatus: json['join_status'],
      isOwner: json['is_owner'],
      isInviteByAdmin: json['is_invite_by_admin'],
      isPaid: json['is_paid'],
      isPayout: json['is_payout'],
      firstName: json['first_name'],
      isUserAgreeStatus: json['user_agree_status'],
      lastName: json['last_name'],
      rating: json['rating'],
      profilePicture: json['profile_picture'],
      total: json['total'],
      isShared: json['is_shared'],
      isSlave: json['is_slave'],
    );
  }

  static const joined = 1;
  static const notJoined = 0;
  static const rejected = 2;

  String? getProfileImage() {
    if (profilePicture != null) {
      return "${API.baseUrlImages}/$profilePicture";
    } else {
      return null;
    }
  }

  String? getSecondProfileImage(List<PayoutMember>? users) {
    if (isShared == 1) {
      final user = users!.firstWhereOrNull((e) =>
          e.isShared == 1 && e.isSlave == 1 && e.payoutOrder == payoutOrder);
      return "${API.baseUrlImages}/${user?.profilePicture}";
    } else {
      return null;
    }
  }

  String? allName() {
    return "$firstName $lastName";
  }

  String? getFirstName(List<PayoutMember>? users) {
    if (isShared == 1) {
      final user = users!.firstWhereOrNull((e) =>
          e.isShared == 1 && e.isSlave == 1 && e.payoutOrder == payoutOrder);
      return "$firstName / ${user?.firstName}";
    } else {
      return "$firstName";
    }
  }

  static List<PayoutMember> toList(Map<String, dynamic> json) {
    List<PayoutMember> members = [];
    if (json.containsKey("memmber_data")) {
      json['memmber_data'].forEach((member) {
        members.add(PayoutMember.fromJson(member));
      });
    }
    return members;
  }
}
