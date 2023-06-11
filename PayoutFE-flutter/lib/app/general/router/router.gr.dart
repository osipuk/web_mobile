// **************************************************************************
// AutoRouteGenerator
// **************************************************************************

// GENERATED CODE - DO NOT MODIFY BY HAND

// **************************************************************************
// AutoRouteGenerator
// **************************************************************************
//
// ignore_for_file: type=lint

import 'package:auto_route/auto_route.dart' as _i36;
import 'package:flutter/material.dart' as _i37;
import 'package:pay_out/app/general/constants/SVGImage.dart';

import '../../modules/createPayout/ui/create_payout_main_view.dart' as _i20;
import '../../modules/editProfile/ui/addressStep/edit_address_screen.dart'
    as _i24;
import '../../modules/editProfile/ui/edit_profile_screen.dart' as _i16;
import '../../modules/editProfile/ui/emailStep/edit_email_screen.dart' as _i22;
import '../../modules/editProfile/ui/nameStep/edit_name_screen.dart' as _i23;
import '../../modules/editProfile/ui/password/edit_password_screen.dart'
    as _i34;
import '../../modules/editProfile/ui/phoneStep/edit_phone_number_screen.dart'
    as _i21;
import '../../modules/faqs/ui/faqs_screen.dart' as _i4;
import '../../modules/home/model/payout_invitation.dart' as _i39;
import '../../modules/home/model/payout_member.dart' as _i41;
import '../../modules/home/ui/home_screen.dart' as _i12;
import '../../modules/invitationPayout/ui/invite_payout_main_view.dart' as _i28;
import '../../modules/invitationRejected/view/invitation_rejected.dart' as _i33;
import '../../modules/invitationSplit/ui/invitation_split_screen.dart' as _i32;
import '../../modules/invitationTrade/ui/invitation_trade_screen.dart' as _i30;
import '../../modules/login/model/user.dart' as _i40;
import '../../modules/login/ui/email/email_login_screen.dart' as _i3;
import '../../modules/login/ui/main/login_screen.dart' as _i2;
import '../../modules/login/ui/password/forgot_password_login_screen.dart'
    as _i7;
import '../../modules/login/ui/password/new_password_screen.dart' as _i8;
import '../../modules/login/ui/password/password_login_screen.dart' as _i6;
import '../../modules/notifications/model/Notification_model.dart' as _i42;
import '../../modules/notifications/view/notifications_screen.dart' as _i27;
import '../../modules/payoutDetail/ui/detail_pay_out_screen.dart' as _i13;
import '../../modules/popUps/change_correct_password_dialog.dart' as _i18;
import '../../modules/popUps/error_dialog_screen.dart' as _i19;
import '../../modules/popUps/successfull_dialog_screen.dart' as _i17;
import '../../modules/previewApp/ui/preview_app_screen.dart' as _i5;
import '../../modules/profile/ui/profile_user_screen.dart' as _i14;
import '../../modules/register/model/register_user_model.dart' as _i38;
import '../../modules/register/ui/email/register_email_screen.dart' as _i9;
import '../../modules/register/ui/tutorial/register_tutorial_screen.dart'
    as _i11;
import '../../modules/register/ui/userData/register_user_data_screen.dart'
    as _i10;
import '../../modules/requestSplit/ui/request_split_screen.dart' as _i31;
import '../../modules/requestTrade/ui/request_trade_screen.dart' as _i29;
import '../../modules/selectPayment/ui/payout_select_paymnet_type_screen.dart'
    as _i26;
import '../../modules/splash/ui/splash_screen.dart' as _i1;
import '../../modules/user/ui/user_screen.dart' as _i15;
import '../../modules/validatePendingCode/ui/validate_pending_code_screen.dart'
    as _i35;
import '../../modules/venmoPayment/ui/venmo_login_screen.dart' as _i25;

class AppRouter extends _i36.RootStackRouter {
  AppRouter([_i37.GlobalKey<_i37.NavigatorState>? navigatorKey])
      : super(navigatorKey);

