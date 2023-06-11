import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/venmoPayment/repository/venmo_login_repository.dart';

class VenmoFormViewModel extends PayOutViewModel {
  final VenmoRepository repository = VenmoRepository();

  VenmoFormViewModel(BuildContext context) : super(context);

  int? userID;
  String userName = "";
  String note = "";
}
