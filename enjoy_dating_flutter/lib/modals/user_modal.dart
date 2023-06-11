import 'dart:ffi';

enum UserGender { male, female }

class UserModal {
  String id;
  String name;
  UserGender gender;
  String dateOfBirth;
  String emailId;
  String mobileNumber;
  List galleryImages;
  String uniqueId;
  String? address;
  String? city;
  String? state;
  String country;
  String? about;
  String imageUrl;
  int status;
  int coins;
  int diamonds;
  int followers;
  int following;
  int age;
  double lat;
  double lng;
  String? isFollow;
  String notificationNewFollowers;
  String notificationDirectMessage;
  String notificationVideoCalls;
  String notificationAddReminders;
  bool isOnline;
  Map fullData;
  Map? bankDetails;
  Map? agentDetails;
  String authToken;
  bool hasRated;

  UserModal({
    required this.id,
    required this.name,
    required this.gender,
    required this.emailId,
    required this.dateOfBirth,
    required this.age,
    required this.galleryImages,
    required this.mobileNumber,
    required this.uniqueId,
     this.address,
     this.city,
     this.state,
    required this.country,
     this.about,
    required this.imageUrl,
    required this.status,
    required this.coins,
    required this.followers,
    required this.following,
    required this.lat,
    required this.lng,
    required this.diamonds,
    this.isFollow,
    required this.notificationDirectMessage,
    required this.notificationNewFollowers,
    required this.notificationVideoCalls,
    required this.notificationAddReminders,
    required this.isOnline,
    required this.bankDetails,
    required this.fullData,
    required this.agentDetails,
    required this.authToken,
    required this.hasRated,
  });

  factory UserModal.fromJson(Map user_data) {
    print('the user token is ${user_data['token']}');
    return UserModal(
      id: user_data['id'],
      name: user_data['name'],
      gender:
          user_data['gender'] == 'female' ? UserGender.female : UserGender.male,
      dateOfBirth: user_data['date_of_birth'],
      emailId: user_data['email']??'a',
      age: user_data['age'],
      mobileNumber: user_data['phone']??'',
      galleryImages: user_data['gallery']??[],
      uniqueId: user_data['unique_id'],
      address: user_data['addresss'],
      city: user_data['city'],
      state: user_data['state'],
      country: user_data['country']??'',
      about: user_data['about'],
      imageUrl: user_data['image'],
      status: int.parse(user_data['status']),
      coins: int.parse(user_data['coins']),
      diamonds: int.parse(user_data['diamonds']??'0'),
      followers: int.parse(user_data['follower']??'0'),
      following: int.parse(user_data['following']??'0'),
      lat: double.parse(user_data['lat']??'0'),
      lng: double.parse(user_data['lng']??'0'),
      isFollow: user_data['is_follow']==null?null:user_data['is_follow'].toString(),
      notificationAddReminders: user_data['add_reminder']??'0',
      notificationVideoCalls: user_data['video_calls']??'0',
      notificationNewFollowers: user_data['new_follower']??'0',
      notificationDirectMessage: user_data['direct_message']??'0',
      isOnline: user_data['is_online']=='1'?true:false,
      bankDetails: user_data['bank_info']==false?null:user_data['bank_info'],
      fullData: user_data,
      authToken: user_data['token']??'No Token',
      agentDetails: user_data['agent_data']==false?null:user_data['agent_data']==''?null:user_data['agent_data'],
      hasRated: user_data['is_google_rated']=='1',
    );
  }
}
