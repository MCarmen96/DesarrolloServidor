
import http from 'http';

const serve=http.createServer((req,res)=>{
    console.log('Metodo',req.method);
    console.log('Url',req.url);
    console.log('Headers',req.headers);
    res.end('--HOLA CARMEN--')

});

serve.listen(3000);