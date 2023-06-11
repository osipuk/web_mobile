// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:firebase_auth/firebase_auth.dart';
import 'package:pay_out/app/modules/login/provider/login_social_provider.dart';
import 'package:flutter_facebook_login/flutter_facebook_login.dart';

class FbAuthProvider {
  Future<FacebookCredential?> signInWithFacebook() async {
    final facebookLogin = FacebookLogin();

    // Trigger the sign-in flow

    final result =
        await facebookLogin.logIn(['email', 'public_profile', 'user_friends']);

    if (result.status == FacebookLoginStatus.loggedIn) {
      // Create a credential from the access token
      final OAuthCredential credential =
          FacebookAuthProvider.credential(result.accessToken?.token ?? '');

      // Once signed in, return the UserCredential
      final userCredential =
          await FirebaseAuth.instance.signInWithCredential(credential);
      return FacebookCredential(userCredential, credential);
    } else {
      return null;
    }
  }
}
