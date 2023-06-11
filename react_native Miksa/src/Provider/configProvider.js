import { Platform } from "react-native";
import base64 from 'react-native-base64'
import { msgProvider, localStorage } from './utilslib/Utils';
import { LoginManager } from 'react-native-fbsdk'
import { GoogleSignin } from 'react-native-google-signin';
import firebase from '../Config1';
global.player_id_me1 = '123456';
global.global_notification_count = 0
//--------------------------- Config Provider Start -----------------------
class configProvider {
	baseURL = 'https://miksaapp.com/app/webservice/';
	img_url = 'https://miksaapp.com/app/webservice/images/200X200/';
	img_url1 = 'https://miksaapp.com/app/webservice/images/400X400/';
	img_url2 = 'https://miksaapp.com/app/webservice/images/700X700/';
	img_url3 = 'https://miksaapp.com/app/webservice/images/';
	login_type = 0;
	onesignalappid = '40c3ef13-5ba7-4008-ab4c-96dfb8b8424c'
	mapkey = 'AIzaSyDiB4SQ9xgyglSS2g_BdBhBI0bDqa-0iTQ';
	maplanguage = 'en';
	language = 0; //1 for english // 0 for spanish
	player_id = '123456';
	player_id_me = '123456';
	device_type = Platform.OS;
	loading_type = false;
	live_status = 'no';
	currency = "$";
	phone_code = 593;
	latitude = "36.778259";
	longitude = "-119.417931";
	headersapi = {
		'Authorization': 'Basic ' + base64.encode(base64.encode('mario') + ":" + base64.encode('carbonell')),
		Accept: 'application/json',
		'Content-Type': 'multipart/form-data',
		'Cache-Control': 'no-cache,no-store,must-revalidate',
		'Pragma': 'no-cache',
		'Expires': 0,
	}
	GetPlayeridfunctin = (player_id) => {
		player_id_me1 = player_id
	}

	checkUserDeactivate = async (navigation) => {
		msgProvider.toast('Your account is deactivated', 'long')
		// setTimeout(() => {
		this.AppLogout(navigation);
		// }, 200);
		return false;
	}


	AppLogoutSplash = async (navigation, login_type) => {
		var id = 'u_' + userdata.user_id;
		var updates = { 'onlineStatus': 'false' }
		var onlineStatusRef = firebase.database().ref('users/' + id).update(updates);
		var queryOffinbox = firebase.database().ref('users/' + id + '/myInbox/');
		queryOffinbox.off();
		FirebaseInboxJson = [];
		count_inbox = 0;
		// alert('app logout')
		if (login_type == 1) {
			console.log('face boook login');
			LoginManager.logOut();
			localStorage.clear();
			navigation.navigate('Login')
			return false;
		} else if (login_type == 2) {
			console.log('google login')
			try {
				await GoogleSignin.revokeAccess();
				await GoogleSignin.signOut();
			} catch (error) {
				console.log(error);
			}
			localStorage.clear();
			navigation.navigate('Login')
			return false;
		} else if (userdata.login_type == 5) {
			console.log('Apple Login')
			localStorage.clear();
			navigation.navigate('Login')
			return false;
		}
	}

	AppLogout = async (navigation) => {
		//----------------------- if get user login type -------------
		var userdata = await localStorage.getItemObject('user_arr');
		var password = await localStorage.getItemString('password');
		var mobile = userdata.mobile;
		var remember_me = await localStorage.getItemString('remember_me');
		var language = await localStorage.getItemString('language');
		console.log(password);
		console.log('mobile123', mobile);
		console.log(remember_me);
		console.log(language);

		if (userdata != null) {
			var id = 'u_' + userdata.user_id;
			var updates = { 'onlineStatus': 'false' }
			var onlineStatusRef = firebase.database().ref('users/' + id).update(updates);
			var queryOffinbox = firebase.database().ref('users/' + id + '/myInbox/');
			queryOffinbox.off();
			FirebaseInboxJson = [];
			count_inbox = 0;
			if (userdata.login_type == 0) {
				localStorage.clear();
				if (remember_me == 'yes') {
					localStorage.setItemString('password', password);
					localStorage.setItemString('mobile', mobile.toString());
					localStorage.setItemString('remember_me', remember_me);
					localStorage.setItemString('language', JSON.stringify(language));
				} else {
					localStorage.setItemString('password', password);
					localStorage.setItemString('mobile', mobile.toString());
					localStorage.setItemString('language', JSON.stringify(language));
				}

				navigation.navigate('Login');
				return false;
			} else if (userdata.login_type == 1) {
				console.log('face boook login');
				LoginManager.logOut();
				localStorage.clear();
				navigation.navigate('Login')
				return false;
			} else if (userdata.login_type == 2) {
				console.log('google login')
				try {
					await GoogleSignin.revokeAccess();
					await GoogleSignin.signOut();
				} catch (error) {
					console.log(error);
				}
				localStorage.clear();
				navigation.navigate('Login')
				return false;
			} else if (userdata.login_type == 5) {
				return false;
				console.log('face boook login')
			}
		} else {
			console.log('user arr not found');
		}
	}
};
//--------------------------- Config Provider End -----------------------

export const config = new configProvider();





