import http from 'http';
import fs from 'fs';
import fsPromise from 'fs/promises';
import path from 'path';
import qs from 'querystring';

const server= http.createServer(async(req,res)=>{

    if(req.method==='GET'&&req.url==='/pideForm'){
        const data=await fsPromise.readFile('./public/formulario.html','utf-8');
        res.writeHead(200,{'Content-Type':'text/html'});
        res.end(data);
    }else if(req.method==='POST'&&req.url==='/enviarForm'){
        //let texto="";
        let array=[];
        req.on('data',chunk=>{
            array.push(chunk);
        });

       /*  req.on('end',()=>{
            res.end(texto);
        }) */

        req.on('end',()=>{
            const datos=Buffer.concat(array);
            console.log(datos.toString);

            const salidaObjeto=qs.parse(datos.toString());
            let name=salidaObjeto.name;
            let email=salidaObjeto.email;
            

            res.writeHeader(200,{"Content-Type":"text/html"});
            res.write(`<h1>--DATOS DORMULARIO RECIBIDOS--</h1><p>Nombre:<b>${name}</b></p><p>Email:
                <b>${email}</b></p>`);
            res.end();
        })
    }

    //if(req.method==)
})

server.listen(3000);



let body = "";

    // 1. Recibimos los trozos (chunks) de datos del cliente
    req.on("data", (chunk) => {
        body += chunk.toString();
    });

    // 2. Cuando termina de llegar la información
    req.on("end", async () => {
        try {
            // Convertimos el cuerpo recibido a objeto JS
            const newItem = JSON.parse(body);

            // 3. Leemos lo que ya hay en el archivo
            const data = await fs.readFile("./public/datos.json", "utf-8");
            const list = JSON.parse(data); // Lo pasamos de texto a Array

            // 4. Añadimos el nuevo item al array
            list.push(newItem);

            // 5. Guardamos el array actualizado de nuevo en el archivo
            // JSON.stringify(list, null, 2) sirve para que el JSON quede "bonito" (identado)
            await fs.writeFile("./public/datos.json", JSON.stringify(list, null, 2));

            // 6. Respondemos al cliente con éxito
            res.writeHead(201, { "Content-Type": "application/json" });
            res.end(JSON.stringify({ message: "Dato guardado correctamente", item: newItem }));