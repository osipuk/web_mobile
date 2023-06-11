// import 'package:Enjoy/chat_detail_page.dart';
// import 'package:Enjoy/constants/colors.dart';
// import 'package:Enjoy/constants/navigation_functions.dart';
// import 'package:Enjoy/constants/sized_box.dart';
// import 'package:Enjoy/widget/CustomTexts.dart';
// import 'package:Enjoy/widget/block_layout.dart';
// import 'package:Enjoy/widget/solidBtn.dart';
// import 'package:flutter/material.dart';
//
//
// class Recent_Page extends StatefulWidget {
//   const Recent_Page({Key? key}) : super(key: key);
//   @override
//   _Recent_PageState createState() => _Recent_PageState();
// }
//
// class _Recent_PageState extends State<Recent_Page> {
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       body: Stack(
//         children: [
//           SingleChildScrollView(
//             child: Container(
//               height: MediaQuery.of(context).size.height,
//               decoration: BoxDecoration(
//                   gradient: LinearGradient(
//                     begin: Alignment.topCenter,
//                     end: Alignment.bottomCenter,
//                     colors: [
//                       Color(0xFE7D44CF),
//                       Color(0xFE00B199)
//                     ],
//                   )
//               ),
//               child: Container(
//                 child: Column(
//                   crossAxisAlignment: CrossAxisAlignment.start,
//                   children: [
//                     vSizedBox6,
//                     Container(
//                       padding: EdgeInsets.symmetric(horizontal: 50),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.center,
//                         children: [
//                                 Column(
//                                   children: [
//                                     ParagraphText('Recent', color: Colors.white,fontSize: 16,),
//                                     Container(
//                                       height: 2,
//                                       width: 25,
//                                       decoration: BoxDecoration(
//                                         borderRadius: BorderRadius.circular(2),
//                                         color: Colors.white
//                                       ),
//                                     )
//                                   ],
//                                 ),
//                                hSizedBox4,
//                           Column(
//                             children: [
//                               ParagraphText('Missed Call', color: Colors.white.withOpacity(0.50),fontSize: 16,),
//                               // Container(
//                               //   height: 2,
//                               //   width: 25,
//                               //   decoration: BoxDecoration(
//                               //       borderRadius: BorderRadius.circular(2),
//                               //       color: Colors.white
//                               //   ),
//                               // )
//                             ],
//                           ),
//                                hSizedBox4,
//                           Column(
//                             children: [
//                               ParagraphText('Matches', color: Colors.white.withOpacity(0.50), fontSize: 16,),
//                               // Container(
//                               //   height: 2,
//                               //   width: 25,
//                               //   decoration: BoxDecoration(
//                               //       borderRadius: BorderRadius.circular(2),
//                               //       color: Colors.white
//                               //   ),
//                               // )
//                             ],
//                           ),
//                         ],
//                       ),
//                     ),
//                     vSizedBox4,
//                     Padding(
//                       padding: const EdgeInsets.symmetric(horizontal: 16.0),
//                       child: Column(
//                         children: [
//                           for(var i=0; i<5; i++)
//                             Column(
//                               children: [
//                                 GestureDetector(
//                                   onTap: (){
//                                     // push(context: context, screen: Chat_Detail_Page());
//                                   },
//                                   child: BlockLayout(
//                                     PersonName: 'Rosella William',
//                                     Chat: 'How are you?',
//                                     ImagePath: 'assets/chat_person.png',
//                                     isIcon: true,
//                                   ),
//                                 ),
//                                 vSizedBox
//                               ],
//                             ),
//                         ],
//                       ),
//                     ),
//
//
//                   ],
//                 ),
//               ),
//             ),
//           ),
//         ],
//       ),
//     );
//   }
// }
