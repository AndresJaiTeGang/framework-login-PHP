import { auth, googleProvider } from './src/auth/firebaseConfig.js';
import {
  signInWithPopup,
  signInWithEmailAndPassword,
  createUserWithEmailAndPassword
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

// LOGIN CON GOOGLE
document.getElementById("google-login").addEventListener("click", () => {
  signInWithPopup(auth, googleProvider)
    .then(async (result) => {
      const idToken = await result.user.getIdToken();
      enviarTokenAlBackend(idToken);
    })
    .catch(error => {
      console.error("Error al iniciar con Google:", error);
    });
});

// LOGIN CON CORREO
document.getElementById("login-form").addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  try {
    // Puedes cambiar a `createUserWithEmailAndPassword` para registrar
    const userCredential = await signInWithEmailAndPassword(auth, email, password);
    const idToken = await userCredential.user.getIdToken();
    enviarTokenAlBackend(idToken);
  } catch (error) {
    document.getElementById("auth-message").innerText = "Error: " + error.message;
    console.error("Login fallido:", error);
  }
});

// ENVÍO DEL TOKEN AL BACKEND
async function enviarTokenAlBackend(idToken) {
  const response = await fetch("http://framework-login.com/backend/verificarToken.php", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({ idToken }) // envía JSON con la propiedad idToken
});


  const data = await response.json();
console.log(data);
if(data.success){
  alert("Login exitoso");
  window.location.href = "home.php"; // o donde redirijas tras login
} else {
  alert("Error: " + (data.error || "No autorizado"));
}

}
