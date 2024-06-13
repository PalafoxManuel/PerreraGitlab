import { DataTypes } from 'sequelize';
import db from '../database/db.js';

const Perrera = db.define('perrera', {
  Id_Perrera: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Ubicacion: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Tamano_Personal: {
    type: DataTypes.INTEGER,
    allowNull: true
  }
}, {
  tableName: 'perrera',
  timestamps: false
});

const Usuario = db.define('usuario', {
  Id_Usuario: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre_Usuario: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  Contrasena: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Id_Perrera: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  Id_Cliente: {
    type: DataTypes.INTEGER,
    allowNull: true
  }
}, {
  tableName: 'usuario',
  timestamps: false
});

const Cliente = db.define('cliente', {
  Id_Cliente: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre_Completo: {
    type: DataTypes.STRING(200),
    allowNull: false
  },
  Numero_Contacto: {
    type: DataTypes.STRING(20),
    allowNull: true
  },
  Correo_Electronico: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  Calle: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  Codigo_Postal: {
    type: DataTypes.STRING(20),
    allowNull: true
  }
}, {
  tableName: 'cliente',
  timestamps: false
});

const Mascota = db.define('mascota', {
  Id_Mascota: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Raza: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  Edad: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  Genero: {
    type: DataTypes.STRING(10),
    allowNull: true
  },
  Color: {
    type: DataTypes.STRING(50),
    allowNull: true
  },
  Peso: {
    type: DataTypes.FLOAT,
    allowNull: true
  },
  Historial_Medico: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  Id_Usuario: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  RescatadoCalle: {
    type: DataTypes.BOOLEAN,
    allowNull: false,
    defaultValue: false
  }
}, {
  tableName: 'mascota',
  timestamps: false
});

const Adopcion = db.define('adopcion', {
  Id_Adopcion: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Cliente: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Fecha_Adopcion: {
    type: DataTypes.DATE,
    allowNull: false
  },
  NotasAdicionales: {
    type: DataTypes.TEXT,
    allowNull: true
  }
}, {
  tableName: 'adopcion',
  timestamps: false
});

const Servicio = db.define('servicio', {
  Id_Servicio: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre_Servicio: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Descripcion: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  Tarifa: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: false
  }
}, {
  tableName: 'servicio',
  timestamps: false
});

const DisponibilidadServicios = db.define('disponibilidad_servicios', {
  Id_Disponibilidad: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Servicio: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Disponible: {
    type: DataTypes.BOOLEAN,
    allowNull: false
  }
}, {
  tableName: 'disponibilidad_servicios',
  timestamps: false
});

const TipoReporte = db.define('tipo_reporte', {
  Id_Tipo_Reporte: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre: {
    type: DataTypes.STRING(200),
    allowNull: false
  }
}, {
  tableName: 'tipo_reporte',
  timestamps: false
});

const Reporte = db.define('reporte', {
  Id_Reporte: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Tipo_Reporte: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  Id_Usuario: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  Contenido: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  Fecha_Reporte: {
    type: DataTypes.DATE,
    allowNull: false
  }
}, {
  tableName: 'reporte',
  timestamps: false
});

const Reserva = db.define('reserva', {
  Id_Reserva: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Fecha_Reserva: {
    type: DataTypes.DATE,
    allowNull: false
  },
  Duracion_Dias: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Tipo_Servicio: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  Estado: {
    type: DataTypes.ENUM('Pendiente', 'Confirmada', 'Cancelada'),
    allowNull: false
  },
  Id_Cliente: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Perrera: {
    type: DataTypes.INTEGER,
    allowNull: false
  }
}, {
  tableName: 'reserva',
  timestamps: false
});

const NotificacionReservas = db.define('notificacionReservas', {
  Id_Notificacion: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Tipo_Notificacion: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Contenido: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  Fecha: {
    type: DataTypes.DATE,
    allowNull: false
  },
  Id_Usuario: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Reserva: {
    type: DataTypes.INTEGER,
    allowNull: false
  }
}, {
  tableName: 'notificacionReservas',
  timestamps: false
});

const Pago = db.define('pago', {
  Id_Pago: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Monto: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: false
  },
  Metodo_Pago: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  Id_Reserva: {
    type: DataTypes.INTEGER,
    allowNull: false
  }
}, {
  tableName: 'pago',
  timestamps: false
});

const Vacuna = db.define('vacuna', {
  Id_Vacuna: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Descripcion: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  Id_TipoMascota: {
    type: DataTypes.INTEGER,
    allowNull: true
  },
  Fabricante: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Sintomas_Adversos: {
    type: DataTypes.TEXT,
    allowNull: true
  }
}, {
  tableName: 'vacuna',
  timestamps: false
});

const Vacunacion = db.define('vacunacion', {
  Id_Vacunacion: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Vacuna: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Fecha_Vacunacion: {
    type: DataTypes.DATE,
    allowNull: false
  },
  Numero_Lote: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  Dosis: {
    type: DataTypes.STRING(50),
    allowNull: false
  }
}, {
  tableName: 'vacunacion',
  timestamps: false
});

const ReservaServicio = db.define('reserva_servicio', {
  Id_Reserva_Servicio: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Reserva: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Servicio: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: true
  }
}, {
  tableName: 'reserva_servicio',
  timestamps: false
});

const TipoMascota = db.define('tipo_mascotas', {
  Id_TipoMascota: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Nombre_Tipo: {
    type: DataTypes.STRING(100),
    allowNull: false
  }
}, {
  tableName: 'tipo_mascotas',
  timestamps: false,
  charset: 'utf8mb4',
  collate: 'utf8mb4_general_ci'
});


export { Perrera, Usuario, Cliente, Mascota, Adopcion, Servicio, DisponibilidadServicios, TipoReporte, Reporte, Reserva, NotificacionReservas, Pago, Vacuna, Vacunacion, ReservaServicio, TipoMascota };