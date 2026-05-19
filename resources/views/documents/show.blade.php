@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $document->title }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <span class="text-sm text-gray-500">Dibuat: {{ $document->created_at->format('d M Y H:i') }}</span>
                </div>
                <a href="{{ route('documents.edit', $document->id) }}" class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    ✏️ Edit
                </a>
            </div>
            <div class="p-6 bg-gray-50">
                <pre class="whitespace-pre-wrap font-mono text-sm text-gray-800 leading-relaxed">{{ $document->content ?: '(Dokumen masih kosong)' }}</pre>
            </div>
        </div>

        <div class="mt-4 flex justify-end">
            <a href="{{ route('documents.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                ← Kembali ke Daftar Dokumen
            </a>
        </div>
    </div>
</div>
@endsection
