import 'dart:async';
import 'dart:developer';
import 'dart:io';

import 'package:Enjoy/add_story.dart';
import 'package:Enjoy/changepassword.dart';
import 'package:Enjoy/chat_detail_page.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_functions.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/contactus.dart';
import 'package:Enjoy/dialogs/withdraw_money_dialog.dart';
import 'package:Enjoy/follower_list.dart';
import 'package:Enjoy/following_list.dart';
import 'package:Enjoy/get_coins.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/notification.dart';
import 'package:Enjoy/overview.dart';
import 'package:Enjoy/pages/gifts_sent_page.dart';
import 'package:Enjoy/pages/photos_page.dart';
import 'package:Enjoy/pages/story_preview_page.dart';
import 'package:Enjoy/pages/view_story_page.dart';

import 'package:Enjoy/profile.dart';
import 'package:Enjoy/reward.dart';
import 'package:Enjoy/services/alert.dart';
import 'package:Enjoy/services/api_urls.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/services/image.dart';
import 'package:Enjoy/services/localServices.dart';
import 'package:Enjoy/services/location.dart';
import 'package:Enjoy/services/webservices.dart';
import 'package:Enjoy/user_blocked.dart';
import 'package:Enjoy/view_story.dart';
import 'package:Enjoy/welcome.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:Enjoy/widget/block_layout.dart';
import 'package:Enjoy/widget/confirmation_dialog.dart';
import 'package:Enjoy/widget/custom_circle_avatar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:Enjoy/widget/custom_text_field.dart';
import 'package:Enjoy/widget/record_video_screen.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:Enjoy/widget/showSnackbar.dart';
import 'package:Enjoy/widget/show_custom_modal_sheet.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:Enjoy/widget/withdrawal_history.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'constants/global_data.dart';
import 'package:story_view/story_view.dart';
import 'package:video_player/video_player.dart';

import 'constants/global_keys.dart';
import 'dialogs/showFeedbackDialog.dart';
import 'modals/media_modal.dart';

class Profile_Account_Page extends StatefulWidget {
  const Profile_Account_Page({Key? key}) : super(key: key);
  @override
  _Profile_Account_PageState createState() => _Profile_Account_PageState();
}

class _Profile_Account_PageState extends State<Profile_Account_Page> {
  TextEditingController email = TextEditingController();
  TextEditingController name = TextEditingController();
  TextEditingController phone = TextEditingController();
  TextEditingController country = TextEditingController();

  double _currentSliderValue = 20;
  double lat = 0;
  double lng = 0;
  List my_stories = [];
  bool addStoryLoad = false;
  Map adminSetting={};
  // List my_user =[];


  int usdToDiamondConversionRate = 0;
  int minimumWithdrawableAmountInUsd = 25;

