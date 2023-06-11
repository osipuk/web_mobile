import 'package:flutter/material.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';
import 'package:youtube_player_flutter/youtube_player_flutter.dart';

class RegisterTutorialScreenViewModel extends PayOutViewModel {
  RegisterTutorialScreenViewModel(BuildContext context) : super(context);

  YoutubePlayerController controller = YoutubePlayerController(
    initialVideoId: 'iLnmTe5Q2Qw',
    flags: YoutubePlayerFlags(
      autoPlay: false,
      mute: true,
    ),
  );
}
