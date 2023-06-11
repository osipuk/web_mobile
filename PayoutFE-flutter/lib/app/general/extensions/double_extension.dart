import 'package:intl/intl.dart';

extension DoubleExtension on num {
  String toCurrency() {
    String value = NumberFormat.currency(
      customPattern: '###,###.##',
    ).format(
      this,
    );
    return "\$ $value";
  }
}

extension IntExtension on int {
  String ordinal() {
    if (this >= 11 && this <= 13) {
      return '${this}th';
    }

    switch (this % 10) {
      case 1:
        return '${this}st';
      case 2:
        return '${this}nd';
      case 3:
        return '${this}rd';
      default:
        return '${this}th';
    }
  }
}
