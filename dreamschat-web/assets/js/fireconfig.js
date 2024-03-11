"use strict";
// Initialize Firebase
var firebaseConfig = {
	apiKey: apiKey,
	authDomain: authDomain,
	databaseURL: databaseURL,
	projectId: projectId,
	storageBucket: storageBucket,
	messagingSenderId: messagingSenderId,
	appId: appId
  };
firebase.initializeApp(firebaseConfig);

var database = firebase.database();
var storageRef = firebase.storage().ref();


