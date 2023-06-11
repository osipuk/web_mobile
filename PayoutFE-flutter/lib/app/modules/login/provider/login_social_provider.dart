import 'package:firebase_auth/firebase_auth.dart';
import 'package:pay_out/app/modules/login/provider/auth_apple_provider.dart';
import 'package:pay_out/app/modules/login/provider/auth_facebook_provider.dart';
import 'package:pay_out/app/modules/login/provider/auth_google_provider.dart';

class LoginSocialProvider {
  final _appleAuth = AppleAuthProvider();
  final _fbAuth = FbAuthProvider();
  final _glAuth = GlAuthProvider();

  Future<GoogleCredential?> loginWithGoogle() async {
    return await _glAuth.signInWithGoogle();
  }

  Future<FacebookCredential?> loginWithFacebook() async {
    return await _fbAuth.signInWithFacebook();
  }

  Future<AppleCredential?> loginWithApple() async {
    return await _appleAuth.signInWithApple();
  }
}

class GoogleCredential {
  final UserCredential userCredential;
  final OAuthCredential googleAuthCredential;
  GoogleCredential(this.userCredential, this.googleAuthCredential);
}

class FacebookCredential {
  final UserCredential userCredential;
  final OAuthCredential fbAuthCredential;
  FacebookCredential(this.userCredential, this.fbAuthCredential);
}

class AppleCredential {
  final UserCredential userCredential;
  final OAuthCredential appleAuthCredential;
  AppleCredential(this.userCredential, this.appleAuthCredential);
}
