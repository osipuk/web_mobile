import 'dart:developer';

import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/global_data.dart';
import '../constants/sized_box.dart';
import '../services/api_urls.dart';
import '../services/webservices.dart';
import '../widget/CustomTexts.dart';
import '../widget/Customeloader.dart';
import '../widget/custom_text_field.dart';
import '../widget/round_edged_button.dart';
import '../widget/showSnackbar.dart';

class WithdrawMoneyDialog extends StatefulWidget {
  final Map? bankAccountDetails;
  // final double minimumAmount;
  final int withdrawableAmount;
  // final double amountWithdr
  const WithdrawMoneyDialog({
    Key? key,
    required this.bankAccountDetails,
    required this.withdrawableAmount,
  }) : super(key: key);

  @override
  _WithdrawMoneyDialogState createState() => _WithdrawMoneyDialogState();
}

class _WithdrawMoneyDialogState extends State<WithdrawMoneyDialog> {
  bool load = false;
  // TextEditingController amountController = TextEditingController();
  TextEditingController bankNameController = TextEditingController();
  TextEditingController bankAddressController = TextEditingController();
  TextEditingController accountNumberController = TextEditingController();
  TextEditingController accountHolderNameController = TextEditingController();
  TextEditingController routingNumberController = TextEditingController();
  TextEditingController zipcodeController = TextEditingController();
  TextEditingController swiftCodeController = TextEditingController();
  // TextEditingController cityController = TextEditingController();
  // TextEditingController countryCodeController = TextEditingController();
  String? errorAmountText;

  initializeData() async {
    print('hddd ${widget.bankAccountDetails}');
    bankNameController.text = widget.bankAccountDetails!['bank_name']??'';
    bankAddressController.text = widget.bankAccountDetails!['bank_address']??'';
    accountNumberController.text = widget.bankAccountDetails!['account_no']??'';
    accountHolderNameController.text =
    widget.bankAccountDetails!['user_name']??'';
    routingNumberController.text = widget.bankAccountDetails!['routing']??'';
    swiftCodeController.text = widget.bankAccountDetails!['code']??'';
    zipcodeController.text = widget.bankAccountDetails!['zipcode']??'';
    // 'bank_name': bankNameController.text,
    // 'bank_address':bankAddressController.text,
    // 'account_no': accountNumberController.text,
    // 'username': accountHolderNameController.text,
    // 'routing': routingNumberController.text,
    // 'code': swiftCodeController.text,
    // 'zipcode':zipcodeController.text,
    setState(() {});
  }

