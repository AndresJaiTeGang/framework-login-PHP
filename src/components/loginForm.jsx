// src/components/LoginForm.jsx
import { useState } from "react";
import { auth, googleProvider } from "../auth/firebaseConfig";
import {
  signInWithEmailAndPassword,
  signInWithPopup,
} from "firebase/auth";

export default function LoginForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState(null);

  const handleEmailLogin = async (e) => {
    e.preventDefault();
    setError(null);
    try {
      await signInWithEmailAndPassword(auth, email, password);
      window.location.href = "/pages/index.html";
    } catch (err) {
      setError("Correo o contraseña incorrectos.");
    }
  };

  const handleGoogleLogin = async () => {
    setError(null);
    try {
      await signInWithPopup(auth, googleProvider);
      window.location.href = "/pages/index.html";
    } catch (err) {
      setError("No se pudo autenticar con Google.");
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen bg-cover bg-center bg-fixed bg-no-repeat bg-[url('/src/assets/bg.jpg')]">
      <div className="bg-white/80 backdrop-blur-md rounded-2xl p-8 w-full max-w-md shadow-xl animate-fade-in">
        <div className="text-center mb-6">
          <img
            src="/src/assets/logo.png"
            alt="Logo"
            className="mx-auto w-16 mb-2"
          />
          <h1 className="text-xl font-bold">Instituto Tecnológico Superior de Salvatierra</h1>
          <p className="text-sm">Academia TICS</p>
        </div>

        <form onSubmit={handleEmailLogin} className="space-y-4">
          <input
            type="email"
            placeholder="Usuario"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            className="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
          />
          <input
            type="password"
            placeholder="Contraseña"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            className="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
          />
          <button
            type="submit"
            className="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
          >
            Iniciar sesión
          </button>
          {error && <p className="text-red-500 text-sm">{error}</p>}
        </form>

        <div className="text-center mt-4 text-sm">
          <a href="/pages/olvido.html" className="text-blue-600 hover:underline">
            ¿Olvidaste la contraseña?
          </a>
          <br />
          <a href="/pages/ayuda.html" className="text-blue-600 hover:underline">
            ¿Necesitas ayuda?
          </a>
        </div>

        <div className="flex items-center my-4">
          <hr className="flex-grow border-t" />
          <span className="mx-2 text-gray-500 text-sm">o</span>
          <hr className="flex-grow border-t" />
        </div>

        <button
          onClick={handleGoogleLogin}
          className="flex items-center justify-center w-full border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition"
        >
          <img
            src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
            alt="Google"
            className="w-5 h-5 mr-2"
          />
          Continuar con Google
        </button>

        <p className="text-xs text-center mt-4 text-gray-600">
          Tu usuario es tu Matrícula o Correo institucional.
        </p>
      </div>
    </div>
  );
}
