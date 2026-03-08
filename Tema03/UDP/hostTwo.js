const dgram=require('dgram');
const client=dgram.createSocket('udp4');
const readline=require('readline');


const message=Buffer.from("hello server UDP");
client.send(message,41234,'127.0.0.1',(error)=>{
    if(error){
         console.error("error al enviar el mensaje......",error);
         client.close();
    }else{
        console.log("mensaje enviado al servidor correctamente!!!");
    }
})

client.on('message',(msg)=>{
    console.log(`Cliente recibio: ${msg}`);
    client.close();
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