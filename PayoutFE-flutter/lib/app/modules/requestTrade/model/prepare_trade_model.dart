class PrepareTradeModel {
  final PrepareTradePayOutData payout;
  List<PrepareTradeUserData> userList;

  PrepareTradeModel({
    required this.payout,
    required this.userList,
  });

  factory PrepareTradeModel.fromJson(Map<String, dynamic> json) {
    return PrepareTradeModel(
      payout: PrepareTradePayOutData.fromJson(json['pool']),
      userList: PrepareTradeUserData.toList(json),
    );
  }
}

class PrepareTradePayOutData {
  final int poolID;
  final String poolName;
  final int ownerID;

  PrepareTradePayOutData({
    required this.poolID,
    required this.poolName,
    required this.ownerID,
  });

  factory PrepareTradePayOutData.fromJson(Map<String, dynamic> json) {
    return PrepareTradePayOutData(
      poolID: json['pool_id'],
      poolName: json['pool_name'],
      ownerID: json['owner_id'],
    );
  }
}

class PrepareTradeUserData {
  final String firstName;
  final String lastName;
  final String image;
  final int userID;
  final int payOutOrder;
  final int isPayout;

  PrepareTradeUserData({
    required this.firstName,
    required this.lastName,
    required this.image,
    required this.userID,
    required this.payOutOrder,
    required this.isPayout,
  });

  factory PrepareTradeUserData.fromJson(Map<String, dynamic> json) {
    return PrepareTradeUserData(
      firstName: json['first_name'],
      lastName: json['last_name'],
      image: json['profile_picture'],
      userID: json['user_id'],
      payOutOrder: json['payout_order'],
      isPayout: json['is_payout'],
    );
  }

  String fullName() {
    return "$firstName $lastName";
  }

  static List<PrepareTradeUserData> toList(Map<String, dynamic> json) {
    List<PrepareTradeUserData> users = [];
    json['users'].forEach((user) {
      users.add(PrepareTradeUserData.fromJson(user));
    });
    return users;
  }
}
