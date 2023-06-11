import 'dart:io';
import 'package:http/http.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';

class PayOutRequest extends BaseRequest {
  PayOutRequest(String method, Uri url) : super(method, url);

  void setBody(Map<String, String> body) {}
}

class PayOutClient extends BaseClient {
  static Future<Map<String, String>> _getHeaders() async {
    return {
      HttpHeaders.authorizationHeader:
          await SharedPreferencesManager.get.authToken()
    };
  }

  @override
  Future<StreamedResponse> send(BaseRequest request) async {
    request.headers.addAll(await _getHeaders());
    print(request.method);
    print(request.method);
    print(request.url);
    print(request.headers);
    print(request.contentLength.toString());

    var response = await request.send().catchError((error) {
      print(error);
    }).whenComplete(() => null);

    print(response.request);
    print(response.stream.first.toString());

    return response;
  }
}
