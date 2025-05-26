<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('LAPANGAN') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Section Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        DATA LAPANGAN
                    </h3>
                </div>
                <!-- Main Content -->
                <div class="p-6 flex flex-col md:flex-row gap-6">
                    <!-- Form Add -->
                    <div class="w-full md:w-1/2 bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-inner">
                        <h4 class="mb-5 text-xl font-semibold text-gray-800 dark:text-gray-200">
                            INPUT DATA LAPANGAN
                        </h4>
                        <form action="{{ route('lapangan.store') }}" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Lapangan
                                </label>
                                <input name="nama" type="text" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukan Nama disini...">
                            </div>
                            <div class="mb-5">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Type
                                </label>
                                <select class="js-example-placeholder-single js-states form-control w-full" name="type"
                                    data-placeholder="Pilih Type">
                                    <option value="">Pilih...</option>
                                    <option value="indoor">Indoor</option>
                                    <option value="outdoor">Outdoor</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Harga
                                </label>
                                <input name="harga" type="number" id="harga"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Masukan Harga disini...">
                            </div>
                            <button type="submit"
                                class="w-full sm:w-auto px-5 py-2.5 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg transition duration-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                SIMPAN
                            </button>
                        </form>
                    </div>
                    <!-- Table Lapangan -->
                    <div class="w-full md:w-1/2">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">NO</th>
                                        <th scope="col" class="px-6 py-3">NAMA LAPANGAN</th>
                                        <th scope="col" class="px-6 py-3">TYPE</th>
                                        <th scope="col" class="px-6 py-3">HARGA</th>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($lapangan as $key => $p)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $lapangan->perPage() * ($lapangan->currentPage() - 1) + $key + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $p->nama }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $p->type }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $p->harga }}
                                            </td>
                                            <td class="px-6 py-4 space-x-2">
                                                <button type="button" data-id="{{ $p->id }}"
                                                    data-modal-target="sourceModal"
                                                    data-nama="{{ $p->nama }}"
                                                    data-type="{{ $p->type }}"
                                                    data-harga="{{ $p->harga }}"
                                                    onclick="editSourceModal(this)"
                                                    class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white transition">
                                                    Edit
                                                </button>
                                                <button onclick="return ShiftDelete('{{ $p->id }}','{{ $p->nama }}')"
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
                            {{ $lapangan->links() }}
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
            <div class="w-full md:w-1/2 relative bg-white dark:bg-gray-800 rounded-lg shadow-xl mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100" id="title_source">
                        Update Lapangan
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col p-4 space-y-6">
                        <div>
                            <label for="nama_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                                Nama Lapangan
                            </label>
                            <input type="text" id="nama_edit" name="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan Nama disini...">
                        </div>
                        <div>
                            <label for="type_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                                Type
                            </label>
                            <select class="js-example-placeholder-single js-states form-control w-full" name="type"
                                data-placeholder="Pilih Type" id="type_edit">
                                <option value="">Pilih...</option>
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div>
                            <label for="harga_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                                Harga
                            </label>
                            <input type="number" id="harga_edit" name="harga"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan Harga disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 dark:border-gray-700 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500 transition">
                            Simpan
                        </button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600 transition">
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
        const nama = button.dataset.nama;
        const type = button.dataset.type;
        const harga = button.dataset.harga;
        let url = "{{ route('lapangan.update', ':id') }}".replace(':id', id);

        document.getElementById('title_source').innerText = `UPDATE LAPANGAN ${nama}`;
        document.getElementById('nama_edit').value = nama;
        document.getElementById('harga_edit').value = harga;
        let event = new Event('change');
        document.getElementById('type_edit').value = type;
        document.getElementById('type_edit').dispatchEvent(event);

        document.getElementById('formSourceButton').innerText = 'Simpan';
        document.getElementById('formSourceModal').setAttribute('action', url);

        // Remove previous hidden inputs (if any) to prevent duplicates
        formModal.querySelectorAll('input[type="hidden"]').forEach(el => el.remove());

        let csrfToken = document.createElement('input');
        csrfToken.setAttribute('type', 'hidden');
        csrfToken.setAttribute('name', '_token');
        csrfToken.setAttribute('value', '{{ csrf_token() }}');
        formModal.appendChild(csrfToken);

        let methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PATCH');
        formModal.appendChild(methodInput);

        document.getElementById(modalTarget).classList.toggle('hidden');
    };

    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        document.getElementById(modalTarget).classList.toggle('hidden');
    };

    const ShiftDelete = async (id, nama) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus LAPANGAN ${nama} ?`);
        if (tanya) {
            await axios.post(`/lapangan/${id}`, {
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
    };
</script>
