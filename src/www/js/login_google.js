/**
  Controlador de Login de Google.
  Creamos un controlador de login distinto del principal para no tener siempre cargadas las librerías de login.
**/

// Cargamos los Servicios
import { Rest } from './servicios/rest.js'
import { SessionStorage } from './servicios/sessionstorage.js'

/**
  Controlador de Login de Google.
**/
class Login {
  constructor () {
    window.onload = this.iniciar.bind(this)
    window.onerror = function (error) { console.log('Error capturado. ' + error) }
}

/**
  Inicia el login.
  Se llama al cargar la página.
**/
iniciar () {
    // Login con Google
    // La variable global google es cargada por el script de index.html */
    /* eslint-disable no-undef */
    google.accounts.id.initialize({
      client_id: 'poner aquí el id de cliente de Google',
      callback: this.controlador.login.bind(this.controlador)
    })
    google.accounts.id.renderButton(
      document.getElementById('divGoogleLogin'),
      { theme: 'outline', size: 'large' } // customization attributes
    )
    // google.accounts.id.prompt(); // also display the One Tap dialog
}

  /**
    Recoge los datos y los envía al servidor para identificar al usuarioRecibe el token del login con Google y lo envía al servidor para identificar al usuario.
    @param token {Object} Token de identificación de usuario de Google.
  **/
  login (token) {
    Rest.post('login_google', [], token.credential, true)
    //Recibimos del servidor el token de autenticación (o un error si falla la autenticación)
      .then(usuario => {
        //Guardamos el token en SessionStorage
        //...
        //Vamos a la página principal
        window.location.href = 'index.html'
      })
      .catch(e => { 
        //Gestión del error (informar al usuario, etc.)
        console.log(e) 
    })
  }
}

/* eslint-disable no-new */
new Login()
