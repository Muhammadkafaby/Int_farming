@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4" style="padding-top: 9rem; padding-bottom: 5rem;">
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">🌟 Emilia 🌟</h1>
    <p class="text-center text-gray-600 mb-6">Halo! Saya Emilia, asisten virtual Anda. Ada yang bisa saya bantu?</p>

    <!-- Opsi Mode -->
    <div class="flex justify-center mb-6">
        <a href="{{ route('chatbot') }}">
            <button
                id="qna-button"
                class="px-4 py-2 bg-gray-700 text-white rounded-l-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500"
            >
                Tanya
            </button>
        </a>
        <a href="{{ route('chatbot_upload') }}">
            <button
                id="document-button"
                class="px-4 py-2 bg-green-600 text-white rounded-r-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500"
            >
                Dokumen
            </button>
        </a>
    </div>

    <!-- PDF Upload Form -->
    <div class="flex justify-center">
        <form id="upload-form" action="{{ route('chatbot_upload') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8">
            @csrf
            @if (session('message'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded relative">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('file_name'))
                <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded relative">
                    File yang diunggah: {{ session('file_name') }}
                </div>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                    Upload PDF
                </label>
                <input type="file" id="file" name="file" accept="application/pdf" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="Upload file PDF">
                <small class="text-gray-500">Hanya file dengan format PDF yang didukung.</small>
            </div>
            <div class="mb-4">
                <iframe id="pdf-preview" class="w-full h-96 border rounded bg-gray-100"></iframe>
            </div>
            <div class="mb-4">
                <div class="bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    <strong>Peringatan:</strong>
                    File PDF yang Anda unggah akan digunakan untuk membantu chatbot dalam mengambil keputusan. Mohon pastikan dokumen yang diunggah sesuai dan tidak sembarangan. Terima kasih atas pengertiannya.
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="confirmation" style="-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">
                    Ketik "<strong>Saya mengerti akan risiko tersebut</strong>" untuk melanjutkan:
                </label>
                <input type="text" id="confirmation" name="confirmation" autocomplete="off" onpaste="return false;"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan konfirmasi Anda di sini">
            </div>
            <div class="flex items-center justify-between">
                <button type="button" id="upload-button" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Validasi file PDF
    document.getElementById('file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.type !== 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File',
                    text: 'Please upload a valid PDF file.',
                });
                event.target.value = '';
                document.getElementById('pdf-preview').src = '';
                return;
            }
            const fileURL = URL.createObjectURL(file);
            document.getElementById('pdf-preview').src = fileURL;
        }
    });

    // Tombol Upload
    document.getElementById('upload-button').addEventListener('click', function() {
        const confirmation = document.getElementById('confirmation').value.trim();
        if (confirmation !== 'Saya mengerti akan risiko tersebut') {
            Swal.fire({
                icon: 'error',
                title: 'Konfirmasi Gagal',
                text: 'Anda harus mengetik kalimat yang sesuai sebelum melanjutkan.',
                confirmButtonColor: '#3085d6',
            });
            return;
        }
        Swal.fire({
            title: 'Apakah Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, unggah!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Uploading...',
                    text: 'Please wait while your file is being uploaded.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
                document.getElementById('upload-form').submit();
            }
        });
    });

    // Tangani tombol "Enter" pada input konfirmasi
    document.getElementById('confirmation').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Mencegah form terkirim
            document.getElementById('upload-button').click(); // Memicu tombol upload
        }
    });
</script>
@endsection