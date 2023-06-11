import 'dart:async';

import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:flutter/material.dart';

class DialerScreen extends StatelessWidget {
  final String image;
  final String age;
  final String timer;
  final String name;
  final Function() endCall;
  final Map? callCharge;
   DialerScreen({
    Key? key,
    required this.age,
    required this.image,
    required this.timer,
    required this.endCall,
    required this.name,
    required this.callCharge,
  }) : super(key: key);

  int coins = 0;

  @override
  Widget build(BuildContext context) {
    if(callCharge!=null){
      coins = int.parse(callCharge!['calling_cost'].toString());
      if(userData!.gender==UserGender.female){
        coins *= int.parse(callCharge!['coin_to_diamond'].toString());
      }
    }
    return Stack(
      children: [
        Container(
          height: MediaQuery.of(context).size.height,
          decoration: BoxDecoration(
            image:
                DecorationImage(image: NetworkImage(image), fit: BoxFit.cover),
          ),
        ),
        if(callCharge!=null)
        Positioned(
          top: 120,
          left: 40,
          right: 40,
          child: Column(
            children: [
              Container(
                // height: 80,
                padding: EdgeInsets.symmetric(horizontal: 16, vertical: 16),
                decoration: BoxDecoration(
                    color: Colors.black38,
                    borderRadius: BorderRadius.circular(50)),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Expanded(
                      child: ParagraphText(
                        userData!.gender==UserGender.male?
                        'You will be charged $coins coins per minute'
                            :'You will receive $coins diamonds per minute',
                        color: Colors.white,
                      ),
                    ),
                    hSizedBox05,
                    Container(
                      padding:
                          EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                      decoration: BoxDecoration(
                          color: Colors.black38,
                          borderRadius: BorderRadius.circular(50)),
                      child: ParagraphText(
                        '${timer}',
                        color: Colors.white,
                      ),
                    )
                  ],
                ),
              )
            ],
          ),
        ),
        Positioned(
          bottom: 32,
          left: 0,
          right: 0,
          child: Column(
            children: [
              SubHeadingText(
                '${name}, ${age}',
                color: Colors.white,
                fontSize: 22,
              ),
              vSizedBox,
              SizedBox(
                height: 150,
                width: 100,
                child: IconButton(
                  icon: Container(
                    padding: EdgeInsets.all(12),
                    decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(60),
                        color: Colors.red),
                    child: Icon(
                      Icons.call_end,
                      color: Colors.white,
                    ),
                  ),
                  onPressed: () {
                    print('End call pressed');
                    endCall();
                  },
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }
}
