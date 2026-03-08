const http = require("http");
const fs = require("fs");
const ejs = require('ejs');
const path = require("path");
const { error } = require("console");

const server = http.createServer((req, res) => {

    /*   res.setHeader('Access-Control-Allow-Origin','*');
      res.setHeader('Access-Control-Allow-Methods','GET');
      res.setHeader('Access-Control-Allow-Headers','Content-Type'); */

    /* res.writeHead(200, {
        'Content-Type': 'text/event-stream',
        'Cache-Control': 'no-cache',
        Connection: 'keep-alive'
    }); */

    console.log(req.url);

    if (req.method === 'GET' && req.url === '/') {
        // primer if para renderizar la vista 
        const filePath = path.join(__dirname, 'cliente.ejs');

        ejs.renderFile(filePath, (error, html) => {
            res.writeHead(200, { 'Content-Type': 'text/html' });
            res.end(html);
        })

    } else if (req.method === "GET" && req.url === '/events') {
        // para enviar los datos indicandole que es un event-stream
        res.writeHead(200, {
            'Content-Type': 'text/event-stream',
            'Cache-Control': 'no-cache',
            Connection: 'keep-alive'
        });

        const sendEvent = () => {
            const random=Math.floor(Math.random()*101)+1;
            console.log(random)
            const numberData=`data:${random}\n\n`;
            console.log(numberData)
            const eventData = `data:${new Date().toLocaleTimeString()}-${random}\n\n`;
            console.log(eventData);
            res.write(eventData);
        }

        const intervalId = setInterval(sendEvent, 3000);
        req.on("close", () => {
            clearInterval(intervalId);
        });

    }

})

server.listen(3000, () => {
    console.log("Servidor SSE escuchando en http://127.0.0.1:3000");
})