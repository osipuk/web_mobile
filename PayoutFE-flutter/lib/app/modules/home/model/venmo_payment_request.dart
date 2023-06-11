class VenmoPaymentRequest {
  final String accessToken; //API.venmoAccesTk;
  final String amount;
  final String note;

  String? userName;
  String? email;
  String? phone;

  VenmoPaymentRequest.byEmail({
    required this.accessToken,
    required this.amount,
    required this.email,
    required this.note,
  });

  VenmoPaymentRequest.byUserName({
    required this.accessToken,
    required this.amount,
    required this.userName,
    required this.note,
  });

  VenmoPaymentRequest.byPhone({
    required this.accessToken,
    required this.amount,
    required this.phone,
    required this.note,
  });

  Map<String, String> toMap() {
    return {
      'access_token': accessToken,
      'amount': amount,
      if (email != null) 'email': email ?? "",
      if (userName != null) 'username': userName ?? "",
      if (phone != null) 'phone': phone ?? "",
      'note': note,
    };
  }
}
