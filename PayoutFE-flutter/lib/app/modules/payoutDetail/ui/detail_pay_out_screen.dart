import 'package:auto_route/auto_route.dart';
import 'package:collection/collection.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
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
class PayOutDetailScreen extends GeneralScreen {
  DetailPayOutViewModel? model;

  PayOutDetailScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam required this.payOut,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;

  Size? columnSize;

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<DetailPayOutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => DetailPayOutViewModel(context),
      onModelReady: (_) {
        DatabaseManager.get.getUser().then((value) {
          model?.user = value;
          model?.notifyListeners();
        });
      },
    );
  }

  Widget builderView(BuildContext context, DetailPayOutViewModel model) {
    this.model = model;
    return Stack(
      alignment: Alignment.topCenter,
      children: [
        backgroundImage(context),
        navBar(context),
        tabBarView(),
        bodyCard(context),
      ],
    );
  }

  Widget separatorNavBar() {
    return Container(
      height: 120,
      color: Colors.transparent,
      child: GestureDetector(
        onTap: () => model?.back(onValue: onBackCallback),
        child: Container(
          width: 80,
          color: Colors.transparent,
        ),
      ),
    );
  }

  Widget navBar(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [onBackWidget(context)],
        ),
      ),
    );
  }

  Widget onHeaderMainCorner() {
    return Container(
      height: 30,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(30.0),
          topRight: Radius.circular(30.0),
        ),
      ),
    );
  }

  Widget onBackWidget(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back, color: Colors.white),
      onPressed: () => model?.back(onValue: onBackCallback),
    );
  }

  Widget bodyCard(BuildContext context) {
    final column = Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        separatorNavBar(),
        onHeaderMainCorner(),
        header(context),
        requestATradeButton(),
        nextPaymentWidget(context),
        datesWidget(),
        priceWidget(),
        paymetnFrecuency(),
        separatorWidget(),
        totalLabelWidget(context),
        invitatorsListWidget(context),
        separatorInvitorCardWidget(),
        separatorTabbar()
      ],
    );

    return SingleChildScrollView(
      child: Container(
        child: Stack(
          alignment: Alignment.center,
          children: [
            whiteBackground(context),
            MeasuredSize(
              onChange: (size) {
                if (columnSize == null) {
                  columnSize = size;
                  model?.notify();
                }
              },
              child: column,
            ),
          ],
        ),
      ),
    );
  }

  Widget whiteBackground(BuildContext context) {
    final heigth = columnSize?.height ?? 600;
    return Container(
      height: heigth - 290,
      margin: EdgeInsets.only(bottom: 50),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(30.0),
        ),
      ),
    );
  }

  Widget header(BuildContext context) {
    return Container(
      color: Colors.white,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          titleName(),
          optionsButton(context),
        ],
      ),
    );
  }

  Widget requestATradeButton() {
    final member =
        payOut?.members?.firstWhereOrNull((e) => e.userID == model?.user?.id);
    return Visibility(
      visible: (payOut?.currentMonth() ?? 0) < (member?.payoutOrder ?? 0),
      child: Container(
        color: Colors.white,
        alignment: Alignment.topLeft,
        width: double.maxFinite,
        height: 60,
        padding: EdgeInsets.only(left: 25, right: 25, bottom: 25),
        child: Container(
          width: 160,
          child: PoppinsButton.icon(
            content: "Request a trade ",
            textColor: PayPOutColors.PrimaryColor,
            width: 16,
            fontSize: 13,
            borderColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
            margin: 0,
            onTap: () {
              model?.navToRequestATrade(payOut);
            },
          ),
        ),
      ),
    );
  }

  Widget titleName() {
    return Expanded(
      child: Container(
        padding: EdgeInsets.only(left: 25, right: 25, bottom: 27),
        alignment: Alignment.topLeft,
        child: PoppinsText(
          content: payOut?.poolName,
          fontWeight: FontWeight.bold,
          fontSize: 28,
          align: TextAlign.start,
          maxLines: 5,
        ),
      ),
    );
  }

  Widget optionsButton(BuildContext context) {
    return Visibility(
      visible: payOut!.poolStatus == PayOut.pengingStatus &&
          payOut?.userID == model?.user?.id,
      child: IconButton(
        icon: Icon(Icons.more_vert, color: PayPOutColors.PrimaryColor),
        onPressed: () => _showPopupMenu(context),
      ),
    );
  }

  void showDialogAddUserInPayOut(BuildContext context, String userName) {
    model?.dialogScreen(
      context,
      'Added correctly',
      '$userName was successfully added to your friends list',
      SVGImage.checkSuccessIcon,
    );
  }

  Widget nextPaymentWidget(BuildContext context) {
    final isShowPaymentWidget = payOut?.poolStatus == PayOut.progressStatus;
    return Container(
      color: Colors.white,
      child: Visibility(
        visible: payOut?.userToPay != null && isShowPaymentWidget,
        child: Container(
          color: PayPOutColors.mediumPink,
          alignment: Alignment.topLeft,
          margin: EdgeInsets.zero,
          padding: EdgeInsets.only(left: 25, right: 25, top: 25),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: [
              Row(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        child: PoppinsText(
                            content: "Next Payment",
                            align: TextAlign.left,
                            fontWeight: FontWeight.w600,
                            fontSize: 14,
                            textColor: Colors.black),
                      ),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            padding: EdgeInsets.only(top: 8),
                            child: PoppinsText(
                              content: payOut
                                  ?.nextPaymentDate()
                                  .getDateString("MMM"),
                              fontSize: 16,
                            ),
                          ),
                          Container(
                            child: PoppinsText(
                              content:
                                  payOut?.nextPaymentDate().getDateString("dd"),
                              fontSize: 38,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          Container(
                            padding: EdgeInsets.only(bottom: 16),
                            child: PoppinsText(
                              content: payOut
                                  ?.nextPaymentDate()
                                  .getDateString("yyyy"),
                              fontSize: 16,
                              fontWeight: FontWeight.w100,
                            ),
                          )
                        ],
                      )
                    ],
                  ),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.end,
                      children: [
                        Container(
                          child: PoppinsText(
                              content: "Amount",
                              align: TextAlign.right,
                              fontSize: 14,
                              fontWeight: FontWeight.w600,
                              textColor: Colors.black),
                        ),
                        Container(
                          child: PoppinsText(
                              content: payOut?.amountPerDeduction?.toCurrency(),
                              fontSize: 24,
                              fontWeight: FontWeight.bold),
                        ),
                        Container(
                          padding: EdgeInsets.only(top: 20),
                          child: PoppinsText(
                              content: "For:",
                              align: TextAlign.right,
                              fontSize: 14,
                              textColor: Colors.black),
                        ),
                        Container(
                          height: 50,
                          padding: EdgeInsets.only(bottom: 20),
                          child: Row(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            mainAxisAlignment: MainAxisAlignment.end,
                            children: [
                              GestureDetector(
                                child: ProfileImage(
                                  size: 25,
                                  pathProfile: model
                                      ?.getPhotoUserCreated(payOut)
                                      ?.getProfileImage(),
                                  secondPathProfile: model
                                      ?.getPhotoUserCreated(payOut)
                                      ?.getSecondProfileImage(payOut?.members),
                                ),
                                onTap: () {
                                  final user =
                                      model?.getNextMemberToPay(payOut);
                                  model?.navToUserDetails(
                                      user!.userID.toString());
                                },
                              ),
                              PoppinsText(
                                content:
                                    "   ${model?.getNameUserCreated(payOut)}",
                                align: TextAlign.right,
                                fontSize: 14,
                                textColor: PayPOutColors.PrimaryColor,
                              )
                            ],
                          ),
                        )
                      ],
                    ),
                  ),
                ],
              ),
              setPaymentButton()
            ],
          ),
        ),
      ),
    );
  }

  Widget setPaymentButton() {
    return Visibility(
      visible: model?.isUserHavePay(payOut) ?? false,
      child: Container(
        width: 180,
        height: 35,
        margin: EdgeInsets.only(bottom: 24),
        child: PoppinsButton.icon(
          content: "Make a payment ",
          textColor: PayPOutColors.PrimaryColor,
          width: 16,
          fontSize: 13,
          imageView: ClipOval(
            child: Container(
              color: PayPOutColors.rose,
              height: 8,
            ),
          ),
          borderColor: PayPOutColors.PrimaryColor,
          fontWeight: FontWeight.bold,
          shadowColor: Colors.black,
          margin: 0,
          onTap: () {
            final member = model?.getNextMemberToPay(payOut);
            model?.navToPaymentType(payOut!, member, () {
              model?.back();
            });
          },
        ),
      ),
    );
  }

  Widget datesWidget() {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 25, right: 25, top: 25),
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
                    content: payOut?.startDate?.toDate(), fontSize: 16),
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
                      textColor: Colors.black),
                ),
                Container(
                  padding: EdgeInsets.only(top: 10),
                  child: PoppinsText(
                      content: payOut?.endDate?.toDate(), fontSize: 16),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget priceWidget() {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 25, right: 25, top: 43),
      child: Row(
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                child: PoppinsText(
                    content: payOut?.poolStatus == PayOut.pengingStatus
                        ? "Monthly transfer"
                        : "Total:",
                    align: TextAlign.left,
                    fontSize: 12,
                    textColor: Colors.black),
              ),
              Container(
                padding: EdgeInsets.only(top: 10),
                child: PoppinsText(
                    content: payOut?.poolStatus == PayOut.pengingStatus
                        ? payOut?.amountPerDeduction?.toCurrency()
                        : payOut?.totalToUserPayment(),
                    fontSize: 16),
              )
            ],
          )
        ],
      ),
    );
  }

  Widget paymetnFrecuency() {
    return Visibility(
      visible: payOut?.poolStatus == PayOut.pengingStatus,
      child: Container(
        color: Colors.white,
        padding: EdgeInsets.only(left: 25, right: 25, top: 43),
        child: Row(
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Container(
                  child: PoppinsText(
                      content: "Transfer frecuency",
                      align: TextAlign.left,
                      fontSize: 12,
                      textColor: Colors.black),
                ),
                Container(
                  padding: EdgeInsets.only(top: 10),
                  child: PoppinsText(
                      content:
                          "Monthly on the ${payOut?.startDate?.date().day.ordinal()}",
                      fontSize: 16),
                )
              ],
            ),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Container(
                    child: PoppinsText(
                        content: "Duration:",
                        align: TextAlign.right,
                        fontSize: 12,
                        textColor: Colors.black),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10),
                    child: PoppinsText(
                        content: model?.allDurationInMonths(payOut) == 1
                            ? "${model?.allDurationInMonths(payOut)} Month"
                            : "${model?.allDurationInMonths(payOut)} Months",
                        fontSize: 16),
                  )
                ],
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget totalLabelWidget(BuildContext context) {
    Offset tapPos;
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 25, top: 16),
      child: Row(
        children: [
          Expanded(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                PoppinsRichText(
                  contents: model?.isAllPaidInMonth(payOut),
                  maxLines: 5,
                  align: TextAlign.center,
                ),
              ],
            ),
          ),
          Visibility(
            visible: false,
            child: GestureDetector(
              onTapUp: (details) {
                RenderBox? box = context.findRenderObject() as RenderBox;
                tapPos = box.globalToLocal(details.globalPosition);
                showInfoDialog(context, '', tapPos.dy);
              },
              child: Container(
                padding: EdgeInsets.only(left: 25, right: 15),
                child: SvgPicture.asset(SVGImage.infoPurpleIcon),
              ),
            ),
          )
        ],
      ),
    );
  }

  Widget separatorWidget() {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 16, right: 16, top: 25),
      child: SeparateLine(),
    );
  }

  Widget invitatorsListWidget(BuildContext context) {
    payOut?.members?.sort(
      (it, it2) => (it2.joinStatus ?? 0).compareTo(it.joinStatus ?? 0),
    );
    final filtersUsers = payOut?.members
        ?.where((e) =>
            e.isShared == 0 ||
            e.isShared == null ||
            (e.isShared == 1 && e.isSlave == 0))
        .toList();

    final members = filtersUsers?.length ?? 0;
    final itemsByHeigth = members.isOdd ? members + 1 : members;

    var size = MediaQuery.of(context).size;
    final double itemHeight = (size.height) / 9;
    final double itemWidth = size.width / 2;

    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(top: 8, left: 16, right: 16),
      height: MediaQuery.of(context).size.width / 8.6 * itemsByHeigth,
      child: GridView.count(
        crossAxisCount: 2,
        childAspectRatio: (itemWidth / itemHeight), //3 / 1.5,
        scrollDirection: Axis.vertical,
        padding: EdgeInsets.zero,
        physics: NeverScrollableScrollPhysics(),
        crossAxisSpacing: 10,
        children: List<Widget>.generate(
          members,
          (index) {
            return inviteCard(context, filtersUsers?[index]);
          },
        ),
      ),
    );
  }

  Widget inviteCard(BuildContext context, PayoutMember? member) {
    return GestureDetector(
      onTap: () {
        model?.navToUserDetails(member?.userID.toString() ?? "");
      },
      child: Stack(
        alignment: Alignment.centerLeft,
        children: [
          Container(
            child: PoppinsButton(
              height: 64,
              cornerRadius: 32,
              borderColor: model?.isPayedInThisMonth(payOut, member) ?? false
                  ? PayPOutColors.PrimaryColor
                  : Colors.white,
              shadowColor: member?.joinStatus == PayoutMember.joined
                  ? PayPOutColors.lightGrey
                  : PayPOutColors.lightGrey.withOpacity(0.1),
              onTap: () {
                model?.navToUserDetails(member?.userID.toString() ?? "");
              },
            ),
          ),
          Row(
            children: [
              Container(
                height: 30,
                margin: EdgeInsets.only(left: 16),
                color: member?.joinStatus == PayoutMember.joined
                    ? Colors.transparent
                    : Colors.white.withOpacity(0.3),
                child: Container(
                  width: 30,
                  margin: EdgeInsets.only(left: 16, right: 8),
                  child: ProfileImage(
                    pathProfile: member?.getProfileImage(),
                    secondPathProfile:
                        member?.getSecondProfileImage(payOut?.members),
                    size: 30,
                    maskColor: member?.joinStatus == PayoutMember.joined
                        ? null
                        : Colors.white.withOpacity(0.4),
                  ),
                ),
              ),
              Column(
                mainAxisAlignment: MainAxisAlignment.center,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  PoppinsText(
                    content: payOut!
                        .nextPaymentDateWithMember(member)
                        .getDateString("MMM dd"),
                    fontWeight: FontWeight.w600,
                    fontSize: 15,
                    textColor: member?.joinStatus == PayoutMember.joined
                        ? Colors.black87
                        : Colors.black87.withOpacity(0.3),
                  ),
                  PoppinsText(
                    content: payOut!
                        .nextPaymentDateWithMember(member)
                        .getDateString("yyyy"),
                    fontSize: 10,
                    textColor: member?.joinStatus == PayoutMember.joined
                        ? Colors.black87
                        : Colors.black87.withOpacity(0.3),
                  )
                ],
              )
            ],
          ),
          Visibility(
            visible: model?.isPayedInThisMonth(payOut, member) ?? false,
            child: Positioned(
              top: 8,
              left: 5,
              child: SvgPicture.asset(
                model?.isPayedIcon(payOut, member) ?? '',
              ),
            ),
          )
        ],
      ),
    );
  }

  Widget separatorInvitorCardWidget() {
    return Container(
      height: 30,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(30.0),
          bottomRight: Radius.circular(30.0),
        ),
        boxShadow: [
          BoxShadow(
            color: PayPOutColors.PrimaryColor.withOpacity(0.3),
            spreadRadius: 2,
            blurRadius: 10,
            offset: Offset(0, 15), // changes position of shadow
          ),
        ],
      ),
    );
  }

  void _showPopupMenu(BuildContext context) async {
    await showMenu(
      context: context,
      position: RelativeRect.fromLTRB(400, 200, 0, 100),
      items: [
        PopupMenuItem(
          height: 30,
          child: Container(
            alignment: Alignment.centerRight,
            child: SvgPicture.asset(SVGImage.close,
                color: PayPOutColors.PrimaryColor),
          ),
        ),

        /// CloseButton
        PopupMenuItem(
          height: 30,
          child: Container(
            width: double.infinity,
            padding: EdgeInsets.only(left: 16),
            child: GestureDetector(
              onTap: () {
                model?.navToCreatePayOut(payOutToEdit: payOut);
              },
              child: Container(
                child: PoppinsText(
                  content: "Edit Payout",
                ),
              ),
            ),
          ),
        ),
        PopupMenuItem(
          height: 10,
          child: Container(
            margin: EdgeInsets.only(top: 12),
            height: 0.5,
            width: double.infinity,
            color: Colors.grey.withOpacity(0.5),
          ),
        ),
        PopupMenuItem(
          height: 60,
          child: Container(
            width: double.infinity,
            padding: EdgeInsets.only(left: 16),
            child: GestureDetector(
              onTap: () {
                showDeleteDialog(context);
              },
              child: Container(
                child: PoppinsText(
                  content: "Delete Payout",
                ),
              ),
            ),
          ),
        )
      ],
      elevation: 8.0,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(18.0),
      ),
    );
  }

  void showDeleteDialog(BuildContext context) {
    showOptionsDialog(
      context,
      "Delete Payout",
      "Are you sure you want to delete this payout? Members who have already joined will be removed from the group.",
      SVGImage.deleteSignalIcon,
      aceptTitleBtn: "Confirm",
      cancelTitleBtn: "Cancel",
      onAceptClick: () {
        showLoader();
        Navigator.of(context, rootNavigator: true).pop();
        final poolID = payOut?.poolID.toString() ?? '';
        model?.deletePayOut(poolID, () {
          hideLoader();
          model?.navToPayOutHome();
        }, () {
          hideLoader();
          print('error to delete payout');
        });
      },
      onCancelClick: () {
        Navigator.of(context, rootNavigator: true).pop();
      },
    );
  }

  Widget separatorTabbar() {
    return Container(
      height: 150,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () {
              model?.back();
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
              model?.back();
              model?.navToNotifications();
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () => model?.navToCreatePayOut(),
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          )
        ],
      ),
    );
  }

  Widget tabBarView() {
    return Container(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(model?.indexSelected ?? 0, onClick: (id) {
            model?.indexSelected = id;
            model?.notify();
          })
        ],
      ),
    );
  }
}
