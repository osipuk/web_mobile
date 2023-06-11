import 'dart:async';
import 'dart:developer';

import 'package:Enjoy/constants/colors.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'constants/global_data.dart';
import 'package:story_view/story_view.dart';

class view_story extends StatefulWidget {
  final List stories;
  final int index;
  const view_story({Key? key,
  required this.stories,
    required this.index,
  }) : super(key: key);
  @override
  _view_storyState createState() => _view_storyState();
}

class _view_storyState extends State<view_story> {
  double _currentSliderValue = 20;
  double lat = 0;
  double lng = 0;
  List my_stories = [];
  final storyController = StoryController();


  List<StoryItem> storyItems = [];
  getStoryItems(){
    widget.stories.forEach((element) {
      storyItems.add(
          StoryItem.pageVideo(

             element['file'],
              controller: StoryController(),
              // controller: storyController,
            duration: Duration(milliseconds: int.parse(element['seconds']))
          )
      );
    });

    // storyController.
    setState(() {
      
    });
  }
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    getStoryItems();
    // get_GPS_Position();
    // interval_api();
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.whiteColor,
      body: StoryView(
        controller: storyController,
        storyItems: storyItems,
        // storyItems: [
        //
        //   StoryItem.pageVideo(
        //     'https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/20_8768455791657797560.mp4',
        //       controller: storyController
        //   )
        //   // for(int i=0;i<widget.stories!.length;i++)
        //    // StoryItem.pageVideo(
        //     //  shown: true,
        //    // url:'https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/20_8768455791657797560.mp4',
        //     // caption: Text(
        //     //   "",
        //     //   style: TextStyle(
        //     //     color: Colors.white,
        //     //     backgroundColor: Colors.black54,
        //     //     fontSize: 17,
        //     //   ),
        //     // ),
        //    // controller: storyController,
        //  // ),
        //   // StoryItem.inlineImage(
        //   //   url:
        //   //   "https://image.ibb.co/cU4WGx/Omotuo-Groundnut-Soup-braperucci-com-1.jpg",
        //   //   controller: storyController,
        //   //   caption: Text(
        //   //     "Omotuo & Nkatekwan; You will love this meal if taken as supper.",
        //   //     style: TextStyle(
        //   //       color: Colors.white,
        //   //       backgroundColor: Colors.black54,
        //   //       fontSize: 17,
        //   //     ),
        //   //   ),
        //   // ),
        //   // StoryItem.inlineImage(
        //   //   url:
        //   //   "https://media.giphy.com/media/5GoVLqeAOo6PK/giphy.gif",
        //   //   controller: storyController,
        //   //   caption: Text(
        //   //     "Hektas, sektas and skatad",
        //   //     style: TextStyle(
        //   //       color: Colors.white,
        //   //       backgroundColor: Colors.black54,
        //   //       fontSize: 17,
        //   //     ),
        //   //   ),
        //   // )
        // ],
        onStoryShow: (s) {
          print("Showing a story");
        },
        onComplete: () {
          print("Completed a cycle");
        },
        progressPosition: ProgressPosition.top,
        onVerticalSwipeComplete: (f){
          print('fdklhfdlk');
          Navigator.pop(context);
        },

        repeat: false,
        inline: true,
      ),
    );
  }

}
