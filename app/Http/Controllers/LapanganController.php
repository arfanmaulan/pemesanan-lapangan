<?php

namespace App\Http\Controllers;

use App\Models\lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        try {

            $lapangan = lapangan::paginate(5);
            return view('page.lapangan.index')->with([
                'lapangan' => $lapangan
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'nama' => $request->input('nama'),
                'type' => $request->input('type'),
                'harga' => $request->input('harga'),
            ];

            lapangan::create($data);

            return redirect()
                ->route('lapangan.index')->with('message_insert', 'Data lapangan Sudah ditambahkan ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'nama' => $request->input('nama'),
                'type' => $request->input('type'),
                'harga' => $request->input('harga'),
            ];

            $datas = lapangan::findOrFail($id);
            $datas->update($data);

            return redirect()
                ->route('lapangan.index')->with('message_insert', 'Data lapangan Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function destroy(string $id)
    {
        try {
            $data = lapangan::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data lapangan Berhasil DiHapus ');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
