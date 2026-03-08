const path = require('path');
const ejs = require('ejs');
const userService = require('../services/service');
const { error } = require('console');

function home(req, res) {

    const filePath = path.join(__dirname, '../views/home.ejs');
      ejs.renderFile(filePath, { title: 'Inicio' }, (err, html) => {
         res.writeHead(200, { 'Content-Type': 'text/html' });
         res.end(html);
     }); 

    
    
}

function users(req, res) {
    const filePath = path.join(__dirname, '../views/users.ejs');
    const users = userService.getUsers();

    ejs.renderFile(filePath, { users }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });

}

function saveUser(req,res){
    const filePath = path.join(__dirname, '../views/users.ejs');
}

module.exports = { home, users };
