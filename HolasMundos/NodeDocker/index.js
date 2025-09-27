console.log("Hola mundo con Node y Docker");
const http=require("http");

const server=http.createServer((peticion,respuesta)=>{

    respuesta.end("--HOLA MUNDO CON NODE + DOCKER--");
    console.log("Servidor con node en funcionamiento con Docker");
    
})

server.listen(3000,"0.0.0.0",()=>{
    console.log("Servidor escuchando en el puerto 2020");
})