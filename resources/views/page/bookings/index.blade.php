<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Manajemen Bookings') }}
            </h2>
            <button onclick="openModal()" class="px-4 py-2 bg-sky-600 text-white rounded-xl hover:bg-sky-500">
                Add
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700">
                <div class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Data Bookings</div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Nama Lapangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Slot Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Metode Bayar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Status Bayar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">Catatan</th>
                                <th class="relative px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @php $no = 1; @endphp
                            @foreach ($bookings as $b)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $no++ }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->lapangan->nama }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->slot_waktu->waktu_mulai }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->tanggal_booking }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->metode_pembayaran->nama_metode }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->status_pembayaran }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->status }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">{{ $b->catatan }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                        <button onclick="editBooking({{ $b }})" class="text-amber-500 hover:text-amber-600">Edit</button>
                                        <button onclick="deleteBookings({{ $b->id }}, '{{ $b->user->name }}')" class="text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Booking -->
<div id="BookingModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tambah Booking</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:text-zinc-400 dark:hover:text-zinc-300">×</button>
        </div>
        <form action="{{ route('bookings.store') }}" method="POST" id="formBookingModal">
            @csrf
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">User</label>
                    <select id="user_id" name="user_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="lapangan_id" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Lapangan</label>
                    <select id="lapangan_id" name="lapangan_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($lapangan as $l)
                            <option value="{{ $l->id }}">{{ $l->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="slot_waktu_id" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Slot Waktu</label>
                    <select id="slot_waktu_id" name="slot_waktu_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($slot_waktu as $s)
                            <option value="{{ $s->id }}">{{ $s->waktu_mulai }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="metode_pembayaran_id" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Metode Pembayaran</label>
                    <select id="metode_pembayaran_id" name="metode_pembayaran_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($metode_pembayaran as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal_booking" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Tanggal</label>
                    <input type="date" id="tanggal_booking" name="tanggal_booking" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                </div>

                <div>
                    <label for="status_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status Pembayaran</label>
                    <select id="status_pembayaran" name="status_pembayaran" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum lunas">Belum Lunas</option>
                    </select>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status</label>
                    <select id="status" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        <option value="dipesan">Dipesan</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="3" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-500">Simpan</button>
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Booking -->
<div id="BookingModalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Booking</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:text-zinc-400 dark:hover:text-zinc-300">×</button>
        </div>
        <form method="POST" id="formBookingModalEdit">
            @csrf
            @method('PUT')
            <div class="flex flex-col space-y-4">

                <div>
                    <label for="user_id_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">User</label>
                    <select id="user_id_edit" name="user_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="lapangan_id_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Lapangan</label>
                    <select id="lapangan_id_edit" name="lapangan_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($lapangan as $l)
                            <option value="{{ $l->id }}">{{ $l->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="slot_waktu_id_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Slot Waktu</label>
                    <select id="slot_waktu_id_edit" name="slot_waktu_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($slot_waktu as $s)
                            <option value="{{ $s->id }}">{{ $s->waktu_mulai }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="metode_pembayaran_id_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Metode Pembayaran</label>
                    <select id="metode_pembayaran_id_edit" name="metode_pembayaran_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        @foreach ($metode_pembayaran as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal_booking_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Tanggal</label>
                    <input type="date" id="tanggal_booking_edit" name="tanggal_booking" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                </div>

                <div>
                    <label for="status_pembayaran_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status Pembayaran</label>
                    <select id="status_pembayaran_edit" name="status_pembayaran" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum lunas">Belum Lunas</option>
                    </select>
                </div>

                <div>
                    <label for="status_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status</label>
                    <select id="status_edit" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                        <option value="">Pilih...</option>
                        <option value="dipesan">Dipesan</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>

                <div>
                    <label for="catatan_edit" class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Catatan</label>
                    <textarea id="catatan_edit" name="catatan" rows="3" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-500">Simpan Perubahan</button>
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600">Batal</button>
            </div>
        </form>
    </div>
</div>


<script>
    function openModal() {
        document.getElementById('BookingModal').classList.remove('hidden');
        document.getElementById('AbsensiModal').classList.add('flex');

    }

    function closeModal() {
        document.getElementById('BookingModal').classList.add('hidden');
        document.getElementById('BookingModalEdit').classList.add('hidden');
    }

    function editBooking(booking) {
        const form = document.getElementById('formBookingModalEdit');
        const url = "{{ route('bookings.update', ':id') }}".replace(':id', booking.id);
        form.setAttribute('action', url);

        document.getElementById('user_id_edit').value = booking.user_id;
        document.getElementById('lapangan_id_edit').value = booking.lapangan_id;
        document.getElementById('slot_waktu_id_edit').value = booking.slot_waktu_id;
        document.getElementById('metode_pembayaran_id_edit').value = booking.metode_pembayaran_id;
        document.getElementById('tanggal_booking_edit').value = booking.tanggal_booking;
        document.getElementById('status_pembayaran_edit').value = booking.status_pembayaran;
        document.getElementById('status_edit').value = booking.status;
        document.getElementById('catatan_edit').value = booking.catatan;

        document.getElementById('BookingModalEdit').classList.remove('hidden');
        document.getElementById('BookingModalEdit').classList.add('flex');
    }

    // Fungsi hapus karyawan
    function deleteBookings(id, name) {
            if (confirm(`Apakah anda yakin untuk menghapus booking ${name}?`)) {
                axios.post(`/bookings/${id}`, {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    })
                    .then(() => location.reload())
                    .catch(err => {
                        alert('Error deleting record');
                        console.error(err);
                    });
            }
        }
</script>

</x-app-layout>
