class DeletePayoutResponse {
  final String status;

  DeletePayoutResponse({required this.status});

  factory DeletePayoutResponse.fromJson(Map<String, dynamic> json) {
    return DeletePayoutResponse(
      status: json['status'],
    );
  }
}
