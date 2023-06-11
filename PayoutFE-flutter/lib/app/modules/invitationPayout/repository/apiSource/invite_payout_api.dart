import 'dart:convert';
import 'dart:io';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/service/api.dart';
import 'package:http/http.dart' as http;
import 'package:http_parser/http_parser.dart';

class InvitePayOutAPI extends API {
  final getAcceptInviteApi = '${API.baseUrl}/acceptRejectJoinPool';
  final getAcceptAgreementApi = '${API.baseUrl}/agreementJoinPool';

  Future<GeneralResponse> postAcceptedInvitation(
      int userID, PayOut payOut) async {
    final response = await http.post(
      Uri.parse(getAcceptInviteApi),
      body: {
        'pool_id': payOut.poolID.toString(),
        'user_id': userID.toString(),
        'join_status': PayOut.ACCEPTED_INVITATION.toString(),
        'request_type': PayOut.INVITED_REQUEST.toString(),
        'pool_owner_id': payOut.userID.toString(),
        'sender_id': payOut.userID.toString(),
        'receiver_id': userID.toString(),
      },
      headers: {
        HttpHeaders.contentTypeHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getAcceptInviteApi');
    }
  }

  Future<GeneralResponse> postAcceptedAggrementPayOut(
      int userID, PayOut payOut) async {
    var request =
        http.MultipartRequest("POST", Uri.parse(getAcceptAgreementApi));
    request.fields.addAll({
      'pool_id': payOut.poolID.toString(),
      'user_id': userID.toString(),
      'join_status': PayOut.ACCEPTED_INVITATION.toString(),
    });

    request.headers.addAll({
      HttpHeaders.contentTypeHeader: 'multipart/form-data;',
    });

    final emptyFile = http.MultipartFile.fromBytes(
      'user_agreement_url',
      [1],
      filename: "agreement.jpg",
      contentType: MediaType('image', 'jpg'),
    );
    request.files.add(emptyFile);

    final response = await request.send();
    final value = await response.stream.transform(utf8.decoder).first;

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(value));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getAcceptAgreementApi');
    }
  }

  Future<GeneralResponse> postDeclineInvitation(
      int userID, PayOut payOut) async {
    final response = await http.post(
      Uri.parse(getAcceptInviteApi),
      body: {
        'pool_id': payOut.poolID.toString(),
        'user_id': userID.toString(),
        'join_status': PayOut.DECLINE_INVITATION.toString(),
        'request_type': PayOut.INVITED_REQUEST.toString(),
        'pool_owner_id': payOut.userID.toString(),
        'sender_id': payOut.userID.toString(),
        'receiver_id': userID.toString(),
      },
      headers: {
        HttpHeaders.contentTypeHeader: 'application/x-www-form-urlencoded',
        HttpHeaders.authorizationHeader:
            await SharedPreferencesManager.get.authToken()
      },
    );

    if (response.statusCode == 200) {
      GeneralResponse responseUser =
          GeneralResponse.fromJson(jsonDecode(response.body));
      return responseUser;
    } else {
      throw Exception('API ERROR: $getAcceptInviteApi');
    }
  }
}
