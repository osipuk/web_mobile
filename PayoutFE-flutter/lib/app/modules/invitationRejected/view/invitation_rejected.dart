import 'package:animated_widgets/widgets/rotation_animated.dart';
import 'package:animated_widgets/widgets/shake_animated_widget.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:measured_size/measured_size.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/bottomBar/bottom_nav_bar.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/invitationRejected/viewModel/invitation_rejected_view_model.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';
import 'package:collection/collection.dart';

// ignore: must_be_immutable
class InviteRejectedPayoutScreen extends GeneralScreen {
  InviteRejectedPayoutScreen(
    VoidCallback? onBackCallback, {
    @queryParam this.payOut,
  }) : super(onBackCallback);

  final PayOut? payOut;

  String querySearch = '';

  Size? columnSize;

  InviteRejectedViewModel? model;

  PayOutTextFieldEditingController searchFieldController =
      new PayOutTextFieldEditingController();

  FocusNode searchFieldFocusNode = FocusNode();

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<InviteRejectedViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => InviteRejectedViewModel(context, payout: payOut),
      onModelReady: (model) => onModelReady(model),
    );
  }

  void onModelReady(InviteRejectedViewModel model) {
    this.model = model;
    model.currentInviteUserSelected = payOut?.members
        ?.indexWhere((e) => e.joinStatus == PayoutMember.rejected);

    if ((model.currentInviteUserSelected ?? -1) < 0) {
      model.currentInviteUserSelected = null;
    }
    model.notify();
  }

  Widget builderView(BuildContext context, InviteRejectedViewModel model) {
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
      height: 80,
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
      height: 40,
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
        headerView(context),
        model?.isSearching ?? false
            ? searchingView(context)
            : inviteFriendsView(context),
        invitatorsListWidget(context),
        footerView(context),
        separatorTabbar()
      ],
    );

    return SingleChildScrollView(
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: 24),
        margin: EdgeInsets.only(top: 64, bottom: 64),
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
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(30.0),
        ),
      ),
    );
  }

  Widget headerView(BuildContext context) {
    final user = payOut?.members?[model?.currentInviteUserSelected ?? 0];
    return Container(
      color: Colors.white,
      child: Column(
        children: <Widget>[
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 24, bottom: 16),
            child: PoppinsText(
              align: TextAlign.left,
              content: 'Invite new friend',
              fontWeight: FontWeight.bold,
              fontSize: 28,
            ),
          ),
          Visibility(
            visible: model?.currentInviteUserSelected != null,
            child: Container(
              width: double.infinity,
              margin: EdgeInsets.only(left: 24, right: 24, bottom: 16),
              child: PoppinsText(
                align: TextAlign.left,
                maxLines: 6,
                textColor: PayPOutColors.PrimaryAssentColor,
                fontSize: 12,
                content: (model?.isSearching ?? false)
                    ? ""
                    : 'add a new user to take the place of ${user?.allName()} in the payout',
              ),
            ),
          )
        ],
      ),
    );
  }

  Widget searchTextField() {
    searchFieldController.text = model?.queryFriendSearch ?? "";
    return Column(
      children: <Widget>[
        Container(
          height: 50,
          alignment: Alignment.center,
          padding: EdgeInsets.only(left: 24),
          margin: EdgeInsets.only(left: 16, right: 16),
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
                    model?.searchUsers(value, false);
                  },
                  textAlignVertical: TextAlignVertical.center,
                  keyboardType: TextInputType.text,
                  textInputAction: TextInputAction.done,
                  textCapitalization: TextCapitalization.words,
                  autocorrect: false,
                  onSubmitted: (value) {
                    model?.searchUsers(value, true, onNewEmail: (email) {
                      User user = User(
                        email: email,
                        firstName: email,
                        lastName: '',
                        registered: false,
                      );
                      model?.addUserHowInvite(user);
                      model?.isSearching = false;
                      searchFieldFocusNode.unfocus();
                      // selectUsersChangeValue(model?.inviteUsersList);
                    });
                    searchFieldFocusNode.unfocus();
                    hideKeyboard();
                  },
                  style: TextStyle(
                    fontSize: 16,
                    color: PayPOutColors.PrimaryColor,
                    fontFamily: GeneralConstants.poppinsFont,
                  ),
                  decoration: InputDecoration(
                    hintText: "Add friends to the payout",
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
                    model?.isSearching = false;
                    model?.notify();
                  },
                ),
              )
            ],
          ),
        )
      ],
    );
  }

  Widget inviteFriendsView(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(left: 16, right: 16),
      child: Column(
        children: <Widget>[
          Container(
            width: double.infinity,
            margin: EdgeInsets.only(left: 24, top: 8),
            child: PoppinsText(
              align: TextAlign.left,
              content: 'Search friends',
            ),
          ),
          Container(
            height: 45,
            alignment: Alignment.center,
            margin: EdgeInsets.only(top: 12, bottom: 16),
            padding: EdgeInsets.only(left: 24, right: 8),
            decoration: BoxDecoration(
              border: Border.all(color: PayPOutColors.lightGrey, width: 1),
              borderRadius: BorderRadius.all(Radius.circular(15.0)),
            ),
            child: ListView(
              physics: NeverScrollableScrollPhysics(),
              scrollDirection: Axis.horizontal,
              children: <Widget>[
                GestureDetector(
                  onTap: () {
                    if (model?.currentInviteUserSelected == null) {
                      print("seleccione un usuario");
                    } else {
                      model?.isSearching = true;
                      model?.startSearchFriends();
                      model?.notify();
                      searchFieldFocusNode.requestFocus();
                    }
                  },
                  child: Container(
                    height: 50,
                    alignment: Alignment.centerLeft,
                    width: MediaQuery.of(context).size.width / 1.75,
                    child: PoppinsText(
                      align: TextAlign.left,
                      content: "Add friends to the payout",
                      textColor: PayPOutColors.lightGrey,
                    ),
                  ),
                ),
                Container(
                  child: PoppinsButton.icon(
                    height: 50,
                    width: 20,
                    imageView: Icon(
                      Icons.search,
                      size: 20,
                      color: PayPOutColors.PrimaryColor,
                    ),
                    onTap: () {
                      if (model?.currentInviteUserSelected == null) {
                        print("seleccione un usuario");
                      } else {
                        model?.isSearching = true;
                        model?.startSearchFriends();
                        model?.notify();
                        searchFieldFocusNode.requestFocus();
                      }
                    },
                  ),
                )
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget invitatorsListWidget(BuildContext context) {
    final items = model?.getUsers().length ?? 0;

    double minHeigth = MediaQuery.of(context).size.height * 0.35;
    double heigth = (model?.isSearching ?? false) ? 0 : (90.0 * items);

    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 32, right: 32),
      height: heigth < minHeigth ? minHeigth : heigth,
      child: ReorderableListView.builder(
        padding: EdgeInsets.zero,
        buildDefaultDragHandles: false,
        onReorder: (oldIndex, newIndex) {
          // orderChangeValue(false);
          if (oldIndex < newIndex) {
            newIndex -= 1;
          }
          // model?.currentInviteUserSelected = null;
          // final item = model?.inviteUsersList.removeAt(oldIndex);
          // model?.inviteUsersList.insert(newIndex, item!);
          // model?.notify();
        },
        proxyDecorator: (child, index, animation) {
          return ShakeAnimatedWidget(
            enabled: true,
            duration: Duration(milliseconds: 300),
            shakeAngle: Rotation.deg(z: 5),
            curve: Curves.linear,
            child: child,
          );
        },
        physics: NeverScrollableScrollPhysics(),
        itemCount: items,
        itemBuilder: (context, index) {
          return Container(
            key: Key(
              index.toString(),
            ),
            child: inviteCard(index, model?.getUsers()[index], context),
          );
        },
      ),
    );
  }

  // Card de usuarios invitados al payOut
  Widget inviteCard(int index, PayoutMember? user, BuildContext context) {
    User? currentMember = model!.inviteUsersList.entries
        .firstWhereOrNull((e) => e.key == index)
        ?.value;

    return Container(
      height: 90,
      color: Colors.white,
      child: GestureDetector(
        onTap: () {
          if (user?.joinStatus == PayoutMember.rejected) {
            if (model?.currentInviteUserSelected == index) {
              model?.currentInviteUserSelected = null;
            } else {
              model?.currentInviteUserSelected = index;
            }
          }
          model?.notify();
          // selectUsersChangeValue(model?.inviteUsersList);
        },
        child: Stack(
          children: [
            Wrap(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    PoppinsText(
                      textColor: PayPOutColors.PrimaryAssentColor,
                      content: "${index + 1}.",
                      fontWeight: FontWeight.w600,
                      fontSize: 14,
                    ),
                    Expanded(
                      child: Container(
                        height: 45,
                        margin: EdgeInsets.only(left: 12),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.all(Radius.circular(27.0)),
                          border: Border.all(
                            color: model?.currentInviteUserSelected == index
                                ? PayPOutColors.PrimaryColor
                                : Colors.white,
                            width: 1,
                          ),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.2),
                              spreadRadius: 0,
                              blurRadius: 10,
                              offset:
                                  Offset(0, 5), // changes position of shadow
                            ),
                          ],
                        ),
                        child: Stack(
                          alignment: Alignment.bottomLeft,
                          children: [
                            Container(
                              height: 45,
                              child: ListView(
                                scrollDirection: Axis.horizontal,
                                children: [
                                  Container(
                                    height: 30,
                                    width: 30,
                                    alignment: Alignment.center,
                                    child: ProfileImage(
                                      pathProfile:
                                          currentMember?.getProfileImage() ??
                                              user?.getProfileImage(),
                                      secondPathProfile:
                                          user?.getSecondProfileImage(
                                              payOut?.members),
                                      size: 30,
                                    ),
                                    margin: EdgeInsets.only(right: 8, left: 16),
                                  ),
                                  Container(
                                    height: 30,
                                    alignment: Alignment.center,
                                    child: PoppinsText(
                                      content: currentMember?.fullName() ??
                                          user?.getFirstName(payOut?.members),
                                      fontWeight: FontWeight.w600,
                                      fontSize: 12,
                                    ),
                                  ),
                                ],
                              ),
                            )
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
                Padding(
                  padding: const EdgeInsets.only(
                    top: 8,
                    left: 32,
                    bottom: 4,
                  ),
                  child: PoppinsText(
                    content:
                        "Payout date: ${payOut?.nextPaymentDateWithMember(user).getDateString("MMM d, yyyy")}",
                    fontSize: 12,
                    align: TextAlign.left,
                    textColor: PayPOutColors.PrimaryAssentColor,
                  ),
                ),
              ],
            ),
            Visibility(
              visible: user?.joinStatus != PayoutMember.rejected,
              child: Container(
                width: double.maxFinite,
                height: 70,
                color: Colors.white.withOpacity(.5),
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget searchingView(BuildContext context) {
    var count = model?.searchUsersList.length ?? 0;
    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(bottom: 16),
      child: Stack(
        children: [
          Container(
            padding: EdgeInsets.only(top: 16, bottom: 8),
            color: Colors.white,
            child: Container(
              height: MediaQuery.of(context).size.height / 1.8,
              padding: EdgeInsets.symmetric(horizontal: 32),
              child: Container(
                child: ListView.builder(
                  itemCount: count,
                  itemBuilder: (context, index) {
                    return Container(
                      child: userCard(model?.searchUsersList[index]),
                    );
                  },
                ),
              ),
              decoration: BoxDecoration(
                border: Border.all(color: Colors.white, width: 1),
                borderRadius: BorderRadius.all(Radius.circular(30.0)),
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
          searchTextField()
        ],
      ),
    );
  }

  // Card de ususarios buscados para invitarlos al payout
  Widget userCard(User? user) {
    return GestureDetector(
      onTap: () {
        if (model!.inviteUsersList.containsValue(user)) {
          print("este usuario ya esta en otra posicicion");
        } else {
          model?.addUserHowInvite(user);
          model?.isSearching = false;
          searchFieldFocusNode.unfocus();
          model?.notify();
        }
        // selectUsersChangeValue(model?.inviteUsersList);
      },
      child: Container(
        height: 45,
        width: double.infinity,
        color: Colors.white,
        margin: EdgeInsets.only(left: 8, right: 16),
        child: Stack(
          alignment: Alignment.bottomLeft,
          children: [
            Container(
              height: 50,
              child: Row(
                children: [
                  Container(
                    height: 30,
                    width: 40,
                    margin: EdgeInsets.only(right: 8),
                    child: ProfileImage(
                      pathProfile: user?.getProfileImage(),
                      size: 30,
                    ),
                  ),
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      PoppinsText(
                        content: user?.fullName(),
                        fontWeight: FontWeight.w600,
                        fontSize: 14,
                      ),
                    ],
                  ),
                ],
              ),
            ),
            Container(
              child: SeparateLine(),
            )
          ],
        ),
      ),
    );
  }

  Widget footerView(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(30.0),
          bottomRight: Radius.circular(30.0),
        ),
      ),
      child: Column(
        children: <Widget>[
          SeparateLine(),
          Container(
            alignment: Alignment.center,
            height: 80,
            margin: EdgeInsets.only(top: 8, bottom: 16, left: 8, right: 24),
            child: Row(
              children: <Widget>[
                Visibility(
                  visible: true,
                  child: GestureDetector(
                    onTap: () => model?.back(onValue: onBackCallback),
                    child: Container(
                      width: 50,
                      margin: EdgeInsets.only(left: 16, right: 12),
                      child: SvgPicture.asset(SVGImage.backRound),
                    ),
                  ),
                ),
                Expanded(
                  child: PoppinsButton(
                    content: "Invite",
                    fontWeight: FontWeight.bold,
                    fontSize: 16,
                    color: PayPOutColors.pink,
                    borderColor: PayPOutColors.pink,
                    onTap: () {
                      if (model?.inviteUsersList.isNotEmpty ?? false) {
                        showLoader();
                        model?.sendInviteUser(() => {hideLoader()});
                      }
                    },
                  ),
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
      height: 60,
      color: Colors.transparent,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          GestureDetector(
            onTap: () {
              model?.back(onValue: onBackCallback);
            },
            child: Container(
              width: 60,
              color: Colors.transparent,
            ),
          ),
          GestureDetector(
            onTap: () {
              model?.navToPayOutHome();
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
          PayOutTabBar(model?.indexSelected, onClick: (id) {
            switch (id) {
              case 0:
                model?.back(onValue: onBackCallback);
                break;
              case 1:
                model?.navToPayOutHome();
                model?.navToNotifications();
                break;
              case 2:
                model?.navToCreatePayOut();
                break;
            }
            model?.indexSelected = id;
            model?.notify();
          })
        ],
      ),
    );
  }
}
