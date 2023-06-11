import 'package:Enjoy/account.dart';
import 'package:Enjoy/services/firebase_push_notifications.dart';
import 'package:Enjoy/signin.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:carousel_slider/carousel_slider.dart';

class WelcomeScreen extends StatefulWidget {
  const WelcomeScreen({Key? key}) : super(key: key);

  @override
  _WelcomeScreenState createState() => _WelcomeScreenState();
}

final List<String> imgList = [
  'assets/slide-1.png',
  'assets/slide-2.png',
  'assets/slide-3.png',
];

// final List<Widget> imageSliders = imgList
//     .map((item) => Container(
//       child: Column(
//         mainAxisAlignment: MainAxisAlignment.center,
//         children: [
//           Image.asset(item, fit: BoxFit.contain, height: 300,),
//         ],
//       ),
//     ))
//     .toList();

class _WelcomeScreenState extends State<WelcomeScreen> {
  int _current = 0;
  final CarouselController _controller = CarouselController();
  // List<Slide> slides = [];

  @override
  void initState() {
    // TODO: implement initState
    // FirebasePushNotifications.firebaseSetup();
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFE7D44CF),
      body: Stack(
        children: [

          Container(
            decoration: BoxDecoration(
              image: DecorationImage(
                image: AssetImage("assets/welcome-bg.png"),
                fit: BoxFit.cover,
              ),
            ),
            child: Column(
              children: [
                SizedBox(height: 100,),
                CarouselSlider(
                  items: imgList.map((item) {
                    return Builder(
                      builder: (BuildContext context) {
                        return Container(
                          // margin: EdgeInsets.symmetric(horizontal: 20.0),
                            decoration: BoxDecoration(
                              // color: Colors.amber
                            ),
                            child: Image.asset(item, fit: BoxFit.contain,)
                        );
                      },
                    );
                  }).toList(),
                  carouselController: _controller,
                  options: CarouselOptions(
                      height: 400,
                      enlargeCenterPage: true,
                      aspectRatio: 1,
                      autoPlay: true,
                      autoPlayInterval: Duration(seconds: 4),
                      viewportFraction: 0.64,
                      onPageChanged: (index, reason) {
                        setState(() {
                          _current = index;

                        });
                      }),
                ),
                Column(
                  children: [
                    Container(
                      padding: _current==0? EdgeInsets.symmetric(horizontal: 30):_current==1? EdgeInsets.symmetric(horizontal: 60): EdgeInsets.symmetric(horizontal: 30),
                      child: RichText(
                        textAlign: TextAlign.center,
                        text: TextSpan(
                          text:_current==0? 'Easily meet people you like on ':_current==1?'Find the people who':'Don’t wait anymore! Find out your',
                          style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, fontFamily: 'Nunito'),
                          children: [
                            TextSpan(
                                text:_current==0 ? 'video calls and Chat': _current==1?' match': ' perfect match', style: TextStyle(color: Color(0xFE1CDBC1))
                            ),
                            TextSpan(
                                text:_current==0 ? '': _current==1?' with you': ' now', style: TextStyle(color: Colors.white)
                            ),
                          ],
                        ),
                      ),
                    ),
                    SizedBox(height: 30,),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: imgList.asMap().entries.map((entry) {
                        return GestureDetector(
                          onTap: () => _controller.animateToPage(entry.key),
                          child: Container(
                            width: 6.0,
                            height: 6.0,
                            margin: EdgeInsets.symmetric(vertical: 8.0, horizontal: 4.0),
                            decoration: BoxDecoration(
                                shape: BoxShape.circle,
                                color: (Theme.of(context).brightness == Brightness.light ? Color(0xFEF0F0F0) : Color(0xFE000000)).withOpacity(_current == entry.key ? 0.5 : 1)
                            ),
                          ),
                        );
                      }).toList(),
                    ),


                  ],
                ),
              ],
            ),

          ),
          Align(
            alignment: Alignment.bottomCenter,
            child: Column(
              mainAxisAlignment: MainAxisAlignment.end,
              children: [
                GestureDetector(
                  onTap: () => {_controller.jumpToPage(2)},
                  child: Container(
                    child: Text(_current == 0 ? 'Skip' : _current == 1 ? 'Skip' : '', style: TextStyle(color: Colors.white, fontSize: 17),),
                  ),
                ),
                Container(
                  height: 42,
                  margin: EdgeInsets.only(left: 16, right: 16, bottom: 40, top: 30),
                  decoration: BoxDecoration(
                    boxShadow: [BoxShadow(
                        color: Color(0xFE1CDBC1).withOpacity(0.5),
                        offset: Offset(0, 0),
                        spreadRadius: 8
                    )],
                    borderRadius: BorderRadius.circular(100),
                    gradient: LinearGradient(
                      begin: Alignment.topCenter,
                      end: Alignment.bottomCenter,
                      stops: [0.0, 1.0],
                      colors: [
                        Color(0xFE1CDBC1),
                        Color(0xFE12C7AE),
                      ],
                    ),
                  ),
                  child: ElevatedButton(
                    onPressed:() {
                      if(_current == 0){
                        _controller.nextPage(duration: Duration(milliseconds: 300) ,curve: Curves.linear);
                      }
                      else if(_current == 1){
                        _controller.nextPage(duration: Duration(milliseconds: 300), curve: Curves.linear);
                      }
                      else if(_current == 2){
                        Navigator.push(context, MaterialPageRoute(builder: (context) => AccountPage()));
                      }
    },
                    style: ElevatedButton.styleFrom(
                        primary: Colors.transparent,
                        onSurface: Colors.transparent,
                        shadowColor: Colors.transparent,
                        shape: StadiumBorder()
                    ),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Text(_current == 0 ? 'Next' : _current == 1 ? 'Next' : 'Let\'s get started', style: TextStyle(fontSize: 17, fontWeight: FontWeight.w700, color: Colors.white),)
                      ],
                    ),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }
}
