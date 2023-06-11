import 'dart:async';
import 'dart:io';

import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
class RecordVideoScreen extends StatefulWidget {
  const RecordVideoScreen({Key? key}) : super(key: key);

  @override
  _RecordVideoScreenState createState() => _RecordVideoScreenState();
}


List<CameraDescription> cameras = [];
class _RecordVideoScreenState extends State<RecordVideoScreen> {

  int timeLeft = 0;
  int videoMillisecondsDuration = 0;
  bool load = false;
  bool isButtonDisabled = false;
  late Timer recordingTimer;
  late CameraController _controller;
  late Future<void> _initializeControllerFuture;

  // CameraDescription firstCamera;
 Future<CameraDescription> youCanAddThisFunctionToMain()async{
    WidgetsFlutterBinding.ensureInitialized();

    // Obtain a list of the available cameras on the device.
    cameras = await availableCameras();


    // Get a specific camera from the list of available cameras.
    final firstCamera = cameras.first;

    // To display the current output from the Camera,
    // create a CameraController.
    return firstCamera;

  }

  String formatTime(int milliseconds){
   String formattedTime = '00:';
   formattedTime +=milliseconds>9000?(milliseconds/1000).floor().toString():'0${(milliseconds/1000).floor()}';
   return formattedTime;
  }
  CameraDescription? selectedCamera;
  Future<void> onNewCameraSelected(CameraDescription cameraDescription) async {
    final CameraController? oldController = _controller;
    if (oldController != null) {
      // `controller` needs to be set to null before getting disposed,
      // to avoid a race condition when we use the controller that is being
      // disposed. This happens when camera permission dialog shows up,
      // which triggers `didChangeAppLifecycleState`, which disposes and
      // re-creates the controller.
      // _controller = null;
      await oldController.dispose();
    }

    final CameraController cameraController = CameraController(
      cameraDescription,
      ResolutionPreset.medium,
      enableAudio: true,
      imageFormatGroup: ImageFormatGroup.jpeg,
    );

    _controller = cameraController;

    // If the controller is updated then update the UI.
    cameraController.addListener(() {
      if (mounted) {
        setState(() {});
      }
      if (cameraController.value.hasError) {
        showSnackbar(
            'Camera error ${cameraController.value.errorDescription}');
      }
    });

    try {
      await cameraController.initialize();
      // await Future.wait(<Future<Object?>>[
      //   // The exposure mode is currently not supported on the web.
      //   ...!kIsWeb
      //       ? <Future<Object?>>[
      //     cameraController.getMinExposureOffset().then(
      //             (double value) => _minAvailableExposureOffset = value),
      //     cameraController
      //         .getMaxExposureOffset()
      //         .then((double value) => _maxAvailableExposureOffset = value)
      //   ]
      //       : <Future<Object?>>[],
      //   cameraController
      //       .getMaxZoomLevel()
      //       .then((double value) => _maxAvailableZoom = value),
      //   cameraController
      //       .getMinZoomLevel()
      //       .then((double value) => _minAvailableZoom = value),
      // ]);
    } on CameraException catch (e) {
      print('Error in catch block 23 $e');
      // switch (e.code) {
      //   case 'CameraAccessDenied':
      //     showInSnackBar('You have denied camera access.');
      //     break;
      //   case 'CameraAccessDeniedWithoutPrompt':
      //   // iOS only
      //     showInSnackBar('Please go to Settings app to enable camera access.');
      //     break;
      //   case 'CameraAccessRestricted':
      //   // iOS only
      //     showInSnackBar('Camera access is restricted.');
      //     break;
      //   case 'AudioAccessDenied':
      //     showInSnackBar('You have denied audio access.');
      //     break;
      //   case 'AudioAccessDeniedWithoutPrompt':
      //   // iOS only
      //     showInSnackBar('Please go to Settings app to enable audio access.');
      //     break;
      //   case 'AudioAccessRestricted':
      //   // iOS only
      //     showInSnackBar('Audio access is restricted.');
      //     break;
      //   default:
      //     _showCameraException(e);
      //     break;
      // }
    }

    if (mounted) {
      setState(() {});
    }
  }

