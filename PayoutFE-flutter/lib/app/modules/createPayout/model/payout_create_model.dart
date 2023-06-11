import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/modules/login/model/user.dart';

class PayOutCreate {
  String? userID = "";
  String? name;
  String? reason;
  DateTime? initDate;
  DateTime? tempInitDate;
  double? pricePerMember;
  bool? randomOrder;
  bool? isDeduct;
  List<User> inviteUsers = [];
  double servicePrice = 0;

  PayOutCreate({this.name, this.userID});

  factory PayOutCreate.fromJson(Map<String, dynamic> json) {
    return PayOutCreate(name: json['name'], userID: json['id']);
  }

  Map<String, dynamic> toMap() {
    return {
      'user_id': userID ?? "",
      'pool_name': name ?? "",
      'reason': reason ?? "other",
      'start_date': "${initDate?.getDateString("yyyy-MM-dd")}",
      'amount_per_deduction': pricePerMember.toString(),
      'order_type': randomOrder ?? false ? 1.toString() : 2.toString(),
      'pool_include': isDeduct ?? false ? 1.toString() : 2.toString(),
      'no_of_deduction_or_members': inviteUsers.length.toString(),
      'pool_type': 3.toString(),
      'invite_users': getInvites(),
      'deduction_period': 30.toString(),
      'total_amount': totalAmount().toString(),
      'payout_orders': getOrderUsers(),
      'reason_id': 2.toString(),
      if (getNotRegisterInvites().isNotEmpty)
        'unregistered_users': getNotRegisterInvites(),
      if (getNotRegisterInvites().isNotEmpty)
        'unregistered_users_order': getNotRegisterOrderUsers(),
    };
  }

  double subTotalAmount() {
    return (pricePerMember ?? 0) * (inviteUsers.length - 1);
  }

  double serviceChangeAmount() {
    return servicePrice * inviteUsers.length;
  }

  double totalAmount() {
    return ((pricePerMember ?? 0) * inviteUsers.length) + serviceChangeAmount();
  }

  String getInvites() {
    List<int> users = [];
    inviteUsers.where((e) => e.registered != false).forEach((element) {
      if (element.id.toString() != userID) {
        users.add(element.id!);
      }
    });
    return users.join(",");
  }

  String getNotRegisterInvites() {
    List<String> users = [];
    inviteUsers.where((e) => e.registered == false).forEach((element) {
      users.add(element.email!);
    });
    return users.isEmpty ? "" : users.join(",");
  }

  String getOrderUsers() {
    List<int> positions = [];
    var myIndex = inviteUsers
        .indexWhere((e) => e.registered != false && e.id.toString() == userID);
    positions.add(myIndex + 1);

    inviteUsers.asMap().forEach((index, element) {
      if (element.registered != false && element.id.toString() != userID) {
        var newPosition = index + 1;
        if (positions.contains(newPosition)) {
          positions.add(newPosition + 1);
        } else {
          positions.add(newPosition);
        }
      }
    });
    return positions.join(",");
  }

  String getNotRegisterOrderUsers() {
    List<int> positions = [];
    inviteUsers.asMap().forEach((index, element) {
      if ((element.email?.isNotEmpty ?? false) && element.registered == false) {
        var newPosition = index + 1;
        if (positions.contains(newPosition)) {
          positions.add(newPosition + 1);
        } else {
          positions.add(newPosition);
        }
      }
    });
    return positions.join(",");
  }

  DateTime? endDate() {
    return initDate?.addMonths(inviteUsers.length - 1);
  }
}
