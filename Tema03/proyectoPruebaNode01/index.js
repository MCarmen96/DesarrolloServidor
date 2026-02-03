const axios = require('axios').default;
const colors = require('colors').default;
import { Person } from './person.js';

const person1= new Person('carmen','garcia',25);
console.log(person1.mostrar());

// me falta aqui lo de axios apra hacer la peticion ayax
//import { operaciones } from './operaciones.js';
//const multiply=operaciones.multiplicar(2,5);

//console.log("operacion 1="+multiply)

console.log("Hola".blue);
