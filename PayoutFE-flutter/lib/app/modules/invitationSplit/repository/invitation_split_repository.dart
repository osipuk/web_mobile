import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/invitationSplit/repository/apiSource/invitation_split_api.dart';

class InvitationSplitRepository {
  final InvitationSplitAPI api = InvitationSplitAPI();

  Future<GeneralResponse> responseInvitationSplit(
      int? requestID, int userID, bool accepted) {
    return api
        .responseInvitationSplit(requestID, userID, accepted)
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
