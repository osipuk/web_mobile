import 'package:intl/intl.dart';

extension EmailValidator on String {
  bool isValidEmail() {
    return RegExp(
            r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$')
        .hasMatch(this);
  }

  bool isValidPassword() {
    return RegExp(
            r'^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,20}$')
        .hasMatch(this);
  }

  String toDate() {
    DateTime time = DateTime.parse(this);
    return time.getDateString("MMM dd, yyyy");
  }

  DateTime date() {
    final _date = this.replaceAll("T00:00:00.000Z", "");
    return DateTime.parse(_date);
  }
}

extension DateExtension on DateTime {
  String getDateString(String format) {
    return DateFormat(format).format(this);
  }

  DateTime addMonths(int months) {
    if (this.isUtc) {
      return DateTime.utc(this.year, this.month + months, this.day, this.hour,
          this.minute, this.second, this.millisecond);
    } else {
      return DateTime(this.year, this.month + months, this.day, this.hour,
          this.minute, this.second, this.millisecond);
    }
  }
}
