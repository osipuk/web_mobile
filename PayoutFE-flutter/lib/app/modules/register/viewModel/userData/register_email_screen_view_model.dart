import 'dart:io';
import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/login/provider/login_social_provider.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';
import 'package:pay_out/app/modules/register/model/register_bank_info_model.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'package:pay_out/app/modules/register/repository/register_repository.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_card_stack_widget.dart';
import 'package:pay_out/app/general/manager/push_notifications_manager.dart';

class RegisterUserDataScreenViewModel extends PayOutViewModel {
  final RegisterRepository repository = RegisterRepository();
  final LoginRepository loginRepository = LoginRepository();
  final SharedPreferencesManager preferencesManager =
      SharedPreferencesManager.get;
  final LoginSocialProvider provider = LoginSocialProvider();

  Register registerUser = Register();
  RegisterBankInfoRequest bankInfo = RegisterBankInfoRequest();
  int currentStep = 1;
  int totalStep = 4;
  RegisterDataUser? step;

  List<RegisterDataUser> omitBackNavSteps = [
    RegisterDataUser.VERIFY_CODE,
    RegisterDataUser.TUTORIAL
  ];

  bool isValidEmail = true;

  RegisterUserDataScreenViewModel(BuildContext context) : super(context);

  void setValidEmail(bool validEmail) {
    isValidEmail = validEmail;
    notifyListeners();
  }

  String getTitleMessage() {
    return isValidEmail ? 'Create with email' : 'Invalid email';
  }

  Color getStatusColor() {
    return isValidEmail ? PayPOutColors.PrimaryColor : PayPOutColors.ErrorColor;
  }

  void setRouteData(String email, Register? user) {
    registerUser.email = email;
    if (user != null) {
      setRegisterUserModel(user);
    }
  }

  void setRegisterUserModel(Register? register) {
    if (register?.phone != null && (register?.phone?.isNotEmpty ?? false)) {
      registerUser.phone = register?.phone;
    }
    if (register?.codePhone != null &&
        (register?.codePhone?.isNotEmpty ?? false)) {
      registerUser.codePhone = register?.codePhone;
    }
    if (register?.password != null &&
        (register?.password?.isNotEmpty ?? false)) {
      registerUser.password = register?.password;
    }
    if (register?.lastName != null &&
        (register?.lastName?.isNotEmpty ?? false)) {
      registerUser.lastName = register?.lastName;
    }
    if (register?.firstName != null &&
        (register?.firstName?.isNotEmpty ?? false)) {
      registerUser.firstName = register?.firstName;
    }
    if (register?.userName != null &&
        (register?.userName?.isNotEmpty ?? false)) {
      registerUser.userName = register?.userName;
    }
    if (register?.state != null && (register?.state?.isNotEmpty ?? false)) {
      registerUser.state = register?.state;
    }
    if (register?.city != null && (register?.city?.isNotEmpty ?? false)) {
      registerUser.city = register?.city;
    }
    if (register?.address != null && (register?.address?.isNotEmpty ?? false)) {
      registerUser.address = register?.address;
    }
    if (register?.postalCode != null &&
        (register?.postalCode?.isNotEmpty ?? false)) {
      registerUser.postalCode = register?.postalCode;
    }

    registerUser.longitude = register?.longitude ?? 0;
    registerUser.latitude = register?.latitude ?? 0;
    registerUser.deviceType = Platform.isAndroid ? 1 : 2;
    registerUser.profileImage = register?.profileImage;
    registerUser.deviceToken = '1234567890';
    registerUser.socialID = register?.socialID ?? '';
    registerUser.dateOfBirth = '';
  }

  bool validateForm(Function(String) onError, {bool isSocial = false}) {
    // VALIDAR PRIMERO QUE NO HAYAN DATOS NULOS
    if (registerUser.firstName?.isEmpty ?? false) {
      onError('Ingresa tu nombre');
      return false;
    }
    if (registerUser.lastName?.isEmpty ?? false) {
      onError('Ingresa tu apellido');
      return false;
    }
    if (registerUser.userName?.isEmpty ?? false) {
      onError('Ingresa tu usuario');
      return false;
    }
    if (registerUser.longitude == 0 || registerUser.latitude == 0) {
      onError('Selecciona una direccion valida');
      return false;
    }

    if (isSocial) {
      if (registerUser.socialID?.isEmpty ?? false) {
        onError('Token ID no valido');
        return false;
      }
    } else if (registerUser.password?.isEmpty ?? false) {
      onError('Ingresa una contraseña valida');
      return false;
    }
    if (registerUser.phone?.isEmpty ?? false) {
      onError('Ingresa un numero telefonico valido');
      return false;
    }
    return true;
  }

