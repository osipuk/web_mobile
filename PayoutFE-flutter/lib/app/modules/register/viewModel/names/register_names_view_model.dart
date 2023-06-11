import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:image_picker/image_picker.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/router/pay_out_view_model.dart';

class RegisterNameScreenViewModel extends PayOutViewModel {
  File? imageFile;
  String pathUserImage = "";

  RegisterNameScreenViewModel(BuildContext context) : super(context);

  Widget getUserImage() {
    if (imageFile == null && (pathUserImage.isEmpty)) {
      return SvgPicture.asset(SVGImage.userIcon);
    }

    return ClipOval(
        child: (imageFile == null)
            ? Image.network(pathUserImage, height: 80, width: 80)
            : Image.file(imageFile!, fit: BoxFit.cover, height: 80, width: 80));
  }

  Future<File> openGallery() async {
    final pickedFile =
        await ImagePicker().pickImage(source: ImageSource.gallery);
    imageFile = File(pickedFile?.path ?? "");
    notify();
    return imageFile!;
  }

  Future<File> openCamera() async {
    final pickedFile =
        await ImagePicker().pickImage(source: ImageSource.camera);
    imageFile = File(pickedFile?.path ?? "");
    notify();
    return imageFile!;
  }
}
