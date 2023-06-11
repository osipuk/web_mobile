import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/requestTrade/model/prepare_trade_model.dart';
import 'package:pay_out/app/modules/requestTrade/repository/apiSource/request_trade_api.dart';

class RequestTradeRepository {
  final RequestTradeAPI api = RequestTradeAPI();

  Future<PrepareTradeModel> prepareATrade(String poolID, int userID) {
    return api.prepareATrade(poolID, userID).then((response) {
      return response;
    });
  }

  Future<GeneralResponse> requestATrade(
      PrepareTradeModel? prepare, int userID, int? selectedID) {
    return api.requestATrade(prepare, userID, selectedID).then((response) {
      return response;
    });
  }
}
