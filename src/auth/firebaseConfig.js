// src/auth/firebaseConfig.js
import { initializeApp } from "firebase/app";
import { getAuth, GoogleAuthProvider } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyClRsFh2-yh7Ft8JXLJrB4NdqBeBhsL8UI",
  authDomain: "framework-login.firebaseapp.com",
  projectId: "framework-login",
  storageBucket: "framework-login.appspot.com",
  messagingSenderId: "745627812413",
  appId: "1:745627812413:web:98e255e61c8b2355cde054",
  measurementId: "G-4NHVV3Z9ZN"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const googleProvider = new GoogleAuthProvider();

export { auth, googleProvider };
