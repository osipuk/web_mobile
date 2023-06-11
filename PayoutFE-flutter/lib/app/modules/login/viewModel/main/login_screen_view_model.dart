import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:local_auth/auth_strings.dart';
import 'package:local_auth/local_auth.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:pay_out/app/general/router/router.gr.dart';
import 'package:pay_out/app/modules/login/provider/login_social_provider.dart';
import 'package:pay_out/app/modules/login/repository/login_repository.dart';
import 'package:auto_route/auto_route.dart';

class LoginScreenViewModel extends PayOutViewModel {
  final LoginRepository repository = LoginRepository();

  final LoginSocialProvider provider = LoginSocialProvider();
  final LocalAuthentication auth = LocalAuthentication();
  final SharedPreferencesManager preferencesManager =
      SharedPreferencesManager.get;

  bool userLocalLogged = false;
  bool fingerPrintAvailable = false;
  bool faceIdAvailable = false;

  LoginScreenViewModel(BuildContext context) : super(context);

  void setBiometricsAuth() async {
    final availableBiometrics = await auth.getAvailableBiometrics();
    faceIdAvailable = availableBiometrics.contains(BiometricType.face);
    fingerPrintAvailable =
        availableBiometrics.contains(BiometricType.fingerprint);
    notifyListeners();
  }

  Future<bool> faceIDLogin(Function(String) onError) async {
    final availableBiometrics = await auth.getAvailableBiometrics();
    faceIdAvailable = availableBiometrics.contains(BiometricType.face);
    const iosStrings = const IOSAuthMessages(
        cancelButton: 'cancel',
        goToSettingsButton: 'settings',
        goToSettingsDescription: 'Please set up your Face ID.',
        lockOut: 'Please reenable your Face ID');

    try {
      return await auth.authenticate(
          biometricOnly: true,
          localizedReason:
              'Por favor utiliza esta autenticacion para ingresar a tu cuenta',
          useErrorDialogs: true,
          stickyAuth: true,
          iOSAuthStrings: iosStrings);
    } on PlatformException catch (_) {
      return false;
    }
  }

  Future<bool> touchIDLogin(Function(String) onError) async {
    final availableBiometrics = await auth.getAvailableBiometrics();
    if (availableBiometrics.contains(BiometricType.fingerprint)) {
      const iosStrings = const IOSAuthMessages(
          cancelButton: 'cancel',
          goToSettingsButton: 'settings',
          goToSettingsDescription: 'Please set up your Touch ID.',
          lockOut: 'Please reenable your Touch ID');

      try {
        return await auth.authenticate(
            localizedReason:
                'Por favor utiliza esta autenticacion para ingresar a tu cuenta',
            iOSAuthStrings: iosStrings,
            useErrorDialogs: true,
            biometricOnly: true,
            stickyAuth: true);
      } on PlatformException catch (e) {
        onError(e.message ?? "");
        return false;
      }
    }
    return false;
  }

  void socialLogIn(
      String socialID, Function onSuccess, Function(String) onError) {
    repository.loginSocialUser(socialID).then((response) {
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

  Future<String?> getGoogleCredential() async {
    final credential = await provider.loginWithGoogle();
    return credential?.userCredential.user?.uid;
  }

  Future<String?> getFacebookCredential() async {
    final credential = await provider.loginWithFacebook();
    return credential?.userCredential.user?.uid;
  }

  Future<String?> getAppleCredential() async {
    final credential = await provider.loginWithApple();
    return credential?.userCredential.user?.uid;
  }

  /// ------------- Navigate functions
  void navToEmailLogin({VoidCallback? onBackCallback}) {
    context.router.navigate(EmailLoginScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToFaqs({VoidCallback? onBackCallback}) {
    context.router.navigate(FaqsScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToPreviewApp({VoidCallback? onBackCallback}) {
    context.router.navigate(PreviewAppScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void navToRegisterUser({VoidCallback? onBackCallback}) {
    context.router.navigate(RegisterEmailScreenRoute(
      onBackCallback: onBackCallback,
    ));
  }

  void showPopUp({VoidCallback? onBackCallback}) {
    context.router.navigate(ChangeCorrectPassDialogRoute(
      onBackCallback: onBackCallback,
    ));
  }
}
