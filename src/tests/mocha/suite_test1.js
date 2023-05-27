//Cargamos la librería de assert de Node.js
//Ref: https://nodejs.org/api/assert.html
let assert = require('assert')

//Suite 1
describe('Suite 1', function () {
	//No hay límite para el nivel de anidación de describe
	describe('Subsuite 1.1', function () {
		//Test 1
		it('debe conocer el sentido del universo', function() {
				//Comprobación 1
				assert.equal(42, getSentidoUniverso())
				//Comprobación 2
				assert.equal('El sentido del Universo', queEs(42))
		})
		//Test 2
		it('debe fallar', function() {
				assert(false, 'Fallo aposta')
		})
	})
	describe('Subsuite 1.2', function () {
	})
})

//Suite 2
describe('Suite 2', function () {
})

//Las funciones a probar pueden cargarse desde un módulo con require(path) siempre que se exporten
function getSentidoUniverso () {
	return 42
}

function queEs(num){
	if (num === 42) return 'El sentido del Universo'
	else return 'No tengo ni idea'
}
