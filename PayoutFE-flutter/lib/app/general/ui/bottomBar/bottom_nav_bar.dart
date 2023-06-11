import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/blur_widget.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';

// ignore: must_be_immutable
class PayOutTabBar extends StatelessWidget {
  PayOutTabBar(this.indexSelected, {required this.onClick});

  Function(int) onClick;
  final int? indexSelected;

  @override
  Widget build(BuildContext context) {
    return Material(
      type: MaterialType.transparency,
      child: SafeArea(
          child: Align(
        alignment: Alignment.bottomCenter,
        child: Container(
          margin: EdgeInsets.only(bottom: 8),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              tabButton(
                1,
                "Home",
                SVGImage.homeTabIcon,
              ),
              tabButton(
                2,
                "Notifications",
                SVGImage.notTabIcon,
                isBadgeActive: PushNotificationsManager.isPendingNotifications,
              ),
              tabButton(
                3,
                "Create new",
                SVGImage.addPayOutIcon,
              )
            ],
          ),
        ),
      )),
    );
  }

  Widget tabButton(int id, String content, String image,
      {bool isBadgeActive = false}) {
    return Expanded(
      child: GestureDetector(
        onTap: () => onClick.call(id),
        child: Container(
          color: Colors.transparent,
          child: Column(
            children: [
              Stack(
                alignment: Alignment.center,
                children: [
                  Visibility(
                    visible: isBadgeActive,
                    child: Container(
                      width: 40,
                      alignment: Alignment.bottomRight,
                      child: Container(
                        margin: EdgeInsets.only(bottom: 25),
                        child: CircleAvatar(
                          backgroundColor: PayPOutColors.rose,
                          radius: 4,
                        ),
                      ),
                    ),
                  ),
                  Visibility(
                    visible: indexSelected != id,
                    child: Container(
                      height: 2,
                      width: 2,
                      child: BlurWidget(
                        circleWidth: 20,
                        blurSigma: 10,
                        color: Colors.white,
                      ),
                    ),
                  ),
                  Container(
                    child: SvgPicture.asset(
                      image,
                      color: PayPOutColors.pink,
                    ),
                    height: 40,
                  ),
                ],
              ),
              PoppinsText(
                content: content,
                textColor: Colors.white,
                fontWeight: FontWeight.w100,
                fontSize: 12,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
