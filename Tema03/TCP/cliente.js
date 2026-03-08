const net=require('net');
const readline=require('readline');


// creamos un cliente

const client=net.createConnection({port:8080},()=>{
    console.log('----Conectado servidor----');
})

const rl=readline.createInterface({
    input:process.stdin,
    output:process.stdout
});

rl.on('line',(input)=>{
    client.write(input);
});

client.on('data',(data)=>{
    let respuesta=data.toString();
    console.log("Respuesta del servidor: ",respuesta);
})

client.on('end',()=>{
    console.log("Desconectado del servidor")
})

