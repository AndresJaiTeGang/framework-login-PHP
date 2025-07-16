import { initializeApp } from "firebase/app";
import { getAuth, signInWithEmailAndPassword, GoogleAuthProvider, signInWithPopup } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyClRsFh2-yh7Ft8JXLJrB4NdqBeBhsL8UI",
  authDomain: "framework-login.firebaseapp.com",
  projectId: "framework-login",
  storageBucket: "framework-login.firebasestorage.app",
  messagingSenderId: "745627812413",
  appId: "1:745627812413:web:98e255e61c8b2355cde054",
  measurementId: "G-4NHVV3Z9ZN"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// LOGIN con usuario/contraseña
const loginForm = document.getElementById("login-form");
if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
      await signInWithEmailAndPassword(auth, email, password);
      window.location.href = "/inicio.html";
    } catch (error) {
      alert("Error al iniciar sesión: " + error.message);
    }
  });
}

// LOGIN con Google
const googleLoginBtn = document.getElementById("google-login");
if (googleLoginBtn) {
  googleLoginBtn.addEventListener("click", async () => {
    try {
      await signInWithPopup(auth, provider);
      window.location.href = "/inicio.html";
    } catch (error) {
      alert("Error al iniciar con Google: " + error.message);
    }
  });
}
