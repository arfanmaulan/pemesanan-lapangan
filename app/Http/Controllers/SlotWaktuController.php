<?php

namespace App\Http\Controllers;

use App\Models\slot_waktu;
use Illuminate\Http\Request;

class SlotWaktuController extends Controller
{
    public function index()
    {
        try {
            $slot_waktu = slot_waktu::paginate(5);
            return view('page.slot_waktu.index')->with([
                'slot_waktu' => $slot_waktu
            ]);
        } catch (\Exception $e) {
            return redirect()->route('error.index')->with('error_message', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'waktu_mulai' => $request->input('waktu_mulai'),
                'waktu_selesai' => $request->input('waktu_selesai'),
            ];

            slot_waktu::create($data);

            return redirect()
                ->route('slot_waktu.index')->with('message_insert', 'Data slot_waktu Sudah ditambahkan ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'waktu_mulai' => $request->input('waktu_mulai'),
                'waktu_selesai' => $request->input('waktu_selesai'),
            ];

            $datas = slot_waktu::findOrFail($id);
            $datas->update($data);
            return redirect()
                ->route('slot_waktu.index')->with('message_insert', 'Data slot_waktu Berhasil diPerbarui ');
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
    }

    public function destroy(string $id)
    {
        try {
            $data = slot_waktu::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data slot_waktu Berhasil DiHapus ');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
