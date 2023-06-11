// import 'package:Enjoy/constants/navigation_functions.dart';
// import 'package:Enjoy/search_tab_page.dart';
// import 'package:Enjoy/tabs.dart';
// import 'package:Enjoy/widget/CustomTexts.dart';
// import 'package:Enjoy/widget/round_edged_button.dart';
// import 'package:flutter/cupertino.dart';
// import 'package:flutter/material.dart';
//
// import 'chat_detail_page.dart';
// import 'constants/sized_box.dart';
//
// class VideoCallPage extends StatefulWidget {
//   const VideoCallPage({Key? key}) : super(key: key);
//
//   @override
//   _VideoCallPageState createState() => _VideoCallPageState();
// }
//
// class _VideoCallPageState extends State<VideoCallPage> {
//
//
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       body: Stack (
//         children: [
//           Container (
//             padding: EdgeInsets.all(16),
//             height: double.infinity,
//             width: double.infinity,
//             decoration: const BoxDecoration (
//               image: DecorationImage (
//                   image: AssetImage("assets/lusie.png"),
//                   alignment: Alignment.topCenter,
//                   fit: BoxFit.cover,
//               ),
//             ),
//           ),
//           Align(
//             alignment: Alignment.bottomCenter,
//             child: Padding(
//               padding: EdgeInsets.all(16),
//               child:
//               Row(
//                 children: [
//                   Expanded(
//                     flex: 10,
//                     child: TextFormField(
//                       decoration: InputDecoration(
//                         fillColor: Colors.white,
//                         filled: true,
//                         focusedBorder: OutlineInputBorder(
//                           borderSide: BorderSide(color: Colors.white, width: 1),
//                           borderRadius: BorderRadius.circular(100),
//
//                         ),
//                         border: OutlineInputBorder(
//                           borderSide: BorderSide(color: Colors.white, width: 1),
//                           borderRadius: BorderRadius.circular(100),
//                         ),
//                         enabledBorder: OutlineInputBorder(
//                           borderSide: BorderSide(color: Colors.white, width: 1),
//                           borderRadius: BorderRadius.circular(100),
//                         ),
//                         hintText: 'Type a message',
//                         hintStyle: TextStyle(color: Colors.black, fontWeight: FontWeight.w300),
//                         contentPadding: EdgeInsets.symmetric(vertical: 20, horizontal: 16),
//                       ),
//                       style: TextStyle(color: Colors.black, fontFamily: 'Nunito', fontSize: 16, fontWeight: FontWeight.w400),
//                     ),
//                   ),
//                   SizedBox(width: 10,),
//                   Expanded(
//                     flex: 2,
//                     child: ElevatedButton(
//                       onPressed: ()=>{
//                         showModalBottomSheet<void>(
//                           backgroundColor: Colors.transparent,
//                           context: context,
//                           builder: (BuildContext context) {
//                             return Container(
//                               height: 450,
//                               decoration: BoxDecoration(
//                                   color: Color(0xFE7D44CF),
//                                   borderRadius: BorderRadius.circular(30)
//                               ),
//                               child: Column(
//                                 crossAxisAlignment: CrossAxisAlignment.center,
//                                 children: [
//                                   vSizedBox,
//                                   Column(
//                                     crossAxisAlignment:  CrossAxisAlignment.center,
//                                     children: [
//                                       Container(
//                                         height: 3,
//                                         width: 35,
//                                         decoration: BoxDecoration(
//                                             color: Color(0xFFe2e2e2),
//                                             borderRadius: BorderRadius.circular(2)
//                                         ),
//                                       ),
//                                     ],
//                                   ),
//                                   SizedBox(height: 15,),
//                                   Container(
//                                     padding: EdgeInsets.symmetric(horizontal: 50),
//                                     child: Row(
//                                       mainAxisAlignment: MainAxisAlignment.start,
//                                       children: [
//                                         Column(
//                                           children: [
//                                             ParagraphText('Basic', color: Colors.white,fontSize: 16,),
//                                             Container(
//                                               height: 2,
//                                               width: 25,
//                                               decoration: BoxDecoration(
//                                                   borderRadius: BorderRadius.circular(2),
//                                                   color: Colors.white
//                                               ),
//                                             )
//                                           ],
//                                         ),
//                                         SizedBox(width: 17,),
//                                         Column(
//                                           children: [
//                                             ParagraphText('Hot', color: Colors.white.withOpacity(0.50),fontSize: 16,),
//                                             // Container(
//                                             //   height: 2,
//                                             //   width: 25,
//                                             //   decoration: BoxDecoration(
//                                             //       borderRadius: BorderRadius.circular(2),
//                                             //       color: Colors.white
//                                             //   ),
//                                             // )
//                                           ],
//                                         ),
//                                         SizedBox(width: 17,),
//                                         Column(
//                                           children: [
//                                             ParagraphText('Popular', color: Colors.white.withOpacity(0.50), fontSize: 16,),
//                                             // Container(
//                                             //   height: 2,
//                                             //   width: 25,
//                                             //   decoration: BoxDecoration(
//                                             //       borderRadius: BorderRadius.circular(2),
//                                             //       color: Colors.white
//                                             //   ),
//                                             // )
//                                           ],
//                                         ),
//                                         SizedBox(width: 17,),
//                                         Column(
//                                           children: [
//                                             ParagraphText('Exclusive', color: Colors.white.withOpacity(0.50), fontSize: 16,),
//                                             // Container(
//                                             //   height: 2,
//                                             //   width: 25,
//                                             //   decoration: BoxDecoration(
//                                             //       borderRadius: BorderRadius.circular(2),
//                                             //       color: Colors.white
//                                             //   ),
//                                             // )
//                                           ],
//                                         ),
//                                         SizedBox(width: 17,),
//                                         Column(
//                                           children: [
//                                             ParagraphText('Love', color: Colors.white.withOpacity(0.50), fontSize: 16,),
//                                             // Container(
//                                             //   height: 2,
//                                             //   width: 25,
//                                             //   decoration: BoxDecoration(
//                                             //       borderRadius: BorderRadius.circular(2),
//                                             //       color: Colors.white
//                                             //   ),
//                                             // )
//                                           ],
//                                         ),
//                                       ],
//                                     ),
//                                   ),
//                                   vSizedBox2,
//
//                                   Row(
//                                     children: [
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/pizza.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/love.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/rock.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/rose.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       )
//                                     ],
//                                   ),
//                                   SizedBox(height: 20,),
//                                   Row(
//                                     children: [
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/sunflower.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//                                             Image.asset('assets/rolling.png', width: 50, height: 50,),
//                                             SizedBox(height: 10,),
//                                             Row(
//                                               mainAxisAlignment: MainAxisAlignment.center,
//                                               children: [
//                                                 Image.asset('assets/coin.png', width: 15,),
//                                                 SizedBox(width: 3,),
//                                                 Text('10', style: TextStyle(fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),),
//                                                 SizedBox(width: 16,)
//                                               ],
//                                             ),
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//
//                                           ],
//                                         ),
//                                       ),
//                                       Expanded(
//                                         flex: 3,
//                                         child: Column(
//                                           mainAxisAlignment: MainAxisAlignment.center,
//                                           children: [
//
//                                           ],
//                                         ),
//                                       )
//                                     ],
//                                   ),
//                                   SizedBox(height: 90,),
//                                   Row(
//                                     mainAxisAlignment: MainAxisAlignment.center,
//                                     children: [
//                                       Image.asset('assets/coin.png', width: 20,),
//                                       SizedBox(width: 3,),
//                                       Text('89', style: TextStyle(fontSize: 16, color: Colors.white, fontWeight: FontWeight.bold),),
//                                       SizedBox(width: 16,)
//                                     ],
//                                   ),
//                                   SizedBox(height: 5,),
//                                   Padding(
//                                     padding: const EdgeInsets.symmetric(horizontal: 16.0),
//                                     child: RoundEdgedButton (
//                                         text: 'Recharge',
//                                     ),
//                                   )
//                                 ],
//                               ),
//                             );
//                           },
//                         )
//                       },
//                       style: ElevatedButton.styleFrom(
//                         padding: EdgeInsets.all(13),
//                         elevation: 0,
//                         shape: new RoundedRectangleBorder(
//                           borderRadius: new BorderRadius.circular(100.0),
//                         ),
//                       ),
//
//                       child: Image.asset('assets/gift.png'),
//                     ),
//                   ),
//                 ],
//               ),
//             )
//           ),
//           Align (
//             alignment: Alignment.bottomCenter,
//             child: Padding(
//               padding: EdgeInsets.only(bottom: 90, left: 30),
//               child: Row(
//                 crossAxisAlignment: CrossAxisAlignment.end,
//                 mainAxisAlignment: MainAxisAlignment.start,
//                 children: [
//                   Column(
//                     mainAxisAlignment: MainAxisAlignment.end,
//                     crossAxisAlignment: CrossAxisAlignment.start,
//                     children: [
//                       RichText(
//                         text: TextSpan (
//                             text: 'Rosella:',
//                             style: TextStyle(color: Colors.white, fontFamily: 'Nunito', fontWeight: FontWeight.w400),
//                             children: const <TextSpan> [
//                               TextSpan(text: ' Please follow my profile', style: TextStyle(color: Color(0xFEFFC107), fontWeight: FontWeight.bold))
//                             ]
//                         ),
//                       ),
//                       SizedBox(height: 10,),
//                       RichText(
//                         text: TextSpan(
//                             text: 'John Doe:',
//                             style: TextStyle(color: Colors.white, fontFamily: 'Nunito', fontWeight: FontWeight.w400),
//                             children: const <TextSpan> [
//                               TextSpan(text: ' Yes', style: TextStyle(color: Color(0xFEFFC107), fontWeight: FontWeight.bold))
//                             ]
//                         ),
//                       ),
//                       SizedBox(height: 10,),
//                       RichText(
//                         text: TextSpan(
//                             text: 'Rosella:',
//                             style: TextStyle(color: Colors.white, fontFamily: 'Nunito', fontWeight: FontWeight.w400),
//                             children: const <TextSpan> [
//                               TextSpan(text: ' Do you have Facebook?', style: TextStyle(color: Color(0xFEFFC107), fontWeight: FontWeight.bold))
//                             ]
//                         ),
//                       ),
//                     ],
//                   )
//                 ],
//               )
//             ),
//           ),
//           Positioned(
//             top: 38,
//             right: 10,
//             child: Column(
//
//               children: [
//                 // Image.asset('assets/self-video.png', width: 80, height: 130, fit: BoxFit.cover,),
//                 Container(
//                   width: 90,
//                   height: 135,
//                   decoration: new BoxDecoration(
//                       borderRadius: BorderRadius.only(
//                         topLeft: Radius.circular(10),
//                         topRight: Radius.circular(10),
//                       ),
//                       image: new DecorationImage(
//                           fit: BoxFit.fill,
//                           image: AssetImage('assets/self-video.png')
//                       )
//                   ),
//                   child: Column(
//                     crossAxisAlignment: CrossAxisAlignment.center,
//                     mainAxisAlignment: MainAxisAlignment.end,
//                     children: [
//                       Container(
//                         child: Text('03:29', style: TextStyle(color: Colors.white, fontFamily: 'medium', fontSize: 15),),
//                         padding: EdgeInsets.all(7),
//                       )
//                     ],
//                   ),
//                 ),
//                 ElevatedButton(
//                   onPressed: (){
//                     push(context: context, screen: tabs_second_page());
//                   },
//                   style: ElevatedButton.styleFrom(
//                     shape: RoundedRectangleBorder(
//                         borderRadius: BorderRadius.only(
//                           bottomLeft: Radius.circular(10),
//                           bottomRight: Radius.circular(10),
//                         )
//                     ),
//                     primary: Color(0xFEFF5858),
//                     elevation: 0,
//                     minimumSize: Size(90, 25),
//                     tapTargetSize: MaterialTapTargetSize.shrinkWrap
//                   ),
//                   child: Container(
//                     child: Text('End Call', style: TextStyle(fontFamily: 'regular', fontSize: 10,),),
//                   ),
//                 )
//               ],
//             ),
//           )
//         ],
//       ),
//     );
//   }
// }
