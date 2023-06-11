import 'dart:async';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_svg/svg.dart';
import 'package:load/load.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';

extension StatelessExtension on StatelessWidget {
  static bool isShowKeyboard = false;
  static bool showLoader = false;

  void hideKeyboard() {
    FocusManager.instance.primaryFocus?.unfocus();
    SystemChannels.textInput.invokeMethod('TextInput.hide');
  }

  void timerPeriodic(Duration duration, Function(Timer) function) {
    Timer.periodic(duration, (timer) {
      function.call(timer);
    });
  }

  void delay(Duration duration, Function function) {
    Timer(duration, () {
      function.call();
    });
  }

  void showInfoDialog(BuildContext context, String message, double posY) async {
    await showMenu(
      context: context,
      position: RelativeRect.fromLTRB(400, posY, 0, 200),
      items: [
        PopupMenuItem(
          height: 20,
          child: Container(
            alignment: Alignment.centerRight,
            child: SvgPicture.asset(SVGImage.close,
                color: PayPOutColors.PrimaryColor),
          ),
        ),
        PopupMenuItem(
          child: Container(
            width: double.infinity,
            padding: EdgeInsets.all(8),
            child: GestureDetector(
              child: Container(
                child: PoppinsText(
                    textColor: PayPOutColors.PrimaryAssentColor,
                    maxLines: 10,
                    content: message),
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
}

void showLoader({tapDismiss = true}) {
  if (!StatelessExtension.showLoader) {
    StatelessExtension.showLoader = true;
    showLoadingDialog(tapDismiss: tapDismiss);
  }
}

void hideLoader() {
  StatelessExtension.showLoader = false;
  hideLoadingDialog();
}

extension MyIterable<E> on Iterable<E> {
  Iterable<E> sortedBy(Comparable key(E e)) =>
      toList()..sort((a, b) => key(a).compareTo(key(b)));
}
