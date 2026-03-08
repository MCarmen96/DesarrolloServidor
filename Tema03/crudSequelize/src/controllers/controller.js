const path = require('path');
const ejs = require('ejs');
const userService = require('../services/service.js');
const qs=require('querystring');
const { title } = require('process');

async function home(req, res) {
    const filePath = path.join(__dirname, '../views/home.ejs');
    const users =await userService.getUsers();
    ejs.renderFile(filePath, { title: 'Inicio',users }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });
}

async function users(req, res) {
    const filePath = path.join(__dirname, '../views/users.ejs');
    const users =await userService.getUsers();
    console.log(users);
    ejs.renderFile(filePath, { users }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });
}


async function createUser(req,res) {
    const filePath = path.join(__dirname, '../views/home.ejs');
    
    const chunks=[];
    req.on('data',(chunk)=>{
        chunks.push(chunk);//cada chunk leído es un buffer
    });

    req.on("end",async()=>{
        const data = Buffer.concat(chunks); // Une varios buffers en uno solo
        const objeto=qs.parse(data.toString());

        await userService.createNewUser(objeto.name);
        res.writeHead(301, { 'Location': '/' });
        res.end();
    })
    
}

async function updateForm(req,res,id){
    const filePath = path.join(__dirname, '../views/updateUser.ejs');
    const user =await userService.getUser(id);
    console.log("TIPO:", typeof users);
    console.log("VALOR:", users);
    ejs.renderFile(filePath, {title:'update user',user }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });
}

async function updateUserSave(req,res,id) {
    const filePath = path.join(__dirname, '../views/home.ejs');
    let texto="";
    req.on('data',(chunk)=>{
        texto+=chunk;
        console.log("nombre update:",texto);
        
    });

    req.on("end",async()=>{
        const data=qs.parse(texto.toString());
        await userService.updateUserSave(data.name,id);
        res.writeHead(301, { 'Location': '/' });
        res.end();
    })
}

async function deleteUser(req, res, id) {
    try {
        await userService.deleteUser(id);
        // Redirigimos al home para actualizar la vista
        res.writeHead(302, { 'Location': '/' });
        res.end();
    } catch (error) {
        res.writeHead(500);
        res.end("Error al borrar el usuario");
    }
}

module.exports = { home, users,createUser,updateForm,updateUserSave,deleteUser};


(async()=>{
    await db.connect();
    await db.getUsers();
})