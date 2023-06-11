class GeneralResponse {
  final bool status;
  final String message;
  // final String? data;

  GeneralResponse({required this.status, required this.message});

  factory GeneralResponse.fromJson(Map<String, dynamic> json) {
    return GeneralResponse(
      status: json['status'],
      message: json['message'] ?? '',
      // data: json['data'] ?? "",
    );
  }
}
