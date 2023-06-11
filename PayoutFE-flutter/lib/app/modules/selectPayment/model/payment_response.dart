class PaymentResponse {
  final bool status;
  final String message;
  final int? data;

  PaymentResponse({required this.status, required this.message, this.data});

  factory PaymentResponse.fromJson(Map<String, dynamic> json) {
    return PaymentResponse(
      status: json['status'],
      message: json['message'],
      data: json['data'] ?? 0,
    );
  }
}
