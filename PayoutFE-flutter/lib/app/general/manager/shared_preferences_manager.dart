import 'package:shared_preferences/shared_preferences.dart';

class SharedPreferencesManager {
  static SharedPreferencesManager get = SharedPreferencesManager();

  void saveUserID(int? userID) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setInt('userID', userID ?? 0);
  }

  Future<int> getUserID() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getInt('userID') ?? 0;
  }

  void deleteUserID() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('userID');
  }

  Future<String> authToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    print(prefs.getString('authToken'));
    return prefs.getString('authToken') ?? "";
  }

  void saveAuthToken(String? authToken) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setString('authToken', authToken ?? "");
  }

  void deleteAuthToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('authToken');
  }

  Future<String> venmoAuthToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('venmoAuthToken') ?? "";
  }

  void saveVenmoAuthToken(String? authToken) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setString('venmoAuthToken', authToken ?? "");
  }

  void deleteVenmoAuthToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('venmoAuthToken');
  }

  Future<bool> pendingRefreshUserData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getBool('pendingRefreshUserData') ?? false;
  }

  void savePendingRefreshUserData(bool value) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setBool('pendingRefreshUserData', value);
  }
}
