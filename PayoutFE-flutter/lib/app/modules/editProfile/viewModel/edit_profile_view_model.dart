import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/editProfile/model/edit_profile_model.dart';
import 'package:pay_out/app/modules/editProfile/repository/edit_profile_repository.dart';
import 'package:pay_out/app/modules/editProfile/ui/edit_profile_screen.dart';
import 'package:auto_route/auto_route.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';

class EditProfileUserViewModel extends PayOutViewModel {
  final EditProfileRepository repository = EditProfileRepository();
  final ProfileRepository userRepository = ProfileRepository();

  bool loadUser = false;
  EditUser editUser = EditUser();
  int indexSelected = 2;

  EditProfileUserViewModel(BuildContext context) : super(context);

  List<EditOptions> menu = [
    EditOptions.Mail,
    EditOptions.Phone,
    EditOptions.Name,
    //EditOptions.Address,
    EditOptions.Password,
    //EditOptions.BankInfo
  ];

  Future<GeneralResponse?> uploadProfileImage() async {
    int userID = await SharedPreferencesManager.get.getUserID();
    return repository.uploadProfileImage(editUser, userID);
  }

  void editProfileUser(Map<String, dynamic> data,
      {required Function(String) successfull,
      required Function(String) onError}) async {
    int userID = await SharedPreferencesManager.get.getUserID();
    repository.editProfileUser(data, userID).then((response) {
      if (response.status) {
        successfull(response.message);
      } else {
        onError(response.message);
      }
    });
  }

  void editPasswordUser(String newPass, String oldPass,
      {required Function(String) successfull,
      required Function(String) onError}) async {
    repository.editPasswordUser(newPass, oldPass).then((response) {
      if (response.status) {
        successfull(response.message);
      } else {
        onError(response.message);
      }
    });
  }

  void getProfileUser() async {
    if (!loadUser) {
      int userID = await SharedPreferencesManager.get.getUserID();
      userRepository.getProfileUser(userID.toString()).then(
        (response) {
          if (response.status) {
            DatabaseManager.get.saveUser(response.data);
            //profileUser = response.data;
            loadUser = true;
            notify();
          }
        },
      );
    }
  }

  String getImageByOption(EditOptions? option) {
    switch (option) {
      case EditOptions.Mail:
        return SVGImage.emailImg;
      case EditOptions.Phone:
        return SVGImage.phoneIcon;
      case EditOptions.Name:
        return SVGImage.nameIcon;
      case EditOptions.Address:
        return SVGImage.addressIcon;
      case EditOptions.Password:
        return SVGImage.passwordImg;
      case EditOptions.BankInfo:
        return SVGImage.creditCardIcon;
      default:
        return "";
    }
  }

  String getTitleByOption(EditOptions? option) {
    switch (option) {
      case EditOptions.Mail:
        return "Edit Email";
      case EditOptions.Phone:
        return "Edit Phone";
      case EditOptions.Name:
        return "Edit Name";
      case EditOptions.Address:
        return "Edit Address";
      case EditOptions.Password:
        return "Edit Password";
      case EditOptions.BankInfo:
        return "Edit Bank Info";
      default:
        return "";
    }
  }

  void navRouteByOption(EditOptions? option, Function? onEditComplete,
      {VoidCallback? onBackCallback}) async {
    final user = await DatabaseManager.get.getUser();
    switch (option) {
      case EditOptions.Mail:
        context.router.popAndPush(
          EditEmailProfileUserScreenRoute(
            onBackCallback: onBackCallback,
            user: user,
          ),
          result: (data) {
            print(data);
          },
        );
        break;
      case EditOptions.Phone:
        context.router.navigate(
          EditPhoneProfileUserScreenRoute(
            onBackCallback: onBackCallback,
            user: user,
          ),
        );
        break;
      case EditOptions.Name:
        context.router.navigate(
          EditNameProfileUserScreenRoute(
            onBackCallback: onBackCallback,
            user: user,
            editProfileComplete: onEditComplete,
          ),
        );
        break;
      case EditOptions.Address:
        context.router.navigate(
          EditAddressProfileUserScreenRoute(
            user: user,
          ),
        );
        break;
      case EditOptions.Password:
        context.router.popAndPush(
          EditPasswordProfileUserScreenRoute(
            onBackCallback: onBackCallback,
            user: user,
          ),
          result: (data) {
            print(data);
          },
        );
        break;
      case EditOptions.BankInfo:
        // context.router.navigate(ChangeCorrectPassDialogRoute());
        break;
      default:
        break;
    }
  }

  Future<GeneralResponse?> openGallery() async {
    final pickedFile = await ImagePicker().pickImage(
      source: ImageSource.gallery,
      maxHeight: 150,
      maxWidth: 150,
    );

    if (pickedFile == null) {
      return GeneralResponse(message: "", status: false);
    }

    editUser.setProfileImage(File(pickedFile.path));
    return await uploadProfileImage();
  }

  Future<GeneralResponse?> openCamera() async {
    final pickedFile = await ImagePicker().pickImage(
      source: ImageSource.camera,
      maxHeight: 150,
      maxWidth: 150,
    );

    if (pickedFile == null) {
      return GeneralResponse(message: "", status: false);
    }

    editUser.setProfileImage(File(pickedFile.path));
    return await uploadProfileImage();
  }
}
