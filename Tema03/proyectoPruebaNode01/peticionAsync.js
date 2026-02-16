import axios from "axios";
function f1(){
    return new Promise((resolve,reject)=>{
        setTimeout(function () 
        { console.log(1);
            resolve("exito")// cuando es el resolve indica que ha terminado la promesa entonces es exito
         }, 250)
    })
     
}

function f2(){
    console.log(2)
}



async function ejecutarPromesa() {
    console.log("Empiezo la promesa");

    try{
        const mensaje=await f1();
        console.log(mensaje)
        f2();
    }catch(error){
        console.log(error);
    }
}

ejecutarPromesa();
let datos;

const nombres=[];

async function datosApi(page) {
    
    const response= await axios.get(`https://rickandmortyapi.com/api/character/?page=${page}`)
        
            datos=response.data.results;
            datos.forEach(element => {
                nombres.push(element.name)
            });

            return nombres;



}


await datosApi(1);
await datosApi(2);
console.log("--NOMBRES API RICKY MORTY--");
let number=1;
nombres.forEach(nombres=>{
    console.log(number+"."+nombres)
    number++;
})
