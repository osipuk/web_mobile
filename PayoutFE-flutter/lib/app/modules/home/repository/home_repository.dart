import 'package:pay_out/app/modules/home/model/home_invitations_response.dart';
import 'package:pay_out/app/modules/home/model/payout_detail_response.dart';
import 'package:pay_out/app/modules/home/repository/apiSource/home_api.dart';

class HomeRepository {
  final HomeAPI api = HomeAPI();

  Future<PayoutInvitationsResponse> getInvitations(String userID) {
    return api.invitations(userID).then((response) {
      return response;
    });
  }

  Future<PayoutInvitationsResponse> getMyPayOuts(String userID) {
    return api.getMyPayOuts(userID).then((response) {
      return response;
    });
  }

  Future<PayoutDetailResponse> getPayOutDetail(String poolID) {
    return api.getPayOutDetail(poolID).then((response) {
      return response;
    });
  }
}
