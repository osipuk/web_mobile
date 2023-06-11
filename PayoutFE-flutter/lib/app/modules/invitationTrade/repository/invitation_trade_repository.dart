import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationTrade/repository/apiSource/invitation_trade_api_source.dart';

class InviteTradeRepository {
  final InviteTradeAPI api = InviteTradeAPI();

  Future<GeneralResponse> postResponseInvitation(int userID, PayOut? payOut,
      PayoutMember? requestInvUser, int responseJoin) {
    return api
        .postResponseInvitation(userID, payOut, requestInvUser, responseJoin)
        .then((response) {
      return response;
    });
  }

  Future<GeneralResponse> changeNotificationStatus(int? requestID) {
    return api.changeNotificationStatus(requestID).then((response) {
      return response;
    });
  }
}
