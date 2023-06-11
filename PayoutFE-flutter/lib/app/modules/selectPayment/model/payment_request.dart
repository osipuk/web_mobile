class PaymentRequest {
  final int? poolID;
  final int? type;
  final int? payer;
  final int? payed;
  final double? amount;

  PaymentRequest({
    required this.poolID,
    required this.type,
    required this.payer,
    required this.payed,
    required this.amount,
  });

  static const CASH = 1;
  static const VENMO = 2;

  Map<String, String> toMap() {
    return {
      'type': type.toString(),
      'pool_id': poolID.toString(),
      'payer': payer.toString(),
      'payed': payed.toString(),
      'amount': amount.toString(),
    };
  }
}
