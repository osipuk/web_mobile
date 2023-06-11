import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:stacked/stacked.dart';

// ignore: must_be_immutable
class GeneralScreen extends GeneralStatelessWidget {
  ScrollController scrollController = ScrollController();

  final VoidCallback? onBackCallback;

  GeneralScreen(this.onBackCallback);

  @override
  Widget build(BuildContext context) {
    return Material(
      type: MaterialType.transparency,
      child: mainBuild(context),
    );
  }

  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<BaseViewModel>.reactive(
      builder: (context, model, child) => generalView(context),
      viewModelBuilder: () => BaseViewModel(),
    );
  }

  Widget generalView(BuildContext context) {
    return WillPopScope(
      onWillPop: () async => !Navigator.of(context).userGestureInProgress,
      child: Scaffold(
        resizeToAvoidBottomInset: true,
        body: Stack(
          children: <Widget>[
            backgroundImage(context),
            generalChidView(context),
          ],
        ),
      ),
    );
  }

  bool onWillPop(BuildContext context) {
    return !Navigator.of(context).userGestureInProgress;
  }

  Widget generalChidView(BuildContext context) {
    return Column(
      children: <Widget>[
        SafeArea(child: onNavBarView(context)),
        Container(child: bodyBackground(context))
      ],
    );
  }

  /// MARK: - Se sobre escribe navBar generica
  Widget onNavBarView(BuildContext context) {
    return Container(
      height: 100,
      padding: EdgeInsets.only(left: 16, bottom: 8),
      alignment: Alignment.bottomLeft,
      child: Row(
        children: <Widget>[
          IconButton(
            icon: Icon(Icons.arrow_back, color: Colors.white),
            onPressed: () => onBackPressed(context),
          )
        ],
      ),
    );
  }

  Widget bodyBackground(BuildContext context) {
    return Expanded(
      child: Container(
        width: MediaQuery.of(context).size.width,
        padding: EdgeInsets.only(right: 16, left: 16, top: 16),
        margin: marginBottomBody(),
        child: NotificationListener<OverscrollIndicatorNotification>(
          onNotification: (OverscrollIndicatorNotification overScroll) {
            //overScroll.disallowGlow();
            return false;
          },
          child: onBodyScrollView(context),
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: borderBottomBody(),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.2),
              spreadRadius: 3,
              blurRadius: 60,
              offset: Offset(0, -5), // changes position of shadow
            ),
          ],
        ),
      ),
    );
  }

  Widget onBodyInitView(BuildContext context) {
    return Container();
  }

  Widget onBodyScrollView(BuildContext context) {
    return SingleChildScrollView(
      controller: scrollController,
      child: onBodyInitView(context),
    );
  }

  /// ------------------------------------------------------------------------------------

  void showErrorDialog(String title, String message, BuildContext context) {
    final dialog = GeneralPopUpScreen(() => {});
    dialog.cTitle = title;
    dialog.cMessage = message;
    dialog.onAceptClick ??= () => Navigator.pop(context);
    showDialog(context: context, builder: (_) => dialog);
  }

  /// MARK: - Se sobre escribe bottomBorder generica
  BorderRadiusGeometry borderBottomBody() {
    return BorderRadius.only(
        topLeft: Radius.circular(35), topRight: Radius.circular(35));
  }

  /// MARK: - Se sobre escribe bottomMargin generica
  EdgeInsetsGeometry marginBottomBody() {
    return EdgeInsets.only(right: 20, left: 20);
  }

  /// MARK: - Imagen de fondo generica
  Widget backgroundImage(BuildContext context) {
    return Container(
      child: SvgPicture.asset(SVGImage.mainBackground, fit: BoxFit.fill),
      width: MediaQuery.of(context).size.width,
      height: MediaQuery.of(context).size.height,
    );
  }

  void onBackPressed(BuildContext context) {}

  void showOptionsDialog(
      BuildContext context, String title, String message, String icon,
      {String aceptTitleBtn = "Ok",
      String cancelTitleBtn = "",
      Function? onAceptClick,
      Function? onCancelClick}) {
    final dialog = GeneralPopUpScreen(() => {});
    dialog.cTitle = title;
    dialog.cMessage = message;
    dialog.cIcon = icon;
    dialog.cButtonTitle = aceptTitleBtn;
    dialog.cnlButtonTitle = cancelTitleBtn;
    dialog.onAceptClick = onAceptClick;
    dialog.onCancelClick = onCancelClick;
    showDialog(
      context: context,
      useSafeArea: false,
      barrierColor: Colors.transparent,
      builder: (_) => dialog,
    );
  }
}
