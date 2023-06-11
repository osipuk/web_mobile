import 'dart:async';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pay_out/app/general/constants/SVGImage.dart';
import 'package:pay_out/app/general/constants/constants.dart';

// ignore: must_be_immutable
class ProfileImage extends StatelessWidget {
  final String? pathProfile;
  final File? fileProfile;
  final Function? onProfileTap;

  Color? maskColor;
  double size = 40;
  String? secondPathProfile;

  ProfileImage({
    this.pathProfile,
    this.fileProfile,
    this.onProfileTap,
    this.size = 40,
    this.maskColor,
    this.secondPathProfile,
  });

  @override
  Widget build(BuildContext context) {
    return getUserImage();
  }

  Widget getUserImage() {
    if (fileProfile != null) {
      return ClipOval(
        child: Image.file(
          fileProfile!,
          height: size,
          width: size,
          fit: BoxFit.cover,
        ),
      );
    }

    if (pathProfile == null || (pathProfile?.isEmpty ?? false)) {
      return SvgPicture.asset(
        SVGImage.userIcon,
        height: size,
      );
    }

    Image profileImage;
    profileImage = Image.network(
      pathProfile!,
      height: size,
      width: size,
      fit: BoxFit.cover,
    );

    Timer(Duration(seconds: 10), () {
      profileImage.image.evict();
    });

    return GestureDetector(
      onTap: () {
        onProfileTap?.call();
      },
      child: Stack(
        alignment: Alignment.center,
        children: [
          SizedBox(
            height: size - 10,
            width: size - 10,
            child: CircularProgressIndicator(
              valueColor: AlwaysStoppedAnimation<Color>(
                PayPOutColors.PrimaryColor,
              ),
              strokeWidth: 2,
            ),
          ),
          if (secondPathProfile == null) onlyProfileWidget(profileImage),
          if (secondPathProfile != null) twoProfileImages(),
          ClipOval(
            child: Container(
              color: maskColor,
              height: size,
            ),
          ),
        ],
      ),
    );
  }

  Widget onlyProfileWidget(Image profileImage) {
    return ClipOval(
      child: profileImage,
    );
  }

  Widget twoProfileImages() {
    return SizedBox(
      height: size,
      width: size,
      child: Stack(
        children: <Widget>[
          Container(
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              image: DecorationImage(
                fit: BoxFit.cover,
                image: NetworkImage(
                  secondPathProfile!,
                ),
              ),
            ),
          ),
          ClipRect(
            child: Align(
              alignment: Alignment.centerLeft,
              widthFactor: 0.5,
              child: Container(
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  image: DecorationImage(
                    fit: BoxFit.cover,
                    image: NetworkImage(
                      pathProfile!,
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
