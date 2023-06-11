import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/ui/general_widget.dart';
import 'package:pay_out/app/general/ui/payout_text_editing.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';

// ignore: must_be_immutable
class RegisterPhoneNumberWidget extends GeneralStatelessWidget {
  final Function(String, String) onChangePhone;
  final String lastPhoneNumber;

  RegisterPhoneNumberWidget(this.lastPhoneNumber,
      {required this.onChangePhone});

  PayOutTextFieldEditingController phoneController =
      new PayOutTextFieldEditingController();

  @override
  Widget build(BuildContext context) {
    return onBodyInitView(context);
  }

  Widget onBodyInitView(BuildContext context) {
    return GestureDetector(
      behavior: HitTestBehavior.opaque,
      onPanStart: (_) {
        unFocus();
      },
      onTap: () {
        unFocus();
      },
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          headerView(),
          entryTextFieldPassword(),
        ],
      ),
    );
  }

  Widget headerView() {
    return Column(
      children: <Widget>[
        Container(
          height: 80,
          width: double.infinity,
          margin: EdgeInsets.only(top: 32, bottom: 32),
          child: SvgPicture.asset(SVGImage.phoneIcon),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16, bottom: 16),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Phone number',
            fontWeight: FontWeight.bold,
            fontSize: 28,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            content: 'Ok, now we will send a code to your phone',
            textColor: PayPOutColors.PrimaryAssentColor,
            align: TextAlign.left,
            maxLines: 3,
            fontSize: 12,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            content: 'to setup multi-factor authentication.',
            textColor: PayPOutColors.PrimaryAssentColor,
            align: TextAlign.left,
            maxLines: 3,
            fontSize: 12,
          ),
        ),
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 16),
          child: PoppinsText(
            content: 'This will help keep your account safe.',
            align: TextAlign.left,
            textColor: PayPOutColors.PrimaryAssentColor,
            maxLines: 3,
            fontSize: 12,
          ),
        )
      ],
    );
  }

  Widget entryTextFieldPassword() {
    phoneController.text = lastPhoneNumber;

    return Column(
      children: <Widget>[
        Container(
          width: double.infinity,
          margin: EdgeInsets.only(left: 24, top: 42),
          child: PoppinsText(
            align: TextAlign.left,
            content: 'Phone Number',
          ),
        ),
        Container(
          height: 45,
          alignment: Alignment.center,
          margin: EdgeInsets.only(top: 12),
          padding: EdgeInsets.only(left: 12, right: 8),
          decoration: BoxDecoration(
            border: Border.all(color: PayPOutColors.PrimaryColor, width: 1),
            borderRadius: BorderRadius.all(Radius.circular(15.0)),
          ),
          child: Row(
            children: <Widget>[
              Container(
                padding: EdgeInsets.only(right: 8, top: 2),
                child: GestureDetector(
                  onTap: () {
                    if (GeneralConstants.countryCode == "57") {
                      GeneralConstants.countryCode = "1";
                    } else {
                      GeneralConstants.countryCode = "57";
                    }
                    onChangePhone(
                        GeneralConstants.countryCode, phoneController.text);
                  },
                  child: PoppinsText(
                    content: '+${GeneralConstants.countryCode}',
                    fontSize: 15,
                  ),
                ),
              ),
              Expanded(
                child: Container(
                  margin: EdgeInsets.only(top: 22),
                  child: TextField(
                    controller: phoneController,
                    onChanged: (phone) {
                      onChangePhone(GeneralConstants.countryCode, phone);
                    },
                    textAlignVertical: TextAlignVertical.center,
                    keyboardType: TextInputType.number,
                    decoration: InputDecoration(
                      hintText: "Phone Number",
                      border: InputBorder.none,
                      hintStyle: TextStyle(
                        fontFamily: GeneralConstants.poppinsFont,
                        color: Colors.black54,
                        fontSize: 15,
                      ),
                    ),
                  ),
                ),
              )
            ],
          ),
        )
      ],
    );
  }
}
