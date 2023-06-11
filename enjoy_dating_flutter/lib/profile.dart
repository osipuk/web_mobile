import 'dart:developer';
import 'dart:io';

import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/pages/photos_page.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/image.dart';
import 'package:Enjoy/services/validations.dart';
import 'package:Enjoy/upload.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/rounded_input.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'constants/colors.dart';
import 'constants/global_data.dart';
import 'modals/media_modal.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({Key? key}) : super(key: key);

  @override
  _ProfilePageState createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  Widget? profile_view = null;
  File? profile = null;
  List images1 = [];
  // List images2 = [];

  final TextEditingController name = TextEditingController();
  final TextEditingController email = TextEditingController();
  final TextEditingController phone = TextEditingController();
  final TextEditingController about = TextEditingController();
  final TextEditingController agentNameController = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    autofill();
    super.initState();
  }

  autofill() {
    profile_view = CustomCircleAvatar(
      imageUrl: userData!.imageUrl,
      height: 90,
      width: 90,
      assetImage: false,
    );
    name.text = userData!.name;
    email.text = userData!.emailId ;
    phone.text = userData!.mobileNumber ;
    about.text = userData!.about ?? '';
    images1 = userData!.galleryImages;
    agentNameController.text = userData!.agentDetails==null?'':'Your Agent :${userData!.agentDetails!['name']}'??'';
    print('the images are $images1');
    // for(var i=0;i<user_data!['gallery'].length;i++){
    //   images1.add(user_data!['gallery'][i]['images']);
    // }
    print('check gallery-----' + images1.toString());
    setState(() {});
  }

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
                        'Edit Profile',
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
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              if (profile_view != null)
                                GestureDetector(
                                    onTap: () {
                                      FocusScope.of(context).requestFocus(new FocusNode());
                                      _showImage_popup(context, "profile");
                                    },
                                    child: profile_view!),
                              // CustomCircleAvatar(imageUrl: 'assets/chat_person.png',height: 90, width: 90, assetImage: false,),
                              SizedBox(
                                height: 10,
                              ),
                              GestureDetector(
                                child: Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Text(
                                      'Change Profile',
                                      style: TextStyle(
                                          fontSize: 16,
                                          color: Colors.white,
                                          fontFamily: 'semibold'),
                                    )
                                  ],
                                ),
                              )
                            ],
                          ),
                          SizedBox(
                            height: 30,
                          ),
                          roundedInput(controler_: name, placeholder: 'Name'),

                          SizedBox(
                            height: 15,
                          ),
                          roundedInput(
                              keyboardType: TextInputType.phone,
                              controler_: phone,
                              placeholder: 'Mobile No.'),
                          SizedBox(
                            height: 15,
                          ),
                          roundedInput(
                              controler_: email,
                              inputEnable: false,
                              placeholder: 'Email'),
                          SizedBox(
                            height: 15,
                          ),
                          roundedInput(
                              controler_: about,
                              placeholder: 'About',
                              maxLength: 3),
                          SizedBox(
                            height: 15,
                          ),
                          if(agentNameController.text!='')
                          roundedInput(
                              controler_: agentNameController,
                              placeholder: 'Agent name',
                              inputEnable: false,
                              maxLength: 1),
                          SizedBox(
                            height: 15,
                          ),
                          vSizedBox,
                          Wrap(children: [
                            for(int index = 0;index<=images1.length;index++)
                            Padding(
                              padding: EdgeInsets.symmetric(horizontal: 6,vertical: 4),
                              child: add_gallery_images(index),
                            )
                          ],),
                          // Row(
                          //   children: [
                          //     add_gallery_images(0),
                          //     hSizedBox,
                          //     add_gallery_images(1),
                          //     hSizedBox,
                          //     add_gallery_images(2),
                          //   ],
                          // ),
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
                          vSizedBox,
                          // SizedBox(height: 15,),
                          // Row(
                          //   children: [
                          //     Expanded(
                          //       flex: 4,
                          //       child: roundedInput(placeholder: 'Day')
                          //     ),
                          //     SizedBox(width: 15,),
                          //     Expanded(
                          //         flex: 4,
                          //         child: roundedInput(placeholder: 'Month')
                          //     ),
                          //     SizedBox(width: 15,),
                          //     Expanded(
                          //         flex: 5,
                          //         child: roundedInput(placeholder: 'Year')
                          //     )
                          //   ],
                          // ),
                          vSizedBox4,
                          // Row(
                          //   children: [
                          //     RoundEdgedButton(text: 'Male',
                          //       color: MyColors.primaryColor,
                          //       width: 100,
                          //       fontfamily: 'regular',
                          //       fontSize: 16,
                          //       shadow: 0,
                          //     ),
                          //     hSizedBox2,
                          //     RoundEdgedButton(text: 'Female',
                          //       color: Color(0xFFFFFFFF).withOpacity(0.70),
                          //       width: 150,
                          //       textColor: Colors.black,
                          //       fontSize: 16,
                          //       fontfamily: 'regular',
                          //       shadow: 0,
                          //     ),
                          //   ],
                          // ),
                          SizedBox(
                            height: 20,
                          ),
                          // Row(
                          //   children: [
                          //     Expanded(
                          //         flex: 4,
                          //         child: Text('Male', style: TextStyle(),)
                          //     ),
                          //     SizedBox(width: 15,),
                          //     Expanded(
                          //         flex: 4,
                          //         child: roundedInput(placeholder: 'Female')
                          //     ),
                          //     Expanded(
                          //       flex: 8,
                          //       child: SizedBox(),
                          //     )
                          //   ],
                          // ),
                          SizedBox(
                            height: 30,
                          ),
                          SolidBtn(
                            BtnText: 'Save',
                            funcTap: () async {
                              FocusScope.of(context).requestFocus(FocusNode());
                              if (validateName(name.text) == null) {
/*update profile images process*/
                                Map files = {};
                                Map data = {
                                  'user_id': userData!.id,
                                };
                                log("checkmizan all images list------------------" +
                                    images1.toString());
                                bool hasfile = false;
                                if (profile != null) {
                                  files['profile_image'] = profile;
                                  hasfile = true;
                                }
                                for (int i = 0; i < images1.length; i++) {
                                  log("checkmizan----" +
                                      images1[i]['images']
                                          .runtimeType
                                          .toString());
                                  if (images1[i]['images'].runtimeType !=
                                      String) {
                                    files['images[' + i.toString() + ']'] =
                                        images1[i]['images'];
                                    hasfile = true;
                                  }
                                }
                                log("checkmizan all files list------------------" +
                                    files.toString());
                                // for(int i=0;i<images.length;i++){
                                //   files['images']={images[0]};
                                // }
                                if (hasfile == true) {
                                  loadingShow(context);
                                  Map res = await postDataWithImage(
                                      data, 'uploadUserImage', 0, 0, files);

                                  loadingHide(context);
                                  print('upload img------$res');
                                  if (res['status'].toString() == '1') {}
                                }
                                /*update profile process*/
                                Map data1 = {
                                  "user_id": userData!.id,
                                  "name": name.text,
                                  "about": about.text,
                                  "phone": phone.text
                                };
                                loadingShow(context);
                                Map res1 =
                                    await postData(data1, 'edit_profile', 0, 0);
                                loadingHide(context);
                                print('checkmizan edit profile-----$res1');
                                if (res1['status'].toString() == '1') {
                                  updateUserDetails(res1['data']);
                                  setState(() {
                                    userData = UserModal.fromJson(res1['data']);
                                    autofill();
                                  });
                                } else {
                                  presentToast(res1['message']);
                                }
                              }
                            },
                          ),
                          SizedBox(
                            height: 30,
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
                        print('image----$image');

                        if (image != null) {
                          images1.add({"images": image});
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
                        print('image----$image');

                        if (image != null) {
                          images1.add({"images": image});
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
    return GestureDetector(
      onTap: (){
        List<ImageModal> media = [];
        (images1 as List).forEach((element) {
          media.add(ImageModal.fromJson(element));
        });
        push(context: context, screen: PhotosPage(images: media, selectedIndex: index));
      },
      child: (images1.length <= index)
          ? Container(
        width: (MediaQuery.of(context).size.width-72)/3,
            height:  (MediaQuery.of(context).size.width-72)/3,
            child: GestureDetector(
              child: ClipRRect(
                  child: Image.asset(
                'assets/add_image.png',
                // width: MediaQuery.of(context).size.width,
                fit: BoxFit.fill,
              )),
              onTap: () {
                FocusScope.of(context).requestFocus(new FocusNode());
                if (images1.length < 6)
                  _showImage_popup(context, 'gallery');
                else
                  presentToast('Only 6 image uploaded.');
              },
            ),
          )
          : Stack(
            children: [
              Container(
                  width: (MediaQuery.of(context).size.width-72)/3,
                  clipBehavior: Clip.hardEdge,
                  // width: double.infinity,
                  height:  (MediaQuery.of(context).size.width-72)/3,
                  // height: (MediaQuery.of(context).size.width / 3 - 20) *
                  //     504 /
                  //     424,
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
              if (images1.length > 1)
                Positioned(
                    right: 0,
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
                              var id = images1[index]['id'];
                              loadingShow(context);
                              var request = {"user_id": userData!.id, "id": id};
                              print('the reqeust is $request');
                              var rem_res = await getData(
                                  request,
                                  'removeGalleryImage',
                                  1,
                                  1);
                              loadingHide(context);
                              if (rem_res['status'].toString() == '1') {
                                images1.removeAt(index);
                                setState(() {});
                                var u_response = await getData(
                                    {"user_id": userData!.id},
                                    'get_user_profile',
                                    0,
                                    0);
                                if (u_response['status'].toString() == '1') {
                                  updateUserDetails(u_response['data']);
                                  userData = UserModal.fromJson(u_response['data']);
                                }
                              }
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
