import 'package:flutter/material.dart';
import 'package:pay_out/app/general/ui/general_step_screen.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/faqs/model/faq.dart';
import 'package:pay_out/app/modules/faqs/viewModel/faqs_screen_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:stacked/stacked_annotations.dart';
import 'package:url_launcher/url_launcher.dart';

// ignore: must_be_immutable
class FaqsScreen extends GeneralStepScreen {
  FaqsScreenViewModel? model;

  FaqsScreen({
    @queryParam VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  ///MARK: Inicializador de vista - vista modelo
  void onModelReady(FaqsScreenViewModel model) {
    model.getFaqsList((error) {});
  }

  Widget builderView(BuildContext context, FaqsScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<FaqsScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => FaqsScreenViewModel(context),
        onModelReady: (model) => this.onModelReady(model));
  }

  @override
  Widget bodyView() {
    return Container(
      child: ListView.builder(
        itemCount: model?.faqs.length,
        itemBuilder: (context, index) {
          final item = model?.faqs[index];
          return faqInternalView(item);
        },
      ),
    );
  }

  Widget faqInternalView(Faq? faq) {
    return Container(
        margin: EdgeInsets.only(bottom: 80),
        child: ListTile(
            title: Container(
              margin: EdgeInsets.only(bottom: 16),
              child: PoppinsText(
                content: faq?.question,
                fontSize: 16,
              ),
            ),
            subtitle: PoppinsText(
              content: faq?.answer,
              textColor: Colors.black,
              maxLines: 30,
              linkOpen: (link) async {
                if (await canLaunch(link.url)) {
                  await launch(link.url);
                }
              },
            )));
  }

  @override
  String title() {
    return 'FAQs';
  }

  @override
  String buttonTitle() {
    return 'Login';
  }

  @override
  void onButtonTapped(BuildContext context) {
    onBackPressed(context);
  }

  @override
  void onBackPressed(BuildContext context) {
    model?.back();
  }
}
