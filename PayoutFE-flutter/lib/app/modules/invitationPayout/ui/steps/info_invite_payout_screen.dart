// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_masked_text2/flutter_masked_text2.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/modules/payoutDetail/viewModel/detail_pay_out_view_model.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class DetailInvitePayoutScreen extends GeneralStatelessWidget {
  DetailPayOutViewModel? model;

  DetailInvitePayoutScreen({
    @queryParam required this.payOut,
  }) : super();
  // Params
  PayOut? payOut;

  MoneyMaskedTextController pricePayoutController =
      new MoneyMaskedTextController(
          leftSymbol: '(\$) ', decimalSeparator: ".", thousandSeparator: ",");

  Widget builderView(BuildContext context, DetailPayOutViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<DetailPayOutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => DetailPayOutViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          headerView(context),
          friendsListWidget(),
          requestsButtons(context),
          dateDetailView(),
          transferDateDetailView(),
          totalPriceDetailView(context)
        ],
      ),
    );
  }

  Widget headerView(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 8, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: payOut?.poolName,
            fontWeight: FontWeight.bold,
            maxLines: 3,
            fontSize: 28,
          ),
        ),
      ],
    );
  }

  Widget friendsListWidget() {
    var items = payOut?.members?.length ?? 0;
    return Container(
      color: Colors.white,
      height: 65,
      child: GridView.builder(
        gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
          crossAxisCount: 1,
          childAspectRatio: 1 / 1,
          mainAxisSpacing: items > 0 ? 10 : 0,
        ),
        itemCount: items,
        itemBuilder: (context, index) {
          return invitatorCard(payOut?.members?[index]);
        },
        scrollDirection: Axis.horizontal,
        padding: items > 0 ? EdgeInsets.all(16) : EdgeInsets.zero,
      ),
    );
  }

  Widget requestsButtons(BuildContext context) {
    return Container(
      color: Colors.white,
      alignment: Alignment.topLeft,
      width: MediaQuery.of(context).size.width,
      margin: EdgeInsets.only(top: 16, bottom: 32),
      height: 35,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          SizedBox(
            width: 20,
          ),
          PoppinsButton.icon(
            content: "  Request split payout  ",
            textColor: PayPOutColors.PrimaryColor,
            fontSize: 12,
            borderColor: PayPOutColors.PrimaryColor,
            shadowColor: PayPOutColors.PrimaryAssentColor,
            fontWeight: FontWeight.bold,
            margin: 0,
            onTap: () {
              model?.navToRequestSplit(payOut);
            },
          )
        ],
      ),
    );
  }

  Widget invitatorCard(PayoutMember? user) {
    return Container(
      child: ProfileImage(
        pathProfile: user?.getProfileImage(),
        size: 30,
      ),
    );
  }

  Widget dateDetailView() {
    return Column(
      children: [
        SeparateLine(),
        Container(
          color: Colors.white,
          padding: EdgeInsets.only(left: 16, right: 16, top: 24),
          child: Row(
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    child: PoppinsText(
                        content: "Start date:",
                        align: TextAlign.left,
                        fontSize: 12,
                        textColor: Colors.black),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                      content:
                          "${payOut?.startDate?.date().getDateString("MMM dd, yyyy")}",
                      fontSize: 15,
                      fontWeight: FontWeight.w500,
                    ),
                  )
                ],
              ),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "End date:",
                        align: TextAlign.right,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content:
                            "${payOut?.endDate?.date().getDateString("MMM dd, yyyy")}",
                        fontSize: 15,
                        fontWeight: FontWeight.w500,
                      ),
                    )
                  ],
                ),
              )
            ],
          ),
        ),
        Container(
          color: Colors.white,
          padding: EdgeInsets.only(left: 16, right: 16, top: 40, bottom: 22),
          child: Row(
            children: [
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "Transfer frequency",
                        align: TextAlign.left,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content:
                            "Monthly on the ${payOut?.startDate?.date().day.ordinal()}",
                        fontSize: 15,
                        fontWeight: FontWeight.w500,
                      ),
                    )
                  ],
                ),
              ),
              Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Container(
                    child: PoppinsText(
                      content: "Duration:",
                      align: TextAlign.right,
                      fontSize: 12,
                      textColor: Colors.black,
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                      content: payOut?.members?.length == 1
                          ? "${payOut?.members?.length} Month"
                          : "${payOut?.members?.length} Months",
                      fontSize: 15,
                      fontWeight: FontWeight.w500,
                    ),
                  )
                ],
              )
            ],
          ),
        )
      ],
    );
  }

  Widget transferDateDetailView() {
    return Column(
      children: [
        SeparateLine(),
        Container(
          color: Colors.white,
          padding: EdgeInsets.only(left: 16, right: 16, top: 32, bottom: 22),
          child: Row(
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    child: PoppinsText(
                        content: "Monthly transfer",
                        align: TextAlign.left,
                        fontSize: 12,
                        textColor: Colors.black),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                      content: payOut?.amountPerDeduction?.toCurrency(),
                      fontSize: 15,
                      fontWeight: FontWeight.w500,
                    ),
                  )
                ],
              ),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: [
                    Container(
                      child: PoppinsText(
                        content: "Total transfer\nin duration",
                        maxLines: 2,
                        align: TextAlign.right,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: payOut?.totalToUserPayment(),
                        fontSize: 15,
                        fontWeight: FontWeight.w500,
                      ),
                    )
                  ],
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget totalPriceDetailView(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        SeparateLine(),
        Container(
          color: Colors.white,
          padding: EdgeInsets.all(16),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    child: PoppinsText(
                      content: "Total payout",
                      maxLines: 2,
                      align: TextAlign.center,
                      fontSize: 12,
                      textColor: Colors.black,
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                      content: payOut?.totalAmount?.toCurrency(),
                      fontSize: 28,
                      fontWeight: FontWeight.bold,
                    ),
                  )
                ],
              ),
              GestureDetector(
                onTapUp: (details) {
                  model?.dialogScreen(
                    context,
                    '',
                    'This is your total savings in the full PayOut cycle. This includes your payout and the share that you save on your own outside of the PayOut application during your payout month.',
                    SVGImage.infoIcon,
                  );
                },
                child: Container(
                  padding: EdgeInsets.only(left: 8, bottom: 60),
                  child: SvgPicture.asset(SVGImage.infoPurpleIcon),
                ),
              )
            ],
          ),
        )
      ],
    );
  }
}