  @override
  void initState() {
    // TODO: implement initState
    if (widget.bankAccountDetails != null) {
      initializeData();
    }
    // amountController.text=widget.withdrawableAmount.toString();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    log(widget.bankAccountDetails.toString());
    return Container(
      height: 650,
      decoration: BoxDecoration(
        color: Colors.transparent,
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        body: load
            ? CustomLoader()
            : SingleChildScrollView(
          physics: BouncingScrollPhysics(),
          child: Container(
            padding: EdgeInsets.symmetric(horizontal: 16),
            decoration: BoxDecoration(
                color: MyColors.whitelight,
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(26),
                  topRight: Radius.circular(26),
                )
            ),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                vSizedBox4,
                Center(
                    child: SubHeadingText(
                      'Enter Your Bank Details!',
                      color: MyColors.primaryColor,
                    )),
                vSizedBox2,
                // SubHeadingText('Enter amount'),
                // vSizedBox,
                // CustomTextField(
                //   hintcolor: Colors.black,
                //   controller: amountController,
                //   hintText: 'Enter amount',
                //   keyboardType: TextInputType.number,
                //   onChanged: (val) {
                //     double amount = 0;
                //     if (val != '') {
                //       try {
                //         amount = double.parse(val);
                //         if (amount > widget.minimumAmount) {
                //           if (amount <=
                //               double.parse(userData!.diamonds.toString())) {
                //             errorAmountText = null;
                //           } else {
                //             errorAmountText =
                //                 'You don\'nt have sufficient balance in your wallet.';
                //           }
                //         } else {
                //           errorAmountText =
                //               'The minimum amount for withdrawal is ${widget.minimumAmount}';
                //         }
                //       } catch (e) {
                //         errorAmountText = 'Invalid amount entered';
                //       }
                //     } else {
                //       errorAmountText = null;
                //     }
                //     setState(() {});
                //   },
                //   errorText: errorAmountText,
                // ),
                //
                // vSizedBox,
                // CustomTextField(
                //     hintcolor: Colors.black,
                //     controller: amountController,
                //     hintText: 'Amount',
                //     verticalPadding: 8),
                vSizedBox,
                CustomTextField(
                    hintcolor: Colors.black,
                    controller: accountHolderNameController,
                    hintText: 'Account Holder Name',
                    verticalPadding: 8),
                vSizedBox,

                Row(
                  children: [
                    Expanded(
                        child: CustomTextField(
                            hintcolor: Colors.black,
                            controller: bankNameController,
                            hintText: 'Bank Name',
                            verticalPadding: 8)),
                    hSizedBox05,
                    Expanded(
                      child:  CustomTextField(
                          hintcolor: Colors.black,
                          controller: routingNumberController,
                          hintText: 'Routing Number',
                          verticalPadding: 8),),
                  ],
                ),
                vSizedBox,
                CustomTextField(
                    hintcolor: Colors.black,
                    controller: accountNumberController,
                    hintText: 'Account No.',
                    verticalPadding: 8),

                vSizedBox,
                CustomTextField(
                    hintcolor: Colors.black,
                    controller: bankAddressController,
                    hintText: 'Bank Address',
                    maxLines: 3,
                    verticalPadding: 8),
                // vSizedBox,
                // Row(
                //   children: [
                //     Expanded(
                //         child: CustomTextField(
                //             hintcolor: Colors.black,
                //             controller: cityController,
                //             hintText: 'Enter city',
                //             verticalPadding: 8)),
                //     hSizedBox05,
                //     Expanded(
                //         child: CustomTextField(
                //           hintcolor: Colors.black,
                //           controller: countryCodeController,
                //           hintText: 'Country',
                //           verticalPadding: 8,
                //         )),
                //
                //   ],
                // ),
                vSizedBox,
                Row(
                  children: [
                    Expanded(
                        child: CustomTextField(
                            hintcolor: Colors.black,
                            controller: zipcodeController,
                            hintText: 'Enter zip code',
                            verticalPadding: 8)),
                    hSizedBox05,
                    Expanded(
                        child: CustomTextField(
                          hintcolor: Colors.black,
                          controller: swiftCodeController,
                          hintText: 'Swift Code',
                          verticalPadding: 8,
                        )),

                  ],
                ),

                vSizedBox2,
                RoundEdgedButton(
                  text: 'Withdraw',
                  onTap: () async {
                    if (accountHolderNameController.text == '') {
                      showSnackbar('Please Enter Account Holder Name.');
                    } else if (bankNameController.text == '') {
                      showSnackbar('Please Enter Bank Name.');
                    }else if (routingNumberController.text == '') {
                      showSnackbar('Please Enter Account Routing Number.');
                    }  else if (accountNumberController.text == '') {
                      showSnackbar('Please Enter Account Number.');
                    } else if (bankAddressController.text == '') {
                      showSnackbar('Please Enter Your Bank Address.');
                    }
                    // else if (cityController.text == '') {
                    //   showSnackbar('Please Enter City.');
                    // }  else if (countryCodeController.text == '') {
                    //   showSnackbar('Please Enter  Country.');
                    // }
                    else if (zipcodeController.text == '') {
                      showSnackbar('Please Enter Zip Code.');
                    }  else if (swiftCodeController.text == '') {
                      showSnackbar('Please Enter Account Swift Code.');
                    } else {
                      setState(() {
                        load = true;
                      });
                      var res =await Webservices.getMap(ApiUrls.settingsAdmin);
                      print("res ----------"+res.toString());
                      var diamond_to_usd = res['diamond_to_usd'];
                      print("res ---diamond_to_usd-------"+diamond_to_usd.toString());

                      var request = {
                        'user_id': userData!.id,
                        'redeem_type':'1',
                        'bank_name': bankNameController.text,
                        'bank_address':bankAddressController.text,
                        // 'amount': amountController.text,
                        'account_no': accountNumberController.text,
                        'username':
                        accountHolderNameController.text,
                        'routing': routingNumberController.text,
                        'code': swiftCodeController.text,
                        'zipcode':zipcodeController.text,
                        // 'diamond':(int.parse(amountController.text)*(int.parse(diamond_to_usd))).toString(),
                        // 'city':cityController.text,
                        // 'country':countryCodeController.text


                      };
                      var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.withdrawalRequest, request: request, showSuccessMessage: true);
                      if(jsonResponse['status']==1){
                        Navigator.pop(context);
                      }else{
                        setState(() {
                          load = false;
                        });
                      }
                    }
                  },
                ),
                vSizedBox2,
              ],
            ),
          ),
        ),
      ),
    );
  }
}

