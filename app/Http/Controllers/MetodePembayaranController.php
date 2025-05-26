<?php

namespace App\Http\Controllers;

use App\Models\metode_pembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        try {
            $metode_pembayaran = metode_pembayaran::paginate(5);
            return view('page.metode_pembayaran.index')->with([
                'metode_pembayaran' => $metode_pembayaran
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'nama_metode' => $request->input('nama_metode'),
            ];

            metode_pembayaran::create($data);

            return redirect()
                ->route('metode_pembayaran.index')->with('message_insert', 'Data metode_pembayaran Sudah ditambahkan ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'nama_metode' => $request->input('nama_metode'),
            ];

            $datas = metode_pembayaran::findOrFail($id);
            $datas->update($data);
            return redirect()
                ->route('metode_pembayaran.index')->with('message_insert', 'Data metode_pembayaran Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function destroy(string $id)
    {
        try {
            $data = metode_pembayaran::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data metode_pembayaran Berhasil DiHapus ');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
