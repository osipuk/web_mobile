import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/modules/faqs/model/faqs_response.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class FAQsAPI extends API {
  final faqsApi = '${API.baseUrl}/listFAQ';

  Future<FAQsResponse> getFaqsList() async {
    final response = await http.get(
      Uri.parse(faqsApi),
      headers: {
        HttpHeaders.acceptHeader: 'application/json',
      },
    );

    if (response.statusCode == 200) {
      FAQsResponse responseUser =
          FAQsResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $faqsApi');
    }
  }
}
