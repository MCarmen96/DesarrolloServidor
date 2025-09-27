console.log("Hola mundo con Node");
const http=require("http");

const server=http.createServer((peticion,respuesta)=>{

    respuesta.end("--HOLA MUNDO CON NODE--");
    console.log("Servidor con node en funcionamiento");
    
})

server.listen(2020,"0.0.0.0",()=>{
    console.log("Servidor escuchando en el puerto 2020");
})