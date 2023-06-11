import 'dart:developer';

import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:flutter/material.dart';

import '../constants/image_urls.dart';
import '../constants/sized_box.dart';
import 'block_layout.dart';
import 'custom_circular_image.dart';
import 'package:intl/intl.dart';

class WithdrawalPage extends StatefulWidget {
  const WithdrawalPage({Key? key}) : super(key: key);

  @override
  State<WithdrawalPage> createState() => _WithdrawalPageState();
}

class _WithdrawalPageState extends State<WithdrawalPage> {
  List history = [];
  bool load = false;
  getHistory() async {
    setState(() {
      load = true;
    });
    history = await Webservices.getList(
        '${ApiUrls.myWithdrawalHistory}?user_id=${userData!.id}');
    setState(() {
      load = false;
    });
    log("history----------" + history.toString());
  }

  @override
  void initState() {
    // TODO: implement initState
    getHistory();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load
          ? CustomLoader()
          : Container(
              decoration: BoxDecoration(
                  gradient: LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
                colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
              )),
              child: Container(
                // margin: EdgeInsets.only(top: 30),
                child: Padding(
                  padding: EdgeInsets.symmetric(horizontal: 16.0),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.start,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      vSizedBox,
                      Row(
                        children: [
                          IconButton(
                            onPressed: () {
                              Navigator.pop(context);
                            },
                            icon: const Icon(
                              Icons.arrow_back_ios,
                              color: Colors.white,
                            ),
                          ),
                          hSizedBox4,
                          Text(
                            'Withdrawal History',
                            style: TextStyle(
                              fontSize: 16,
                              color: Colors.white,
                            ),
                            textAlign: TextAlign.start,
                          ),
                          vSizedBox8,
                        ],
                      ),
                      Expanded(
                        child: ListView.builder(
                          itemCount: history.length,
                          itemBuilder: (context, i) {
                            return Container(
                              padding: EdgeInsets.symmetric(
                                  horizontal: 16, vertical: 10),
                              margin: EdgeInsets.only(bottom: 6),
                              decoration: BoxDecoration(
                                color: Colors.white,
                                border: Border(
                                    bottom: BorderSide(color: Colors.black54)),
                              ),
                              child: Row(
                                children: [
                                  // CustomCircularImage(imageUrl: isIncoming?callHistory[index]['user_data']['image']:callHistory[index]['user_data']['image']),
                                  // hSizedBox,
                                  Expanded(
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        SubHeadingText(
                                            '${history[i]['redeem_type'].toString() == '1' ? 'Bank' : history[i]['redeem_type'].toString() == '2' ? 'Manual' : 'Paypal'}'),
                                        // SubHeadingText(isIncoming?callHistory[index]['user_data']['name']:callHistory[index]['user_data']['name'],color: isIncoming?d==Duration.zero?Colors.red:Colors.green: MyColors.backcolor,),
                                        vSizedBox05,
                                        Row(
                                          children: [
                                            // Icon(Icons.published_with_changes_rounded ),
                                            // hSizedBox05,
                                            ParagraphText(
                                                '${DateFormat.yMMMd().format(DateTime.parse(history[i]['created_at']))}'),

                                            // ParagraphText(isIncoming?d==Duration.zero?'Missed':'Incoming': 'Outgoing',color: isIncoming?d==Duration.zero?Colors.red:Colors.green: MyColors.primaryColor),
                                          ],
                                        ),
                                        // vSizedBox,
                                        GestureDetector(
                                            behavior: HitTestBehavior.opaque,
                                            onTap: () async {
                                              print('object');
                                              if (history[i]['status']
                                                      .toString() ==
                                                  '2') {
                                                showDialog(
                                                  context: context,
                                                  builder:
                                                      (BuildContext context) {
                                                    return AlertDialog(
                                                      title: Text("Rejected"),
                                                      content: Text(
                                                          "${history[i]['message']}"),
                                                      actions: [
                                                        TextButton(
                                                          child: Text("OK"),
                                                          onPressed: () {
                                                            Navigator.of(
                                                                    context)
                                                                .pop();
                                                          },
                                                        )
                                                      ],
                                                    );
                                                  },
                                                );
                                              }
                                            },
                                            child: Padding(
                                              padding: const EdgeInsets.only(
                                                  top: 8.0, bottom: 8.0),
                                              child: Row(
                                                children: [
                                                  ParagraphText('Status : '),
                                                  ParagraphText(
                                                    '${history[i]['status'].toString() == '0' ? 'Pending' : history[i]['status'].toString() == '1' ? 'Approved' : 'Rejected (view reason) '}',
                                                    color: history[i]['status']
                                                                .toString() ==
                                                            '0'
                                                        ? Colors.orange
                                                        : history[i]['status']
                                                                    .toString() ==
                                                                '1'
                                                            ? Colors.green
                                                            : Colors.red,
                                                  ),
                                                ],
                                              ),
                                            ))
                                      ],
                                    ),
                                  ),
                                  hSizedBox05,
                                  Column(
                                    // crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      ParagraphText(
                                        '\$ ${history[i]['amount']}',
                                        color: Colors.green,
                                        fontSize: 18,
                                      ),
                                      // if(userData!.gender==UserGender.female)
                                      Row(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.end,
                                          children: [
                                            ParagraphText(
                                              '${history[i]['diamonds']}',
                                              fontSize: 16,
                                            ),
                                            hSizedBox05,
                                            CustomCircularImage(
                                              imageUrl: MyImages.diamond,
                                              height: 25,
                                              width: 25,
                                              fileType: CustomFileType.asset,
                                            ),
                                          ])
                                    ],
                                  ),
                                ],
                              ),
                            );
                          },
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
    );
  }
}
