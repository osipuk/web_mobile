import 'package:pay_out/app/modules/profile/model/profile_response.dart';
import 'package:pay_out/app/modules/profile/model/search_users_response.dart';
import 'package:pay_out/app/modules/profile/respository/apiSource/profile_api.dart';

class ProfileRepository {
  final ProfileAPI api = ProfileAPI();

  Future<ProfileResponse> getProfileUser(String userID) {
    return api.getProfileUserDetail(userID).then((response) {
      return response;
    });
  }

  Future<SearchUsersResponse> postSearchUsers(String userID, String query) {
    return api.postSearchUsers(userID, query).then((response) {
      return response;
    });
  }
}
