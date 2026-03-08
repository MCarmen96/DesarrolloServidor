const { error } = require('console');
const dgrma=require('dgram');
const server=dgrma.createSocket('udp4');

server.on('message',(msg,rinfo)=>{
    console.log(`Servidor recibido: ${msg} desde ${rinfo.address}: ${rinfo.port}`);

    const response=Buffer.from('Mensaje recibido OK!!');
    server.send(response,rinfo.port,rinfo.address,(error)=>{
        if(error){
            console.error("error en la respuesta......",error);
        }else{
            console.log("Respuesta enviada correctamente!!!");
        }
    })
})

server.on('listening',()=>{
    const address=server.address();
    console.log(`Servidor UPD iniciado en ${address.address}:${address.port}`);
})

server.on('error',(err)=>{
    console.error("Error en el servidro UDP: ",err);
    server.close();
})

server.bind(41234,()=>{
     console.log(`Servidor UPD escuchando en el puerto 41234`);
})