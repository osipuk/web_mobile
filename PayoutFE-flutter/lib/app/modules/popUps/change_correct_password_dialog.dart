import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class ChangeCorrectPassDialog extends GeneralPopUpScreen {
  ChangeCorrectPassDialog({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  @override
  String title() {
    return 'Changed correctly';
  }

  @override
  String subTitle() {
    return 'We have saved your new password, please re-authenticate to enter';
  }

  @override
  String headerImage() {
    return SVGImage.checkSuccessIcon;
  }

  @override
  void onActionButtonTapped(BuildContext context) {
    super.onActionButtonTapped(context);
    model?.navToLoginHome();
  }
}
