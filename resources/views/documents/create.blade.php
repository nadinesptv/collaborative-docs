@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Buat Dokumen Baru') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                {{-- Form ini mengarah ke route 'documents.store' dengan method POST --}}
                <form action="{{ route('documents.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumen</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border"
                               placeholder="Masukkan judul dokumen (misal: Laporan Proyek)">
                        
                        {{-- Menampilkan pesan error jika validasi gagal --}}
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ url()->previous() ?? route('documents.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                            Buat Dokumen
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection