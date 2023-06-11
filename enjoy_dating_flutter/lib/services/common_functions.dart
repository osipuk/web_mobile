import 'dart:convert';
import 'dart:developer';
import 'dart:io';
import 'package:Enjoy/services/api_urls.dart';
import 'package:http_parser/http_parser.dart';
import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:http/http.dart' as http;

import '../constants/colors.dart';
import 'alert.dart';
// const mainURL = 'https://webwiders.in/WEB01/cryptowebapp/Api/';
// const mainURL = 'http://bluediamondresearch.com/WEB01/Normal_Dating/Api/';
late BuildContext dialogContext;


Future postDataWithImage(data,api,successalert,erroralert,files) async {
  var url = Uri.parse(ApiUrls.baseUrl+api);
  print('file service----$files');
  //
  log(ApiUrls.baseUrl+api);
  var request = new http.MultipartRequest("POST", url);
  (data as Map<dynamic, dynamic>).forEach((key, value) {
    request.fields[key]=value;
    // print(value2);
  });

  if(files!=null){
    (files as Map<dynamic, dynamic>).forEach((key, value) async{
      request.files.add(await http.MultipartFile.fromPath(key, value.path)
      );
    });
  }

  print('request----file-------${request.files}');

  try {
    log(request.fields.toString());
    final streamedResponse = await request.send();
    final response = await http.Response.fromStream(streamedResponse);
    log(response.body);
    var u = jsonDecode(response.body);
    if(u['status']==1){
      if(successalert==1){
        presentToast(u['message']);
      }
    }
    else{
      if(erroralert==1) {
        presentToast(u['message']);
      }
    }
    return u;
    // return response;
  } catch (e) {
    print(e);
    return null;
    // return null;
  }
}


Future postData(data,api,successalert,erroralert) async {
  // log('this is post data')
  var url = Uri.parse(ApiUrls.baseUrl+api);
  log('api---$data'+url.toString());

  final response = await http.post(url,body:data);

  if (response.statusCode == 200) {

    var u = jsonDecode(response.body);
    log('this is post data---ab '+response.body.toString());
    if(u['status']==1){

      if(successalert==1){
        presentToast(u['message']);
      }
    }
    else {
      if(erroralert==1) {
        presentToast(u['message']);
      }
    }
    return u;
    // return response.body;
    log('post data from function'+response.body);
    // return parseProducts(response.body);
  } else {
    presentToast("Something went wrong! Please check your internet connection!");
    return {"success":0,"message":'Unable to post'};
    // throw Exception('Unable to fetch products from the REST API');
  }
}

Future postData2(data,api,successalert,erroralert) async {
  // log('this is post data')
  var url = Uri.parse(ApiUrls.baseUrl+api);
  log('api---'+url.toString());
  final response = await http.post(url,body:data);

  if (response.statusCode == 200) {

    var u = jsonDecode(response.body);
    log('this is post data---ab '+response.body.toString());
    if(u['status']==1){

      if(successalert==1){
        presentToast(u['message']);
      }
    }
    else{
      if(erroralert==1) {
        presentToast(u['message']);
      }
    }
    return u;
    // return response.body;
    log('post data from function'+response.body);
    // return parseProducts(response.body);
  } else {
    presentToast("Something went wrong! Please check your internet connection!");
    return {"success":0,"message":'Unable to post'};
    // throw Exception('Unable to fetch products from the REST API');
  }
}

Future getData(data,api,successalert,erroralert,{ bool showPrintConsole = false}) async {
  var str="?";
  (data as Map<dynamic, dynamic>).forEach((key, value) {
    str=str+key+"="+value+"&";
    // request.fields[key]=value;
    // print(value2);
  });

  str=str+"t=1";
  var url = Uri.parse(ApiUrls.baseUrl+api+str);
  if(showPrintConsole){
    log(ApiUrls.baseUrl+api+str);  
  }
  
  final response = await http.get(url);
  if(showPrintConsole){
    log('this is get  data--- ' + response.body);
  }
  if (response.statusCode == 200) {
    var u = jsonDecode(response.body);
    if(u['success']==1){
      if(successalert==1){
        presentToast(u['message']);
      }
    }
    else{
      if(erroralert==1) {
        presentToast(u['message']);
      }
    }
    return u;
    // return response.body;
    log('post data from function'+response.body);
    // return parseProducts(response.body);
  }
}

void loadingHide(context){
  Navigator.pop(dialogContext,true);
}

Future<dynamic> loadingShow(context){
  return  showDialog(
    context: context,
    barrierDismissible: false,
    builder: (context) {
      dialogContext = context;
      double h = MediaQuery.of(context).size.height;
      double w = MediaQuery.of(context).size.width;
      return Dialog(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
          insetPadding: EdgeInsets.all(10),

          elevation: 0,
          backgroundColor: Colors.transparent,
          child: Stack(
              clipBehavior: Clip.none,
              children:[
                Container(
                    width: double.infinity,
                    // height: 200,
                    child:
                    Padding(
                      padding:EdgeInsets.all(16),
                      child: ListView(
                        shrinkWrap: true,
                        children: <Widget>[
                          Row(
                            children: [
                              Container(
                                clipBehavior: Clip.none,
                                width:(MediaQuery.of(context).size.width - 70),
                                // padding:EdgeInsets.fromLTRB(0, 0, 20, 0),
                                child:SpinKitRing(
                                  color: Colors.lightBlueAccent,
                                  size: 50.0,
                                ),
                              )
                            ],
                          ),
                        ],
                      ),
                    )
                ),
              ]
          )

      );
    },
  ).then((exit) {
    if (exit == null) return;
  });







}

Future getListCurrency(symbol) async {

  var url = Uri.parse('https://www.fo.money/cryptowebapp/Api/currency?symbols=t'+symbol+'USD');

  final response = await http.get(url);
  log('this is get  data--- '+response.body);
  if (response.statusCode == 200) {
    var u = jsonDecode(response.body);
    return jsonDecode(u['data']);
    // return response.body;
    log('post data from function'+response.body);
    // return parseProducts(response.body);
  }
}

final spinkit = SpinKitFadingFour(
          itemBuilder: (BuildContext context, int index) {
            return DecoratedBox(
              decoration: BoxDecoration(
                color: MyColors.primaryColor,
              ),
            );
          },
        );