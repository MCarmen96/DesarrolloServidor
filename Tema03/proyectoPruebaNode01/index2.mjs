// 12. NODE CORE pagina 33
// * global.process
// esta importacion de modulos es con CommonJS
console.log('PID:', process.pid);
console.log(`Cantidad argumentos:${process.argv.length}`);
console.log('argumentos:', process.argv);

// * forma moderna de hacer importacion Módulos ES Modules 

import { Person } from './person.mjs';

//const op=require('./operaciones');

//const multiply=op.multiplicar(process.argv[2],process.argv[3]);

//console.log("operacion= "+multiply)


const person1 = new Person(process.argv[4], process.argv[5], process.argv[6]);
console.log(person1.mostrar());

// calbacks 
console.log("inicio");
let despedirse = function (nombre) {
    console.log("adios " + nombre)
}

let fin = function (mensaje) {
    console.log(mensaje)
}

function saludar(nombre, callback1, callback2) {
    console.log("hola " + nombre);
    setTimeout(function () { callback1(nombre); callback2("fin del programa"); }, 250)

}

saludar('carmen', despedirse, fin);

function f2() {
        console.log(2);
}

function f1() {
     return new Promise((resolve)=>{
       
         resolve("TERMINA LA PROMESA");
          console.log(1);
     })
       

}

/* function promesa() {
    return new Promise((resolve, reject) => {
        resolve(f1());
    })
} */

console.log(" ---INICIO PROMESA--")

f1().then((mensaje) => {

    console.log("----Entro en la promesa---");
    console.log("----sigo en la promesa---");
    f2()
    console.log(mensaje)


}).catch((error)=>{
    console.log(error)
});