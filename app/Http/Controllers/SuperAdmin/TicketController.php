<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = \App\Models\SupportTicket::with(['company', 'user'])->latest()->paginate(20);
        return view('superadmin.tickets.index', compact('tickets'));
    }
}
