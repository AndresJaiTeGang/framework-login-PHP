import { auth, googleProvider } from './auth/firebaseConfig';
import {
  signInWithPopup,
  signInWithEmailAndPassword
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

document.addEventListener("DOMContentLoaded", () => {
  let loginInProgress = false;

  const googleBtn = document.getElementById("google-login");
  const loginForm = document.getElementById("login-form");

  if (googleBtn) {
    googleBtn.addEventListener("click", async () => {
      if (loginInProgress) return;
      loginInProgress = true;

      try {
        const result = await signInWithPopup(auth, googleProvider);
        const idToken = await result.user.getIdToken();
        await enviarTokenAlBackend(idToken);
      } catch (error) {
        if (error.code === 'auth/popup-closed-by-user') {
          alert("Cerraste la ventana antes de completar el inicio de sesión.");
        } else if (error.code === 'auth/cancelled-popup-request') {
          alert("Ya hay una ventana de inicio de sesión abierta.");
        } else {
          alert("Error en el inicio de sesión con Google.");
          console.error("Error al iniciar sesión con Google:", error);
        }
      } finally {
        loginInProgress = false;
      }
    });
  } else {
    console.error("No se encontró el botón con ID 'google-login'");
  }

  if (loginForm) {
    loginForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      try {
        const userCredential = await signInWithEmailAndPassword(auth, email, password);
        const idToken = await userCredential.user.getIdToken();
        await enviarTokenAlBackend(idToken);
      } catch (error) {
        const msg = error.message || "Error desconocido";
        document.getElementById("auth-message").innerText = "Error: " + msg;
        console.error("Login con correo fallido:", error);
      }
    });
  } else {
    console.error("No se encontró el formulario con ID 'login-form'");
  }
});

async function enviarTokenAlBackend(idToken) {
  try {
    const response = await fetch("http://framework-login.com/backend/verificarToken.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ idToken })
    });

    const data = await response.json();
    console.log("Respuesta del backend:", data);

    if (data.success) {
      alert("Login exitoso");
      window.location.href = "home.php";
    } else {
      alert("Error: " + (data.error || "No autorizado"));
    }

  } catch (error) {
    alert("Error en la comunicación con el servidor.");
    console.error("Error al enviar token al backend:", error);
  }
}
