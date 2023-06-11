import 'package:auto_route/auto_route.dart';
import 'package:pay_out/app/modules/createPayout/ui/create_payout_main_view.dart';
import 'package:pay_out/app/modules/editProfile/ui/addressStep/edit_address_screen.dart';
import 'package:pay_out/app/modules/editProfile/ui/edit_profile_screen.dart';
import 'package:pay_out/app/modules/editProfile/ui/emailStep/edit_email_screen.dart';
import 'package:pay_out/app/modules/editProfile/ui/nameStep/edit_name_screen.dart';
import 'package:pay_out/app/modules/editProfile/ui/password/edit_password_screen.dart';
import 'package:pay_out/app/modules/editProfile/ui/phoneStep/edit_phone_number_screen.dart';
import 'package:pay_out/app/modules/faqs/ui/faqs_screen.dart';
import 'package:pay_out/app/modules/home/ui/home_screen.dart';
import 'package:pay_out/app/modules/invitationPayout/ui/invite_payout_main_view.dart';
import 'package:pay_out/app/modules/invitationRejected/view/invitation_rejected.dart';
import 'package:pay_out/app/modules/invitationSplit/ui/invitation_split_screen.dart';
import 'package:pay_out/app/modules/invitationTrade/ui/invitation_trade_screen.dart';
import 'package:pay_out/app/modules/login/ui/email/email_login_screen.dart';
import 'package:pay_out/app/modules/login/ui/main/login_screen.dart';
import 'package:pay_out/app/modules/login/ui/password/forgot_password_login_screen.dart';
import 'package:pay_out/app/modules/login/ui/password/new_password_screen.dart';
import 'package:pay_out/app/modules/login/ui/password/password_login_screen.dart';
import 'package:pay_out/app/modules/notifications/view/notifications_screen.dart';
import 'package:pay_out/app/modules/payoutDetail/ui/detail_pay_out_screen.dart';
import 'package:pay_out/app/modules/popUps/change_correct_password_dialog.dart';
import 'package:pay_out/app/modules/popUps/error_dialog_screen.dart';
import 'package:pay_out/app/modules/popUps/successfull_dialog_screen.dart';
import 'package:pay_out/app/modules/previewApp/ui/preview_app_screen.dart';
import 'package:pay_out/app/modules/profile/ui/profile_user_screen.dart';
import 'package:pay_out/app/modules/register/ui/email/register_email_screen.dart';
import 'package:pay_out/app/modules/register/ui/tutorial/register_tutorial_screen.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_user_data_screen.dart';
import 'package:pay_out/app/modules/requestSplit/ui/request_split_screen.dart';
import 'package:pay_out/app/modules/requestTrade/ui/request_trade_screen.dart';
import 'package:pay_out/app/modules/selectPayment/ui/payout_select_paymnet_type_screen.dart';
import 'package:pay_out/app/modules/splash/ui/splash_screen.dart';
import 'package:pay_out/app/modules/user/ui/user_screen.dart';
import 'package:pay_out/app/modules/validatePendingCode/ui/validate_pending_code_screen.dart';
import 'package:pay_out/app/modules/venmoPayment/ui/venmo_login_screen.dart';

@MaterialAutoRouter(routes: <AutoRoute>[
  PayOutScreenRoute(page: SplashScreen),
  PayOutScreenRoute(page: LoginScreen),
  PayOutScreenRoute(page: EmailLoginScreen),
  PayOutScreenRoute(page: FaqsScreen),
  PayOutScreenRoute(page: PreviewAppScreen),
  PayOutScreenRoute(page: PasswordLoginScreen),
  PayOutScreenRoute(page: ForgotPasswordLoginScreen),
  PayOutScreenRoute(page: NewPasswordLoginScreen),
  PayOutScreenRoute(page: RegisterEmailScreen),
  PayOutScreenRoute(page: RegisterUserDataScreen),
  PayOutScreenRoute(page: RegisterTutorialScreen),
  PayOutScreenRoute(page: HomeScreen),
  PayOutScreenRoute(page: PayOutDetailScreen),
  PayOutScreenRoute(page: ProfileUserScreen),
  PayOutScreenRoute(page: UserScreen),
  PayOutScreenRoute(page: EditProfileUserScreen),
  PayOutDialogRoute(page: SuccessfulDialogScreen),
  PayOutDialogRoute(page: ChangeCorrectPassDialog),
  PayOutDialogRoute(page: ErrorDialogScreen),
  PayOutScreenRoute(page: CreatePayoutMainScreen),
  PayOutScreenRoute(page: EditPhoneProfileUserScreen),
  PayOutScreenRoute(page: EditEmailProfileUserScreen),
  PayOutScreenRoute(page: EditNameProfileUserScreen),
  PayOutScreenRoute(page: EditAddressProfileUserScreen),
  PayOutScreenRoute(page: VenmoLoginScreen),
  PayOutScreenRoute(page: SelectPaymentTypeScreen),
  PayOutTabRoute(page: NotificationScreen),
  PayOutScreenRoute(page: InvitePayoutMainScreen),
  PayOutScreenRoute(page: RequestAtradeScreen),
  PayOutScreenRoute(page: InviteTradeScreen),
  PayOutScreenRoute(page: RequestSplitScreen),
  PayOutScreenRoute(page: InviteSplitScreen),
  PayOutScreenRoute(page: InviteRejectedPayoutScreen),
  PayOutScreenRoute(page: EditPasswordProfileUserScreen),
  PayOutScreenRoute(page: ValidateCodeUserScreen),
])
class $AppRouter {}

//ROUTE APP ---
class PayOutScreenRoute<T> extends CupertinoRoute<T> {
  const PayOutScreenRoute({
    required Type page,
  }) : super(
          page: page,
          fullscreenDialog: false,
        );
}

class PayOutDialogRoute<T> extends CustomRoute<T> {
  const PayOutDialogRoute({
    required Type page,
  }) : super(
          page: page,
          fullscreenDialog: true,
          transitionsBuilder: TransitionsBuilders.fadeIn,
          reverseDurationInMilliseconds: 300,
          durationInMilliseconds: 300,
          opaque: false,
        );
}

class PayOutTabRoute<T> extends CustomRoute<T> {
  const PayOutTabRoute({
    required Type page,
  }) : super(
          page: page,
          fullscreenDialog: true,
          transitionsBuilder: TransitionsBuilders.fadeIn,
          reverseDurationInMilliseconds: 100,
          durationInMilliseconds: 100,
          opaque: false,
        );
}
