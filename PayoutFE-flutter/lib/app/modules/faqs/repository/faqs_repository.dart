import 'package:pay_out/app/modules/faqs/model/faqs_response.dart';
import 'package:pay_out/app/modules/faqs/repository/apiSource/faqs_api.dart';

class FAQsRepository {
  final FAQsAPI api = FAQsAPI();

  Future<FAQsResponse> getFaqsList() {
    return api.getFaqsList().then((response) {
      return response;
    });
  }
}
