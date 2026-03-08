
const net = require('net');
let count = 0;
//creo el servidor TCP
const server = net.createServer((socket) => {

    count++;
    if (count >3) {
        socket.write("Sorry no se aceptan mas clientes...");

    }else{
        console.log('Cliente conectado', count);

        socket.on('data', (data) => {

            let texto = data.toString();
            console.log('Datos recibidos:', texto);
            let datosMayus = texto.toUpperCase();
            socket.write(`Datos recibidos: ${datosMayus}`);
        })

        socket.on('end', () => {
            console.log("Cliente ", count, " desconectado!!")
            console.log("---------------------------------")
        })

        socket.on('error', (err) => {
            console.error('error ', err)
        })
    }


});

server.listen(8080, () => {
    console.log("-Servidor en el puerto 8080-")
})
