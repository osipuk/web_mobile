import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_response_model.dart';
import 'package:pay_out/app/modules/createPayout/repository/apiSource/create_payout_api.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/profile/model/search_users_response.dart';

class CreatePayOutRepository {
  final CreatePayOutAPI api = CreatePayOutAPI();

  Future<PayOutCreateResponse> postCreatePayout(PayOutCreate payOutCreate) {
    return api.postCreatePayout(payOutCreate).then((response) {
      return response;
    });
  }

  Future<SearchUsersResponse> postSearchUsers(String userID, String query) {
    return api.postSearchUsers(userID, query).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> postAcceptedInvitation(
      int userID, PayOutCreateResponse payOut) {
    return api.postAcceptedInvitation(userID, payOut).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> postAcceptedAgreementPayOut(
      int userID, int payoutID) {
    return api.postAcceptedAgreementPayOut(userID, payoutID).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> addUserInPayOut(int? userID, PayOut? payOut) {
    return api.addUserInPayOut(userID, payOut).then((response) {
      return response;
    });
  }
}
