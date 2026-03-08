import http from 'http';
import fs, { appendFile } from 'fs';
import fsPromise from 'fs/promises';
import readline from 'readline';




const serve=http.createServer((req,res)=>{
    
    const {method,url}=req;
    //console.log(url);
    console.log(req.method);
    if(method==="GET"&&url==="/api/datos"){
        console.log("entro")
        const fileStream=  fs.readFileSync("./public/datos.json",{encoding:'utf-8'});//leeo
        //const objeto=JSON.parse(fileStream);
        //console.log(objeto);
        res.writeHead(200,{'Content-Type':'text/html'});
        res.end(fileStream);

    }else if(method==="POST"&&url==="/api/enviarDatos"){

        let texto="";
        req.on('data',(chunk)=>{
            texto+=chunk.toString();
        })

        req.on("end",()=>{
            const textoObjeto=JSON.parse(texto);
            //convierto el texto a un objeto
            const leoDatos= fs.readFileSync("./public/datos.json",{encoding:'utf-8'});
            const array=JSON.parse(leoDatos);

            array.push(textoObjeto);
            
            fs.writeFileSync("./public/datos.json",JSON.stringify(array),{encoding:'utf-8'});
            // escribo en ele archivoºrray));


            res.writeHead(201, { "Content-Type": "application/json" });
            res.end(JSON.stringify({"mensaje":"usuario creado, escrito en le fichero"}));
        })
    }
})

serve.listen(3000,()=>{
    console.log("servidor en el puerot 3000")
});