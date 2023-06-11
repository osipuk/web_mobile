// import 'package:tap/packages/lib/utils/google_search/latlng.dart';

import 'package:Enjoy/modals/user_modal.dart';

import '../services/calling_services.dart';

UserModal? userData;
List giftsList = [];
int serverStatus = 0;

Map<String, String>? headers(){
  if(userData==null){
    return null;
  }else{
    return {
      'X-RapidAPI-Key': userData!.authToken
    };
  }
}
List onlineUsersList = [];


List reportReasonsList = [];
List agentList= [];
String thumbnail = '';
bool locationPermission = false;
CallingApiServices callingApiServices = CallingApiServices();

double userLatitude = 0;
double userLongitude = 0;
String city='';