import 'dart:convert';
import 'package:http/http.dart';
import 'package:pay_out/app/modules/register/model/place.dart';
import 'package:pay_out/app/modules/register/model/suggestion.dart';
import 'package:uuid/uuid.dart';

class PlaceApiProvider {
  final client = Client();

  PlaceApiProvider();

  final sessionToken = Uuid().v4();
  final apiKey = 'AIzaSyBThaKa4iWEKA-5PfQn1kV_EINjamYd4-4';
  final country = 'usa';

  Future<List<Suggestion>> fetchSuggestions(String input, String lang) async {
    final request =
        'https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$input&types=address&language=$lang&components=country:$country&key=$apiKey&sessiontoken=$sessionToken';
    final response = await client.get(Uri.parse(request));

    if (response.statusCode == 200) {
      final result = json.decode(response.body);
      if (result['status'] == 'OK') {
        return result['predictions']
            .map<Suggestion>((p) => Suggestion(p['place_id'], p['description']))
            .toList();
      }
      if (result['status'] == 'ZERO_RESULTS') {
        return [];
      }
      throw Exception(result['error_message']);
    } else {
      throw Exception('Failed to fetch suggestion');
    }
  }

  Future<Place> getPlaceDetailFromId(String placeId) async {
    final request =
        'https://maps.googleapis.com/maps/api/place/details/json?place_id=$placeId&fields=address_component,formatted_address,geometry&key=$apiKey&sessiontoken=$sessionToken';
    final response = await client.get(Uri.parse(request));

    if (response.statusCode == 200) {
      final result = json.decode(response.body);

      if (result['status'] == 'OK') {
        ///MARK: DATOS DE DIRECCION
        final components =
            result['result']['address_components'] as List<dynamic>;
        final place = Place();
        components.forEach((c) {
          final List type = c['types'];
          place.address = result['result']['formatted_address'];

          if (type.contains('administrative_area_level_1')) {
            place.state = c['long_name'];
          }
          if (type.contains('locality')) {
            place.city = c['long_name'];
          }
          if (type.contains('postal_code')) {
            place.zipCode = c['long_name'];
          }
        });

        ///MARK: DATOS DE UBICACION
        final locComponents = result['result']['geometry'] as dynamic;
        place.latitude = locComponents['location']['lat'] as double;
        place.longitude = locComponents['location']['lng'] as double;
        return place;
      }
      throw Exception(result['error_message']);
    } else {
      throw Exception('Failed to fetch suggestion');
    }
  }
}
