import 'package:flutter/widgets.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/invitationSplit/repository/invitation_split_repository.dart';
import 'package:pay_out/app/modules/login/model/user.dart';

class InvitationSplitViewModel extends PayOutViewModel {
  final InvitationSplitRepository repository = InvitationSplitRepository();

  // User? user;
  User? selectedUser;
  int indexSelected = 2;

  String querySearch = "";
  List<User>? users = [];

  InvitationSplitViewModel(BuildContext context) : super(context);

  void requestASplit(int? notID, int? requestID, bool accepted,
      Function() onComplete, Function(String) onFailed) async {
    final userID = await SharedPreferencesManager.get.getUserID();
    repository.responseInvitationSplit(requestID, userID, accepted).then(
      (response) {
        if (response.status) {
          onComplete();
          repository.changeNotificationStatus(notID);
        } else {
          onFailed(response.message);
        }
      },
    );
  }
}
