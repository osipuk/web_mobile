import 'package:Enjoy/constants/colors.dart';
import 'package:Enjoy/constants/navigation_functions.dart';
import 'package:Enjoy/constants/sized_box.dart';
import 'package:Enjoy/services/auth.dart';
import 'package:Enjoy/services/common_functions.dart';
import 'package:Enjoy/single.dart';
import 'package:Enjoy/video_call.dart';
import 'package:Enjoy/widget/Customeloader.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Follower_list extends StatefulWidget {
  final String user_id;
  const Follower_list({Key? key, required this.user_id}) : super(key: key);

  @override
  _Follower_listState createState() => _Follower_listState();
}

class _Follower_listState extends State<Follower_list> {
  List lists = [];
  bool load = false;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    get_list();
  }

  get_list() async {
    setState(() {
      load = true;
    });
    Map data = {'user_id': widget.user_id.toString(), 'status': 'follower'};
    Map res = await getData(data, 'myFollower', 0, 0);
    print('res-----$res');
    if(res['status'].toString()=='1'){
      lists=res['data'];
      setState(() {

      });
    } else {
      lists=[];
    }
    setState(() {
      load = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: new Text('Follower'),
        centerTitle: true,
        backgroundColor: MyColors.primaryColor,
        leading: Builder(
          builder: (BuildContext context) {
            return IconButton(
              icon: const Icon(Icons.arrow_back_ios_new),
              onPressed: () {
                Navigator.pop(context);
              },
              tooltip: MaterialLocalizations.of(context).openAppDrawerTooltip,
            );
          },
        ),
      ),
      body: load?CustomLoader():Stack(
        children: [

          Container(
            decoration: BoxDecoration(
                gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [Color(0xFE1CDBC1), Color(0xFE1F66BA)],
            )),
            child: Container(
              width: MediaQuery.of(context).size.width,
              margin: EdgeInsets.only(top: 16),
              padding: EdgeInsets.all(16),
              child: SingleChildScrollView(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    // SizedBox(height: 35,),
                    // Text('Follower', style: TextStyle(fontSize: 27, color: Colors.white, fontWeight: FontWeight.bold, letterSpacing: 2),),
                    // SizedBox(height: 25,),
                    // for()
                    for(int i=0;i<lists.length;i++)
                    Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: GestureDetector(
                        onTap: ()async {
                          push(context: context, screen: Single_Page(user_id:lists[i]['id']));
                          get_list();
                        },
                        child: Container(
                          padding:
                              EdgeInsets.symmetric(vertical: 10, horizontal: 10),
                          decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(16),
                              color: Color(0xFE4AB5E1)),
                          child: Row(
                            children: [
                              Expanded(
                                flex: 3,
                                child: ClipRRect(
                                  child: Image.network(
                                    lists[i]['image'],
                                    width: 90,
                                    height: 85,
                                    fit: BoxFit.cover,
                                  ),
                                  borderRadius: BorderRadius.circular(50),
                                ),
                              ),
                              SizedBox(
                                width: 20,
                              ),
                              Expanded(
                                flex: 8,
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      '${lists[i]['name']}',
                                      style: TextStyle(
                                          fontWeight: FontWeight.bold,
                                          fontSize: 20,
                                          color: Colors.white),
                                    ),
                                    SizedBox(
                                      height: 5,
                                    ),
                                    Row(
                                      children: [
                                        (lists[i]['country_flag']!=null)?
                                        Image.network(
                                          lists[i]['country_flag'],
                                          width: 18,
                                        ):Image.asset('assets/usa.png',width: 18,),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          '${lists[i]['gender']}, ${lists[i]['age']}',
                                          style: TextStyle(
                                              fontSize: 14,
                                              fontWeight: FontWeight.w300,
                                              color: Colors.white),
                                        )
                                      ],
                                    )
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    if(!load&&lists.length==0)
                    Center(
                      child: new Text('No follower yet.',style:TextStyle(color: Colors.white)),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
