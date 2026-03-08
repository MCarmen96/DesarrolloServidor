const { Sequelize } = require("sequelize");
const dotenv = require("dotenv/config");

const sequelize = new Sequelize(process.env.DB_DATABASE, process.env.DB_USER, '',
    {
        host: process.env.DB_HOST,
        dialect: 'mysql'
    }
);



async function connect(params) {
    try {

        await sequelize.authenticate();
        console.log("Coneccion exitosa con la bbdd");
    } catch (error) {
        console.error("Error al conectar a la base de datos: ", error)
    }
}
connect();
module.exports = sequelize;