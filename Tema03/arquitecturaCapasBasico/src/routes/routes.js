const pageController = require('../controllers/controller');

function pageRoutes(req, res) {

    if (req.method === 'GET' && req.url === '/') {
        return pageController.home(req, res);
    }

    if (req.method === 'GET' && req.url === '/item') {
        return pageController.users(req, res);
    }

    if(req.method==='POST'&&req.url==='/enviarUser'){
        return pageController.saveUser(req,res);
    }
    res.writeHead(404);
    res.end('Not found');
}

module.exports = pageRoutes;

