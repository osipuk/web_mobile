import 'package:pay_out/app/modules/payoutDetail/model/delete_payout_response.dart';
import 'package:pay_out/app/modules/payoutDetail/repository/apiSource/payout_detail_api.dart';

class PayOutDetailRepository {
  final PayOutDetailAPI api = PayOutDetailAPI();

  Future<DeletePayoutResponse> deletePayOut(String poolID) {
    return api.deletePayout(poolID).then((response) {
      return response;
    });
  }
}
