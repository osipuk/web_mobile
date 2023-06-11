import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/create_payout_view_model.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class FeesCreatePayoutScreen extends GeneralStatelessWidget {
  FeesCreatePayoutScreen({
    required this.otherOptionChangeValue,
    required this.payOut,
    this.payOutToEdit,
  });

  final Function(bool) otherOptionChangeValue;
  final PayOutCreate? payOut;
  final PayOut? payOutToEdit;

  CreatePayoutViewModel? model;

  Widget builderView(BuildContext context, CreatePayoutViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<CreatePayoutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () =>
          CreatePayoutViewModel(context, payoutToEdit: payOutToEdit),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          headerView(context),
          deductionView(),
          usersListWidget(context)
        ],
      ),
    );
  }

  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Fees',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, right: 32),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 3,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content:
                'Calculate the additional value of the payments, when changing the option you will see the variations of the values',
          ),
        )
      ],
    );
  }

  Widget deductionView() {
    return Container(
      margin: EdgeInsets.only(top: 16, bottom: 16, left: 16),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          PoppinsText(
            content: "Deduct charges from Payout",
            fontSize: 12,
          ),
          Switch(
            activeColor: PayPOutColors.PrimaryColor,
            value: payOut?.isDeduct ?? false,
            onChanged: otherOptionChangeValue,
          )
        ],
      ),
    );
  }

  Widget usersListWidget(BuildContext context) {
    final items = payOut?.inviteUsers.length ?? 0;

    return Container(
      height: 60.0 * items,
      child: ListView.builder(
        physics: NeverScrollableScrollPhysics(),
        itemCount: items,
        itemBuilder: (context, index) {
          return userCardDetail(payOut?.inviteUsers[index]);
        },
      ),
    );
  }

  // Card de ususarios buscados para invitarlos al payout
  Widget userCardDetail(User? user) {
    return Container(
      height: 60,
      color: PayPOutColors.lightPink,
      padding: EdgeInsets.only(left: 8, right: 16),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Container(
            height: 30,
            width: 30,
            margin: EdgeInsets.only(left: 4, right: 10),
            child: ProfileImage(
              size: 30,
              pathProfile: user?.getProfileImage(),
            ),
          ),
          Container(
            alignment: Alignment.centerLeft,
            child: PoppinsText(
              align: TextAlign.left,
              content: user?.fullName(),
              fontWeight: FontWeight.w600,
              fontSize: 11,
            ),
          ),
          Expanded(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                PoppinsText(
                  content: "\$ 1.25",
                  fontWeight: FontWeight.bold,
                  fontSize: 11,
                ),
                PoppinsText(
                  textColor: PayPOutColors.lightGrey,
                  content: "Payout received : \$XX.XX",
                  fontSize: 11,
                )
              ],
            ),
          )
        ],
      ),
    );
  }
}
