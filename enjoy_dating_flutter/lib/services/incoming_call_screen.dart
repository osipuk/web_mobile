import 'package:Enjoy/services/video_call_page.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:audioplayers/audioplayers.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/global_data.dart';
import '../constants/navigation_functions.dart';
import '../constants/sized_box.dart';
import '../dialogs/showFeedbackDialog.dart';
import '../widget/CustomTexts.dart';
import '../widget/custom_circular_image.dart';
import 'api_urls.dart';
import 'auth.dart';

class IncomingScreenFromNotificationPage extends StatefulWidget {
  // final Map incomingCallData;
  static final String id = 'incomingCallPage';

  const IncomingScreenFromNotificationPage({
    required Key key,
    // required this.incomingCallData,
  }) : super(key: key);

  @override
  State<IncomingScreenFromNotificationPage> createState() =>
      IncomingScreenFromNotificationPageState();
}

class IncomingScreenFromNotificationPageState
    extends State<IncomingScreenFromNotificationPage> {
  AudioPlayer audioPlayer = AudioPlayer();


  initAllData()async{
    userData=await getUserDetails();
    var request = {
      "receiver_id":userData!.id,
    };
    var jsonResponse = await  Webservices.postData(apiUrl: ApiUrls.checkIncomingCall, request: request, showErrorMessage: false);
    if(jsonResponse['status']==1){
    incomingCallData = jsonResponse['data'];
    }
    setState(() {

    });
  }
  @override
  void initState() {
    // TODO: implement initState
    initAllData();
    print('I am here in incoming call init state page');
    audioPlayer.play(
      AssetSource('callertune.mp3'),
    );
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    audioPlayer.dispose();
    super.dispose();
  }

  Map? incomingCallData;



  @override
  Widget build(BuildContext context) {
    return incomingCallData==null?Container(color: MyColors.primaryColor,):IncomingCallScreen(
      audioPlayer: audioPlayer,
      incomingCall:incomingCallData!,
    );
  }
}

class IncomingCallScreen extends StatelessWidget {
  final Map incomingCall;
  final AudioPlayer audioPlayer;

  const IncomingCallScreen(
      {Key? key, required this.incomingCall, required this.audioPlayer})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.symmetric(vertical: 32),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          CustomCircularImage(imageUrl: incomingCall!['sender']['image'] ?? ''),
          vSizedBox,
          SubHeadingText('${incomingCall!['sender']['name']}'),
          Expanded(
            child: vSizedBox,
          ),
          Column(
            children: [
              GestureDetector(
                onTap: () async {
                  print('popping------2');
                  Navigator.pop(context);
                  await audioPlayer.pause();
                  await push(
                      context: context,
                      screen: VideoCallScreen(
                        userId: incomingCall!['sender']['id'],
                        name: incomingCall!['sender']['name'],
                        callingId: incomingCall!['id'],
                        isPickingCall: true,
                        isFollow: incomingCall!['sender']['is_follow'] ?? '1',
                        image: incomingCall!['sender']['image'],
                        age: incomingCall!['sender']['age'].toString(),
                      ));
                  if (!userData!.hasRated) {
                    showCustomDialog(FeedBackDialog());
                  }
                },
                child: Container(
                  padding: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  decoration: BoxDecoration(
                    color: Colors.green,
                  ),
                  child: Center(
                    child: ParagraphText(
                      'Accept',
                      color: MyColors.whiteColor,
                    ),
                  ),
                ),
              ),
              vSizedBox,
              GestureDetector(
                onTap: () async {
                  print('popping------3');
                  Navigator.pop(context);
                  await audioPlayer.pause();
                  var request = {
                    // "sender_id": incomingCall!['sender']['id'],
                    // "receiver_id":userData!.id,
                    "calling_id": incomingCall!['id'],
                  };
                  var jsonResponse = await Webservices.postData(
                    apiUrl: ApiUrls.endCall,
                    request: request,
                  );
                },
                child: Container(
                  padding: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  decoration: BoxDecoration(
                    color: Colors.red,
                  ),
                  child: Center(
                    child: ParagraphText(
                      'Reject',
                      color: MyColors.whiteColor,
                    ),
                  ),
                ),
              ),
            ],
          )
        ],
      ),
    );
  }
}
