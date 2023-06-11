import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/pages/call_history_page.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:flutter/material.dart';

class CallHistoryTabsPage extends StatefulWidget {
  const CallHistoryTabsPage({super.key});

  @override
  State<CallHistoryTabsPage> createState() => _CallHistoryTabsPageState();
}

class _CallHistoryTabsPageState extends State<CallHistoryTabsPage> {


  Widget buildRecentCallHistory(){
    return CallHistoryPage(apiUrl: ApiUrls.recentCalls,);
  }
  Widget buildMissedCallHistory(){
    return CallHistoryPage(apiUrl: ApiUrls.recentMissedCalls,);
  }

  Widget buildMatchedCallHistory(){
    return CallHistoryPage(apiUrl: ApiUrls.recentMatchCalls,);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(

      backgroundColor: Colors.green,
      body: Container(
        height: MediaQuery.of(context).size.height,
        width: MediaQuery.of(context).size.width,
        decoration: BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [
                Color(0xFE7D44CF),
                Color(0xFE00B199)
              ],
            )
        ),
        child: DefaultTabController(
          length: 3,
          child: Column(
            children: [
              vSizedBox6,
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16,),
                child: TabBar(
                  tabs: [
                    Tab( child: ParagraphText('Recent'),),
                    Tab( child: ParagraphText('Missed Call'),),
                    Tab( child: ParagraphText('Matches'),),
                  ],
                ),
              ),
              Expanded(
                child:  TabBarView(
                  children: [
                    buildRecentCallHistory(),
                    buildMissedCallHistory(),
                    buildMatchedCallHistory()
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}