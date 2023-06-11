import 'dart:developer';
import 'dart:io';
import 'dart:async';

import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/image.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/upload.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
import 'constants/colors.dart';
import 'constants/global_data.dart';
import 'package:video_player/video_player.dart';

class addStory extends StatefulWidget {
  final bool? is_update;
  final Map? data;
  const addStory({
    Key? key,
    this.is_update = false,
    this.data,
  }) : super(key: key);

  @override
  _addStoryState createState() => _addStoryState();
}

class _addStoryState extends State<addStory> {

  T? _ambiguate<T>(T? value) => value;
  Widget? profile_view = null;
  File? profile = null;
  List images1 = [];
  List images2 = [];
  late List<CameraDescription> _cameras;
  File? videoFile;
  int duration = 0;
  final TextEditingController title = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    print('-------story data----${widget.data}');
    if (widget.is_update!) {
      title.text = widget.data!['title'];
      var file = {'images': widget.data!['file'],'is_file':false};
      images1.add(file);
    }


  }

  @override
  void dispose() {
    // _controller.dispose();
    super.dispose();
  }

  // autofill() {
  //   profile_view = CustomCircleAvatar(
  //     imageUrl: user_data!['image'],
  //     height: 90,
  //     width: 90,
  //     assetImage: false,
  //   );
  //   // for(var i=0;i<user_data!['gallery'].length;i++){
  //   //   images1.add(user_data!['gallery'][i]['images']);
  //   // }
  //   print('check gallery-----' + images1.toString());
  //   setState(() {});
  // }



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Container(
            height: double.infinity,
            decoration: BoxDecoration(
                gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
            )),
            child: SingleChildScrollView(
              child: Container(
                child: Column(
                  // crossAxisAlignment: CrossAxisAlignment.stretch,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    AppBar(
                      backgroundColor: Colors.transparent,
                      leading: IconButton(
                        icon: Icon(
                          Icons.arrow_back_ios_new_rounded,
                          color: Colors.white,
                        ),
                        onPressed: () => {Navigator.pop(context, userData)},
                      ),
                      title: Text(
                        widget.is_update! ? 'Edit Story' : 'Add Story',
                        style: TextStyle(color: Colors.white, fontSize: 16),
                      ),
                      centerTitle: true,
                      shadowColor: Colors.transparent,
                      shape: Border(
                          bottom: BorderSide(
                              color: Colors.white.withOpacity(0.50),
                              width: 0.5)),
                    ),
                    SizedBox(
                      height: 40,
                    ),
                    Container(
                      padding:
                          EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          roundedInput(controler_: title, placeholder: 'Title'),
                          vSizedBox,
                          ParagraphText(
                            'Add Video',
                            fontSize: 16,
                            fontFamily: 'bold',
                            color: MyColors.primaryColor,
                          ),
                          vSizedBox,
                          Row(
                            children: [
                              IconButton(onPressed: () async{
                                videoFile = await pickVideo(isGallery: true);
                                VideoPlayerController  _controller =  VideoPlayerController.file(videoFile!);
                                await _controller.initialize();
                                // duration = _controller.value.duration.inSeconds.toString();
                                print('the duration is $duration');
                                duration = _controller.value.duration.inSeconds;
                                print('the duration iss is $duration');
                                // _controller.addListener(() {
                                //   setState(() {});
                                // });
                                // _controller.setLooping(true);
                                // _controller.initialize().then((_) => setState(() {}));
                                // _controller.play();
                                print('video-file---$videoFile---------duration-------$duration');
                              },
                                  icon: Icon(Icons.video_call_outlined,color: MyColors.primaryColor,))
                              // _captureControlRowWidget(),
                              // add_gallery_images(0),
                              // hSizedBox,
                              // add_gallery_images(1),
                              // hSizedBox,
                              // add_gallery_images(2),
                            ],
                          ),
                          // vSizedBox,
                          // Row(
                          //   children: [
                          //     add_gallery_images(3),
                          //     hSizedBox,
                          //     add_gallery_images(4),
                          //     hSizedBox,
                          //     add_gallery_images(5),
                          //   ],
                          // ),
                          vSizedBox4,
                          SolidBtn(
                            BtnText: widget.is_update!?'Update':'Save',
                            funcTap: () async {
                              Map files = {};
                              if (validateTitle(title.text) == null) {
                                if (videoFile==null) {
                                  presentToast('Please upload video.');
                                  return;
                                }
                                Map data = {
                                  'user_id':  userData?.id,
                                  'title': title.text,
                                  'file_type': 'video',
                                  'duration': duration.toString(),
                                };

                                if(widget.is_update!){
                                  data['id']=widget.data!['id'];
                                }

                                print('data---pass ${data}');
                                if (videoFile!=null) {
                                  files = {'file': videoFile};
                                }

                                loadingShow(context);
                                Map res = await postDataWithImage(
                                    data, widget.is_update!?'editMyStory':'addMyStory', 0, 0, files);
                                loadingHide(context);
                                print('add story----$res');
                                if (res['status'].toString() == '1') {
                                  Navigator.pop(context);
                                }
                              }
                            },
                          ),

                          if(widget.is_update!)
                            vSizedBox4,
                          if(widget.is_update!)
                            SolidBtn(
                            BtnText: 'Remove Story',
                            funcTap: () async {
                              Map data = {
                               'id':widget.data!['id'],
                                'user_id': userData?.id,
                              };
                              loadingShow(context);
                              Map res = await getData(data,'deleteMyStory',0,0);
                              loadingHide(context);
                              print('delete-----$res');
                              if(res['status'].toString()=='1'){
                                Navigator.pop(context);
                              }
                            },
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  void _showImage_popup(BuildContext ctx, String type) {
    showCupertinoModalPopup(
        context: ctx,
        builder: (_) => CupertinoActionSheet(
              actions: [
                CupertinoActionSheetAction(
                    onPressed: () async {
                      File? image = null;
                      // images = [];
                      image = await pickImage(false);
                      if (image != null && type == "profile") {
                        // profile_view = Image.file(image);
                        profile = image;
                        profile_view = CustomCircleAvatar(
                          imageUrl: '',
                          height: 90,
                          width: 90,
                          assetImage: false,
                          localImageFile: image,
                          localImage: true,
                        );
                        // profile_view = Image.file(image,fit: BoxFit.cover, height: 130,width:100);
                        setState(() {});
                      } else {


                        if (image != null) {
                          images1.add({"images": image,'is_file':true});
                          setState(() {});
                        }
                      }
                      _close(ctx);
                    },
                    child: const Text('Open Camera')),
                CupertinoActionSheetAction(
                    onPressed: () async {
                      File? image = null;
                      // images = [];
                      image = await pickImage(true);
                      if (image != null && type == "profile") {
                        // profile_view = Image.file(image);
                        profile = image;
                        profile_view = CustomCircleAvatar(
                          imageUrl: '',
                          height: 90,
                          width: 90,
                          assetImage: false,
                          localImageFile: image,
                          localImage: true,
                        );
                        // profile_view = Image.file(image,fit: BoxFit.cover, height: 130,width:100);
                        setState(() {});
                      } else {


                        if (image != null) {
                          images1.add({"images": image,'is_file':true});
                          setState(() {});
                        }
                      }
                      _close(ctx);
                    },
                    child: const Text('Gallery')),
              ],
              cancelButton: CupertinoActionSheetAction(
                onPressed: () => _close(ctx),
                child: const Text('Close'),
              ),
            ));
  }

  void _close(BuildContext ctx) {
    Navigator.of(ctx).pop();
  }

  Widget add_gallery_images(int index) {
    return (images1.length <= index)
        ? Expanded(
            child: GestureDetector(
              child: Column(
                children: [
                  ClipRRect(
                      child: Image.asset(
                    'assets/add_image.png',
                    width: 100,
                    fit: BoxFit.fitWidth,
                  )),
                ],
              ),
              onTap: () {
                // if (images1.length < 6)
                  // _showImage_popup(context, 'gallery');
                // else
                //   presentToast('Only 6 image uploaded.');
              },
            ),
          )
        : Expanded(
            child: Stack(
              children: [
                Container(
                    clipBehavior: Clip.hardEdge,
                    // width: double.infinity,
                    height: (MediaQuery.of(context).size.width / 3 - 20) *
                        504 /
                        424,
                    // height:200,
                    decoration: BoxDecoration(
                        color: Colors.grey,
                        borderRadius: BorderRadius.circular(12)),
                    child: (images1[index]['images'].runtimeType != String)
                        ? Image.file(
                            images1[index]['images'],
                            fit: BoxFit.cover,
                          )
                        : Image.network(
                            images1[index]['images'],
                            fit: BoxFit.cover,
                          )),
                if (images1.isNotEmpty)
                  Positioned(
                      left: 84,
                      top: 0,
                      child: Container(
                          clipBehavior: Clip.hardEdge,
                          decoration: BoxDecoration(
                              color: Colors.black.withOpacity(0.5),
                              borderRadius: BorderRadius.only(
                                  bottomLeft: Radius.circular(50),
                                  topRight: Radius.circular(12))),
                          child: IconButton(
                            padding: EdgeInsets.only(left: 8, bottom: 8),
                            icon: Icon(
                              Icons.close,
                              color: Colors.white,
                            ),
                            onPressed: () async {
                              if (images1[index]['images'].runtimeType ==
                                  String) {
                                images1.removeAt(index);
                                setState(() {});
                              } else {
                                images1.removeAt(index);
                                setState(() {});
                              }
                              setState(() {});
                            },
                          )))
              ],
            ),
          );
  }

}
