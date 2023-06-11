import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/login/viewModel/password/new_password_screen_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';

// ignore: must_be_immutable
class NewPasswordLoginScreen extends GeneralScreen {
  NewPasswordLoginScreenViewModel? model;

  NewPasswordLoginScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  Widget builderView(
      BuildContext context, NewPasswordLoginScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<NewPasswordLoginScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => NewPasswordLoginScreenViewModel(context),
    );
  }

  @override
  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        entryTextFieldPassword(),
        nextButtonView()
      ],
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 95,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.passwordImg),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'New password',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 3,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content:
                'Please, set your password with at least eight characters, a capital letter, a number, and a special character to protect your data.',
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword() {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Password',
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Expanded(
                  child: TextField(
                    textAlignVertical: TextAlignVertical.center,
                    obscureText: model?.hidePassword ?? false,
                    decoration: InputDecoration(
                        hintText: "Entry password",
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                ),
                PoppinsButton(
                  image: SVGImage.viewPasswordIcon,
                  iconColor: PayPOutColors.lightGrey,
                  borderColor: Colors.white,
                  shadowColor: Colors.white,
                  onTap: () => model?.changePasswordViewed,
                )
              ],
            ))
      ],
    );
  }

  Widget nextButtonView() {
    return Container(
      margin: EdgeInsets.only(top: 75, bottom: 32),
      child: Row(
        children: <Widget>[
          Expanded(
            child: PoppinsButton(
              content: "Save",
              fontWeight: FontWeight.bold,
              fontSize: 16,
              color: PayPOutColors.pink,
              borderColor: PayPOutColors.pink,
              onTap: () {
                model?.showSuccessChangePasswordDialog();
              },
            ),
          )
        ],
      ),
    );
  }

  @override
  Widget onNavBarView(BuildContext context) {
    return Container(
      height: 100,
      padding: EdgeInsets.only(left: 16, bottom: 8),
    );
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
