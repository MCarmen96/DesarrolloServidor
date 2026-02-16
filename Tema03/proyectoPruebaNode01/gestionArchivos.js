//const fs=requiere("fs");
import { error } from 'console';
import fs from 'fs';

import fsPromise from 'fs/promises';
import readline from 'fs/readline';


fs.access('original.txt', (error) => {

    if (error) {
        console.log("El archivo original no existe")
        return
    }
    fs.access('original_backup.txt',(error) => {
        // si no esta la copia es cuando tengo que hacer la copia
        if (error) {
            fs.copyFile('original.txt', 'original_backup.txt', (error) => {
                if (error) {
                    console.log("error al copiar")
                    return
                }
                console.log("archivo copiado");
            })
        }
        console.log("El archivo original_backup.txt ya existe");
    })

    console.log("el archivo original si existe");
});

// todo 1 creoel archivo 

/* fs.access("saludar.txt",(error)=>{
    if(error){
        console.log("no exite")
        return
    }
    console.log("el archvio slaudar se ha creado")
}) */

// * escribir ficheros
// te crea el archivo sin no exite




/* async function escribir() {

    fs.access('saludar.txt',async (error)=>{
        // si no existe
        if(error){

            await fsPromise.appendFile('saludar.txt','Hola desde Node.js');
            const datos=await fsPromise.readFile('saludar.txt','utf-8')
            console.log(datos);
        }
        // si ya exiite lo sobre escribo lo que tenga
        writeFile("saludar.txt","Hola desde Node.js, sobreescribiendo el contenido ")

        const datos=await fsPromise.readFile('saludar.txt','utf-8')
        console.log(datos);
    })
    
}

escribir(); */


(async ()=>{

    await fsPromise.writeFile("saludar.txt","Hola desde Node.js");
    const datos= await fsPromise.readFile('saludar.txt','utf-8');
    console.log(datos)

})();

// * leer por stream


// const stream= fs.createReadStream(fichero,{encoding:"utf-8"});
const stream=fs.createReadStream('archivo_grande.md',{encoding:'utf-8'});

stream.once('data',chunk=>{
    console.log("Empiezo a leer el archivo grande !!")
});

let texto="";
let cantidadChunk=0;
// d
stream.on('data',chunk=>{
    cantidadChunk++;
    console.log(cantidadChunk+ " cogiendo datos....")
    texto+=chunk;
})

stream.on('end',chunk=>{
    console.log(`Longitud de contenido del archivo: ${texto.length}`)
})




