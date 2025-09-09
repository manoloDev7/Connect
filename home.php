<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <script>
      function abrirPopup() {
        document.getElementById("formPopup").style.display = "block";
        mostrarFormulario("registro"); // Por defecto abrir login
      }

      function cerrarPopup() {
        document.getElementById("formPopup").style.display = "none";
      }

      function mostrarFormulario(tipo) {
        // Mostrar y ocultar formularios
        document.getElementById("form-login").style.display =
          tipo === "login" ? "block" : "none";
        document.getElementById("form-registro").style.display =
          tipo === "registro" ? "block" : "none";

        // Activar el botón correcto
        const tabs = document.querySelectorAll(".tab-btn");
        tabs.forEach((tab) => tab.classList.remove("active"));
        if (tipo === "login") {
          tabs[0].classList.add("active");
        } else {
          tabs[1].classList.add("active");
        }
      }
    </script>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Inter&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Barlow&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=DM+Sans&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Work+Sans&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Manrope&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Urbanist&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Manrope&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Sora&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap");
      body {
        background-color: #000000;
      }
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
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
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(104, 104, 104, 0.651);
        color: white;
      }
      @keyframes hey {
        0% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(10px);
        }
        100% {
          transform: translateY(0);
        }
      }
      .opo {
        display: flex;
        align-content: center;
        padding: 0 1vw;
        color: white;
        
        border-radius: 2em;
      }
      pre{
        height:0;
        width: 0;
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
        width: 25%;
        display: inline-block;
        justify-content: flex-end;
      }
      .conte_logo {
        margin-left: 5rem;
      }
      .imagen_logo {
        width: 100%;
        height: vw;
        display: flex;
        display: inline-block;
      }

      .nuevoUsuario-opcion-en-nav {
        color: #01acb4;
        height: 3vw;
      }

      .bloque-espaciador {
        height: 30px;
      }

      .banner {
        position: relative;
        width: 100%;
        height: 60vh;
        overflow: hidden;
      }

      .video-fondo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
      }

      /* Degradado oscuro encima del video */
      .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
          to bottom,
          rgba(0, 0, 0, 0.6),
          rgba(0, 0, 0, 0.6)
        );
        z-index: 1;
      }

      .texto-bienvenida {
        font-family: "Work Sans", sans-serif;
        font-weight: bold;
        font-size: 3.5vw;
        color: #ffffff;
        margin: 0;
      }
      .texto-bienvenida:hover {
        cursor: pointer;
      }
      .contenido-banner {
        display: flex;
        display: block;
        width: 60%;
        height: 500px;
        position: relative;
        z-index: 2; /* encima del overlay */
        color: white;
        text-align: left;
        padding: 0 0rem;
        margin-left: 50px;
        margin-top: 30px;
      }

      .shadow__btn {
        padding: 10px 20px;
        margin-top: 10px;
        border: none;
        font-size: 23px;
        color: #fff;
        border-radius: 2em;
        letter-spacing: 1px;
        font-weight: 700;
        text-transform: capitalize;
        transition: 0.5s;
        transition-property: box-shadow;
        font-family: "Work Sans", sans-serif;
      }
      @keyframes hey {
        0% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(10px);
        }
        100% {
          transform: translateY(0);
        }
      }

      .shadow__btn {
        background: #4edede;
        box-shadow: 0 0 5px #01acb4;
        animation: hey 1s ease-in-out infinite;
      }

      .shadow__btn:hover {
        box-shadow: 0 0 5px #4edede, 0 0 15px #4edede, 0 0 25px #4edede,
          0 0 50px #4edede;
        cursor: pointer;
      }

      .seccion-carta {
        height: 550px;
        background-color: #e6e6e6;
        display: flex;
        justify-content: space-between;
        justify-content: space-around;
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.6),
            rgba(0, 0, 0, 0.6)
          ),
          url(../src-y-fotos/fondoCartaConte.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .carta {
        display: flex;
        display: inline-block;
        border-radius: 2rem;
        width: 37%;
        padding: 30px 10px;
        margin-top: 30px;
        margin-bottom: 30px;
        box-shadow: 0 0 15px #01acb4;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
        height: 480px;
      }
      .carta:hover {
        box-shadow: 0 0 30px #01acb4;
        cursor: pointer;
        box-shadow: 0 0 20px #dbdddea4;
        cursor: pointer;
      }
      .cartaa {
        background-color: #ffff;
        display: flex;
        display: inline-block;
        border-radius: 2rem;
        width: 37%;
        padding: 30px 10px;
        margin-top: 30px;
        margin-bottom: 30px;
        box-shadow: 0 0 15px #01acb4;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
        height: 480px;
      }
      .cartaa:hover {
        box-shadow: 0 0 30px #01acb4;
        cursor: pointer;
        box-shadow: 0 0 20px #f9f9f9b2;
        cursor: pointer;
      }
      .cabeza-carta {
        font-weight: bold;
        font-family: "Work Sans", sans-serif;
      }

      .card {
        width: 50%;
        height: 300px;
        border: none;
        border-radius: 1rem;
        padding-top: 10px;
        position: relative;
        margin: auto;
        font-family: "Work Sans", sans-serif;
        font-weight: 700;
        margin-top: 10px;
        box-shadow: 0 0 15px #01acb4;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
        animation: hey 1s ease-in-out infinite;
      }
      .card:hover {
        cursor: pointer;
        box-shadow: 0 0 20px #9da2a739;
        transform: scale(1.1);
        cursor: pointer;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }
      .card:active {
        background-color: #444646;
        transition: all 0.25s;
        -webkit-transition: all 0.25s;
        box-shadow: none;
        transform: scale(1.1);
      }

      .card span {
        font-weight: 600;
        color: white;
        text-align: center;
        display: block;
        padding-top: 10px;
        font-size: 1.3em;
      }

      .card .job {
        font-weight: 400;
        color: white;
        display: block;
        text-align: center;
        padding-top: 5px;
        font-size: 1em;
      }
      .card .job:hover {
        cursor: pointer;
      }

      .card .img {
        width: 40%;
        height: 87px;
        background: #e8e8e8;
        border-radius: 100%;
        margin: auto;
        margin-top: 45px;
        background-image: url(../src-y-fotos/retratoCarta.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      .card button {
        padding: 8px 25px;
        display: block;
        margin: auto;
        border-radius: 8px;
        border: none;
        margin-top: 20px;
        background: #e6e6e6;
        color: #111111;
        font-weight: 600;
        color: #000;
        box-shadow: 0 0 15px #01acb4;
      }

      .card button:hover {
        background: #01acb4;
        color: #ffff;
        cursor: pointer;
        transition: 400ms;
      }

      .card2 {
        width: 190px;
        background: white;
        padding: 0.4em;
        border-radius: 1rem;
        box-shadow: 0 0 15px #01acb4;
        margin: auto;
        margin-top: 10px;
        height: 320px;
        transition: all 0.1s ease-in-out;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
        animation: hey 1s ease-in-out infinite;
        font-family: "Work Sans", sans-serif;
      }
      .card2:hover {
        box-shadow: 0 0 20px #9da2a739;
        transform: scale(1.1);
        cursor: pointer;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }
      .card2:active {
        background-color: #444646;
        transition: all 0.25s;
        -webkit-transition: all 0.25s;
        box-shadow: none;
        transform: scale(1.1);
      }

      .card-image2 {
        background-color: rgb(236, 236, 236);
        width: 100%;
        height: 150px;
        border-radius: 6px 6px 0 0;
        background-image: url(../src-y-fotos/fondoContaCarta.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      .card-image:hover {
        transform: scale(0.98);
      }

      .category {
        text-transform: uppercase;
        font-size: 0.9em;
        font-weight: 700;
        color: #ffffff;
        padding: 15px 7px 0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .category:hover {
        cursor: pointer;
      }

      .heading {
        font-weight: 700;
        color: rgb(255, 255, 255);
        padding: 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1em;
      }

      .heading:hover {
        cursor: pointer;
      }

      .author {
        color: rgb(255, 255, 255);
        font-weight: 700;
        font-size: 11px;
        padding-top: 20px;
        font-family: Arial, Helvetica, sans-serif;
      }

      .name {
        font-weight: 700;
        font-family: Arial, Helvetica, sans-serif;
      }

      .name:hover {
        cursor: pointer;
      }
      .seccion-barraExplorar {
        height: 700px;
        background-color: #01acb4;
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.8),
            rgba(0, 0, 0, 0.6)
          ),
          url(../src-y-fotos/portada-barraexplorador.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: 40%;
      }

      .input {
        width: 100%;
        height: 60px;
        line-height: 28px;
        padding: 0 10rem;
        padding-left: 2.5rem;
        border: 2px solid transparent;
        border-radius: 2em;
        outline: none;
        background-color: #f3f3f4;
        color: #000000;
        transition: 0.3s ease;
        margin-left: 130px;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
      }

      .input::placeholder {
        color: #ffffff;
      }

      .input:focus,
      input:hover {
        outline: none;
        border-color: rgba(234, 226, 183, 0.4);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgb(234 226 183 / 10%);
        box-shadow: 0 0 15px #01acb4;
      }

      .icon {
        position: absolute;
        left: 9rem;
        fill: #9e9ea7;
        width: 1rem;
        height: 1rem;
      }
      .texto-cabeza-barra {
        font-family: "Work Sans", sans-serif;
        font-weight: 700;
        font-size: 3em;
        color: #ffffff;
      }
      .cabeza-barra {
        padding: 20px 30px;
        margin-left: 100px;
      }
      .h3 {
        font-family: "Work Sans", sans-serif;
        padding: 20px 1rem;
        font-weight: 700;
        font-size: 1.5vw;
        display: flex;
        display: inline-block;
        margin-left: 110px;
        color: #ffffff;
      }
      .link-ubis-conte-barra {
        color: #01acb4;
        text-decoration: underline;
      }
      .conte-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        background-color: transparent;
        gap: 40px;
        padding: 20px 130px;
        height: 400px;
        margin-left: 30px;
        width: 70%;
      }
      .f1,
      .f2,
      .f3,
      .f4,
      .f5,
      .f6 {
        height: 170px;
        border-radius: 2em;
        box-shadow: 0 0 15px #212730;
        width: 20vw;
        transition: all 0.1s ease-in-out;
        color: transparent;
      }
      .f1,
      .f2,
      .f3,
      .f4,
      .f5,
      .f6:hover {
        transform: scale(1.1);
      }
      .f1,
      .f2,
      .f3,
      .f4,
      .f5,
      .f6:active {
        transition: all 0.25s;
        -webkit-transition: all 0.25s;
        box-shadow: none;
        transform: scale(0.98);
      }
      .f1 {
        background-image: url(../src-y-fotos/fondoTulcingo.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        cursor: pointer;
        overflow: hidden;
      }
      .f1:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .f2 {
        background-image: url(../src-y-fotos/fondoHuamux.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .f2:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .f3 {
        background-image: url(../src-y-fotos/fondoTlapa.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .f3:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .f4 {
        background-image: url(../src-y-fotos/fondoTeco.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin-left:100px;
      }
      .f4:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .f5 {
        background-image: url(../src-y-fotos/izucarFondo.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin-left:100px;
      }
      .f5:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .f6 {
        background-image: url(../src-y-fotos/izucarFondo.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .f6:hover {
        box-shadow: 0 0 25px #ffffff;
        transform: scale(1.1);
      }
      .footer {
        background: #2f3132;
        color: #ecf0f1;
        padding: 2rem 0 1rem;
        margin-top: auto;
      }

      .footer-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 1rem;
      }

      .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
      }

      .footer-section h3 {
        color: #3498db;
        margin-bottom: 1rem;
        font-size: 1.1rem;
      }

      .footer-section ul {
        list-style: none;
      }

      .footer-section ul li {
        margin-bottom: 0.5rem;
      }

      .footer-link {
        color: #bdc3c7;
        text-decoration: none;
        transition: color 0.3s ease;
      }

      .footer-link:hover {
        color: #3498db;
      }

      .footer-bottom {
        border-top: 1px solid #34495e;
        padding-top: 1rem;
        text-align: center;
        color: #95a5a6;
        font-size: 0.9rem;
      }

      .social-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin: 1.5rem 0;
      }

      .footer-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid transparent;
        border-radius: 50%;
        color: #bdc3c7;
        font-size: 1.3rem;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
      }

      .footer-social-link:hover {
        background: rgba(52, 152, 219, 0.2);
        border-color: #3498db;
        color: #3498db;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
      }

      .footer-social-link.facebook:hover {
        background: rgba(24, 119, 242, 0.2);
        border-color: #1877f2;
        color: #1877f2;
        box-shadow: 0 5px 15px rgba(24, 119, 242, 0.3);
      }

      .footer-social-link.instagram:hover {
        background: linear-gradient(
          45deg,
          rgba(225, 48, 108, 0.2),
          rgba(255, 220, 128, 0.2)
        );
        border-color: #e1306c;
        color: #e1306c;
        box-shadow: 0 5px 15px rgba(225, 48, 108, 0.3);
      }

      .footer-legal-link {
        color: #95a5a6;
        margin: 0 1rem;
        text-decoration: none;
        transition: color 0.3s ease;
      }

      .footer-legal-link:hover {
        color: #3498db;
      }

      @media (max-width: 768px) {
        .footer-content {
          grid-template-columns: 1fr;
          text-align: center;
        }
      }

      .bloque-espaciador {
        background-color: #000;
      }

      /* Fondo del pop-up */
      .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
      }

      /* Contenido del formulario emergente */
      .popup-content {
        background-color: #fff;
        display: block;
        padding: 1rem;
        max-width: 380px;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);

        margin-top: 1.5vw;
        margin-left: 35vw;
        box-shadow: 0 0 15px #01acb4;
        background: hsl(0, 0%, 100%, 0.2);
        border-style: unset;
        border: 3px solid hsl(0, 0%, 100%, 0.3);
        transition: all 0.1s ease-in-out;
        background: rgba(255, 255, 255, 0.131); /* más transparente */
        backdrop-filter: blur(3px); /* blur más sutil */
        -webkit-backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.017);
        box-shadow: 0 4px 15px rgba(216, 212, 212, 0.651);
        color: white;
      }
      .popup-content:hover {
        cursor: pointer;
        box-shadow: 0 0 20px #9da2a739;
        transform: scale(1.1);
        cursor: pointer;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }

      /* Ícono de cierre (X) */
      .cerrar-icono {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 22px;
        color: #555;
        cursor: pointer;
        transition: color 0.3s;
      }

      .cerrar-icono:hover {
        color: #d00;
      }

      /* Estilos del formulario */
      .form {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: #ffffff;
        font-family: Arial, Helvetica, sans-serif;
        padding: 10px;
      }

      .input-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .input-container input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
      }

      .submit {
        display: block;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
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

      .submit:hover {
        cursor: pointer;
        box-shadow: 0 0 20px #9da2a739;
        background: rgba(255, 255, 255, 0.241); /* más transparente */
        backdrop-filter: blur(50px); /* blur más sutil */
        -webkit-backdrop-filter: blur(50px);
      }
      .tab-btnactive {
        display: inline-block;
        background-color: #ffffffff;
        color: #000000ff;
        font-size: 0.5vw;
        line-height: 1rem;
        font-weight: bold;
        width: 30%;
        border-radius: 0.5rem;
        text-transform: uppercase;
        cursor: pointer;
      }
      .tab-btn {
        display: inline-block;
        background-color: #ffffffff;
        color: #000000ff;
        font-size: 0.5vw;
        line-height: 1rem;
        font-weight: bold;
        width: 30%;
        border-radius: 0.5rem;
        text-transform: uppercase;
        cursor: pointer;
      }
      .signup-link {
        font-family: "DM Sans", sans-serif;
      }
      .selecto{
        font-family:arial;
      }
    </style>
  </head>
  <body>
    <nav class="conte_nav">
      <div class="conte_logo">
        <div class="imagen_logo">
          <img
            src="../src-y-fotos/logoColores2.png"
            width="150vw"
            height="150vw"
            alt=""
          />
        </div>
      </div>
      <nav class="nav">
        <div class="opo" style="display: inline-block">
          <a href="index.php?route=empleos">Empleos</a>
        </div>
        
        <div class="opo" style="display: inline-block">
          <a href="index.php?route=login">Log in</a>
        </div>
        <div class="opo" style="display: inline-block">
          <a class="nuevoUsuario-opcion-en-nav" href="index.php?route=register"
            >Resgistrate</a
          >
        </div>
      </nav>
    </nav>

    <section class="banner">
      <video class="video-fondo" autoplay muted loop playsinline>
        <source src="../src-y-fotos/video3Home.mp4" type="video/mp4" />
        Tu navegador no soporta videos.
      </video>
      
      
      <div class="overlay"></div>

      <div class="contenido-banner">
        <p class="texto-bienvenida">
          Bienvenido al mejor sitio web para encontrar empleo en Mexico.
        </p>
        <button class="shadow__btn" onclick="abrirPopup()">
          Registrate ya!
        </button>
      </div>
    </section>
    <div class="bloque-espaciador"></div>

    <div class="seccion-carta" onclick="abrirPopup()">
      <div class="carta">
        <div class="cabeza-carta">
          <h3>Contrata gente</h3>
          <h1>Para tu negocio</h1>
        </div>
        <div class="card" onclick="abrirPopup()">
          <div class="card-border-top"></div>
          <div class="img"></div>
          <span> Maria Alejandra Perez</span>
          <p class="job">Contador</p>
          <button onclick="abrirPopup()">Chatear</button>
        </div>
      </div>
      <div class="cartaa" onclick="abrirPopup()">
        <div class="cabeza-carta">
          <h3>Genera dinero</h3>
          <h1>Consigue un empleo</h1>
        </div>
        <div class="card2" onclick="abrirPopup()">
          <div class="card-image2"></div>
          <div class="category">Finanzas</div>
          <div class="heading">
            <h3>Contador de tiempo completo</h3>
            <div class="author">
              Por <span class="name">Jose </span>hace 4 dias
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bloque-espaciador"></div>
    <div class="seccion-barraExplorar">
      <div class="cabeza-barra">
        <p class="texto-cabeza-barra">Explora nuevos empleos</p>
      </div>
      <div class="conte-barra">
        <form class="group" action="index.php" method="get" style="width:100%">
          <input type="hidden" name="route" value="empleos">
          <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
            <g>
              <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
            </g>
          </svg>
          <input class="input" type="search" name="ubicacion" placeholder="Busca empleo por ubicacion" required />
          <button type="submit" style="display:none">Buscar</button>
        </form>
      </div>

      <div class="conte-sub-barra">
        <p class="h3">
          Encuentra nuevas oportunidades de empleo hoy. Explora los mejores
          empleos cerca de tu ubicacion.
        </p>
        <a class="link-ubis-conte-barra" href="index.php?route=empleos"
          >Mas ubicaciones</a
        >
        <div class="conte-grid">
          <a class="f1" href="index.php?route=empleos&ubicacion=Tulcingo">Tulcingo</a>
          <a class="f2" href="index.php?route=empleos&ubicacion=Huamuxtitlan">Huamuxtitlan</a>
          <a class="f3" href="index.php?route=empleos&ubicacion=Tlapa de Comonfort">Tlapa de Comonfort</a>
          <a class="f4" href="index.php?route=empleos&ubicacion=Tecomatlan">Tecomatlan</a>
          <a class="f5" href="index.php?route=empleos&ubicacion=Izucar de Matamoros">Izucar de Matamoros</a>
        </div>

      </div>
    </div>

    <footer class="footer">
      <div class="footer-container">
        <div class="footer-content">
          <div class="footer-section">
            <h3>Para Candidatos</h3>
            <ul>
              <li><a href="index.php?route=empleos" class="footer-link">Buscar Empleos</a></li>
              
            </ul>
          </div>

          <div class="footer-section">
            <h3>Para Empresas</h3>
            <ul>
              <li>
                <a href="index.php?route=empleos" class="footer-link">Publicar Empleo</a>
              </li>
              
            </ul>
          </div>

          <div class="footer-section">

            <ul>
             
              
                
              </li>
            </ul>
          </div>
        </div>

        <div class="footer-bottom">
          
          <p>&copy; 2025 Connect. Todos los derechos reservados.</p>
          <p>
            <a href="#privacidad" class="footer-legal-link"
              >Política de Privacidad</a
            >
            <a href="#terminos" class="footer-legal-link">Términos de Uso</a>
            <a href="#cookies" class="footer-legal-link">Cookies</a>
          </p>
        </div>
      </div>
    </footer>

  

    <!-- Pop-up -->
    <div id="formPopup" class="popup">
      <div class="popup-content">
        <!-- Ícono para cerrar -->
        <i class="fas fa-times cerrar-icono" onclick="cerrarPopup()"></i>

        
        <div class="tabs">
          <button class="tab-btnactive" onclick="mostrarFormulario('login')">
            Iniciar sesión
          </button>
          <button class="tab-btn" onclick="mostrarFormulario('registro')">
            Registrate
          </button>
        </div>

        <?php if (!empty($error)): ?>
        <p style="color:red"><?=htmlspecialchars($error)?></p>
        <?php endif; ?>


        <!-- FORMULARIO DElogin-->
        <form id="form-login" class="form" method="post" action="index.php?route=login">
          <?= csrf_input() ?>
          <p class="form-title">Ingresa a tu cuenta</p>
          <div class="input-container">
            <input
              type="email"
              placeholder="Ingrese email"
              id="email"
              .
              name="email"
              required
            />
          </div>
          <div class="input-container" data-pw>
            <input
              type="password"
              placeholder="Ingrese contraseña"
              id="contra"
              name="password"
              required
            />
            <button type="button" class="pw-toggle" aria-label="Mostrar contraseña">👁</button>
          </div>
          <button type="submit" class="submit">Ingresar</button>
          <p class="signup-link">
            ¿No tienes cuenta?
            <a
              href="index.php?route=register"
              onclick="mostrarFormulario('registro')"
              >Regístrate</a
            >
          </p>
        </form>

        <!-- FORMULARIO DE Registro -->
        <form
          id="form-registro"
          class="form"
          method="post"
          style="display: none"
          action="index.php?route=register"
        >
        <?= csrf_input() ?>
          <p class="form-title">Regístrate</p>
          <div class="input-container">
            <input
              type="text"
              placeholder="Ingrese su nombre"
              name="nombre"
              required
            />
            <input
              type="text"
              placeholder="Ingrese su apellido"
              name="apellido"
              required
            />
            
            <input
              type="email"
              placeholder="Ingrese email"
              name="email"
              required
            />
          </div>
          <p style="font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">La contraseña debe tener al menos: 8 caracteres 1 mayúscula 1 minúscula 1 número 1 símbolo</p>
          <div class="input-container" data-pw>
            <input
              id="password"
              type="password"
              placeholder="Ingrese nueva contraseña"
              name="password"
              required
            />
            <button type="button" class="pw-toggle" aria-label="Mostrar contraseña">👁</button>
            <div class="input-container" data-pw>
              <input type="password" id="password2" name="password_confirm" placeholder="Confirme contraseña" required>
              <button type="button" class="pw-toggle" aria-label="Mostrar contraseña">👁</button>
            </div>
            <label for="tipo_usuario" class="selecto">¿Qué buscas?</label>
            <select name="tipo_usuario" id="tipo_usuario" required>
            <option value="candidato">Empleo</option>
            <option value="empresa">Empleados</option>
            </select><br>
          </div>
          <button type="submit" class="submit" id="submit">Registrarse</button>
          <p class="signup-link">
            ¿Ya tienes cuenta?
            <a href="./index1.php" onclick="mostrarFormulario('login')"
              >Inicia sesión</a
            >
          </p>
        </form>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("form-registro");
        const passwordField = document.getElementById("password");

        form.addEventListener("submit", function (e) {
          const password = passwordField.value;

          
          const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

          if (!regex.test(password)) {
            e.preventDefault(); // Evita el envío del formulario
            alert(
              "La contraseña debe tener al menos:\n- 8 caracteres\n- 1 mayúscula\n- 1 minúscula\n- 1 número\n- 1 símbolo"
            );
          }
        });
      });
    </script>
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

        // Validación de contraseña en registro (segura + confirmación)
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
  </body>
</html>
