class NotificationModel {
  final int id;
  final int type;
  final int poolID;
  final String createdAt;
  final String content;
  final int status;
  final String icon;
  final int? userToPay;
  final int? notificationOwnerID;
  final int? userID;
  final int? request;
  final int? isActive;

  NotificationModel(
      {required this.id,
      required this.type,
      required this.poolID,
      required this.content,
      required this.status,
      required this.icon,
      required this.createdAt,
      this.notificationOwnerID,
      this.userID,
      this.userToPay = 0,
      this.isActive = 0,
      this.request});

  static const SHOW_NOTIFICATION = 0;
  static const NEW_NOTIFICATION = 1;

  static const IS_ACTIVE = 0;

  factory NotificationModel.fromJson(Map<String, dynamic> json) {
    return NotificationModel(
      id: json['id'],
      type: json['type'],
      poolID: json['pool_id'],
      createdAt: json['created_at'],
      content: json['content'],
      status: json['status'],
      icon: json['icon'],
      notificationOwnerID: json['notification_owner'],
      userID: json['user_id'],
      userToPay: json['user_to_pay'] ?? 0,
      request: json['request'] ?? 0,
      isActive: json['is_active'] ?? 0,
    );
  }
}

class NotificationType {
  static const int INVITATION = 1;
  static const int REJECT = 2;
  static const int TIME_TO_PAY = 3;
  static const int TRADE = 4;
  static const int TRADE_ADMIN = 5;
  static const int SPLIT = 6;
}
