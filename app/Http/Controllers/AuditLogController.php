<?php

namespace App\Http\Controllers;

use App\AuditLog;

use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')->latest()->paginate(10);
        return view('audit_logs.index', compact('logs'));
    }
}
