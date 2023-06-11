import 'package:animated_widgets/widgets/rotation_animated.dart';
import 'package:animated_widgets/widgets/shake_animated_widget.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/profile_image.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/createPayout/viewModel/create_payout_view_model.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class InviteFriendsCreatePayoutScreen extends GeneralScreen {
  InviteFriendsCreatePayoutScreen(
    VoidCallback? onBackCallback, {
    required this.initDate,
    required this.orderChangeValue,
    required this.selectUsersChangeValue,
    required this.random,
    required this.querySearch,
    this.payOutToEdit,
  }) : super(onBackCallback);

  final DateTime? initDate;
  final Function(bool) orderChangeValue;
  final Function(List<User>?) selectUsersChangeValue;
  final PayOut? payOutToEdit;

  final String querySearch;
  bool? random;

  CreatePayoutViewModel? model;

  PayOutTextFieldEditingController searchFieldController =
      new PayOutTextFieldEditingController();

  FocusNode searchFieldFocusNode = FocusNode();

  Widget builderView(BuildContext context, CreatePayoutViewModel model) {
    if (this.model == null) {
      this.model = model;
    }
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<CreatePayoutViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () =>
          CreatePayoutViewModel(context, payoutToEdit: payOutToEdit),
      onModelReady: (model) {
        DatabaseManager.get.getUser().then((meUser) {
          if (payOutToEdit == null) {
            this.model?.addUserHowInvite(meUser);
          }
        });
      },
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        headerView(context),
        model!.isSearching ? searchingView(context) : inviteFriendsView(context)
      ],
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
            content: model!.isSearching ? 'Search' : 'Invite friends',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, right: 32),
          child: PoppinsText(
            align: TextAlign.left,
            maxLines: 6,
            textColor: PayPOutColors.PrimaryAssentColor,
            fontSize: 12,
            content: model!.isSearching
                ? ""
                : 'Search people by their name, email or phone number. If they don\'t have PayOut installed yet, enter their email to invite them.',
          ),
        )
      ],
    );
  }

  Widget searchTextField() {
    searchFieldController.text = model?.queryFriendSearch ?? "";
    return Column(
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
                      selectUsersChangeValue(model?.inviteUsersList);
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
    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 32),
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
                  model?.startSearchFriends();
                  searchFieldFocusNode.requestFocus();
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
                    model?.isSearching = true;
                    model?.notify();
                    searchFieldFocusNode.requestFocus();
                  },
                ),
              )
            ],
          ),
        ),
        randomView(),
        changeOrderTitle(),
        invitatorsListWidget(context)
      ],
    );
  }

  Widget randomView() {
    return Visibility(
      visible: (model?.inviteUsersList.length ?? 0) > 1,
      child: Container(
        margin: EdgeInsets.only(top: 16, bottom: 12, left: 16),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            PoppinsText(
              content: "Randomized group order",
              fontSize: 13,
            ),
            Switch(
              activeColor: PayPOutColors.PrimaryColor,
              value: random ?? false,
              onChanged: (value) {
                orderChangeValue(value);
                if (value) {
                  model?.inviteUsersList.shuffle();
                  model?.notify();
                }
              },
            )
          ],
        ),
      ),
    );
  }

  Widget changeOrderTitle() {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        SeparateLine(),
        Visibility(
          visible: !(model?.inviteUsersList.isEmpty ?? true),
          child: Container(
            height: 44,
            padding: EdgeInsets.only(top: 16, bottom: 8, left: 8),
            child: PoppinsText(
              content: "Hold to change the order or delete",
              fontSize: 12,
              textColor: PayPOutColors.lightGrey,
              align: TextAlign.left,
            ),
          ),
        )
      ],
    );
  }

  Widget invitatorsListWidget(BuildContext context) {
    final items = model?.inviteUsersList.length ?? 0;

    return Container(
      color: Colors.white,
      padding: EdgeInsets.only(left: 12),
      height: (model?.isSearching ?? false) ? 0 : (100.0 * items),
      child: ReorderableListView.builder(
        padding: EdgeInsets.zero,
        onReorder: (oldIndex, newIndex) {
          orderChangeValue(false);
          if (oldIndex < newIndex) {
            newIndex -= 1;
          }
          model?.currentInviteUserSelected = null;
          final item = model?.inviteUsersList.removeAt(oldIndex);
          model?.inviteUsersList.insert(newIndex, item!);
          model?.notify();
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
            child: inviteCard(index, model?.inviteUsersList[index], context),
          );
        },
      ),
    );
  }

  // Card de usuarios invitados al payOut
  Widget inviteCard(int index, User? user, BuildContext context) {
    final date = initDate ?? DateTime.now();
    var newDate = new DateTime(date.year, date.month + index, date.day);

    return Container(
      height: 100,
      color: Colors.white,
      child: GestureDetector(
        onTap: () {
          if (model?.currentInviteUserSelected == index) {
            model?.currentInviteUserSelected = null;
          } else {
            model?.currentInviteUserSelected = index;
          }
          selectUsersChangeValue(model?.inviteUsersList);
        },
        child: Wrap(
          // mainAxisAlignment: MainAxisAlignment.start,
          // crossAxisAlignment: CrossAxisAlignment.start,
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
                      border: Border.all(
                        color: model?.currentInviteUserSelected == index
                            ? PayPOutColors.PrimaryColor
                            : Colors.white,
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
                          height: 45,
                          child: ListView(
                            scrollDirection: Axis.horizontal,
                            children: [
                              Container(
                                height: 30,
                                width: 30,
                                alignment: Alignment.center,
                                child: ProfileImage(
                                  pathProfile: user?.getProfileImage(),
                                  size: 30,
                                ),
                                margin: EdgeInsets.only(right: 8, left: 16),
                              ),
                              Container(
                                height: 30,
                                alignment: Alignment.center,
                                child: PoppinsText(
                                  content: user?.fullName(),
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
                Container(
                  alignment: Alignment.centerRight,
                  child: PoppinsButton.icon(
                    color: Colors.transparent,
                    imageView: Icon(
                      Icons.delete,
                      color: model?.currentInviteUserSelected == index
                          ? PayPOutColors.PrimaryColor
                          : Colors.white,
                    ),
                    width: 25,
                    onTap: () async {
                      var userID =
                          await SharedPreferencesManager.get.getUserID();

                      if (userID == user?.id) {
                        model?.showErrorDialog(
                          context,
                          "Invite friends",
                          "You must be part of this Payout",
                        );
                        return;
                      }

                      if (model?.currentInviteUserSelected == index) {
                        model?.removeUserHowInvite(index);
                      }
                      model?.currentInviteUserSelected = null;
                      selectUsersChangeValue(model?.inviteUsersList);
                    },
                  ),
                )
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
                    "Payout date:  ${newDate.getDateString("MMM d, yyyy")}",
                fontSize: 12,
                align: TextAlign.left,
                textColor: PayPOutColors.PrimaryAssentColor,
              ),
            ),
            Visibility(
              visible: !(index == ((model?.inviteUsersList.length ?? 0) - 1)),
              child: SeparateLine(),
            )
          ],
        ),
      ),
    );
  }

  Widget searchingView(BuildContext context) {
    var count = model?.searchUsersList.length ?? 0;
    return Stack(
      children: [
        if ((model?.searchUsersList.length ?? 0) == 0)
          SizedBox(
            height: MediaQuery.of(context).size.height / 3,
          ),
        if ((model?.searchUsersList.length ?? 0) > 0)
          Container(
            height: MediaQuery.of(context).size.height / 1.5,
            padding: EdgeInsets.only(top: 45, bottom: 8),
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
        searchTextField()
      ],
    );
  }

  // Card de ususarios buscados para invitarlos al payout
  Widget userCard(User? user) {
    return GestureDetector(
      onTap: () {
        model?.addUserHowInvite(user);
        model?.isSearching = false;
        searchFieldFocusNode.unfocus();
        selectUsersChangeValue(model?.inviteUsersList);
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
}
