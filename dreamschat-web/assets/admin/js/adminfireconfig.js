"use strict";
// Initialize Firebasevar 
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