  bool showBackNav() {
    return !omitBackNavSteps.contains(step);
  }

  ///  API Functions
  void sendSMSCode() {
    final number = '+${GeneralConstants.countryCode}${registerUser.phone}';
    repository.sendSMSCode(number).then((response) {});
  }

  void createUser(
      Function(RegisterResponse) onSuccess, Function(String) onError) async {
    bool isSocial = registerUser.socialID?.isNotEmpty ?? false;
    if (validateForm(onError, isSocial: isSocial)) {
      showLoader();

      String? token = await PushNotificationsManager.get.getNotificationToken();
      registerUser.deviceToken = token;

      repository.postCreateUser(registerUser, isSocial).then((response) {
        if (response.status) {
          preferencesManager.saveUserID(response.data.id);
          registerUser.id = response.data.id;
          onSuccess(response);
        } else {
          onError(response.message);
        }
        notify();
      }).catchError(error);
    }
  }

  //auth register providers
  Future<String?> getTokenGoogleCredential() async {
    final credential = await provider.loginWithGoogle();

    registerUser.socialID = credential?.userCredential.user?.uid;
    registerUser.email = credential?.userCredential.user?.email;
    registerUser.userName = credential?.userCredential.user?.displayName;
    registerUser.firstName =
        credential?.userCredential.additionalUserInfo?.profile?["given_name"];
    registerUser.lastName =
        credential?.userCredential.additionalUserInfo?.profile?["family_name"];

    String pathImage =
        credential?.userCredential.additionalUserInfo?.profile?["picture"] ??
            '';

    if (pathImage.isNotEmpty) {
      // registerUser.profileImage = File.fromUri(Uri.parse(pathImage));
      registerUser.profileImage = File(pathImage);
    }

    return credential?.userCredential.user?.uid;
  }

  Future<String?> getTokenFacebookCredential() async {
    final credential = await provider.loginWithFacebook();

    registerUser.socialID = credential?.userCredential.user?.uid;
    registerUser.email = credential?.userCredential.user?.email;
    registerUser.userName = credential?.userCredential.user?.displayName;
    registerUser.firstName =
        credential?.userCredential.additionalUserInfo?.profile?["first_name"];
    registerUser.lastName =
        credential?.userCredential.additionalUserInfo?.profile?["last_name"];

    String pathImage = credential?.userCredential.additionalUserInfo
            ?.profile?["picture"]["data"]["url"] ??
        '';

    if (pathImage.isNotEmpty) {
      registerUser.profileImage = File(pathImage);
    }

    return credential?.userCredential.user?.uid;
  }

  Future<String?> getTokenAppleCredential() async {
    final credential = await provider.loginWithApple();

    registerUser.socialID = credential?.userCredential.user?.uid;
    registerUser.email = credential?.userCredential.user?.email;
    registerUser.userName = credential?.userCredential.user?.displayName;
    registerUser.firstName =
        credential?.userCredential.additionalUserInfo?.profile?["first_name"];
    registerUser.lastName =
        credential?.userCredential.additionalUserInfo?.profile?["last_name"];

    return credential?.userCredential.user?.uid;
  }

  void socialLogIn(
      String socialID, Function onSuccess, Function(String) onError) {
    loginRepository.loginSocialUser(socialID).then((response) {
      if (response.status) {
        preferencesManager.saveAuthToken(response.authToken);
        preferencesManager.saveUserID(response.data?.id);
        DatabaseManager.get.saveUser(response.data);
        onSuccess();
      } else {
        onError(response.message);
      }
    });
  }

  /// Navigation functions
  void navToRegisterEmailData(
    BuildContext context,
    String email, {
    VoidCallback? onBackCallback,
  }) {
    context.router.push(RegisterUserDataScreenRoute(
        onBackCallback: onBackCallback, email: email, registerUser: null));
  }

  void navToRegisterUserData(
    BuildContext context, {
    VoidCallback? onBackCallback,
  }) {
    final user = Register.fromJson(registerUser.toCreateSocialMap());
    context.router.navigate(RegisterUserDataScreenRoute(
      onBackCallback: onBackCallback,
      email: user.email ?? "",
      registerUser: user,
    ));
  }
}
