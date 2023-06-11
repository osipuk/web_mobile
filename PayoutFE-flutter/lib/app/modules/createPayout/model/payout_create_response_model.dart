class PayOutCreateResponse {
  final bool status;
  final String message;
  final PayOutCreateIDResponse data;

  PayOutCreateResponse({
    required this.status,
    required this.message,
    required this.data,
  });

  factory PayOutCreateResponse.fromJson(Map<String, dynamic> json) {
    return PayOutCreateResponse(
      status: json['status'],
      message: json['message'],
      data: PayOutCreateIDResponse.fromJson(json['data']),
    );
  }
}

class PayOutCreateIDResponse {
  final int id;

  PayOutCreateIDResponse({
    required this.id,
  });

  factory PayOutCreateIDResponse.fromJson(Map<String, dynamic> json) {
    return PayOutCreateIDResponse(
      id: json['pool_id'] ?? json['id'],
    );
  }
}
