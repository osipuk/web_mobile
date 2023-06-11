import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/global_keys.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/widget/CustomTexts.dart';
import 'package:Enjoy/widget/custom_text_field.dart';
import 'package:Enjoy/widget/solidBtn.dart';
import 'package:flutter/material.dart';


class Chat_Detail_Page extends StatefulWidget {
  const Chat_Detail_Page({Key? key}) : super(key: key);

  @override
  _Chat_Detail_PageState createState() => _Chat_Detail_PageState();
}

class _Chat_Detail_PageState extends State<Chat_Detail_Page> {
  String dropdownValue = 'I dont like this user';
  TextEditingController message = TextEditingController();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      extendBody: true,
     appBar: AppBar(
        backgroundColor: Colors.transparent,
        leading: IconButton(
          icon: Icon(Icons.arrow_back_ios_new, color: Colors.white,),
          onPressed: () => {
            Navigator.pop(context)
          },
        ),
        title: Text('Rosella William', style: TextStyle(color: Colors.white, fontSize: 16, fontFamily: 'semibold'),),
        centerTitle: true,
        shadowColor: Colors.transparent,
        shape: Border(
            bottom: BorderSide(
                color: Colors.white.withOpacity(0.50),
                width: 0.2
            )
        ),
       actions: [
         IconButton(
             onPressed: (){

             },
             icon: Icon(Icons.videocam_outlined)
         ),
         PopupMenuButton(
           icon: Icon(Icons.more_vert),
           color: Colors.white,
           offset: Offset(0, 50),
           shape: RoundedRectangleBorder(
             borderRadius: BorderRadius.all(Radius.circular(8.0)),
             side: BorderSide(
               color: Color(0xFEC4C4C4),
               width: 1.0,
             ),
           ),
           itemBuilder:(context) => [
             PopupMenuItem(
               onTap: () async{
                 // Navigator.pop(context);
                 await Future.delayed(Duration(milliseconds: 100));
                 showDialog(
                   context: MyGlobalKeys.navigatorKey.currentContext!,
                   builder: (BuildContext context) => SimpleDialog(
                     backgroundColor: Colors.transparent,
                     // title:const Text('GeeksforGeeks'),
                     children: [
                       Container(
                         width: 350,
                         padding: EdgeInsets.all(25),
                         decoration: BoxDecoration(
                             borderRadius: BorderRadius.circular(20),
                             color: Color(0xFE1CDBC1),
                             boxShadow: [BoxShadow(
                                 color: Color(0xFE1CDBC1).withOpacity(0.5),
                                 spreadRadius: 10
                             )]
                         ),
                         child: Column(
                           children: [
                             Row(
                               children: [
                                 Text('Report', style: TextStyle(fontFamily: 'extrabold', color: Colors.white, fontSize: 35),)
                               ],
                               mainAxisAlignment: MainAxisAlignment.center,
                             ),
                             vSizedBox4,
                             Row(
                               children: [
                                 Text('Select Reason: ', style: TextStyle(fontFamily: 'regular', color: Colors.white, fontSize: 12),),
                               ],
                               mainAxisAlignment: MainAxisAlignment.start,
                             ),
                             vSizedBox,
                             Container(
                               child: DropdownButtonHideUnderline(
                                 child: DropdownButton(
                                   value: dropdownValue,
                                   icon: const Icon(Icons.keyboard_arrow_down_rounded),
                                   elevation: 16,
                                   style: const TextStyle(color: Colors.black),
                                   onChanged: (String? newValue) {
                                     setState(() {
                                       dropdownValue = newValue!;
                                     });
                                   },
                                   items: <String>['I dont like this user', 'Nudity & inappropriate content', 'Spam and Fraud', 'Verbal Harassment', 'Black Screen', 'Fake Gender', 'Money Request', 'Contact outside Enjoy club']
                                       .map<DropdownMenuItem<String>>((String value) {
                                     return DropdownMenuItem<String>(
                                       value: value,
                                       child: Text(value),
                                     );
                                   }).toList(),
                                   isExpanded: true,
                                 ),
                               ),
                               padding: EdgeInsets.symmetric(vertical: 5, horizontal: 10),
                               decoration: ShapeDecoration(
                                 color: Colors.white,
                                 shape: RoundedRectangleBorder(
                                   borderRadius: BorderRadius.all(Radius.circular(100)),
                                 ),
                               ),
                             ),
                             vSizedBox4,
                             SolidBtn(BtnText: 'Submit Report', BgColorTop: Colors.redAccent, BgColorBottom: Colors.red, ShadowColor: Color(0xFE1CDBC1), funcTap: (){}),
                             vSizedBox2,
                             GestureDetector(
                               onTap: (){Navigator.of(context, rootNavigator: true).pop();},
                               child: Row(
                                 mainAxisAlignment: MainAxisAlignment.center,
                                 children: [
                                   Text('Cancel', style: TextStyle(fontFamily: 'regular', fontSize: 14, color: Colors.white),)
                                 ],
                               ),
                             )
                           ],
                         ),
                       )
                     ],
                   ),
                 );
               },
               child: Row(
                 children: [
                   SizedBox(width: 10,),
                   Text('Report', style: TextStyle(color: Colors.black, fontFamily: 'semibold', fontSize: 14),)
                 ],
               ),
               value: 1,
             ),
             PopupMenuItem(
               onTap: () {
                 print('lkfshjdklf');
               },
               child: Row(
                 children: [
                   SizedBox(width: 10,),
                   Text('Block', style: TextStyle(color: Colors.red, fontFamily: 'semibold', fontSize: 14),)
                 ],
               ),
               value: 2,
             ),
           ]
         ),
       ],
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              height: MediaQuery.of(context).size.height,
              width: MediaQuery.of(context).size.width,
              padding: EdgeInsets.symmetric(horizontal: 16),
              decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Color(0xFE7D44CF),
                      Color(0xFE00B199)
                    ],
                  )
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  vSizedBox8,
                  vSizedBox4,
                  Stack(
                    clipBehavior: Clip.none,
                    children: [
                      Container(
                        margin: EdgeInsets.only(left: 9.5),
                        width: MediaQuery.of(context).size.width - 60,
                        padding: EdgeInsets.only(left: 32, right: 32, top: 12, bottom: 12),
                        // height: 20,
                        decoration: const BoxDecoration(
                          color: Color(0xFFF8F8F8),
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(16),
                            topRight: Radius.circular(16),
                            bottomRight: Radius.circular(16),
                            bottomLeft: Radius.circular(0)
                          )
                        ),
                        child:ParagraphText('Hi Abiola, any progress on the project? We need a link for standup.',
                          color: MyColors.primaryColor,)
                      ),
                      Positioned(
                        left: -2,
                          bottom: 0,
                          child: Image.asset('assets/left_subtract.png', height: 20,)
                      ),
                    ],
                  ),
                  vSizedBox,
                  Stack(
                    clipBehavior: Clip.none,
                    children: [
                      Container(
                          margin: EdgeInsets.only(left: 40, right: 9),
                          // width: MediaQuery.of(context).size.width - 60,
                          padding: EdgeInsets.only(left: 32, right: 32, top: 12, bottom: 12),
                          // height: 20,
                          decoration: const BoxDecoration(
                              color: Color(0xFF14CBB2),
                              borderRadius: BorderRadius.only(
                                  topLeft: Radius.circular(16),
                                  topRight: Radius.circular(16),
                                  bottomRight: Radius.circular(0),
                                  bottomLeft: Radius.circular(16)
                              )
                          ),
                          child:ParagraphText('Hi Demola!\nYes, I j kjhf ks djfkls\n fkjsl kfjkls\n lasflkjsd fsh h kaskl jl j k jkls fkl  klsfj kla flk\n kl jklasjust finished developing the "Chat" template.',
                            color: MyColors.whiteColor,)
                      ),

                      Positioned(
                          right: 1,
                          bottom: -0.10,
                          child: Image.asset('assets/right_subtract.png', height: 20,)
                      ),
                    ],
                  ),



                ],
              ),
            ),
          ),
          Align(
            alignment: Alignment.bottomCenter,
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Container(
                height: 50,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                     children: [
                       Image.asset('assets/mdi_camera.png', height: 25,),
                       hSizedBox,
                       Expanded(
                           child: CustomTextField(
                               preffix: Padding(
                                 padding: const EdgeInsets.symmetric(vertical: 10.0, horizontal: 0),
                                 child: Image.asset('assets/gift.png', height: 24,),
                               ),
                               verticalPadding: 0,
                               controller: message,
                               fontsize: 14,
                               bgColor: Colors.white,
                               hintText: 'dType a message',
                             borderRadius: 30,
                             border: Border.all(color: const Color(0xFF7D44CF)),
                           )
                       ),
                       hSizedBox,
                       Image.asset('assets/voice.png', height: 25,),
                     ],
                ),
              ),
            ),
          )

        ],
      ),
    );
  }
}
