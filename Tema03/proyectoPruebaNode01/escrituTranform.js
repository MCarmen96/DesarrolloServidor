import readline from 'readline';// te permite leer linea a linea
import fs from 'fs';
import { Transform } from 'stream';
import { pipeline } from 'stream/promises';

const mayus=new Transform({
    transform(chunk,encode,cb){
        this.push(chunk.toString('utf8').toUpperCase());
        cb;
    }
});


/* fs.createReadStream("escrituraTransform.txt",{encoding:'utf-8'})
    .pipe(mayus)
    .pipe(fs.createWriteStream("salidaTransform.txt",{encodin:'utf8'}))
    .on('finish',()=>{
        console.log('transform terminado');
    })
    .on('error',(err)=>{
         console.error('error en la tuberia',err);
    }) */


    
const changesA=new Transform({
    transform(chunk,encode,cb){
        
        
        this.push(chunk.toString('utf8').replaceAll("a","X"));
        cb();
    }
});


try{
    await pipeline(
        fs.createReadStream('pipeline.txt',{encoding:'utf-8'}),
        changesA,
        fs.createWriteStream("salidaTrans2.txt",{encoding:'utf-8'}))

    console.log("tranform terminado con pipeline")
    
}catch(error){
    console.error('error en la tuberia',error);
}

