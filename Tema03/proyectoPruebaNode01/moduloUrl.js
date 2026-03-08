import url from "url";

const direccion='https://www.example.com:8080/path/to/resource?name=Carmen&age=29#section';

const urlParseada=url.parse(direccion,true);// el segundo parametro true hace que la propiedad query sea un objeto en vez de un string
// te da toda la info de la url es decir sirve para descomponer la url en sus partes
console.log(urlParseada);

// * url.format hace lo contrario construye una url a partir de un objeto

const objetoUrl={
    protocolo:'https',
    host:'www.gatitos.com',
    pathname:'/buscar',
    query:{
        name:'lucky',
        page:5
    },
}

const direccion2=url.format(objetoUrl);
console.log(direccion2);

// * url.resolve()

const base='https://www.example.com/carpeta/';
const relativa='pagina.html';
const resultado=url.resolve(base,relativa);
console.log(resultado);

// CASO 1: La base termina en '/' (Es una carpeta)
const base1 = 'https://www.example.com/carpeta/';
const relativa1 = 'pagina.html';
const resultado1 = url.resolve(base1, relativa1);
console.log('Caso 1:', resultado1); 
// Resultado: https://www.example.com/carpeta/pagina.html

// CASO 2: La base NO termina en '/' (Se considera un archivo)
const base2 = 'https://www.example.com/carpeta/index.html';
const relativa2 = 'contacto.html';
const resultado2 = url.resolve(base2, relativa2);
console.log('Caso 2:', resultado2); 
// Resultado: https://www.example.com/carpeta/contacto.html
// (Fíjate cómo 'index.html' ha desaparecido para dejar paso a 'contacto.html')