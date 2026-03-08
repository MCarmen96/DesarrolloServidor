
const mysql=require("mysql2/promise")
const dotenv=require("dotenv/config");
//import mysql from "mysql2/promise";
//import "dotenv/config";




    let pool = mysql.createPool({
            host: process.env.DB_HOST,
            user: process.env.DB_USER,
            password: '',
            database: "users",
            waitForConnections: true,
            connectionLimit: 10,
            queueLimit: 0
        })
        //console.log("CONEXION ALA BD REALIZADA")


/* try {
    const [rows] = await pool.execute('SELECT * FROM user WHERE id=?', [12]);
    const [all] = await pool.execute('SELECT * FROM user');
    console.log("todos->", all);
    console.log(rows);
} catch (error) {
    console.log("error en la consulta....")
} */

async function getAllUsers() {
    try{
        const [users]=await pool.execute('SELECT * FROM user');
        //console.log("Usuarios en el repo db",users);
        return users;
    }catch(error){
        console.log(error);
    }
}

async function saveUser(user){
    console.log("desde el repoposritory: ",user);
    const [result]= await pool.execute('INSERT INTO user(nombre) VALUES(?)',[user]);
}

async function getUser(id) {
    const [row]=await pool.execute('SELECT * FROM user WHERE id=?',[id]);
    return row;
}
async function updateUserSave(user,id) {
    const [row]=await pool.execute('UPDATE user SET nombre=?  WHERE id=?',[user,id]);
    return row;
}

async function deleteUser(id) {
    // IMPORTANTE: Siempre usa WHERE para no borrar toda la tabla
    const [result] = await pool.execute(
        'DELETE FROM user WHERE id = ?', 
        [id]
    );
    return result; 
}


module.exports = {
    getAllUsers,saveUser,getUser,updateUserSave,deleteUser
};