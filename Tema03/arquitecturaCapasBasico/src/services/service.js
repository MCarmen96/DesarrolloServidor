const fs = require('fs');
const path = require('path');

const dataPath = path.join(__dirname, '../data/datos.json');

function readUsers() {
    /* const data = fs.readFileSync(dataPath, 'utf8');
    return JSON.parse(data); */
    
    console.log("entro en read user")

    const fileStream = fs.readFileSync(dataPath, { encoding: 'utf-8' });//leeo
    return JSON.parse(fileStream);
    
}


function getUsers() {
    return readUsers();
}

function writeUser(){

    
}


module.exports = {
    getUsers
};
