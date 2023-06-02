/**
  Controlador principal de la aplicación.
**/

// Cargamos los Modelos
import { Modelo } from './modelos/modelo.js'
import { Clase1 } from './modelos/clase1.js'

// Cargamos las Vistas
import { VistaMenu } from './vistas/vistamenu.js'
import { Vista1 } from './vistas/vista1.js'
import { Vista2 } from './vistas/vista2.js'

// Cargamos los Servicios
import { Rest } from './servicios/rest.js'

/**
  Controlador principal de la aplicación.
**/
class App {
  #usuario = null // Usuario logeado.

  constructor () {
    window.onload = this.iniciar.bind(this)
    window.onerror = function (error) { console.log('Error capturado. ' + error) }
  }

  /**
    Inicia la aplicación y muestra la vista1.
    Se llama al cargar la página.
  **/
  iniciar () {
    // Comprobar login
    this.#usuario = JSON.parse(sessionStorage.getItem('usuario'))
    // console.log(this.#usuario)
    if (!this.#usuario) { window.location.href = 'login.html' } // Falta informar al usuario del error.
    //Establecemos la autorización para las llamadas REST
    Rest.setAutorizacion(this.#usuario.autorizacion)
    this.modelo = new Modelo()
    this.vistaMenu = new VistaMenu(this, document.getElementById('divMenu'))
    this.vista1 = new Vista1(this, document.getElementById('divVista1'))
    this.vista2 = new Vista2(this, document.getElementById('divVista2'))

    this.verVista1()
  }

  /**
    Muestra el error en la vista de mensajes.
    @param error {Error} Error que se ha producido.
  **/
  gestionarError (error) {
    console.error(error)
  }

  /**
    Recibe el token del login con Google y lo envía al servidor para identificar al usuario.
    @param token {Object} Token de identificación de usuario de Google.
  **/
  loginGoogle (token) {
    Rest.post('login', [], token.credential, true)
      .then(usuario => {
        this.#usuario = usuario
        Rest.setAutorizacion(this.#usuario.autorizacion)
        this.vistaMenu.mostrar(true)
        this.vistaLogin.mostrar(false)
        switch (usuario.rol) {
          case 'alumno':
            this.mostrarTareasAlumno(this.#usuario)
            break
          case 'profesor':
            this.mostrarAlumnos()
            break
          default:
            console.error(`Rol de usuario desconocido: ${usuario.rol}`)
        }
      })
      .catch(e => { this.vistaLogin.mostrarError(e) })
  }

  /**
    Cierra la sesión del usuario.
  **/
  logout () {
    this.#usuario = null
    Rest.setAutorizacion(null)
    window.location.href = 'login.html'
  }

  verVista1 () {
    this.vistaMenu.verVista1()
    this.ocultarVistas()
    this.vista1.mostrar()
  }

  verVista2 () {
    this.vistaMenu.verVista2()
    this.ocultarVistas()
    this.vista2.mostrar()
  }

  /**
    Oculta todas las vistas.
  **/
  ocultarVistas () {
    this.vista1.mostrar(false)
    this.vista2.mostrar(false)
  }

  accion1 (objeto) {
    // Acción 1
    Rest.post('entidad1', [], objeto)
      .then(respuesta => {
        // Procesamos la respuesta del servidor
        // Actualizamos el modelo
        // Cambiamos de vista...
      })
      .catch(error => {
        // Gestionamos el error
      })
  }
}

/* eslint-disable no-new */
new App()
