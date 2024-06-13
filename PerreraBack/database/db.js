import { Sequelize } from "sequelize";

// Configuración directa de la base de datos (no recomendado para producción)
const db = new Sequelize(
    'perrera',  // Nombre de la base de datos
    'root',       // Usuario de la base de datos
    'VPrTZTNNTidNZaAflzqVQFfYCwKWOSPd', // Contraseña del usuario de la base de datos
    {
        host: 'viaduct.proxy.rlwy.net', // Host de la base de datos
        dialect: 'mysql',
        logging: false, // Puedes habilitar el logging si lo necesitas
    }
);

export default db;