  initializeCameraSettings()async{
   setState(() {
     load = true;
   });
   selectedCamera = await youCanAddThisFunctionToMain();
    _controller = CameraController(
      // Get a specific camera from the list of available cameras.
      selectedCamera!,
      // Define the resolution to use.
      ResolutionPreset.medium,
    );

    // Next, initialize the controller. This returns a Future.
    _initializeControllerFuture = _controller.initialize();
    setState(() {
      load = false;
    });

  }
  IconData getCameraLensIcon(CameraLensDirection direction) {
    switch (direction) {
      case CameraLensDirection.back:
        return Icons.camera_rear;
      case CameraLensDirection.front:
        return Icons.camera_front;
      case CameraLensDirection.external:
        return Icons.camera;
      default:
        throw ArgumentError('Unknown lens direction');
    }
  }
  @override
  void initState() {
    // TODO: implement initState
    initializeCameraSettings();
    super.initState();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    try{
      _controller.dispose();
    }catch(e){
      print('Error in catch block $e');
    }

    super.dispose();
  }
  @override
  Widget build(BuildContext context) {
    return  Scaffold(

      // You must wait until the controller is initialized before displaying the
      // camera preview. Use a FutureBuilder to display a loading spinner until the
      // controller has finished initializing.
      body:load?CustomLoader(): FutureBuilder<void>(
        future: _initializeControllerFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.done) {
            // If the Future is complete, display the preview.
            return Stack(
              children: [
                Column(
                  children: [
                    Expanded(child: CameraPreview(_controller)),
                  ],
                ),
                Positioned(
                  right: 36, top: 64,
                  child: Container(child: SubHeadingText('${formatTime(videoMillisecondsDuration)}', color:Colors.white,),),
                )
              ],
            );
          } else {
            // Otherwise, display a loading indicator.
            return const Center(child: CircularProgressIndicator());
          }
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
      floatingActionButton: Padding(
        padding: const EdgeInsets.only(bottom: 12.0),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            if(timeLeft!=0)
            MainHeadingText('${timeLeft}', color: Colors.white,),



            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                GestureDetector(
                    onTap: ()async{
                      if(_controller.value.flashMode!=FlashMode.torch){
                        print(' ia here');
                        await _controller.setFlashMode(FlashMode.torch);
                      }else{
                        print(' ia hereeee');
                        await _controller.setFlashMode(FlashMode.off);
                      }
                      setState(() {

                      });

                },child: Icon(_controller.value.flashMode==FlashMode.torch?Icons.flash_on:Icons.flash_off_outlined, color: Colors.white,size: 32,)),
                hSizedBox,
                GestureDetector(
                  behavior: HitTestBehavior.opaque,
                  onTap:isButtonDisabled?null: ()async{
                    // Take the Picture in a try / catch block. If anything goes wrong,

                    // catch the error.
                    try {
                      await _initializeControllerFuture;
                      if(!_controller.value.isRecordingVideo){
                        setState(() {
                          isButtonDisabled = true;
                        });
                        timeLeft = 3;
                        videoMillisecondsDuration = 0;
                        setState(() {

                        });
                        Timer.periodic(Duration(seconds: 1), (timer)async {
                          timeLeft--;
                          setState(() {

                          });
                          if(timeLeft==0){
                            setState(() {
                              isButtonDisabled = false;
                            });
                            timer.cancel();
                            videoMillisecondsDuration = 0;
                            await _controller.startVideoRecording();
                            recordingTimer = Timer.periodic(Duration(milliseconds: 100), (ntimer)async {
                              videoMillisecondsDuration += 100;

                              setState(() {

                              });
                              if(videoMillisecondsDuration>=30000){
                                XFile video = await _controller.stopVideoRecording();
                                setState(() {
                                  recordingTimer.cancel();
                                  videoMillisecondsDuration = 0;
                                });

                                File file = File(video.path);
                                await _controller.setFlashMode(FlashMode.off);
                                Navigator.pop(context, file);
                              }

                            });
                          }

                        });



                      }

                      else {
                        XFile video = await _controller.stopVideoRecording();
                        setState(() {
                          recordingTimer.cancel();
                          videoMillisecondsDuration = 0;
                        });

                        File file = File(video.path);
                        await _controller.setFlashMode(FlashMode.off);
                        Navigator.pop(context, file);
                      }

                      if (!mounted) return;


                    } catch (e) {
                      // If an error occurs, log the error to the console.
                      print(e);
                    }
                  },
                  child: Stack(
                    children: [
                      Container(
                        height: 80,
                        margin: EdgeInsets.all(2),
                        width: 80,
                        decoration: BoxDecoration(
                          color: Colors.red,
                          borderRadius: BorderRadius.circular(40)
                        ),
                        child: Center(
                          child: Icon(
                            Icons.circle,
                            color: Colors.white,
                            size: 80,
                          ),
                        ),
                      ),
                      // FloatingActionButton(
                      //
                      //   onPressed: null,
                      //   child: const Icon(Icons.camera_alt, size: 50,),
                      //   backgroundColor: Colors.red,
                      // ),
                      Positioned(
                        top: 0,right: 0,bottom: 0,left: 0,
                        child: CircularProgressIndicator(
                          value: videoMillisecondsDuration/30000,
                          color: Colors.white,
                        ),
                      )
                    ],
                  ),
                ),
                hSizedBox,
                GestureDetector(
                  behavior: HitTestBehavior.opaque,
                  onTap: _controller.value.isRecordingVideo || isButtonDisabled?(){}:()async{
                    print('hello world ');
                    print('tt');
                    print('${cameras.length}');
                    int count = 0;
                    cameras.forEach((element) {

                      print('america rus malasiya ${selectedCamera!.lensDirection} ${element.lensDirection}');
                      if(element.lensDirection!=selectedCamera!.lensDirection && count==0){
                        selectedCamera = element;
                        count++;

                      }
                    });
                    setState(() {
                      load = true;
                    });
                    await onNewCameraSelected(selectedCamera!);
                    setState(() {
                      load = false;
                    });

                    setState(() {

                    });
                  },
                  child: Icon(
                    getCameraLensIcon(selectedCamera!.lensDirection),
                    color: Colors.white,
                    size: 32,
                  ),
                )
              ],
            ),
          ],
        ),
      ),
    );

  }
}
