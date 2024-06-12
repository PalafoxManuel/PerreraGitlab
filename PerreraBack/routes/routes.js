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
router.get('/clientes', getAllClientes);
router.get('/clientes/:id', getCliente);
router.post('/clientes', createCliente);
router.put('/clientes/:id', updateCliente);
router.delete('/clientes/:id', deleteCliente);

// Rutas para Mascota
router.get('/mascotas', getAllMascotas);
router.get('/mascotas/:id', getMascota);
router.post('/mascotas', createMascota);
router.put('/mascotas/:id', updateMascota);
router.delete('/mascotas/:id', deleteMascota);

// Rutas para Perrera
router.get('/perreras', getAllPerreras);
router.get('/perreras/:id', getPerrera);
router.post('/perreras', createPerrera);
router.put('/perreras/:id', updatePerrera);
router.delete('/perreras/:id', deletePerrera);

// Rutas para Usuario
router.get('/usuarios', getAllUsuarios);
router.get('/usuarios/:id', getUsuario);
router.post('/usuarios', createUsuario);
router.put('/usuarios/:id', updateUsuario);
router.delete('/usuarios/:id', deleteUsuario);

// Rutas para Adopcion
router.get('/adopciones', getAllAdopciones);
router.get('/adopciones/:id', getAdopcion);
router.post('/adopciones', createAdopcion);
router.put('/adopciones/:id', updateAdopcion);
router.delete('/adopciones/:id', deleteAdopcion);

// Rutas para DisponibilidadServicios
router.get('/disponibilidad-servicios', getAllDisponibilidadServicios);
router.get('/disponibilidad-servicios/:id', getDisponibilidadServicio);
router.post('/disponibilidad-servicios', createDisponibilidadServicio);
router.put('/disponibilidad-servicios/:id', updateDisponibilidadServicio);
router.delete('/disponibilidad-servicios/:id', deleteDisponibilidadServicio);

// Rutas para TipoReporte
router.get('/tipos-reporte', getAllTipoReportes);
router.get('/tipos-reporte/:id', getTipoReporte);
router.post('/tipos-reporte', createTipoReporte);
router.put('/tipos-reporte/:id', updateTipoReporte);
router.delete('/tipos-reporte/:id', deleteTipoReporte);

// Rutas para Reporte
router.get('/reportes', getAllReportes);
router.get('/reportes/:id', getReporte);
router.post('/reportes', createReporte);
router.put('/reportes/:id', updateReporte);
router.delete('/reportes/:id', deleteReporte);

// Rutas para Reserva
router.get('/reservas', getAllReservas);
router.get('/reservas/:id', getReserva);
router.post('/reservas', createReserva);
router.put('/reservas/:id', updateReserva);
router.delete('/reservas/:id', deleteReserva);

// Rutas para NotificacionReservas
router.get('/notificaciones-reservas', getAllNotificacionesReservas);
router.get('/notificaciones-reservas/:id', getNotificacionReserva);
router.post('/notificaciones-reservas', createNotificacionReserva);
router.put('/notificaciones-reservas/:id', updateNotificacionReserva);
router.delete('/notificaciones-reservas/:id', deleteNotificacionReserva);

// Rutas para Pago
router.get('/pagos', getAllPagos);
router.get('/pagos/:id', getPago);
router.post('/pagos', createPago);
router.put('/pagos/:id', updatePago);
router.delete('/pagos/:id', deletePago);

// Rutas para Vacuna
router.get('/vacunas', getAllVacunas);
router.get('/vacunas/:id', getVacuna);
router.post('/vacunas', createVacuna);
router.put('/vacunas/:id', updateVacuna);
router.delete('/vacunas/:id', deleteVacuna);

// Rutas para Vacunacion
router.get('/vacunaciones', getAllVacunaciones);
router.get('/vacunaciones/:id', getVacunacion);
router.post('/vacunaciones', createVacunacion);
router.put('/vacunaciones/:id', updateVacunacion);
router.delete('/vacunaciones/:id', deleteVacunacion);

// Rutas para Servicio
router.get('/servicios', getAllServicios);
router.get('/servicios/:id', getServicio);
router.post('/servicios', createServicio);
router.put('/servicios/:id', updateServicio);
router.delete('/servicios/:id', deleteServicio);

// Rutas para ReservaServicio
router.get('/reservas-servicio', getAllReservaServicios);
router.get('/reservas-servicio/:id', getReservaServicio);
router.post('/reservas-servicio', createReservaServicio);
router.put('/reservas-servicio/:id', updateReservaServicio);
router.delete('/reservas-servicio/:id', deleteReservaServicio);

export default router;
