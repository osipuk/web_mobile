import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'apiSource/register_api.dart';

class RegisterRepository {
  final RegisterAPI api = RegisterAPI();

  Future<RegisterResponse> postCreateUser(Register register, bool isSocial) {
    return api.registerUser(register, isSocial).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> sendSMSCode(String number) {
    return api.sendSMSCode(number).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> verifySMSCode(
      int idUser, String code, String number) {
    return api.verifySMSCode(idUser, code, number).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> postActiveRegisterUser(int idUser) {
    return api.activeRegisterUser(idUser).then((response) {
      return response;
    });
  }
}
