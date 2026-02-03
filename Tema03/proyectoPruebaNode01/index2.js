// 12. NODE CORE pagina 33
// * global.process
// esta importacion de modulos es con CommonJS
console.log('PID:',process.pid);
console.log(`Cantidad argumentos:${process.argv.length}`);
console.log('argumentos:',process.argv);

const Persona=require('./person');
const op=require('./operaciones');

const multiply=op.multiplicar(process.argv[2],process.argv[3]);

console.log("operacion= "+multiply)


const person1= new Persona(process.argv[4],process.argv[5],process.argv[6]);
console.log(person1.mostrar());