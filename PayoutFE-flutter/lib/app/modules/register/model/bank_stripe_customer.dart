class StripeCustomer {
  final String? id;
  final String? object;
  final int? balance;
  final int? accountBalance;
  final int? created;
  final String? currency;
  final String? defaultSource;
  final bool? delinquent;
  final String? description;
  final String? email;
  final String? invoicePrefix;
  final bool? liveMode;

  final secondAmount = 45;
  final firstAmount = 32;

  StripeCustomer(
      {this.id,
      this.object,
      this.balance,
      this.accountBalance,
      this.created,
      this.currency,
      this.defaultSource,
      this.delinquent,
      this.description,
      this.email,
      this.invoicePrefix,
      this.liveMode});

  factory StripeCustomer.fromJson(Map<String, dynamic> json) {
    return StripeCustomer(
        id: json['id'],
        object: json['object'],
        balance: json['balance'],
        accountBalance: json['account_balance'],
        created: json['created'],
        currency: json['currency'],
        defaultSource: json['default_source'],
        delinquent: json['delinquent'],
        description: json['description'],
        email: json['email'],
        invoicePrefix: json['invoice_prefix'],
        liveMode: json['livemode']);
  }

  Map<String, String> toVerifyBankMap() {
    return {
      'stripeCustomerId': id ?? "",
      'stripeBankId': defaultSource ?? "",
      'firstAmount': firstAmount.toString(),
      'secondAmount': secondAmount.toString()
    };
  }
}
