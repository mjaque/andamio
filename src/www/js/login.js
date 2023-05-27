/**
  Controlador de Login.
  Creamos un controlador de login distinto del principal para no tener siempre cargadas las librerías de login.
**/

// Cargamos los Servicios
import { Rest } from './servicios/rest.js'

/**
  Controlador de Login.
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
    // Capturamos los elementos de la vista
    this.usuario = document.querySelectorAll('input')[0] // primer input
    this.clave = document.querySelectorAll('input')[1] // segundo input
    this.btnAcceder = document.querySelector('button')

    // Capturamos eventos
    this.btnAcceder.onclick = this.login.bind(this)
  }

  /**
    Recoge los datos y los envía al servidor para identificar al usuario
  **/
  login (token) {
    const login = {
      usuario: this.usuario.value,
      clave: this.clave.value
    }
    // Aquí se hace la validación de campos

    Rest.post('login', [], login, true)
    // Recibimos del servidor el token de autenticación (o un error si falla la autenticación)
      .then(usuario => {
        // console.log(usuario)
        // Guardamos el token en SessionStorage
        sessionStorage.setItem('usuario', JSON.stringify(usuario))
        // Vamos a la página principal
        window.location.href = 'index.html'
      })
      .catch(e => {
        // Gestión del error (informar al usuario, etc.)
        console.log(e)
      })
  }
}

/* eslint-disable no-new */
new Login()
