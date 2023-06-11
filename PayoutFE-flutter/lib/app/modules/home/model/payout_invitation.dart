import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

class PayOut {
  final int poolID;
  int? poolMemberID = 0;
  int? payOutOrder = 0;
  int? userID;
  int? poolUserID = 0;
  int? noOfDeductionOrMembers = 0;
  String? poolName;
  num? amountPerDeduction = 0;
  int? deductionPeriod = 0;
  num? totalAmount = 0;
  String? startDate = "";
  String? endDate = "";
  String? firstName = "";
  String? lastName = "";
  int? reasonID = 0;
  String? reason = "";
  int? poolType = 0;
  int? orderType = 0;
  int? poolStatus = 0;
  int? poolInclude = 0;
  int? isDeleted = 0;
  int? userToPay;
  List<PayoutMember>? members = [];

  PayOut(
    this.poolID, {
    this.poolMemberID,
    this.userID,
    this.poolName,
    this.poolUserID,
    this.amountPerDeduction,
    this.payOutOrder,
    this.deductionPeriod,
    this.totalAmount,
    this.startDate,
    this.endDate,
    this.firstName,
    this.lastName,
    this.noOfDeductionOrMembers,
    this.reasonID,
    this.reason,
    this.poolType,
    this.orderType,
    this.poolStatus,
    this.poolInclude,
    this.isDeleted,
    this.userToPay,
    this.members,
  });

  static const pengingStatus = 0;
  static const progressStatus = 1;
  static const completedStatus = 2;
  static const cancelledStatus = -1;

  static const ACCEPTED_INVITATION = 1;
  static const DECLINE_INVITATION = 2;
  static const LEAVE_INVITATION = -1;

  static const INVITED_REQUEST = 1;
  static const WANTS_TO_JOIN_REQUEST = 2;
  static const WANTS_TO_SWAP_REQUEST = 3;
  static const WANTS_TO_REPLACE_REQUEST = 4;
  static const PROMISORY_REQUEST = 4;

  static const DELETE_PAYOUT = 1;

  factory PayOut.fromJson(Map<String, dynamic> json) {
    return PayOut(
      json['pool_id'] ?? 0,
      poolMemberID: json['pool_member_id'] ?? 0,
      userID: json['user_id'] ?? 0,
      poolName: json['pool_name'] ?? "",
      poolUserID: json['pool_user_id'] ?? 0,
      payOutOrder: json['payout_order'] ?? 0,
      amountPerDeduction: json['amount_per_deduction'] ?? 0,
      deductionPeriod: json['deduction_period'] ?? 0,
      totalAmount: json['total_amount'] ?? 0,
      startDate: json['start_date'] ?? "",
      endDate: json['end_date'] ?? "",
      firstName: json['first_name'] ?? "",
      lastName: json['last_name'] ?? "",
      noOfDeductionOrMembers: json['no_of_deduction_or_members'] ?? 0,
      reasonID: json['reason_id'] ?? 0,
      reason: json['reason'] ?? "",
      poolType: json['pool_type'] ?? 0,
      orderType: json['order_type'] ?? 0,
      poolStatus: json['pool_status'] ?? 0,
      poolInclude: json['pool_include'] ?? 0,
      isDeleted: json['is_deleted'] ?? 0,
      userToPay: json['user_to_pay'],
      members: PayoutMember.toList(json),
    );
  }

  static List<PayOut> toList(Map<String, dynamic> json) {
    List<PayOut> payOuts = [];
    json['data'].forEach((payOut) {
      payOuts.add(PayOut.fromJson(payOut));
    });
    return payOuts;
  }

  int currentMonth() {
    var a = startDate?.date();
    DateTime now = DateTime.now();
    DateTime b = new DateTime(now.year, now.month, now.day, 23, 59, 0);
    var diff = b.difference(a!);
    var currentMonth = diff.isNegative ? 1 : b.difference(a).getMonths();
    return (currentMonth <= 0) ? 1 : currentMonth;
  }

  int totalMonth() {
    var a = startDate?.date() ?? DateTime.now();
    var b = endDate?.date();
    var currentMonth = b?.difference(a).getMonths() ?? 1;
    return (currentMonth == 0) ? 1 : currentMonth;
  }

  DateTime nextPaymentDate() {
    var aStart = startDate?.date() ?? DateTime.now();
    DateTime a = DateTime(aStart.year, aStart.month, aStart.day);
    DateTime now = new DateTime.now();
    DateTime b = new DateTime(now.year, now.month, now.day);
    int? days = a.difference(b).getDays();

    int monthsDiff = (a.difference(b).getDays() / 30).round();
    int monthToAdd = monthsDiff < 0
        ? monthsDiff * -1
        : days < 0
            ? monthsDiff + 1
            : monthsDiff;

    return days >= 1
        ? a
        : DateTime(aStart.year, a.addMonths(monthToAdd).month, aStart.day);
  }

  String nextPaymentDateInDays() {
    var aStart = startDate?.date() ?? DateTime.now();
    DateTime a = DateTime(aStart.year, aStart.month, aStart.day);
    DateTime now = new DateTime.now();
    DateTime b = new DateTime(now.year, now.month, now.day);

    int? days = a.difference(b).getDays();
    int monthsDiff = (a.difference(b).getDays() / 30).round();
    int monthToAdd = monthsDiff < 0
        ? monthsDiff * -1
        : days < 0
            ? monthsDiff + 1
            : monthsDiff;
    int? furuteDays = a.addMonths(monthToAdd).difference(b).getDays();

    return monthsDiff > 0
        ? "$monthsDiff Months "
        : furuteDays <= 0
            ? "Today"
            : furuteDays == 1
                ? "Tomorrow"
                : "$furuteDays Days";
  }

  DateTime nextPaymentDateWithMember(PayoutMember? member) {
    var aStart = startDate?.date() ?? DateTime.now();
    DateTime a = DateTime(aStart.year, aStart.month, 1);

    print(a);

    final position = (member?.payoutOrder ?? 1) - 1;
    final newDate =
        DateTime(aStart.year, a.addMonths(position).month, aStart.day);
    print(newDate);
    return newDate;
  }

  String totalToUserPayment() {
    return ((totalAmount ?? 0) - (amountPerDeduction ?? 0)).toCurrency();
  }
}

extension DurationExtensions on Duration {
  int getMonths() {
    final years = this.inDays ~/ 365;
    final months = (this.inDays % 365) ~/ 30;
    print(this.inDays % 365);
    return months + (years * 12);
  }

  int getDays() {
    return this.inDays;
  }
}
