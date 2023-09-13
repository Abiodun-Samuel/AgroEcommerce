<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'order')->latest()->paginate(20);
        return Inertia::render('Admin/Transaction/TransactionIndex', [
            'transactions' => $transactions,
        ]);
    }
}
