import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';

// ignore: must_be_immutable
class ErrorDialogScreen extends GeneralPopUpScreen {
  String cTitle = '';
  String cMessage = '';
  String cIcon = SVGImage.warningDialogIcon;

  ErrorDialogScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam this.cTitle = '',
    @queryParam this.cMessage = '',
    @queryParam this.cIcon = SVGImage.warningDialogIcon,
  }) : super(onBackCallback);

  @override
  Widget build(BuildContext context) {
    return super.build(context);
  }

  @override
  String title() {
    return cTitle;
  }

  @override
  String subTitle() {
    return cMessage;
  }

  @override
  String headerImage() {
    return cIcon;
  }
}
