import readline from 'readline';// te permite leer linea a linea
import fs from 'fs';
import { Readable } from 'node:stream';

/* (async()=>{
    
    const fileStream=fs.createReadStream("archivo_grande.md");
    const rl=readline.createInterface({
        input: fileStream,
        crlfdDelay:Infinity    
    });

    for await(const line of rl){
        console.log(line)
    }
})();
 */

   
async function* leerlineas() {

    const fileStream=fs.createReadStream("archivo_grande.md");
    const rl=readline.createInterface({
        input: fileStream,
        crlfdDelay:Infinity    
    });
    for await (const linea of rl){
        yield linea;
    }
}


async function procesarArchivo(limite) {

    const iterador=leerlineas();
    let count=0;
    const stream=Readable.from(iterador).take(limite);
    stream.on('end',()=>{
        console.log("se supone que se ha cerrado ¬.¬");
    })

    //removeListener para el on esto seria para el readline
    // luego el close y destroy el stream para liberar la memoria siempre hay que liberar memoria

    for await(const linea of stream){
        count++;
        /*   count++;
        
        if(count==limite){
            iterador.return();
        }else{ */

        console.log(`${count}-Procesando linea: ${linea}`)
    }

    console.log("lectura completa!!");
}
const limite=5;

procesarArchivo(limite);
