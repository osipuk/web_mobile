import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/editProfile/model/edit_profile_model.dart';
import 'package:pay_out/app/modules/editProfile/repository/apiSource/edit_profile_api.dart';

class EditProfileRepository {
  final EditProfileAPI api = EditProfileAPI();

  Future<GeneralResponse?> uploadProfileImage(EditUser user, int idUser) {
    return api.uploadProfileImage(user, idUser);
  }

  Future<GeneralResponse> editProfileUser(
      Map<String, dynamic> data, int idUser) {
    return api.editProfileUser(data, idUser);
  }

  Future<GeneralResponse> editPasswordUser(String newPass, String oldPass) {
    return api.editPasswordUser(newPass, oldPass);
  }
}
