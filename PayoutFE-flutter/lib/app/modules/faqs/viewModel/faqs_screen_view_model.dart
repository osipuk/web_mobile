import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/faqs/model/faq.dart';
import 'package:pay_out/app/modules/faqs/repository/faqs_repository.dart';

class FaqsScreenViewModel extends PayOutViewModel {
  final FAQsRepository repository = FAQsRepository();

  List<Faq> faqs = [];

  FaqsScreenViewModel(BuildContext context) : super(context);

  ///MARK: API functions
  void getFaqsList(Function(String) onError) {
    repository.getFaqsList().then((response) {
      if (response.status) {
        faqs = response.data;
      } else {
        onError(response.message);
      }
      notifyListeners();
    }).catchError(error);
  }
}
