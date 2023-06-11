import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/keyboard_widget_builder.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';

// ignore: must_be_immutable
class StepWidget extends StatelessWidget {
  StepWidget(this.titleBtn, this.body,
      {required this.onButtonTapped,
      required this.onBackButtonTapped,
      required this.showContentFooter,
      required this.enableFooter,
      this.isAlwaysShowFooter,
      this.onBackActive,
      this.title,
      this.footer,
      this.topPadding = 0});

  String? title;
  final String? titleBtn;
  final Function onButtonTapped;
  final Function onBackButtonTapped;
  final Widget? body;
  final Widget? footer;
  final bool? onBackActive;
  final double? topPadding;
  final bool showContentFooter;
  bool enableFooter = true;

  bool? isAlwaysShowFooter = true;

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        bodyBackground(context),
        Column(
          children: <Widget>[
            if (title != null) headerView(title ?? ""),
            Expanded(child: _body()),
            (footer == null) ? footerView() : footer!
          ],
        )
      ],
    );
  }

  Widget headerView(String title) {
    return Container(
      alignment: Alignment.centerLeft,
      padding: EdgeInsets.only(top: 32, left: 12, bottom: 16),
      child: PoppinsText(
        content: title,
        fontSize: 30,
        fontWeight: FontWeight.bold,
      ),
    );
  }

  Widget footerView() {
    if (!(isAlwaysShowFooter ?? true)) {
      return Container();
    }

    return KeyboardVisibilityBuilder(
      builder: (context, child, isKeyboardVisible) {
        if (isKeyboardVisible) {
          return Container(height: 30);
        } else {
          return Container(
            decoration: BoxDecoration(
              color: enableFooter
                  ? showContentFooter
                      ? Colors.white
                      : PayPOutColors.whitePurple
                  : Colors.white,
              borderRadius: BorderRadius.all(
                Radius.circular(40.0),
              ),
            ),
            child: Column(
              children: <Widget>[
                SeparateLine(),
                Container(
                  alignment: Alignment.topCenter,
                  height: 80,
                  margin:
                      EdgeInsets.only(bottom: 24, top: 8, left: 16, right: 32),
                  child: Visibility(
                    visible: showContentFooter,
                    child: Row(
                      children: <Widget>[
                        Visibility(
                          visible: onBackActive ?? false,
                          child: GestureDetector(
                            onTap: () => onBackButtonTapped(),
                            child: Container(
                                width: 50,
                                margin: EdgeInsets.only(left: 16, right: 12),
                                child: SvgPicture.asset(SVGImage.backRound)),
                          ),
                        ),
                        Expanded(
                          child: PoppinsButton(
                            content: titleBtn ?? "",
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                            textColor: enableFooter
                                ? PayPOutColors.PrimaryColor
                                : PayPOutColors.lightGrey.withOpacity(0.5),
                            color: enableFooter
                                ? PayPOutColors.pink
                                : Colors.white,
                            borderColor: enableFooter
                                ? PayPOutColors.pink
                                : Colors.white,
                            onTap: () => enableFooter ? onButtonTapped() : null,
                          ),
                        )
                      ],
                    ),
                  ),
                )
              ],
            ),
          );
        }
      },
    );
  }

  Widget _body() {
    return Container(
      margin: EdgeInsets.only(left: 16, right: 16, top: 16),
      child: NotificationListener<OverscrollIndicatorNotification>(
        onNotification: (OverscrollIndicatorNotification overScroll) {
          return false;
        },
        child: SingleChildScrollView(
          scrollDirection: Axis.vertical,
          physics: ClampingScrollPhysics(),
          child: body,
        ),
      ),
    );
  }

  Widget bodyBackground(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: topPadding ?? 0, bottom: 16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(
          Radius.circular(40.0),
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
}
