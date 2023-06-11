class VenmoPaymentResponse {
  VenmoPaymentDataResponse? data;
  VenmoPaymentResponse({required this.data});

  factory VenmoPaymentResponse.fromJson(Map<String, dynamic> json) {
    return VenmoPaymentResponse(
        data: VenmoPaymentDataResponse.fromJson(json["data"]));
  }
}

class VenmoPaymentDataResponse {
  VenmoPaymentInfoResponse? payment;

  VenmoPaymentDataResponse({required this.payment});

  factory VenmoPaymentDataResponse.fromJson(Map<String, dynamic> json) {
    return VenmoPaymentDataResponse(
      payment: VenmoPaymentInfoResponse.fromJson(json["payment"]),
    );
  }
}

class VenmoPaymentInfoResponse {
  String? status;
  String? id;

  VenmoPaymentInfoResponse({required this.status, required this.id});

  factory VenmoPaymentInfoResponse.fromJson(Map<String, dynamic> json) {
    return VenmoPaymentInfoResponse(
      status: json['status'] ?? 0,
      id: json['id'] ?? 0,
    );
  }
}




// {
//     "data": {
//         "balance": null,
//         "payment": {
//             "status": "settled",
//             "refund": null,
//             "medium": "sr beta",
//             "id": "3368907466686333606",
//             "date_authorized": null,
//             "fee": null,
//             "date_completed": "2021-09-23T04:57:45",
//             "target": {
//                 "merchant": null,
//                 "redeemable_target": null,
//                 "phone": null,
//                 "user": {
//                     "username": "Nageen-Ahmed",
//                     "last_name": "Ahmed",
//                     "friends_count": 0,
//                     "is_group": false,
//                     "is_active": true,
//                     "trust_request": null,
//                     "phone": null,
//                     "profile_picture_url": "https://pics.venmo.com/eb56a48d-3dd9-4fa2-80fb-bd7e532e0b12?width=460&height=460&photoVersion=11",
//                     "is_payable": true,
//                     "is_blocked": false,
//                     "id": "2158950766084096088",
//                     "identity": null,
//                     "date_joined": "2017-02-26T18:49:47",
//                     "about": " ",
//                     "display_name": "Nageen Ahmed",
//                     "identity_type": "personal",
//                     "first_name": "Nageen",
//                     "friend_status": null,
//                     "email": null
//                 },
//                 "type": "user",
//                 "email": null
//             },
//             "audience": "private",
//             "actor": {
//                 "username": "madnadd",
//                 "last_name": "Ahmed",
//                 "friends_count": 0,
//                 "is_group": false,
//                 "is_active": true,
//                 "trust_request": null,
//                 "phone": null,
//                 "profile_picture_url": "https://pics.venmo.com/7b6273bf-f589-4640-8943-301139886653?width=460&height=460&photoVersion=1",
//                 "is_payable": true,
//                 "is_blocked": false,
//                 "id": "1626579956400128899",
//                 "identity": null,
//                 "date_joined": "2015-02-23T06:04:01",
//                 "about": " ",
//                 "display_name": "Nadeem Ahmed",
//                 "identity_type": "personal",
//                 "first_name": "Nadeem",
//                 "friend_status": null,
//                 "email": null
//             },
//             "note": "payout test for API",
//             "amount": 0.1,
//             "action": "pay",
//             "date_created": "2021-09-23T04:57:45",
//             "date_reminded": null,
//             "external_wallet_payment_info": null
//         }
//     }
// }