  double maxCapacityInUsd = 0;
  getConversionRate()async{
    var jsonResponse = await Webservices.getMap(ApiUrls.converstionRates);
    usdToDiamondConversionRate = int.parse(jsonResponse['diamond_to_usd']??'20');
    maxCapacityInUsd = userData!.diamonds/usdToDiamondConversionRate;
    minimumWithdrawableAmountInUsd =  int.parse(jsonResponse['min_withdrawal_amount']??'20');
    setState(() {

    });
  }
  changeProfilePicture(bool isGallery) async {
    File? selectedImage;
    selectedImage = await pickImage(isGallery);
    if (selectedImage != null) {
      Navigator.pop(context);
      loadingShow(context);
      var request = {
        'user_id': userData!.id,
      };
      var files = {'image': selectedImage};
      await Webservices.postDataWithImageFunction(
          body: request,
          files: files,
          context: context,
          endPoint: ApiUrls.editProfile);
      await MyLocalServices.updateUserDataFromServer(
          userId: userData!.id, apiUrl: ApiUrls.getUserData);

      loadingHide(context);
      setState(() {});
    }
  }
  getAdminSetting()async{
    adminSetting = await Webservices.getMap(ApiUrls.settingsAdmin);

  }
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    // get_GPS_Position();
    // interval_api();
    getConversionRate();
    print('user detail-----${userData}');
    get_my_stories();
    get_info();
    getAdminSetting();
  }

  get_GPS_Position() async {
    print('------enter------');
    dynamic position = await determinePosition();
    print('current position------${position}');
    if (position != null) {}
  }

  get_info() async {
    Map data = {'user_id':  userData?.id};
    Map res = await getData(data, 'get_user_profile', 0, 0);
    print('res--------$res');
    if (res['status'].toString() == '1') {
      userData = UserModal.fromJson(res['data']);
      setState(() {});
    }
  }

  get_my_stories() async {
    Map data = {
      'user_id':  userData?.id,
    };
    Map res = await getData(data, 'myStoryList', 0, 0);
    print('my story-----$res');
    if (res['status'].toString() == '1') {
      my_stories = res['data'];
      setState(() {});
    }
  }
  // get_my_user() async {
  //   Map data = {
  //     'user_id': await getCurrentUserId(),
  //   };
  //   Map res = await getData(data, 'getGiftList', 0, 0);
  //   print('my story-----$res');
  //   if (res['status'].toString() == '1') {
  //     my_user = res['data'];
  //     setState(() {});
  //   }
  // }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.whiteColor,
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    padding: EdgeInsets.all(16),
                    decoration: BoxDecoration(
                        color: MyColors.secondary,
                        borderRadius: BorderRadius.only(
                            bottomLeft: Radius.circular(40),
                            bottomRight: Radius.circular(40))),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        vSizedBox4,
                        Container(
                          width: MediaQuery.of(context).size.width,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            children: [
                              // Image.network(user_data!['image']),
                              GestureDetector(
                                onTap: () {
                                  showCustomBottomSheet(
                                    context,
                                    height: null,
                                    child: Padding(
                                      padding: const EdgeInsets.symmetric(horizontal: 32),
                                      child: Column(
                                        mainAxisSize: MainAxisSize.min,
                                        children: [
                                          GestureDetector(
                                            onTap: () {
                                              changeProfilePicture(false);
                                            },
                                            child: Row(

                                              children: [
                                                Icon(Icons.camera_alt),
                                                hSizedBox,
                                                SubHeadingText(
                                                    'Open Camera'),
                                              ],
                                            ),
                                          ),
                                          vSizedBox,
                                          Divider(),
                                          vSizedBox,
                                          GestureDetector(
                                              onTap: () {
                                                changeProfilePicture(true);
                                              },
                                              child: Row(
                                                children: [
                                                  Icon(Icons.image),
                                                  hSizedBox,
                                                  SubHeadingText(
                                                      'Select From Gallery'),
                                                ],
                                              )),
                                        ],
                                      ),
                                    ),
                                  );
                                },
                                child: Stack(
                                  children: [
                                    Container(
                                      padding: EdgeInsets.all(6),
                                      child: CustomCircularImage(
                                        imageUrl: userData!.imageUrl,
                                        height: 100,
                                        width: 100,
                                      ),
                                    ),
                                    Positioned(
                                      bottom: 0,
                                      right: 0,
                                      child: Container(
                                        padding: EdgeInsets.all(6),
                                        decoration: BoxDecoration(
                                            color: Colors.white,
                                            borderRadius: BorderRadius.circular(50)
                                        ),
                                        child: Icon(Icons.camera_alt),
                                      ),
                                    )
                                  ],
                                ),
                              ),
                              hSizedBox2,

                              vSizedBox,
                              Text(
                                '#' + userData!.uniqueId,
                                style: TextStyle(
                                    fontSize: 12,
                                    fontFamily: 'semibold',
                                    color: Colors.white),
                              ),
                              vSizedBox,
                              ParagraphText(
                                userData!.name +
                                    ', ' +
                                    calculateAge(userData!.dateOfBirth)
                                        .toString() +
                                    ', ' +
                                    userData!.country,
                                fontSize: 16,
                                fontFamily: 'semibold',
                                color: Colors.white,
                              ),
                              // ParagraphText('Rosella William, 25, USA',
                              //   fontSize: 16,
                              //   fontFamily: 'semibold',
                              //   color: Colors.white,),
                            ],
                          ),
                        ),
                        // vSizedBox,
                        // Row(
                        //   mainAxisAlignment: MainAxisAlignment.spaceAround,
                        //   children: [
                        //     Text('Location: USA', style: TextStyle(fontSize: 16, fontFamily: 'semibold', color: Colors.white),),
                        //     Text('Age: 25 Yr', style: TextStyle(fontSize: 16, fontFamily: 'semibold', color: Colors.white),)
                        //   ],
                        // ),

                        vSizedBox4,
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            GestureDetector(
                              behavior: HitTestBehavior.translucent,
                              onTap: () async {
                                await Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => (Following_list(
                                          user_id: userData!.id,
                                        ))));
                                MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);
                              },
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  ParagraphText(
                                    '${userData!.following}',
                                    fontSize: 16,
                                    fontFamily: 'bold',
                                    color: MyColors.whiteColor,
                                  ),
                                  vSizedBox05,
                                  ParagraphText(
                                    'Following',
                                    fontSize: 16,
                                    fontFamily: 'light',
                                    color: Colors.white,
                                  ),
                                ],
                              ),
                            ),
                            hSizedBox8,
                            GestureDetector(
                              behavior: HitTestBehavior.translucent,
                              onTap: () async{
                                await Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => (Follower_list(
                                          user_id: userData!.id,
                                        ))));
                                MyLocalServices.updateUserDataFromServer(userId: userData!.id, apiUrl: ApiUrls.getUserData);

                              },
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  ParagraphText(
                                    '${userData!.followers}',
                                    fontSize: 16,
                                    fontFamily: 'bold',
                                    color: MyColors.whiteColor,
                                  ),
                                  vSizedBox05,
                                  const ParagraphText(
                                    'Followers',
                                    fontSize: 16,
                                    fontFamily: 'light',
                                    color: Colors.white,
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                        vSizedBox4,
                        const ParagraphText(
                          'Add Stories',
                          fontSize: 16,
                          fontFamily: 'bold',
                          color: MyColors.primaryColor,
                        ),
                        vSizedBox,
                        Row(
                          children: [
                            GestureDetector(
                              behavior: HitTestBehavior.translucent,
                              onTap: addStoryLoad
                                  ? () {
                                print('please wait');
                              }
                                  : () async {
                                File? videoFile;
                                int duration = 0;

                                // videoFile = await pickVideo(isGallery: false);
                                videoFile = await push(
                                    context: context,
                                    screen: RecordVideoScreen());
                                if (videoFile != null) {
                                  setState(() {
                                    addStoryLoad = true;
                                  });
                                  VideoPlayerController controller =
                                  VideoPlayerController.file(
                                      videoFile);
                                  await controller.initialize();
                                  duration =
                                      controller.value.duration.inSeconds;
                                  print('the duration iss is $duration');

                                  // try{
                                  //   controller.dispose();
                                  // }catch(e){
                                  //   print('Error in catch block $e');
                                  // }
                                  if (duration < 5) {
                                    presentToast(
                                        'Story Length too short');
                                  } else if (duration > 30) {
                                    presentToast(
                                        'Story Length must be less than 30 secs');
                                  } else {
                                    await push(
                                        context: context,
                                        screen: StoryPreviewPage(
                                          storyFile: videoFile,
                                          controller: controller,
                                        ));
                                    get_my_stories();
                                  }

                                  controller.dispose();
                                  setState(() {
                                    addStoryLoad = false;
                                  });
                                } else {
                                  print('the selected video is null');
                                }

                                // push(context: context, screen: addStory())
                                //     .then((val) => {
                                //           get_my_stories(),
                                //         });
                              },
                              child: CustomCircleAvatar(
                                imageUrl: 'assets/add_border.png',
                              ),
                            ),
                            hSizedBox,
                            Expanded(
                              child: Container(
                                height: 75,
                                child: ListView(
                                  scrollDirection: Axis.horizontal,
                                  children: <Widget>[
                                    for (int i = 0; i < my_stories.length; i++)
                                      GestureDetector(
                                        onTap: () {
                                          push(
                                              context: context,
                                              screen: ViewStoryPage(
                                                stories: my_stories,
                                                selectedIndex: i, userId: userData!.id,
                                              ));
                                          // push(
                                          //     context: context,
                                          //     screen: view_story(
                                          //       stories: my_stories,
                                          //       index: i,
                                          //     )).then((val) => {
                                          //       get_my_stories(),
                                          //     });
                                        },
                                        child: Padding(
                                          padding:
                                          const EdgeInsets.only(left: 5.0),
                                          child: Container(
                                            width: 75,
                                            decoration: BoxDecoration(
                                                borderRadius:
                                                BorderRadius.circular(50),
                                                color: Colors.white,
                                                border: Border.all(
                                                    color:
                                                    MyColors.primaryColor,
                                                    width: 2)),
                                            padding: EdgeInsets.all(2),
                                            child: ClipRRect(
                                              clipBehavior: Clip.hardEdge,
                                              child: Image.network(
                                                my_stories[i]['thumbnail'] ??
                                                    '',
                                                fit: BoxFit.cover,
                                              ),
                                              borderRadius:
                                              BorderRadius.circular(50),
                                            ),
                                          ),
                                        ),
                                      ),
                                  ],
                                ),
                              ),
                            ),
                            // hSizedBox,
                            // Container(
                            //   decoration: BoxDecoration(
                            //       borderRadius: BorderRadius.circular(50),
                            //       color: Colors.white,
                            //       border: Border.all(
                            //           color: MyColors.primaryColor, width: 2)),
                            //   padding: EdgeInsets.all(2),
                            //   child: CustomCircleAvatar(
                            //     imageUrl: 'assets/chat_person.png',
                            //   ),
                            // ),
                          ],
                        ),
                        vSizedBox2,
                        GestureDetector(
                          onTap: (){
                            showCustomDialog(FeedBackDialog());
                          },
                          child: ParagraphText(
                            'Your Gallery',
                            fontSize: 16,
                            fontFamily: 'bold',
                            color: MyColors.primaryColor,
                          ),
                        ),
                        vSizedBox,
                        Wrap(
                          children: [
                            for (int i = 0;
                            i < userData!.galleryImages.length;
                            i++)
                              GestureDetector(
                                onTap: () {
                                  print(userData!.galleryImages);
                                  List<ImageModal> media = [];
                                  (userData!.galleryImages as List)
                                      .forEach((element) {
                                    media.add(ImageModal.fromJson(element));
                                  });
                                  push(
                                      context: context,
                                      screen: PhotosPage(
                                          images: media, selectedIndex: i));
                                },
                                child: Container(
                                  clipBehavior: Clip.hardEdge,
                                  padding: EdgeInsets.all(4.0),
                                  // width: double.infinity,
                                  height:
                                  (MediaQuery.of(context).size.width / 3 -
                                      20),
                                  // height:200,
                                  decoration: BoxDecoration(
                                    // color: Colors.grey,
                                      borderRadius: BorderRadius.circular(24)),
                                  child: Image.network(
                                    userData!.galleryImages[i]['images'],
                                    fit: BoxFit.cover,
                                    height: 200,
                                    width: 100,
                                  ),
                                ),
                              ),
                          ],
                        ),
                        vSizedBox4,
                        if (userData!.gender == UserGender.male)
                          Container(
                            padding: EdgeInsets.only(
                                left: 16, top: 5, bottom: 5, right: 5),
                            decoration: BoxDecoration(
                                border: Border.all(
                                    color: MyColors.primaryColor, width: 3),
                                borderRadius: BorderRadius.circular(30)),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Row(
                                  children: [
                                    Image.asset(
                                      'assets/coin.png',
                                      height: 20,
                                      width: 20,
                                    ),
                                    hSizedBox,
                                    ParagraphText(
                                      '${userData!.coins}',
                                      color: Colors.white,
                                    )
                                  ],
                                ),
                                RoundEdgedButton(
                                  text: 'Get Coins',
                                  width: 95,
                                  fontSize: 12,
                                  shadow: 0,
                                  verticalMargin: 0,
                                  verticalPadding: 0,
                                  horizontalMargin: 0,
                                  onTap: () {
                                    push(
                                        context: context,
                                        screen: Get_Coins_Page())
                                        .then((value) => {get_info()});
                                  },
                                )
                              ],
                            ),
                          )
                        else
                          Container(
                            padding: EdgeInsets.only(
                                left: 16, top: 5, bottom: 5, right: 5),
                            decoration: BoxDecoration(
                                border: Border.all(
                                    color: MyColors.primaryColor, width: 3),
                                borderRadius: BorderRadius.circular(30)),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Row(
                                  children: [
                                    Image.asset(
                                      MyImages.diamond,
                                      height: 20,
                                      width: 20,
                                    ),
                                    hSizedBox,
                                    ParagraphText(
                                      userData!.diamonds.toString(),
                                      color: Colors.white,
                                    )
                                  ],
                                ),
                                GestureDetector(
                                  onTap: () {
                                    showModalBottomSheet<void>(
                                      backgroundColor: Colors.transparent,
                                      context: context,
                                      builder: (BuildContext context) {
                                        return StatefulBuilder(
                                            builder: (context, setState) {

                                              return Container(
                                                height: (maxCapacityInUsd>=minimumWithdrawableAmountInUsd?500:350)+MediaQuery.of(context).viewInsets.bottom,

                                                child: Scaffold(
                                                  backgroundColor: Colors.transparent,
                                                  body: Container(
                                                    decoration: BoxDecoration(
                                                        image: DecorationImage(
                                                          image: AssetImage(
                                                              "assets/popup_back.png"),
                                                          fit: BoxFit.cover,
                                                        ),
                                                        borderRadius:
                                                        BorderRadius.only(
                                                          topLeft: Radius.circular(30),
                                                          topRight: Radius.circular(30),
                                                        )),
                                                    child: Stack(
                                                      children: [
                                                        Column(
                                                          crossAxisAlignment:
                                                          CrossAxisAlignment.center,
                                                          children: [
                                                            vSizedBox,
                                                            Column(
                                                              crossAxisAlignment:
                                                              CrossAxisAlignment.center,
                                                              children: [
                                                                Container(
                                                                  height: 3,
                                                                  width: 35,
                                                                  decoration: BoxDecoration(
                                                                      color:
                                                                      Color(0xFFe2e2e2),
                                                                      borderRadius:
                                                                      BorderRadius
                                                                          .circular(2)),
                                                                ),
                                                              ],
                                                            ),
                                                            Expanded(
                                                              child: Column(
                                                                mainAxisAlignment: MainAxisAlignment.center,
                                                                  children: [
                                                                    ParagraphText(
                                                                      maxCapacityInUsd>=minimumWithdrawableAmountInUsd?'Great Job!':'Oops!!!',
                                                                      fontSize: 35,
                                                                      fontFamily: 'bold',
                                                                      color: maxCapacityInUsd>=minimumWithdrawableAmountInUsd?Colors.white:Colors.red,
                                                                    ),
                                                                    vSizedBox,
                                                                    // if(maxCapacityInUsd>minimumWithdrawableAmountInUsd)
                                                                    //   Row(
                                                                    //     mainAxisAlignment:
                                                                    //     MainAxisAlignment.center,
                                                                    //     children: [
                                                                    //       ParagraphText(
                                                                    //         'You can withdraw max \$${maxCapacityInUsd.ceil()} to your account',
                                                                    //         fontSize: 18,
                                                                    //         fontFamily: 'regular',
                                                                    //         color: Colors.white,
                                                                    //       ),
                                                                    //     ],
                                                                    //   )
                                                                    // else
                                                                    //   Row(
                                                                    //     mainAxisAlignment:
                                                                    //     MainAxisAlignment.center,
                                                                    //     children: [
                                                                    //       ParagraphText(
                                                                    //         'You need to earn',
                                                                    //         fontSize: 18,
                                                                    //         fontFamily: 'regular',
                                                                    //         color: Colors.white,
                                                                    //       ),
                                                                    //       hSizedBox05,
                                                                    //       Image.asset(
                                                                    //         'assets/diamond.png',
                                                                    //         height: 20,
                                                                    //       ),
                                                                    //       hSizedBox05,
                                                                    //       ParagraphText(
                                                                    //         '${((minimumWithdrawableAmountInUsd-maxCapacityInUsd)*usdToDiamondConversionRate).ceil()}',
                                                                    //         fontSize: 18,
                                                                    //         fontFamily: 'regular',
                                                                    //         color: Colors.white,
                                                                    //       ),
                                                                    //
                                                                    //
                                                                    //     ],
                                                                    //   ),
                                                                    // ParagraphText(
                                                                    //   'to get \$$minimumWithdrawableAmountInUsd',
                                                                    //   fontSize: 18,
                                                                    //   fontFamily: 'regular',
                                                                    //   color: Colors.white,
                                                                    // ),
                                                                    // vSizedBox,
                                                                    Row(
                                                                      mainAxisAlignment: MainAxisAlignment.center,
                                                                      crossAxisAlignment: CrossAxisAlignment.end,
                                                                      children: [
                                                                        ParagraphText(
                                                                          'You have ${userData!.diamonds} ',
                                                                          fontSize: 22,
                                                                          fontFamily: 'regular',
                                                                          color: Colors.white,
                                                                        ),
                                                                        hSizedBox05,
                                                                        Image.asset(MyImages.diamond, height: 28,),
                                                                      ],
                                                                    ),
                                                                    vSizedBox,
                                                                    // if(maxCapacityInUsd>=minimumWithdrawableAmountInUsd)
                                                                      Column(
                                                                        children: [
                                                                          ParagraphText(
                                                                            '\$${_currentSliderValue.ceil().toString()} for ${((usdToDiamondConversionRate)* (_currentSliderValue.ceil())).toStringAsFixed(0)} diamonds',
                                                                            fontSize: 28,
                                                                            fontFamily: 'bold',
                                                                            color: Colors.white,
                                                                          ),
                                                                          vSizedBox2,
                                                                          Slider(
                                                                            value: _currentSliderValue,
                                                                            min: 10,
                                                                            max: 1000,
                                                                            // divisions: 20,
                                                                            inactiveColor: Colors.white
                                                                                .withOpacity(0.40),
                                                                            activeColor:
                                                                            MyColors.primaryColor,
                                                                            label: _currentSliderValue
                                                                                .round()
                                                                                .toString(),
                                                                            onChangeEnd: (double value){

                                                                              print(' the valllusss are  ${userData!.diamonds} ${minimumWithdrawableAmountInUsd} ${usdToDiamondConversionRate}');
                                                                              print('qq ${maxCapacityInUsd}');
                                                                            },
                                                                            onChanged: (double value) {

                                                                              if(_currentSliderValue>maxCapacityInUsd){
                                                                              }else{

                                                                              }
                                                                              setState(() {
                                                                                _currentSliderValue = value;
                                                                                print('object123------------${_currentSliderValue}');
                                                                              });

                                                                            },
                                                                          ),
                                                                          vSizedBox2,
                                                                          Padding(
                                                                            padding:
                                                                            const EdgeInsets.symmetric(
                                                                                horizontal: 16.0),
                                                                            child: RoundEdgedButton(
                                                                              text:
                                                                              'Withdraw Amount',
                                                                              onTap: ()async{
                                                                                print('hello workd');
                                                                                print('maxCapacityInUsd-----${maxCapacityInUsd}');
                                                                                print('minimumWithdrawableAmountInUsd-----${((userData!.diamonds/usdToDiamondConversionRate))}');
                                                                                print('_currentSliderValue-----${_currentSliderValue.ceil().toString()}');


                                                                                if(minimumWithdrawableAmountInUsd<=((userData!.diamonds/usdToDiamondConversionRate))){
                                                                            showModalBottomSheet<void>(
                                                                              backgroundColor: Colors.transparent,
                                                                              context: context,
                                                                              builder: (BuildContext context) {
                                                                                return StatefulBuilder(builder: (BuildContext context, StateSetter setState) {
                                                                                  return Container(
                                                                                    padding: EdgeInsets.all(16),
                                                                                    height: 360,
                                                                                    decoration: BoxDecoration(
                                                                                        color: Colors.white,
                                                                                        borderRadius: BorderRadius.only(
                                                                                          topLeft: Radius.circular(25),
                                                                                          topRight: Radius.circular(25),
                                                                                        )),
                                                                                    child: Center(
                                                                                      child: Column(
                                                                                        mainAxisAlignment: MainAxisAlignment.start,
                                                                                        mainAxisSize: MainAxisSize.min,
                                                                                        children: <Widget>[
                                                                                          GestureDetector(
                                                                                            onTap: () async {
                                                                                              Navigator.pop(context);
                                                                                              bool load = false;
                                                                                              bool? result = await showCustomConfirmationDialog(

                                                                                              );
                                                                                              print('The result is $result');
                                                                                              if(result==true){
                                                                                                print('Iam hereee');
                                                                                                await showModalBottomSheet<void>(
                                                                                                  backgroundColor: Colors.transparent,
                                                                                                  isScrollControlled: true,
                                                                                                  context: MyGlobalKeys.navigatorKey.currentContext!,
                                                                                                  builder: (BuildContext context) {
                                                                                                    return Padding(
                                                                                                      padding: EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
                                                                                                      child: StatefulBuilder(builder: (context, setState) {
                                                                                                        return Container(
                                                                                                          height: 270,
                                                                                                          color: Colors.transparent,
                                                                                                          child: SingleChildScrollView(
                                                                                                            child: load
                                                                                                                ? CustomLoader()
                                                                                                                : Container(
                                                                                                                    color: Colors.transparent,
                                                                                                                    child: Container(
                                                                                                                      height: MediaQuery.of(context).size.height,
                                                                                                                      decoration: BoxDecoration(
                                                                                                                          color: MyColors.whitelight,
                                                                                                                          borderRadius: BorderRadius.only(
                                                                                                                            topLeft: Radius.circular(26),
                                                                                                                            topRight: Radius.circular(26),
                                                                                                                          )),
                                                                                                                      child: Padding(
                                                                                                                        padding: EdgeInsets.all(16),
                                                                                                                        child: Column(
                                                                                                                          mainAxisAlignment: MainAxisAlignment.start,
                                                                                                                          mainAxisSize: MainAxisSize.min,
                                                                                                                          children: <Widget>[
                                                                                                                            vSizedBox2,
                                                                                                                            Text(
                                                                                                                              'Enter your Email!',
                                                                                                                              style: TextStyle(color: MyColors.primaryColor, fontFamily: 'bold', fontSize: 20),
                                                                                                                            ),
                                                                                                                            vSizedBox2,
                                                                                                                            CustomTextField(
                                                                                                                              border: Border.all(color: MyColors.greyColor, width: 1),
                                                                                                                              hintcolor: MyColors.blackColor,
                                                                                                                              controller: email,
                                                                                                                              hintText: 'Enter your Email',
                                                                                                                              verticalPadding: 8,
                                                                                                                            ),
                                                                                                                            vSizedBox4,
                                                                                                                            RoundEdgedButton(
                                                                                                                              text: 'Submit',
                                                                                                                              onTap: () async {
                                                                                                                                String pattern = r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
                                                                                                                                RegExp regex = new RegExp(pattern);
                                                                                                                                if (email.text == '') {
                                                                                                                                  showSnackbar('Please enter your email');
                                                                                                                                } else if (!regex.hasMatch(email.text)) {
                                                                                                                                  showSnackbar('Please Enter your valid email.');
                                                                                                                                }
                                                                                                                                // else if(_currentSliderValue<=res['min_withdrawal_amount'] && _currentSliderValue>=res['min_withdrawal_amount']){
                                                                                                                                //   print('object----858');
                                                                                                                                //   showSnackbar('Amount should be max ${res['max_withdrawal_amount']} and minimum ${res['min_withdrawal_amount']}');
                                                                                                                                //
                                                                                                                                // }
                                                                                                                                else {
                                                                                                                                  Map<String, dynamic> request = {
                                                                                                                                    'paypal_emailid': email.text,
                                                                                                                                    'user_id': userData!.id,
                                                                                                                                    'redeem_type': '3',
                                                                                                                                    // 'amount': _currentSliderValue.ceil().toString(),
                                                                                                                                    // 'diamond': (double.parse(_currentSliderValue.toString()) * double.parse(adminSetting['diamond_to_usd'])).toString()
                                                                                                                                  };

                                                                                                                                  setState(() {
                                                                                                                                    load = true;
                                                                                                                                  });
                                                                                                                                  var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.withdrawalRequest, request: request, showSuccessMessage: true);
                                                                                                                                  setState(() {
                                                                                                                                    load = false;
                                                                                                                                  });
                                                                                                                                  log("jsonResponse" + jsonResponse.toString());
                                                                                                                                  if (jsonResponse['status'] == 1) {
                                                                                                                                    Navigator.pop(context);
                                                                                                                                  } else {
                                                                                                                                    Navigator.pop(context);
                                                                                                                                    showSnackbar(jsonResponse['message']);
                                                                                                                                    // setState(() {
                                                                                                                                    //   load = false;
                                                                                                                                    // });
                                                                                                                                  }
                                                                                                                                }
                                                                                                                              },
                                                                                                                              // Navigator.pop(context),
                                                                                                                            ),
                                                                                                                          ],
                                                                                                                        ),
                                                                                                                      ),
                                                                                                                    ),
                                                                                                                  ),
                                                                                                          ),
                                                                                                        );
                                                                                                      }),
                                                                                                    );
                                                                                                  },
                                                                                                );
                                                                                              }

                                                                                            },
                                                                                            child: Container(
                                                                                                width: MediaQuery.of(context).size.width,
                                                                                                height: 60,
                                                                                                padding: EdgeInsets.all(10),
                                                                                                decoration: BoxDecoration(color: MyColors.whiteColor, border: Border.all(color: MyColors.greyColor, width: 1), borderRadius: BorderRadius.circular(10)),
                                                                                                child: Row(
                                                                                                  children: [
                                                                                                    Icon(Icons.paypal, color: MyColors.secondary),
                                                                                                    hSizedBox,
                                                                                                    Text(
                                                                                                      'Paypal',
                                                                                                      style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),
                                                                                                    ),
                                                                                                  ],
                                                                                                )),
                                                                                          ),
                                                                                          GestureDetector(
                                                                                            onTap: () async {
                                                                                              Navigator.pop(context);
                                                                                              await showModalBottomSheet(
                                                                                                  context: MyGlobalKeys.navigatorKey.currentContext!,
                                                                                                  isScrollControlled: true,
                                                                                                  backgroundColor: Colors.transparent,
                                                                                                  builder: (context) {
                                                                                                    return WithdrawMoneyDialog(
                                                                                                      bankAccountDetails: userData!.bankDetails,
                                                                                                      withdrawableAmount: _currentSliderValue.ceil(),
                                                                                                    );
                                                                                                  });
                                                                                            },
                                                                                            child: Padding(
                                                                                              padding: EdgeInsets.symmetric(vertical: 18.0),
                                                                                              child: Container(
                                                                                                  width: MediaQuery.of(context).size.width,
                                                                                                  height: 60,
                                                                                                  padding: EdgeInsets.all(10),
                                                                                                  decoration: BoxDecoration(color: MyColors.whiteColor, border: Border.all(color: MyColors.greyColor, width: 1), borderRadius: BorderRadius.circular(10)),
                                                                                                  child: Row(
                                                                                                    children: [
                                                                                                      Icon(Icons.account_balance, color: MyColors.secondary),
                                                                                                      hSizedBox,
                                                                                                      Text(
                                                                                                        'Bank',
                                                                                                        style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),
                                                                                                      ),
                                                                                                    ],
                                                                                                  )),
                                                                                            ),
                                                                                          ),
                                                                                          GestureDetector(
                                                                                            onTap: () async {
                                                                                              // bool load1 = false;
                                                                                              // await showModalBottomSheet<void>(
                                                                                              //   backgroundColor: Colors.transparent,
                                                                                              //   context: context,
                                                                                              //   isScrollControlled: true,
                                                                                              //   builder: (BuildContext context) {
                                                                                              //     return Padding(
                                                                                              //       padding: EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
                                                                                              //       child: StatefulBuilder(builder: (context, setState) {
                                                                                              //         return SingleChildScrollView(
                                                                                              //           // backgroundColor: Colors.transparent,
                                                                                              //           child: load1
                                                                                              //               ? CustomLoader()
                                                                                              //               : Container(
                                                                                              //                   height: 415 + MediaQuery.of(context).viewInsets.bottom,
                                                                                              //                   decoration: BoxDecoration(
                                                                                              //                       color: MyColors.whitelight,
                                                                                              //                       borderRadius: BorderRadius.only(
                                                                                              //                         topLeft: Radius.circular(26),
                                                                                              //                         topRight: Radius.circular(26),
                                                                                              //                       )),
                                                                                              //                   child: Scaffold(
                                                                                              //                     backgroundColor: Colors.transparent,
                                                                                              //                     body: Padding(
                                                                                              //                       padding: EdgeInsets.all(16),
                                                                                              //                       child: Column(
                                                                                              //                         mainAxisAlignment: MainAxisAlignment.start,
                                                                                              //                         mainAxisSize: MainAxisSize.min,
                                                                                              //                         children: <Widget>[
                                                                                              //                           vSizedBox2,
                                                                                              //                           Text(
                                                                                              //                             'Enter your Detail!',
                                                                                              //                             style: TextStyle(color: MyColors.primaryColor, fontSize: 20, fontFamily: 'bold'),
                                                                                              //                           ),
                                                                                              //                           vSizedBox2,
                                                                                              //                           CustomTextField(
                                                                                              //                             hintcolor: Colors.black,
                                                                                              //                             controller: name,
                                                                                              //                             hintText: 'Enter your Name',
                                                                                              //                             verticalPadding: 8,
                                                                                              //                           ),
                                                                                              //                           vSizedBox,
                                                                                              //                           CustomTextField(
                                                                                              //                             hintcolor: Colors.black,
                                                                                              //                             keyboardType: TextInputType.number,
                                                                                              //                             controller: phone,
                                                                                              //                             hintText: 'Enter your phone number',
                                                                                              //                             verticalPadding: 8,
                                                                                              //                           ),
                                                                                              //                           vSizedBox,
                                                                                              //                           CustomTextField(
                                                                                              //                             hintcolor: Colors.black,
                                                                                              //                             controller: country,
                                                                                              //                             hintText: 'Enter your country',
                                                                                              //                             verticalPadding: 8,
                                                                                              //                           ),
                                                                                              //                           vSizedBox4,
                                                                                              //                           RoundEdgedButton(
                                                                                              //                             text: 'Submit',
                                                                                              //                             onTap: () async {
                                                                                              //                               print('hello 1');
                                                                                              //                               String phonePattern = r'^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$';
                                                                                              //                               RegExp pnumber = new RegExp(phonePattern);
                                                                                              //                               if (name.text == '') {
                                                                                              //                                 print('Please enter your name');
                                                                                              //                                 showSnackbar('Please enter your name');
                                                                                              //                               } else if (phone.text == '') {
                                                                                              //                                 print('Please enter your phone number');
                                                                                              //                                 showSnackbar('Please enter your phone number');
                                                                                              //                               } else if (phone.text.length < 9) {
                                                                                              //                                 print('Please Enter your valid phone Number.');
                                                                                              //                                 showSnackbar('Please Enter your valid phone Number.');
                                                                                              //                               } else if (country.text == '') {
                                                                                              //                                 print('hello 1');
                                                                                              //                                 showSnackbar('Please enter your country');
                                                                                              //                               } else {
                                                                                              //                                 double diamond = (double.parse(_currentSliderValue.ceil().toString()) * double.parse(adminSetting['diamond_to_usd']));
                                                                                              //                                 print("diamonddiamond-----------${diamond.ceil().toString()}");
                                                                                              //                                 Map<String, dynamic> request = {
                                                                                              //                                   'username': name.text,
                                                                                              //                                   'phone': phone.text,
                                                                                              //                                   'country': country.text,
                                                                                              //                                   'user_id': userData!.id,
                                                                                              //                                   'redeem_type': '2',
                                                                                              //                                   'amount': _currentSliderValue.ceil().toString(),
                                                                                              //                                   'diamond': diamond.toString()
                                                                                              //                                 };
                                                                                              //                                 setState(() {
                                                                                              //                                   load1 = true;
                                                                                              //                                 });
                                                                                              //                                 print("data for api -----------" + request.toString());
                                                                                              //                                 var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.withdrawalRequest, request: request, showSuccessMessage: true);
                                                                                              //
                                                                                              //                                 setState(() {
                                                                                              //                                   load1 = false;
                                                                                              //                                 });
                                                                                              //                                 log("jsonResponse" + jsonResponse.toString());
                                                                                              //                                 if (jsonResponse['status'] == 1) {
                                                                                              //                                   Navigator.pop(context);
                                                                                              //                                 } else {
                                                                                              //                                   Navigator.pop(context);
                                                                                              //                                   showSnackbar(jsonResponse['message']);
                                                                                              //                                   // setState(() {
                                                                                              //                                   //   load = false;
                                                                                              //                                   // });
                                                                                              //                                 }
                                                                                              //                               }
                                                                                              //                             },
                                                                                              //                             // Navigator.pop(context),
                                                                                              //                           ),
                                                                                              //                         ],
                                                                                              //                       ),
                                                                                              //                     ),
                                                                                              //                   ),
                                                                                              //                 ),
                                                                                              //         );
                                                                                              //       }),
                                                                                              //     );
                                                                                              //   },
                                                                                              // );
                                                                                              Navigator.pop(context);


                                                                                              bool? result = await showCustomConfirmationDialog();
                                                                                              print('the result is $result');
                                                                                              if(result ==true){
                                                                                                Map<String, dynamic> request = {
                                                                                                  'user_id': userData!.id,
                                                                                                  'redeem_type': '2',
                                                                                                };
                                                                                                this.setState(() {
                                                                                                  // load1 = true;
                                                                                                });
                                                                                                print("data for api -----------" + request.toString());
                                                                                                var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.withdrawalRequest, request: request, showSuccessMessage: true);

                                                                                                this.setState(() {
                                                                                                  // load1 = false;
                                                                                                });
                                                                                                log("jsonResponse" + jsonResponse.toString());
                                                                                                if (jsonResponse['status'] == 1) {
                                                                                                  Navigator.pop(context);
                                                                                                } else {
                                                                                                  Navigator.pop(context);
                                                                                                  showSnackbar(jsonResponse['message']);
                                                                                                  // setState(() {
                                                                                                  //   load = false;
                                                                                                  // });
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            child: Container(
                                                                                                width: MediaQuery.of(context).size.width,
                                                                                                height: 60,
                                                                                                padding: EdgeInsets.all(10),
                                                                                                decoration: BoxDecoration(color: MyColors.whiteColor, border: Border.all(color: MyColors.greyColor, width: 1), borderRadius: BorderRadius.circular(10)),
                                                                                                child: Row(
                                                                                                  children: [
                                                                                                    Icon(Icons.diamond, color: MyColors.secondary),
                                                                                                    hSizedBox,
                                                                                                    Text(
                                                                                                      'Manual',
                                                                                                      style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),
                                                                                                    ),
                                                                                                  ],
                                                                                                )),
                                                                                          ),
                                                                                          vSizedBox4,
                                                                                          RoundEdgedButton(
                                                                                            text: 'Close',
                                                                                            onTap: () => Navigator.pop(context),
                                                                                          )
                                                                                        ],
                                                                                      ),
                                                                                    ),
                                                                                  );
                                                                                });
                                                                              },
                                                                            );
                                                                          }
                                                                                else{
                                                                                  showSnackbar('You don\'t have enough diamonds to withdraw');
                                                                                }

                                                                          // if(maxCapacityInUsd>=minimumWithdrawableAmountInUsd  && maxCapacityInUsd>=_currentSliderValue.ceil()) {
                                                                                //   if(_currentSliderValue>=double.parse(adminSetting['min_withdrawal_amount']) && _currentSliderValue<=double.parse(adminSetting['max_withdrawal_amount'])){
                                                                                //     showModalBottomSheet<
                                                                                //         void>(
                                                                                //       backgroundColor: Colors.transparent,
                                                                                //       context: context,
                                                                                //       builder: (
                                                                                //           BuildContext context) {
                                                                                //         return StatefulBuilder(
                                                                                //             builder: (
                                                                                //                 BuildContext context,
                                                                                //                 StateSetter setState) {
                                                                                //               return Container(
                                                                                //                 padding: EdgeInsets.all(16),
                                                                                //                 height: 360,
                                                                                //                 decoration: BoxDecoration(
                                                                                //                     color: Colors.white,
                                                                                //                     borderRadius: BorderRadius.only(
                                                                                //                       topLeft: Radius.circular(25),
                                                                                //                       topRight: Radius.circular(25),
                                                                                //                     )
                                                                                //                 ),
                                                                                //                 child: Center(
                                                                                //                   child: Column(
                                                                                //                     mainAxisAlignment: MainAxisAlignment.start,
                                                                                //                     mainAxisSize: MainAxisSize.min,
                                                                                //                     children: <Widget>[
                                                                                //                       GestureDetector(
                                                                                //                         onTap: () async {
                                                                                //                           Navigator.pop(context);
                                                                                //                           bool load = false;
                                                                                //                           await showModalBottomSheet<void>(
                                                                                //                             backgroundColor: Colors.transparent,
                                                                                //                             isScrollControlled: true,
                                                                                //                             context: context,
                                                                                //                             builder: (
                                                                                //                                 BuildContext context) {
                                                                                //                               return Padding(
                                                                                //                                 padding:  EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
                                                                                //                                 child: StatefulBuilder(
                                                                                //                                     builder: (context, setState){
                                                                                //                                       return Container(
                                                                                //                                         height: 270,
                                                                                //                                         color: Colors.transparent,
                                                                                //                                         child: SingleChildScrollView(
                                                                                //                                           child:load?CustomLoader():Container(
                                                                                //                                             color: Colors.transparent,
                                                                                //                                             child: Container(
                                                                                //                                               height: MediaQuery.of(context).size.height,
                                                                                //                                               decoration: BoxDecoration(
                                                                                //                                                   color: MyColors.whitelight,
                                                                                //                                                   borderRadius: BorderRadius.only(
                                                                                //                                                     topLeft: Radius.circular(26),
                                                                                //                                                     topRight: Radius.circular(26),
                                                                                //                                                   )
                                                                                //                                               ),
                                                                                //                                               child: Padding(
                                                                                //                                                 padding: EdgeInsets.all(16),
                                                                                //                                                 child: Column(
                                                                                //                                                   mainAxisAlignment: MainAxisAlignment.start,
                                                                                //                                                   mainAxisSize: MainAxisSize.min,
                                                                                //                                                   children: <Widget>[
                                                                                //                                                     vSizedBox2,
                                                                                //                                                     Text(
                                                                                //                                                       'Enter your Email!',
                                                                                //                                                       style: TextStyle(color: MyColors.primaryColor, fontFamily: 'bold', fontSize: 20),),
                                                                                //                                                     vSizedBox2,
                                                                                //                                                     CustomTextField(
                                                                                //                                                       border: Border.all(color: MyColors.greyColor, width: 1),
                                                                                //                                                       hintcolor: MyColors.blackColor,
                                                                                //                                                       controller: email,
                                                                                //                                                       hintText: 'Enter your Email',
                                                                                //                                                       verticalPadding: 8,
                                                                                //                                                     ),
                                                                                //                                                     vSizedBox4,
                                                                                //                                                     RoundEdgedButton(
                                                                                //                                                       text: 'Submit',
                                                                                //                                                       onTap: () async {
                                                                                //                                                         String pattern =
                                                                                //                                                             r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
                                                                                //                                                         RegExp regex = new RegExp(pattern);
                                                                                //                                                         if (email
                                                                                //                                                             .text ==
                                                                                //                                                             '') {
                                                                                //                                                           showSnackbar(
                                                                                //                                                               'Please enter your email');
                                                                                //                                                         }else if (!regex.hasMatch(email.text)) {
                                                                                //                                                           showSnackbar(
                                                                                //                                                               'Please Enter your valid email.');
                                                                                //                                                         }
                                                                                //                                                         // else if(_currentSliderValue<=res['min_withdrawal_amount'] && _currentSliderValue>=res['min_withdrawal_amount']){
                                                                                //                                                         //   print('object----858');
                                                                                //                                                         //   showSnackbar('Amount should be max ${res['max_withdrawal_amount']} and minimum ${res['min_withdrawal_amount']}');
                                                                                //                                                         //
                                                                                //                                                         // }
                                                                                //                                                         else {
                                                                                //
                                                                                //                                                           Map<
                                                                                //                                                               String,
                                                                                //                                                               dynamic>request = {
                                                                                //                                                             'paypal_emailid': email
                                                                                //                                                                 .text,
                                                                                //                                                             'user_id': userData!
                                                                                //                                                                 .id,
                                                                                //                                                             'redeem_type': '3',
                                                                                //                                                             'amount': _currentSliderValue
                                                                                //                                                                 .ceil()
                                                                                //                                                                 .toString(),
                                                                                //                                                             'diamond': (double
                                                                                //                                                                 .parse(
                                                                                //                                                                 _currentSliderValue
                                                                                //                                                                     .toString()) *
                                                                                //                                                                 double
                                                                                //                                                                     .parse(
                                                                                //                                                                     adminSetting['diamond_to_usd']))
                                                                                //                                                                 .toString()
                                                                                //                                                           };
                                                                                //
                                                                                //                                                           setState((){
                                                                                //                                                             load =true;
                                                                                //                                                           });
                                                                                //                                                           var jsonResponse = await Webservices
                                                                                //                                                               .postData(
                                                                                //                                                               apiUrl: ApiUrls
                                                                                //                                                                   .withdrawalRequest,
                                                                                //                                                               request: request,
                                                                                //                                                               showSuccessMessage: true);
                                                                                //                                                           setState((){
                                                                                //                                                             load =false;
                                                                                //                                                           });
                                                                                //                                                           log(
                                                                                //                                                               "jsonResponse" +
                                                                                //                                                                   jsonResponse
                                                                                //                                                                       .toString());
                                                                                //                                                           if (jsonResponse['status'] ==
                                                                                //                                                               1) {
                                                                                //                                                             Navigator
                                                                                //                                                                 .pop(
                                                                                //                                                                 context);
                                                                                //                                                           } else {
                                                                                //                                                             Navigator
                                                                                //                                                                 .pop(
                                                                                //                                                                 context);
                                                                                //                                                             showSnackbar(
                                                                                //                                                                 jsonResponse['message']);
                                                                                //                                                             // setState(() {
                                                                                //                                                             //   load = false;
                                                                                //                                                             // });
                                                                                //                                                           }
                                                                                //                                                         }
                                                                                //                                                       },
                                                                                //                                                       // Navigator.pop(context),
                                                                                //                                                     ),
                                                                                //                                                   ],
                                                                                //                                                 ),
                                                                                //                                               ),
                                                                                //                                             ),
                                                                                //                                           ),
                                                                                //                                         ),
                                                                                //                                       );
                                                                                //                                     }
                                                                                //                                 ),
                                                                                //                               );
                                                                                //                             },
                                                                                //                           );
                                                                                //                         },
                                                                                //                         child: Container(
                                                                                //                             width: MediaQuery.of(context).size.width,
                                                                                //                             height: 60,
                                                                                //                             padding: EdgeInsets.all(10),
                                                                                //                             decoration: BoxDecoration(
                                                                                //                                 color: MyColors.whiteColor,
                                                                                //                                 border: Border.all(
                                                                                //                                     color: MyColors.greyColor,
                                                                                //                                     width: 1
                                                                                //                                 ),
                                                                                //                                 borderRadius: BorderRadius.circular(10)
                                                                                //                             ),
                                                                                //                             child: Row(
                                                                                //                               children: [
                                                                                //                                 Icon(Icons.paypal, color: MyColors.secondary),
                                                                                //                                 hSizedBox,
                                                                                //                                 Text('Paypal', style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),),
                                                                                //                               ],
                                                                                //                             )
                                                                                //                         ),
                                                                                //                       ),
                                                                                //                       GestureDetector(
                                                                                //                         onTap: () async {
                                                                                //                           Navigator.pop(context);
                                                                                //                           await showModalBottomSheet(
                                                                                //                               context: MyGlobalKeys
                                                                                //                                   .navigatorKey
                                                                                //                                   .currentContext!,
                                                                                //                               isScrollControlled: true,
                                                                                //                               backgroundColor: Colors.transparent,
                                                                                //                               builder: (
                                                                                //                                   context) {
                                                                                //                                 return WithdrawMoneyDialog(
                                                                                //                                   bankAccountDetails: null,
                                                                                //                                   withdrawableAmount: _currentSliderValue
                                                                                //                                       .ceil(),);
                                                                                //                               });
                                                                                //                         },
                                                                                //                         child: Padding(
                                                                                //                           padding: EdgeInsets.symmetric(vertical: 18.0),
                                                                                //                           child: Container(
                                                                                //                               width: MediaQuery.of(context).size.width,
                                                                                //                               height: 60,
                                                                                //                               padding: EdgeInsets.all(10),
                                                                                //                               decoration: BoxDecoration(
                                                                                //                                   color: MyColors.whiteColor,
                                                                                //                                   border: Border.all(
                                                                                //                                       color: MyColors.greyColor,
                                                                                //                                       width: 1
                                                                                //                                   ),
                                                                                //                                   borderRadius: BorderRadius.circular(10)
                                                                                //                               ),
                                                                                //                               child: Row(
                                                                                //                                 children: [
                                                                                //                                   Icon(Icons.account_balance, color: MyColors.secondary),
                                                                                //                                   hSizedBox,
                                                                                //                                   Text('Bank', style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),),
                                                                                //                                 ],
                                                                                //                               )
                                                                                //                           ),
                                                                                //                         ),
                                                                                //                       ),
                                                                                //                       GestureDetector(
                                                                                //                         onTap: () async {
                                                                                //                           bool load1=false;
                                                                                //                           await showModalBottomSheet<void>(
                                                                                //                             backgroundColor: Colors.transparent,
                                                                                //                             context: context,
                                                                                //                             isScrollControlled: true,
                                                                                //
                                                                                //                             builder: (
                                                                                //                                 BuildContext context) {
                                                                                //                               return Padding(
                                                                                //                                 padding:  EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
                                                                                //                                 child: StatefulBuilder(
                                                                                //                                     builder: (context , setState) {
                                                                                //                                       return SingleChildScrollView(
                                                                                //                                         // backgroundColor: Colors.transparent,
                                                                                //                                         child:load1?CustomLoader():Container(
                                                                                //                                           height: 415 + MediaQuery.of(context).viewInsets.bottom,
                                                                                //                                           decoration: BoxDecoration(
                                                                                //                                               color: MyColors.whitelight,
                                                                                //                                               borderRadius: BorderRadius.only(
                                                                                //                                                 topLeft: Radius.circular(26),
                                                                                //                                                 topRight: Radius.circular(26),
                                                                                //                                               )
                                                                                //                                           ),
                                                                                //                                           child: Scaffold(
                                                                                //                                             backgroundColor: Colors.transparent,
                                                                                //                                             body: Padding(
                                                                                //                                               padding: EdgeInsets.all(16),
                                                                                //                                               child: Column(
                                                                                //                                                 mainAxisAlignment: MainAxisAlignment.start,
                                                                                //                                                 mainAxisSize: MainAxisSize.min,
                                                                                //                                                 children: <Widget>[
                                                                                //                                                   vSizedBox2,
                                                                                //                                                   Text(
                                                                                //                                                     'Enter your Detail!',
                                                                                //                                                     style: TextStyle(color: MyColors.primaryColor, fontSize: 20, fontFamily: 'bold'),),
                                                                                //                                                   vSizedBox2,
                                                                                //                                                   CustomTextField(
                                                                                //                                                     hintcolor: Colors.black,
                                                                                //                                                     controller: name,
                                                                                //                                                     hintText: 'Enter your Name',
                                                                                //                                                     verticalPadding: 8,
                                                                                //                                                   ),
                                                                                //                                                   vSizedBox,
                                                                                //                                                   CustomTextField(
                                                                                //                                                     hintcolor: Colors
                                                                                //                                                         .black,
                                                                                //                                                     keyboardType: TextInputType
                                                                                //                                                         .number,
                                                                                //                                                     controller: phone,
                                                                                //                                                     hintText: 'Enter your phone number',
                                                                                //                                                     verticalPadding: 8,
                                                                                //                                                   ),
                                                                                //                                                   vSizedBox,
                                                                                //                                                   CustomTextField(
                                                                                //                                                     hintcolor: Colors
                                                                                //                                                         .black,
                                                                                //                                                     controller: country,
                                                                                //                                                     hintText: 'Enter your country',
                                                                                //                                                     verticalPadding: 8,
                                                                                //                                                   ),
                                                                                //                                                   vSizedBox4,
                                                                                //                                                   RoundEdgedButton(
                                                                                //                                                     text: 'Submit',
                                                                                //                                                     onTap: () async {
                                                                                //                                                       print('hello 1');
                                                                                //                                                       String phonePattern =
                                                                                //                                                           r'^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$';
                                                                                //                                                       RegExp pnumber = new RegExp(phonePattern);
                                                                                //                                                       if (name
                                                                                //                                                           .text ==
                                                                                //                                                           '') {
                                                                                //                                                         print('Please enter your name');
                                                                                //                                                         showSnackbar(
                                                                                //                                                             'Please enter your name');
                                                                                //                                                       } else
                                                                                //                                                       if (phone.text == '') {
                                                                                //                                                         print('Please enter your phone number');
                                                                                //                                                         showSnackbar('Please enter your phone number');
                                                                                //                                                       }else if (phone.text.length<9) {
                                                                                //                                                         print('Please Enter your valid phone Number.');
                                                                                //                                                         showSnackbar('Please Enter your valid phone Number.');
                                                                                //                                                       }
                                                                                //                                                       else
                                                                                //                                                       if (country
                                                                                //                                                           .text ==
                                                                                //                                                           '') {
                                                                                //                                                         print('hello 1');
                                                                                //                                                         showSnackbar(
                                                                                //                                                             'Please enter your country');
                                                                                //                                                       }
                                                                                //                                                       else {
                                                                                //                                                         double diamond =(double.parse(_currentSliderValue.ceil().toString()) * double.parse(adminSetting['diamond_to_usd']));
                                                                                //                                                         print("diamonddiamond-----------${diamond.ceil().toString()}");
                                                                                //                                                         Map<
                                                                                //                                                             String,
                                                                                //                                                             dynamic>request = {
                                                                                //                                                           'username': name
                                                                                //                                                               .text,
                                                                                //                                                           'phone': phone
                                                                                //                                                               .text,
                                                                                //                                                           'country': country
                                                                                //                                                               .text,
                                                                                //                                                           'user_id': userData!
                                                                                //                                                               .id,
                                                                                //                                                           'redeem_type': '2',
                                                                                //                                                           'amount': _currentSliderValue.ceil().toString(),
                                                                                //                                                           'diamond': diamond.toString()
                                                                                //                                                         };
                                                                                //                                                         setState((){
                                                                                //                                                           load1 =true;
                                                                                //                                                         });
                                                                                //                                                         print("data for api -----------"+request.toString());
                                                                                //                                                         var jsonResponse = await Webservices
                                                                                //                                                             .postData(
                                                                                //                                                             apiUrl: ApiUrls
                                                                                //                                                                 .withdrawalRequest,
                                                                                //                                                             request: request,
                                                                                //                                                             showSuccessMessage: true);
                                                                                //
                                                                                //                                                         setState((){
                                                                                //                                                           load1=false;
                                                                                //                                                         });
                                                                                //                                                         log(
                                                                                //                                                             "jsonResponse" +
                                                                                //                                                                 jsonResponse
                                                                                //                                                                     .toString());
                                                                                //                                                         if (jsonResponse['status'] ==
                                                                                //                                                             1) {
                                                                                //                                                           Navigator
                                                                                //                                                               .pop(
                                                                                //                                                               context);
                                                                                //                                                         } else {
                                                                                //                                                           Navigator
                                                                                //                                                               .pop(
                                                                                //                                                               context);
                                                                                //                                                           showSnackbar(
                                                                                //                                                               jsonResponse['message']);
                                                                                //                                                           // setState(() {
                                                                                //                                                           //   load = false;
                                                                                //                                                           // });
                                                                                //                                                         }
                                                                                //                                                       }
                                                                                //                                                     },
                                                                                //                                                     // Navigator.pop(context),
                                                                                //                                                   ),
                                                                                //                                                 ],
                                                                                //                                               ),
                                                                                //                                             ),
                                                                                //                                           ),
                                                                                //                                         ),
                                                                                //                                       );
                                                                                //                                     }
                                                                                //                                 ),
                                                                                //                               );
                                                                                //                             },
                                                                                //                           );
                                                                                //                           Navigator.pop(context);
                                                                                //                         },
                                                                                //                         child: Container(
                                                                                //                             width: MediaQuery.of(context).size.width,
                                                                                //                             height: 60,
                                                                                //                             padding: EdgeInsets.all(10),
                                                                                //                             decoration: BoxDecoration(
                                                                                //                                 color: MyColors.whiteColor,
                                                                                //                                 border: Border.all(
                                                                                //                                     color: MyColors.greyColor,
                                                                                //                                     width: 1
                                                                                //                                 ),
                                                                                //                                 borderRadius: BorderRadius.circular(10)
                                                                                //                             ),
                                                                                //                             child: Row(
                                                                                //                               children: [
                                                                                //                                 Icon(Icons.diamond, color: MyColors.secondary),
                                                                                //                                 hSizedBox,
                                                                                //                                 Text('Manual', style: TextStyle(fontSize: 18, fontFamily: 'semibold', color: MyColors.primaryColor),),
                                                                                //                               ],
                                                                                //                             )
                                                                                //                         ),
                                                                                //                       ),
                                                                                //                       vSizedBox4,
                                                                                //                       RoundEdgedButton(text: 'Close', onTap: () => Navigator.pop(context),)
                                                                                //                     ],
                                                                                //                   ),
                                                                                //                 ),
                                                                                //               );
                                                                                //             }
                                                                                //         );
                                                                                //       },
                                                                                //     );
                                                                                //   }
                                                                                //   else{
                                                                                //     showSnackbar('The minimum amount for withdrawal is ${adminSetting['min_withdrawal_amount']} , The maximum amount for withdrawal is ${adminSetting['max_withdrawal_amount']}');
                                                                                //   }
                                                                                //   // await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
                                                                                //
                                                                                // }
                                                                                // else{
                                                                                //
                                                                                // }

                                                                              },
                                                                            ),
                                                                          ),
                                                                          vSizedBox4,
                                                                        ],
                                                                      )
                                                                  ],
                                                              ),
                                                            )

                                                          ],
                                                        ),
                                                        // Positioned(
                                                        //   right: 26, bottom: 8,
                                                        //   child: Row(
                                                        //     // crossAxisAlignment: end,
                                                        //     children: [
                                                        //       SubHeadingText('You have: ${userData!.diamonds}', color: Colors.white,),
                                                        //       hSizedBox05,
                                                        //       Image.asset(MyImages.diamond, height: 30,),
                                                        //     ],
                                                        //   ),
                                                        // )
                                                      ],
                                                    ),
                                                  ),
                                                ),
                                              );
                                            }
                                        );
                                      },
                                    );
                                  },
                                  child: Container(
                                    width: 95,
                                    height: 40,
                                    decoration: BoxDecoration(
                                        image: DecorationImage(
                                          image:
                                          AssetImage("assets/btn_back.png"),
                                          fit: BoxFit.cover,
                                        ),
                                        borderRadius:
                                        BorderRadius.circular(30)),
                                    child: Column(
                                      crossAxisAlignment:
                                      CrossAxisAlignment.center,
                                      mainAxisAlignment:
                                      MainAxisAlignment.center,
                                      children: [
                                        ParagraphText(
                                          'Redeem',
                                          color: MyColors.whiteColor,
                                          fontFamily: 'semibold',
                                        )
                                      ],
                                    ),
                                  ),
                                ),

                                // RoundEdgedButton(
                                //   text: 'Get Coins',
                                //   width: 95,
                                //   fontSize: 12,
                                //   shadow: 0,
                                //   verticalMargin: 0,
                                //   verticalPadding: 0,
                                //   horizontalMargin: 0,
                                // )
                              ],
                            ),
                          ),
                        vSizedBox,
                      ],
                    ),
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  if(userData!.gender==UserGender.male)
                    GestureDetector(
                      onTap: () {
                        push(context: context, screen: Rewards());
                      },
                      child: Container(
                        margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                        height: 54,
                        padding: EdgeInsets.symmetric(horizontal: 16),
                        decoration: BoxDecoration(
                            borderRadius: BorderRadius.only(
                                topRight: Radius.circular(20),
                                topLeft: Radius.circular(20)),
                            color: MyColors.primaryColor),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            ParagraphText(
                              'Earn Free Coins',
                              fontSize: 16,
                              fontFamily: 'semibold',
                              color: Colors.white,
                            ),
                            hSizedBox,
                            Icon(
                              Icons.arrow_forward_ios,
                              size: 20,
                              color: MyColors.whiteColor,
                            )
                          ],
                        ),
                      ),
                    ),
                  if(userData!.gender==UserGender.female)
                    GestureDetector(
                      onTap: () {
                        push(context: context, screen: OverviewPage());
                      },
                      child: Container(
                        margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                        height: 54,
                        padding: EdgeInsets.symmetric(horizontal: 16),
                        decoration: BoxDecoration(color: MyColors.primaryColor),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            ParagraphText(
                              'Overview',
                              fontSize: 16,
                              fontFamily: 'semibold',
                              color: Colors.white,
                            ),
                            hSizedBox,
                            Icon(
                              Icons.arrow_forward_ios,
                              size: 20,
                              color: MyColors.whiteColor,
                            )
                          ],
                        ),
                      ),
                    ),
                  GestureDetector(
                    onTap: () async {
                      await push(context: context, screen: ProfilePage())
                          .then((value) => {
                        print('back value$value'),
                        setState(() {
                          userData != value;
                        }),
                      });
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Edit Profile',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  // GestureDetector(
                  //   onTap: () {
                  //     push(context: context, screen: NotificationPage());
                  //   },
                  //   child: Container(
                  //     margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                  //     height: 54,
                  //     padding: EdgeInsets.symmetric(horizontal: 16),
                  //     decoration: BoxDecoration(
                  //         // borderRadius: BorderRadius.circular(20),
                  //         color: MyColors.primaryColor),
                  //     child: Row(
                  //       mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  //       children: [
                  //         ParagraphText(
                  //           'Notifications',
                  //           fontSize: 16,
                  //           fontFamily: 'semibold',
                  //           color: Colors.white,
                  //         ),
                  //         hSizedBox,
                  //         Icon(
                  //           Icons.arrow_forward_ios,
                  //           size: 20,
                  //           color: MyColors.whiteColor,
                  //         )
                  //       ],
                  //     ),
                  //   ),
                  // ),
                  GestureDetector(
                    onTap: () {
                      push(context: context, screen: ChangePassword());
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                        // borderRadius: BorderRadius.circular(20),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Change Password',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  GestureDetector(
                    onTap: () {
                      push(context: context, screen: UserBlockedPage());
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                        // borderRadius: BorderRadius.circular(20),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Blocked User',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  if(userData!.gender==UserGender.female)
                    GestureDetector(
                      onTap: () {
                        push(context: context, screen: WithdrawalPage());
                      },
                      child: Container(
                        margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                        height: 54,
                        padding: EdgeInsets.symmetric(horizontal: 16),
                        decoration: BoxDecoration(color: MyColors.primaryColor),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            ParagraphText(
                              'Withdrawal History',
                              fontSize: 16,
                              fontFamily: 'semibold',
                              color: Colors.white,
                            ),
                            hSizedBox,
                            Icon(
                              Icons.arrow_forward_ios,
                              size: 20,
                              color: MyColors.whiteColor,
                            )
                          ],
                        ),
                      ),
                    ),
                  GestureDetector(
                    onTap: () {
                      share();
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                        // borderRadius: BorderRadius.circular(20),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Share with Friends',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  GestureDetector(
                    onTap: () {
                      push(context: context, screen: GiftsReceivedPage());
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                        // borderRadius: BorderRadius.circular(20),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            '${userData!.gender==UserGender.male?'View Sent Gifts': 'View Gifts Received'}',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  GestureDetector(
                    onTap: () {
                      push(context: context, screen: ContactUs());
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                        // borderRadius: BorderRadius.circular(20),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Contact us',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  GestureDetector(
                    onTap: () {
                      logoutConfirmation(context);
                    },
                    child: Container(
                      margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
                      height: 54,
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              bottomRight: Radius.circular(20),
                              bottomLeft: Radius.circular(20)),
                          color: MyColors.primaryColor),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          ParagraphText(
                            'Logout',
                            fontSize: 16,
                            fontFamily: 'semibold',
                            color: Colors.white,
                          ),
                          hSizedBox,
                          Icon(
                            Icons.arrow_forward_ios,
                            size: 20,
                            color: MyColors.whiteColor,
                          )
                        ],
                      ),
                    ),
                  ),
                  vSizedBox8,
                ],
              ),
            ),
          ),
          Positioned(
            top: 26,
            right: 16,
            child: IconButton(
              icon: Icon(
                Icons.notifications,
                color: Colors.white,
              ),
              onPressed: () async {
                push(context: context, screen: NotificationPage());
              },
            ),
          )
        ],
      ),
    );
  }

  String calculateAge(String birthDateString) {
    log('check-----date---' + birthDateString);
    String datePattern = "yyyy-MM-dd";

    DateTime birthDate = DateFormat(datePattern).parse(birthDateString);
    DateTime currentDate = DateTime.now();
    int age = currentDate.year - birthDate.year;
    int month1 = currentDate.month;
    int month2 = birthDate.month;
    if (month2 > month1) {
      age--;
    } else if (month1 == month2) {
      int day1 = currentDate.day;
      int day2 = birthDate.day;
      if (day2 > day1) {
        age--;
      }
    }
    return age.toString() + " years";
  }
}

