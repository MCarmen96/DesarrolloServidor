import mysql from "mysql2/promise";
import "dotenv/config";
const pool=mysql.createPool({
    host:process.env.DB_HOST,
    user:process.env.DB_USER,
    password:'',
    database:"depart",
    waitForConnections:true,
    connectionLimit:10,
    queueLimit:0

})

try{
    const [rows]=await pool.execute('SELECT * FROM depart WHERE depart_no=?',[12]);
    const [all]=await pool.execute('SELECT * FROM depart');
    console.log("todos->",all);
    console.log(rows);
}catch(error){
    console.log("error en la consulta....")
}
