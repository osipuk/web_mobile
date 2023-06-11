// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_masked_text2/flutter_masked_text2.dart';
import 'package:flutter_svg/svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_rich_text.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/general/extensions/double_extension.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/requestSplit/viewModel/request_split_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:collection/collection.dart';

// ignore: must_be_immutable
class RequestSplitScreen extends GeneralScreen {
  RequestSplitViewModel? model;

  RequestSplitScreen(
    VoidCallback? onBackCallback, {
    @queryParam required this.payOut,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;

  Size? columnSize;

  PayOutTextFieldEditingController searchFieldController =
      new PayOutTextFieldEditingController();

  FocusNode searchFieldFocusNode = FocusNode();

  MoneyMaskedTextController pricePayoutController =
      new MoneyMaskedTextController(
          leftSymbol: '(\$) ', decimalSeparator: ".", thousandSeparator: ",");

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<RequestSplitViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RequestSplitViewModel(context),
      onModelReady: (model) async {
        model.user = await DatabaseManager.get.getUser();
        model.notify();
      },
    );
  }

  Widget builderView(BuildContext context, RequestSplitViewModel model) {
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
        onTap: () => model?.back(),
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
      onPressed: () => model?.back(),
    );
  }

  Widget bodyCard(BuildContext context) {
    final column = Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        separatorNavBar(),
        onHeaderMainCorner(),
        headerView(context),
        searchTextField(),
        selectedUserWidget(context),
        descriptionInvite(),
        totalUserPriceDetailView(),
        totalPriceDetailView(),
        footerView(context),
        separatorTabbar(),
      ],
    );

    return SingleChildScrollView(
      child: Container(
        margin: marginBottomBody(),
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

  Widget headerView(BuildContext context) {
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 24),
      child: Column(
        children: <Widget>[
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(top: 24),
            child: PoppinsText(
              align: TextAlign.left,
              content: "Request to split",
              fontWeight: FontWeight.bold,
              maxLines: 3,
              fontSize: 28,
            ),
          ),
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(bottom: 16),
            child: PoppinsText(
              align: TextAlign.left,
              content: "payment",
              fontWeight: FontWeight.bold,
              maxLines: 3,
              fontSize: 28,
            ),
          ),
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 16, top: 16),
            child: PoppinsText(
              align: TextAlign.left,
              content: 'Search friends',
            ),
          ),
        ],
      ),
    );
  }

  Widget searchTextField() {
    return Container(
      color: Colors.white,
      child: Container(
        padding: EdgeInsets.only(left: 16, right: 16, top: 16),
        margin: EdgeInsets.only(bottom: 28),
        child: Column(
          children: <Widget>[
            Container(
              height: 50,
              alignment: Alignment.center,
              padding: EdgeInsets.only(left: 24, right: 8),
              decoration: BoxDecoration(
                border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
                borderRadius: BorderRadius.all(Radius.circular(15.0)),
                color: Colors.white,
              ),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Expanded(
                    child: TextField(
                      focusNode: searchFieldFocusNode,
                      controller: searchFieldController,
                      onChanged: (value) {
                        model?.searchUsers(value);
                      },
                      textAlignVertical: TextAlignVertical.center,
                      keyboardType: TextInputType.text,
                      textInputAction: TextInputAction.done,
                      textCapitalization: TextCapitalization.words,
                      onSubmitted: (value) {
                        model?.searchUsers(value);
                        searchFieldFocusNode.unfocus();
                        hideKeyboard();
                      },
                      style: TextStyle(
                        fontSize: 16,
                        color: PayPOutColors.PrimaryColor,
                        fontFamily: GeneralConstants.poppinsFont,
                      ),
                      decoration: InputDecoration(
                        hintText: "Search",
                        border: InputBorder.none,
                        hintStyle: TextStyle(
                          fontSize: 14,
                          color: Colors.black54,
                          fontFamily: GeneralConstants.poppinsFont,
                        ),
                      ),
                    ),
                  ),
                  Container(
                    alignment: Alignment.centerLeft,
                    child: PoppinsButton.icon(
                      color: Colors.transparent,
                      image: SVGImage.close,
                      onTap: () {
                        searchFieldFocusNode.unfocus();
                        hideKeyboard();
                        // model?.isSearching = false;
                        model?.notify();
                      },
                    ),
                  ),
                ],
              ),
            ),
            Visibility(
              visible: model?.users?.isNotEmpty ?? true,
              child: Container(
                height: (70 * (model?.users?.length ?? 0)) + 16,
                margin: EdgeInsets.only(bottom: 8),
                child: Container(
                  child: ListView.builder(
                    physics: NeverScrollableScrollPhysics(),
                    padding: EdgeInsets.only(top: 8, bottom: 8),
                    itemCount: model?.users?.length ?? 0,
                    itemBuilder: (context, index) {
                      final user = model?.users?[index];
                      return Container(
                        child: userCard(user, false, context),
                      );
                    },
                  ),
                ),
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.white, width: 1),
                  borderRadius: BorderRadius.only(
                    bottomRight: Radius.circular(30.0),
                    bottomLeft: Radius.circular(30.0),
                  ),
                  color: Colors.white,
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.1),
                      spreadRadius: 2,
                      blurRadius: 20,
                      offset: Offset(0, 15), // changes position of shadow
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget selectedUserWidget(BuildContext context) {
    return Visibility(
      visible: model?.selectedUser != null,
      child: Container(
        color: Colors.white,
        height: 90,
        child: Column(
          children: [
            Container(
              padding: EdgeInsets.only(top: 8),
              child: userCard(model?.selectedUser, true, context),
            ),
            SeparateLine()
          ],
        ),
      ),
    );
  }

  // Card de usuarios invitados al payOut
  Widget userCard(User? user, bool isClear, BuildContext context) {
    return Container(
      color: Colors.transparent,
      height: 70,
      padding: EdgeInsets.only(left: 8, right: 16),
      child: Column(
        children: [
          GestureDetector(
            onTap: () {
              searchFieldFocusNode.unfocus();
              model?.selectedUser = user;
              model?.clearUsers();
            },
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Expanded(
                  child: Container(
                    height: 50,
                    margin: EdgeInsets.only(left: 12, bottom: 8),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      border: Border.all(
                        color: Colors.white,
                        width: 1,
                      ),
                      borderRadius: BorderRadius.all(Radius.circular(27.0)),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.2),
                          spreadRadius: 0,
                          blurRadius: 10,
                          offset: Offset(0, 5), // changes position of shadow
                        ),
                      ],
                    ),
                    child: Stack(
                      alignment: Alignment.bottomLeft,
                      children: [
                        Container(
                          height: 50,
                          child: Row(
                            children: [
                              Container(
                                height: 30,
                                width: 30,
                                alignment: Alignment.center,
                                child: ProfileImage(
                                  pathProfile: user?.getProfileImage(),
                                  size: 30,
                                ),
                                margin: EdgeInsets.only(right: 16, left: 16),
                              ),
                              Expanded(
                                child: Container(
                                  height: 30,
                                  alignment: Alignment.centerLeft,
                                  child: PoppinsText(
                                    content: user?.fullName(),
                                    fontWeight: FontWeight.w600,
                                    align: TextAlign.left,
                                    fontSize: 12,
                                  ),
                                ),
                              ),
                              Visibility(
                                visible: isClear,
                                child: Container(
                                  alignment: Alignment.centerRight,
                                  child: PoppinsButton.icon(
                                    color: Colors.transparent,
                                    imageView: Icon(Icons.close,
                                        color: PayPOutColors.PrimaryColor),
                                    width: 30,
                                    onTap: () async {
                                      model?.selectedUser = null;
                                      model?.clearUsers();
                                    },
                                  ),
                                ),
                              )
                            ],
                          ),
                        )
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget descriptionInvite() {
    final user =
        payOut?.members?.firstWhereOrNull((e) => e.userID == model?.user?.id);
    final userDate = payOut?.nextPaymentDateWithMember(user);

    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 24, right: 32, top: 24, bottom: 32),
      child: PoppinsRichText(
        contents: [
          PoppinsRichContent(
            content: 'Request ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: model?.selectedUser?.fullName() ?? "Your friend",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
          PoppinsRichContent(
            content: ' to split every month\'s share with you. On ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: "${userDate?.getDateString("MMM dd, yyyy")} ",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
          PoppinsRichContent(
            content: ', you will also split the payout share in half with ',
            textColor: Colors.black,
          ),
          PoppinsRichContent(
            content: model?.selectedUser?.fullName() ?? "Your friend.",
            textColor: PayPOutColors.PrimaryColor,
            fontWeight: FontWeight.bold,
          ),
        ],
        maxLines: 5,
      ),
    );
  }

  Widget totalUserPriceDetailView() {
    return Container(
      color: Colors.white,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          SeparateLine(),
          Container(
            color: Colors.white,
            padding: EdgeInsets.symmetric(vertical: 24),
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
                        content:
                            "Total from ${model?.selectedUser?.fullName() ?? "your friend"} each month:",
                        maxLines: 2,
                        align: TextAlign.center,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: ((payOut?.amountPerDeduction ?? 0) / 2.0)
                            .toCurrency(),
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
      ),
    );
  }

  Widget totalPriceDetailView() {
    return Container(
      color: Colors.white,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          SeparateLine(),
          Container(
            color: Colors.white,
            padding: EdgeInsets.symmetric(vertical: 24),
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
                        content: "Total from you each month:",
                        maxLines: 2,
                        align: TextAlign.center,
                        fontSize: 12,
                        textColor: Colors.black,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(top: 10),
                      child: PoppinsText(
                        content: ((payOut?.amountPerDeduction ?? 0) / 2.0)
                            .toCurrency(),
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
      ),
    );
  }

  Widget separatorTabbar() {
    return Container(
      height: 160,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () {
              model?.navToPayOutHome();
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
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

  Widget footerView(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(40.0),
          bottomRight: Radius.circular(40.0),
        ),
      ),
      child: Column(
        children: <Widget>[
          SeparateLine(),
          Container(
            alignment: Alignment.topCenter,
            height: 80,
            margin: EdgeInsets.only(bottom: 16, top: 24, left: 16, right: 16),
            child: Row(
              children: <Widget>[
                GestureDetector(
                  onTap: () => {},
                  child: Container(
                    width: 50,
                    margin: EdgeInsets.only(left: 16, right: 12),
                    child: SvgPicture.asset(SVGImage.backRound),
                  ),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: 'Request',
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: model!.isActiveSplitAction()
                        ? PayPOutColors.pink
                        : Colors.white,
                    borderColor: model!.isActiveSplitAction()
                        ? PayPOutColors.pink
                        : Colors.white,
                    textColor: model!.isActiveSplitAction()
                        ? PayPOutColors.PrimaryColor
                        : PayPOutColors.lightGrey,
                    onTap: () => requestASplit(context),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }

  void requestASplit(BuildContext context) {
    if (model!.isActiveSplitAction()) {
      showLoader();
      model?.requestASplit(payOut, () {
        showSplitSuccessDialog(context);
      }, (error) {
        hideLoader();
        model?.showErrorDialog(context, "Error", error);
      });
    }
  }

  void showSplitSuccessDialog(BuildContext context) {
    hideLoader();
    model?.dialogScreen(
      context,
      'Successfully requested',
      "${model?.selectedUser?.fullName() ?? model?.querySearch} has been notified. Feel free to send them a message to remind them about thus in a day or two.",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        Navigator.of(context).pop();
        model?.navToNotifications();
      },
    );
  }

  Widget tabBarView() {
    return Container(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          PayOutTabBar(1, onClick: (id) {
            model?.notify();
          })
        ],
      ),
    );
  }
}
