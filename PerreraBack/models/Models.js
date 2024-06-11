import { Sequelize, DataTypes } from 'sequelize';
import sequelize from '../database/db.js';

const Adopcion = sequelize.define('adopcion', {
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
  }
}, {
  tableName: 'adopcion',
  timestamps: false
});

const Cliente = sequelize.define('cliente', {
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
    type: DataTypes.STRING(20)
  },
  Correo_Electronico: {
    type: DataTypes.STRING(100)
  },
  Calle: {
    type: DataTypes.STRING(100)
  },
  Codigo_Postal: {
    type: DataTypes.STRING(20)
  }
}, {
  tableName: 'cliente',
  timestamps: false
});

const DisponibilidadMascotas = sequelize.define('disponibilidad_mascotas', {
  Id_Disponibilidad: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  Disponible: {
    type: DataTypes.BOOLEAN,
    allowNull: false
  }
}, {
  tableName: 'disponibilidad_mascotas',
  timestamps: false
});

const DisponibilidadServicios = sequelize.define('disponibilidad_servicios', {
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

const Mascota = sequelize.define('mascota', {
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
    type: DataTypes.STRING(100)
  },
  Edad: {
    type: DataTypes.INTEGER
  },
  Genero: {
    type: DataTypes.STRING(10)
  },
  Color: {
    type: DataTypes.STRING(50)
  },
  Peso: {
    type: DataTypes.FLOAT
  },
  Fecha_Ingreso: {
    type: DataTypes.DATE
  },
  Historial_Medico: {
    type: DataTypes.TEXT
  }
}, {
  tableName: 'mascota',
  timestamps: false
});

const Notificacion = sequelize.define('notificacion', {
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
    type: DataTypes.TEXT
  },
  Fecha: {
    type: DataTypes.DATE,
    allowNull: false
  },
  Id_Perrera: {
    type: DataTypes.INTEGER
  }
}, {
  tableName: 'notificacion',
  timestamps: false
});

const Pago = sequelize.define('pago', {
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

const Perrera = sequelize.define('perrera', {
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
  }
}, {
  tableName: 'perrera',
  timestamps: false
});

const Reporte = sequelize.define('reporte', {
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
    type: DataTypes.INTEGER
  },
  Id_Usuario: {
    type: DataTypes.INTEGER
  },
  Contenido: {
    type: DataTypes.TEXT
  }
}, {
  tableName: 'reporte',
  timestamps: false
});

const Reserva = sequelize.define('reserva', {
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
    type: DataTypes.STRING(100)
  },
  Estado: {
    type: DataTypes.STRING(20),
    allowNull: false,
    validate: {
      isIn: [['Pendiente', 'Confirmada', 'Cancelada']]
    }
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
  timestamps: false,
  validate: {
    fechaReservaNoPasada() {
      if (this.Fecha_Reserva < new Date()) {
        throw new Error('Fecha de reserva no puede ser en el pasado');
      }
    }
  }
});

const Servicio = sequelize.define('servicio', {
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
    type: DataTypes.TEXT
  },
  Tarifa: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: false
  }
}, {
  tableName: 'servicio',
  timestamps: false
});


const TipoReporte = sequelize.define('tipo_reporte', {
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

const Usuario = sequelize.define('usuario', {
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
    type: DataTypes.INTEGER
  }
}, {
  tableName: 'usuario',
  timestamps: false
});

const Vacuna = sequelize.define('vacuna', {
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
    type: DataTypes.TEXT
  },
  Tipo_Mascota: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  Fabricante: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  Sintomas_Adversos: {
    type: DataTypes.TEXT
  }
}, {
  tableName: 'vacuna',
  timestamps: false
});

const Vacunacion = sequelize.define('vacunacion', {
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

const ReservaServicio = sequelize.define('reserva_servicio', {
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
    type: DataTypes.INTEGER
  }
}, {
  tableName: 'reserva_servicio',
  timestamps: false
});

export {
  Adopcion,
  Cliente,
  DisponibilidadMascotas,
  DisponibilidadServicios,
  Mascota,
  Notificacion,
  Pago,
  Perrera,
  Reporte,
  Reserva,
  Servicio,
  TipoReporte,
  Usuario,
  Vacuna,
  Vacunacion,
  ReservaServicio
};