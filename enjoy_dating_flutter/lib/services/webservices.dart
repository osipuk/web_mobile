import 'dart:convert' as convert;
import 'dart:developer';
import 'dart:io';
import 'package:Enjoy/constants/global_data.dart';
import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;

import '../widget/showSnackbar.dart';
import 'api_urls.dart';

class Webservices {
  static Future<http.Response> getData(String url) async {
    http.Response response =
        http.Response('{"message":"failure","status":0}', 404);
    log('called $url');
    try {
      response = await http.get(
        Uri.parse(url),headers: headers(),
      );
      log(response.body);
    } catch (e) {
      // showSnackbar(context, text)
      log('Error in $url : ------ $e');
    }
    return response;
  }

  static Future<Map<String, dynamic>> postData(
      {required String apiUrl,
        required Map request,
        bool showSuccessMessage = false,
        bool showErrorMessage = true,
        }) async {
    http.Response response =
    http.Response('{"message":"failure","status":0}', 404);
    try {
      log('the request for ---------898--------$apiUrl is $request');
      print('eee');
      response = await http.post(Uri.parse(apiUrl), body: request,headers: headers(),);
      print('the response ${response.statusCode} of ${response.body}');
      if (response.statusCode == 200) {
        print('dkfhsk');
        var jsonResponse = convert.jsonDecode(response.body);
        print('sdfsdfsd');
        log('the response for $apiUrl is $jsonResponse');
        if (jsonResponse['status'] == 1) {
          if(showSuccessMessage)
            showSnackbar(jsonResponse['message'].toString());
          return jsonResponse;
        } else {
          if(showErrorMessage){
            showSnackbar( jsonResponse['message'].toString());
          }
        }
        return jsonResponse;
      }
      else{
        log('The response for $apiUrl is ${response.statusCode} and ${response.body}');
        if(showErrorMessage){
          showSnackbar('Some Error occured. Please try again later');
        }
      }
    } catch (e) {
      log('Error in response -888---------$apiUrl : ------ $e');
    }
    return {"status": 0, "message": "Please try again later."};
  }

  // static Future<http.Response> postMultipartData({required String url, required Map<String, dynamic> request})async{
  //   http.Response response = http.Response('{"message":"failure","status":0}', 404);
  //   try{
  //     log('the request for $url is $request');
  //     response = await http.post(
  //         Uri.parse(url),
  //         body: request
  //     );
  //   }
  //   catch(e){
  //     log('Error in $url : ------ $e');
  //   }
  //   return response;
  // }

  static Future<List> getList(String url) async {
    var response = await getData(url);
    if (response.statusCode == 200) {
      var jsonResponse = convert.jsonDecode(response.body);
      if (jsonResponse['status'] == 1) {
        log('the response for url: $url is ${jsonResponse}');
        return jsonResponse['data']??[];
      } else {
        log('Error in response for url $url -----${response.body}');
      }
    }
    return [];
  }
  static Future<List> getListFromRequestParameters(String apiUrl, Map<String, dynamic> request,{ bool isGetMethod = true} ) async {

    Map<String, dynamic> tempRequest = {};
    request.forEach((key, value) {
      if(value!=null){
        tempRequest['$key'] = value;
      }
    });
    try{
      log('the request for url $apiUrl is $tempRequest');
      String tempGetRequest = '?';
      tempRequest.forEach((key, value) {
        tempGetRequest +=key+'=' + value + '&';

      });
      tempGetRequest = tempGetRequest.substring(0,tempGetRequest.length-1);
      print('the url issss $apiUrl$tempGetRequest');
      late http.Response response;
      if(isGetMethod){
        response = await http.get(Uri.parse(apiUrl + tempGetRequest),headers: headers(),);
      }else{
        response = await http.post(Uri.parse(apiUrl), body: tempRequest,headers: headers(),);
      }
      if (response.statusCode == 200) {
        var jsonResponse = convert.jsonDecode(response.body);
        if (jsonResponse['status'] == 1) {
          log('the respognse for url: $apiUrl is ${jsonResponse}');
          return jsonResponse['data'] ?? [];
        } else {
          log('Error in response for url $apiUrl -----${response.body}');
        }
      }else{
        print('error in status code ${response.statusCode}');
        log('The response for url ${apiUrl} with status code ${response.statusCode} is ${response.body}');
      }
    }catch(e){
      print('inside catch block. Error in getting response for search doctors $e');
    }

    return [];
  }


