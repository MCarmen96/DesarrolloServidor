const http = require('http');
const fs = require('fs');
const path = require('path');

const pageRoutes = require('./routes/routes');

const server = http.createServer((req, res) => {

    // Archivos estáticos css y js
    if (req.url.startsWith('/public')) {
        const filePath = path.join(__dirname, req.url);
        fs.readFile(filePath, (err, data) => {
            if (err) {
                res.writeHead(404);
                return res.end('File not found');
            }

            res.writeHead(200);
            res.end(data);
        });
        return;
    }

    // Rutas dinámicas
    pageRoutes(req, res);
});

server.listen(3000, () => {
    console.log('Servidor en http://localhost:3000');
});
