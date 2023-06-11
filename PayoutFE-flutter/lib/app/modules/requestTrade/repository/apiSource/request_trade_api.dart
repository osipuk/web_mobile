import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/requestTrade/model/prepare_trade_model.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;

class RequestTradeAPI extends API {
  final getPrepareTradeApi = '${API.baseUrl}/prepareTradeRequest';
  final postRequestTradeApi = '${API.baseUrl}/requestOrderChange';

  Future<PrepareTradeModel> prepareATrade(String poolID, int userID) async {
    final response = await http.post(
      Uri.parse(getPrepareTradeApi),
      body: {
        'pool_id': poolID,
        'sender_id': userID.toString(),
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      PrepareTradeModel responseTrade =
          PrepareTradeModel.fromJson(jsonDecode(response.body));
      return responseTrade;
    } else {
      throw Exception('API ERROR: $getPrepareTradeApi');
    }
  }

  Future<GeneralResponse> requestATrade(
      PrepareTradeModel? prepare, int userID, int? selectedUserID) async {
    final response = await http.post(
      Uri.parse(postRequestTradeApi),
      body: {
        'pool_id': prepare?.payout.poolID.toString(),
        'pool_owner_id': prepare?.payout.ownerID.toString(),
        'user_id': userID.toString(),
        'exchange_member_id': selectedUserID.toString()
      },
      headers: {
        HttpHeaders.acceptHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseTrade =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseTrade;
    } else {
      throw Exception('API ERROR: $postRequestTradeApi');
    }
  }
}
