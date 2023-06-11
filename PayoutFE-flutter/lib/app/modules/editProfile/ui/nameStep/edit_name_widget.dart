import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/register/viewModel/names/register_names_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';

// ignore: must_be_immutable
class EditNamesWidget extends GeneralStatelessWidget {
  final Function(String) onFirstNameChangeValue;
  final Function(String) onLastNameChangeValue;
  final Function(String) onUserNameChangeValue;

  EditNamesWidget(this.lastFirstName, this.lastName, this.lastUserName,
      {required this.onFirstNameChangeValue,
      required this.onLastNameChangeValue,
      required this.onUserNameChangeValue});

  PayOutTextFieldEditingController firstNameController =
      new PayOutTextFieldEditingController();
  PayOutTextFieldEditingController lastNameController =
      new PayOutTextFieldEditingController();
  PayOutTextFieldEditingController userNameController =
      new PayOutTextFieldEditingController();

  FocusNode firstNameFocusNode = FocusNode();
  FocusNode lastNameFocusNode = FocusNode();
  FocusNode userNameFocusNode = FocusNode();

  final String lastFirstName;
  final String lastName;
  final String lastUserName;

  RegisterNameScreenViewModel? model;

  Widget builderView(BuildContext context, RegisterNameScreenViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    // WidgetsBinding.instance?.removeObserver(this);
    // WidgetsBinding.instance?.addObserver(this);
    return ViewModelBuilder<RegisterNameScreenViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterNameScreenViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(context),
        firstNameTextField(),
        lastNameTextField(),
        userNameTextField()
      ],
    );
  }

  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.nameIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Full name',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        )
      ],
    );
  }

  Widget firstNameTextField() {
    firstNameController.text = lastFirstName;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 8),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'First name',
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
                    controller: firstNameController,
                    onChanged: onFirstNameChangeValue,
                    textAlignVertical: TextAlignVertical.center,
                    keyboardType: TextInputType.text,
                    textInputAction: TextInputAction.next,
                    textCapitalization: TextCapitalization.words,
                    onSubmitted: (value) {
                      firstNameFocusNode.unfocus();
                      lastNameFocusNode.requestFocus();
                    },
                    decoration: InputDecoration(
                      hintText: "First Name",
                      border: InputBorder.none,
                      hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont,
                      ),
                    ),
                  ),
                )
              ],
            ))
      ],
    );
  }

  Widget lastNameTextField() {
    lastNameController.text = lastName;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Last name',
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
                    controller: lastNameController,
                    focusNode: lastNameFocusNode,
                    onChanged: onLastNameChangeValue,
                    textAlignVertical: TextAlignVertical.center,
                    textCapitalization: TextCapitalization.words,
                    textInputAction: TextInputAction.next,
                    keyboardType: TextInputType.text,
                    onSubmitted: (value) {
                      firstNameFocusNode.unfocus();
                      lastNameFocusNode.unfocus();
                      userNameFocusNode.requestFocus();
                    },
                    decoration: InputDecoration(
                        hintText: "Last Name",
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                )
              ],
            ))
      ],
    );
  }

  Widget userNameTextField() {
    userNameController.text = lastUserName;
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'User name',
          ),
        ),
        Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12, bottom: 32),
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
                    controller: userNameController,
                    focusNode: userNameFocusNode,
                    onChanged: onUserNameChangeValue,
                    textAlignVertical: TextAlignVertical.center,
                    textCapitalization: TextCapitalization.words,
                    keyboardType: TextInputType.text,
                    onSubmitted: (value) {
                      hideKeyboard();
                    },
                    decoration: InputDecoration(
                        hintText: "User Name",
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                            fontSize: 15,
                            color: Colors.black54,
                            fontFamily: GeneralConstants.poppinsFont)),
                  ),
                )
              ],
            ))
      ],
    );
  }
}
