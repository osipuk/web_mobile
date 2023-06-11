import 'package:Enjoy/constants/global_data.dart';
import 'package:Enjoy/constants/image_urls.dart';
import 'package:Enjoy/modals/user_modal.dart';
import 'package:Enjoy/single.dart';
import 'package:flutter/material.dart';

import '../chat_detail_page.dart';
import '../constants/colors.dart';
import '../constants/navigation_functions.dart';
import '../dialogs/showFeedbackDialog.dart';
import '../get_coins.dart';
import '../pages/chat_page.dart';
import '../services/video_call_page.dart';
import '../video_call.dart';
import '../widget/CustomTexts.dart';

class UserSearchCard extends StatelessWidget {
  final UserModal user;
  const UserSearchCard({Key? key, required this.user}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: (){
        push(context: context, screen: Single_Page(user_id: user.id,));
      },
      child: Container(
        height: 210,
        decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(20),
            color: Colors.white,
            border: Border.all(color: Colors.white,)
        ),
        child: Stack(
          children: [

            ClipRRect(
              child: Image.network(user.imageUrl,
                height: 210,
                fit: BoxFit.cover,
              ),
              borderRadius: BorderRadius.circular(20),
            ),
            Container(
              height: MediaQuery.of(context).size.height,
              width: MediaQuery.of(context).size.width,
              decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.transparent,
                      Color(0xFF7D44CF)
                    ],
                  ),
                  borderRadius: BorderRadius.circular(20)
              ),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.end,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: ParagraphText('${user.name}, ${user.age}',
                      fontSize: 16,
                      fontFamily: 'bold',
                      color: Colors.white,
                    ),
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      GestureDetector(
                        onTap: ()async{
                          // push(context: context, screen: VideoCallPage());
                          await push(context: context, screen: VideoCallScreen(name: user.name,userId: user.id,isFollow: user.isFollow??'0',age: user.age.toString(),image: user.imageUrl,));
                          if(!userData!.hasRated){
                            showCustomDialog(FeedBackDialog());
                          }
                        },
                        child: Image.asset('assets/video_sec.png', width: 35, height: 35,),
                      ),
                      SizedBox(width: 20,),
                      GestureDetector(
                        onTap: (){
                          push(context: context, screen: ChatPage(info: user.fullData));
                          // push(context: context, screen: Chat_Detail_Page());
                        },
                        child: Image.asset('assets/chat_sec.png', width: 35, height: 35,),
                      )
                    ],
                  ),
                  SizedBox(height: 10,)
                ],
              ),
            ),
            Positioned(
                right: 10,
                top: 10,
                child: Container(
                  width: 35,
                  height: 18,
                  decoration: BoxDecoration(
                      color: MyColors.secondary,
                      borderRadius: BorderRadius.circular(20)
                  ),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Row(
                        children: [
                          Image.asset('assets/eye.png', height: 10,),
                          SizedBox(width: 2,),
                          ParagraphText('${user.followers}', color: Colors.white,fontSize: 8,)
                        ],
                      ),

                    ],
                  ),
                )
            ),
            Positioned(
                left: 10,
                top: 10,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    GestureDetector(
                      onTap: (){
                        push(context: context, screen: Get_Coins_Page());
                      },
                      child: Row(
                        children: [
                          Image.asset(user.gender==UserGender.male?MyImages.coins:MyImages.diamond, width: 15,),
                          SizedBox(width: 3,),
                          Text('${user.gender==UserGender.male?user.coins:user.diamonds}', style: TextStyle(fontSize: 16, color: Colors.white, fontWeight: FontWeight.bold),),
                          SizedBox(width: 16,)
                        ],
                      ),
                    )
                  ],
                )
            ),
          ],
        ),
      ),
    );
  }
}
