import 'dart:io';
import 'dart:math';
import 'package:path_provider/path_provider.dart';
import 'package:http/http.dart' as http;

class EditUser {
  File? profileImage;

  void setProfileImage(File profileImage) {
    this.profileImage = profileImage;
  }

  Future<File> urlToFile(String imageUrl) async {
    var rng = new Random();
    Directory tempDir = await getTemporaryDirectory();

    String tempPath = tempDir.path;
    File file = new File('$tempPath' + (rng.nextInt(100)).toString() + '.png');
    http.Response response =
        await http.get(Uri.parse(imageUrl), headers: Map<String, String>());

    await file.writeAsBytes(response.bodyBytes);
    return file;
  }
}