// import 'dart:developer';
//
// import 'package:flutter/material.dart';
//
// import '../constants/colors.dart';
// import '../constants/global_data.dart';
// import '../constants/sized_box.dart';
// import '../services/api_urls.dart';
// import '../services/webservices.dart';
// import '../widget/CustomTexts.dart';
// import '../widget/Customeloader.dart';
// import '../widget/custom_text_field.dart';
// import '../widget/round_edged_button.dart';
// import '../widget/showSnackbar.dart';
//
// class WithdrawMoneyDialog extends StatefulWidget {
//   final Map? bankAccountDetails;
//   // final double minimumAmount;
//   final int withdrawableAmount;
//   // final double amountWithdr
//   const WithdrawMoneyDialog({
//     Key? key,
//     required this.bankAccountDetails,
//     required this.withdrawableAmount,
//   }) : super(key: key);
//
//   @override
//   _WithdrawMoneyDialogState createState() => _WithdrawMoneyDialogState();
// }
//
// class _WithdrawMoneyDialogState extends State<WithdrawMoneyDialog> {
//   bool load = false;
//   TextEditingController amountController = TextEditingController();
//   TextEditingController bankNameController = TextEditingController();
//   TextEditingController bankAddressController = TextEditingController();
//   TextEditingController accountNumberController = TextEditingController();
//   TextEditingController accountHolderNameController = TextEditingController();
//   TextEditingController routingNumberController = TextEditingController();
//   TextEditingController zipcodeController = TextEditingController();
//   TextEditingController swiftCodeController = TextEditingController();
//   TextEditingController cityController = TextEditingController();
//   TextEditingController countryCodeController = TextEditingController();
//   String? errorAmountText;
//
//   initializeData() async {
//     bankNameController.text = widget.bankAccountDetails!['bank_name'];
//     accountNumberController.text = widget.bankAccountDetails!['acount_no'];
//     accountHolderNameController.text =
//         widget.bankAccountDetails!['acount_holder_name'];
//     routingNumberController.text = widget.bankAccountDetails!['routing_no'];
//     swiftCodeController.text = widget.bankAccountDetails!['swift_code'];
//     setState(() {});
//   }
//
//   @override
//   void initState() {
//     // TODO: implement initState
//     if (widget.bankAccountDetails != null) {
//       initializeData();
//     }
// amountController.text=widget.withdrawableAmount.toString();
//     super.initState();
//   }
//
//   @override
//   Widget build(BuildContext context) {
//     log(widget.bankAccountDetails.toString());
//     return Container(
//       // height: 560 + MediaQuery.of(context).viewInsets.bottom,
//       padding: EdgeInsets.symmetric(horizontal: 16),
//       decoration: BoxDecoration(
//           color: Colors.white,
//           borderRadius: BorderRadius.only(
//             topLeft: Radius.circular(20),
//             topRight: Radius.circular(20),
//           )),
//       child: Scaffold(
//         body: load
//             ? CustomLoader()
//             : SingleChildScrollView(
//           physics: BouncingScrollPhysics(),
//                 child: Column(
//                   mainAxisSize: MainAxisSize.min,
//                   crossAxisAlignment: CrossAxisAlignment.start,
//                   children: [
//                     vSizedBox4,
//                     Center(
//                         child: SubHeadingText(
//                       'Enter Your Bank Details!',
//                       color: MyColors.primaryColor,
//                     )),
//                     vSizedBox2,
//                     // SubHeadingText('Enter amount'),
//                     // vSizedBox,
//                     // CustomTextField(
//                     //   hintcolor: Colors.black,
//                     //   controller: amountController,
//                     //   hintText: 'Enter amount',
//                     //   keyboardType: TextInputType.number,
//                     //   onChanged: (val) {
//                     //     double amount = 0;
//                     //     if (val != '') {
//                     //       try {
//                     //         amount = double.parse(val);
//                     //         if (amount > widget.minimumAmount) {
//                     //           if (amount <=
//                     //               double.parse(userData!.diamonds.toString())) {
//                     //             errorAmountText = null;
//                     //           } else {
//                     //             errorAmountText =
//                     //                 'You don\'nt have sufficient balance in your wallet.';
//                     //           }
//                     //         } else {
//                     //           errorAmountText =
//                     //               'The minimum amount for withdrawal is ${widget.minimumAmount}';
//                     //         }
//                     //       } catch (e) {
//                     //         errorAmountText = 'Invalid amount entered';
//                     //       }
//                     //     } else {
//                     //       errorAmountText = null;
//                     //     }
//                     //     setState(() {});
//                     //   },
//                     //   errorText: errorAmountText,
//                     // ),
//                     //
//                     // vSizedBox,
//                     // CustomTextField(
//                     //     hintcolor: Colors.black,
//                     //     controller: amountController,
//                     //     hintText: 'Amount',
//                     //     verticalPadding: 8),
//                     vSizedBox,
//                     CustomTextField(
//                         hintcolor: Colors.black,
//                         controller: accountHolderNameController,
//                         hintText: 'Account Holder Name',
//                         verticalPadding: 8),
//                     vSizedBox,
//
//                     Row(
//                       children: [
//                         Expanded(
//                             child: CustomTextField(
//                                 hintcolor: Colors.black,
//                                 controller: bankNameController,
//                                 hintText: 'Bank Name',
//                                 verticalPadding: 8)),
//                         hSizedBox05,
//                         Expanded(
//                             child:  CustomTextField(
//                                 hintcolor: Colors.black,
//                                 controller: routingNumberController,
//                                 hintText: 'Routing Number',
//                                 verticalPadding: 8),),
//                       ],
//                     ),
//                     vSizedBox,
//                     CustomTextField(
//                         hintcolor: Colors.black,
//                         controller: accountNumberController,
//                         hintText: 'Account No.',
//                         verticalPadding: 8),
//
//                     vSizedBox,
//                     CustomTextField(
//                         hintcolor: Colors.black,
//                         controller: bankAddressController,
//                         hintText: 'Bank Address',
//                         maxLines: 3,
//                         verticalPadding: 8),
//                     vSizedBox,
//                     Row(
//                       children: [
//                         Expanded(
//                             child: CustomTextField(
//                                 hintcolor: Colors.black,
//                                 controller: cityController,
//                                 hintText: 'Enter city',
//                                 verticalPadding: 8)),
//                         hSizedBox05,
//                         Expanded(
//                             child: CustomTextField(
//                           hintcolor: Colors.black,
//                           controller: countryCodeController,
//                           hintText: 'Country',
//                           verticalPadding: 8,
//                         )),
//
//                       ],
//                     ),
//                     vSizedBox,
//                     Row(
//                       children: [
//                         Expanded(
//                             child: CustomTextField(
//                                 hintcolor: Colors.black,
//                                 controller: zipcodeController,
//                                 hintText: 'Enter zip code',
//                                 verticalPadding: 8)),
//                         hSizedBox05,
//                         Expanded(
//                             child: CustomTextField(
//                               hintcolor: Colors.black,
//                               controller: swiftCodeController,
//                               hintText: 'Swift Code',
//                               verticalPadding: 8,
//                             )),
//
//                       ],
//                     ),
//
//                     vSizedBox2,
//                     RoundEdgedButton(
//                       text: 'Withdraw',
//                       onTap: () async {
//                      if (accountHolderNameController.text == '') {
//                           showSnackbar('Please Enter Account Holder Name.');
//                         } else if (bankNameController.text == '') {
//                           showSnackbar('Please Enter Bank Name.');
//                         }else if (routingNumberController.text == '') {
//                           showSnackbar('Please Enter Account Routing Number.');
//                         }  else if (accountNumberController.text == '') {
//                           showSnackbar('Please Enter Account Number.');
//                         } else if (bankAddressController.text == '') {
//                           showSnackbar('Please Enter Your Bank Address.');
//                         }else if (cityController.text == '') {
//                           showSnackbar('Please Enter City.');
//                         }  else if (countryCodeController.text == '') {
//                           showSnackbar('Please Enter  Country.');
//                         }else if (zipcodeController.text == '') {
//                           showSnackbar('Please Enter Zip Code.');
//                         }  else if (swiftCodeController.text == '') {
//                           showSnackbar('Please Enter Account Swift Code.');
//                         } else {
//                           setState(() {
//                             load = true;
//                           });
//                           var res =await Webservices.getMap(ApiUrls.settingsAdmin);
//                           print("res ----------"+res.toString());
//                           var diamond_to_usd = res['diamond_to_usd'];
//                           print("res ---diamond_to_usd-------"+diamond_to_usd.toString());
//
//                           var request = {
//                             'user_id': userData!.id,
//                             'redeem_type':'1',
//                             'bank_name': bankNameController.text,
//                             'bank_address':bankAddressController.text,
//                             'amount': amountController.text,
//                             'account_no': accountNumberController.text,
//                             'username':
//                                 accountHolderNameController.text,
//                             'routing': routingNumberController.text,
//                             'code': swiftCodeController.text,
//                             'zipcode':zipcodeController.text,
//                           'diamond':(int.parse(amountController.text)*(int.parse(diamond_to_usd))).toString(),
//                             'city':cityController.text,
//                             'country':countryCodeController.text
//
//
//                           };
//                           var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.withdrawalRequest, request: request, showSuccessMessage: true);
//                           if(jsonResponse['status']==1){
//                             Navigator.pop(context);
//                           }else{
//                             setState(() {
//                               load = false;
//                             });
//                           }
//                         }
//                       },
//                     ),
//                   ],
//                 ),
//               ),
//       ),
//     );
//   }
// }
