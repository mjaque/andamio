/**
  Vista1.
**/

import { Vista } from './vista.js'
import { Clase1 } from '../modelos/clase1.js'

export class Vista1 extends Vista{
  /**
    Constructor de la clase.
    @param {Object} controlador Controlador de la vista.
    @param {Node} base Nodo al que se añadirá la vista.
  **/
  constructor (controlador, base) {
    super(controlador)
    this.base = base
   
    // Cogemos referencias a los elementos del interfaz
    this.iCampo1 = this.base.querySelectorAll('input')[0]
	this.pError1 = this.base.querySelectorAll('p.error')[0]
    this.iCampo2 = this.base.querySelectorAll('input')[1]
	this.pError2 = this.base.querySelectorAll('p.error')[2]
	this.btnEnviar = this.base.getElementsByTagName('button')[0]

    // Asociamos eventos
    this.iCampo1.onchange = this.validarCampo.bind(this)
    this.iCampo2.onchange = this.validarCampo.bind(this)
	this.btnEnviar.onclick = this.enviar.bind(this)
  }

  validarCampo(evento){
	const campo = evento.target

	if (campo === this.iCampo1){
	  //Comprobamos la longitud del campo (por ejemplo)
	  if (campo.value.length < 3)
		this.pError1.style.display = 'block'
	  else
		this.pError1.style.display = 'none'
	}
	if (campo === this.iCampo2){
	  //Aquí va la validación del Campo 2
	}
  }

  enviar(){
	//Validaciones cruzadas de campos
	//...

	//Creamos un objeto con los campos
	const campo1 = this.iCampo1.value
	const campo2 = this.iCampo2.value
	const objeto = new Clase1(campo1, campo2)
  
	//Enviamos los datos al controlador
	this.controlador.accion1(objeto)
  }
}
