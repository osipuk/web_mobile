import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';

// ignore: must_be_immutable
class SuccessfulDialogScreen extends GeneralPopUpScreen {
  String cTitle = '';
  String cMessage = '';
  String cIcon = SVGImage.warningDialogIcon;
  String cCancelBtn = '';

  Function? onAceptClick;
  Function? onCancelClick;

  SuccessfulDialogScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam this.cTitle = '',
    @queryParam this.cMessage = '',
    @queryParam this.cIcon = SVGImage.warningDialogIcon,
    @queryParam this.cCancelBtn = '',
    @queryParam this.onAceptClick,
    @queryParam this.onCancelClick,
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
  String cancelButtonTitle() {
    return cCancelBtn;
  }

  @override
  String headerImage() {
    return cIcon;
  }
}