  static Future<Map<String, dynamic>> getMap(String url, {Map<String, dynamic>? request}) async {

    Map<String, dynamic> tempRequest = {};
    if(request!=null){
      request.forEach((key, value) {
        if(value!=null){
          tempRequest['$key'] = value;
        }
      });
    }
    try{
      log('the request for url $url is $tempRequest');
      late http.Response response;
      if(request==null){
        response = await http.get(Uri.parse(url),headers: headers(),);
      }else{
        response = await http.post(Uri.parse(url), body: tempRequest,headers: headers(),);
      }
      if (response.statusCode == 200) {
        var jsonResponse = convert.jsonDecode(response.body);
        if (jsonResponse['status'].toString() == '1') {
          log('the respognse for url: $url is ${jsonResponse}');
          return jsonResponse['data'] ?? jsonResponse['content']??jsonResponse;
        } else {
          log('Error in response for url $url -----${response.body}');
        }
      }else{
        print('error in status code ${response.statusCode}');
        log(response.body);
      }
    }catch(e){
      print('inside catch block 546745 $e');
    }

    return {};
  }

  static Future<Map<String, dynamic>> postDataWithImageFunction({
    required Map<String, dynamic> body,
    required Map<String, File> files,
    required BuildContext context,

    /// endpoint of the api
    required String endPoint,
    bool successAlert = false,
    bool errorAlert = true,
  }) async {
    print('the request is $body and files are $files');
    var url = Uri.parse(endPoint);
    //
    log(endPoint);
    try {
    var request = new http.MultipartRequest("POST", url,);
    body.forEach((key, value) {
      request.fields[key] = value;
      // log(value2);
    });

    if (files != null) {
      (files as Map<dynamic, dynamic>).forEach((key, value) async {
        request.files.add(await http.MultipartFile.fromPath(key, value.path,));
      });
    }


      log(request.fields.toString());
      final streamedResponse = await request.send();
      final response = await http.Response.fromStream(streamedResponse);
      log('the response for $endPoint is ${response.body}');
      var jsonResponse = convert.jsonDecode(response.body);

      if (jsonResponse['status'] == 1) {
        if (successAlert) {
          // showSnackbar(context, jsonResponse['message']);
        }
      } else {
        if (errorAlert) {
          // showSnackbar(context, jsonResponse['message']);
        }
      }
      return jsonResponse;
      // return response;
    } catch (e) {
      print(e);
      try{
        var response = await http.post(
          url,
          body: body,headers: headers(),
        );
        if(response.statusCode==200){
          var jsonResponse = convert.jsonDecode(response.body);
          return jsonResponse;
        }
      }catch(error){
        print('inside double catch block $error');
      }
      return {'status': 0, 'message': "fail"};
      // return null;
    }
  }
  static Future<void> updateDeviceToken({
    required String userId,
    required String token,
  }) async {
    var request = {
      "user_id": userId,
      "id": userId,
      "device_id": token,
    };
    print('the device token request for url ${ApiUrls.updateDeviceToken} is $request');
    try {
      var response = await http.post(
        Uri.parse(ApiUrls.updateDeviceToken),
        body: request,headers: headers(),
      );
      if (response.statusCode == 200) {
        print('the device token is updated');
        print(response.body);
      } else {

        print('error in device token with status code ${response.statusCode}');
        log(response.body);
      }
    } catch (e) {
      print('error in device token:  $e');
    }
  }

  static Future<int> getServerStatus() async {
    // return 1;

    try {
      var response = await http.get(Uri.parse(ApiUrls.getServerStatus),headers: headers());
      if (response.statusCode == 200) {
        var jsonResponse = convert.jsonDecode(response.body);
        if (jsonResponse['status'] == '1' || jsonResponse['status'] == 1) {
          return 1;
        } else {
          print('the server status is not 1');
        }
      } else {
        print('the server status code is not 200 ${response.statusCode}');
      }
    } catch (e) {
      print('Error in catch block $e');
    }
    return 0;
  }
}
