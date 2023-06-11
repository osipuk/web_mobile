import 'package:Enjoy/widget/custom_circular_image.dart';
import 'package:flutter/material.dart';

import '../constants/global_data.dart';
import '../constants/image_urls.dart';
import '../constants/sized_box.dart';
import '../modals/user_modal.dart';
import '../widget/CustomTexts.dart';
class VideoCallAnimationPage extends StatefulWidget {
  final String? giftUrl;
  const VideoCallAnimationPage({Key? key, this.giftUrl}) : super(key: key);

  @override
  State<VideoCallAnimationPage> createState() => _VideoCallAnimationPageState();
}

class _VideoCallAnimationPageState extends State<VideoCallAnimationPage> with SingleTickerProviderStateMixin{
  double height = 100;
  double opacity = 0;
  double width = 100;

  animate()async{
    width = 200;
    height = 200;
    opacity = 0.8;
    setState(() {

    });
  }

  @override
  void initState() {
    // TODO: implement initState
    Future.delayed(Duration(microseconds: 30)).then((as){
      animate();
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: ()async=> false,
      child: Dialog(
        // insetAnimationCurve: Curves.bounceInOut,
        // insetAnimationDuration: Duration(seconds: 2),
        insetPadding: EdgeInsets.symmetric(horizontal: 32),
        elevation: 0,
        backgroundColor: Colors.transparent,
        child: Container(
          height: 400,
          width: MediaQuery.of(context).size.width,
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              AnimatedContainer(
                duration: Duration(seconds: 2),
                curve: Curves.ease,
                height: height,
                // width: width,


                child: AnimatedOpacity(
                  opacity: opacity,
                  duration: Duration(seconds: 1),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Expanded(child:widget.giftUrl!=null?CustomCircularImage(imageUrl: widget.giftUrl!, width: height,fit: BoxFit.fill,) : Image.asset(userData!.gender==UserGender.male?MyImages.coins:MyImages.diamond, fit: BoxFit.fill,)),
                      vSizedBox,
                      SubHeadingText(widget.giftUrl!=null? '':userData!.gender==UserGender.male?'Coins deducted': 'Diamonds Received', color: Colors.yellow,),
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
