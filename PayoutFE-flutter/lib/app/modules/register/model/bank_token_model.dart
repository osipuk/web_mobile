class RegisterCreateBankTokenResponse {
  final bool status;
  final String message;
  final BankToken? data;

  RegisterCreateBankTokenResponse(
      {required this.status, required this.message, this.data});

  factory RegisterCreateBankTokenResponse.fromJson(Map<String, dynamic> json) {
    return RegisterCreateBankTokenResponse(
        status: json['status'],
        message: json['message'],
        data: json['data'] != null
            ? BankToken.fromJson(json['data'])
            : BankToken());
  }
}

class BankToken {
  String? id;
  String? object;
  String? clientIp;
  int? created;
  bool? liveMode;
  String? type;
  bool? used;
  BankAccount? bankAccount;

  BankToken(
      {this.id,
      this.object,
      this.clientIp,
      this.created,
      this.liveMode,
      this.type,
      this.used,
      this.bankAccount});

  factory BankToken.fromJson(Map<String, dynamic> json) {
    return BankToken(
        id: json['id'],
        object: json['object'],
        clientIp: json['client_ip'],
        created: json['created'],
        liveMode: json['livemode'],
        type: json['type'],
        used: json['used'],
        bankAccount: (json['bank_account'] is String)
            ? BankAccount()
            : BankAccount.fromJson(json['bank_account']));
  }
}

class BankAccount {
  String? id;
  String? object;
  String? accountHolderName;
  String? accountHolderType;
  String? bankName;
  String? country;
  String? currency;
  String? fingerprint;
  String? last4;
  String? routingNumber;
  String? status;

  BankAccount(
      {this.id,
      this.object,
      this.accountHolderName,
      this.accountHolderType,
      this.bankName,
      this.country,
      this.currency,
      this.fingerprint,
      this.last4,
      this.routingNumber,
      this.status});

  factory BankAccount.fromJson(Map<String, dynamic> json) {
    return BankAccount(
      id: json['id'],
      object: json['object'],
      accountHolderName: json['account_holder_name'],
      accountHolderType: json['account_holder_type'],
      bankName: json['bank_name'],
      country: json['country'],
      currency: json['currency'],
      fingerprint: json['fingerprint'],
      last4: json['last4'],
      routingNumber: json['routing_number'],
      status: json['status'],
    );
  }
}
