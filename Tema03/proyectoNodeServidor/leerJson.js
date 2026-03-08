import http from 'http';
//const json=require('./public/datos.json');

import json from './public/datos.json' with{type:"json"};

http.createServer((req,res)=>{
    res.writeHead(200,{'Content_Type':'application/json'});
    res.end(JSON.stringify(json));
}).listen(3000);