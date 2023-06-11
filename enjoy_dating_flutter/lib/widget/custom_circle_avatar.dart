import 'dart:io';

import 'package:Enjoy/constants/colors.dart';
import 'package:flutter/material.dart';

class CustomCircleAvatar extends StatelessWidget {
  final double height;
  final double width;
  final String imageUrl;
  bool localImage;
  bool assetImage;
  final File? localImageFile;

  CustomCircleAvatar(
      {Key? key,
      required this.imageUrl,
      this.height = 60,
      this.width = 60,
      this.localImage = false,
        this.assetImage = true,
      this.localImageFile})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      height: height,
      width: width,
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(height),
          // border: Border.all(color: MyColors.secondary, width: 2),
          image:assetImage?
              DecorationImage(
                image: AssetImage(imageUrl),
                fit: BoxFit.cover,
              ):
          localImage
              ? DecorationImage(
                  image: FileImage(localImageFile!),
            fit: BoxFit.cover,
                )
              : DecorationImage(
                  image: NetworkImage(
                    imageUrl,
                  ),
                  fit: BoxFit.cover,
                )),
    );
  }
}
