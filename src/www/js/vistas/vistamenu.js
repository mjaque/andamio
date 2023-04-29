/**
  Vista del menú de navegación de la aplicación.
  Muestra los enlaces de contexto.
**/
import { Vista } from './vista.js'

export class VistaMenu extends Vista {
  /**
    Constructor de la clase.
    @param {Object} controlador Controlador de la vista principal.
    @param {Node} base Nodo al que se añadirá la vista principal.
  **/
  constructor (controlador, base) {
    super(controlador, 'flex')
    this.base = base
    
    // Cogemos referencias a los elementos del interfaz

    // Asociamos eventos
  }

  /**
    Muestra la vista 1.
  **/
  verVista1 () {
    this.limpiar()
    const h1 = document.createElement('h1')
    this.base.appendChild(h1)
    h1.appendChild(document.createTextNode('Estás en Vista 1'))
    //this.crearEnlaceAVista2()
    this.base.appendChild(this.crearEnlaceAVista2())
  }

  /**
    Muestra la vista 2.
  **/
  verVista2 () {
    this.limpiar()
    const h1 = document.createElement('h1')
    this.base.appendChild(h1)
    h1.appendChild(document.createTextNode('Estás en Vista 2'))
    this.base.appendChild(this.crearEnlaceAVista1())
  }
  
  /**
   * 
   */
  crearEnlaceAVista1(){
    const a = document.createElement('a')
    a.appendChild(document.createTextNode('Ver Vista1'))
    a.onclick = this.controlador.verVista1.bind(this.controlador)
    return a
  }

  /**
   * 
   * 
   */
  crearEnlaceAVista2(){
    const a = document.createElement('a')
    a.appendChild(document.createTextNode('Ver Vista2'))
    a.onclick = this.controlador.verVista2.bind(this.controlador)
    return a
  }

  /**
    Elimina los elementos del menú.
  **/
  limpiar () {
    this.eliminarHijos(this.base)
  }

  crearIconoAyuda (texto) {
    return this.crearIcono('help.svg', null, texto)
  }
}
