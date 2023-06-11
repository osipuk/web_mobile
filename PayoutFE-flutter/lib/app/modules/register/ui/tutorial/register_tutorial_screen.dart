// ignore: must_be_immutable
import 'package:flutter/material.dart';
import 'package:pay_out/app/general/ui/poppins_text.dart';
import 'package:pay_out/app/modules/register/viewModel/tutorial/register_tutorial_view_model.dart';
import 'package:stacked/stacked.dart';
import 'package:youtube_player_flutter/youtube_player_flutter.dart';

// ignore: must_be_immutable
class RegisterTutorialScreen extends StatelessWidget {
  RegisterTutorialScreenViewModel? model;

  ///MARK: Inicializador de vista - vista modelo
  void onModelReady(RegisterTutorialScreenViewModel model) {
    // Llamar funciones de API (Solo se llama una vez al correr la vista)
  }

  Widget builderView(
      BuildContext context, RegisterTutorialScreenViewModel model) {
    this.model = model;
    return onBodyInitView(context);
  }

  @override
  Widget build(BuildContext context) {
    return ViewModelBuilder<RegisterTutorialScreenViewModel>.reactive(
        builder: (context, model, child) => builderView(context, model),
        viewModelBuilder: () => RegisterTutorialScreenViewModel(context),
        onModelReady: (model) => this.onModelReady(model));
  }

  Widget onBodyInitView(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        headerView(),
        body(context),
      ],
    );
  }

  Widget headerView() {
    return Container(
      width: double.infinity,
      margin: EdgeInsets.only(left: 16, top: 16),
      child: PoppinsText(
        align: TextAlign.left,
        content: 'Tutorial',
        fontWeight: FontWeight.bold,
        fontSize: 28,
      ),
    );
  }

  Widget body(BuildContext context) {
    return Container(
      height: MediaQuery.of(context).size.height / 2,
      child: Center(
        child: YoutubePlayer(
            controller: model?.controller ??
                YoutubePlayerController(initialVideoId: ""),
            showVideoProgressIndicator: true,
            progressIndicatorColor: Colors.amber,
            aspectRatio: 16 / 9,
            liveUIColor: Colors.white,
            onReady: () {
              //_controller.addListener(listener);
            }),
      ),
    );
  }
}
