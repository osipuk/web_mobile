import 'dart:io';
import 'dart:math';

import 'package:flutter_share/flutter_share.dart';
import 'package:http/http.dart' as http;
import 'package:path_provider/path_provider.dart';
import 'package:audio_waveforms/audio_waveforms.dart';


extension StringExtension on String {
  String capitalize() {
    return "${this[0].toUpperCase()}${this.substring(1)}";
  }
}

String secondsInTimerFormat(int seconds){
  String r= '';
  int minutes = (seconds/60).floor();
  int secs = seconds%60;
  if(minutes>9){
    r +='${minutes}:';
  }else{
    r+= '0${minutes}:';
  }
  if(secs>9){
    r +='${secs}';
  }else{
    r+= '0${secs}';
  }
  return r;
}

Future<void> share() async {
  await FlutterShare.share(
      title: 'Hey, I found this amazing app!!',
      text: 'Find your partner and chat with them',
      linkUrl: 'https://play.google.com/store/apps/details?id=com.enjoy_dating.app',
      chooserTitle: 'Enjoy - Live Video Chat App'
  );
}
void playOrPlausePlayer(PlayerController controller) async {
  controller.playerState == PlayerState.playing
      ? await controller.pausePlayer()
      : await controller.startPlayer(finishMode: FinishMode.stop);
}

Future<File> urlToFile(Uri url) async {
// generate random number.
  var rng = new Random();
// get temporary directory of device.
  Directory tempDir = await getTemporaryDirectory();
// get temporary path from temporary directory.
  String tempPath = tempDir.path;
  print('the temp path is created for ${url.path}');
// create a new file in temporary path with random file name.
  File file = new File('$tempPath' + (rng.nextInt(100)).toString() + '.mp3');
// call http.get method and pass imageUrl into it to get response.
  http.Response response = await http.get(url);
// write bodyBytes received in response to file.
  await file.writeAsBytes(response.bodyBytes);
// now return the file which is created with random name in
// temporary directory and image bytes from response is written to // that file.
  return file;
}