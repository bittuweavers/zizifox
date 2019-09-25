<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $appointments = Appointment::all();

        return view('admin.appointments.index', compact('appointments'));
    }


    /**
     * Display Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $appointment = Appointment::findOrFail($id);

        return view('admin.appointments.show', compact('appointment'));
    }
}