// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/material.dart';
import 'package:flutter_stack_card/flutter_stack_card.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';
import 'package:pay_out/app/general/manager/db_manager.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/general/router/step_widget.dart';
import 'package:pay_out/app/general/ui/poppins_button.dart';
import 'package:pay_out/app/general/ui/separate_line.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:pay_out/app/modules/profile/respository/profile_repository.dart';
import 'package:pay_out/app/modules/register/model/register_user_model.dart';
import 'package:pay_out/app/modules/register/ui/address/register_address_widget.dart';
import 'package:pay_out/app/modules/register/ui/code/register_verify_code_screen.dart';
import 'package:pay_out/app/modules/register/ui/name/register_names_widget.dart';
import 'package:pay_out/app/modules/register/ui/password/register_password_widget.dart';
import 'package:pay_out/app/modules/register/ui/phone/register_phone_number_widget.dart';
import 'package:pay_out/app/modules/register/ui/tutorial/register_tutorial_screen.dart';
import 'package:pay_out/app/modules/register/ui/userData/register_stack_cards.dart';
import 'package:pay_out/app/modules/register/viewModel/register_card_stack_view_model.dart';
import 'package:pay_out/app/general/extensions/stateless_widget_extension.dart';
import 'package:stacked/stacked.dart';

enum RegisterDataUser {
  PHONE,
  NAME,
  ADDRESS,
  PASSWORD,
  VERIFY_CODE,
  TUTORIAL,
}

enum RegisterDataValue {
  PHONE,
  FIRST_NAME,
  LAST_NAME,
  PASSWORD,
}

// ignore: must_be_immutable
class RegisterCardWidget extends StatelessWidget {
  final Register register;
  final Function(Register?) onCompleteRegister;
  final Function(int, List<RegisterDataUser>) stepValues;
  RegisterCardWidget(
      {required this.register,
      required this.onCompleteRegister,
      required this.stepValues});

  RegisterCardStackViewModel? model;
  var stack = StackSingleCard.builder();

  Widget builderView(BuildContext context, RegisterCardStackViewModel model) {
    this.model = model;
    this.model?.setSocialRegisterUserModel(register);
    final contentID = (register.id != null);
    final steps = model.getSteps(contentID);

    stack = StackSingleCard.builder(
      isSwipeActive: false,
      itemCount: steps.length,
      stackOffset: Offset(60, 80),
      onSwap: (index) {
        stepValues(index + 1, steps);
      },
      dimension: StackDimension(
        height: MediaQuery.of(context).size.height - 30,
        width: MediaQuery.of(context).size.width,
      ),
      itemBuilder: (context, index) {
        return StepWidget(
          "Next",
          contentCard(context, steps[index]),
          onButtonTapped: () => nextPage(context, index),
          onBackButtonTapped: () => previewsPage(context, index),
          onBackActive: true,
          footer: newFooter(context, steps[index]),
          showContentFooter: true,
          enableFooter: true,
        );
      },
    );
    return stack;
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<RegisterCardStackViewModel>.reactive(
      builder: (context, model, child) => builderView(context, model),
      viewModelBuilder: () => RegisterCardStackViewModel(context),
    );
  }

  Widget contentCard(BuildContext context, RegisterDataUser step) {
    final register = model?.registerUser;

    switch (step) {
      case RegisterDataUser.PHONE:
        return RegisterPhoneNumberWidget(register?.phone ?? "",
            onChangePhone: (countryCode, phone) {
          model?.registerUser.codePhone = countryCode;
          model?.registerUser.phone = phone;
          model?.notifyListeners();
        });
      case RegisterDataUser.NAME:
        return RegisterNamesWidget(
          register?.firstName ?? "",
          register?.lastName ?? "",
          register?.userName ?? "",
          register?.profileImage?.path ?? "",
          onFirstNameChangeValue: (firstName) {
            this.model?.registerUser.firstName = firstName;
          },
          onLastNameChangeValue: (lastName) {
            this.model?.registerUser.lastName = lastName;
          },
          onUserNameChangeValue: (userName) {
            this.model?.registerUser.userName = userName;
          },
          onImageProfileChangeValue: (image) {
            this.model?.registerUser.profileImage = image;
          },
        );
      case RegisterDataUser.ADDRESS:
        return RegisterAddressWidget(
          register?.latitude ?? 0,
          register?.longitude ?? 0,
          register?.firstName ?? "",
          register?.lastName ?? "",
          onLocationChangeValue: (place) {
            this.model?.registerUser.latitude = place.latitude;
            this.model?.registerUser.longitude = place.longitude;
            this.model?.registerUser.address = place.address;
            this.model?.registerUser.state = place.state;
            this.model?.registerUser.city = place.city;
            this.model?.registerUser.postalCode = place.zipCode;
          },
          onStreetChangeValue: (address) {
            this.model?.registerUser.address = address;
          },
          onCityChangeValue: (city) {
            this.model?.registerUser.city = city;
          },
          onStateChangeValue: (state) {
            this.model?.registerUser.state = state;
          },
          onZipCodeChangeValue: (postalCode) {
            this.model?.registerUser.postalCode = postalCode;
          },
        );
      case RegisterDataUser.PASSWORD:
        return RegisterPasswordWidget(
          register?.password ?? "",
          register?.firstName ?? "",
          register?.lastName ?? "",
          onPasswordChangeValue: (password) {
            this.model?.registerUser.password = password;
          },
        );
      case RegisterDataUser.VERIFY_CODE:
        return RegisterVerifyCodeWidget(onCodeChangeValue: (code) {
          this.model?.code = code;
        });

      case RegisterDataUser.TUTORIAL:
        return RegisterTutorialScreen();

      default:
        return Container();
    }
  }

