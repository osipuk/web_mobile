import 'package:flutter/material.dart';
import 'package:pay_out/app/general/ui/general_step_screen.dart';
import 'package:pay_out/app/modules/previewApp/viewModel/preview_app_screen_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:youtube_player_flutter/youtube_player_flutter.dart';

// ignore: must_be_immutable
class PreviewAppScreen extends GeneralStepScreen {
  PreviewAppScreenViewModel? model;

  PreviewAppScreen({
    VoidCallback? onBackCallback,
  }) : super(onBackCallback);

  ///MARK: Inicializador de vista - vista modelo
  void onModelReady(PreviewAppScreenViewModel model) {
    // Llamar funciones de API (Solo se llama una vez al correr la vista)
  }

  Widget builderView(BuildContext context, PreviewAppScreenViewModel model) {
    this.model = model;
    return generalView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<PreviewAppScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => PreviewAppScreenViewModel(context),
        onModelReady: (model) => this.onModelReady(model));
  }

  @override
  Widget bodyView() {
    return Center(
      child: YoutubePlayer(
          controller:
              model?.controller ?? YoutubePlayerController(initialVideoId: ''),
          showVideoProgressIndicator: true,
          progressIndicatorColor: Colors.amber,
          aspectRatio: 16 / 9,
          liveUIColor: Colors.white,
          onReady: () {
            //_controller.addListener(listener);
          }),
    );
  }

  @override
  String title() {
    return 'Preview App';
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
