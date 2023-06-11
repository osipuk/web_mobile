import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/invitationPayout/repository/apiSource/invite_payout_api.dart';

class InvitePayOutRepository {
  final InvitePayOutAPI api = InvitePayOutAPI();

  Future<GeneralResponse> postAcceptedInvitation(int userID, PayOut payOut) {
    return api.postAcceptedInvitation(userID, payOut).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> postDeclineInvitation(int userID, PayOut payOut) {
    return api.postDeclineInvitation(userID, payOut).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> postAcceptedAggrementPayOut(
      int userID, PayOut payOut) {
    return api.postAcceptedAggrementPayOut(userID, payOut).then((response) {
      return response;
    });
  }
}
