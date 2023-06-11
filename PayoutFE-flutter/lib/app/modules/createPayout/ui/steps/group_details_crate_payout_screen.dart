// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/material.dart';
import 'package:flutter_masked_text2/flutter_masked_text2.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/model/payout_create_model.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class GroupDetailsCreatePayoutScreen extends GeneralStatelessWidget {
  GroupDetailsCreatePayoutScreen({required this.payout});

  final PayOutCreate? payout;
  PayOutViewModel? model;

  MoneyMaskedTextController pricePayoutController =
      new MoneyMaskedTextController(
          leftSymbol: '(\$) ', decimalSeparator: ".", thousandSeparator: ",");

  Widget builderView(BuildContext context, PayOutViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PayOutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => PayOutViewModel(context),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return SingleChildScrollView(
      primary: true,
      physics: NeverScrollableScrollPhysics(),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          headerView(context),
          friendsListWidget(),
          randomLabel(),
          dateDetailView(),
          transferDateDetailView(context),
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
          margin: EdgeInsets.only(left: 16, bottom: 16, top: 24),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Group details',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, right: 32),
          child: PoppinsText(
            align: TextAlign.left,
            textColor: PayPOutColors.PrimaryColor,
            fontSize: 16,
            content: payout?.name,
          ),
        )
      ],
    );
  }

  Widget friendsListWidget() {
    var items = payout?.inviteUsers.length ?? 0;
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
          return invitatorCard(payout?.inviteUsers[index]);
        },
        scrollDirection: Axis.horizontal,
        padding: items > 0 ? EdgeInsets.all(16) : EdgeInsets.zero,
      ),
    );
  }

  Widget invitatorCard(User? user) {
    return Container(
      child: ProfileImage(
        pathProfile: user?.getProfileImage(),
        size: 30,
      ),
    );
  }

  Widget randomLabel() {
    return Visibility(
      visible: payout?.randomOrder ?? false,
      child: Container(
        width: double.infinity,
        margin: EdgeInsets.only(left: 16, bottom: 4),
        child: PoppinsText(
          align: TextAlign.left,
          content: '(Order randomized)',
          fontSize: 13,
        ),
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
                          "${payout?.initDate?.getDateString("MMM dd, yyyy")}",
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
                            "${payout?.endDate()?.getDateString("MMM dd, yyyy")}",
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
                            "Monthly on the ${payout?.initDate?.day.ordinal()}",
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
                      content: payout?.inviteUsers.length == 1
                          ? "${payout?.inviteUsers.length} Month"
                          : "${payout?.inviteUsers.length} Months",
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

  Widget transferDateDetailView(BuildContext context) {
    GlobalKey key = GlobalKey();

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
                      content: payout?.pricePerMember?.toCurrency(),
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
                    Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      crossAxisAlignment: CrossAxisAlignment.start,
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
                        GestureDetector(
                          key: key,
                          onTapUp: (details) {
                            model?.dialogScreen(
                              context,
                              '',
                              'Total amount transferred in duration is the total that will be sent to the PayOut recipient each month. This does not include the share of the recipient.',
                              SVGImage.infoIcon,
                            );
                          },
                          child: Container(
                            padding: EdgeInsets.only(left: 8),
                            child: SvgPicture.asset(SVGImage.infoPurpleIcon),
                          ),
                        )
                      ],
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: payout?.subTotalAmount().toCurrency(),
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
                  Row(
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
                          padding: EdgeInsets.only(left: 8),
                          child: SvgPicture.asset(SVGImage.infoPurpleIcon),
                        ),
                      )
                    ],
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                      content: payout?.totalAmount().toCurrency(),
                      fontSize: 28,
                      fontWeight: FontWeight.bold,
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
}
