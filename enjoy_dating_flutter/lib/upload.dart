import 'dart:developer';
import 'dart:io';

import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/profile_ready.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/image.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'constants/colors.dart';

class UploadPicPage extends StatefulWidget {
  const UploadPicPage({Key? key}) : super(key: key);

  @override
  _UploadPicPageState createState() => _UploadPicPageState();
}

class _UploadPicPageState extends State<UploadPicPage> {
  List images = [];
  // List row1=[];
  // List row2=[];
  Image? profile_view = null;

  File? profile=null ;
  @override
  void initState() {
    // TODO: implement initState
    profile_view = Image.network(userData!.imageUrl,fit: BoxFit.cover,height: 130.0, width:100);
    setState(() {

    });
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: appBar(
        implyLeading: false,
        context: context,
        title: '',
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              decoration: BoxDecoration(
                  gradient: LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
                colors: [Color(0xFE7D44CF), Color(0xFE00B199)],
              )),
              child: Container(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    vSizedBox8,
                    // AppBar(
                    //   backgroundColor: Colors.transparent,
                    //   leading: IconButton(
                    //     icon: Icon(Icons.arrow_back_ios_new_rounded, color: Colors.white,),
                    //     onPressed: () => {},
                    //   ),
                    //   title: Text('Back', style: TextStyle(color: Colors.white, fontSize: 16),),
                    //   centerTitle: true,
                    //   shadowColor: Colors.transparent,
                    // ),
                    SizedBox(height: 30,),
                    Container(
                      padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      child: SingleChildScrollView(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text('Upload your pics',
                                style: TextStyle(
                                    color: Colors.white,
                                    fontSize: 26,
                                    fontWeight: FontWeight.bold,
                                    letterSpacing: 1)),
                            Text(
                              'Upload your profile picture and atleast one gallery image',
                              style: TextStyle(
                                  color: Colors.white.withOpacity(0.8),
                                  fontSize: 16),
                            ),
                            vSizedBox4,
                            Text(
                              'Profile Pic',
                              style: TextStyle(
                                  color: Colors.white,
                                  fontFamily: 'regular',
                                  fontSize: 16),
                            ),
                            vSizedBox,
                           GestureDetector(
                             onTap: (){
                               _showImage_popup(context,'profile');
                             },
                             child: Container(
                                 clipBehavior: Clip.hardEdge,
                                 height:130,
                                 width:100,
                                 decoration: BoxDecoration(borderRadius: BorderRadius.circular(10.0),),
                                 child: (profile_view!=null)?profile_view:Text('')
                             ),
                           ),

                            // Image.asset('assets/slide-3.png', height: 130,),
                            vSizedBox2,
                            Text(
                              'Gallery',
                              style: TextStyle(
                                  color: Colors.white,
                                  fontFamily: 'regular',
                                  fontSize: 16),
                            ),
                            vSizedBox,

                            Row(
                              children: [
                                add_gallery_images(0),
                                hSizedBox,
                                add_gallery_images(1),
                                hSizedBox,
                                add_gallery_images(2),
                              ],
                            ),
                            vSizedBox,
                            Row(
                              children: [
                                add_gallery_images(3),
                                hSizedBox,
                                add_gallery_images(4),
                                hSizedBox,
                                add_gallery_images(5),
                              ],
                            ),

                            // Row(
                            //   children: [
                            //     for(int i=0;i<images.length;i++)
                            //       Expanded(
                            //         child: Padding(
                            //           padding: const EdgeInsets.all(5.0),
                            //           child: Column(
                            //             children: [
                            //               GestureDetector(
                            //                 child:Align(
                            //                   alignment: Alignment.topRight,
                            //                   child: Icon(Icons.close_rounded,color: Colors.red,),
                            //                 ),
                            //                 onTap: () {
                            //                     images.removeAt(i);
                            //                     setState(() {
                            //
                            //                     });
                            //                 },
                            //               ),
                            //               Image.file(images[i],width: 100.0,fit: BoxFit.cover,height: 90.0,),
                            //             ],
                            //           ),
                            //         ),
                            //       ),
                            //   ],
                            // ),
                            vSizedBox,
                            // if(images.length>=0)
                            // vSizedBox8,
                            // if(images.length==0)
                            //   vSizedBox,
                            // if(images.length>0)
                            Opacity(
                              opacity: images.length==0?0.4:1,
                              child: RoundEdgedButton(
                                color:MyColors.active,
                                text: 'Finish',
                                onTap: images.length==0?(){}: () async{
                                  Map files={};
                                  Map data = {
                                    'user_id':userData!.id,
                                  };
                                  log("uploading-------"+data.toString());
                                  if(profile!=null){
                                    files['profile_image']=profile;
                                  }
                                  for(int i=0;i<images.length;i++){
                                    files['images['+i.toString()+']']=images[i];
                                  }
                                  log("uploading-------"+userData.toString());
                                  // for(int i=0;i<images.length;i++){
                                  //   files['images']={images[0]};
                                  // }

                                  loadingShow(context);
                                  Map res = await postDataWithImage(data,'uploadUserImage',0, 0, files);

                                  loadingHide(context);
                                  print('upload img------$res');
                                  if(res['status'].toString()=='1'){
                                    var u_response = await getData({"user_id":userData!.id}, 'get_user_profile', 0, 0);
                                    if(u_response['status'].toString()=='1'){
                                      updateUserDetails(u_response['data']);
                                      userData = UserModal.fromJson(u_response['data']);
                                    }
                                    presentToast(res['message']);
                                    pushReplacement(context: context, screen: ProfileReadyPage());
                                    // Navigator.of(context).pushAndRemoveUntil(
                                    //     MaterialPageRoute(
                                    //         builder: (context) => ProfileReadyPage()),
                                    //         (Route<dynamic> route) => false);
                                  }
                                  else {
                                    presentToast(res['message']);
                                  }
                                  // push(
                                  //     context: context, screen: ProfileReadyPage());
                                },
                              ),
                            ),
                          ],
                        ),
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
                  if(image!=null && type=="profile"){
                    // profile_view = Image.file(image);
                    profile=image;
                    profile_view = Image.file(image,fit: BoxFit.cover, height: 130,width:100);
                    images.add(image);
                    setState(() {

                    });
                  }
                  else{
                    print('image----$image');

                    if (image != null) {
                      images.add(image);
                      setState(() {});
                    }

                  }

                  _close(ctx);
                },
                child: const Text('Take Camera')),
            CupertinoActionSheetAction(
                onPressed: () async {
                  File? image = null;
                  // images = [];
                  image = await pickImage(true);
                  if(image!=null && type=="profile"){
                    // profile_view = Image.file(image);
                    profile=image;
                    profile_view = Image.file(image,fit: BoxFit.cover, height: 130,width:100);
                    images.add(image);
                    setState(() {

                    });
                  }
                  else{
                    print('image----$image');

                    if (image != null) {
                      images.add(image);
                      setState(() {});
                    }

                  }

                  _close(ctx);
                },
                // onPressed: () async {
                //   File? image = null;
                //   // images = [];
                //   image = await pickImage(true);
                //   print('image----$image');
                //   if (image != null) {
                //     images.add(image);
                //     setState(() {});
                //     print('image array----$images');
                //   }
                //   _close(ctx);
                // },
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


  Widget add_gallery_images(int index){
    return  (images.length<=index)?Expanded(
      child: GestureDetector(
        child: Column(
          children: [
            ClipRRect(
                child: Image.asset(
                  'assets/add_image.png',
                  width:
                  MediaQuery.of(context).size.width,
                  fit: BoxFit.fitWidth,
                )
            ),
          ],
        ),
        onTap: () {
          if(images.length<6)
            _showImage_popup(context,'gallery');
          else
            presentToast('Only 6 image uploaded.');
        },
      ),
    ):Expanded(
      child: Stack(
        children:[
          Container(

              clipBehavior: Clip.hardEdge,
              // width: double.infinity,
              height:  (MediaQuery.of(context).size.width/3 - 20) * 504/424,
              // height:200,
            decoration: BoxDecoration(
              color:Colors.grey,
              borderRadius: BorderRadius.circular(12)
            ),
              child: Image.file(images[index], fit: BoxFit.cover,)
          ),
          Positioned(
            right:0,
              top:0,
              child: Container(
                clipBehavior: Clip.hardEdge,
                decoration: BoxDecoration(
                  color:Colors.black.withOpacity(0.5),
                  borderRadius: BorderRadius.only(bottomLeft: Radius.circular(50), topRight: Radius.circular(12))

                ),
            child:IconButton(

              padding: EdgeInsets.only(left:8, bottom:8),
              icon:Icon(Icons.close, color: Colors.white,), onPressed: (){
              images.removeAt(index);
              setState(() {

              });

            },)
          ))
        ],
      ),
    );
  }

}
