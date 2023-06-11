import 'package:auto_route/auto_route.dart';
import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/ui/general_screen.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/home/model/payout_invitation.dart';
import 'package:pay_out/app/modules/home/model/payout_member.dart';
import 'package:pay_out/app/modules/home/model/venmo_payment_request.dart';
import 'package:pay_out/app/modules/venmoPayment/ui/venmo_form_screen.dart';
import 'package:pay_out/app/modules/venmoPayment/viewModel/venmo_login_view_model.dart';
import 'package:stacked/stacked.dart';

enum VenmoLoginState { INIT, ON_WAIT, ON_LOGGED, ON_FINISH, ON_ERROR }

// ignore: must_be_immutable
class VenmoLoginScreen extends GeneralScreen {
  VenmoLoginViewModel? model;

  VenmoLoginScreen({
    @queryParam VoidCallback? onBackCallback,
    @queryParam required this.member,
    @queryParam required this.payOut,
    @queryParam required this.onPaymentComplete,
  }) : super(onBackCallback);
  // Params
  PayOut? payOut;
  PayoutMember? member;
  Function? onPaymentComplete;

  InAppWebViewController? _controller;
  InAppWebViewGroupOptions options = InAppWebViewGroupOptions(
      crossPlatform: InAppWebViewOptions(
        useShouldOverrideUrlLoading: true,
        mediaPlaybackRequiresUserGesture: false,
      ),
      android: AndroidInAppWebViewOptions(
        useHybridComposition: true,
      ),
      ios: IOSInAppWebViewOptions(
        allowsInlineMediaPlayback: true,
      ));

