import 'package:pay_out/app/modules/register/model/place.dart';
import 'package:pay_out/app/modules/register/model/place_api_provider.dart';
import 'package:pay_out/app/modules/register/model/suggestion.dart';

class GooglePlaceManager {
  static String language = 'en';

  Future<List<Suggestion>> getSuggestions(String query) async {
    return PlaceApiProvider().fetchSuggestions(query, language);
  }

  Future<Place> getPlaceIn(String placeID) {
    return PlaceApiProvider().getPlaceDetailFromId(placeID);
  }
}
