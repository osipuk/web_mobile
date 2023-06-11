import 'package:pay_out/app/modules/faqs/model/faq.dart';

class FAQsResponse {
  final bool status;
  final String message;
  final List<Faq> data;

  FAQsResponse(
      {required this.status, required this.message, required this.data});

  factory FAQsResponse.fromJson(Map<String, dynamic> json) {
    return FAQsResponse(
        status: json['status'],
        message: json['message'],
        data: Faq.toList(json));
  }
}
