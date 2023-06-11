import 'dart:io';

import 'package:audio_waveforms/audio_waveforms.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:path_provider/path_provider.dart';
import '../constants/sized_box.dart';
import 'CustomTexts.dart';

// import 'chat_bubble.dart';

class RecordAudioBottomSheet extends StatefulWidget {
  const RecordAudioBottomSheet({Key? key}) : super(key: key);

  @override
  _RecordAudioBottomSheetState createState() => _RecordAudioBottomSheetState();
}

class _RecordAudioBottomSheetState extends State<RecordAudioBottomSheet> {


  late final RecorderController recorderController;
  late final PlayerController playerController1;
  // late final PlayerController playerController2;
  // late final PlayerController playerController3;
  // late final PlayerController playerController4;
  // late final PlayerController playerController5;
  // late final PlayerController playerController6;

  String? path;
  String? musicFile;
  bool isRecording = false;
  late Directory appDirectory;

  @override
  void initState() {
    super.initState();
    _getDir();
    _initialiseControllers();
  }

  void _getDir() async {
    appDirectory = await getApplicationDocumentsDirectory();
    _preparePlayers();
    path = "${appDirectory.path}/music.aac";
    // Future.delayed(Duration(seconds: 2)).then((value) => _startOrStopRecording());
  }

  Future<ByteData> _loadAsset(String path) async {
    return await rootBundle.load(path);
  }

  void _initialiseControllers() {
    recorderController = RecorderController()
      ..androidEncoder = AndroidEncoder.aac
      ..androidOutputFormat = AndroidOutputFormat.mpeg4
      ..iosEncoder = IosEncoder.kAudioFormatMPEG4AAC
      ..sampleRate = 16000;
    playerController1 = PlayerController()
      ..addListener(() {
        if (mounted) setState(() {});
      });
    // playerController2 = PlayerController()
    //   ..addListener(() {
    //     if (mounted) setState(() {});
    //   });
    // playerController3 = PlayerController()
    //   ..addListener(() {
    //     if (mounted) setState(() {});
    //   });
    // playerController4 = PlayerController()
    //   ..addListener(() {
    //     if (mounted) setState(() {});
    //   });
    // playerController5 = PlayerController()
    //   ..addListener(() {
    //     if (mounted) setState(() {});
    //   });
    // playerController6 = PlayerController()
    //   ..addListener(() {
    //     if (mounted) setState(() {});
    //   });
  }

  void _preparePlayers() async {
    ///audio-1
    final file1 = File('${appDirectory.path}/audio1.mp3');
    await file1.writeAsBytes(
        (await _loadAsset('assets/audios/audio1.mp3')).buffer.asUint8List());
    playerController1.preparePlayer(file1.path);

    // ///audio-2
    // final file2 = File('${appDirectory.path}/audio2.mp3');
    // await file2.writeAsBytes(
    //     (await _loadAsset('assets/audios/audio2.mp3')).buffer.asUint8List());
    // playerController2.preparePlayer(file2.path);
    //
    // ///audio-3
    // final file3 = File('${appDirectory.path}/audio3.mp3');
    // await file3.writeAsBytes(
    //     (await _loadAsset('assets/audios/audio3.mp3')).buffer.asUint8List());
    // playerController3.preparePlayer(file3.path);
    //
    // ///audio-4
    // final file4 = File('${appDirectory.path}/audio4.mp3');
    // await file4.writeAsBytes(
    //     (await _loadAsset('assets/audios/audio4.mp3')).buffer.asUint8List());
    // playerController4.preparePlayer(file4.path);
  }
  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          SubHeadingText('Please say something'),
          vSizedBox4,
          if(isRecording)
          AudioWaveforms(
            enableGesture: true,
            size: Size(MediaQuery.of(context).size.width, 80),
            recorderController: recorderController,
            waveStyle: const WaveStyle(
              waveColor: Colors.white,
              extendWaveform: true,
              showMiddleLine: false,
            ),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(12.0),
              color: const Color(0xFF1E1B26),
            ),
            padding: const EdgeInsets.only(left: 18),
            margin: const EdgeInsets.symmetric(horizontal: 15),
          ),
          GestureDetector(
            onTap: (){
              _startOrStopRecording();
            },
            child: Icon(isRecording ? Icons.stop : Icons.mic),
          ),
          // vSizedBox4,
          // GestureDetector(
          //   onTap: ()async{
          //     _startOrStopRecording();
          //     // _startListening();
          //     //
          //     // await Future.delayed(Duration(seconds: 7));
          //     // _stopListening();
          //   },
          //   child: Container(
          //     padding: EdgeInsets.all(6),
          //     decoration: BoxDecoration(
          //       // border: isListening?Border.all():null,
          //     ),
          //     child: Image.asset(
          //       MyImages.mic,
          //       height: 60,
          //       fit: BoxFit.fitHeight,
          //     ),
          //   ),
          // ),
          vSizedBox4,
        ],
      ),
    );
  }
  void _playOrPlausePlayer(PlayerController controller) async {
    controller.playerState == PlayerState.playing
        ? await controller.pausePlayer()
        : await controller.startPlayer(finishMode: FinishMode.loop);
  }

  void _startOrStopRecording() async {
    if (isRecording) {
      recorderController.reset();
      String? path = await recorderController.stop(false);
      print('the path is ${path}');
      if(path!=null){
        File file = File(path);
        Navigator.pop(context, file);
      }

      if (path != null) await playerController1.preparePlayer(path);
    } else {
      await recorderController.record(path);
    }
    try{
      setState(() {
        isRecording = !isRecording;
      });
    }catch(e){
      print('Error in catch block not that important $e');
    }
  }

  void _refreshWave() {
    if (isRecording) recorderController.refresh();
  }
}
