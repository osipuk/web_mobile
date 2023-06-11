import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/invitationRejected/repository/apiSource/invitation_rejected_api.dart';

class InvitationRejectedRepository {
  final InvitationRejectedAPI api = InvitationRejectedAPI();

  Future<GeneralResponse> sendInvitation(
    String? poolID,
    String? newUserId,
    String? oldUserId,
    bool isRegistered,
  ) {
    return api
        .sendInvitation(poolID, newUserId, oldUserId, isRegistered)
        .then((response) {
      return response;
    });
  }
}
