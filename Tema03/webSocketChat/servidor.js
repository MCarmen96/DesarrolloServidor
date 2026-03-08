const WebSocket = require('ws');

const wss = new WebSocket.Server({ port: 8080 });
// por cada cliente se guarda en wws al hacer on
const clientes = [];
let count=0;
// on es una conexion 
wss.on('connection', (ws) => {
    
    count++,
    console.log('cliente conectado',count);
    //ws.send('---Bienvenido al servidor WEBSOCKET---');

    ws.on('message', (ms) => {
        console.log(ms.toString());
        let nombreUser;
        let mensaje;
        let mensajeCliente=ms.toString()

        if (mensajeCliente.startsWith('Nombre:')) {
            
            let result = mensajeCliente.substring(7);
            //creo el cliente con su socket
            console.log("separado=", result)
            let objCliente = {
                nombre: result,
                socket: ws
            };
            //añado el cliente completo
            clientes.push(objCliente);
        } else {
        
            //encuentro el nombre
            for (let index = 0; index < clientes.length; index++) {
                // quien es el que ha enviado el mensaje
                if(clientes[index].socket===ws){
                    nombreUser=clientes[index].nombre;
                    break;//me salgo cuando lo encuentro
                }
                
            }
            console.log(`Usuario emisor: ${nombreUser}`);
            mensaje=nombreUser+":"+ms.toString();//monto el mensaje
            //envio el emnsaje a todos
            for (let index = 0; index < clientes.length; index++) {
            clientes[index].socket.send(mensaje);
            
           }
        }

        //console.log('Mensaje recibido por parte del cliente: ',ms.toString());
        //ws.send(`Mensaje recibido con exito:${ms}`);
    });
});



console.log('Servidor WebSocket esuchando en ws://localhost:8080');