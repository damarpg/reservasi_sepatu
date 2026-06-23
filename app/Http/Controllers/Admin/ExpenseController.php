<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'foto_nota' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto_nota')->store('notas', 'public');

        Expense::create([
            'nama_pengeluaran' => $request->nama_biaya,
            'jumlah' => $request->nominal,
            'foto_nota' => $path,
            'tanggal' => now(),
        ]);

        return redirect()->back()->with('success', 'Biaya operasional berhasil dicatat!');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->back()->with('success', 'Catatan biaya berhasil dihapus!');
    }
}