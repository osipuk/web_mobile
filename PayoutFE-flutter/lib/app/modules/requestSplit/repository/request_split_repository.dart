import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/requestSplit/repository/apiSource/request_split_api.dart';

class RequestSplitRepository {
  final RequestSplitAPI api = RequestSplitAPI();

  Future<GeneralResponse> splitWithUserRegister(
      PayOut? payOut, int senderID, int receiverID) {
    return api
        .splitWithUserRegister(payOut, senderID, receiverID)
        .then((response) {
      return response;
    });
  }

  Future<GeneralResponse> splitWitNotUserRegister(
      PayOut? payOut, int senderID, String email) {
    return api
        .splitWitNotUserRegister(payOut, senderID, email)
        .then((response) {
      return response;
    });
  }
}
