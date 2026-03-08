const WebSocket=require('ws');

const wss=new WebSocket.Server({port:8080});

wss.on('connection',(ws)=>{
    console.log('cliente conectado');
    ws.send('---Bienvenido al servidor WEBSOCKET---');

    ws.on('message',(ms)=>{
            console.log('Mensaje recibido por parte del cliente: ',ms.toString());
            ws.send(`Mensaje recibido con exito:${ms}`);
    });
});

console.log('Servidor WebSocket esuchando en ws://localhost:8080');