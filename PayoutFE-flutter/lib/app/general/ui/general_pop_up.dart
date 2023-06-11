import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';
import 'general_screen.dart';

// ignore: must_be_immutable
class GeneralPopUpScreen extends GeneralScreen {
  PayOutViewModel? model;

  String cIcon = '';
  String cTitle = '';
  String cMessage = '';
  String cButtonTitle = 'Ok';
  String cnlButtonTitle = '';

  Function? onAceptClick;
  Function? onCancelClick;

  GeneralPopUpScreen(
    @queryParam VoidCallback? onBackCallback,
  ) : super(onBackCallback);

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PayOutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => PayOutViewModel(context),
    );
  }

  Widget builderView(BuildContext context, PayOutViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget generalView(BuildContext context) {
    return Dialog(
      insetPadding: EdgeInsets.all(0),
      backgroundColor: Colors.black.withOpacity(0.5),
      elevation: 0,
      child: Center(
        child: IntrinsicHeight(
          child: Container(
            margin: EdgeInsets.only(left: 20, right: 20),
            decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: borderBottomBody(),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.3),
                    spreadRadius: 3,
                    blurRadius: 60,
                    offset: Offset(0, -5), // changes position of shadow
                  ),
                ]),
            child: onBodyInitView(context),
          ),
        ),
      ),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: <Widget>[
        _imageView(),
        Visibility(
          visible: title().isNotEmpty,
          child: Container(
            margin: EdgeInsets.only(
              left: 8,
              right: 8,
              bottom: 24,
            ),
            child: PoppinsText(
              align: TextAlign.center,
              content: title(),
              fontWeight: FontWeight.bold,
              fontSize: 24,
            ),
          ),
        ),
        Visibility(
          visible: subTitle().isNotEmpty,
          child: Container(
            margin: EdgeInsets.only(left: 35, bottom: 30, right: 35),
            child: PoppinsText(
              align: TextAlign.center,
              maxLines: 12,
              textColor: PayPOutColors.PrimaryAssentColor,
              content: subTitle(),
            ),
          ),
        ),
        Container(
          margin: EdgeInsets.only(left: 24, right: 24, bottom: 40),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Visibility(
                visible: cancelButtonTitle().isNotEmpty,
                child: Expanded(
                  child: Container(
                    alignment: Alignment.center,
                    child: PoppinsButton(
                      content: cancelButtonTitle(),
                      fontWeight: FontWeight.bold,
                      color: PayPOutColors.lightPink,
                      borderColor: PayPOutColors.pink,
                      fontSize: 16,
                      onTap: () {
                        onCancelButtonTapped.call();
                      },
                    ),
                  ),
                ),
              ),
              Expanded(
                child: Container(
                  alignment: Alignment.center,
                  child: PoppinsButton(
                    content: actionButtonTitle(),
                    fontWeight: FontWeight.bold,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    fontSize: 16,
                    onTap: () {
                      onActionButtonTapped.call(context);
                    },
                  ),
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _imageView() {
    if (headerImage().isEmpty) {
      return Container(
        margin: EdgeInsets.only(top: 50),
      );
    }
    return Container(
      height: 78,
      width: double.infinity,
      margin: EdgeInsets.only(top: 50, bottom: 32),
      child: SvgPicture.asset(headerImage()),
    );
  }

  String title() {
    return cTitle;
  }

  String subTitle() {
    return cMessage;
  }

  String actionButtonTitle() {
    return cButtonTitle;
  }

  String cancelButtonTitle() {
    return cnlButtonTitle;
  }

  String headerImage() {
    return cIcon;
  }

  void onActionButtonTapped(BuildContext context) {
    if (onAceptClick == null) {
      model?.back();
    } else {
      onAceptClick?.call();
    }
  }

  void onCancelButtonTapped() {
    if (onCancelClick == null) {
      model?.back();
    } else {
      onCancelClick?.call();
    }
  }

  @override
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.all(Radius.circular(30));
  }

  @override
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(right: 20, left: 20, bottom: 16);
  }
}
