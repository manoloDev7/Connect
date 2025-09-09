<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>


    <script>
      (function(){
        function togglePw(btn){
          const wrap = btn.closest('[data-pw]');
          if (!wrap) return;
          const inp = wrap.querySelector('input[type="password"], input[type="text"]');
          if (!inp) return;
          const toText = (inp.type === 'password');
          inp.type = toText ? 'text' : 'password';
          btn.setAttribute('aria-label', toText ? 'Ocultar contraseña' : 'Mostrar contraseña');
          btn.textContent = toText ? '🙈' : '👁';
        }

        // Un solo listener para todos los botones (presentes o futuros)
        document.addEventListener('click', function(e){
          const btn = e.target.closest('.pw-toggle');
          if (!btn) return;
          e.preventDefault();
          togglePw(btn);
        });

        // Validación de contraseña en REGISTRO (segura + confirmación)
        document.addEventListener("DOMContentLoaded", function () {
          const form = document.getElementById("form-registro");
          const p1 = document.getElementById("password");
          const p2 = document.getElementById("password2");
          if (!form || !p1 || !p2) return;

          form.addEventListener("submit", function (e) {
            const pass1 = p1.value || '';
            const pass2 = p2.value || '';
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

            if (!regex.test(pass1)) {
              e.preventDefault();
              alert("La contraseña debe tener:\n- 8+ caracteres\n- 1 mayúscula\n- 1 minúscula\n- 1 número\n- 1 símbolo");
              return;
            }
            if (pass1 !== pass2) {
              e.preventDefault();
              alert("Las contraseñas no coinciden.");
            }
          });
        });
      })();
    </script>
    
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=DM+Sans&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Urbanist&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Sora&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap');
      body{
        background-color:#000000;
        background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),url(../src-y-fotos/fondoCartaConte.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 800px;
      }
      * {
        padding: 0;
        margin: 0;
      }
      .form {
        background-color: #fff;
        display: block;
        padding: 3rem;
        max-width: 368px;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);

        margin-top: 11vw;
        margin-left: 35vw;
        box-shadow: 0 0 15px #01acb4;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.10s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
        animation: hey 1s ease-in-out infinite;
      }
      .form:hover{
        cursor: pointer;
        box-shadow: 0 0 20px #9da2a739;
        transform: scale(1.1);
        cursor: pointer;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }

      .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: #ffffff;
        font-family: Arial, Helvetica, sans-serif;
        padding:10px;
      }

      .input-container {
        position: relative;
      }

      .input-container input,
      .form button {
        outline: none;
        border: 1px solid #e5e7eb;
        margin: 8px 0;
      }

      .input-container input {
        background-color: #fff;
        padding: 1rem;
        padding-right: 3rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      }

      .submit {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: #ffffffff;
        color: #000000ff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.5rem;
        text-transform: uppercase;
        cursor: pointer;
      }
      .submit:hover{
        cursor: pointer;
        box-shadow: 0 0 20px #9da2a739;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }

      .signup-link {
        color: #ffffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
      }

      .signup-link a {
        text-decoration: underline;
        color: #01acb4;
      }
      .conte_nav {
        height: 58px;
        background-color: #01acb4;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        border-radius: 2em;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.10s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(104, 104, 104, 0.651);
        color: white;
      }
      .opo {
        display: flex;
        align-content: center;
        padding: 0 1vw;
        color: white;
        
        border-radius: 2em;
      }
      a {
        font-family: "DM Sans", sans-serif;
        font-weight: 900;
        color: #ffffff;
        border-radius: 0.5em;
        text-decoration: none;
        padding: 0px 1px;
      }
      .opo:hover {
        box-shadow: 0 0 20px #9da2a739;
        transform: scale(1.1);
        cursor: pointer;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }
      .opo:active {
        background-color: #444646;
        transition: all 0.25s;
        -webkit-transition: all 0.25s;
        box-shadow: none;
        transform: scale(0.98);
      }
      .nav {
        display: flex;
        justify-content: space-between;
        width: 14%;
        display: inline-block;
        justify-content: flex-end;
      }
      .conte_logo {
        margin-left: 5rem;
      }
      .imagen_logo {
        width: 100%;
        height: 1vw;
        display: flex;
        display: inline-block;
      }
      .nuevoUsuario-opcion-en-nav{
        color: #01acb4;
        height: 3vw;
      }
      
      /* Activa posicionamiento solo cuando hay data-pw */
      .input-container[data-pw] { position: relative; }

      /* Un pequeño padding para que no tape el botón (ajústalo si ya tienes padding) */
      .input-container[data-pw] > input { padding-right: 44px; }

      /* El botón ojo */
      .pw-toggle{
        position:absolute; right:15px; top:40%; transform:translateY(-50%);
        background:transparent; border:0; cursor:pointer; font-size:16px;
       line-height:1; z-index:2;
       /* Si tu fondo es oscuro y el texto del botón no se ve, ajusta color aquí */
      }
      .pw-toggle:focus{ outline:2px solid #4edede; border-radius:6px; } 
    </style>
  </head>
  <body>
    <nav class="conte_nav">
      <div class="conte_logo">
        <div class="imagen_logo">
          <img src="../src-y-fotos/logoColores2.png" width="150vw" height="150vw" alt="" onclick="home()">
        </div>
      </div>
      <nav class="nav">
        <div class="opo" style="display: inline-block;"><a href="./home">Inicio</a></div>
        <div class="opo" style="display: inline-block;"><a class="nuevoUsuario-opcion-en-nav" href="index.php?route=register">Registrate</a></div>
      </nav>
    </nav>
    <?php if (!empty($error)): ?>
    <p style="color:red"><?=htmlspecialchars($error)?></p>
    <?php endif; ?>


    <form class="form" method="post" action="index.php?route=login">
      <?= csrf_input() ?>
      <p class="form-title">Ingresa a tu cuenta</p>
      
      <!-- LOGIN -->
      <div class="input-container">
        <input
          type="email"
          placeholder="Ingrese email"
          id="email"
          name="email"
          required
          class="input-container"
        />
      </div>

      <div class="input-container" data-pw>
        <input type="password" id="login_password" name="password" placeholder="Ingrese contraseña" required>
        <button type="button" class="pw-toggle" aria-label="Mostrar contraseña">👁</button>
      </div>

      <button type="submit" class="submit"  >Ingresar</button>

      <p class="signup-link">
        No tienes?
        <a href="index.php?route=register">Registrate</a>
      </p>
    </form>
  </body>
</html>