  @override
  final Map<String, _i36.PageFactory> pagesMap = {
    SplashScreenRoute.name: (routeData) {
      final args = routeData.argsAs<SplashScreenRouteArgs>(
          orElse: () => const SplashScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i1.SplashScreen(onBackCallback: args.onBackCallback));
    },
    LoginScreenRoute.name: (routeData) {
      final args = routeData.argsAs<LoginScreenRouteArgs>(
          orElse: () => const LoginScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i2.LoginScreen(onBackCallback: args.onBackCallback));
    },
    EmailLoginScreenRoute.name: (routeData) {
      final args = routeData.argsAs<EmailLoginScreenRouteArgs>(
          orElse: () => const EmailLoginScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i3.EmailLoginScreen(onBackCallback: args.onBackCallback));
    },
    FaqsScreenRoute.name: (routeData) {
      final args = routeData.argsAs<FaqsScreenRouteArgs>(
          orElse: () => const FaqsScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i4.FaqsScreen(onBackCallback: args.onBackCallback));
    },
    PreviewAppScreenRoute.name: (routeData) {
      final args = routeData.argsAs<PreviewAppScreenRouteArgs>(
          orElse: () => const PreviewAppScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i5.PreviewAppScreen(onBackCallback: args.onBackCallback));
    },
    PasswordLoginScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<PasswordLoginScreenRouteArgs>(
          orElse: () => PasswordLoginScreenRouteArgs(
              email: queryParams.get('email', "")));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i6.PasswordLoginScreen(
              onBackCallback: args.onBackCallback, email: args.email));
    },
    ForgotPasswordLoginScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<ForgotPasswordLoginScreenRouteArgs>(
          orElse: () => ForgotPasswordLoginScreenRouteArgs(
              email: queryParams.getString('email', "")));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i7.ForgotPasswordLoginScreen(
              onBackCallback: args.onBackCallback, email: args.email));
    },
    NewPasswordLoginScreenRoute.name: (routeData) {
      final args = routeData.argsAs<NewPasswordLoginScreenRouteArgs>(
          orElse: () => const NewPasswordLoginScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child:
              _i8.NewPasswordLoginScreen(onBackCallback: args.onBackCallback));
    },
    RegisterEmailScreenRoute.name: (routeData) {
      final args = routeData.argsAs<RegisterEmailScreenRouteArgs>(
          orElse: () => const RegisterEmailScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i9.RegisterEmailScreen(onBackCallback: args.onBackCallback));
    },
    RegisterUserDataScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<RegisterUserDataScreenRouteArgs>(
          orElse: () => RegisterUserDataScreenRouteArgs(
              email: queryParams.getString('email', ""),
              registerUser: queryParams.get('user')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i10.RegisterUserDataScreen(
              onBackCallback: args.onBackCallback,
              email: args.email,
              registerUser: args.registerUser));
    },
    RegisterTutorialScreenRoute.name: (routeData) {
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData, child: _i11.RegisterTutorialScreen());
    },
    HomeScreenRoute.name: (routeData) {
      final args = routeData.argsAs<HomeScreenRouteArgs>(
          orElse: () => const HomeScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i12.HomeScreen(onBackCallback: args.onBackCallback));
    },
    PayOutDetailScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<PayOutDetailScreenRouteArgs>(
          orElse: () =>
              PayOutDetailScreenRouteArgs(payOut: queryParams.get('payOut')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i13.PayOutDetailScreen(
              onBackCallback: args.onBackCallback, payOut: args.payOut));
    },
    ProfileUserScreenRoute.name: (routeData) {
      final args = routeData.argsAs<ProfileUserScreenRouteArgs>(
          orElse: () => const ProfileUserScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i14.ProfileUserScreen(onBackCallback: args.onBackCallback));
    },
    UserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<UserScreenRouteArgs>(
          orElse: () =>
              UserScreenRouteArgs(id: queryParams.getString('id', "")));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i15.UserScreen(
              onBackCallback: args.onBackCallback, id: args.id));
    },
    EditProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditProfileUserScreenRouteArgs>(
          orElse: () => EditProfileUserScreenRouteArgs(
              editProfileComplete: queryParams.get('editProfileComplete')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i16.EditProfileUserScreen(
              onBackCallback: args.onBackCallback,
              editProfileComplete: args.editProfileComplete));
    },
    SuccessfulDialogScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<SuccessfulDialogScreenRouteArgs>(
          orElse: () => SuccessfulDialogScreenRouteArgs(
              cTitle: queryParams.getString('cTitle', ''),
              cMessage: queryParams.getString('cMessage', ''),
              cIcon: queryParams.getString('cIcon', SVGImage.warningDialogIcon),
              cCancelBtn: queryParams.getString('cCancelBtn', ''),
              onAceptClick: queryParams.get('onAceptClick'),
              onCancelClick: queryParams.get('onCancelClick')));
      return _i36.CustomPage<dynamic>(
          routeData: routeData,
          child: _i17.SuccessfulDialogScreen(
              onBackCallback: args.onBackCallback,
              cTitle: args.cTitle,
              cMessage: args.cMessage,
              cIcon: args.cIcon,
              cCancelBtn: args.cCancelBtn,
              onAceptClick: args.onAceptClick,
              onCancelClick: args.onCancelClick),
          fullscreenDialog: true,
          transitionsBuilder: _i36.TransitionsBuilders.fadeIn,
          durationInMilliseconds: 300,
          reverseDurationInMilliseconds: 300,
          opaque: false,
          barrierDismissible: false);
    },
    ChangeCorrectPassDialogRoute.name: (routeData) {
      final args = routeData.argsAs<ChangeCorrectPassDialogRouteArgs>(
          orElse: () => const ChangeCorrectPassDialogRouteArgs());
      return _i36.CustomPage<dynamic>(
          routeData: routeData,
          child:
              _i18.ChangeCorrectPassDialog(onBackCallback: args.onBackCallback),
          fullscreenDialog: true,
          transitionsBuilder: _i36.TransitionsBuilders.fadeIn,
          durationInMilliseconds: 300,
          reverseDurationInMilliseconds: 300,
          opaque: false,
          barrierDismissible: false);
    },
    ErrorDialogScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<ErrorDialogScreenRouteArgs>(
          orElse: () => ErrorDialogScreenRouteArgs(
              cTitle: queryParams.getString('cTitle', ''),
              cMessage: queryParams.getString('cMessage', ''),
              cIcon:
                  queryParams.getString('cIcon', SVGImage.warningDialogIcon)));
      return _i36.CustomPage<dynamic>(
          routeData: routeData,
          child: _i19.ErrorDialogScreen(
              onBackCallback: args.onBackCallback,
              cTitle: args.cTitle,
              cMessage: args.cMessage,
              cIcon: args.cIcon),
          fullscreenDialog: true,
          transitionsBuilder: _i36.TransitionsBuilders.fadeIn,
          durationInMilliseconds: 300,
          reverseDurationInMilliseconds: 300,
          opaque: false,
          barrierDismissible: false);
    },
    CreatePayoutMainScreenRoute.name: (routeData) {
      final args = routeData.argsAs<CreatePayoutMainScreenRouteArgs>(
          orElse: () => const CreatePayoutMainScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i20.CreatePayoutMainScreen(
              onBackCallback: args.onBackCallback,
              payOutToEdit: args.payOutToEdit));
    },
    EditPhoneProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditPhoneProfileUserScreenRouteArgs>(
          orElse: () => EditPhoneProfileUserScreenRouteArgs(
              user: queryParams.get('user')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i21.EditPhoneProfileUserScreen(
              onBackCallback: args.onBackCallback, user: args.user));
    },
    EditEmailProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditEmailProfileUserScreenRouteArgs>(
          orElse: () => EditEmailProfileUserScreenRouteArgs(
              user: queryParams.get('user')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i22.EditEmailProfileUserScreen(
              onBackCallback: args.onBackCallback, user: args.user));
    },
    EditNameProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditNameProfileUserScreenRouteArgs>(
          orElse: () => EditNameProfileUserScreenRouteArgs(
              user: queryParams.get('user'),
              editProfileComplete: queryParams.get('editProfileComplete')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i23.EditNameProfileUserScreen(
              onBackCallback: args.onBackCallback,
              user: args.user,
              editProfileComplete: args.editProfileComplete));
    },
    EditAddressProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditAddressProfileUserScreenRouteArgs>(
          orElse: () => EditAddressProfileUserScreenRouteArgs(
              user: queryParams.get('user')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i24.EditAddressProfileUserScreen(
              onBackCallback: args.onBackCallback, user: args.user));
    },
    VenmoLoginScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<VenmoLoginScreenRouteArgs>(
          orElse: () => VenmoLoginScreenRouteArgs(
              member: queryParams.get('member'),
              payOut: queryParams.get('payOut'),
              onPaymentComplete: queryParams.get('onPaymentComplete')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i25.VenmoLoginScreen(
              onBackCallback: args.onBackCallback,
              member: args.member,
              payOut: args.payOut,
              onPaymentComplete: args.onPaymentComplete));
    },
    SelectPaymentTypeScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<SelectPaymentTypeScreenRouteArgs>(
          orElse: () => SelectPaymentTypeScreenRouteArgs(
              member: queryParams.get('member'),
              payOut: queryParams.get('payOut'),
              onPaymentComplete: queryParams.get('onPaymentComplete')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i26.SelectPaymentTypeScreen(
              onBackCallback: args.onBackCallback,
              member: args.member,
              payOut: args.payOut,
              onPaymentComplete: args.onPaymentComplete));
    },
    NotificationScreenRoute.name: (routeData) {
      final args = routeData.argsAs<NotificationScreenRouteArgs>(
          orElse: () => const NotificationScreenRouteArgs());
      return _i36.CustomPage<dynamic>(
          routeData: routeData,
          child: _i27.NotificationScreen(
              onBackCallback: args.onBackCallback,
              notificationLoaded: args.notificationLoaded),
          fullscreenDialog: true,
          transitionsBuilder: _i36.TransitionsBuilders.fadeIn,
          durationInMilliseconds: 100,
          reverseDurationInMilliseconds: 100,
          opaque: false,
          barrierDismissible: false);
    },
    InvitePayoutMainScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<InvitePayoutMainScreenRouteArgs>(
          orElse: () => InvitePayoutMainScreenRouteArgs(
              payOut: queryParams.get('payOut')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i28.InvitePayoutMainScreen(
              payOut: args.payOut, onBackCallback: args.onBackCallback));
    },
    RequestAtradeScreenRoute.name: (routeData) {
      final args = routeData.argsAs<RequestAtradeScreenRouteArgs>();
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i29.RequestAtradeScreen(args.onBackCallback,
              payOut: args.payOut));
    },
    InviteTradeScreenRoute.name: (routeData) {
      final args = routeData.argsAs<InviteTradeScreenRouteArgs>();
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i30.InviteTradeScreen(args.onBackCallback,
              payOut: args.payOut,
              notID: args.notID,
              requestedUserID: args.requestedUserID));
    },
    RequestSplitScreenRoute.name: (routeData) {
      final args = routeData.argsAs<RequestSplitScreenRouteArgs>();
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i31.RequestSplitScreen(args.onBackCallback,
              payOut: args.payOut));
    },
    InviteSplitScreenRoute.name: (routeData) {
      final args = routeData.argsAs<InviteSplitScreenRouteArgs>();
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i32.InviteSplitScreen(args.onBackCallback,
              payOut: args.payOut,
              requestedID: args.requestedID,
              requestedUserID: args.requestedUserID,
              notID: args.notID));
    },
    InviteRejectedPayoutScreenRoute.name: (routeData) {
      final args = routeData.argsAs<InviteRejectedPayoutScreenRouteArgs>();
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i33.InviteRejectedPayoutScreen(args.onBackCallback,
              payOut: args.payOut));
    },
    EditPasswordProfileUserScreenRoute.name: (routeData) {
      final queryParams = routeData.queryParams;
      final args = routeData.argsAs<EditPasswordProfileUserScreenRouteArgs>(
          orElse: () => EditPasswordProfileUserScreenRouteArgs(
              user: queryParams.get('user')));
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child: _i34.EditPasswordProfileUserScreen(
              onBackCallback: args.onBackCallback, user: args.user));
    },
    ValidateCodeUserScreenRoute.name: (routeData) {
      final args = routeData.argsAs<ValidateCodeUserScreenRouteArgs>(
          orElse: () => const ValidateCodeUserScreenRouteArgs());
      return _i36.CupertinoPageX<dynamic>(
          routeData: routeData,
          child:
              _i35.ValidateCodeUserScreen(onBackCallback: args.onBackCallback));
    }
  };

  @override
  List<_i36.RouteConfig> get routes => [
        _i36.RouteConfig(SplashScreenRoute.name, path: '/splash-screen'),
        _i36.RouteConfig(LoginScreenRoute.name, path: '/login-screen'),
        _i36.RouteConfig(EmailLoginScreenRoute.name,
            path: '/email-login-screen'),
        _i36.RouteConfig(FaqsScreenRoute.name, path: '/faqs-screen'),
        _i36.RouteConfig(PreviewAppScreenRoute.name,
            path: '/preview-app-screen'),
        _i36.RouteConfig(PasswordLoginScreenRoute.name,
            path: '/password-login-screen'),
        _i36.RouteConfig(ForgotPasswordLoginScreenRoute.name,
            path: '/forgot-password-login-screen'),
        _i36.RouteConfig(NewPasswordLoginScreenRoute.name,
            path: '/new-password-login-screen'),
        _i36.RouteConfig(RegisterEmailScreenRoute.name,
            path: '/register-email-screen'),
        _i36.RouteConfig(RegisterUserDataScreenRoute.name,
            path: '/register-user-data-screen'),
        _i36.RouteConfig(RegisterTutorialScreenRoute.name,
            path: '/register-tutorial-screen'),
        _i36.RouteConfig(HomeScreenRoute.name, path: '/home-screen'),
        _i36.RouteConfig(PayOutDetailScreenRoute.name,
            path: '/pay-out-detail-screen'),
        _i36.RouteConfig(ProfileUserScreenRoute.name,
            path: '/profile-user-screen'),
        _i36.RouteConfig(UserScreenRoute.name, path: '/user-screen'),
        _i36.RouteConfig(EditProfileUserScreenRoute.name,
            path: '/edit-profile-user-screen'),
        _i36.RouteConfig(SuccessfulDialogScreenRoute.name,
            path: '/successful-dialog-screen'),
        _i36.RouteConfig(ChangeCorrectPassDialogRoute.name,
            path: '/change-correct-pass-dialog'),
        _i36.RouteConfig(ErrorDialogScreenRoute.name,
            path: '/error-dialog-screen'),
        _i36.RouteConfig(CreatePayoutMainScreenRoute.name,
            path: '/create-payout-main-screen'),
        _i36.RouteConfig(EditPhoneProfileUserScreenRoute.name,
            path: '/edit-phone-profile-user-screen'),
        _i36.RouteConfig(EditEmailProfileUserScreenRoute.name,
            path: '/edit-email-profile-user-screen'),
        _i36.RouteConfig(EditNameProfileUserScreenRoute.name,
            path: '/edit-name-profile-user-screen'),
        _i36.RouteConfig(EditAddressProfileUserScreenRoute.name,
            path: '/edit-address-profile-user-screen'),
        _i36.RouteConfig(VenmoLoginScreenRoute.name,
            path: '/venmo-login-screen'),
        _i36.RouteConfig(SelectPaymentTypeScreenRoute.name,
            path: '/select-payment-type-screen'),
        _i36.RouteConfig(NotificationScreenRoute.name,
            path: '/notification-screen'),
        _i36.RouteConfig(InvitePayoutMainScreenRoute.name,
            path: '/invite-payout-main-screen'),
        _i36.RouteConfig(RequestAtradeScreenRoute.name,
            path: '/request-atrade-screen'),
        _i36.RouteConfig(InviteTradeScreenRoute.name,
            path: '/invite-trade-screen'),
        _i36.RouteConfig(RequestSplitScreenRoute.name,
            path: '/request-split-screen'),
        _i36.RouteConfig(InviteSplitScreenRoute.name,
            path: '/invite-split-screen'),
        _i36.RouteConfig(InviteRejectedPayoutScreenRoute.name,
            path: '/invite-rejected-payout-screen'),
        _i36.RouteConfig(EditPasswordProfileUserScreenRoute.name,
            path: '/edit-password-profile-user-screen'),
        _i36.RouteConfig(ValidateCodeUserScreenRoute.name,
            path: '/validate-code-user-screen')
      ];
}

