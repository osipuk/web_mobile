
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

import 'alert.dart';

String? validateName(String? str){
  // bool Valid = RegExp(r'^[a-zA-Z0-9&%=]+$').hasMatch(str!);
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter a valid user name!");
    return "err";
  }
  else{
    return null;
  }
}
String? validateAddress(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter your Address!");
    return "err";
  }
  else{
    return null;
  }
}


String? validatePassword(String pass){
  String? value = (pass==null)?"":pass.trim();
  if(value==null || value==''){
    presentToast("Enter your password!");
    return "err";
  }
  else{
    return null;
  }
}
String? validateEmail(String email) {
  bool emailValid = RegExp(r"^[a-zA-Z0-9.a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[a-zA-Z0-9]+\.[a-zA-Z]+").hasMatch(email);
  if (emailValid == false || email == null) {
    // print('hhhhh');
    presentToast('Enter a valid email address');
    // print('hhhhxxxxh');
    return 'Enter a valid email address';
  }
  else
    return null;
}

String? validateFullname(String name) {
  bool Valid = RegExp(r'^[a-zA-Z0-9&%=]+$').hasMatch(name);
  print('regex---$Valid');
  if (Valid == false || name == null) {
    presentToast('Enter a valid Full Name.');
    return 'Enter a valid Full Name';
  }
  else
    return null;
}



String? validateFamilyName(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter your family name!");
    return "err";
  }
  else{
    return null;
  }
}


String? validateBirthDate(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter your Date of Birth!");
    return "err";
  }
  else{
    return null;
  }
}
String? validateBirthPlace(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter your place of birth!");
    return "err";
  }
  else{
    return null;
  }
}
String? validateNationality(String? str) {
  String? value = (str == null) ? "" : str.trim();
  if (value == null || value == '') {
    presentToast("Enter your nationality!");
    return "err";
  }
  else {
    return null;
  }
}
String? validateDocumentType(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Select document type!");
    return "err";
  }
  else{
    return null;
  }
}
String? validateDocumentNumber(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Enter document number entered in selected document type");
    return "err";
  }
  else{
    return null;
  }
}

String? validateStreet(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your Street and number");
    return "err";
  }
  else{
    return null;
  }
}


String? validatePostCode(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your post code!");
    return "err";
  }
  else{
    return null;
  }
}


String? validateCity(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your city!");
    return "err";
  }
  else{
    return null;
  }
}


String? validateState(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your state!");
    return "err";
  }
  else{
    return null;
  }
}

String? validateCountry(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your country!");
    return "err";
  }
  else{
    return null;
  }
}

String? validateAddressVerificationDocument(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter your address verification document!");
    return "err";
  }
  else{
    return null;
  }
}

String? validateAmount(String amount) {

  bool amountValid = RegExp(r"^[0-9]+(\.[0-9]{1,2})?$").hasMatch(amount);
  if (amountValid == false || amount == null) {

    presentToast('Enter a valid amount');
    return 'Enter a valid amount';
  }
  else
    return null;
}


String? ValidatepasswordMetch(String newpass,String confirm_pass){
  if((newpass == '' || newpass==null) && (confirm_pass==''||confirm_pass==null)){
    presentToast('Please enter your new password/confirm password');
    return 'err';
  } else {
    if(newpass != confirm_pass){
      presentToast('New password and confirm password should be matched.');
      return 'err';
    } else {
      return null;
    }
  }
}


String? validateDesc(String str){
  if(str=="" || str==null) {
    presentToast("Please enter description/note!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateMsg(String str){
  if(str=="" || str==null) {
    presentToast("Please enter message.");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateReason(String str){
  if(str=="" || str==null) {
    presentToast("Please enter your reason!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateGender(String str){
  if(str=="" || str==null) {
    presentToast("Please select gender!");
    return 'ss';
  }
  else {
    return null;
  }
}




String? validateCurrentPassword(String password){
  if(password=="" || password==null) {
    presentToast("Please enter your current password!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validatePhone(String password){
  if(password=="" || password==null) {
    presentToast("Please enter your phone number!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validatepascode(String pascode){
  if(pascode=="" || pascode==null) {
    presentToast("Please enter tap code!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateage(String age){
  if(age=="" || age==null) {
    presentToast("Please enter your age!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validatsocial(String age){
  if(age=="" || age==null) {
    presentToast("Please enter social media account id!");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateDublicatename(String a,String b){
  if(a==b) {
    presentToast("full name and user name should't be matched.");
    return 'ss';
  }
  else{
    return null;
  }
}


String? validateitemname(String age){
  if(age=="" || age==null) {
    presentToast("Please ente item name.");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validatqty(String age){
  if(age=="" || age==null) {
    presentToast("Please ente item quantity.");
    return 'ss';
  }
  else{
    return null;
  }
}

String? validateTitle(String? str){
  String? value = (str==null)?"":str.trim();
  if(value==null || value==''){
    presentToast("Please enter title!");
    return "err";
  }
  else{
    return null;
  }
}


// int? validatePhone(int phone){
//   if(phone=="" || phone==null) {
//     presentToast("Please enter your phone number!");
//     return 0;
//   }
//   else{
//     return null;
//   }
// }



