import 'package:Enjoy/changepassword.dart';
import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/contactus.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/notification.dart';
import 'package:Enjoy/profile.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/flutter_in_app_purchase_services.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/new_stripe_services.dart';
import 'package:Enjoy/services/stripe_response_modal.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/welcome.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/block_layout.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';
import 'package:Enjoy/widget/custom_full_page_loader.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';

import 'constants/global_data.dart';
import 'constants/global_keys.dart';

class Get_Coins_Page extends StatefulWidget {
  const Get_Coins_Page({Key? key}) : super(key: key);
  @override
  _Get_Coins_PageState createState() => _Get_Coins_PageState();
}

class _Get_Coins_PageState extends State<Get_Coins_Page> {
  double _currentSliderValue = 20;
  bool show = true;
  bool hide = false;
  bool load = false;
  List purchaseCoinsPackagesList = [];
  List histories = [];
  bool inAppPurchaseLoad = false;

  //TODO: add api for getting diamond history and also update redeem section
  List diamondHistory = [];

  String? selectedDabba;
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    get_coin_list();
    get_info();
    get_history();
  }

  get_info() async {
    Map data = {'user_id':await  userData?.id};
    Map res = await getData(data, 'get_user_profile', 0, 0);
    print('res--------$res');
    if (res['status'].toString() == '1') {
      userData = UserModal.fromJson(res['data']);
      setState(() {

      });
    }
  }

  get_history() async {
    Map data = {'user_id':  userData?.id};
    Map res = await getData(data,'purchaseHistory',0,0);
    print('history--------$res');
    if (res['status'].toString() == '1') {
      histories = res['data'];
      setState(() {

      });
    }
  }



  get_coin_list() async {
    setState(() {
      load = true;
    });
    purchaseCoinsPackagesList = await Webservices.getList(ApiUrls.purchaseCoinsPackages, );

    setState(() {
      load = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.whiteColor,
      body:load?CustomLoader():Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    padding: EdgeInsets.all(16),
                    decoration: BoxDecoration(
                        color: Color(0xFFE9EE00),
                        borderRadius: BorderRadius.only(
                            bottomLeft: Radius.circular(40),
                            bottomRight: Radius.circular(40))),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        vSizedBox2,
                        IconButton(
                          onPressed: () {
                            Navigator.pop(context);
                          },
                          icon: Icon(
                            Icons.arrow_back_outlined,
                            size: 25,
                          ),
                          padding: EdgeInsets.all(0),
                          visualDensity: VisualDensity(horizontal: -4),
                        ),
                        vSizedBox4,
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  ParagraphText(
                                    userData!.gender==UserGender.male? 'My Coins': 'My Diamonds',
                                    fontSize: 14,
                                    fontFamily: 'bold',
                                    color: MyColors.blackColor,
                                  ),
                                  vSizedBox05,
                                  ParagraphText(
                                   userData!.gender==UserGender.male? '${userData!.coins}': '${userData!.diamonds}',
                                    fontSize: 44,
                                    fontFamily: 'bold',
                                    color: Colors.black,
                                  ),
                                  vSizedBox05,
                                  ParagraphText(
                                    'In order to send more messages, to recieve more matches and for many more, buy coins.',
                                    fontSize: 10,
                                    color: MyColors.blackColor,
                                  ),
                                ],
                              ),
                            ),
                            hSizedBox,
                            Expanded(
                                child: Image.asset('assets/coins_banner.png'))
                          ],
                        ),
                        vSizedBox4,
                      ],
                    ),
                  ),
                  vSizedBox2,
                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 50),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        if(userData!.gender==UserGender.male)
                        Column(
                          children: [
                            ParagraphText(
                              'Buy Coins',
                              fontFamily: show ? 'semibold' : 'light',
                              color: show
                                  ? MyColors.secondary
                                  : Colors.black.withOpacity(0.50),
                              fontSize: 16,
                            ),
                            vSizedBox05,
                            if (show == true)
                              Container(
                                height: 2,
                                width: 25,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(2),
                                    color: MyColors.secondary),
                              )
                          ],
                        ),
                        if(userData!.gender==UserGender.female)
                        Column(
                          children: [
                            ParagraphText(
                              'Redeem',
                              fontFamily: hide ? 'semibold' : 'light',
                              color: hide
                                  ? MyColors.secondary
                                  : Colors.black.withOpacity(0.50),
                              fontSize: 16,
                            ),
                            vSizedBox05,
                            if (hide == true)
                              Container(
                                height: 2,
                                width: 25,
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(2),
                                    color: MyColors.secondary),
                              )
                          ],
                        ),
                      ],
                    ),
                  ),
                  if (userData!.gender==UserGender.male)
                    Column(
                      children: [
                        GridView(
                          physics: NeverScrollableScrollPhysics(),
                          shrinkWrap: true,
                          gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                            crossAxisCount: 2,
                            childAspectRatio: 0.8
                          ),
                          children: [
                            for(int i=0;i<purchaseCoinsPackagesList.length;i++)
                            GestureDetector(
                              behavior: HitTestBehavior.translucent,
                              onTap:serverStatus!=1?()async{
                                inAppPurchaseLoad = true;
                                setState(() {

                                });

                                Map<String, dynamic> request = {

                                };
                                print('Calling stripe...............');
                                StripeResponseModal? stripeResponse = await NewStripeServices.makePayment(emailId: userData!.emailId, amount:purchaseCoinsPackagesList[i]['price'],intentType: IntentType.createIntent);
                                if(stripeResponse!=null){
                                  request['stripe_transaction_id']=stripeResponse.clientSecret;
                                  request['customer_id']=stripeResponse.customerId;
                                  Map data = {
                                    'user_id': userData?.id,
                                    'coin_manage_id':purchaseCoinsPackagesList[i]['id'],
                                    'coins_value':purchaseCoinsPackagesList[i]['no_of_coin'],
                                    'coin_amount':purchaseCoinsPackagesList[i]['price'],
                                    'coin_transactions_id':'123456',
                                  };

                                  Map res = await postData(data,'purchaseCoin',0,0);

                                  print('purchase--- $res');
                                  if(res['status'].toString()=='1'){
                                    // Navigator.pop(context);
                                    await MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);

                                  }else{

                                  }
                                  inAppPurchaseLoad = false;
                                  setState(() {

                                  });
                                  // pushReplacement(context: MyGlobalKeys.navigatorKey.currentContext!, screen: Confirm_Decryption(key: confirmDe))


                                }else{
                                  setState(() {
                                    inAppPurchaseLoad = false;
                                  });
                                  // showSnackbar('Inside else');
                                  print('inside stripe response else it is null');
                                }
                              } :() async{
                                selectedDabba = purchaseCoinsPackagesList[i]['id'];
                                inAppPurchaseLoad = true;
                                setState(() {

                                });


                                String productId = purchaseCoinsPackagesList[i]['prodoct_id'];
                                // String productId = 'smallpack';
                                // String productId = 'android.test.purchased';
                                FlutterInAppPurchaseServices inAppServices =
                                FlutterInAppPurchaseServices();
                                // await inAppServices.initData();
                                print('Purchasing product ${productId}');
                                await inAppServices.getInAppPurchaseRequirements(
                                    '${productId}');
                                // 'android.test.purchased');
                                await inAppServices.initData();

                                InAppPurchaseCustomResponse payResponse =await inAppServices.payAndDownload(context);
                                if(payResponse.isSuccessful){
                                  Map data = {
                                    'user_id': userData?.id,
                                    'coin_manage_id':purchaseCoinsPackagesList[i]['id'],
                                    'coins_value':purchaseCoinsPackagesList[i]['no_of_coin'],
                                    'coin_amount':purchaseCoinsPackagesList[i]['price'],
                                    'coin_transactions_id':'123456',
                                  };
                                  loadingShow(context);
                                  Map res = await postData(data,'purchaseCoin',0,0);
                                  loadingHide(context);
                                  print('purchase--- $res');
                                  if(res['status'].toString()=='1'){
                                    // Navigator.pop(context);
                                    await MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);
                                    setState(() {

                                    });
                                  }
                                }else{

                                }
                                inAppPurchaseLoad = false;
                                setState(() {

                                });
                              },
                              child: Stack(
                                alignment: Alignment.center,
                                clipBehavior: Clip.none,
                                children: [
                                  Container(
                                    margin: EdgeInsets.all(10.0),
                                    padding: EdgeInsets.all(10),
                                    decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(20),
                                        image: DecorationImage(
                                            image: AssetImage(
                                              purchaseCoinsPackagesList[i]['title']!='Hot'?"assets/image_1.png":"assets/fire.png",
                                            ),
                                            fit: BoxFit.contain,
                                            alignment: Alignment.bottomCenter),
                                        border: selectedDabba == purchaseCoinsPackagesList[i]['id']?Border.all(
                                            color: MyColors.primaryColor, width: 2):Border.all(
                                            color: MyColors.secondary, width: 2),
                                        boxShadow: [
                                          BoxShadow(
                                            color: Colors.black.withOpacity(0.15),
                                            offset: const Offset(
                                              0,
                                              3.0,
                                            ),
                                            blurRadius: 13.0,
                                            spreadRadius: 0,
                                          ),
                                        ],
                                        color: Colors.white),
                                    child: Column(
                                      children: [
                                        Row(
                                          mainAxisAlignment:
                                          MainAxisAlignment.spaceBetween,
                                          children: [
                                            Row(
                                              children: [
                                                Image.asset(
                                                MyImages.coins,
                                                  height: 20,
                                                  width: 20,
                                                ),
                                                hSizedBox,
                                                ParagraphText(
                                                  '${purchaseCoinsPackagesList[i]['no_of_coin']}',
                                                  color: Colors.black,
                                                )
                                              ],
                                            ),
                                            ParagraphText(
                                              '\$ ${purchaseCoinsPackagesList[i]['price']}',
                                              fontSize: 12,
                                              color: MyColors.primaryColor,
                                            )
                                          ],
                                        ),
                                        vSizedBox2,
                                        Image.network(
                                          purchaseCoinsPackagesList[i]['image'],
                                          height: 52,
                                          width: 52,
                                        ),
                                        vSizedBox,
                                        ParagraphText(
                                          '${purchaseCoinsPackagesList[i]['title']}',
                                          fontSize: 15,
                                          fontFamily: 'bold',
                                        ),
                                        vSizedBox6
                                      ],
                                    ),
                                  ),
                                  if(purchaseCoinsPackagesList[i]['discount'].toString()!='0')
                                  Positioned(
                                    top: -7,
                                    child: Container(
                                      height: 30,
                                      width: 130,
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(50),
                                        color:selectedDabba == purchaseCoinsPackagesList[i]['id']?MyColors.primaryColor:MyColors.secondary,
                                      ),
                                      child: Column(
                                        mainAxisAlignment: MainAxisAlignment.center,
                                        crossAxisAlignment: CrossAxisAlignment.center,
                                        children: [
                                          ParagraphText('${purchaseCoinsPackagesList[i]['discount']}% Discount',color: Colors.white,)
                                        ],
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            )
                          ],
                        ),
                        // Padding(
                        //   padding: const EdgeInsets.symmetric(horizontal: 22.0),
                        //   child: Row(
                        //     children: [
                        //       // for(int i=0;i<coin_lists.length;i++)
                        //       Expanded(
                        //           child: Container(
                        //         padding: EdgeInsets.all(10),
                        //         decoration: BoxDecoration(
                        //             borderRadius: BorderRadius.circular(20),
                        //             image: DecorationImage(
                        //                 image: AssetImage(
                        //                   "assets/image_1.png",
                        //                 ),
                        //                 fit: BoxFit.contain,
                        //                 alignment: Alignment.bottomCenter),
                        //             border: Border.all(
                        //                 color: MyColors.secondary, width: 2),
                        //             boxShadow: [
                        //               BoxShadow(
                        //                 color: Colors.black.withOpacity(0.15),
                        //                 offset: const Offset(
                        //                   0,
                        //                   3.0,
                        //                 ),
                        //                 blurRadius: 13.0,
                        //                 spreadRadius: 0,
                        //               ),
                        //             ],
                        //             color: Colors.white),
                        //         child: Column(
                        //           children: [
                        //             Row(
                        //               mainAxisAlignment:
                        //                   MainAxisAlignment.spaceBetween,
                        //               children: [
                        //                 Row(
                        //                   children: [
                        //                     Image.asset(
                        //                       'assets/diamond.png',
                        //                       height: 20,
                        //                       width: 20,
                        //                     ),
                        //                     hSizedBox,
                        //                     ParagraphText(
                        //                       '670',
                        //                       color: Colors.black,
                        //                     )
                        //                   ],
                        //                 ),
                        //                 ParagraphText(
                        //                   '\$9.99',
                        //                   fontSize: 12,
                        //                   color: MyColors.primaryColor,
                        //                 )
                        //               ],
                        //             ),
                        //             vSizedBox2,
                        //             Image.asset(
                        //               'assets/popular.png',
                        //               height: 52,
                        //               width: 52,
                        //             ),
                        //             vSizedBox,
                        //             ParagraphText(
                        //               'Popular',
                        //               fontSize: 15,
                        //               fontFamily: 'bold',
                        //             ),
                        //             vSizedBox6
                        //           ],
                        //         ),
                        //       )),
                        //       hSizedBox,
                        //       Expanded(
                        //           child: Container(
                        //         padding: EdgeInsets.all(10),
                        //         decoration: BoxDecoration(
                        //             borderRadius: BorderRadius.circular(20),
                        //             image: DecorationImage(
                        //                 image: AssetImage(
                        //                   "assets/fire.png",
                        //                 ),
                        //                 fit: BoxFit.contain,
                        //                 alignment: Alignment.bottomCenter),
                        //             // border: Border.all(color: MyColors.secondary, width: 2),
                        //             boxShadow: [
                        //               BoxShadow(
                        //                 color: Colors.black.withOpacity(0.15),
                        //                 offset: const Offset(
                        //                   0,
                        //                   3.0,
                        //                 ),
                        //                 blurRadius: 13.0,
                        //                 spreadRadius: 0,
                        //               ),
                        //             ],
                        //             color: Colors.white),
                        //         child: Column(
                        //           children: [
                        //             Row(
                        //               mainAxisAlignment:
                        //                   MainAxisAlignment.spaceBetween,
                        //               children: [
                        //                 Row(
                        //                   children: [
                        //                     Image.asset(
                        //                       'assets/diamond.png',
                        //                       height: 20,
                        //                       width: 20,
                        //                     ),
                        //                     hSizedBox,
                        //                     ParagraphText(
                        //                       '670',
                        //                       color: Colors.black,
                        //                     )
                        //                   ],
                        //                 ),
                        //                 ParagraphText(
                        //                   '\$9.99',
                        //                   fontSize: 12,
                        //                   color: MyColors.primaryColor,
                        //                 )
                        //               ],
                        //             ),
                        //             vSizedBox2,
                        //             Image.asset(
                        //               'assets/hot.png',
                        //               height: 52,
                        //               width: 52,
                        //             ),
                        //             vSizedBox,
                        //             ParagraphText(
                        //               'Hot',
                        //               fontSize: 15,
                        //               fontFamily: 'bold',
                        //             ),
                        //             vSizedBox6
                        //           ],
                        //         ),
                        //       )),
                        //     ],
                        //   ),
                        // ),
                        // vSizedBox,
                        // Padding(
                        //   padding: const EdgeInsets.symmetric(horizontal: 22.0),
                        //   child: Row(
                        //     children: [
                        //       Expanded(
                        //           child: Container(
                        //         padding: EdgeInsets.all(10),
                        //         decoration: BoxDecoration(
                        //             borderRadius: BorderRadius.circular(20),
                        //             // image: DecorationImage(
                        //             //     image: AssetImage("assets/image_1.png",),
                        //             //     fit: BoxFit.contain,
                        //             //     alignment: Alignment.bottomCenter
                        //             // ),
                        //             // border: Border.all(color: MyColors.secondary, width: 2),
                        //             boxShadow: [
                        //               BoxShadow(
                        //                 color: Colors.black.withOpacity(0.15),
                        //                 offset: const Offset(
                        //                   0,
                        //                   3.0,
                        //                 ),
                        //                 blurRadius: 13.0,
                        //                 spreadRadius: 0,
                        //               ),
                        //             ],
                        //             color: Colors.white),
                        //         child: Column(
                        //           children: [
                        //             Row(
                        //               mainAxisAlignment:
                        //                   MainAxisAlignment.spaceBetween,
                        //               children: [
                        //                 Row(
                        //                   children: [
                        //                     Image.asset(
                        //                       'assets/diamond.png',
                        //                       height: 20,
                        //                       width: 20,
                        //                     ),
                        //                     hSizedBox,
                        //                     ParagraphText(
                        //                       '670',
                        //                       color: Colors.black,
                        //                     )
                        //                   ],
                        //                 ),
                        //                 ParagraphText(
                        //                   '\$9.99',
                        //                   fontSize: 12,
                        //                   color: MyColors.primaryColor,
                        //                 )
                        //               ],
                        //             ),
                        //             vSizedBox2,
                        //             Image.asset(
                        //               'assets/smart_pack.png',
                        //               height: 52,
                        //               width: 52,
                        //             ),
                        //             vSizedBox,
                        //             ParagraphText(
                        //               'Smart Pack',
                        //               fontSize: 15,
                        //               fontFamily: 'bold',
                        //             ),
                        //             vSizedBox4
                        //           ],
                        //         ),
                        //       )),
                        //       hSizedBox,
                        //       Expanded(
                        //           child: Container(
                        //         padding: EdgeInsets.all(10),
                        //         decoration: BoxDecoration(
                        //             borderRadius: BorderRadius.circular(20),
                        //             // image: DecorationImage(
                        //             //     image: AssetImage("assets/fire.png",),
                        //             //     fit: BoxFit.contain,
                        //             //     alignment: Alignment.bottomCenter
                        //             // ),
                        //             // border: Border.all(color: MyColors.secondary, width: 2),
                        //             boxShadow: [
                        //               BoxShadow(
                        //                 color: Colors.black.withOpacity(0.15),
                        //                 offset: const Offset(
                        //                   0,
                        //                   3.0,
                        //                 ),
                        //                 blurRadius: 13.0,
                        //                 spreadRadius: 0,
                        //               ),
                        //             ],
                        //             color: Colors.white),
                        //         child: Column(
                        //           children: [
                        //             Row(
                        //               mainAxisAlignment:
                        //                   MainAxisAlignment.spaceBetween,
                        //               children: [
                        //                 Row(
                        //                   children: [
                        //                     Image.asset(
                        //                       'assets/diamond.png',
                        //                       height: 20,
                        //                       width: 20,
                        //                     ),
                        //                     hSizedBox,
                        //                     ParagraphText(
                        //                       '670',
                        //                       color: Colors.black,
                        //                     )
                        //                   ],
                        //                 ),
                        //                 ParagraphText(
                        //                   '\$9.99',
                        //                   fontSize: 12,
                        //                   color: MyColors.primaryColor,
                        //                 )
                        //               ],
                        //             ),
                        //             vSizedBox2,
                        //             Image.asset(
                        //               'assets/medium_pack.png',
                        //               height: 52,
                        //               width: 52,
                        //             ),
                        //             vSizedBox,
                        //             ParagraphText(
                        //               'Medium Pack',
                        //               fontSize: 15,
                        //               fontFamily: 'bold',
                        //             ),
                        //             vSizedBox4
                        //           ],
                        //         ),
                        //       )),
                        //     ],
                        //   ),
                        // ),
                        vSizedBox2,
                        // Padding(
                        //   padding: const EdgeInsets.symmetric(
                        //       horizontal: 22.0, vertical: 10),
                        //   child: RoundEdgedButton(text: 'Continue'),
                        // )
                      ],
                    ),
                  if (userData!.gender==UserGender.female)
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        vSizedBox4,
                        Container(
                          padding: EdgeInsets.symmetric(horizontal: 22),
                          child: Column(
                            children: [
                              for (var i=0;i<diamondHistory.length; i++)
                                Column(
                                  children: [
                                    Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.spaceBetween,
                                      crossAxisAlignment:
                                          CrossAxisAlignment.center,
                                      children: [
                                        Row(
                                          children: [
                                            Column(
                                              children: [
                                                Image.asset(
                                                  MyImages.diamond,
                                                  height: 35,
                                                  width: 35,
                                                ),
                                              ],
                                            ),
                                            hSizedBox,
                                            Column(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: [
                                                ParagraphText(
                                                  '${histories[i]['coin_title']}',
                                                  fontSize: 14,
                                                  fontFamily: 'semibold',
                                                  fontWeight: FontWeight.w900,
                                                  color: Colors.black,
                                                ),
                                                ParagraphText(
                                                  'You redeemed recently',
                                                  fontSize: 14,
                                                  fontFamily: 'semibold',
                                                  color: Colors.black,
                                                ),
                                                // vSizedBox05,
                                                ParagraphText(
                                                  '${histories[i]['created_at']}',
                                                  fontSize: 10,
                                                  fontFamily: 'regular',
                                                  color: MyColors.primaryColor,
                                                ),
                                              ],
                                            )
                                          ],
                                        ),
                                        ParagraphText(
                                          '${histories[i]['coins_value']}',
                                          fontFamily: 'semibold',
                                          fontSize: 14,
                                          color: Color(0xFF03CD23)
                                              .withOpacity(0.80),
                                        )
                                      ],
                                    ),
                                    vSizedBox2,
                                  ],
                                ),
                              if(histories.length==0)
                              Center(
                                child: Text('No data found.'),
                              ),
                            ],
                          ),
                        ),
                      ],
                    )
                ],
              ),
            ),
          ),
          if(inAppPurchaseLoad)
            CustomFullPageLoader()

        ],
      ),
    );
  }
}
