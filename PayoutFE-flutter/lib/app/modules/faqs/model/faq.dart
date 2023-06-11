class Faq {
  int id;
  String question;
  String answer;

  Faq({required this.id, required this.question, required this.answer});

  factory Faq.fromJson(Map<String, dynamic> json) {
    return Faq(
      id: json['id'],
      question: json['question'],
      answer: json['answer'],
    );
  }

  static List<Faq> toList(Map<String, dynamic> json) {
    List<Faq> faqs = [];
    json['data'].forEach((faq) {
      faqs.add(Faq.fromJson(faq));
    });
    return faqs;
  }
}
