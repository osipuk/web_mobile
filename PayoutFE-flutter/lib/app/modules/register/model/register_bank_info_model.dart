// Modelo de peticion
class RegisterBankInfoRequest {
  int? id;
  String? routing;
  String? nameAccount;
  String? checkNumber;
  DateTime? dob = DateTime.now();
  String? ssn;

  RegisterBankInfoRequest(
      {this.id,
      this.routing,
      this.nameAccount,
      this.checkNumber,
      this.dob,
      this.ssn});

  Map<String, dynamic> toBankTokenMap() {
    return {
      'account_name': nameAccount,
      'routing_number': routing,
      'account_number': checkNumber,
    };
  }
}
