import { Sequelize } from "sequelize";

// Configuración directa de la base de datos (no recomendado para producción)
const db = new Sequelize(
    'perrera',  // Nombre de la base de datos
    'root',     // Usuario de la base de datos
    '', // Contraseña del usuario de la base de datos
    {
        host:'127.0.0.1', // Host de la base de datos
        port: 3306,  // Nuevo puerto configurado en MySQL
        dialect: 'mysql',
        logging: false, // Puedes habilitar el logging si lo necesitas
    }
);

export default db;