  @override
  Widget mainBuild(BuildContext context) {
    return ViewModelBuilder<VenmoLoginViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => VenmoLoginViewModel(context),
      onModelReady: (model) {
        showLoader();
        SharedPreferencesManager.get.venmoAuthToken().then((token) {
          if (token.isNotEmpty) {
            model.status = VenmoLoginState.ON_LOGGED;
            hideLoader();
          } else {
            model.status = VenmoLoginState.ON_WAIT;
          }
          model.notify();
        });
      },
    );
  }

  Widget navBar(BuildContext context) {
    return SafeArea(
      child: Container(
        height: 30,
        width: double.infinity,
        margin: EdgeInsets.only(top: 24, right: 32, left: 8),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.start,
          children: [
            onBackWidget(context),
            onNavTitle(context),
          ],
        ),
      ),
    );
  }

  Widget onBackWidget(BuildContext context) {
    return IconButton(
      icon: Icon(Icons.arrow_back, color: Colors.white),
      onPressed: () => model?.back(),
    );
  }

  Widget onNavTitle(BuildContext context) {
    return Expanded(
      child: Center(
        child: PoppinsText(
          content: model?.status == VenmoLoginState.ON_LOGGED
              ? ""
              : "Pay with Venmo",
          textColor: Colors.white,
          fontSize: 18,
        ),
      ),
    );
  }

  Widget builderView(BuildContext context, VenmoLoginViewModel model) {
    this.model = model;
    return Container(
      child: Stack(
        children: [
          backgroundImage(context),
          SafeArea(
            child: Column(
              children: [
                navBar(context),
                backgroundBody(context),
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget backgroundBody(BuildContext context) {
    return Expanded(
      child: Container(
        margin: EdgeInsets.only(
          left: 16,
          right: 16,
          top: 30,
        ),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.all(
            Radius.circular(30.0),
          ),
        ),
        child: bodyView(context),
      ),
    );
  }

  Widget bodyView(BuildContext context) {
    switch (model?.status) {
      case VenmoLoginState.INIT:
        return Container();
      case VenmoLoginState.ON_WAIT:
        return webView(context);
      case VenmoLoginState.ON_LOGGED:
        return VenmoPaymentFormScreen(
          onBackCallback: onBackCallback,
          payOut: payOut,
          onButtonTapped: (userName, note) {
            sentPaymentIntent(context, userName, note);
          },
          onBackTapped: () {
            model?.back();
          },
        );
      default:
        return Container();
    }
  }

  Widget webView(BuildContext context) {
    return Container(
      color: Colors.white,
      margin: EdgeInsets.all(16),
      child: Stack(
        children: [
          InAppWebView(
            key: Key("webKey"),
            initialUrlRequest: URLRequest(url: Uri.parse(model!.venmoLoginApi)),
            onWebViewCreated: (controller) {
              _controller = controller;
            },
            onLoadStart: (controller, url) {
              showLoader();
            },
            onLoadStop: (controller, url) {
              readJS(context);
            },
          ),
        ],
      ),
    );
  }

  void readJS(BuildContext context) async {
    String html = await _controller?.evaluateJavascript(
            source:
                "window.document.getElementsByTagName('html')[0].outerHTML;") ??
        '';

    // MARK: - Inicializado
    if (model?.status == VenmoLoginState.ON_WAIT &&
        html.contains("Authorize an Application")) {
      onWaitStatus(html);
      return;
    }

    // MARK: - recien Logeado
    if (html.contains("access token") && !html.contains("error")) {
      onSuccessfulLoginStatus(html);
      return;
    }

    // MARK: - recien Logeado
    if (html.contains("was incorrect") || html.contains("Invalid code")) {
      onErrorStatus(html, context);
    }

    _controller?.loadUrl(
        urlRequest: URLRequest(url: Uri.parse(model?.venmoLoginApi ?? "")));
    delay(Duration(seconds: 5), () {
      hideLoader();
    });
  }

  //MARK: - Webview status functiosn

  void onWaitStatus(String html) {
    if (model?.status == VenmoLoginState.ON_WAIT &&
        html.contains("Authorize an Application")) {
      hideLoader();
      model?.isLoading = false;
      model?.notify();
    }
  }

  void onSuccessfulLoginStatus(String html) {
    String token = _getToken(html);
    if (token.isNotEmpty) {
      model?.status = VenmoLoginState.ON_LOGGED;
      SharedPreferencesManager.get.saveVenmoAuthToken(token);
    }
    model?.notify();
    hideLoader();
  }

  void onErrorStatus(String html, BuildContext context) {
    _controller?.loadUrl(
        urlRequest: URLRequest(url: Uri.parse(model?.venmoLoginApi ?? "")));
    delay(Duration(seconds: 1), () {
      model?.showErrorDialog(
          context, "Error", "Enter a valid email and / or password.");
    });
  }

  void onLogOutStatus() {
    SharedPreferencesManager.get.deleteVenmoAuthToken();
    model?.notify();
  }

  //END MARK:

  String _getToken(String html) {
    List<String> t = html.split("<b>");
    String strongToken = t.firstWhere((element) => element.contains("access"));

    String fToken = strongToken.replaceAll("access token:</b> ", "");
    return fToken.replaceAll("<br>", "");
  }

  void sentPaymentIntent(
      BuildContext context, String? userName, String? note) async {
    String accessToken = await SharedPreferencesManager.get.venmoAuthToken();
    var request = VenmoPaymentRequest.byUserName(
      accessToken: accessToken,
      amount: payOut!.amountPerDeduction.toString(),
      userName: "nabz-ahmed", //userName,
      note: note ?? "",
    );

    //MARK: send postVenmoPayment
    showLoader();
    model?.postVenmoPayment(request, (onResponse) {
      model?.markVenmoPaymentSuccessfull(payOut, (markResponse) {
        _showPaymentSuccesfull(context, userName);
      }, (error) {
        _showPaymentErrorl(context, error);
      });
    }, (error) {
      _showPaymentErrorl(context, error);
    });
  }

  void _showPaymentSuccesfull(BuildContext context, String? userName) {
    model?.dialogScreen(
      context,
      "Successful payment",
      "Payment of ${payOut?.amountPerDeduction} has been successfully sent to $userName",
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        onPaymentComplete?.call();
        Navigator.of(context).pop();
        model?.navToPayOutHome();
      },
    );
  }

  void _showPaymentErrorl(BuildContext context, String? error) {
    model?.showErrorDialog(
      context,
      "Failed payment",
      error ?? "Payment could not be completed, please try again later.",
    );
  }
}
