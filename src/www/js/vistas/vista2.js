/**
  Vista2.
**/

import { Vista } from './vista.js'

export class Vista2 extends Vista{
  /**
    Constructor de la clase.
    @param {Object} controlador Controlador de la vista.
    @param {Node} base Nodo al que se añadirá la vista.
  **/
  constructor (controlador, base) {
    super(controlador)
    this.base = base
   
    // Cogemos referencias a los elementos del interfaz
    //this.iNombre = document...

    // Asociamos eventos
    //this.btnAceptar.onclick = this.aceptar.bind(this)
  }

}

