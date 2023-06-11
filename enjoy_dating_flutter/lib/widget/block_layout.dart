import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/material.dart';

class BlockLayout extends StatelessWidget {
  final String PersonName;
  final String Chat;
  final IconData Iconing;
  final String ImagePath;
  final bool isIcon;
  final int unreadCount;

  const BlockLayout({Key? key,
    required this.PersonName,
    required this.Chat,
    this.Iconing = Icons.video_call,
    required this.ImagePath,
    this.isIcon = false,
    required this.unreadCount
  }) : super(key: key);


  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 16, vertical: 0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            padding: EdgeInsets.symmetric(vertical: 15, horizontal: 16),
            decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(20),
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Color(0xFE1CDBC1),
                    Color(0xFE12C7AE)
                  ],
                )
            ),
            child: Row(
              children: [
                Column(
                  children: [
                    CustomCircularImage(imageUrl: ImagePath, height: 42,width: 42,fit: BoxFit.cover,),
                    // ClipRRect(
                    //
                    //     child: Image.network(ImagePath, height: 42, width: 42, fit: BoxFit.cover, ),
                    //   borderRadius: BorderRadius.circular(50),
                    // ),
                  ],
                ),
                SizedBox(width: 8,),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Expanded(child: Text(PersonName, style: TextStyle(fontWeight: FontWeight.bold, fontSize:unreadCount!=0?18: 16, color: Colors.white),)),
                          if(unreadCount!=0)
                          Icon(Icons.circle, color: MyColors.whiteColor,size: 14,)
                        ],
                      ),
                      Text(Chat, style: TextStyle(fontSize:unreadCount!=0?14: 12, fontWeight:unreadCount!=0?FontWeight.w500: FontWeight.w300, color: Colors.white),)
                    ],
                  ),
                ),
              ],
            ),
          )
        ],
      ),
    );
  }
}
