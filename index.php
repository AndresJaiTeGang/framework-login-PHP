<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Institucional</title>

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/src/style.css" />

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
  style="background-image: url('/src/assets/fondo-ITESS.jpg')">

  <div class="fixed inset-0 backdrop-blur-md flex items-center justify-center z-10">
    <div class="absolute left-1/2 top-1/2 w-[600px] h-[550px] bg-white/60 rounded-lg z-0 transform -translate-x-1/2 -translate-y-1/2"></div>

    <div class="contenido z-10">
      <div class="flex items-center justify-center gap-4 mb-4">
        <img src="/src/assets/logo-inicio.svg" alt="Logo del ITESS" class="logo" />
        <div class="w-px h-[90px] bg-gray-600"></div>
        <div class="text-center text-sm">
          <h1 class="text-sm font-semibold text-gray-900 leading-tight">
            Instituto Tecnológico Superior<br />de Salvatierra
          </h1>
          <p class="text-[11px] text-gray-700">Academia TICS</p>
        </div>
      </div>

      <form id="login-form" class="space-y-2" method="POST" action="login.php">
        <input id="email" name="username" type="text" placeholder="Usuario" required />
        <input id="password" name="password" type="password" placeholder="Contraseña" required />
        <button class="flex items-center justify-center mx-auto bg-blue-500 text-white px-4 py-2 rounded"
          id="inicia-sesion" type="submit">
          Iniciar sesión
        </button>
      </form>

      <div class="text-center mt-3 text-xs text-gray-700 space-y-1">
        <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal"
          data-bs-target="#modalRecuperar">
          ¿Olvidaste la contraseña?
        </button>
        <br />
        <button type="button" class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal"
          data-bs-target="#modalAyuda">
          ¿Necesitas ayuda?
        </button>
      </div>

      <div class="my-3 border-t border-black-300" id="separador"></div>

      <div class="flex flex-col gap-2 items-center">
        <button id="google-login" type="button" class="btn btn-outline-secondary d-flex align-items-center gap-2">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" style="width: 20px; height: 20px;" />
          <span>Continuar con Google</span>
        </button>
      </div>

      <div class="mt-3 text-xs text-gray-600 flex items-center justify-center gap-2 text-center">
        <svg id="info" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M13 16h-1v-4h-1m1-4h.01M12 20.5c4.694 0 8.5-3.806 8.5-8.5s-3.806-8.5-8.5-8.5-8.5 3.806-8.5 8.5 3.806 8.5 8.5 8.5z" />
        </svg>
        Tu usuario es tu Matrícula o Correo institucional.
      </div>
    </div>
  </div>

  <!-- Modal: Recuperar contraseña -->
  <div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="modalRecuperarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="recuperar.php">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalRecuperarLabel">Recuperar contraseña</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <label for="correo-recuperar" class="form-label">Correo electrónico</label>
            <input type="email" name="correo" class="form-control" id="correo-recuperar" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Ayuda -->
  <div class="modal fade" id="modalAyuda" tabindex="-1" aria-labelledby="ayudaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="ayudaLabel">¿Necesitas ayuda?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p class="text-sm text-muted">
            Para soporte técnico, comunícate al correo: <strong>soporte@itess.edu.mx</strong> o acude con el personal de la Academia de TICS.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Firebase SDKs -->
  <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-auth-compat.js"></script>


  <script>
  // Configuración Firebase
  const firebaseConfig = {
    apiKey: "AIzaSyClRsFh2-yh7Ft8JXLJrB4NdqBeBhsL8UI",
    authDomain: "framework-login.firebaseapp.com",
    projectId: "framework-login",
    appId: "1:745627812413:web:98e255e61c8b2355cde054"
  };

  // Inicializa Firebase
  firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();

  // Login con Google con fetch para backend
  document.getElementById('google-login').addEventListener('click', () => {
    const provider = new firebase.auth.GoogleAuthProvider();

    auth.signInWithPopup(provider)
      .then(result => result.user.getIdToken())
      .then(token => {
        console.log("Token para el backend:", token);

        // Enviar token a backend para validación y sesión
        fetch('login_google.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ token: token })
        })
          .then(response => {
            if (!response.ok) throw new Error('Error al iniciar sesión en el servidor.');
            return response.json();
          })
          .then(data => {
            if(data.success) {
              window.location.href = "home.php";
            } else {
              alert("Login fallido: " + (data.message || "Error desconocido"));
            }
          })
          .catch(error => {
            alert(error.message);
            console.error(error);
          });
      })
      .catch(error => {
        alert("Error en el login con Google.");
        console.error(error);
      });
  });
</script>

  <!-- Scripts extras y Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Limpia formulario al cargar
    window.addEventListener("load", () => {
      const form = document.getElementById("login-form");
      if (form) form.reset();
    });
  </script>

  <!-- Tu JS personalizado si existe -->
  <script type="module" src="/src/components/main.js"></script>


 <script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('google-login');
  if(btn) {
    btn.addEventListener('click', () => {
      console.log('Botón Google clickeado');

      const provider = new firebase.auth.GoogleAuthProvider();

      firebase.auth().signInWithPopup(provider)
        .then(result => {
          console.log('Usuario autenticado con Firebase:', result.user);
          return result.user.getIdToken();
        })
        .then(token => {
          console.log('Token ID obtenido:', token);

          fetch("http://miproyecto.local/backend/login_google.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token: token })
          })
            .then(response => {
              console.log('Respuesta del backend:', response);
              if (!response.ok) throw new Error('Error al iniciar sesión en el servidor.');
              return response.json();
            })
            .then(data => {
              console.log('Datos recibidos del backend:', data);
              if(data.success) {
                window.location.href = "home.php";
              } else {
                alert("Login fallido: " + (data.message || "Error desconocido"));
              }
            })
            .catch(error => {
              alert(error.message);
              console.error(error);
            });
        })
        .catch(error => {
          alert("Error en el login con Google.");
          console.error(error);
        });
    });
  } else {
    console.error('No se encontró botón Google-login');
  }
});
</script>



</body>

</html>
