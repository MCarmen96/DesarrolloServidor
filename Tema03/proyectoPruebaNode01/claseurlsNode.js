// clase url

const myUrl=new URL('https://www.example.com:8080/path/to/resource?name=Carmen&age=29#section');

console.log(myUrl.href); // * https://www.example.com:8080/path/to/resource?name=Carmen&age29#section
console.log(myUrl.protocol); // * https
console.log(myUrl.username); // si no sale no tiene
console.log(myUrl.password);// si no sale no tiene
console.log(myUrl.hostname); // * www.example.com
console.log(myUrl.port);// * 8080
console.log(myUrl.pathname); // * /path/to/resource
console.log(myUrl.search); // * ?name=Carmen&age29#sectio
console.log(myUrl.hash); // * #section
console.log(myUrl.origin); // * devuelve el origen de la url (combinacion de protocolo hastname y port) https://www.example.com:8080

// TODO --MANIPULACION DE URLS--
// cambiamos el nombre de la ruta
myUrl.pathname='/new-path';
console.log("---Despues del cambio en el pathname: ",myUrl.href);

// cambiamos el valor de la consulta
myUrl.searchParams.set('age','20');
console.log("---Despues del cambio en el parametro: ",myUrl.href);
