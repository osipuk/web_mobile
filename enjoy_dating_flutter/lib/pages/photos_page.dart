import 'package:carousel_slider/carousel_slider.dart';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../constants/colors.dart';
import '../constants/global_constants.dart';
import '../constants/global_data.dart';
import '../constants/global_keys.dart';
import '../constants/sized_box.dart';
import '../modals/media_modal.dart';
import '../services/api_urls.dart';
import '../services/webservices.dart';
import '../widget/appbar.dart';
import '../widget/solidBtn.dart';

class PhotosPage extends StatefulWidget {
  int selectedIndex;
  final List<ImageModal> images;
  final bool owner;
  PhotosPage({Key? key, required this.images, required this.selectedIndex,
    this.owner = true,
    }) : super(key: key);

  @override
  _PhotosPageState createState() => _PhotosPageState();
}

class _PhotosPageState extends State<PhotosPage> {
  PageController _pageController = PageController(viewportFraction: 1);
  Map? selectedMessage = reportReasonsList[0];
  List<Widget> indicators(imagesLength,currentIndex) {
    return List<Widget>.generate(imagesLength, (index) {
      return Container(
        margin: EdgeInsets.all(3),
        width: 10,
        height: 10,
        decoration: BoxDecoration(
            color: currentIndex == index ? MyColors.primaryColor : Colors.white,
            shape: BoxShape.circle),
      );
    });
  }

  @override
  void initState() {
    // TODO: implement initState
    _pageController = PageController(viewportFraction: 1, initialPage: widget.selectedIndex);
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: MyColors.secondary,
      appBar: appBar(context: context, title:   'All Photos', actions: [
        PopupMenuButton(
          // initialValue: '1',
          child: Center(
              child:Icon(Icons.more_vert,color: Colors.white,)),
          itemBuilder: (context) {
            return [
              PopupMenuItem(
                value: '1',
                child: Text('Report this Image',style: TextStyle(color: Colors.red),),
                onTap: () async{
                  // Navigator.pop(context);
                  await Future.delayed(Duration(milliseconds: 10));

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
                                    value: selectedMessage,
                                    icon: const Icon(Icons.keyboard_arrow_down_rounded),
                                    elevation: 16,
                                    style: const TextStyle(color: Colors.black),
                                    onChanged: (Map? newValue) {
                                      setState(() {
                                        selectedMessage = newValue!;
                                      });
                                    },
                                    items: List.generate(reportReasonsList.length, (index) => DropdownMenuItem<Map>(
                                      value: reportReasonsList[index],
                                      child: Text(reportReasonsList[index]['message']),
                                    ),),
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
                              SolidBtn(BtnText: 'Submit Report', BgColorTop: Colors.redAccent, BgColorBottom: Colors.red, ShadowColor: Color(0xFE1CDBC1), funcTap: ()async{
                                setState((){});
                                var request = {
                                  'report_to': userData!.id,
                                  'report_by': userData!.id,
                                  'message': selectedMessage!['message'],
                                  'report_type': '1',
                                  'content_id': widget.selectedIndex.toString(),
                                };
                                Navigator.pop(context);
                                var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.reportUser, request: request,showSuccessMessage: true );
                              }),
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

                  // await showModalBottomSheet(context: MyGlobalKeys.navigatorKey.currentContext!,isScrollControlled: true,backgroundColor: Colors.transparent, builder: (context){
                  //   return StatefulBuilder(
                  //     builder: (context, setState) {
                  //       return Container(
                  //         height: 500,
                  //         // padding: EdgeInsets.symmetric(horizontal: 16),
                  //         decoration: BoxDecoration(
                  //           color: MyColors.secondary,
                  //           borderRadius: BorderRadius.circular(14),
                  //         ),
                  //         child: Column(
                  //           children: [
                  //             vSizedBox2,
                  //             Padding(
                  //               padding: EdgeInsets.symmetric(horizontal: 16),
                  //               child: SubHeadingText('Please select why you are reporting this user.', color: Colors.white,),
                  //             ),
                  //             vSizedBox2,
                  //             Expanded(
                  //               child: ListView.builder(
                  //                 itemCount: reportReasonsList.length,
                  //                 itemBuilder: (context, index){
                  //                   return GestureDetector(
                  //                     onTap: ()async{
                  //                       selectedMessage = reportReasonsList[index];
                  //                       setState((){});
                  //                       var request = {
                  //                         'report_to': userData!.id,
                  //                         'report_by': userData!.id,
                  //                         'message': selectedMessage!['message'],
                  //                       };
                  //                       Navigator.pop(context);
                  //                       var jsonResponse = await Webservices.postData(apiUrl: ApiUrls.reportUser, request: request, context: MyGlobalKeys.navigatorKey.currentContext!,showSuccessMessage: true );
                  //                     },
                  //                     child: Container(
                  //                       height: 80,
                  //                       color:selectedMessage==reportReasonsList[index]? MyColors.primaryColor: null,
                  //                       margin: EdgeInsets.symmetric(vertical: 4),
                  //                       child: Center(
                  //                         child: ParagraphText(reportReasonsList[index]['message'], color: Colors.white,fontWeight: selectedMessage==reportReasonsList[index]? FontWeight.w700:null,),
                  //                       ),
                  //                     ),
                  //                   );
                  //                 },
                  //               ),
                  //             )
                  //           ],
                  //         ),
                  //       );
                  //     }
                  //   );
                  // });
                },
              ),
            ];
          },
        ),
      ]),
      body: Container(
        padding: EdgeInsets.symmetric(horizontal: 16, vertical: 30),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [

            SizedBox(
              height: MediaQuery.of(context).size.width,
              width: MediaQuery.of(context).size.width,
              child:   PageView.builder(
                  itemCount: widget.images.length,
                  pageSnapping: true,
                  controller: _pageController,
                  onPageChanged: (page) {
                    setState(() {
                      widget.selectedIndex = page;
                    });
                  },
                  itemBuilder: (context, pagePosition) {
                    return Container(
                      width: MediaQuery.of(context).size.width,
                      margin: EdgeInsets.symmetric(horizontal: 8, vertical: 8),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(MyGlobalConstants.kborderRadius),
                          image: DecorationImage(
                              image: NetworkImage(
                                  widget.images[pagePosition].image
                              ),
                              fit: BoxFit.cover
                          )
                      ),
                    );
                  }),
            ),
            vSizedBox2,
            Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: indicators(widget.images.length,widget.selectedIndex)),

          ],
        ),
      ),
    );
  }
}
