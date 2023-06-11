import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/model/general_model.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'package:pay_out/app/modules/register/repository/register_repository.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_card_stack_widget.dart';
import 'package:pay_out/app/general/extensions/string_extension.dart';

class RegisterCardStackViewModel extends PayOutViewModel {
  final RegisterRepository repository = RegisterRepository();
  final LoginRepository loginRepository = LoginRepository();

  Register registerUser = Register();
  String code = "";

  String codeDummy = "8765";

  RegisterCardStackViewModel(BuildContext context) : super(context);

  final List<RegisterDataUser> formSteps = [
    RegisterDataUser.NAME,
    RegisterDataUser.ADDRESS,
    RegisterDataUser.PASSWORD,
    RegisterDataUser.PHONE,
  ];

  final List<RegisterDataUser> lastFormSteps = [
    RegisterDataUser.VERIFY_CODE,
    RegisterDataUser.TUTORIAL,
  ];

  List<RegisterDataUser> getSteps(bool contentID) {
    return (contentID) ? lastFormSteps : formSteps;
  }

  ///  API Functions
  void sendSMSCode(
      Function(GeneralResponse) onSuccess, Function(String) onError) {
    final number = '+${GeneralConstants.countryCode}${registerUser.phone}';
    repository.sendSMSCode(number).then((response) {
      if (response.status) {
        onSuccess(response);
      } else {
        onError(response.message);
      }
    });
  }

  void verifySMSCode(int idUser, Function(GeneralResponse) onSuccess,
      Function(String) onError) {
    final number = '+${GeneralConstants.countryCode}${registerUser.phone}';
    repository.verifySMSCode(idUser, code, number).then((response) {
      if (response.status) {
        onSuccess(response);
      } else {
        onError(response.message);
      }
    });
  }

  void activeRegisterUser(
      int userID, Function(bool) onSuccess, Function(String) onError) async {
    repository.postActiveRegisterUser(userID).then((response) {
      if (response.status) {
        onSuccess(response.status);
      } else {
        onError(response.message);
      }
      notify();
    }).catchError(error);
  }

  void loginAfterVerifiedAccount(
      Function(User?) onSuccess, Function(String) onError) {
    final isSocial = registerUser.socialID?.isNotEmpty ?? false;
    if (isSocial) {
      _socialLogIn(onSuccess, onError);
    } else {
      _logIn(onSuccess, onError);
    }
  }

  void _logIn(Function(User?) onSuccess, Function(String) onError) {
    loginRepository
        .loginUser(registerUser.email ?? "", registerUser.password ?? "")
        .then((response) {
      if (response.status) {
        SharedPreferencesManager.get.saveAuthToken(response.authToken);
        SharedPreferencesManager.get.saveUserID(response.data?.id);
        DatabaseManager.get.saveUser(response.data);
        onSuccess(response.data);
      } else {
        onError(response.message);
      }
    });
  }

  void _socialLogIn(Function(User?) onSuccess, Function(String) onError) {
    loginRepository
        .loginSocialUser(registerUser.socialID ?? "")
        .then((response) {
      if (response.status) {
        SharedPreferencesManager.get.saveAuthToken(response.authToken);
        SharedPreferencesManager.get.saveUserID(response.data?.id);
        DatabaseManager.get.saveUser(response.data);
        onSuccess(response.data);
      } else {
        onError(response.message);
      }
    });
  }

  void setSocialRegisterUserModel(Register register) {
    if (register.firstName != null &&
        (register.firstName?.isNotEmpty ?? false) &&
        registerUser.firstName == null) {
      registerUser.firstName = register.firstName;
    }
    if (register.lastName != null &&
        (register.lastName?.isNotEmpty ?? false) &&
        registerUser.lastName == null) {
      registerUser.lastName = register.lastName;
    }
    if (register.userName != null &&
        (register.userName?.isNotEmpty ?? false) &&
        registerUser.userName == null) {
      registerUser.userName = register.userName;
    }
    if (register.profileImage != null) {
      registerUser.profileImage = register.profileImage;
    }
    if (register.socialID != null && (register.socialID?.isNotEmpty ?? false)) {
      registerUser.socialID = register.socialID;
    }
  }

  //validacion de datos
  bool isValidNamesData() {
    bool firstName = registerUser.firstName?.isNotEmpty ?? false;
    bool lastName = registerUser.lastName?.isNotEmpty ?? false;
    bool userName = registerUser.userName?.isNotEmpty ?? false;
    return firstName && lastName && userName;
  }

  bool isValidAddressData() {
    bool address = registerUser.address?.isNotEmpty ?? false;
    bool city = registerUser.city?.isNotEmpty ?? false;
    bool postalCode = registerUser.postalCode?.isNotEmpty ?? false;
    bool state = registerUser.state?.isNotEmpty ?? false;
    return address && city && postalCode && state;
  }

  bool isValidPasswordData() {
    if (registerUser.socialID == null ||
        (registerUser.socialID?.isEmpty ?? false)) {
      String password = registerUser.password ?? "";
      bool validPassword = password.isValidPassword();
      return validPassword;
    }
    return true;
  }

  bool isValidPhoneData() {
    String phone = registerUser.phone ?? "";
    bool validPhone = phone.isNotEmpty;
    bool maxPhone = phone.length >= 10;
    return validPhone && maxPhone;
  }

  bool isValidCodeData() {
    bool validCode = code.isNotEmpty;
    return validCode;
  }
}
