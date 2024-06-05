import express from 'express';
import { 
    getAllUsuarios, getUsuario, createUsuario, updateUsuario, deleteUsuario,
    getAllReservas, getReserva, createReserva, updateReserva, deleteReserva,
    getAllPagos, getPago, createPago, updatePago, deletePago,
    getAllNotificaciones, getNotificacion, createNotificacion, updateNotificacion, deleteNotificacion,
    getAllAdopciones, getAdopcion, createAdopcion, updateAdopcion, deleteAdopcion,
    getAllDisponibilidadesMascotas, getDisponibilidadMascota, createDisponibilidadMascota, updateDisponibilidadMascota, deleteDisponibilidadMascota,
    getAllServicios, getServicio, createServicio, updateServicio, deleteServicio,
    getAllDisponibilidadesServicios, getDisponibilidadServicio, createDisponibilidadServicio, updateDisponibilidadServicio, deleteDisponibilidadServicio,
    getAllReportes, getReporte, createReporte, updateReporte, deleteReporte
} from "../models/Models.js";

const router = express.Router();

// Rutas para Usuario
router.get('/usuarios', getAllUsuarios);
router.get('/usuarios/:id', getUsuario);
router.post('/usuarios', createUsuario);
router.put('/usuarios/:id', updateUsuario);
router.delete('/usuarios/:id', deleteUsuario);

// Rutas para Reserva
router.get('/reservas', getAllReservas);
router.get('/reservas/:id', getReserva);
router.post('/reservas', createReserva);
router.put('/reservas/:id', updateReserva);
router.delete('/reservas/:id', deleteReserva);

// Rutas para Pago
router.get('/pagos', getAllPagos);
router.get('/pagos/:id', getPago);
router.post('/pagos', createPago);
router.put('/pagos/:id', updatePago);
router.delete('/pagos/:id', deletePago);

// Rutas para Notificacion
router.get('/notificaciones', getAllNotificaciones);
router.get('/notificaciones/:id', getNotificacion);
router.post('/notificaciones', createNotificacion);
router.put('/notificaciones/:id', updateNotificacion);
router.delete('/notificaciones/:id', deleteNotificacion);

// Rutas para Adopcion
router.get('/adopciones', getAllAdopciones);
router.get('/adopciones/:id', getAdopcion);
router.post('/adopciones', createAdopcion);
router.put('/adopciones/:id', updateAdopcion);
router.delete('/adopciones/:id', deleteAdopcion);

// Rutas para DisponibilidadMascotas
router.get('/disponibilidades-mascotas', getAllDisponibilidadesMascotas);
router.get('/disponibilidades-mascotas/:id', getDisponibilidadMascota);
router.post('/disponibilidades-mascotas', createDisponibilidadMascota);
router.put('/disponibilidades-mascotas/:id', updateDisponibilidadMascota);
router.delete('/disponibilidades-mascotas/:id', deleteDisponibilidadMascota);

// Rutas para Servicio
router.get('/servicios', getAllServicios);
router.get('/servicios/:id', getServicio);
router.post('/servicios', createServicio);
router.put('/servicios/:id', updateServicio);
router.delete('/servicios/:id', deleteServicio);

// Rutas para DisponibilidadServicios
router.get('/disponibilidades-servicios', getAllDisponibilidadesServicios);
router.get('/disponibilidades-servicios/:id', getDisponibilidadServicio);
router.post('/disponibilidades-servicios', createDisponibilidadServicio);
router.put('/disponibilidades-servicios/:id', updateDisponibilidadServicio);
router.delete('/disponibilidades-servicios/:id', deleteDisponibilidadServicio);

// Rutas para Reporte
router.get('/reportes', getAllReportes);
router.get('/reportes/:id', getReporte);
router.post('/reportes', createReporte);
router.put('/reportes/:id', updateReporte);
router.delete('/reportes/:id', deleteReporte);

export default router;