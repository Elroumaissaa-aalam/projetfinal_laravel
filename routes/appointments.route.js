import express from 'express';
import {
  createAppointment,
  getAppointments,
  getAppointment,
  updateAppointment,
  deleteAppointment,
  createCheckoutSession,
  getAvailableTimeSlots
} from '../controllers/appointments.controller.js';

const router = express.Router();

// GET /api/appointments - Get all appointments with optional filtering
router.get('/', getAppointments);

// GET /api/appointments/available-slots - Get available time slots
router.get('/available-slots', getAvailableTimeSlots);

// GET /api/appointments/:id - Get single appointment
router.get('/:id', getAppointment);

// POST /api/appointments - Create new appointment
router.post('/', createAppointment);

// PUT /api/appointments/:id - Update appointment
router.put('/:id', updateAppointment);

// DELETE /api/appointments/:id - Delete appointment
router.delete('/:id', deleteAppointment);

// POST /api/appointments/create-checkout-session - Create Stripe checkout session
router.post('/create-checkout-session', createCheckoutSession);

export default router;