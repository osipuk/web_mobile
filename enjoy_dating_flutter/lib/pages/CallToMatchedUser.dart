import 'package:cached_network_image/cached_network_image.dart';
import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/appbar.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:Enjoy/widget/round_edged_button.dart';
import 'package:flutter/material.dart';

import '../constants/navigation_functions.dart';
import '../dialogs/showFeedbackDialog.dart';
import '../services/video_call_page.dart';

class CallToMatchedUserPage extends StatefulWidget {
  final UserModal matchedUser;
  const CallToMatchedUserPage({Key? key, required this.matchedUser})
      : super(key: key);

  @override
  State<CallToMatchedUserPage> createState() => _CallToMatchedUserPageState();
}

class _CallToMatchedUserPageState extends State<CallToMatchedUserPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // appBar: appBar(context: context),
      body: Stack(
        children: [
          Container(
            decoration: BoxDecoration(
                image: DecorationImage(
                    image: CachedNetworkImageProvider(
                      '${widget.matchedUser.imageUrl}',
                    ),
                    fit: BoxFit.cover)),
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  RoundEdgedButton(
                    onTap: ()async{
                      print('the ${widget.matchedUser.isFollow}');
                      await push(context: context, screen: VideoCallScreen(name: widget.matchedUser.name,userId: widget.matchedUser.id,isFollow: widget.matchedUser.isFollow!,image: widget.matchedUser.imageUrl,age: widget.matchedUser.age.toString(),));
                      print('popping 33');
                      Navigator.maybePop(MyGlobalKeys.navigatorKey.currentContext!);
                      if(!userData!.hasRated){
                        showCustomDialog(FeedBackDialog());
                      }
                    },
                    text: 'Accept',
                  ),
                  vSizedBox2,
                  GestureDetector(
                    onTap: () {
                      Navigator.pop(context, true);
                    },
                    child: Container(
                      child: Text(
                        'Next',
                        style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.w700,
                            color: MyColors.primaryColor,
                            decoration: TextDecoration.underline),
                      ),
                    ),
                  ),
                  vSizedBox2,
                  // ParagraphText('${widget.matchedUser.imageUrl}')
                ],
              ),
            ),
          ),
          Positioned(
            left: 16, right: 32, top: 80,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                IconButton(
                  icon: const Icon(
                    Icons.chevron_left_outlined,
                    color: Colors.white,
                    size: 40,
                  ),
                  onPressed: () {
                    Navigator.pop(context);
                  },
                ),
                Row(

                  children: [
                    CustomCircularImage(imageUrl: userData!.gender==UserGender.male?MyImages.coins:MyImages.diamond, width: 30,height: 30,fileType: CustomFileType.asset, ),
                    hSizedBox,
                    SubHeadingText( '${userData!.gender==UserGender.male?userData!.coins:userData!.diamonds}', color: Colors.white,),
                  ],
                )
              ],
            ),
          )
        ],
      ),
    );
  }
}
