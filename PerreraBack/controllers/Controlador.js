import { 
    Cliente, 
    Mascota, 
    Perrera, 
    TipoReporte, 
    Usuario, 
    Reporte, 
    Reserva, 
    Servicio, 
    Vacuna, 
    Vacunacion, 
    ReservaServicio, 
    Adopcion, 
    DisponibilidadServicios, 
    NotificacionReservas, 
    Pago 
} from "../models/Models.js";

// Controladores para Cliente
export const getAllClientes = async (req, res) => {
    try {
        const clientes = await Cliente.findAll();
        res.json(clientes);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getCliente = async (req, res) => {
    try {
        const cliente = await Cliente.findByPk(req.params.id);
        res.json(cliente);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createCliente = async (req, res) => {
    try {
        const cliente = await Cliente.create(req.body);
        res.json(cliente);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateCliente = async (req, res) => {
    try {
        const cliente = await Cliente.findByPk(req.params.id);
        await cliente.update(req.body);
        res.json(cliente);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteCliente = async (req, res) => {
    try {
        const cliente = await Cliente.findByPk(req.params.id);
        await cliente.destroy();
        res.json({ message: "Cliente eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Mascota
export const getAllMascotas = async (req, res) => {
    try {
        const mascotas = await Mascota.findAll();
        res.json(mascotas);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getMascota = async (req, res) => {
    try {
        const mascota = await Mascota.findByPk(req.params.id);
        res.json(mascota);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createMascota = async (req, res) => {
    try {
        const mascota = await Mascota.create(req.body);
        res.json(mascota);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateMascota = async (req, res) => {
    try {
        const mascota = await Mascota.findByPk(req.params.id);
        await mascota.update(req.body);
        res.json(mascota);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteMascota = async (req, res) => {
    try {
        const mascota = await Mascota.findByPk(req.params.id);
        await mascota.destroy();
        res.json({ message: "Mascota eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Perrera
export const getAllPerreras = async (req, res) => {
    try {
        const perreras = await Perrera.findAll();
        res.json(perreras);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getPerrera = async (req, res) => {
    try {
        const perrera = await Perrera.findByPk(req.params.id);
        res.json(perrera);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createPerrera = async (req, res) => {
    try {
        const perrera = await Perrera.create(req.body);
        res.json(perrera);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updatePerrera = async (req, res) => {
    try {
        const perrera = await Perrera.findByPk(req.params.id);
        await perrera.update(req.body);
        res.json(perrera);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deletePerrera = async (req, res) => {
    try {
        const perrera = await Perrera.findByPk(req.params.id);
        await perrera.destroy();
        res.json({ message: "Perrera eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};
// Controladores para Usuario
export const getAllUsuarios = async (req, res) => {
    try {
        const usuarios = await Usuario.findAll();
        res.json(usuarios);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getUsuario = async (req, res) => {
    try {
        const usuario = await Usuario.findByPk(req.params.id);
        res.json(usuario);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createUsuario = async (req, res) => {
    try {
        const usuario = await Usuario.create(req.body);
        res.json(usuario);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateUsuario = async (req, res) => {
    try {
        const usuario = await Usuario.findByPk(req.params.id);
        await usuario.update(req.body);
        res.json(usuario);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteUsuario = async (req, res) => {
    try {
        const usuario = await Usuario.findByPk(req.params.id);
        await usuario.destroy();
        res.json({ message: "Usuario eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Adopcion
export const getAllAdopciones = async (req, res) => {
    try {
        const adopciones = await Adopcion.findAll();
        res.json(adopciones);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getAdopcion = async (req, res) => {
    try {
        const adopcion = await Adopcion.findByPk(req.params.id);
        res.json(adopcion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createAdopcion = async (req, res) => {
    try {
        const adopcion = await Adopcion.create(req.body);
        res.json(adopcion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateAdopcion = async (req, res) => {
    try {
        const adopcion = await Adopcion.findByPk(req.params.id);
        await adopcion.update(req.body);
        res.json(adopcion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteAdopcion = async (req, res) => {
    try {
        const adopcion = await Adopcion.findByPk(req.params.id);
        await adopcion.destroy();
        res.json({ message: "Adopción eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para DisponibilidadServicios
export const getAllDisponibilidadServicios = async (req, res) => {
    try {
        const disponibilidadServicios = await DisponibilidadServicios.findAll();
        res.json(disponibilidadServicios);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getDisponibilidadServicio = async (req, res) => {
    try {
        const disponibilidadServicio = await DisponibilidadServicios.findByPk(req.params.id);
        res.json(disponibilidadServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createDisponibilidadServicio = async (req, res) => {
    try {
        const disponibilidadServicio = await DisponibilidadServicios.create(req.body);
        res.json(disponibilidadServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateDisponibilidadServicio = async (req, res) => {
    try {
        const disponibilidadServicio = await DisponibilidadServicios.findByPk(req.params.id);
        await disponibilidadServicio.update(req.body);
        res.json(disponibilidadServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteDisponibilidadServicio = async (req, res) => {
    try {
        const disponibilidadServicio = await DisponibilidadServicios.findByPk(req.params.id);
        await disponibilidadServicio.destroy();
        res.json({ message: "Disponibilidad de servicio eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para TipoReporte
export const getAllTipoReportes = async (req, res) => {
    try {
        const tipoReportes = await TipoReporte.findAll();
        res.json(tipoReportes);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getTipoReporte = async (req, res) => {
    try {
        const tipoReporte = await TipoReporte.findByPk(req.params.id);
        res.json(tipoReporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createTipoReporte = async (req, res) => {
    try {
        const tipoReporte = await TipoReporte.create(req.body);
        res.json(tipoReporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateTipoReporte = async (req, res) => {
    try {
        const tipoReporte = await TipoReporte.findByPk(req.params.id);
        await tipoReporte.update(req.body);
        res.json(tipoReporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteTipoReporte = async (req, res) => {
    try {
        const tipoReporte = await TipoReporte.findByPk(req.params.id);
        await tipoReporte.destroy();
        res.json({ message: "Tipo de reporte eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Reporte
export const getAllReportes = async (req, res) => {
    try {
        const reportes = await Reporte.findAll();
        res.json(reportes);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getReporte = async (req, res) => {
    try {
        const reporte = await Reporte.findByPk(req.params.id);
        res.json(reporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createReporte = async (req, res) => {
    try {
        const reporte = await Reporte.create(req.body);
        res.json(reporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateReporte = async (req, res) => {
    try {
        const reporte = await Reporte.findByPk(req.params.id);
        await reporte.update(req.body);
        res.json(reporte);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteReporte = async (req, res) => {
    try {
        const reporte = await Reporte.findByPk(req.params.id);
        await reporte.destroy();
        res.json({ message: "Reporte eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Reserva
export const getAllReservas = async (req, res) => {
    try {
        const reservas = await Reserva.findAll();
        res.json(reservas);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getReserva = async (req, res) => {
    try {
        const reserva = await Reserva.findByPk(req.params.id);
        res.json(reserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createReserva = async (req, res) => {
    try {
        const reserva = await Reserva.create(req.body);
        res.json(reserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateReserva = async (req, res) => {
    try {
        const reserva = await Reserva.findByPk(req.params.id);
        await reserva.update(req.body);
        res.json(reserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteReserva = async (req, res) => {
    try {
        const reserva = await Reserva.findByPk(req.params.id);
        await reserva.destroy();
        res.json({ message: "Reserva eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para NotificacionReservas
export const getAllNotificacionesReservas = async (req, res) => {
    try {
        const notificacionesReservas = await NotificacionReservas.findAll();
        res.json(notificacionesReservas);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getNotificacionReserva = async (req, res) => {
    try {
        const notificacionReserva = await NotificacionReservas.findByPk(req.params.id);
        res.json(notificacionReserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createNotificacionReserva = async (req, res) => {
    try {
        const notificacionReserva = await NotificacionReservas.create(req.body);
        res.json(notificacionReserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateNotificacionReserva = async (req, res) => {
    try {
        const notificacionReserva = await NotificacionReservas.findByPk(req.params.id);
        await notificacionReserva.update(req.body);
        res.json(notificacionReserva);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteNotificacionReserva = async (req, res) => {
    try {
        const notificacionReserva = await NotificacionReservas.findByPk(req.params.id);
        await notificacionReserva.destroy();
        res.json({ message: "Notificación de reserva eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Pago
export const getAllPagos = async (req, res) => {
    try {
        const pagos = await Pago.findAll();
        res.json(pagos);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getPago = async (req, res) => {
    try {
        const pago = await Pago.findByPk(req.params.id);
        res.json(pago);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createPago = async (req, res) => {
    try {
        const pago = await Pago.create(req.body);
        res.json(pago);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updatePago = async (req, res) => {
    try {
        const pago = await Pago.findByPk(req.params.id);
        await pago.update(req.body);
        res.json(pago);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deletePago = async (req, res) => {
    try {
        const pago = await Pago.findByPk(req.params.id);
        await pago.destroy();
        res.json({ message: "Pago eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Vacuna
export const getAllVacunas = async (req, res) => {
    try {
        const vacunas = await Vacuna.findAll();
        res.json(vacunas);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getVacuna = async (req, res) => {
    try {
        const vacuna = await Vacuna.findByPk(req.params.id);
        res.json(vacuna);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createVacuna = async (req, res) => {
    try {
        const vacuna = await Vacuna.create(req.body);
        res.json(vacuna);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateVacuna = async (req, res) => {
    try {
        const vacuna = await Vacuna.findByPk(req.params.id);
        await vacuna.update(req.body);
        res.json(vacuna);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteVacuna = async (req, res) => {
    try {
        const vacuna = await Vacuna.findByPk(req.params.id);
        await vacuna.destroy();
        res.json({ message: "Vacuna eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Vacunacion
export const getAllVacunaciones = async (req, res) => {
    try {
        const vacunaciones = await Vacunacion.findAll();
        res.json(vacunaciones);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getVacunacion = async (req, res) => {
    try {
        const vacunacion = await Vacunacion.findByPk(req.params.id);
        res.json(vacunacion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createVacunacion = async (req, res) => {
    try {
        const vacunacion = await Vacunacion.create(req.body);
        res.json(vacunacion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateVacunacion = async (req, res) => {
    try {
        const vacunacion = await Vacunacion.findByPk(req.params.id);
        await vacunacion.update(req.body);
        res.json(vacunacion);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteVacunacion = async (req, res) => {
    try {
        const vacunacion = await Vacunacion.findByPk(req.params.id);
        await vacunacion.destroy();
        res.json({ message: "Vacunación eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para Servicio
export const getAllServicios = async (req, res) => {
    try {
        const servicios = await Servicio.findAll();
        res.json(servicios);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getServicio = async (req, res) => {
    try {
        const servicio = await Servicio.findByPk(req.params.id);
        res.json(servicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createServicio = async (req, res) => {
    try {
        const servicio = await Servicio.create(req.body);
        res.json(servicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateServicio = async (req, res) => {
    try {
        const servicio = await Servicio.findByPk(req.params.id);
        await servicio.update(req.body);
        res.json(servicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteServicio = async (req, res) => {
    try {
        const servicio = await Servicio.findByPk(req.params.id);
        await servicio.destroy();
        res.json({ message: "Servicio eliminado correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};

// Controladores para ReservaServicio
export const getAllReservaServicios = async (req, res) => {
    try {
        const reservaServicios = await ReservaServicio.findAll();
        res.json(reservaServicios);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const getReservaServicio = async (req, res) => {
    try {
        const reservaServicio = await ReservaServicio.findByPk(req.params.id);
        res.json(reservaServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const createReservaServicio = async (req, res) => {
    try {
        const reservaServicio = await ReservaServicio.create(req.body);
        res.json(reservaServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const updateReservaServicio = async (req, res) => {
    try {
        const reservaServicio = await ReservaServicio.findByPk(req.params.id);
        await reservaServicio.update(req.body);
        res.json(reservaServicio);
    } catch (error) {
        res.json({ message: error.message });
    }
};

export const deleteReservaServicio = async (req, res) => {
    try {
        const reservaServicio = await ReservaServicio.findByPk(req.params.id);
        await reservaServicio.destroy();
        res.json({ message: "Reserva de servicio eliminada correctamente" });
    } catch (error) {
        res.json({ message: error.message });
    }
};
