import { Sequelize, DataTypes } from 'sequelize';
import sequelize from '../database/database.js';

// Definición de la tabla Tipo_Reporte
const TipoReporte = sequelize.define('Tipo_Reporte', {
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
  tableName: 'Tipo_Reporte',
  timestamps: false
});

// Definición de la tabla Perrera
const Perrera = sequelize.define('Perrera', {
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
  tableName: 'Perrera',
  timestamps: false
});

// Definición de la tabla Mascota
const Mascota = sequelize.define('Mascota', {
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
  tableName: 'Mascota',
  timestamps: false
});

// Definición de la tabla Cliente
const Cliente = sequelize.define('Cliente', {
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
  Ciudad: {
    type: DataTypes.STRING(100)
  },
  Estado: {
    type: DataTypes.STRING(100)
  },
  Pais: {
    type: DataTypes.STRING(100)
  },
  Codigo_Postal: {
    type: DataTypes.STRING(20)
  }
}, {
  tableName: 'Cliente',
  timestamps: false
});

// Definición de la tabla Usuario
const Usuario = sequelize.define('Usuario', {
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
  Rol: {
    type: DataTypes.STRING(20),
    allowNull: false
  },
  Id_Perrera: {
    type: DataTypes.INTEGER,
    references: {
      model: Perrera,
      key: 'Id_Perrera'
    }
  }
}, {
  tableName: 'Usuario',
  timestamps: false
});

// Definición de la tabla Reserva
const Reserva = sequelize.define('Reserva', {
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
    allowNull: false,
    references: {
      model: Cliente,
      key: 'Id_Cliente'
    }
  },
  Id_Perrera: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: Perrera,
      key: 'Id_Perrera'
    }
  }
}, {
  tableName: 'Reserva',
  timestamps: false,
  validate: {
    fechaReservaNoPasada() {
      if (this.Fecha_Reserva < new Date()) {
        throw new Error('Fecha de reserva no puede ser en el pasado');
      }
    }
  }
});

// Definición de la tabla Pago
const Pago = sequelize.define('Pago', {
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
    allowNull: false,
    references: {
      model: Reserva,
      key: 'Id_Reserva'
    }
  }
}, {
  tableName: 'Pago',
  timestamps: false
});

// Definición de la tabla Notificacion
const Notificacion = sequelize.define('Notificacion', {
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
    type: DataTypes.INTEGER,
    references: {
      model: Perrera,
      key: 'Id_Perrera'
    }
  }
}, {
  tableName: 'Notificacion',
  timestamps: false
});

// Definición de la tabla Adopcion
const Adopcion = sequelize.define('Adopcion', {
  Id_Adopcion: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: Mascota,
      key: 'Id_Mascota'
    },
    unique: true
  },
  Id_Cliente: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: Cliente,
      key: 'Id_Cliente'
    }
  },
  Fecha_Adopcion: {
    type: DataTypes.DATE,
    allowNull: false
  }
}, {
  tableName: 'Adopcion',
  timestamps: false
});

// Definición de la tabla Disponibilidad_Mascotas
const DisponibilidadMascotas = sequelize.define('Disponibilidad_Mascotas', {
  Id_Disponibilidad: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  Id_Mascota: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: Mascota,
      key: 'Id_Mascota'
    }
  },
  Disponible: {
    type: DataTypes.BOOLEAN,
    allowNull: false
  }
}, {
  tableName: 'Disponibilidad_Mascotas',
  timestamps: false
});

// Definición de la tabla Servicio
const Servicio = sequelize.define('Servicio', {
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
  tableName: 'Servicio',
  timestamps: false
});
// Definición de la tabla Disponibilidad_Servicios
const DisponibilidadServicios = sequelize.define('Disponibilidad_Servicios', {
    Id_Disponibilidad: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      primaryKey: true
    },
    Id_Servicio: {
      type: DataTypes.INTEGER,
      allowNull: false,
      references: {
        model: Servicio,
        key: 'Id_Servicio'
      }
    },
    Disponible: {
      type: DataTypes.BOOLEAN,
      allowNull: false
    }
  }, {
    tableName: 'Disponibilidad_Servicios',
    timestamps
},{
    tableName: 'Disponibilidad_Servicios',
    timestamps: false
});

// Exportar todos los modelos
export {
    TipoReporte,
    Perrera,
    Mascota,
    Cliente,
    Usuario,
    Reserva,
    Pago,
    Notificacion,
    Adopcion,
    DisponibilidadMascotas,
    Servicio,
    DisponibilidadServicios,
    Reporte
};