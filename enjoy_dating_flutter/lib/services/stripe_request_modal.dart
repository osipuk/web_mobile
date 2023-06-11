class StripeRequestModal{
  String customerId;
  String amount;
  String? description;
  String? currencyCode;  ///three letter code
  String? shippingName;
  String? shippingAddressLine1;
  String? shippingAddressPostalCode;
  String? shippingAddressCity;
  String? shippingAddressStateCode;
  String? shippingAddressCountryCode;

  StripeRequestModal({
      required this.customerId,
    required this.amount,
    required this.description,
    required this.shippingName,
    required this.shippingAddressLine1,
    required this.shippingAddressPostalCode,
    required this.shippingAddressCity,
    required this.shippingAddressStateCode,
    required this.shippingAddressCountryCode,
    required this.currencyCode
  });


  Map<String, dynamic> toJson(){
    return {
      "amount": amount,
      "currency": currencyCode,
      "description": description,
      "shipping[name]": shippingName,
      // "shipping[address][line1]":"510 Townsend St",
      // "shipping[address][postal_code]":"98140",
      // "shipping[address][city]":"San Francisco",
      // "shipping[address][state]":"CA",
      "shipping[address][country]":"US",
    };
  }



}
//
// var requestSample = {
//   "amount": 400,
//   "currency": "usd",
//   "description": "Sample Description",
//   "shipping[name]": "customer name",
//   "shipping[address][line1]":"510 Townsend St",
//   "shipping[address][postal_code]":"98140",
//   "shipping[address][city]":"San Francisco",
//   "shipping[address][state]":"CA",
//   "shipping[address][country]":"US",
// };
