const { DataTypes } = require("sequelize");
const sequelize = require("../config/dbUsers");

const User = sequelize.define("User", {
    id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        primaryKey: true,
        autoIncrement:true
    },
    nombre: {
        type: DataTypes.STRING,
        allowNull: true
    },
    password: {
        type: DataTypes.STRING,
        allowNull: true,

    },
    compra: {
        type: DataTypes.STRING,
        allowNull: true,
    }},
    {
        freezeTableName: true,
        timestamps: false
    }
);

module.exports={User};