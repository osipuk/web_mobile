import 'dart:convert';

import 'package:http/http.dart';

class PayoutpartRequest extends MultipartRequest {
  PayoutpartRequest(String method, Uri url) : super(method, url);

  @override
  ByteStream finalize() {
    super.finalize();
    headers['content-type'] = '';
    return ByteStream(_finalize(""));
  }

  Stream<List<int>> _finalize(String boundary) async* {
    const line = [13, 10]; // \r\n
    final separator = utf8.encode('--$boundary\r\n');
    final close = utf8.encode('--$boundary--\r\n');

    for (var field in fields.entries) {
      yield separator;
      yield utf8.encode(field.value);
      yield line;
    }

    for (final file in files) {
      yield separator;
      yield* file.finalize();
      yield line;
    }
    yield close;
  }
}
