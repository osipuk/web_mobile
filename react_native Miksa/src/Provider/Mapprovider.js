import React, { Component } from 'react'
import { Modal, Text, View, StyleSheet, TouchableOpacity, Image, Dimensions, Platform, PermissionsAndroid, SafeAreaView } from 'react-native'
import { Colors, mediaprovider, config, localStorage, localimag, Currentltlg, Lang_chg, apifuntion, msgProvider, msgTitle, consolepro, validation } from './utilslib/Utils';
import Icon2 from 'react-native-vector-icons/Entypo';
import MapView, { Marker, PROVIDER_GOOGLE, } from 'react-native-maps';
import { GooglePlacesAutocomplete } from 'react-native-google-places-autocomplete';
// import Slider from '@react-native-community/slider'
import Geolocation from '@react-native-community/geolocation';

const windowWidth = Dimensions.get('window').width;
const windowHeight = Dimensions.get('window').height;

export default class Mapprovider extends Component {
  constructor(props) {
    super(props);
    this.state = {
      loading: false,
      modalVisible1: false,
      latitude: config.latitude,
      longitude: config.longitude,
      latdelta: '0.0922',
      longdelta: '0.0421',
      isConnected: true,
      addressbar: false,
      addressbar2: false,
      addressselected: 'Search',
      makermove: 1,
      username: '',
      address: '',
      radiusstart: 0,
      radiusend: 0,
    };
    this.getcurrentlatlogn();
  }



  // getcurrentlatlogn = async () => {
  //   this.getlatlong();
  // }



  callLocation = async (that) => {
    this.setState({ loading: true })
    localStorage.getItemObject('position').then((position) => {
      console.log('position', position)
      if (position != null) {
        var pointcheck1 = 0
        this.getalldata(position)
        Geolocation.getCurrentPosition(
          //Will give you the current location
          (position) => {

            localStorage.setItemObject('position', position)
            this.getalldata(position);
            pointcheck1 = 1
          },
          (error) => {
            let position = { 'coords': { 'latitude': config.latitude, 'longitude': config.longitude } }

            this.getalldata(position)
          },
          { enableHighAccuracy: true, timeout: 10000000, maximumAge: 10000 }
        );
        that.watchID = Geolocation.watchPosition((position) => {
          //Will give you the location on location change
          console.log('data', position);

          if (pointcheck1 != 1) {
            localStorage.setItemObject('position', position)
            this.getalldata(position)
          }

        });

      }
      else {
        console.log('helo gkjodi')
        var pointcheck = 0
        Geolocation.getCurrentPosition(
          //Will give you the current location
          (position) => {

            localStorage.setItemObject('position', position)

            this.getalldata(position)
            pointcheck = 1
          },
          (error) => {
            let position = { 'coords': { 'latitude': config.latitude, 'longitude': config.longitude } }

            this.getalldata(position)
          },
          { enableHighAccuracy: true, timeout: 1500000, maximumAge: 1000 }
        );
        that.watchID = Geolocation.watchPosition((position) => {
          //Will give you the location on location change
          console.log('data', position);
          if (pointcheck != 1) {
            localStorage.setItemObject('position', position)
            this.getalldata(position)
          }
        });
      }
    })
  }
  getcurrentlatlogn = async () => {

    let permission = await localStorage.getItemString('permission')
    if (permission != 'denied') {
      var that = this;
      //Checking for the permission just after component loaded
      if (Platform.OS === 'ios') {
        this.callLocation(that);
      } else {
        // this.callLocation(that);
        async function requestLocationPermission() {
          try {
            const granted = await PermissionsAndroid.request(
              PermissionsAndroid.PERMISSIONS.ACCESS_FINE_LOCATION, {
              'title': 'Location Access Required',
              'message': 'This App needs to Access your location'
            }
            )
            console.log('granted', PermissionsAndroid.RESULTS.GRANTED)
            if (granted === PermissionsAndroid.RESULTS.GRANTED) {
              that.callLocation(that);
            } else {
              let position = { 'coords': { 'latitude': that.state.latitude, 'longitude': that.state.longitude } }
              localStorage.setItemString('permission', 'denied')
              that.getalldata(position)
            }
          } catch (err) { console.warn(err) }
        }
        requestLocationPermission();
      }
    } else {
      let position = { 'coords': { 'latitude': config.latitude, 'longitude': config.longitude } }
      this.getalldata(position)
    }

  }