/// generated route for
/// [_i1.SplashScreen]
class SplashScreenRoute extends _i36.PageRouteInfo<SplashScreenRouteArgs> {
  SplashScreenRoute({void Function()? onBackCallback})
      : super(SplashScreenRoute.name,
            path: '/splash-screen',
            args: SplashScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'SplashScreenRoute';
}

class SplashScreenRouteArgs {
  const SplashScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'SplashScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i2.LoginScreen]
class LoginScreenRoute extends _i36.PageRouteInfo<LoginScreenRouteArgs> {
  LoginScreenRoute({void Function()? onBackCallback})
      : super(LoginScreenRoute.name,
            path: '/login-screen',
            args: LoginScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'LoginScreenRoute';
}

class LoginScreenRouteArgs {
  const LoginScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'LoginScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i3.EmailLoginScreen]
class EmailLoginScreenRoute
    extends _i36.PageRouteInfo<EmailLoginScreenRouteArgs> {
  EmailLoginScreenRoute({void Function()? onBackCallback})
      : super(EmailLoginScreenRoute.name,
            path: '/email-login-screen',
            args: EmailLoginScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'EmailLoginScreenRoute';
}

class EmailLoginScreenRouteArgs {
  const EmailLoginScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'EmailLoginScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i4.FaqsScreen]
class FaqsScreenRoute extends _i36.PageRouteInfo<FaqsScreenRouteArgs> {
  FaqsScreenRoute({void Function()? onBackCallback})
      : super(FaqsScreenRoute.name,
            path: '/faqs-screen',
            args: FaqsScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'FaqsScreenRoute';
}

class FaqsScreenRouteArgs {
  const FaqsScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'FaqsScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i5.PreviewAppScreen]
class PreviewAppScreenRoute
    extends _i36.PageRouteInfo<PreviewAppScreenRouteArgs> {
  PreviewAppScreenRoute({void Function()? onBackCallback})
      : super(PreviewAppScreenRoute.name,
            path: '/preview-app-screen',
            args: PreviewAppScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'PreviewAppScreenRoute';
}

class PreviewAppScreenRouteArgs {
  const PreviewAppScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'PreviewAppScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i6.PasswordLoginScreen]
class PasswordLoginScreenRoute
    extends _i36.PageRouteInfo<PasswordLoginScreenRouteArgs> {
  PasswordLoginScreenRoute(
      {void Function()? onBackCallback, dynamic email = ""})
      : super(PasswordLoginScreenRoute.name,
            path: '/password-login-screen',
            args: PasswordLoginScreenRouteArgs(
                onBackCallback: onBackCallback, email: email),
            rawQueryParams: {'email': email});

  static const String name = 'PasswordLoginScreenRoute';
}

class PasswordLoginScreenRouteArgs {
  const PasswordLoginScreenRouteArgs({this.onBackCallback, this.email = ""});

  final void Function()? onBackCallback;

  final dynamic email;

  @override
  String toString() {
    return 'PasswordLoginScreenRouteArgs{onBackCallback: $onBackCallback, email: $email}';
  }
}

/// generated route for
/// [_i7.ForgotPasswordLoginScreen]
class ForgotPasswordLoginScreenRoute
    extends _i36.PageRouteInfo<ForgotPasswordLoginScreenRouteArgs> {
  ForgotPasswordLoginScreenRoute(
      {void Function()? onBackCallback, String email = ""})
      : super(ForgotPasswordLoginScreenRoute.name,
            path: '/forgot-password-login-screen',
            args: ForgotPasswordLoginScreenRouteArgs(
                onBackCallback: onBackCallback, email: email),
            rawQueryParams: {'email': email});

  static const String name = 'ForgotPasswordLoginScreenRoute';
}

class ForgotPasswordLoginScreenRouteArgs {
  const ForgotPasswordLoginScreenRouteArgs(
      {this.onBackCallback, this.email = ""});

  final void Function()? onBackCallback;

  final String email;

  @override
  String toString() {
    return 'ForgotPasswordLoginScreenRouteArgs{onBackCallback: $onBackCallback, email: $email}';
  }
}

/// generated route for
/// [_i8.NewPasswordLoginScreen]
class NewPasswordLoginScreenRoute
    extends _i36.PageRouteInfo<NewPasswordLoginScreenRouteArgs> {
  NewPasswordLoginScreenRoute({void Function()? onBackCallback})
      : super(NewPasswordLoginScreenRoute.name,
            path: '/new-password-login-screen',
            args: NewPasswordLoginScreenRouteArgs(
                onBackCallback: onBackCallback));

  static const String name = 'NewPasswordLoginScreenRoute';
}

class NewPasswordLoginScreenRouteArgs {
  const NewPasswordLoginScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'NewPasswordLoginScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i9.RegisterEmailScreen]
class RegisterEmailScreenRoute
    extends _i36.PageRouteInfo<RegisterEmailScreenRouteArgs> {
  RegisterEmailScreenRoute({void Function()? onBackCallback})
      : super(RegisterEmailScreenRoute.name,
            path: '/register-email-screen',
            args: RegisterEmailScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'RegisterEmailScreenRoute';
}

class RegisterEmailScreenRouteArgs {
  const RegisterEmailScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'RegisterEmailScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i10.RegisterUserDataScreen]
class RegisterUserDataScreenRoute
    extends _i36.PageRouteInfo<RegisterUserDataScreenRouteArgs> {
  RegisterUserDataScreenRoute(
      {void Function()? onBackCallback,
      String email = "",
      _i38.Register? registerUser})
      : super(RegisterUserDataScreenRoute.name,
            path: '/register-user-data-screen',
            args: RegisterUserDataScreenRouteArgs(
                onBackCallback: onBackCallback,
                email: email,
                registerUser: registerUser),
            rawQueryParams: {'email': email, 'user': registerUser});

  static const String name = 'RegisterUserDataScreenRoute';
}

class RegisterUserDataScreenRouteArgs {
  const RegisterUserDataScreenRouteArgs(
      {this.onBackCallback, this.email = "", this.registerUser});

  final void Function()? onBackCallback;

  final String email;

  final _i38.Register? registerUser;

  @override
  String toString() {
    return 'RegisterUserDataScreenRouteArgs{onBackCallback: $onBackCallback, email: $email, registerUser: $registerUser}';
  }
}

/// generated route for
/// [_i11.RegisterTutorialScreen]
class RegisterTutorialScreenRoute extends _i36.PageRouteInfo<void> {
  const RegisterTutorialScreenRoute()
      : super(RegisterTutorialScreenRoute.name,
            path: '/register-tutorial-screen');

  static const String name = 'RegisterTutorialScreenRoute';
}

/// generated route for
/// [_i12.HomeScreen]
class HomeScreenRoute extends _i36.PageRouteInfo<HomeScreenRouteArgs> {
  HomeScreenRoute({void Function()? onBackCallback})
      : super(HomeScreenRoute.name,
            path: '/home-screen',
            args: HomeScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'HomeScreenRoute';
}

class HomeScreenRouteArgs {
  const HomeScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'HomeScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i13.PayOutDetailScreen]
class PayOutDetailScreenRoute
    extends _i36.PageRouteInfo<PayOutDetailScreenRouteArgs> {
  PayOutDetailScreenRoute(
      {void Function()? onBackCallback, required _i39.PayOut? payOut})
      : super(PayOutDetailScreenRoute.name,
            path: '/pay-out-detail-screen',
            args: PayOutDetailScreenRouteArgs(
                onBackCallback: onBackCallback, payOut: payOut),
            rawQueryParams: {'payOut': payOut});

  static const String name = 'PayOutDetailScreenRoute';
}

class PayOutDetailScreenRouteArgs {
  const PayOutDetailScreenRouteArgs(
      {this.onBackCallback, required this.payOut});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  @override
  String toString() {
    return 'PayOutDetailScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut}';
  }
}

/// generated route for
/// [_i14.ProfileUserScreen]
class ProfileUserScreenRoute
    extends _i36.PageRouteInfo<ProfileUserScreenRouteArgs> {
  ProfileUserScreenRoute({void Function()? onBackCallback})
      : super(ProfileUserScreenRoute.name,
            path: '/profile-user-screen',
            args: ProfileUserScreenRouteArgs(onBackCallback: onBackCallback));

  static const String name = 'ProfileUserScreenRoute';
}

class ProfileUserScreenRouteArgs {
  const ProfileUserScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'ProfileUserScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i15.UserScreen]
class UserScreenRoute extends _i36.PageRouteInfo<UserScreenRouteArgs> {
  UserScreenRoute({void Function()? onBackCallback, String id = ""})
      : super(UserScreenRoute.name,
            path: '/user-screen',
            args: UserScreenRouteArgs(onBackCallback: onBackCallback, id: id),
            rawQueryParams: {'id': id});

  static const String name = 'UserScreenRoute';
}

class UserScreenRouteArgs {
  const UserScreenRouteArgs({this.onBackCallback, this.id = ""});

  final void Function()? onBackCallback;

  final String id;

  @override
  String toString() {
    return 'UserScreenRouteArgs{onBackCallback: $onBackCallback, id: $id}';
  }
}

/// generated route for
/// [_i16.EditProfileUserScreen]
class EditProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditProfileUserScreenRouteArgs> {
  EditProfileUserScreenRoute(
      {void Function()? onBackCallback, required Function? editProfileComplete})
      : super(EditProfileUserScreenRoute.name,
            path: '/edit-profile-user-screen',
            args: EditProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback,
                editProfileComplete: editProfileComplete),
            rawQueryParams: {'editProfileComplete': editProfileComplete});

  static const String name = 'EditProfileUserScreenRoute';
}

class EditProfileUserScreenRouteArgs {
  const EditProfileUserScreenRouteArgs(
      {this.onBackCallback, required this.editProfileComplete});

  final void Function()? onBackCallback;

  final Function? editProfileComplete;

  @override
  String toString() {
    return 'EditProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, editProfileComplete: $editProfileComplete}';
  }
}

/// generated route for
/// [_i17.SuccessfulDialogScreen]
class SuccessfulDialogScreenRoute
    extends _i36.PageRouteInfo<SuccessfulDialogScreenRouteArgs> {
  SuccessfulDialogScreenRoute(
      {void Function()? onBackCallback,
      String cTitle = '',
      String cMessage = '',
      String cIcon = SVGImage.warningDialogIcon,
      String cCancelBtn = '',
      Function? onAceptClick,
      Function? onCancelClick})
      : super(SuccessfulDialogScreenRoute.name,
            path: '/successful-dialog-screen',
            args: SuccessfulDialogScreenRouteArgs(
                onBackCallback: onBackCallback,
                cTitle: cTitle,
                cMessage: cMessage,
                cIcon: cIcon,
                cCancelBtn: cCancelBtn,
                onAceptClick: onAceptClick,
                onCancelClick: onCancelClick),
            rawQueryParams: {
              'cTitle': cTitle,
              'cMessage': cMessage,
              'cIcon': cIcon,
              'cCancelBtn': cCancelBtn,
              'onAceptClick': onAceptClick,
              'onCancelClick': onCancelClick
            });

  static const String name = 'SuccessfulDialogScreenRoute';
}

class SuccessfulDialogScreenRouteArgs {
  const SuccessfulDialogScreenRouteArgs(
      {this.onBackCallback,
      this.cTitle = '',
      this.cMessage = '',
      this.cIcon = SVGImage.warningDialogIcon,
      this.cCancelBtn = '',
      this.onAceptClick,
      this.onCancelClick});

  final void Function()? onBackCallback;

  final String cTitle;

  final String cMessage;

  final String cIcon;

  final String cCancelBtn;

  final Function? onAceptClick;

  final Function? onCancelClick;

  @override
  String toString() {
    return 'SuccessfulDialogScreenRouteArgs{onBackCallback: $onBackCallback, cTitle: $cTitle, cMessage: $cMessage, cIcon: $cIcon, cCancelBtn: $cCancelBtn, onAceptClick: $onAceptClick, onCancelClick: $onCancelClick}';
  }
}

/// generated route for
/// [_i18.ChangeCorrectPassDialog]
class ChangeCorrectPassDialogRoute
    extends _i36.PageRouteInfo<ChangeCorrectPassDialogRouteArgs> {
  ChangeCorrectPassDialogRoute({void Function()? onBackCallback})
      : super(ChangeCorrectPassDialogRoute.name,
            path: '/change-correct-pass-dialog',
            args: ChangeCorrectPassDialogRouteArgs(
                onBackCallback: onBackCallback));

  static const String name = 'ChangeCorrectPassDialogRoute';
}

class ChangeCorrectPassDialogRouteArgs {
  const ChangeCorrectPassDialogRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'ChangeCorrectPassDialogRouteArgs{onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i19.ErrorDialogScreen]
class ErrorDialogScreenRoute
    extends _i36.PageRouteInfo<ErrorDialogScreenRouteArgs> {
  ErrorDialogScreenRoute(
      {void Function()? onBackCallback,
      String cTitle = '',
      String cMessage = '',
      String cIcon = SVGImage.warningDialogIcon})
      : super(ErrorDialogScreenRoute.name,
            path: '/error-dialog-screen',
            args: ErrorDialogScreenRouteArgs(
                onBackCallback: onBackCallback,
                cTitle: cTitle,
                cMessage: cMessage,
                cIcon: cIcon),
            rawQueryParams: {
              'cTitle': cTitle,
              'cMessage': cMessage,
              'cIcon': cIcon
            });

  static const String name = 'ErrorDialogScreenRoute';
}

class ErrorDialogScreenRouteArgs {
  const ErrorDialogScreenRouteArgs(
      {this.onBackCallback,
      this.cTitle = '',
      this.cMessage = '',
      this.cIcon = SVGImage.warningDialogIcon});

  final void Function()? onBackCallback;

  final String cTitle;

  final String cMessage;

  final String cIcon;

  @override
  String toString() {
    return 'ErrorDialogScreenRouteArgs{onBackCallback: $onBackCallback, cTitle: $cTitle, cMessage: $cMessage, cIcon: $cIcon}';
  }
}

/// generated route for
/// [_i20.CreatePayoutMainScreen]
class CreatePayoutMainScreenRoute
    extends _i36.PageRouteInfo<CreatePayoutMainScreenRouteArgs> {
  CreatePayoutMainScreenRoute(
      {void Function()? onBackCallback, _i39.PayOut? payOutToEdit})
      : super(CreatePayoutMainScreenRoute.name,
            path: '/create-payout-main-screen',
            args: CreatePayoutMainScreenRouteArgs(
                onBackCallback: onBackCallback, payOutToEdit: payOutToEdit));

  static const String name = 'CreatePayoutMainScreenRoute';
}

class CreatePayoutMainScreenRouteArgs {
  const CreatePayoutMainScreenRouteArgs(
      {this.onBackCallback, this.payOutToEdit});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOutToEdit;

  @override
  String toString() {
    return 'CreatePayoutMainScreenRouteArgs{onBackCallback: $onBackCallback, payOutToEdit: $payOutToEdit}';
  }
}

/// generated route for
/// [_i21.EditPhoneProfileUserScreen]
class EditPhoneProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditPhoneProfileUserScreenRouteArgs> {
  EditPhoneProfileUserScreenRoute(
      {void Function()? onBackCallback, _i40.User? user})
      : super(EditPhoneProfileUserScreenRoute.name,
            path: '/edit-phone-profile-user-screen',
            args: EditPhoneProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback, user: user),
            rawQueryParams: {'user': user});

  static const String name = 'EditPhoneProfileUserScreenRoute';
}

class EditPhoneProfileUserScreenRouteArgs {
  const EditPhoneProfileUserScreenRouteArgs({this.onBackCallback, this.user});

  final void Function()? onBackCallback;

  final _i40.User? user;

  @override
  String toString() {
    return 'EditPhoneProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, user: $user}';
  }
}

/// generated route for
/// [_i22.EditEmailProfileUserScreen]
class EditEmailProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditEmailProfileUserScreenRouteArgs> {
  EditEmailProfileUserScreenRoute(
      {void Function()? onBackCallback, _i40.User? user})
      : super(EditEmailProfileUserScreenRoute.name,
            path: '/edit-email-profile-user-screen',
            args: EditEmailProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback, user: user),
            rawQueryParams: {'user': user});

  static const String name = 'EditEmailProfileUserScreenRoute';
}

class EditEmailProfileUserScreenRouteArgs {
  const EditEmailProfileUserScreenRouteArgs({this.onBackCallback, this.user});

  final void Function()? onBackCallback;

  final _i40.User? user;

  @override
  String toString() {
    return 'EditEmailProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, user: $user}';
  }
}

/// generated route for
/// [_i23.EditNameProfileUserScreen]
class EditNameProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditNameProfileUserScreenRouteArgs> {
  EditNameProfileUserScreenRoute(
      {void Function()? onBackCallback,
      required _i40.User? user,
      required Function? editProfileComplete})
      : super(EditNameProfileUserScreenRoute.name,
            path: '/edit-name-profile-user-screen',
            args: EditNameProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback,
                user: user,
                editProfileComplete: editProfileComplete),
            rawQueryParams: {
              'user': user,
              'editProfileComplete': editProfileComplete
            });

  static const String name = 'EditNameProfileUserScreenRoute';
}

class EditNameProfileUserScreenRouteArgs {
  const EditNameProfileUserScreenRouteArgs(
      {this.onBackCallback,
      required this.user,
      required this.editProfileComplete});

  final void Function()? onBackCallback;

  final _i40.User? user;

  final Function? editProfileComplete;

  @override
  String toString() {
    return 'EditNameProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, user: $user, editProfileComplete: $editProfileComplete}';
  }
}

/// generated route for
/// [_i24.EditAddressProfileUserScreen]
class EditAddressProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditAddressProfileUserScreenRouteArgs> {
  EditAddressProfileUserScreenRoute(
      {void Function()? onBackCallback, _i40.User? user})
      : super(EditAddressProfileUserScreenRoute.name,
            path: '/edit-address-profile-user-screen',
            args: EditAddressProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback, user: user),
            rawQueryParams: {'user': user});

  static const String name = 'EditAddressProfileUserScreenRoute';
}

class EditAddressProfileUserScreenRouteArgs {
  const EditAddressProfileUserScreenRouteArgs({this.onBackCallback, this.user});

  final void Function()? onBackCallback;

  final _i40.User? user;

  @override
  String toString() {
    return 'EditAddressProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, user: $user}';
  }
}

/// generated route for
/// [_i25.VenmoLoginScreen]
class VenmoLoginScreenRoute
    extends _i36.PageRouteInfo<VenmoLoginScreenRouteArgs> {
  VenmoLoginScreenRoute(
      {void Function()? onBackCallback,
      required _i41.PayoutMember? member,
      required _i39.PayOut? payOut,
      required Function? onPaymentComplete})
      : super(VenmoLoginScreenRoute.name,
            path: '/venmo-login-screen',
            args: VenmoLoginScreenRouteArgs(
                onBackCallback: onBackCallback,
                member: member,
                payOut: payOut,
                onPaymentComplete: onPaymentComplete),
            rawQueryParams: {
              'member': member,
              'payOut': payOut,
              'onPaymentComplete': onPaymentComplete
            });

  static const String name = 'VenmoLoginScreenRoute';
}

class VenmoLoginScreenRouteArgs {
  const VenmoLoginScreenRouteArgs(
      {this.onBackCallback,
      required this.member,
      required this.payOut,
      required this.onPaymentComplete});

  final void Function()? onBackCallback;

  final _i41.PayoutMember? member;

  final _i39.PayOut? payOut;

  final Function? onPaymentComplete;

  @override
  String toString() {
    return 'VenmoLoginScreenRouteArgs{onBackCallback: $onBackCallback, member: $member, payOut: $payOut, onPaymentComplete: $onPaymentComplete}';
  }
}

/// generated route for
/// [_i26.SelectPaymentTypeScreen]
class SelectPaymentTypeScreenRoute
    extends _i36.PageRouteInfo<SelectPaymentTypeScreenRouteArgs> {
  SelectPaymentTypeScreenRoute(
      {void Function()? onBackCallback,
      required _i41.PayoutMember? member,
      required _i39.PayOut? payOut,
      required Function? onPaymentComplete})
      : super(SelectPaymentTypeScreenRoute.name,
            path: '/select-payment-type-screen',
            args: SelectPaymentTypeScreenRouteArgs(
                onBackCallback: onBackCallback,
                member: member,
                payOut: payOut,
                onPaymentComplete: onPaymentComplete),
            rawQueryParams: {
              'member': member,
              'payOut': payOut,
              'onPaymentComplete': onPaymentComplete
            });

  static const String name = 'SelectPaymentTypeScreenRoute';
}

class SelectPaymentTypeScreenRouteArgs {
  const SelectPaymentTypeScreenRouteArgs(
      {this.onBackCallback,
      required this.member,
      required this.payOut,
      required this.onPaymentComplete});

  final void Function()? onBackCallback;

  final _i41.PayoutMember? member;

  final _i39.PayOut? payOut;

  final Function? onPaymentComplete;

  @override
  String toString() {
    return 'SelectPaymentTypeScreenRouteArgs{onBackCallback: $onBackCallback, member: $member, payOut: $payOut, onPaymentComplete: $onPaymentComplete}';
  }
}

/// generated route for
/// [_i27.NotificationScreen]
class NotificationScreenRoute
    extends _i36.PageRouteInfo<NotificationScreenRouteArgs> {
  NotificationScreenRoute(
      {void Function()? onBackCallback,
      List<_i42.NotificationModel>? notificationLoaded})
      : super(NotificationScreenRoute.name,
            path: '/notification-screen',
            args: NotificationScreenRouteArgs(
                onBackCallback: onBackCallback,
                notificationLoaded: notificationLoaded));

  static const String name = 'NotificationScreenRoute';
}

class NotificationScreenRouteArgs {
  const NotificationScreenRouteArgs(
      {this.onBackCallback, this.notificationLoaded});

  final void Function()? onBackCallback;

  final List<_i42.NotificationModel>? notificationLoaded;

  @override
  String toString() {
    return 'NotificationScreenRouteArgs{onBackCallback: $onBackCallback, notificationLoaded: $notificationLoaded}';
  }
}

/// generated route for
/// [_i28.InvitePayoutMainScreen]
class InvitePayoutMainScreenRoute
    extends _i36.PageRouteInfo<InvitePayoutMainScreenRouteArgs> {
  InvitePayoutMainScreenRoute(
      {required _i39.PayOut? payOut, void Function()? onBackCallback})
      : super(InvitePayoutMainScreenRoute.name,
            path: '/invite-payout-main-screen',
            args: InvitePayoutMainScreenRouteArgs(
                payOut: payOut, onBackCallback: onBackCallback),
            rawQueryParams: {'payOut': payOut});

  static const String name = 'InvitePayoutMainScreenRoute';
}

class InvitePayoutMainScreenRouteArgs {
  const InvitePayoutMainScreenRouteArgs(
      {required this.payOut, this.onBackCallback});

  final _i39.PayOut? payOut;

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'InvitePayoutMainScreenRouteArgs{payOut: $payOut, onBackCallback: $onBackCallback}';
  }
}

/// generated route for
/// [_i29.RequestAtradeScreen]
class RequestAtradeScreenRoute
    extends _i36.PageRouteInfo<RequestAtradeScreenRouteArgs> {
  RequestAtradeScreenRoute(
      {required void Function()? onBackCallback, required _i39.PayOut? payOut})
      : super(RequestAtradeScreenRoute.name,
            path: '/request-atrade-screen',
            args: RequestAtradeScreenRouteArgs(
                onBackCallback: onBackCallback, payOut: payOut));

  static const String name = 'RequestAtradeScreenRoute';
}

class RequestAtradeScreenRouteArgs {
  const RequestAtradeScreenRouteArgs(
      {required this.onBackCallback, required this.payOut});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  @override
  String toString() {
    return 'RequestAtradeScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut}';
  }
}

/// generated route for
/// [_i30.InviteTradeScreen]
class InviteTradeScreenRoute
    extends _i36.PageRouteInfo<InviteTradeScreenRouteArgs> {
  InviteTradeScreenRoute(
      {required void Function()? onBackCallback,
      required _i39.PayOut? payOut,
      required int? notID,
      required int? requestedUserID})
      : super(InviteTradeScreenRoute.name,
            path: '/invite-trade-screen',
            args: InviteTradeScreenRouteArgs(
                onBackCallback: onBackCallback,
                payOut: payOut,
                notID: notID,
                requestedUserID: requestedUserID),
            rawQueryParams: {
              'payOut': payOut,
              'notID': notID,
              'requestedUserID': requestedUserID
            });

  static const String name = 'InviteTradeScreenRoute';
}

class InviteTradeScreenRouteArgs {
  const InviteTradeScreenRouteArgs(
      {required this.onBackCallback,
      required this.payOut,
      required this.notID,
      required this.requestedUserID});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  final int? notID;

  final int? requestedUserID;

  @override
  String toString() {
    return 'InviteTradeScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut, notID: $notID, requestedUserID: $requestedUserID}';
  }
}

/// generated route for
/// [_i31.RequestSplitScreen]
class RequestSplitScreenRoute
    extends _i36.PageRouteInfo<RequestSplitScreenRouteArgs> {
  RequestSplitScreenRoute(
      {required void Function()? onBackCallback, required _i39.PayOut? payOut})
      : super(RequestSplitScreenRoute.name,
            path: '/request-split-screen',
            args: RequestSplitScreenRouteArgs(
                onBackCallback: onBackCallback, payOut: payOut),
            rawQueryParams: {'payOut': payOut});

  static const String name = 'RequestSplitScreenRoute';
}

class RequestSplitScreenRouteArgs {
  const RequestSplitScreenRouteArgs(
      {required this.onBackCallback, required this.payOut});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  @override
  String toString() {
    return 'RequestSplitScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut}';
  }
}

/// generated route for
/// [_i32.InviteSplitScreen]
class InviteSplitScreenRoute
    extends _i36.PageRouteInfo<InviteSplitScreenRouteArgs> {
  InviteSplitScreenRoute(
      {required void Function()? onBackCallback,
      required _i39.PayOut? payOut,
      required int? requestedID,
      required int? requestedUserID,
      required int? notID})
      : super(InviteSplitScreenRoute.name,
            path: '/invite-split-screen',
            args: InviteSplitScreenRouteArgs(
                onBackCallback: onBackCallback,
                payOut: payOut,
                requestedID: requestedID,
                requestedUserID: requestedUserID,
                notID: notID),
            rawQueryParams: {
              'payOut': payOut,
              'requestedID': requestedID,
              'requestedUserID': requestedUserID,
              'notID': notID
            });

  static const String name = 'InviteSplitScreenRoute';
}

class InviteSplitScreenRouteArgs {
  const InviteSplitScreenRouteArgs(
      {required this.onBackCallback,
      required this.payOut,
      required this.requestedID,
      required this.requestedUserID,
      required this.notID});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  final int? requestedID;

  final int? requestedUserID;

  final int? notID;

  @override
  String toString() {
    return 'InviteSplitScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut, requestedID: $requestedID, requestedUserID: $requestedUserID, notID: $notID}';
  }
}

/// generated route for
/// [_i33.InviteRejectedPayoutScreen]
class InviteRejectedPayoutScreenRoute
    extends _i36.PageRouteInfo<InviteRejectedPayoutScreenRouteArgs> {
  InviteRejectedPayoutScreenRoute(
      {required void Function()? onBackCallback, _i39.PayOut? payOut})
      : super(InviteRejectedPayoutScreenRoute.name,
            path: '/invite-rejected-payout-screen',
            args: InviteRejectedPayoutScreenRouteArgs(
                onBackCallback: onBackCallback, payOut: payOut));

  static const String name = 'InviteRejectedPayoutScreenRoute';
}

class InviteRejectedPayoutScreenRouteArgs {
  const InviteRejectedPayoutScreenRouteArgs(
      {required this.onBackCallback, this.payOut});

  final void Function()? onBackCallback;

  final _i39.PayOut? payOut;

  @override
  String toString() {
    return 'InviteRejectedPayoutScreenRouteArgs{onBackCallback: $onBackCallback, payOut: $payOut}';
  }
}

/// generated route for
/// [_i34.EditPasswordProfileUserScreen]
class EditPasswordProfileUserScreenRoute
    extends _i36.PageRouteInfo<EditPasswordProfileUserScreenRouteArgs> {
  EditPasswordProfileUserScreenRoute(
      {void Function()? onBackCallback, _i40.User? user})
      : super(EditPasswordProfileUserScreenRoute.name,
            path: '/edit-password-profile-user-screen',
            args: EditPasswordProfileUserScreenRouteArgs(
                onBackCallback: onBackCallback, user: user),
            rawQueryParams: {'user': user});

  static const String name = 'EditPasswordProfileUserScreenRoute';
}

class EditPasswordProfileUserScreenRouteArgs {
  const EditPasswordProfileUserScreenRouteArgs(
      {this.onBackCallback, this.user});

  final void Function()? onBackCallback;

  final _i40.User? user;

  @override
  String toString() {
    return 'EditPasswordProfileUserScreenRouteArgs{onBackCallback: $onBackCallback, user: $user}';
  }
}

/// generated route for
/// [_i35.ValidateCodeUserScreen]
class ValidateCodeUserScreenRoute
    extends _i36.PageRouteInfo<ValidateCodeUserScreenRouteArgs> {
  ValidateCodeUserScreenRoute({void Function()? onBackCallback})
      : super(ValidateCodeUserScreenRoute.name,
            path: '/validate-code-user-screen',
            args: ValidateCodeUserScreenRouteArgs(
                onBackCallback: onBackCallback));

  static const String name = 'ValidateCodeUserScreenRoute';
}

class ValidateCodeUserScreenRouteArgs {
  const ValidateCodeUserScreenRouteArgs({this.onBackCallback});

  final void Function()? onBackCallback;

  @override
  String toString() {
    return 'ValidateCodeUserScreenRouteArgs{onBackCallback: $onBackCallback}';
  }
}
