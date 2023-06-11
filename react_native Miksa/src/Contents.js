import Share from 'react-native-share'
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider } from './Provider/utilslib/Utils';
import { Linking } from 'react-native';
class Contents {

    btnShareApp = async (navigation) => {
        var action = 'share_app';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 1;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }
    btnRateApp = async (navigation) => {
        var action = 'rate_app';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 0;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }
    btnTermCondi = async (navigation) => {
        var action = 'terms_condition';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 0;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }
    btnPrivacyPolicy = async (navigation) => {
        var action = 'privacy_policy';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 0;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }
    btnAboutUs = async (navigation) => {
        var action = 'about_us';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 0;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }
    btnAppUserGuide = async (navigation) => {
        var action = 'app_user_guide';
        var json_content = await localStorage.getItemObject('json_content');
        var action_status = 0;
        if (json_content == null) {
            this.getAllContent(action_status, action, navigation);
        }
        else {
            action_status = 1;
            this.getAllContent(action_status, action, navigation);
            this.getAllContentShow(action, json_content, navigation);
        }
    }

    getAllContent = async (action_status, action, navigation) => {
        var url = config.baseURL + 'get_all_content.php?user_id=0';
        consolepro.consolelog('Term & condi', url);
        if (action_status == 0) {
            apifuntion.getApi(url).then((obj) => {
                if (obj.success == 'true') {
                    var content_arr = obj.content_arr;
                    if (content_arr != 'NA') {
                        localStorage.setItemObject('json_content', content_arr);
                    }
                    this.getAllContentShow(action, content_arr, navigation);
                } else {
                    setTimeout(() => {
                        if (obj.account_active_status == "deactivate") {
                            config.checkUserDeactivate(this.props.navigation);
                            return false;
                        }
                        msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                        return false;
                    }, 600);
                }
            }).catch(err => {
                if (err == "noNetwork") {
                    msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], obj.noNetwork[config.language], false);
                } else {
                    msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], obj.serverNotRespond[config.language], false);
                }
                console.log('err', err);
            });
        } else {

            apifuntion.postNoLoadingApi(url).then((obj) => {
                consolepro.consolelog('Term & condi', obj);
                if (obj.success == 'true') {
                    var content_arr = obj.content_arr;
                    if (content_arr != 'NA') {
                        localStorage.setItemObject('json_content', content_arr);
                    }
                } else {
                    setTimeout(() => {
                        if (obj.account_active_status == "deactivate") {
                            config.checkUserDeactivate(this.props.navigation);
                            return false;
                        }
                        msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                        return false;
                    }, 600);
                }
            }).catch(err => {
                if (err == "noNetwork") {
                    msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], obj.noNetwork[config.language], false);
                } else {
                    msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], obj.serverNotRespond[config.language], false);
                }
                console.log('err', err);
            });
        }
    }


    getAllContentShow = async (action, content_arr, navigation) => {
        if (content_arr != null) {
            for (let i = 0; i < content_arr.length; i++) {
                var content_id = content_arr[i].content_id;
                var content_type = content_arr[i].content_type;
                var content = content_arr[i].content[0];
                if (action == 'signup' && content_type == 1) {
                    consoleProvider.log('i am signup', content_type);
                }
                else if (action == 'share_app' && content_type == 5) {
                    var message = content;
                    let shareOptions = {
                        message: message,
                        failOnCancel: false,
                    };
                    Share.open(shareOptions)
                } else if (action == 'rate_app' && (content_type == 3 || content_type == 4)) {
                    if (config.device_type == 'ios' && content_type == 3) {
                        Linking.openURL(content).catch(err =>
                            consolepro.consolelog('content_type', content_type)
                        );
                        return false
                    }
                    if (config.device_type == 'android' && content_type == 4) {
                        Linking.openURL(content).catch(err =>
                            consolepro.consolelog('Please check for the Google Play Store')
                        );
                        return false;
                    }
                } else if (action == 'about_us' && content_type == 0) {
                    navigation.navigate('Terms', { content: content, title: Lang_chg.txt_content[config.language] });
                }
                else if (action == 'privacy_policy' && content_type == 1) {
                    navigation.navigate('Terms', { content: content, title: Lang_chg.txt_content_privacy_policy[config.language] });
                }
                else if (action == 'terms_condition' && content_type == 2) {
                    navigation.navigate('Terms', { content: content, title: Lang_chg.txt_content_terms_of_service[config.language] });
                }
                else if (action == 'app_user_guide' && content_type == 7) {
                    navigation.navigate('Terms', { content: content, title: Lang_chg.txt_content_App_User_Guide[config.language] });
                }
            }
        }
    }
}

//--------------------------- Config Provider End -----------------------
export const contents = new Contents();
