import axios from "axios";
let datos;
let nombres = [];

function pagina1() {
    axios.get("https://rickandmortyapi.com/api/character/?page=1")
        .then(response => {
            console.log(response.data)
            datos = response.data.results;

            datos.forEach(element => {
                nombres.push(element.name);
            });



        }).catch(error => {
            console.log(error)
        })
}


function pagina2(){

    axios.get("https://rickandmortyapi.com/api/character/?page=2")
        
    .then(response => {
            console.log(response.data)
            datos = response.data.results;

            datos.forEach(element => {
                nombres.push(element.name);
            });

    


        }).catch(error => {
            console.log(error)
        })
}



function mostrar(funct1,funct2){
    
    

}


