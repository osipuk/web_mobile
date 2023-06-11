import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';

class SurveyViewModel extends PayOutViewModel {
  SurveyViewModel(BuildContext context) : super(context);

  final List<String> options = [
    "Student loans",
    "Wedding expenses",
    "Down payment on house/car"
  ];
}
