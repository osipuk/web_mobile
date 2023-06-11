import 'dart:io';

class ImageModal {
  String id;
  String userId;
  String image;
  DateTime createdAt;

  ImageModal({
    required this.id,
    required this.image,
    required this.createdAt,
    required this.userId
  });

  factory ImageModal.fromJson(Map jsonData) {
    return ImageModal(
        id: jsonData['id'],
        image: jsonData['images'],
      createdAt: DateTime.parse(jsonData['created_at']),
      userId: jsonData['user_id'],
    );
  }
}

// [{id: 32, user_id: 28,
// images: https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/21213855981658124774.jpg,
// created_at: 2022-07-18 01:12:54},
// {id: 33, user_id: 28, images: https://www.bluediamondresearch.com/WEB01/Normal_Dating/assets/customer_img/17298816191658124774.jpg, created_at: 2022-07-18 01:12:54}]