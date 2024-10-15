// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.14.0/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyAlDJo4edAs0NDzRQQ70HOgnFvFvDlyxYI",
    authDomain: "laravel-auth-91a1c.firebaseapp.com",
    projectId: "laravel-auth-91a1c",
    storageBucket: "laravel-auth-91a1c.appspot.com",
    messagingSenderId: "192513901034",
    appId: "1:192513901034:web:b57ae5fa495eccaffe3293",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// Facebook
var facebookProvider = new firebase.auth.FacebookAuthProvider();

var googleProvider = new firebase.auth.GoogleAuthProvider();
