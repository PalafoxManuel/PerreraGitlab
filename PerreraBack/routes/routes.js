import express from 'express';
import { 
    getAllMascotas, getMascota, createMascota, updateMascota, deleteMascota,
    getAllClientes, getCliente, createCliente, updateCliente, deleteCliente,
    getAllAdopciones, getAdopcion, updateAdopcion, deleteAdopcion, createAdopcion,
    getAllDisponibilidadesMascotas, getDisponibilidadMascota, createDisponibilidadMascota, updateDisponibilidadMascota, deleteDisponibilidadMascota,
    getAllServicios, getServicio, createServicio, updateServicio, deleteServicio,
    getAllDisponibilidadesServicios, getDisponibilidadServicio, createDisponibilidadServicio, updateDisponibilidadServicio, deleteDisponibilidadServicio,
    getAllPerreras, getPerrera, createPerrera, updatePerrera, deletePerrera,
    getAllNotificaciones, getNotificacion, createNotificacion, updateNotificacion, deleteNotificacion,
    getAllReservas, getReserva, createReserva, updateReserva, deleteReserva,
    getAllPagos, getPago, createPago, updatePago, deletePago,
    getAllTipoReporte, getTipoReporte, createTipoReporte, updateTipoReporte, deleteTipoReporte,
    getAllUsuarios, getUsuario, createUsuario, updateUsuario, deleteUsuario,
    getAllReportes, getReporte, createReporte, updateReporte, deleteReporte,
    getAllVacunas, getVacuna, createVacuna, updateVacuna, deleteVacuna,
    getAllVacunaciones, getVacunacion, createVacunacion, updateVacunacion, deleteVacunacion,
    getAllReservaServicios, getReservaServicio, createReservaServicio, updateReservaServicio, deleteReservaServicio
} from "../controllers/Controlador.js";

const router = express.Router();

// Rutas para Mascota
router.get('/mascotas', getAllMascotas);
router.get('/mascotas/:id', getMascota);
router.post('/mascotas', createMascota);
router.put('/mascotas/:id', updateMascota);
router.delete('/mascotas/:id', deleteMascota);

// Rutas para Cliente
router.get('/cliente', getAllClientes);
router.get('/cliente/:id', getCliente);
router.post('/cliente', createCliente);
router.put('/clientes/:id', updateCliente);
router.delete('/cliente/:id', deleteCliente);

// Rutas para Adopcion
router.get('/adopcione', getAllAdopciones);
router.get('/adopcione/:id', getAdopcion);
router.post('/adopcione', createAdopcion);
router.put('/adopcione/:id', updateAdopcion);
router.delete('/adopcione/:id', deleteAdopcion);

// Rutas para DisponibilidadMascotas
router.get('/disponibilidades-mascotas', getAllDisponibilidadesMascotas);
router.get('/disponibilidades-mascotas/:id', getDisponibilidadMascota);
router.post('/disponibilidades-mascotas', createDisponibilidadMascota);
router.put('/disponibilidades-mascotas/:id', updateDisponibilidadMascota);
router.delete('/disponibilidades-mascotas/:id', deleteDisponibilidadMascota);

// Rutas para Servicio
router.get('/servicio', getAllServicios);
router.get('/servicio/:id', getServicio);
router.post('/servicio', createServicio);
router.put('/servicio/:id', updateServicio);
router.delete('/servicio/:id', deleteServicio);

// Rutas para DisponibilidadServicios
router.get('/disponibilidades-servicios', getAllDisponibilidadesServicios);
router.get('/disponibilidades-servicios/:id', getDisponibilidadServicio);
router.post('/disponibilidades-servicios', createDisponibilidadServicio);
router.put('/disponibilidades-servicios/:id', updateDisponibilidadServicio);
router.delete('/disponibilidades-servicios/:id', deleteDisponibilidadServicio);

// Rutas para Perrera
router.get('/perrera', getAllPerreras);
router.get('/perrera/:id', getPerrera);
router.post('/perrera', createPerrera);
router.put('/perrera/:id', updatePerrera);
router.delete('/perrera/:id', deletePerrera);

// Rutas para Notificacion
router.get('/notificacion', getAllNotificaciones);
router.get('/notificacion/:id', getNotificacion);
router.post('/notificacion', createNotificacion);
router.put('/notificacion/:id', updateNotificacion);
router.delete('/notificacion/:id', deleteNotificacion);

// Rutas para Reserva
router.get('/reserva', getAllReservas);
router.get('/reserva/:id', getReserva);
router.post('/reserva', createReserva);
router.put('/reserva/:id', updateReserva);
router.delete('/reserva/:id', deleteReserva);

// Rutas para Pago
router.get('/pago', getAllPagos);
router.get('/pago/:id', getPago);
router.post('/pago', createPago);
router.put('/pago/:id', updatePago);
router.delete('/pago/:id', deletePago);

// Rutas para TipoReporte
router.get('/tipo-reporte', getAllTipoReporte);
router.get('/tipo-reporte/:id', getTipoReporte);
router.post('/tipo-reporte', createTipoReporte);
router.put('/tipo-reporte/:id', updateTipoReporte);
router.delete('/tipo-reporte/:id', deleteTipoReporte);

// Rutas para Usuario
router.get('/usuario', getAllUsuarios);
router.get('/usuario/:id', getUsuario);
router.post('/usuario', createUsuario);
router.put('/usuario/:id', updateUsuario);
router.delete('/usuario/:id', deleteUsuario);

// Rutas para Reporte
router.get('/reporte', getAllReportes);
router.get('/reporte/:id', getReporte);
router.post('/reporte', createReporte);
router.put('/reporte/:id', updateReporte);
router.delete('/reporte/:id', deleteReporte);

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

// Rutas para ReservaServicio
router.get('/reserva-servicio', getAllReservaServicios);
router.get('/reserva-servicio/:id', getReservaServicio);
router.post('/reserva-servicio', createReservaServicio);
router.put('/reserva-servicio/:id', updateReservaServicio);
router.delete('/reserva-servicio/:id', deleteReservaServicio);

export default router;