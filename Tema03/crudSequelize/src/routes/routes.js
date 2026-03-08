const pageController = require('../controllers/controller');

function pageRoutes(req, res) {

    const [ruta,id] = rutaDinamica(req)
    
    console.log(`Petición: ${req.method} | Ruta: ${ruta} | ID: ${id}`)

    if (req.method === 'GET' && req.url === '/') {
        return pageController.home(req, res);
    }

    if (req.method === 'GET' && req.url === '/users') {
        return pageController.users(req, res);
    }

    if(req.method==='POST'&& req.url==='/createUser'){
        return pageController.createUser(req,res);
    }
    if(req.method==='GET'&&ruta==='/updateUser'&& id){
        return pageController.updateForm(req,res,id)
    }

    if(req.method==='POST'&&ruta==='/updateUserSave'&& id){
        return pageController.updateUserSave(req,res,id)
    }

    if(req.method==='GET'&& ruta==='/delete'&&id){
        return pageController.deleteUser(req, res, id);
    }

    res.writeHead(404);
    res.end('Not found');
}

function rutaDinamica(req){
    const partes=req.url.split("/");// Divide la URL por cada "/"
    //const id=partes[partes.length-1];
    const id=partes.pop();
    let baseruta="";
    console.log(partes);
    console.log(id);
    console.log(isNaN(Number(id)));
    // if esl id es ="" es false
    // si el id esta vacio o no exite
    if(!id||isNaN(Number(id))){
        
        for (let i = 1; i < partes.length; i++) {
            baseruta = baseruta + "/" + partes[i];
        }
        return [baseruta+"/"+id, null]
    }
    for (let i = 1; i < partes.length; i++) {
        baseruta = baseruta + "/" + partes[i]
    }

    return [baseruta, Number(id)]
}
module.exports = pageRoutes;

