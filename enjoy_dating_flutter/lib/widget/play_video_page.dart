import 'package:flutter/material.dart';
import 'package:flick_video_player/flick_video_player.dart';
import 'package:flutter/services.dart';
import 'package:video_player/video_player.dart';

import '../constants/global_data.dart';
import '../services/api_urls.dart';
import '../services/common_functions.dart';
import '../services/webservices.dart';

class PlayVideoPage extends StatefulWidget {
  final String url;
  bool isAdvertisement = false;
  PlayVideoPage({Key? key, required this.url, required}) : super(key: key);

  @override
  _PlayVideoPageState createState() => _PlayVideoPageState();
}

class _PlayVideoPageState extends State<PlayVideoPage> {
  late FlickManager flickManager;
  late VideoPlayerController videoPlayerController;
  participateInVideoWatch()async{
    var request = {
      'user_id': userData!.id,
      'activity_id': '2'
    };
    loadingShow(context);
    var jsonResponse =  await Webservices.postData(apiUrl: ApiUrls.participateExtraActivityEarning, request: request,  showSuccessMessage: true);
    loadingHide(context);
  }
  @override
  void initState() {
    super.initState();
    videoPlayerController =VideoPlayerController.network(widget.url);
    flickManager = FlickManager(
      videoPlayerController:
      videoPlayerController,
    );
    videoPlayerController.addListener(() async{
      Duration? temp = (await  videoPlayerController.position);
      int temptemp = 0;
      if(temp==null){

      }else{
        temptemp = temp.inSeconds;
      }
      if((videoPlayerController.value.duration.inSeconds - 1)<=temptemp){
        participateInVideoWatch();
        videoPlayerController.removeListener(() { });
      }
    });
  }

  @override
  void dispose() {
    flickManager.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // appBar: appBar(context: context,),
      body: SafeArea(
        child: Container(
          // padding: EdgeInsets.symmetric(vertical: 16),
          child: FlickVideoPlayer(
            flickManager: flickManager,


            // preferredDeviceOrientation: [DeviceOrientation.landscapeRight,DeviceOrientation.portraitUp],
          ),
        ),
      ),
    );
  }
}