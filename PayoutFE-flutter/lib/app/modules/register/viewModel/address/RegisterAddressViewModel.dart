import 'dart:async';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/google_places_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/register/model/place.dart';
import 'package:pay_out/app/modules/register/model/suggestion.dart';

class RegisterAddressViewModel extends PayOutViewModel {
  String address = '';
  String city = '';
  String state = '';
  String zipCode = '';
  double longitude = 0;
  double latitude = 0;

  List<Suggestion> listSuggestion = [];
  Timer? timer;

  var onSelectedSuggestion = false;

  // activos para el progress indicator
  var searchSuggestionActive = false;
  var searchPlaceActive = false;

  RegisterAddressViewModel(BuildContext context) : super(context);

  //MARK: - Consulta sugeridos de google
  void getSuggestions(String query, Function onComplete) {
    address = query;
    searchSuggestionActive = true;
    notify();

    timer?.cancel();

    timer = Timer(Duration(milliseconds: 500), () {
      onSelectedSuggestion = query.isNotEmpty;
      if (query.isNotEmpty) {
        GooglePlaceManager().getSuggestions(query).then((value) {
          onComplete.call();
          _setSuggestedList(value);
        });
      } else {
        _setSuggestedList([]);
      }
    });
  }

  void _setSuggestedList(List<Suggestion> list) {
    listSuggestion = list;
    searchSuggestionActive = false;
    notify();
  }

  //MARK: Consulta detalle degueridos (PLACES)
  void getPlace(String placeID, {required Function(Place) onSuccess}) {
    searchPlaceActive = true;
    notify();

    GooglePlaceManager().getPlaceIn(placeID).then((place) {
      _setSuggestedList([]);
      searchPlaceActive = false;
      address = place.address ?? '';
      city = place.city ?? '';
      state = place.state ?? '';
      zipCode = place.zipCode ?? '';
      latitude = place.latitude ?? 0;
      longitude = place.longitude ?? 0;
      onSuccess(place);
      notify();
    });
  }
}