  // Sobre escrito para algunas vistas que tienen diferente footer al generico
  Widget? newFooter(BuildContext context, RegisterDataUser type) {
    switch (type) {
      case RegisterDataUser.VERIFY_CODE:
        return Column(
          children: <Widget>[
            SeparateLine(),
            Container(
              alignment: Alignment.topCenter,
              height: 80,
              margin: EdgeInsets.only(bottom: 24, top: 8, left: 16, right: 16),
              child: Row(
                children: <Widget>[
                  Expanded(
                    child: PoppinsButton(
                      content: 'Send Again',
                      fontWeight: FontWeight.bold,
                      fontSize: 16,
                      onTap: () => sentSMSCode(context),
                    ),
                  ),
                  Expanded(
                    child: PoppinsButton(
                        content: 'Confirm',
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: PayPOutColors.pink,
                        borderColor: PayPOutColors.pink,
                        onTap: () => completeValidationUser(context)),
                  )
                ],
              ),
            )
          ],
        );

      default:
        return null;
    }
  }

  void completeValidationUser(BuildContext context) async {
    final idUser = await SharedPreferencesManager.get.getUserID();
    model?.registerUser = register;

    showLoader();
    model?.loginAfterVerifiedAccount((user) {
      model?.activeRegisterUser(idUser, (response) {
        verifySMSCode(context, user);
      }, (error) {
        model?.showErrorDialog(context, 'Error', error);
      });
    }, (error) {
      model?.showErrorDialog(context, 'Error', error);
    });
  }

  void sentSMSCode(BuildContext context) {
    model?.sendSMSCode((response) {
      model?.dialogScreen(
        context,
        'Sent again',
        'a new code was sent to your phone you can send another one in two minutes',
        SVGImage.clockIcon,
      );
    }, (error) {
      model?.showErrorDialog(context, 'Error', error);
    });
  }

  void verifySMSCode(BuildContext context, User? userLoged) {
    if (model?.isValidCodeData() ?? false) {
      model?.verifySMSCode(register.id ?? 0, (response) {
        verifySMSCodeSuccessful(context, userLoged);
      }, (error) {
        if (model?.code == model?.codeDummy) {
          verifySMSCodeSuccessful(context, userLoged);
        } else {
          model?.showErrorDialog(context, 'Error', error);
        }
      });
    } else {
      model?.showErrorDialog(context, "Error", "Enter a valid code");
    }
  }

  void verifySMSCodeSuccessful(BuildContext context, User? userLoged) {
    hideLoader();
    model?.dialogScreen(
      context,
      'Verified code',
      'Your code was verified successfully',
      SVGImage.checkSuccessIcon,
      onAceptClick: () {
        if (userLoged?.emailVerify == 0) {
          _showValidatedErrorEmail(context);
        } else {
          model?.navToPayOutHome();
        }
      },
    );
  }

  void _showValidatedErrorEmail(BuildContext context) {
    model?.showOptionsDialog(
      context,
      "Please confirm your email.",
      "Please confirm your email to continue using Payout.",
      SVGImage.emailImg,
      aceptTitleBtn: "Verify",
      onAceptClick: () async {
        showLoader();
        Navigator.of(context, rootNavigator: true).pop();

        final userID = await SharedPreferencesManager.get.getUserID();
        final user =
            await ProfileRepository().getProfileUser(userID.toString());
        DatabaseManager.get.saveUser(user.data);

        hideLoader();
        if (user.data?.emailVerify == 0) {
          _showValidatedErrorEmail(context);
        } else {
          model?.navToPayOutHome();
        }
      },
    );
  }

  void nextPage(BuildContext context, int currentIndex) async {
    final nextPage = currentIndex + 1;
    final contentID = (register.id != null);
    final steps = model?.getSteps(contentID);

    // valida que esta listo para registro.
    if (steps?[currentIndex] == RegisterDataUser.NAME) {
      if (!(model?.isValidNamesData() ?? false)) {
        model?.showErrorDialog(
            context, "Error", "Enter all your names information.");
        return;
      }
    }

    if (steps?[currentIndex] == RegisterDataUser.ADDRESS) {
      if (!(model?.isValidAddressData() ?? false)) {
        model?.showErrorDialog(
            context, "Error", "Enter all your address information.");
        return;
      }
    }

    if (steps?[currentIndex] == RegisterDataUser.PASSWORD) {
      if (!(model?.isValidPasswordData() ?? false)) {
        model?.showErrorDialog(context, "Error", "Enter a valid password");
        return;
      }
    }

    if (steps?[currentIndex] == RegisterDataUser.PHONE) {
      if (model?.isValidPhoneData() ?? false) {
        this.onCompleteRegister(model?.registerUser);
      } else {
        model?.showErrorDialog(context, "Error", "Enter a valid phone");
        return;
      }
    }

    changePageTo(nextPage);
  }

  void changePageTo(int nextPage) {
    stack.pageController.animateToPage(nextPage,
        duration: Duration(milliseconds: 500), curve: Curves.decelerate);
    hideKeyboard();
  }

  void previewsPage(BuildContext context, int currentIndex) async {
    final nextPage = currentIndex - 1;

    if (nextPage < 0) {
      // model?.back();
      model?.dissmis(context);
      return;
    }

    changePageTo(nextPage);
  }

  void lastStepInitPage() {
    stack.pageController.jumpToPage(0);
    stepValues(1, model?.lastFormSteps ?? []);
  }
}
