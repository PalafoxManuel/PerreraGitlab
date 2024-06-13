import express from 'express';
import {
    getAllClientes, getCliente, createCliente, updateCliente, deleteCliente,
    getAllMascotas, getMascota, createMascota, updateMascota, deleteMascota,
    getAllPerreras, getPerrera, createPerrera, updatePerrera, deletePerrera,
    getAllUsuarios, getUsuario, createUsuario, updateUsuario, deleteUsuario,
    getAllAdopciones, getAdopcion, createAdopcion, updateAdopcion, deleteAdopcion,
    getAllDisponibilidadServicios, getDisponibilidadServicio, createDisponibilidadServicio, updateDisponibilidadServicio, deleteDisponibilidadServicio,
    getAllTipoReportes, getTipoReporte, createTipoReporte, updateTipoReporte, deleteTipoReporte,
    getAllReportes, getReporte, createReporte, updateReporte, deleteReporte,
    getAllReservas, getReserva, createReserva, updateReserva, deleteReserva,
    getAllNotificacionesReservas, getNotificacionReserva, createNotificacionReserva, updateNotificacionReserva, deleteNotificacionReserva,
    getAllPagos, getPago, createPago, updatePago, deletePago,
    getAllVacunas, getVacuna, createVacuna, updateVacuna, deleteVacuna,
    getAllVacunaciones, getVacunacion, createVacunacion, updateVacunacion, deleteVacunacion,
    getAllServicios, getServicio, createServicio, updateServicio, deleteServicio,
    getAllReservaServicios, getReservaServicio, createReservaServicio, updateReservaServicio, deleteReservaServicio
} from '../controllers/Controlador.js';

const router = express.Router();

// Rutas para Cliente
router.get('/cliente', getAllClientes);
router.get('/cliente/:id', getCliente);
router.post('/cliente', createCliente);
router.put('/cliente/:id', updateCliente);
router.delete('/cliente/:id', deleteCliente);

// Rutas para Mascota
router.get('/mascota', getAllMascotas);
router.get('/mascota/:id', getMascota);
router.post('/mascota', createMascota);
router.put('/mascota/:id', updateMascota);
router.delete('/mascota/:id', deleteMascota);

// Rutas para Perrera
router.get('/perrera', getAllPerreras);
router.get('/perrera/:id', getPerrera);
router.post('/perrera', createPerrera);
router.put('/perrera/:id', updatePerrera);
router.delete('/perrera/:id', deletePerrera);

// Rutas para Usuario
router.get('/usuario', getAllUsuarios);
router.get('/usuario/:id', getUsuario);
router.post('/usuario', createUsuario);
router.put('/usuario/:id', updateUsuario);
router.delete('/usuario/:id', deleteUsuario);

// Rutas para Adopcion
router.get('/adopcion', getAllAdopciones);
router.get('/adopcion/:id', getAdopcion);
router.post('/adopcion', createAdopcion);
router.put('/adopcion/:id', updateAdopcion);
router.delete('/adopcion/:id', deleteAdopcion);

// Rutas para DisponibilidadServicios
router.get('/disponibilidad-servicio', getAllDisponibilidadServicios);
router.get('/disponibilidad-servicio/:id', getDisponibilidadServicio);
router.post('/disponibilidad-servicio', createDisponibilidadServicio);
router.put('/disponibilidad-servicio/:id', updateDisponibilidadServicio);
router.delete('/disponibilidad-servicio/:id', deleteDisponibilidadServicio);

// Rutas para TipoReporte
router.get('/tipo-reporte', getAllTipoReportes);
router.get('/tipo-reporte/:id', getTipoReporte);
router.post('/tipo-reporte', createTipoReporte);
router.put('/tipo-reporte/:id', updateTipoReporte);
router.delete('/tipo-reporte/:id', deleteTipoReporte);

// Rutas para Reporte
router.get('/reporte', getAllReportes);
router.get('/reporte/:id', getReporte);
router.post('/reporte', createReporte);
router.put('/reporte/:id', updateReporte);
router.delete('/reporte/:id', deleteReporte);

// Rutas para Reserva
router.get('/reserva', getAllReservas);
router.get('/reserva/:id', getReserva);
router.post('/reserva', createReserva);
router.put('/reservas:id', updateReserva);
router.delete('/reserva/:id', deleteReserva);

// Rutas para NotificacionReservas
router.get('/notificacion-reserva', getAllNotificacionesReservas);
router.get('/notificacion-reserva/:id', getNotificacionReserva);
router.post('/notificacion-reserva', createNotificacionReserva);
router.put('/notificacion-reserva/:id', updateNotificacionReserva);
router.delete('/notificacion-reserva/:id', deleteNotificacionReserva);

// Rutas para Pago
router.get('/pago', getAllPagos);
router.get('/pago/:id', getPago);
router.post('/pago', createPago);
router.put('/pago/:id', updatePago);
router.delete('/pago/:id', deletePago);

// Rutas para Vacuna
router.get('/vacuna', getAllVacunas);
router.get('/vacuna/:id', getVacuna);
router.post('/vacuna', createVacuna);
router.put('/vacuna/:id', updateVacuna);
router.delete('/vacuna/:id', deleteVacuna);

// Rutas para Vacunacion
router.get('/vacunacion', getAllVacunaciones);
router.get('/vacunacion/:id', getVacunacion);
router.post('/vacunacion', createVacunacion);
router.put('/vacunacion/:id', updateVacunacion);
router.delete('/vacunacion/:id', deleteVacunacion);

// Rutas para Servicio
router.get('/servicio', getAllServicios);
router.get('/servicio/:id', getServicio);
router.post('/servicio', createServicio);
router.put('/servicio/:id', updateServicio);
router.delete('/servicio/:id', deleteServicio);

// Rutas para ReservaServicio
router.get('/reserva-servicio', getAllReservaServicios);
router.get('/reserva-servicio/:id', getReservaServicio);
router.post('/reserva-servicio', createReservaServicio);
router.put('/reserva-servicio/:id', updateReservaServicio);
router.delete('/reserva-servicio/:id', deleteReservaServicio);

export default router;