  getalldata = (position) => {
    let longitude = position.coords.longitude
    let latitude = position.coords.latitude
    console.log('positionlatitude', latitude)
    console.log('positionlongitude', longitude)
    let event = { latitude: latitude, longitude: longitude, latitudeDelta: this.state.latdelta, longitudeDelta: this.state.longdelta }
    this.setState({
      longitude: parseFloat(longitude),
      latitude: parseFloat(latitude),
      latdelta: '0.0922',
      longdelta: '0.0421',
    })
    // this.getadddressfromlatlong(event)
  }




  setMapRef = (map) => {
    this.map = map;
  }
  getCoordinates = (region) => {
    return ({
      latitude: parseFloat(this.state.latitude),
      longitude: parseFloat(this.state.longitude),
      latitudeDelta: parseFloat(this.state.latdelta),
      longitudeDelta: parseFloat(this.state.longdelta),
    });
  }

  getadddressfromlatlong = (event) => {

    fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + event.latitude + ',' + event.longitude + '&key=' + config.mapkey + '&language=' + config.maplanguage)

      .then((response) => response.json())
      .then((resp) => {
        let responseJson = resp.results[0]
        let city = '';
        let administrative_area_level_1 = '';
        for (let i = 0; i < responseJson.address_components.length; i++) {
          if (responseJson.address_components[i].types[0] == "locality") {
            city = responseJson.address_components[i].long_name
            break;
          }
          else if (responseJson.address_components[i].types[0] == "administrative_area_level_2") {
            city = responseJson.address_components[i].long_name
          }

        }
        for (let j = 0; j < responseJson.address_components.length; j++) {
          if (responseJson.address_components[j].types[0] == "administrative_area_level_1") {
            administrative_area_level_1 = responseJson.address_components[j].long_name
          }

        }
        let details = responseJson
        let data2 = { 'latitude': details.geometry.location.lat, 'longitude': details.geometry.location.lng, 'address': details.formatted_address, 'city': city, 'administrative_area_level_1': administrative_area_level_1 }
        this.GooglePlacesRef && this.GooglePlacesRef.setAddressText(details.formatted_address)
        this.setState({ latdelta: event.latitudeDelta, longdelta: event.longitudeDelta, latitude: event.latitude, longitude: event.longitude, addressselected: details.formatted_address, address: details.formatted_address })
      })

  }

  DoneButton = () => {
    var data = {
      latitude: this.state.latitude,
      longitude: this.state.longitude,
      address: this.state.address
    }
    this.props.canclemap()
    return this.props.locationget(data);
  }


  render() {
    return (

      <Modal
        animationType="slide"
        transparent={true}
        visible={this.props.mapmodal}
        onRequestClose={() => {
          this.setState({ makermove: 0 })
          this.props.canclemap();
        }}>
        <SafeAreaView style={styles.container}>

          <View style={styles.container}>
            <View style={{ width: '100%', alignSelf: 'center', flexDirection: 'row', paddingTop: 10, backgroundColor: '#0088e0' }}>
              <TouchableOpacity style={{ paddingVertical: 15, width: '20%', alignSelf: 'center' }} onPress={() => { this.setState({ makermove: 0 }); this.props.canclemap() }}>
                <View style={{ width: '100%', alignSelf: 'center' }}>
                  <Image source={require('../icons/back2.png')} style={{ alignSelf: 'center', width: 20, height: 20, resizeMode: 'contain' }} />
                </View>
              </TouchableOpacity>
              <View style={{ paddingVertical: 15, width: '60%' }}>
                <Text style={{ color: '#ffffff', fontFamily: 'Poppins-Medium', fontSize: 17, textAlign: 'center' }}>{Lang_chg.txt_select_service_search[config.language]}</Text>
              </View>
              <TouchableOpacity style={{ paddingVertical: 15, width: '20%', alignSelf: 'center' }} onPress={() => { this.DoneButton() }}>
                <View style={{ width: '100%', alignSelf: 'center' }} >
                  <Text style={{ color: '#ffffff', fontFamily: 'Poppins-Medium', fontSize: 13, textAlign: 'center' }}>{Lang_chg.Done[config.language]}</Text>
                </View>
              </TouchableOpacity>

            </View>
            <View style={{ flex: 1 }}>
              <MapView
                followsUserLocation={true}
                style={{ flex: 1 }}
                region={
                  this.getCoordinates(this)
                }
                zoomEnabled={true}
                provider={PROVIDER_GOOGLE}
                minZoomLevel={2}
                maxZoomLevel={20}
                rotateEnabled={true}
                pitchEnabled={true}
                showsUserLocation={true}
                userLocationPriority='high'
                moveOnMarkerPress={true}
                showsMyLocationButton={true}
                showsScale={true} // also this is not working
                showsCompass={true} // and this is not working
                showsPointsOfInterest={true} // this is not working either
                showsBuildings={true} // and finally, this isn't working either
                onMapReady={this.onMapReady}
                // onRegionChangeComplete={(event) => { this.getadddressfromlatlong(event) }}
                // draggable
                ref={this.setMapRef}
              >
                <Marker.Animated
                  coordinate={{
                    latitude: parseFloat(this.state.latitude),
                    longitude: parseFloat(this.state.longitude),
                    latitudeDelta: parseFloat(this.state.latdelta),
                    longitudeDelta: parseFloat(this.state.longdelta),
                  }}
                  isPreselected={true}
                  onDragEnd={(e) => { console.log("dragEnd", (e.nativeEvent.coordinate)) }}
                  draggable
                  title={this.state.username != null ? this.state.username : 'Guest user'}
                  description={'Your are here location'}

                >
                  <Image source={require('../icons/location_red.png')} style={{ height: 30, width: 30, resizeMode: 'contain', }} />
                </Marker.Animated>
              </MapView>


              <View style={{ position: 'absolute', width: '100%' }}>
                <View style={{ flex: 1, paddingHorizontal: 0 }}>
                  <GooglePlacesAutocomplete
                    placeholder={Lang_chg.text_search1[config.language]}
                    minLength={1} // minimum length of text to search
                    autoFocus={false}
                    returnKeyType={'search'} // Can be left out for default return key https://facebook.github.io/react-native/docs/textinput.html#returnkeytype
                    listViewDisplayed='auto' // true/false/undefined
                    fetchDetails={true}
                    ref={(instance) => { this.GooglePlacesRef = instance }}
                    renderDescription={row => row.description} // custom description render
                    onPress={(data, details = null) => {
                      let responseJson = details
                      // let city = '';
                      // let administrative_area_level_1 = '';
                      // for (let i = 0; i < responseJson.address_components.length; i++) {
                      //   if (responseJson.address_components[i].types[0] == "locality") {
                      //     city = responseJson.address_components[i].long_name
                      //     break;
                      //   }
                      //   else if (responseJson.address_components[i].types[0] == "administrative_area_level_2") {
                      //     city = responseJson.address_components[i].long_name
                      //   }

                      // }
                      // for (let j = 0; j < responseJson.address_components.length; j++) {
                      //   if (responseJson.address_components[j].types[0] == "administrative_area_level_1") {
                      //     administrative_area_level_1 = responseJson.address_components[j].long_name
                      //   }

                      // }


                      this.setState({ 'latitude': details.geometry.location.lat, 'longitude': details.geometry.location.lng, 'address': details.formatted_address, })
                      {
                        (this.GooglePlacesRef && details.formatted_address != null) && this.GooglePlacesRef.setAddressText(details.formatted_address)
                      }
                      // let data2 = { 'latitude': details.geometry.location.lat, 'longitude': details.geometry.location.lng, 'address': details.formatted_address, 'city': city, 'administrative_area_level_1': administrative_area_level_1 }

                      // return this.props.locationget(data2);

                    }}
                    // getDefaultValue={() => {
                    //   return  mapaddress!='NA'?mapaddress.address:'' // text input default value
                    // }}
                    query={{
                      // available options: https://developers.google.com/places/web-service/autocomplete
                      key: 'AIzaSyDiB4SQ9xgyglSS2g_BdBhBI0bDqa-0iTQ',
                      language: 'en', // language of the results
                      //   types: '(cities)',  default: 'geocode'
                    }}
                    styles={{
                      textInputContainer: {
                        backgroundColor: 'white',
                        alignSelf: 'center',
                        alignItems: 'center',
                        justifyContent: 'center',
                        height: 50,
                        alignItems: 'flex-end',
                        borderRadius: 0,
                        width: '100%',
                      },
                      textInput: {
                        marginLeft: 2,
                        marginRight: 10,
                        textAlign: 'left',
                        fontFamily: 'Poppins-Bold',
                        height: 40,
                        borderRadius: 10,
                        color: '#5d5d5d',
                        fontSize: 16,
                      },
                      predefinedPlacesDescription: {
                        color: Colors.statusbarcolor,
                      },
                      description: {
                        fontFamily: 'Poppins-Bold',
                      },
                      container: {
                        borderRadius: 10
                      },
                      poweredContainer: {
                        backgroundColor: Colors.statusbarcolor,
                        borderRadius: 15,
                        color: '#FFFFFF'
                      },
                      listView: {
                        backgroundColor: '#FFFFFF',
                        marginTop: 30, borderRadius: 15,
                      }
                    }}
                    currentLocation={false} // Will add a 'Current location' button at the top of the predefined places list
                    currentLocationLabel="Current location"
                    nearbyPlacesAPI="GooglePlacesSearch" // Which API to use: GoogleReverseGeocoding or GooglePlacesSearch
                    GoogleReverseGeocodingQuery={{
                      // available options for GoogleReverseGeocoding API : https://developers.google.com/maps/documentation/geocoding/intro
                    }}
                    GooglePlacesSearchQuery={{
                      // available options for GooglePlacesSearch API : https://developers.google.com/places/web-service/search
                      rankby: 'distance',
                      types: 'food',
                    }}
                    filterReverseGeocodingByTypes={[
                      'locality',
                      'administrative_area_level_3',
                      'postal_code',
                      'sublocality',
                      'country']} // filter the reverse geocoding results by types - ['locality', 'administrative_area_level_3'] if you want to display only cities
                    //   predefinedPlaces={[homePlace, workPlace]}
                    debounce={100}
                    renderLeftButton={() => (<TouchableOpacity style={{ alignSelf: 'center' }} onPress={() => { null }}>

                      <Image source={require('../icons/search2.png')} style={{ alignContent: 'center', alignSelf: 'center', resizeMode: 'contain', width: 16, height: 16, marginLeft: 10 }} />
                    </TouchableOpacity>)}

                    renderRightButton={() => (<TouchableOpacity style={{ alignSelf: 'center', paddingRight: 10 }} onPress={() => { this.GooglePlacesRef.setAddressText(""); this.setState({ addressselected: Lang_chg.text_search1[config.language] }) }}>

                      <Image source={require('../icons/cross2.png')} style={{ alignContent: 'center', alignSelf: 'center', resizeMode: 'contain', width: 16, height: 16, marginLeft: 10 }} />
                    </TouchableOpacity>)}
                  //   <Image source={require('./icons/location.png')} style={{alignContent:'center',alignSelf:'center',resizeMode:'contain',width:20,height:20,marginLeft:10}}/>}
                  />
                </View>
              </View>
            </View>
          </View>
        </SafeAreaView>
      </Modal>

    )
  }
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF'
  },
  button: {
    backgroundColor: '#00a1e4',
    width: 180,
    borderRadius: 45,
    paddingVertical: 10
  },
  searchbutton: {
    backgroundColor: '#00a1e4',

    borderRadius: 45,
    paddingVertical: 11,
    marginTop: 20,
    marginBottom: 8,
    textAlign: 'center',
    color: '#FFFFFF',
    position: "absolute", bottom: 10, width: '80%',
    alignSelf: 'center'
  },
  searchbar: {
    flexDirection: "row",
    width: '80%',
    marginHorizontal: 20,
    backgroundColor: '#FFFFFF',
    marginTop: 10,
    marginRight: 10,
    elevation: 10,
    borderRadius: 15,
    alignSelf: 'center',
    shadowOffset: {
      height: 7,
      width: 0
    },
    shadowColor: "rgba(0,0,0,1)",
    shadowOpacity: 0.49,
    shadowRadius: 5,

  },
  text2: {
    fontSize: 16,
    color: 'white',
    fontFamily: 'Poppins-Bold',
    alignSelf: 'center',
  },
  img2: {
    width: 15,
    height: 15,
  },
  number: {
    width: windowWidth * 84 / 100,
    backgroundColor: '#ea0a0a',
    borderRadius: 50,
    flexDirection: 'row',
    justifyContent: 'center',
    alignSelf: 'center',
    paddingVertical: 15,
    position: 'absolute',
    bottom: 20
  },
  age: {
    fontSize: 18,
    fontFamily: 'Poppins-Bold',
  },
})