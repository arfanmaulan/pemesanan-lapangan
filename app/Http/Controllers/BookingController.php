<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\lapangan;
use App\Models\metode_pembayaran;
use App\Models\slot_waktu;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Get all bookings
        $bookings = booking::paginate(10);
        $user = User::all();
        $lapangan = lapangan::all();
        $slot_waktu = slot_waktu::all();
        $metode_pembayaran = metode_pembayaran::all();
        return view('page.bookings.index', compact('bookings', 'user', 'lapangan', 'slot_waktu', 'metode_pembayaran'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->input('user_id'),
                'lapangan_id' => $request->input('lapangan_id'),
                'slot_waktu_id' => $request->input('slot_waktu_id'),
                'metode_pembayaran_id' => $request->input('metode_pembayaran_id'),
                'tanggal_booking' => $request->input('tanggal_booking'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'status' => $request->input('status'),
                'catatan' => $request->input('catatan')
            ];

            booking::create($data);
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        
    }
    public function update(Request $request, $id)
    {
        try {
            $data = [
                'user_id' => $request->input('user_id'),
                'lapangan_id' => $request->input('lapangan_id'),
                'slot_waktu_id' => $request->input('slot_waktu_id'),
                'metode_pembayaran_id' => $request->input('metode_pembayaran_id'),
                'tanggal_booking' => $request->input('tanggal_booking'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'status' => $request->input('status'),
                'catatan' => $request->input('catatan')
            ];

            $datas = booking::findOrFail($id);
            $datas->update($data);
        } catch (\Exception $e) {
            return redirect()
                ->route('error.index')->with('error_message', 'terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        };
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }
    public function destroy($id)
    {
        try {
            $data = booking::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data booking Berhasil DiHapus ');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
