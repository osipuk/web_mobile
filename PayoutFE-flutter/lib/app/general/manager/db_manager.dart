import 'dart:async';
import 'package:floor/floor.dart';
import 'package:pay_out/app/general/manager/shared_preferences_manager.dart';
import 'package:pay_out/app/modules/login/model/user.dart';
import 'package:sqflite/sqflite.dart' as sqflite;
part 'db_manager.g.dart'; // the generated code will be there

@Database(version: 2, entities: [User])
abstract class AppDatabase extends FloorDatabase {
  UserAdb get userObj;
}

class DatabaseManager {
  static DatabaseManager get = DatabaseManager();

  Future<AppDatabase> getDB() {
    return $FloorAppDatabase.databaseBuilder('app_database.db').build();
  }

  Future<User?> getUser() async {
    int? id = await SharedPreferencesManager.get.getUserID();
    final database = await getDB();
    final userObj = database.userObj;
    final result = userObj.findUserById(id);
    return result.first;
  }

  void saveUser(User? user) async {
    final database = await getDB();
    final userObj = database.userObj;
    userObj.deleteAllUsers();
    await userObj.insertUser(user);
  }
}
