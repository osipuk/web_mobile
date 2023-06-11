import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/register/viewModel/names/register_names_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';

// ignore: must_be_immutable
class RegisterNamesWidget extends GeneralStatelessWidget {
  final Function(String) onFirstNameChangeValue;
  final Function(String) onLastNameChangeValue;
  final Function(String) onUserNameChangeValue;
  final Function(File) onImageProfileChangeValue;

  RegisterNamesWidget(
      this.lastFirstName, this.lastName, this.lastUserName, this.imageProfile,
      {required this.onFirstNameChangeValue,
      required this.onLastNameChangeValue,
      required this.onUserNameChangeValue,
      required this.onImageProfileChangeValue});

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
  final String imageProfile;

  RegisterNameScreenViewModel? model;

  Widget builderView(BuildContext context, RegisterNameScreenViewModel model) {
    this.model = model;
    this.model?.pathUserImage = imageProfile;
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
            width: 110,
            margin: EdgeInsets.only(top: 32, bottom: 32),
            child: GestureDetector(
              onTap: () => showUploadImageModal(context),
              child: Stack(
                alignment: Alignment.center,
                children: <Widget>[
                  Container(
                    child: model?.getUserImage(),
                  ),
                  Positioned(
                      bottom: -8,
                      right: 0,
                      child: Container(
                        height: 40,
                        width: 40,
                        alignment: Alignment.bottomRight,
                        child: SvgPicture.asset(SVGImage.cameraButtonIcon),
                      ))
                ],
              ),
            )),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Full name',
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
                'Nice, please tell us what your name is, not your nickname or your alias, we will use this name for all processes.',
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
          margin: EdgeInsets.only(left: 24, top: 42),
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
                            fontFamily: GeneralConstants.poppinsFont)),
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

  /// UPLOAD image modal
  void showUploadImageModal(BuildContext context) {
    showModalBottomSheet(
        context: context,
        backgroundColor: Colors.transparent,
        builder: (BuildContext bc) {
          return Container(
              padding:
                  EdgeInsets.only(left: 56, right: 30, top: 32, bottom: 52),
              child: Wrap(
                children: <Widget>[
                  Container(
                    child: Row(
                      children: <Widget>[
                        Expanded(
                          child: PoppinsText(
                            content: 'Upload pic',
                            fontWeight: FontWeight.bold,
                            fontSize: 23,
                          ),
                        ),
                        PoppinsButton(
                          image: SVGImage.close,
                          borderColor: Colors.transparent,
                          color: Colors.transparent,
                          shadowColor: Colors.white,
                          onTap: () => Navigator.pop(context),
                        )
                      ],
                    ),
                  ),
                  SeparateLine(),
                  GestureDetector(
                    onTap: () {
                      Navigator.pop(context);
                      model?.openGallery().then((path) {
                        onImageProfileChangeValue(path);
                      });
                    },
                    child: Container(
                      height: 60,
                      child: Row(
                        children: <Widget>[
                          Container(
                            margin: EdgeInsets.only(right: 32),
                            alignment: Alignment.centerLeft,
                            child: SvgPicture.asset(SVGImage.galleryIcon),
                          ),
                          PoppinsText(
                            content: 'Open gallery',
                            textColor: PayPOutColors.PrimaryAssentColor,
                            fontSize: 16,
                          )
                        ],
                      ),
                    ),
                  ),
                  SeparateLine(),
                  GestureDetector(
                    onTap: () {
                      Navigator.pop(context);
                      model?.openCamera().then((path) {
                        onImageProfileChangeValue(path);
                      });
                    },
                    child: Container(
                      height: 60,
                      child: Row(
                        children: <Widget>[
                          Container(
                            margin: EdgeInsets.only(right: 32),
                            alignment: Alignment.centerLeft,
                            child: SvgPicture.asset(SVGImage.cameraIcon),
                          ),
                          PoppinsText(
                            content: 'Open camera',
                            textColor: PayPOutColors.PrimaryAssentColor,
                            fontSize: 16,
                          )
                        ],
                      ),
                    ),
                  )
                ],
              ),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.only(
                    topRight: Radius.circular(30.0),
                    topLeft: Radius.circular(30.0)),
              ));
        });
  }
}