// import 'dart:async';
// import 'dart:developer';
// import 'dart:io';
//
// import 'package:Enjoy/add_story.dart';
// import 'package:Enjoy/changepassword.dart';
// import 'package:Enjoy/chat_detail_page.dart';
// import 'package:Enjoy/constants/colors.dart';
// import 'package:Enjoy/constants/global_functions.dart';
// import 'package:Enjoy/constants/image_urls.dart';
// import 'package:Enjoy/constants/navigation_functions.dart';
// import 'package:Enjoy/constants/sized_box.dart';
// import 'package:Enjoy/contactus.dart';
// import 'package:Enjoy/dialogs/withdraw_money_dialog.dart';
// import 'package:Enjoy/follower_list.dart';
// import 'package:Enjoy/following_list.dart';
// import 'package:Enjoy/get_coins.dart';
// import 'package:Enjoy/modals/user_modal.dart';
// import 'package:Enjoy/notification.dart';
// import 'package:Enjoy/overview.dart';
// import 'package:Enjoy/pages/gifts_sent_page.dart';
// import 'package:Enjoy/pages/photos_page.dart';
// import 'package:Enjoy/pages/story_preview_page.dart';
// import 'package:Enjoy/pages/view_story_page.dart';
//
// import 'package:Enjoy/profile.dart';
// import 'package:Enjoy/reward.dart';
// import 'package:Enjoy/services/alert.dart';
// import 'package:Enjoy/services/api_urls.dart';
// import 'package:Enjoy/services/auth.dart';
// import 'package:Enjoy/services/common.dart';
// import 'package:Enjoy/services/common_functions.dart';
// import 'package:Enjoy/services/image.dart';
// import 'package:Enjoy/services/localServices.dart';
// import 'package:Enjoy/services/location.dart';
// import 'package:Enjoy/services/webservices.dart';
// import 'package:Enjoy/user_blocked.dart';
// import 'package:Enjoy/view_story.dart';
// import 'package:Enjoy/welcome.dart';
// import 'package:Enjoy/widget/CustomTexts.dart';
// import 'package:Enjoy/widget/Customeloader.dart';
// import 'package:Enjoy/widget/block_layout.dart';
// import 'package:Enjoy/widget/custom_circle_avatar.dart';
// import 'package:Enjoy/widget/custom_circular_image.dart';
// import 'package:Enjoy/widget/custom_text_field.dart';
// import 'package:Enjoy/widget/record_video_screen.dart';
// import 'package:Enjoy/widget/round_edged_button.dart';
// import 'package:Enjoy/widget/showSnackbar.dart';
// import 'package:Enjoy/widget/show_custom_modal_sheet.dart';
// import 'package:Enjoy/widget/solidBtn.dart';
// import 'package:Enjoy/widget/withdrawal_history.dart';
// import 'package:flutter/cupertino.dart';
// import 'package:flutter/material.dart';
// import 'package:intl/intl.dart';
// import 'constants/global_data.dart';
// import 'package:story_view/story_view.dart';
// import 'package:video_player/video_player.dart';
//
// import 'constants/global_keys.dart';
// import 'modals/media_modal.dart';
//
// class Profile_Account_Page extends StatefulWidget {
//   const Profile_Account_Page({Key? key}) : super(key: key);
//   @override
//   _Profile_Account_PageState createState() => _Profile_Account_PageState();
// }
//
// class _Profile_Account_PageState extends State<Profile_Account_Page> {
//   TextEditingController email = TextEditingController();
//   TextEditingController name = TextEditingController();
//   TextEditingController phone = TextEditingController();
//   TextEditingController country = TextEditingController();
//
//   double _currentSliderValue = 20;
//   double lat = 0;
//   double lng = 0;
//   List my_stories = [];
//   bool addStoryLoad = false;
//   Map adminSetting={};
//   // List my_user =[];
//
//
//   int usdToDiamondConversionRate = 0;
//   int minimumWithdrawableAmountInUsd = 100;
//
//   double maxCapacityInUsd = 0;
//   getConversionRate()async{
//     var jsonResponse = await Webservices.getMap(ApiUrls.converstionRates);
//     usdToDiamondConversionRate = int.parse(jsonResponse['diamond_to_usd']??'20');
//     maxCapacityInUsd = userData!.diamonds/usdToDiamondConversionRate;
//     setState(() {
//
//     });
//   }
//   changeProfilePicture(bool isGallery) async {
//     File? selectedImage;
//     selectedImage = await pickImage(isGallery);
//     if (selectedImage != null) {
//       Navigator.pop(context);
//       loadingShow(context);
//       var request = {
//         'user_id': userData!.id,
//       };
//       var files = {'image': selectedImage};
//       await Webservices.postDataWithImageFunction(
//           body: request,
//           files: files,
//           context: context,
//           endPoint: ApiUrls.editProfile);
//       await MyLocalServices.updateUserDataFromServer(
//           userId: userData!.id, apiUrl: ApiUrls.getUserData);
//
//       loadingHide(context);
//       setState(() {});
//     }
//   }
// getAdminSetting()async{
//   adminSetting = await Webservices.getMap(ApiUrls.settingsAdmin);
//
// }
//   @override
//   void initState() {
//     // TODO: implement initState
//     super.initState();
//     // get_GPS_Position();
//     // interval_api();
//     getConversionRate();
//     print('user detail-----${userData}');
//     get_my_stories();
//     get_info();
//     getAdminSetting();
//   }
//
//   get_GPS_Position() async {
//     print('------enter------');
//     dynamic position = await determinePosition();
//     print('current position------${position}');
//     if (position != null) {}
//   }
//
//   get_info() async {
//     Map data = {'user_id': await getCurrentUserId()};
//     Map res = await getData(data, 'get_user_profile', 0, 0);
//     print('res--------$res');
//     if (res['status'].toString() == '1') {
//       userData = UserModal.fromJson(res['data']);
//       setState(() {});
//     }
//   }
//
//   get_my_stories() async {
//     Map data = {
//       'user_id': await getCurrentUserId(),
//     };
//     Map res = await getData(data, 'myStoryList', 0, 0);
//     print('my story-----$res');
//     if (res['status'].toString() == '1') {
//       my_stories = res['data'];
//       setState(() {});
//     }
//   }
//   // get_my_user() async {
//   //   Map data = {
//   //     'user_id': await getCurrentUserId(),
//   //   };
//   //   Map res = await getData(data, 'getGiftList', 0, 0);
//   //   print('my story-----$res');
//   //   if (res['status'].toString() == '1') {
//   //     my_user = res['data'];
//   //     setState(() {});
//   //   }
//   // }
//
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       backgroundColor: MyColors.whiteColor,
//       body: Stack(
//         children: [
//           SingleChildScrollView(
//             child: Container(
//               child: Column(
//                 crossAxisAlignment: CrossAxisAlignment.start,
//                 children: [
//                   Container(
//                     padding: EdgeInsets.all(16),
//                     decoration: BoxDecoration(
//                         color: MyColors.secondary,
//                         borderRadius: BorderRadius.only(
//                             bottomLeft: Radius.circular(40),
//                             bottomRight: Radius.circular(40))),
//                     child: Column(
//                       crossAxisAlignment: CrossAxisAlignment.start,
//                       children: [
//                         vSizedBox4,
//                         Container(
//                           width: MediaQuery.of(context).size.width,
//                           child: Column(
//                             crossAxisAlignment: CrossAxisAlignment.center,
//                             children: [
//                               // Image.network(user_data!['image']),
//                               GestureDetector(
//                                 onTap: () {
//                                   showCustomBottomSheet(
//                                     context,
//                                     height: null,
//                                     child: Padding(
//                                       padding: const EdgeInsets.symmetric(horizontal: 32),
//                                       child: Column(
//                                         mainAxisSize: MainAxisSize.min,
//                                         children: [
//                                           GestureDetector(
//                                             onTap: () {
//                                               changeProfilePicture(false);
//                                             },
//                                             child: Row(
//
//                                               children: [
//                                                 Icon(Icons.camera_alt),
//                                                 hSizedBox,
//                                                 SubHeadingText(
//                                                     'Open Camera'),
//                                               ],
//                                             ),
//                                           ),
//                                           vSizedBox,
//                                           Divider(),
//                                           vSizedBox,
//                                           GestureDetector(
//                                               onTap: () {
//                                                 changeProfilePicture(true);
//                                               },
//                                               child: Row(
//                                                 children: [
//                                                   Icon(Icons.image),
//                                                   hSizedBox,
//                                                   SubHeadingText(
//                                                       'Select From Gallery'),
//                                                 ],
//                                               )),
//                                         ],
//                                       ),
//                                     ),
//                                   );
//                                 },
//                                 child: Stack(
//                                   children: [
//                                     Container(
//                                       padding: EdgeInsets.all(6),
//                                       child: CustomCircularImage(
//                                         imageUrl: userData!.imageUrl,
//                                         height: 100,
//                                         width: 100,
//                                       ),
//                                     ),
//                                     Positioned(
//                                       bottom: 0,
//                                       right: 0,
//                                       child: Container(
//                                         padding: EdgeInsets.all(6),
//                                         decoration: BoxDecoration(
//                                           color: Colors.white,
//                                           borderRadius: BorderRadius.circular(50)
//                                         ),
//                                         child: Icon(Icons.camera_alt),
//                                       ),
//                                     )
//                                   ],
//                                 ),
//                               ),
//                               hSizedBox2,
//
//                               vSizedBox,
//                               Text(
//                                 '#' + userData!.uniqueId,
//                                 style: TextStyle(
//                                     fontSize: 12,
//                                     fontFamily: 'semibold',
//                                     color: Colors.white),
//                               ),
//                               vSizedBox,
//                               ParagraphText(
//                                 userData!.name +
//                                     ', ' +
//                                     calculateAge(userData!.dateOfBirth)
//                                         .toString() +
//                                     ', ' +
//                                     userData!.country,
//                                 fontSize: 16,
//                                 fontFamily: 'semibold',
//                                 color: Colors.white,
//                               ),
//                               // ParagraphText('Rosella William, 25, USA',
//                               //   fontSize: 16,
//                               //   fontFamily: 'semibold',
//                               //   color: Colors.white,),
//                             ],
//                           ),
//                         ),
//                         // vSizedBox,
//                         // Row(
//                         //   mainAxisAlignment: MainAxisAlignment.spaceAround,
//                         //   children: [
//                         //     Text('Location: USA', style: TextStyle(fontSize: 16, fontFamily: 'semibold', color: Colors.white),),
//                         //     Text('Age: 25 Yr', style: TextStyle(fontSize: 16, fontFamily: 'semibold', color: Colors.white),)
//                         //   ],
//                         // ),
//
//                         vSizedBox4,
//                         Row(
//                           mainAxisAlignment: MainAxisAlignment.center,
//                           children: [
//                             GestureDetector(
//                               behavior: HitTestBehavior.translucent,
//                               onTap: () async {
//                                 Navigator.push(
//                                     context,
//                                     MaterialPageRoute(
//                                         builder: (context) => (Following_list(
//                                               user_id: userData!.id,
//                                             ))));
//                               },
//                               child: Column(
//                                 crossAxisAlignment: CrossAxisAlignment.center,
//                                 children: [
//                                   ParagraphText(
//                                     '${userData!.following}',
//                                     fontSize: 16,
//                                     fontFamily: 'bold',
//                                     color: MyColors.whiteColor,
//                                   ),
//                                   vSizedBox05,
//                                   ParagraphText(
//                                     'Following',
//                                     fontSize: 16,
//                                     fontFamily: 'light',
//                                     color: Colors.white,
//                                   ),
//                                 ],
//                               ),
//                             ),
//                             hSizedBox8,
//                             GestureDetector(
//                               behavior: HitTestBehavior.translucent,
//                               onTap: () {
//                                 Navigator.push(
//                                     context,
//                                     MaterialPageRoute(
//                                         builder: (context) => (Follower_list(
//                                               user_id: userData!.id,
//                                             ))));
//                               },
//                               child: Column(
//                                 crossAxisAlignment: CrossAxisAlignment.center,
//                                 children: [
//                                   ParagraphText(
//                                     '${userData!.followers}',
//                                     fontSize: 16,
//                                     fontFamily: 'bold',
//                                     color: MyColors.whiteColor,
//                                   ),
//                                   vSizedBox05,
//                                   const ParagraphText(
//                                     'Followers',
//                                     fontSize: 16,
//                                     fontFamily: 'light',
//                                     color: Colors.white,
//                                   ),
//                                 ],
//                               ),
//                             ),
//                           ],
//                         ),
//                         vSizedBox4,
//                         const ParagraphText(
//                           'Add Stories',
//                           fontSize: 16,
//                           fontFamily: 'bold',
//                           color: MyColors.primaryColor,
//                         ),
//                         vSizedBox,
//                         Row(
//                           children: [
//                             GestureDetector(
//                               behavior: HitTestBehavior.translucent,
//                               onTap: addStoryLoad
//                                   ? () {
//                                       print('please wait');
//                                     }
//                                   : () async {
//                                       File? videoFile;
//                                       int duration = 0;
//
//                                       // videoFile = await pickVideo(isGallery: false);
//                                       videoFile = await push(
//                                           context: context,
//                                           screen: RecordVideoScreen());
//                                       if (videoFile != null) {
//                                         setState(() {
//                                           addStoryLoad = true;
//                                         });
//                                         VideoPlayerController controller =
//                                             VideoPlayerController.file(
//                                                 videoFile);
//                                         await controller.initialize();
//                                         duration =
//                                             controller.value.duration.inSeconds;
//                                         print('the duration iss is $duration');
//
//                                         // try{
//                                         //   controller.dispose();
//                                         // }catch(e){
//                                         //   print('Error in catch block $e');
//                                         // }
//                                         if (duration < 5) {
//                                           presentToast(
//                                               'Story Length too short');
//                                         } else if (duration > 30) {
//                                           presentToast(
//                                               'Story Length must be less than 30 secs');
//                                         } else {
//                                           await push(
//                                               context: context,
//                                               screen: StoryPreviewPage(
//                                                 storyFile: videoFile,
//                                                 controller: controller,
//                                               ));
//                                           get_my_stories();
//                                         }
//
//                                         controller.dispose();
//                                         setState(() {
//                                           addStoryLoad = false;
//                                         });
//                                       } else {
//                                         print('the selected video is null');
//                                       }
//
//                                       // push(context: context, screen: addStory())
//                                       //     .then((val) => {
//                                       //           get_my_stories(),
//                                       //         });
//                                     },
//                               child: CustomCircleAvatar(
//                                 imageUrl: 'assets/add_border.png',
//                               ),
//                             ),
//                             hSizedBox,
//                             Expanded(
//                               child: Container(
//                                 height: 75,
//                                 child: ListView(
//                                   scrollDirection: Axis.horizontal,
//                                   children: <Widget>[
//                                     for (int i = 0; i < my_stories.length; i++)
//                                       GestureDetector(
//                                         onTap: () {
//                                           push(
//                                               context: context,
//                                               screen: ViewStoryPage(
//                                                 stories: my_stories,
//                                                 selectedIndex: i, userId: userData!.id,
//                                               ));
//                                           // push(
//                                           //     context: context,
//                                           //     screen: view_story(
//                                           //       stories: my_stories,
//                                           //       index: i,
//                                           //     )).then((val) => {
//                                           //       get_my_stories(),
//                                           //     });
//                                         },
//                                         child: Padding(
//                                           padding:
//                                               const EdgeInsets.only(left: 5.0),
//                                           child: Container(
//                                             width: 75,
//                                             decoration: BoxDecoration(
//                                                 borderRadius:
//                                                     BorderRadius.circular(50),
//                                                 color: Colors.white,
//                                                 border: Border.all(
//                                                     color:
//                                                         MyColors.primaryColor,
//                                                     width: 2)),
//                                             padding: EdgeInsets.all(2),
//                                             child: ClipRRect(
//                                               clipBehavior: Clip.hardEdge,
//                                               child: Image.network(
//                                                 my_stories[i]['thumbnail'] ??
//                                                     '',
//                                                 fit: BoxFit.cover,
//                                               ),
//                                               borderRadius:
//                                                   BorderRadius.circular(50),
//                                             ),
//                                           ),
//                                         ),
//                                       ),
//                                   ],
//                                 ),
//                               ),
//                             ),
//                             // hSizedBox,
//                             // Container(
//                             //   decoration: BoxDecoration(
//                             //       borderRadius: BorderRadius.circular(50),
//                             //       color: Colors.white,
//                             //       border: Border.all(
//                             //           color: MyColors.primaryColor, width: 2)),
//                             //   padding: EdgeInsets.all(2),
//                             //   child: CustomCircleAvatar(
//                             //     imageUrl: 'assets/chat_person.png',
//                             //   ),
//                             // ),
//                           ],
//                         ),
//                         vSizedBox2,
//                         ParagraphText(
//                           'Your Gallery',
//                           fontSize: 16,
//                           fontFamily: 'bold',
//                           color: MyColors.primaryColor,
//                         ),
//                         vSizedBox,
//                         Wrap(
//                           children: [
//                             for (int i = 0;
//                                 i < userData!.galleryImages.length;
//                                 i++)
//                               GestureDetector(
//                                 onTap: () {
//                                   print(userData!.galleryImages);
//                                   List<ImageModal> media = [];
//                                   (userData!.galleryImages as List)
//                                       .forEach((element) {
//                                     media.add(ImageModal.fromJson(element));
//                                   });
//                                   push(
//                                       context: context,
//                                       screen: PhotosPage(
//                                           images: media, selectedIndex: i));
//                                 },
//                                 child: Container(
//                                   clipBehavior: Clip.hardEdge,
//                                   padding: EdgeInsets.all(4.0),
//                                   // width: double.infinity,
//                                   height:
//                                       (MediaQuery.of(context).size.width / 3 -
//                                           20),
//                                   // height:200,
//                                   decoration: BoxDecoration(
//                                       // color: Colors.grey,
//                                       borderRadius: BorderRadius.circular(24)),
//                                   child: Image.network(
//                                     userData!.galleryImages[i]['images'],
//                                     fit: BoxFit.cover,
//                                     height: 200,
//                                     width: 100,
//                                   ),
//                                 ),
//                               ),
//                           ],
//                         ),
//                         vSizedBox4,
//                         if (userData!.gender == UserGender.male)
//                           Container(
//                             padding: EdgeInsets.only(
//                                 left: 16, top: 5, bottom: 5, right: 5),
//                             decoration: BoxDecoration(
//                                 border: Border.all(
//                                     color: MyColors.primaryColor, width: 3),
//                                 borderRadius: BorderRadius.circular(30)),
//                             child: Row(
//                               mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                               children: [
//                                 Row(
//                                   children: [
//                                     Image.asset(
//                                       'assets/coin.png',
//                                       height: 20,
//                                       width: 20,
//                                     ),
//                                     hSizedBox,
//                                     ParagraphText(
//                                       '${userData!.coins}',
//                                       color: Colors.white,
//                                     )
//                                   ],
//                                 ),
//                                 RoundEdgedButton(
//                                   text: 'Get Coins',
//                                   width: 95,
//                                   fontSize: 12,
//                                   shadow: 0,
//                                   verticalMargin: 0,
//                                   verticalPadding: 0,
//                                   horizontalMargin: 0,
//                                   onTap: () {
//                                     push(
//                                             context: context,
//                                             screen: Get_Coins_Page())
//                                         .then((value) => {get_info()});
//                                   },
//                                 )
//                               ],
//                             ),
//                           )
//                         else
//                           Container(
//                             padding: EdgeInsets.only(
//                                 left: 16, top: 5, bottom: 5, right: 5),
//                             decoration: BoxDecoration(
//                                 border: Border.all(
//                                     color: MyColors.primaryColor, width: 3),
//                                 borderRadius: BorderRadius.circular(30)),
//                             child: Row(
//                               mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                               children: [
//                                 Row(
//                                   children: [
//                                     Image.asset(
//                                       MyImages.diamond,
//                                       height: 20,
//                                       width: 20,
//                                     ),
//                                     hSizedBox,
//                                     ParagraphText(
//                                       userData!.diamonds.toString(),
//                                       color: Colors.white,
//                                     )
//                                   ],
//                                 ),
//                                 GestureDetector(
//                                   onTap: () {
//                                     showModalBottomSheet<void>(
//                                       backgroundColor: Colors.transparent,
//                                       context: context,
//                                       builder: (BuildContext context) {
//                                         return StatefulBuilder(
//                                           builder: (context, setState) {
//
//                                             return Container(
//                                               height: 500+MediaQuery.of(context).viewInsets.bottom,
//
//                                               child: Scaffold(
//                                                 backgroundColor: Colors.transparent,
//                                                 body: Container(
//                                                   decoration: BoxDecoration(
//                                                       image: DecorationImage(
//                                                         image: AssetImage(
//                                                             "assets/popup_back.png"),
//                                                         fit: BoxFit.cover,
//                                                       ),
//                                                       borderRadius:
//                                                       BorderRadius.only(
//                                                         topLeft: Radius.circular(30),
//                                                         topRight: Radius.circular(30),
//                                                       )),
//                                                   child: Stack(
//                                                     children: [
//                                                       Column(
//                                                         crossAxisAlignment:
//                                                             CrossAxisAlignment.center,
//                                                         children: [
//                                                           vSizedBox,
//                                                           Column(
//                                                             crossAxisAlignment:
//                                                                 CrossAxisAlignment.center,
//                                                             children: [
//                                                               Container(
//                                                                 height: 3,
//                                                                 width: 35,
//                                                                 decoration: BoxDecoration(
//                                                                     color:
//                                                                         Color(0xFFe2e2e2),
//                                                                     borderRadius:
//                                                                         BorderRadius
//                                                                             .circular(2)),
//                                                               ),
//                                                             ],
//                                                           ),
//                                                           vSizedBox6,
//                                                           ParagraphText(
//                                                             'Great Job!',
//                                                             fontSize: 35,
//                                                             fontFamily: 'bold',
//                                                             color: Colors.white,
//                                                           ),
//                                                           vSizedBox,
//                                                           if(maxCapacityInUsd>minimumWithdrawableAmountInUsd)
//                                                           Row(
//                                                             mainAxisAlignment:
//                                                                 MainAxisAlignment.center,
//                                                             children: [
//                                                               ParagraphText(
//                                                                 'You can withdraw max \$${maxCapacityInUsd.ceil()} to your account',
//                                                                 fontSize: 18,
//                                                                 fontFamily: 'regular',
//                                                                 color: Colors.white,
//                                                               ),
//                                                               // hSizedBox05,
//                                                               // Image.asset(
//                                                               //   'assets/diamond.png',
//                                                               //   height: 20,
//                                                               // ),
//                                                               // hSizedBox05,
//                                                               // ParagraphText(
//                                                               //   '670 left to get',
//                                                               //   fontSize: 18,
//                                                               //   fontFamily: 'regular',
//                                                               //   color: Colors.white,
//                                                               // ),
//                                                             ],
//                                                           )
//                                                           else
//                                                             Row(
//                                                               mainAxisAlignment:
//                                                               MainAxisAlignment.center,
//                                                               children: [
//                                                                 ParagraphText(
//                                                                   'Only',
//                                                                   fontSize: 18,
//                                                                   fontFamily: 'regular',
//                                                                   color: Colors.white,
//                                                                 ),
//                                                                 hSizedBox05,
//                                                                 Image.asset(
//                                                                   'assets/diamond.png',
//                                                                   height: 20,
//                                                                 ),
//                                                                 hSizedBox05,
//                                                                 ParagraphText(
//                                                                   '${((minimumWithdrawableAmountInUsd-maxCapacityInUsd)*usdToDiamondConversionRate).ceil()} left to get',
//                                                                   fontSize: 18,
//                                                                   fontFamily: 'regular',
//                                                                   color: Colors.white,
//                                                                 ),
//                                                               ],
//                                                             ),
//                                                           vSizedBox2,
//                                                           ParagraphText(
//                                                             '\$${_currentSliderValue.ceil().toString()}',
//                                                             fontSize: 35,
//                                                             fontFamily: 'bold',
//                                                             color: Colors.white,
//                                                           ),
//                                                           vSizedBox4,
//                                                           Slider(
//                                                             value: _currentSliderValue,
//                                                             min: 10,
//                                                             max: 1000,
//                                                             // divisions: 20,
//                                                             inactiveColor: Colors.white
//                                                                 .withOpacity(0.40),
//                                                             activeColor:
//                                                                 MyColors.primaryColor,
//                                                             label: _currentSliderValue
//                                                                 .round()
//                                                                 .toString(),
//                                                             onChangeEnd: (double value){
//
//                                                               print(' the valllusss are  ${userData!.diamonds} ${minimumWithdrawableAmountInUsd} ${usdToDiamondConversionRate}');
//                                                               print('qq ${maxCapacityInUsd}');
//                                                             },
//                                                             onChanged: (double value) {
//
//                                                               if(_currentSliderValue>maxCapacityInUsd){
//                                                               }else{
//
//                                                               }
//                                                               setState(() {
//                                                                 _currentSliderValue = value;
//                                                                 print('object123------------${_currentSliderValue}');
//                                                               });
//
//                                                             },
//                                                           ),
//                                                           vSizedBox2,
//                                                           Padding(
//                                                             padding:
//                                                                 const EdgeInsets.symmetric(
//                                                                     horizontal: 16.0),
//                                                             child: RoundEdgedButton(
//                                                               text:
//                                                                   'Withdraw Amount',
//                                                               onTap: ()async{
//                                                                 print('maxCapacityInUsd-----${maxCapacityInUsd}');
//                                                                 print('minimumWithdrawableAmountInUsd-----${minimumWithdrawableAmountInUsd}');
//                                                                 print('_currentSliderValue-----${_currentSliderValue.ceil().toString()}');
//                                                                 if(maxCapacityInUsd>=minimumWithdrawableAmountInUsd  && maxCapacityInUsd>=_currentSliderValue.ceil()) {
//                                                                    if(_currentSliderValue>=double.parse(adminSetting['min_withdrawal_amount']) && _currentSliderValue<=double.parse(adminSetting['max_withdrawal_amount'])){
//                                                                      showModalBottomSheet<
//                                                                          void>(
//                                                                        context: context,
//                                                                        builder: (
//                                                                            BuildContext context) {
//                                                                          return StatefulBuilder(
//                                                                              builder: (
//                                                                                  BuildContext context,
//                                                                                  StateSetter setState) {
//                                                                                return Container(
//                                                                                  height: 200,
//                                                                                  color: Colors
//                                                                                      .white,
//                                                                                  child: Center(
//                                                                                    child: Column(
//                                                                                      mainAxisAlignment: MainAxisAlignment
//                                                                                          .start,
//                                                                                      mainAxisSize: MainAxisSize
//                                                                                          .min,
//                                                                                      children: <
//                                                                                          Widget>[
//                                                                                        GestureDetector(
//                                                                                          onTap: () async {
//                                                                                            bool load = false;
//                                                                                            await showModalBottomSheet<
//                                                                                                void>(
//                                                                                              context: context,
//                                                                                              builder: (
//                                                                                                  BuildContext context) {
//                                                                                                return StatefulBuilder(
//                                                                                                    builder: (context, setState){
//                                                                                                    return Container(
//                                                                                                      height: 500+MediaQuery.of(context).viewInsets.bottom,
//                                                                                                      child: Scaffold(
//                                                                                                        body:load?CustomLoader():Container(
//
//                                                                                                          color: Colors
//                                                                                                              .white24,
//                                                                                                          child: Padding(
//                                                                                                            padding: EdgeInsets
//                                                                                                                .all(
//                                                                                                                16),
//                                                                                                            child: Column(
//                                                                                                              mainAxisAlignment: MainAxisAlignment
//                                                                                                                  .start,
//                                                                                                              mainAxisSize: MainAxisSize
//                                                                                                                  .min,
//                                                                                                              children: <
//                                                                                                                  Widget>[
//                                                                                                                Text(
//                                                                                                                  'Enter your Email!',
//                                                                                                                  style: TextStyle(
//                                                                                                                      color: MyColors
//                                                                                                                          .primaryColor,
//                                                                                                                      fontSize: 16),),
//                                                                                                                vSizedBox,
//                                                                                                                CustomTextField(
//                                                                                                                  hintcolor: Colors
//                                                                                                                      .black,
//                                                                                                                  controller: email,
//                                                                                                                  hintText: 'Enter your Email',
//                                                                                                                  verticalPadding: 8,
//                                                                                                                ),
//                                                                                                                vSizedBox4,
//                                                                                                                ElevatedButton(
//                                                                                                                  // style: ButtonStyle(
//                                                                                                                  //   backgroundColor: Colors.green,
//                                                                                                                  // ),
//                                                                                                                  child: Text(
//                                                                                                                      'Submit'),
//                                                                                                                  onPressed: () async {
//                                                                                                                    String pattern =
//                                                                                                                        r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
//                                                                                                                    RegExp regex = new RegExp(pattern);
//                                                                                                                    if (email
//                                                                                                                        .text ==
//                                                                                                                        '') {
//                                                                                                                      showSnackbar(
//                                                                                                                          'Please enter your email');
//                                                                                                                    }else if (!regex.hasMatch(email.text)) {
//                                                                                                                      showSnackbar(
//                                                                                                                        'Please Enter your valid email.');
//                                                                                                                    }
//                                                                                                                    // else if(_currentSliderValue<=res['min_withdrawal_amount'] && _currentSliderValue>=res['min_withdrawal_amount']){
//                                                                                                                    //   print('object----858');
//                                                                                                                    //   showSnackbar('Amount should be max ${res['max_withdrawal_amount']} and minimum ${res['min_withdrawal_amount']}');
//                                                                                                                    //
//                                                                                                                    // }
//                                                                                                                    else {
//
//                                                                                                                      Map<
//                                                                                                                          String,
//                                                                                                                          dynamic>request = {
//                                                                                                                        'paypal_emailid': email
//                                                                                                                            .text,
//                                                                                                                        'user_id': userData!
//                                                                                                                            .id,
//                                                                                                                        'redeem_type': '3',
//                                                                                                                        'amount': _currentSliderValue
//                                                                                                                            .ceil()
//                                                                                                                            .toString(),
//                                                                                                                        'diamond': (double
//                                                                                                                            .parse(
//                                                                                                                            _currentSliderValue
//                                                                                                                                .toString()) *
//                                                                                                                            double
//                                                                                                                                .parse(
//                                                                                                                                adminSetting['diamond_to_usd']))
//                                                                                                                            .toString()
//                                                                                                                      };
//
//                                                                                                                      setState((){
//                                                                                                                        load =true;
//                                                                                                                      });
//                                                                                                                      var jsonResponse = await Webservices
//                                                                                                                          .postData(
//                                                                                                                          apiUrl: ApiUrls
//                                                                                                                              .withdrawalRequest,
//                                                                                                                          request: request,
//                                                                                                                          showSuccessMessage: true);
//                                                                                                                      setState((){
//                                                                                                                        load =false;
//                                                                                                                      });
//                                                                                                                      log(
//                                                                                                                          "jsonResponse" +
//                                                                                                                              jsonResponse
//                                                                                                                                  .toString());
//                                                                                                                      if (jsonResponse['status'] ==
//                                                                                                                          1) {
//                                                                                                                        Navigator
//                                                                                                                            .pop(
//                                                                                                                            context);
//                                                                                                                      } else {
//                                                                                                                        Navigator
//                                                                                                                            .pop(
//                                                                                                                            context);
//                                                                                                                        showSnackbar(
//                                                                                                                            jsonResponse['message']);
//                                                                                                                        // setState(() {
//                                                                                                                        //   load = false;
//                                                                                                                        // });
//                                                                                                                      }
//                                                                                                                    }
//                                                                                                                  },
//                                                                                                                  // Navigator.pop(context),
//                                                                                                                ),
//                                                                                                              ],
//                                                                                                            ),
//                                                                                                          ),
//                                                                                                        ),
//                                                                                                      ),
//                                                                                                    );
//                                                                                                  }
//                                                                                                );
//                                                                                              },
//                                                                                            );
//                                                                                            Navigator
//                                                                                                .pop(
//                                                                                                context);
//                                                                                          },
//                                                                                          child: Text(
//                                                                                              'Paypal'),
//                                                                                        ),
//                                                                                        GestureDetector(
//                                                                                          onTap: () async {
//                                                                                            await showModalBottomSheet(
//                                                                                                context: MyGlobalKeys
//                                                                                                    .navigatorKey
//                                                                                                    .currentContext!,
//                                                                                                isScrollControlled: true,
//                                                                                                backgroundColor: Colors
//                                                                                                    .transparent,
//                                                                                                builder: (
//                                                                                                    context) {
//                                                                                                  return WithdrawMoneyDialog(
//                                                                                                    bankAccountDetails: null,
//                                                                                                    withdrawableAmount: _currentSliderValue
//                                                                                                        .ceil(),);
//                                                                                                });
//                                                                                            Navigator.pop(context);
//                                                                                          },
//                                                                                          child: Padding(
//                                                                                            padding: EdgeInsets
//                                                                                                .all(
//                                                                                                18.0),
//                                                                                            child: Text(
//                                                                                                'Bank '),
//                                                                                          ),
//                                                                                        ),
//                                                                                        GestureDetector(
//                                                                                          onTap: () async {
//                                                                                            bool load1=false;
//                                                                                            await showModalBottomSheet<
//                                                                                                void>(
//                                                                                              context: context,
//                                                                                              builder: (
//                                                                                                  BuildContext context) {
//                                                                                                return StatefulBuilder(
//                                                                                                  builder: (context , setState) {
//                                                                                                    return Scaffold(
//                                                                                                      body:load1?CustomLoader():Container(
//                                                                                                        height: 500,
//                                                                                                        color: Colors
//                                                                                                            .white24,
//                                                                                                        child: Padding(
//                                                                                                          padding: EdgeInsets
//                                                                                                              .all(
//                                                                                                              16),
//                                                                                                          child: Column(
//                                                                                                            mainAxisAlignment: MainAxisAlignment
//                                                                                                                .start,
//                                                                                                            mainAxisSize: MainAxisSize
//                                                                                                                .min,
//                                                                                                            children: <
//                                                                                                                Widget>[
//                                                                                                              Text(
//                                                                                                                'Enter your Detail !',
//                                                                                                                style: TextStyle(
//                                                                                                                    color: MyColors
//                                                                                                                        .primaryColor,
//                                                                                                                    fontSize: 18),),
//                                                                                                              vSizedBox,
//                                                                                                              CustomTextField(
//                                                                                                                hintcolor: Colors
//                                                                                                                    .black,
//                                                                                                                controller: name,
//                                                                                                                hintText: 'Enter your Name',
//                                                                                                                verticalPadding: 8,
//                                                                                                              ),
//                                                                                                              vSizedBox,
//                                                                                                              CustomTextField(
//                                                                                                                hintcolor: Colors
//                                                                                                                    .black,
//                                                                                                                keyboardType: TextInputType
//                                                                                                                    .number,
//                                                                                                                controller: phone,
//                                                                                                                hintText: 'Enter your phone number',
//                                                                                                                verticalPadding: 8,
//                                                                                                              ),
//                                                                                                              vSizedBox,
//                                                                                                              CustomTextField(
//                                                                                                                hintcolor: Colors
//                                                                                                                    .black,
//                                                                                                                controller: country,
//                                                                                                                hintText: 'Enter your country',
//                                                                                                                verticalPadding: 8,
//                                                                                                              ),
//                                                                                                              vSizedBox4,
//                                                                                                              ElevatedButton(
//                                                                                                                // style: ButtonStyle(
//                                                                                                                //   backgroundColor: Colors.green,
//                                                                                                                // ),
//                                                                                                                child: Text(
//                                                                                                                    'Submit'),
//                                                                                                                onPressed: () async {
//                                                                                                                  String phonePattern =
//                                                                                                                      r'^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$';
//                                                                                                                  RegExp pnumber = new RegExp(phonePattern);
//                                                                                                                  if (name
//                                                                                                                      .text ==
//                                                                                                                      '') {
//                                                                                                                    showSnackbar(
//                                                                                                                        'Please enter your name');
//                                                                                                                  } else
//                                                                                                                  if (phone.text == '') {
//                                                                                                                    showSnackbar('Please enter your phone number');
//                                                                                                                  }else if (!pnumber.hasMatch(phone.text)) {
//                                                                                                                    showSnackbar('Please Enter your valid phone Number.');
//                                                                                                                  }
//                                                                                                                  else
//                                                                                                                  if (country
//                                                                                                                      .text ==
//                                                                                                                      '') {
//                                                                                                                    showSnackbar(
//                                                                                                                        'Please enter your country');
//                                                                                                                  }
//                                                                                                                  else {
//                                                                                                                    double diamond =(double.parse(_currentSliderValue.ceil().toString()) * double.parse(adminSetting['diamond_to_usd']));
//                                                                                                                    print("diamonddiamond-----------${diamond.ceil().toString()}");
//                                                                                                                    Map<
//                                                                                                                        String,
//                                                                                                                        dynamic>request = {
//                                                                                                                      'username': name
//                                                                                                                          .text,
//                                                                                                                      'phone': phone
//                                                                                                                          .text,
//                                                                                                                      'country': country
//                                                                                                                          .text,
//                                                                                                                      'user_id': userData!
//                                                                                                                          .id,
//                                                                                                                      'redeem_type': '2',
//                                                                                                                      'amount': _currentSliderValue.ceil().toString(),
//                                                                                                                      'diamond': diamond.toString()
//                                                                                                                    };
//                                                                                                                    setState((){
//                                                                                                                      load1 =true;
//                                                                                                                    });
//                                                                                                                    print("data for api -----------"+request.toString());
//                                                                                                                    var jsonResponse = await Webservices
//                                                                                                                        .postData(
//                                                                                                                        apiUrl: ApiUrls
//                                                                                                                            .withdrawalRequest,
//                                                                                                                        request: request,
//                                                                                                                        showSuccessMessage: true);
//
//                                                                                                                    setState((){
//                                                                                                                      load1=false;
//                                                                                                                    });
//                                                                                                                    log(
//                                                                                                                        "jsonResponse" +
//                                                                                                                            jsonResponse
//                                                                                                                                .toString());
//                                                                                                                    if (jsonResponse['status'] ==
//                                                                                                                        1) {
//                                                                                                                      Navigator
//                                                                                                                          .pop(
//                                                                                                                          context);
//                                                                                                                    } else {
//                                                                                                                      Navigator
//                                                                                                                          .pop(
//                                                                                                                          context);
//                                                                                                                      showSnackbar(
//                                                                                                                          jsonResponse['message']);
//                                                                                                                      // setState(() {
//                                                                                                                      //   load = false;
//                                                                                                                      // });
//                                                                                                                    }
//                                                                                                                  }
//                                                                                                                },
//                                                                                                                // Navigator.pop(context),
//                                                                                                              ),
//                                                                                                            ],
//                                                                                                          ),
//                                                                                                        ),
//                                                                                                      ),
//                                                                                                    );
//                                                                                                  }
//                                                                                                );
//                                                                                              },
//                                                                                            );
//                                                                                            Navigator
//                                                                                                .pop(
//                                                                                                context);
//                                                                                          },
//                                                                                          child: Text(
//                                                                                              'Manual'),
//                                                                                        ),
//                                                                                        vSizedBox4,
//                                                                                        ElevatedButton(
//                                                                                          child: const Text(
//                                                                                              'Close'),
//                                                                                          onPressed: () =>
//                                                                                              Navigator
//                                                                                                  .pop(
//                                                                                                  context),
//                                                                                        ),
//
//
//                                                                                      ],
//                                                                                    ),
//                                                                                  ),
//                                                                                );
//                                                                              }
//                                                                          );
//                                                                        },
//                                                                      );
//                                                                    }else{
//                                                                      showSnackbar('The minimum amount for withdrawal is ${adminSetting['min_withdrawal_amount']} , The maximum amount for withdrawal is ${adminSetting['max_withdrawal_amount']}');
//                                                                    }
//                                                                   // await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
//
//                                                                 }
//                                                                 else{
//
//                                                                 }
//                                                                     //   PopupMenuButton(
//                                                                     //   initialValue: 2,
//                                                                     //   child: Center(
//                                                                     //       child: Text('')),
//                                                                     //   itemBuilder: (context) {
//                                                                     //     return List.generate(1, (index) {
//                                                                     //       return PopupMenuItem(
//                                                                     //         value: index,
//                                                                     //         child: Column(
//                                                                     //           children: [
//                                                                     //             Text('Paypal  '),
//                                                                     //             Text('Bank transfer  '),
//                                                                     //             Text('Manual  '),
//                                                                     //           ],
//                                                                     //         ),
//                                                                     //       );
//                                                                     //     });
//                                                                     //   },
//                                                                     // );
//                                                                   // });
//
//
//                                                                 // await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
//                                                                 //   //   return WithdrawMoneyDialog(bankAccountDetails: null, withdrawableAmount: _currentSliderValue.ceil(),);
//                                                                 //   // });
//                                                                 // if(maxCapacityInUsd>=minimumWithdrawableAmountInUsd  && maxCapacityInUsd>=_currentSliderValue.ceil()){
//                                                                 //   print('hhhh ${maxCapacityInUsd>=minimumWithdrawableAmountInUsd  && maxCapacityInUsd<=_currentSliderValue.ceil()}');
//                                                                 //   print(' the valllusss are  ${userData!.diamonds} ${minimumWithdrawableAmountInUsd} ${usdToDiamondConversionRate}');
//                                                                 //   print('qq ${maxCapacityInUsd}   ${_currentSliderValue}');
//                                                                 //
//                                                                 //   await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
//                                                                 //     return WithdrawMoneyDialog(bankAccountDetails: null, withdrawableAmount: _currentSliderValue.ceil(),);
//                                                                 //   });
//                                                                 // }else{
//                                                                 //   showSnackbar('Invalid Amount Selected');
//                                                                 // }
//
//                                                               },
//                                                             ),
//                                                           )
//                                                         ],
//                                                       ),
//                                                       Positioned(
//                                                         right: 26, bottom: 26,
//                                                         child: Row(
//                                                           // crossAxisAlignment: end,
//                                                           children: [
//                                                             SubHeadingText('You have: ${userData!.diamonds}', color: Colors.white,),
//                                                             hSizedBox05,
//                                                             Image.asset(MyImages.diamond, height: 30,),
//                                                           ],
//                                                         ),
//                                                       )
//                                                     ],
//                                                   ),
//                                                 ),
//                                               ),
//                                             );
//                                           }
//                                         );
//                                       },
//                                     );
//                                   },
//                                   child: Container(
//                                     width: 95,
//                                     height: 40,
//                                     decoration: BoxDecoration(
//                                         image: DecorationImage(
//                                           image:
//                                               AssetImage("assets/btn_back.png"),
//                                           fit: BoxFit.cover,
//                                         ),
//                                         borderRadius:
//                                             BorderRadius.circular(30)),
//                                     child: Column(
//                                       crossAxisAlignment:
//                                           CrossAxisAlignment.center,
//                                       mainAxisAlignment:
//                                           MainAxisAlignment.center,
//                                       children: [
//                                         ParagraphText(
//                                           'Redeem',
//                                           color: MyColors.whiteColor,
//                                           fontFamily: 'semibold',
//                                         )
//                                       ],
//                                     ),
//                                   ),
//                                 ),
//
//                                 // RoundEdgedButton(
//                                 //   text: 'Get Coins',
//                                 //   width: 95,
//                                 //   fontSize: 12,
//                                 //   shadow: 0,
//                                 //   verticalMargin: 0,
//                                 //   verticalPadding: 0,
//                                 //   horizontalMargin: 0,
//                                 // )
//                               ],
//                             ),
//                           ),
//                         vSizedBox,
//                       ],
//                     ),
//                   ),
//                   SizedBox(
//                     height: 20,
//                   ),
//                   if(userData!.gender==UserGender.male)
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: Rewards());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           borderRadius: BorderRadius.only(
//                               topRight: Radius.circular(20),
//                               topLeft: Radius.circular(20)),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Earn Free Coins',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   if(userData!.gender==UserGender.female)
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: OverviewPage());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Overview',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   GestureDetector(
//                     onTap: () async {
//                       await push(context: context, screen: ProfilePage())
//                           .then((value) => {
//                                 print('back value$value'),
//                                 setState(() {
//                                   userData != value;
//                                 }),
//                               });
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Edit Profile',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   // GestureDetector(
//                   //   onTap: () {
//                   //     push(context: context, screen: NotificationPage());
//                   //   },
//                   //   child: Container(
//                   //     margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                   //     height: 54,
//                   //     padding: EdgeInsets.symmetric(horizontal: 16),
//                   //     decoration: BoxDecoration(
//                   //         // borderRadius: BorderRadius.circular(20),
//                   //         color: MyColors.primaryColor),
//                   //     child: Row(
//                   //       mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                   //       children: [
//                   //         ParagraphText(
//                   //           'Notifications',
//                   //           fontSize: 16,
//                   //           fontFamily: 'semibold',
//                   //           color: Colors.white,
//                   //         ),
//                   //         hSizedBox,
//                   //         Icon(
//                   //           Icons.arrow_forward_ios,
//                   //           size: 20,
//                   //           color: MyColors.whiteColor,
//                   //         )
//                   //       ],
//                   //     ),
//                   //   ),
//                   // ),
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: ChangePassword());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           // borderRadius: BorderRadius.circular(20),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Change Password',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: UserBlockedPage());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           // borderRadius: BorderRadius.circular(20),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Blocked User',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   if(userData!.gender==UserGender.female)
//                     GestureDetector(
//                       onTap: () {
//                         push(context: context, screen: WithdrawalPage());
//                       },
//                       child: Container(
//                         margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                         height: 54,
//                         padding: EdgeInsets.symmetric(horizontal: 16),
//                         decoration: BoxDecoration(color: MyColors.primaryColor),
//                         child: Row(
//                           mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                           children: [
//                             ParagraphText(
//                               'Withdrawal History',
//                               fontSize: 16,
//                               fontFamily: 'semibold',
//                               color: Colors.white,
//                             ),
//                             hSizedBox,
//                             Icon(
//                               Icons.arrow_forward_ios,
//                               size: 20,
//                               color: MyColors.whiteColor,
//                             )
//                           ],
//                         ),
//                       ),
//                     ),
//                   GestureDetector(
//                     onTap: () {
//                       share();
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           // borderRadius: BorderRadius.circular(20),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Share with Freinds',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: GiftsReceivedPage());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                         // borderRadius: BorderRadius.circular(20),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             '${userData!.gender==UserGender.male?'View Sent Gifts': 'View Gifts Received'}',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   GestureDetector(
//                     onTap: () {
//                       push(context: context, screen: ContactUs());
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           // borderRadius: BorderRadius.circular(20),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Contact us',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   GestureDetector(
//                     onTap: () {
//                       logoutConfirmation(context);
//                     },
//                     child: Container(
//                       margin: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
//                       height: 54,
//                       padding: EdgeInsets.symmetric(horizontal: 16),
//                       decoration: BoxDecoration(
//                           borderRadius: BorderRadius.only(
//                               bottomRight: Radius.circular(20),
//                               bottomLeft: Radius.circular(20)),
//                           color: MyColors.primaryColor),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           ParagraphText(
//                             'Logout',
//                             fontSize: 16,
//                             fontFamily: 'semibold',
//                             color: Colors.white,
//                           ),
//                           hSizedBox,
//                           Icon(
//                             Icons.arrow_forward_ios,
//                             size: 20,
//                             color: MyColors.whiteColor,
//                           )
//                         ],
//                       ),
//                     ),
//                   ),
//                   vSizedBox8,
//                 ],
//               ),
//             ),
//           ),
//           Positioned(
//             top: 26,
//             right: 16,
//             child: IconButton(
//               icon: Icon(
//                 Icons.notifications,
//                 color: Colors.white,
//               ),
//               onPressed: () async {
//                 push(context: context, screen: NotificationPage());
//               },
//             ),
//           )
//         ],
//       ),
//     );
//   }
//
//   String calculateAge(String birthDateString) {
//     log('check-----date---' + birthDateString);
//     String datePattern = "yyyy-MM-dd";
//
//     DateTime birthDate = DateFormat(datePattern).parse(birthDateString);
//     DateTime currentDate = DateTime.now();
//     int age = currentDate.year - birthDate.year;
//     int month1 = currentDate.month;
//     int month2 = birthDate.month;
//     if (month2 > month1) {
//       age--;
//     } else if (month1 == month2) {
//       int day1 = currentDate.day;
//       int day2 = birthDate.day;
//       if (day2 > day1) {
//         age--;
//       }
//     }
//     return age.toString() + " years";
//   }
// }
