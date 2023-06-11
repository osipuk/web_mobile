import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/login/model/login_response.dart';
import 'apiSource/login_api.dart';

class LoginRepository {
  final LoginAPI api = LoginAPI();

  Future<LoginResponse> loginUser(String email, String password) {
    return api.loginUser(email, password).then((response) {
      return response;
    });
  }

  Future<LoginResponse> loginSocialUser(String socialID) {
    return api.loginSocialUser(socialID).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> forgotPassword(String email) {
    return api.forgotPassword(email).then((response) {
      return response;
    });
  }
}
