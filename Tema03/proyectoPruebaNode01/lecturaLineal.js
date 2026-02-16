import readline from 'readline';// te permite leer linea a linea
import fs from 'fs';

const archivo="archivo_grande.md";
if(archivo===undefined){
    throw "erro no hay archivo";    
}

let countLines=0;

const lectorLineas=readline.createInterface({
    input:fs.createReadStream(archivo),
    crlfDelay:Infinity
})

lectorLineas.on('line',(line)=>{
    countLines++;
    console.log(`Numero total de caracteres por linea. ${line.length}`);

})
lectorLineas.on('close',()=>{
            console.log(`Total de lineas leidas: ${countLines}`)
})

