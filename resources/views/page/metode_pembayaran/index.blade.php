<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('METODE PEMBAYARAN') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 shadow-xl overflow-hidden sm:rounded-lg">
                <!-- Header Data -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        DATA METODE PEMBAYARAN
                    </h3>
                </div>
                <!-- Main Content -->
                <div class="p-6 flex flex-col md:flex-row gap-6">
                    <!-- FORM ADD -->
                    <div class="w-full md:w-1/2 bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-inner">
                        <h4 class="mb-5 text-xl font-semibold text-gray-800 dark:text-gray-200">
                            INPUT DATA METODE PEMBAYARAN
                        </h4>
                        <form action="{{ route('metode_pembayaran.store') }}" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="nama_metode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Nama Metode
                                </label>
                                <input name="nama_metode" type="text" id="nama_metode"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukan Nama Metode disini...">
                            </div>
                            <button type="submit"
                                class="w-full py-2 px-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-white transition duration-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                SIMPAN
                            </button>
                        </form>
                    </div>
                    <!-- TABLE METODE PEMBAYARAN -->
                    <div class="w-full md:w-1/2">
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">NO</th>
                                        <th scope="col" class="px-6 py-3">NAMA METODE</th>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($metode_pembayaran as $key => $m)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $metode_pembayaran->perPage() * ($metode_pembayaran->currentPage() - 1) + $key + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $m->nama_metode }}
                                            </td>
                                            <td class="px-6 py-4 space-x-2">
                                                <button type="button" data-id="{{ $m->id }}"
                                                    data-modal-target="sourceModal"
                                                    data-nama_metode="{{ $m->nama_metode }}"
                                                    onclick="editSourceModal(this)"
                                                    class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white transition">
                                                    Edit
                                                </button>
                                                <button onclick="return metode_pembayaranDelete('{{ $m->id }}','{{ $m->nama_metode }}')"
                                                    class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-xs text-white transition">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $metode_pembayaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 rounded-lg shadow-xl mx-5">
                <div class="flex items-start justify-between p-4 border-b border-gray-200 dark:border-gray-700 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100" id="title_source">
                        Update Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="p-4 space-y-6">
                        <div>
                            <label for="nama_metode_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Nama Metode
                            </label>
                            <input name="nama_metode" type="text" id="nama_metode_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan Nama Metode disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 dark:border-gray-700 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 w-40 h-10 rounded-xl hover:bg-green-500 transition">
                            Simpan
                        </button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 w-40 h-10 rounded-xl text-white hover:bg-red-600 transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Script Modal & Delete -->
<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;
        const id = button.dataset.id;
        const nama_metode = button.dataset.nama_metode;
        let url = "{{ route('metode_pembayaran.update', ':id') }}".replace(':id', id);

        document.getElementById('title_source').innerText = `UPDATE NAMA METODE ${nama_metode}`;
        document.getElementById('nama_metode_edit').value = nama_metode;
        document.getElementById('formSourceButton').innerText = 'Simpan';
        document.getElementById('formSourceModal').setAttribute('action', url);

        // Clear any existing hidden inputs to prevent duplicates
        formModal.querySelectorAll('input[type="hidden"]').forEach(el => el.remove());

        let csrfToken = document.createElement('input');
        csrfToken.setAttribute('type', 'hidden');
        csrfToken.setAttribute('value', '{{ csrf_token() }}');
        csrfToken.setAttribute('name', '_token');
        formModal.appendChild(csrfToken);

        let methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PATCH');
        formModal.appendChild(methodInput);

        document.getElementById(modalTarget).classList.toggle('hidden');
    }

    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        document.getElementById(modalTarget).classList.toggle('hidden');
    }

    const metode_pembayaranDelete = async (id, nama) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus Nama Metode ${nama} ?`);
        if (tanya) {
            await axios.post(`/metode_pembayaran/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
                .then(function(response) {
                    location.reload();
                })
                .catch(function(error) {
                    alert('Error deleting record');
                    console.log(error);
                });
        }
    }
</script>
