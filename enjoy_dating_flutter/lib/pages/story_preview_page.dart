import 'dart:io';
import 'dart:typed_data';

import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/message_modal.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/widget/custom_full_page_loader.dart';
import 'package:flutter/material.dart';
import 'package:story_view/story_view.dart';
import 'package:video_player/video_player.dart';

import '../constants/colors.dart';
import 'package:video_thumbnail/video_thumbnail.dart';
import 'package:path_provider/path_provider.dart';

import '../constants/global_data.dart';

class StoryPreviewPage extends StatefulWidget {
  final File storyFile;
  final VideoPlayerController controller;
  final bool fromChatPage;
  final Map<String,dynamic>? request;
  StoryPreviewPage(
      {Key? key, this.fromChatPage = false, required this.storyFile, required this.controller, this.request})
      : super(key: key);

  @override
  _StoryPreviewPageState createState() => _StoryPreviewPageState();
}

class _StoryPreviewPageState extends State<StoryPreviewPage> {
  TextEditingController titleController = TextEditingController();
  int value = 2;
  int duration = 0;
  bool load= false;
  initializeValues() async {
    // widget.controller.addListener(() async {
    //   value = (await widget.controller.position)?.inMilliseconds ?? 0;
    //   duration = widget.controller.value.duration.inMilliseconds;
    //   setState(() {});
    // });
    duration = widget.controller.value.duration.inMilliseconds;
  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    widget.controller.play();
    initializeValues();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
    widget.controller.removeListener(() {});
    widget.controller.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      resizeToAvoidBottomInset: false,
      body: SafeArea(
        child: Stack(
          children: [
            Container(
              child: widget.controller.value.isInitialized
                  ? GestureDetector(
                onTap: (){
                  if(widget.controller.value.isPlaying){
                    widget.controller.pause();
                  }else{
                    widget.controller.play();
                  }
                },
                      child: VideoPlayer(widget.controller),
                    )
                  : Container(),
            ),
            
            Positioned(
              bottom:  MediaQuery.of(context).viewInsets.bottom,
              left: 0,
              right: 0,
              child: Container(
                padding: EdgeInsets.symmetric(horizontal: 16),
                decoration: BoxDecoration(
                  color: Colors.black.withOpacity(0.4),
                  borderRadius: BorderRadius.circular(0),
                  // border: Border.all(color: Colors.white),
                ),
                child: Row(
                  children: [
                    Expanded(
                      child: TextFormField(
                        controller: titleController,
                        style: TextStyle(
                          color: MyColors.whiteColor,
                        ),
                        decoration: InputDecoration(
                            border: InputBorder.none,
                            hintText: 'Enter caption',
                            hintStyle: TextStyle(color: Colors.white),
                          
                        ),
                      ),
                    ),
                    hSizedBox,
                    GestureDetector(
                      child: Icon(
                        Icons.send,
                        color: Colors.white,
                      ),
                      onTap: () async{
                        if(titleController.text==''){
                          presentToast('Please enter title for your story');
                        }else{
                          FocusScope.of(context).requestFocus( new FocusNode());
                          setState(() {
                            load = true;
                          });
                          Map<String, dynamic> request = {
                            'user_id':  userData?.id,
                            'title': titleController.text,
                            'file_type': 'video',
                            'seconds': duration.toString(),
                          };
                          if(widget.fromChatPage){
                            request = widget.request!;

                            request['message_type'] = kMessageType[3];
                            request['caption'] = titleController.text;
                          }

                          Uint8List? uint8list = await VideoThumbnail.thumbnailData(
                            video: widget.storyFile.path,
                            imageFormat: ImageFormat.JPEG,
                            maxWidth: 400, // specify the width of the thumbnail, let the height auto-scaled to keep the source aspect ratio
                            maxHeight: 400,
                            quality: 50,
                          );
                          final tempDir = await getTemporaryDirectory();

                          File thumbnail = await File('${tempDir.path}/image.png').create();
                          thumbnail.writeAsBytesSync(uint8list!.toList());
                          var files = {
                            'file': widget.storyFile,
                            'thumbnail': thumbnail,
                          };

                          if(widget.fromChatPage){
                            files = {
                              'message': widget.storyFile,
                              'thumbnail': thumbnail,
                            };
                          }

                          var jsonResponse = await Webservices.postDataWithImageFunction(body: request, files: files, context: context, endPoint:widget.fromChatPage?ApiUrls.sendMessage: ApiUrls.addStory);
                          if(jsonResponse['status']==1){
                            presentToast(jsonResponse['message']);
                            Navigator.pop(context, true);
                          }else{
                            setState(() {
                              load = false;
                            });
                          }
                        }
                      },
                    )
                  ],
                ),
              ),
            ),
            if(load)
              CustomFullPageLoader()
          ],
        ),
      ),
    );
  }
}
