import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/register/model/place.dart';
import 'package:pay_out/app/modules/register/model/suggestion.dart';
import 'package:pay_out/app/modules/register/viewModel/address/RegisterAddressViewModel.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class EditAddressWidget extends GeneralStatelessWidget {
  RegisterAddressViewModel? model;

  PayOutTextFieldEditingController streetController =
      PayOutTextFieldEditingController();
  PayOutTextFieldEditingController cityController =
      PayOutTextFieldEditingController();
  PayOutTextFieldEditingController stateController =
      PayOutTextFieldEditingController();
  PayOutTextFieldEditingController zipCodeController =
      PayOutTextFieldEditingController();

  final String street;
  final String city;
  final String state;
  final String zipCode;

  final double latitude;
  final double longitude;
  var timer = Timer(Duration(seconds: 0), () {});

  final Function(Place) onLocationChangeValue;
  final Function(String) onStreetChangeValue;
  final Function(String) onCityChangeValue;
  final Function(String) onStateChangeValue;
  final Function(String) onZipCodeChangeValue;

  EditAddressWidget({
    required this.latitude,
    required this.longitude,
    required this.state,
    required this.zipCode,
    required this.street,
    required this.city,
    required this.onLocationChangeValue,
    required this.onStreetChangeValue,
    required this.onCityChangeValue,
    required this.onStateChangeValue,
    required this.onZipCodeChangeValue,
  });

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<RegisterAddressViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterAddressViewModel(context),
    );
  }

  Widget builderView(BuildContext context, RegisterAddressViewModel model) {
    this.model = model;
    this.model?.longitude = longitude;
    this.model?.latitude = latitude;
    return onBodyInitView(context);
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        streetTextField(),
        suggestionListWidget(),
        cityTextField(),
        stateTextField(),
        zipCodeTextField()
      ],
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.addressIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Address',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
      ],
    );
  }

  Widget streetTextField() {
    streetController.text = model?.address ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 8),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Street',
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
                  controller: streetController,
                  textAlignVertical: TextAlignVertical.center,
                  onChanged: getSuggestions,
                  decoration: InputDecoration(
                    hintText: "Street",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont),
                  ),
                ),
              ),
              Visibility(
                visible: (model?.searchSuggestionActive ?? false) ||
                    (model?.searchPlaceActive ?? false),
                child: Container(
                  width: 20,
                  height: 20,
                  child: CircularProgressIndicator(
                    backgroundColor: Colors.white,
                    strokeWidth: 2,
                    valueColor: AlwaysStoppedAnimation<Color>(
                        PayPOutColors.PrimaryColor),
                  ),
                ),
              )
            ],
          ),
        ),
      ],
    );
  }

  Widget cityTextField() {
    cityController.text = model?.city ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'City',
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
                  controller: cityController,
                  textAlignVertical: TextAlignVertical.center,
                  onChanged: (city) {
                    model?.city = city;
                    onCityChangeValue(city);
                  },
                  decoration: InputDecoration(
                    hintText: "City",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont),
                  ),
                ),
              ),
              Visibility(
                visible: model?.searchPlaceActive ?? false,
                child: Container(
                  width: 20,
                  height: 20,
                  child: CircularProgressIndicator(
                    backgroundColor: Colors.white,
                    strokeWidth: 2,
                    valueColor: AlwaysStoppedAnimation<Color>(
                        PayPOutColors.PrimaryColor),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget stateTextField() {
    stateController.text = model?.state ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'State',
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
                  controller: stateController,
                  textAlignVertical: TextAlignVertical.center,
                  onChanged: (state) {
                    model?.state = state;
                    onStateChangeValue(state);
                  },
                  decoration: InputDecoration(
                    hintText: "State",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont),
                  ),
                ),
              ),
              Visibility(
                visible: model?.searchPlaceActive ?? false,
                child: Container(
                  width: 20,
                  height: 20,
                  child: CircularProgressIndicator(
                    backgroundColor: Colors.white,
                    strokeWidth: 2,
                    valueColor: AlwaysStoppedAnimation<Color>(
                        PayPOutColors.PrimaryColor),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget zipCodeTextField() {
    zipCodeController.text = model?.zipCode ?? "";
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Zip Code',
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
                  controller: zipCodeController,
                  textAlignVertical: TextAlignVertical.center,
                  onChanged: (zipCode) {
                    model?.zipCode = zipCode;
                    onZipCodeChangeValue(zipCode);
                  },
                  decoration: InputDecoration(
                    hintText: "Zip Code",
                    border: InputBorder.none,
                    hintStyle: TextStyle(
                        fontSize: 15,
                        color: Colors.black54,
                        fontFamily: GeneralConstants.poppinsFont),
                  ),
                ),
              ),
              Visibility(
                visible: model?.searchPlaceActive ?? false,
                child: Container(
                  width: 20,
                  height: 20,
                  child: CircularProgressIndicator(
                    backgroundColor: Colors.white,
                    strokeWidth: 2,
                    valueColor: AlwaysStoppedAnimation<Color>(
                        PayPOutColors.PrimaryColor),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget suggestionListWidget() {
    return Visibility(
      visible: model?.onSelectedSuggestion ?? false,
      child: Column(
        children: <Widget>[
          Container(
              height: (model?.listSuggestion.length.toDouble() ?? 0) * 35,
              child: ListView.builder(
                padding: EdgeInsets.only(top: 20),
                itemCount: model?.listSuggestion.length,
                physics: NeverScrollableScrollPhysics(),
                itemBuilder: (context, index) {
                  final item = model?.listSuggestion[index];
                  return suggestionAddressItem(item);
                },
              )),
          Visibility(
            visible: model?.listSuggestion.isNotEmpty ?? false,
            child: SeparateLine(),
          )
        ],
      ),
    );
  }

  Widget suggestionAddressItem(Suggestion? suggestion) {
    return GestureDetector(
      onTap: () => getPlace(suggestion?.placeId ?? ""),
      child: Container(
        padding: EdgeInsets.only(left: 16, right: 16, bottom: 8),
        child: PoppinsText(
          content: suggestion?.description ?? "",
          textColor: PayPOutColors.PrimaryAssentColor,
          fontSize: 12,
          maxLines: 1,
        ),
        height: 30,
      ),
    );
  }

  void getSuggestions(String query) {
    timer.cancel();
    timer = Timer(Duration(milliseconds: 2), () {
      if (model?.address != query) {
        onStreetChangeValue(query);
        model?.getSuggestions(query, () {});
      }
    });
  }

  void getPlace(String placeID) {
    model?.getPlace(placeID, onSuccess: (place) {
      onLocationChangeValue(place);
    });
    unFocus();
  }
}
