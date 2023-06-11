import 'package:flutter/material.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/ui/general_pop_up.dart';

class GeneralStatelessWidget extends StatelessWidget
    with WidgetsBindingObserver {
  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async => !Navigator.of(context).userGestureInProgress,
      child: Material(
        type: MaterialType.transparency,
        child: mainBuild(context),
      ),
    );
  }

  Widget mainBuild(BuildContext context) {
    return Container();
  }

  @override
  void didChangeMetrics() {
    super.didChangeMetrics();
    final value = WidgetsBinding.instance?.window.viewInsets.bottom;
    if (value == 0) {
      hideKeyboard();
    }
  }

  void unFocus() {
    hideKeyboard();
  }

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
