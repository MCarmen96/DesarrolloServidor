const fs = require('fs');
const path = require('path');
const db=require('../repositories/db.js');

/* const dataPath = path.join(__dirname, '../data/users.json');

function readUsers() {
    const data = fs.readFileSync(dataPath, 'utf8');
    return JSON.parse(data);
}


function getUsers() {
    return readUsers();
}


module.exports = {
    getUsers
}; */

async function getUsers() {
    const user= await db.getAllUsers();
    
    return user;
    
}

async function createNewUser(user){

    await db.saveUser(user);
}


async function getUser(id) {

    return await db.getUser(id);
    
}
async function updateUserSave(user,id) {
    return await db.updateUserSave(user,id);
}
async function deleteUser(id) {
    return await db.deleteUser(id);
}
module.exports={
    getUsers,createNewUser,getUser,updateUserSave,deleteUser
}


