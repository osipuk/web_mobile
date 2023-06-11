import 'dart:async';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:flutter/material.dart';
import '../constants/sized_box.dart';
class PurchaseCoinsBottomSheet extends StatefulWidget {
  final Map purchaseData;
  int counter;
  PurchaseCoinsBottomSheet({Key? key, required this.purchaseData, required this.counter}) : super(key: key);

  @override
  State<PurchaseCoinsBottomSheet> createState() => _PurchaseCoinsBottomSheetState();
}

class _PurchaseCoinsBottomSheetState extends State<PurchaseCoinsBottomSheet> {
  
  Timer? purchaseCoinsTimer;

  bool load = false;
  // int counter = 30;
  @override
  void initState() {
    // TODO: implement initState
    purchaseCoinsTimer = Timer.periodic(const Duration(seconds: 1), (timer) {
      widget.counter--;
      if(widget.counter==0){
        Navigator.pop(context);
      }
      setState(() {

      });
    });
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    purchaseCoinsTimer?.cancel();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {

    return Container(

      decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [Color(0xFE7D44CF), Color(0xFE7D44CF),Color(0xFE1F66BA)],
          ),
        // borderRadius: BorderRadius.circular(40)
      ),
      child:load?const CustomLoader(): Column(
        children: [
          vSizedBox2,
          Stack(
            children: [
              Container(
                height: 60,
                width: 60,
                // padding:
                // EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                decoration: BoxDecoration(
                    color: Colors.black38,
                    borderRadius: BorderRadius.circular(50)),
                child: Center(
                  child: SubHeadingText(
                    '${widget.counter}',
                    fontSize: 22,
                    color: Colors.white,
                  ),
                ),
              ),
              SizedBox(
                height: 60,
                width: 60,
                child: CircularProgressIndicator(
                  value: widget.counter/30,
                  color: Colors.white,

                ),
              )
            ],
          ),
          vSizedBox2,
          const ParagraphText('Get More Coins to continue video chatting', color: Colors.white,),
          vSizedBox2,
          Container(
            width: MediaQuery.of(context).size.width - 120,
            height: 60,
            decoration: BoxDecoration(
              color: Colors.yellow,
              borderRadius: BorderRadius.circular(40),
            ),
            child: Row(
              children: [
                Expanded(
                  child: Center(child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset(MyImages.coins, height: 40,width: 40,),
                      hSizedBox05,
                      ParagraphText('${widget.purchaseData['no_of_coin']}'),
                    ],
                  )),
                ),
                Expanded(
                  child: Container(
                    margin: const EdgeInsets.symmetric(vertical: 4),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(40),
                      color: Colors.blue,
                    ),
                    child: Center(child: ParagraphText('\$${widget.purchaseData['price']}', color: Colors.white,)),
                  ),
                )
              ],
            ),

          ),
          vSizedBox2,
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16),
            child: RoundEdgedButton(text: 'Get Coins', onTap: ()async{
              push(context: context, screen: const Get_Coins_Page());
             //  Map data = {
             //    'user_id':userData!.id,
             //    'coin_manage_id':widget.purchaseData['id'],
             //    'coins_value':widget.purchaseData['no_of_coin'],
             //    'coin_amount':widget.purchaseData['price'],
             //    'coin_transactions_id':'123456',
             //  };
             // setState(() {
             //   load = true;
             // });
             //  // Map res = await postData(data,'purchaseCoin',0,0);
             //  var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.purchaseCoin, request: data);
             //  Navigator.pop(context, widget.purchaseData['no_of_coin'].toString());
             //  setState(() {
             //    load = false;
             //  });
            },),
          ),
          
        ],
      ),
    );
  }
}
