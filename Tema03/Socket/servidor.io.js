const express=require('express');
const http=require('http');
const {Server}=require('socket.io');
const path=require('path');
const { Socket } = require('dgram');

const app=express();
const server=http.createServer(app);
const io=new Server(server);

//por cada conexion se guarda el cliente en el socket
io.on('connection',(socket)=>{
    socket.join("room1");// me subcribo a la sala

    //*por cada conexion de un cliente que realize el evento el 'message' 
    
    socket.on('menssage',(msg)=>{
        console.log("mensje del cliente: ",msg);

        // * emitimos le mensaje al resto de clientes de esa misma sala
        socket.to('room1').emit("respuesta",`mensaje recibido:${msg}`)
    });

    server.listen(3000,()=>{
        console.log("Servidor corriendo en http://localhost:3000");
    });
})