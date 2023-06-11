import 'package:flutter/material.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/home/repository/home_repository.dart';
import 'package:pay_out/app/modules/requestTrade/model/prepare_trade_model.dart';
import 'package:pay_out/app/modules/requestTrade/repository/request_trade_repository.dart';
import 'package:collection/collection.dart';

class RequestTradeViewModel extends PayOutViewModel {
  RequestTradeViewModel(BuildContext context) : super(context);

  final RequestTradeRepository repository = RequestTradeRepository();
  PrepareTradeModel? prepare;

  ///MARK Functions
  void prepareATrade(String poolID, Function() onComplete) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.prepareATrade(poolID, userID).then(
      (response) async {
        prepare = response;
        prepare?.userList = await getUsers();
        onComplete();
      },
    );
  }

  void requestATrade(PrepareTradeModel? prepare, int? selectedID,
      Function() onComplete, Function(String) onFailed) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.requestATrade(prepare, userID, selectedID).then(
      (response) {
        if (response.status) {
          onComplete();
        } else {
          onFailed(response.message);
        }
      },
    );
  }

  //Utilties
  Future<List<PrepareTradeUserData>> getUsers() async {
    final payoutID = prepare?.payout.poolID.toString() ?? '';
    final payout = await HomeRepository().getPayOutDetail(payoutID);

    final userID = await SharedPreferencesManager.get.getUserID();
    final me = payout.data.members?.firstWhereOrNull((e) => e.userID == userID);

    final isSomeOnePayment =
        payout.data.members?.firstWhereOrNull((e) => e.isPaid == 1);

    final currentReceivePaymentUser = payout.data.members
        ?.firstWhereOrNull((e) => e.payoutOrder == payout.data.currentMonth());

// (e.isShared == 0 || (e.isShared == 1 && e.isSlave == 0))

    return prepare?.userList.where((e) {
          final member = payout.data.members!
              .firstWhereOrNull((element) => element.userID == e.userID);
          return (member?.isShared == 0 ||
                  (member?.isShared == 1 && member?.isSlave == 0)) &&
              e.isPayout == 0 &&
              e.payOutOrder != me?.payoutOrder &&
              (e.userID != currentReceivePaymentUser?.userID ||
                  isSomeOnePayment == null);
        }).toList() ??
        [];
  }
}
