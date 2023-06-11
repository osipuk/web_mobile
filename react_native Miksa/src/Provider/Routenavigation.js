import React, { Component } from 'react'
import { createStackNavigator } from '@react-navigation/stack';
import Home from '../component/Home'
import Login from '../component/Login'
import Signup from '../component/Signup'
import Splash from '../component/Splash'
const Stack = createStackNavigator();
const Stacknav = (navigation) => {
    return (
      <Stack.Navigator
        initialRouteName={'Splash'}
      >
        <Stack.Screen name="Splash" component={Splash} options={{ headerShown: false }}/>
        <Stack.Screen name="Signup" component={Signup} options={{ headerShown: false }}/>
        <Stack.Screen name="Login" component={Login} options={{ headerShown: false }}/>
        <Stack.Screen name="Home" component={Home} options={{ headerShown: false }} />
      </Stack.Navigator>
  
    );
  }
  export default Stacknav