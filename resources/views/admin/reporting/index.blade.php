@extends('layouts.admin')

@section('title', 'Reporting')

@section('content')
<h1 class="text-3xl font-bold mb-8">Reporting</h1>

<div class="bg-white rounded-lg shadow-md p-6">

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <p class="text-gray-600 text-sm mb-2">Total Transaction</p>
            <h3 class="text-4xl font-bold">
                {{ $totalTransaksi ?? 0 }}
            </h3>
        </div>

        <div>
            <p class="text-gray-600 text-sm mb-2">Top Seller</p>
            <h3 class="text-2xl font-bold">
                {{ $topSeller?->alat?->nama_alat ?? 'N/A'}}
            </h3>
        </div>
    </div>

    <!-- Period Selector -->
    <div class="flex gap-2 mb-8">
        <a href="{{ route('admin.reporting', ['periode' => 'day']) }}"
           class="px-6 py-2 rounded {{ $periode === 'day' ? 'bg-green-500 text-white' : 'border border-gray-300 hover:bg-gray-50' }}">
            Day
        </a>

        <a href="{{ route('admin.reporting', ['periode' => 'week']) }}"
           class="px-6 py-2 rounded {{ $periode === 'week' ? 'bg-green-500 text-white' : 'border border-gray-300 hover:bg-gray-50' }}">
            Week
        </a>

        <a href="{{ route('admin.reporting', ['periode' => 'month']) }}"
           class="px-6 py-2 rounded {{ $periode === 'month' ? 'bg-green-500 text-white' : 'border border-gray-300 hover:bg-gray-50' }}">
            Month
        </a>
    </div>

    <!-- Income Section -->
    <div class="mb-8">
        <p class="text-gray-600 text-sm mb-2">Income</p>
        <h3 class="text-4xl font-bold">
            Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}
        </h3>
    </div>

    <!-- Chart Placeholder -->
    <div class="mb-8">
        <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
            <p class="text-gray-400">
                Chart Area - Implementasi dengan Chart.js atau library lainnya
            </p>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="mb-8">
        <p class="text-gray-600 text-sm mb-2">Total Revenue</p>
        <h3 class="text-4xl font-bold">
            Rp {{ number_format(($pendapatan ?? 0) * 1.3, 0, ',', '.') }}
        </h3>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4">
        <button
            type="button"
            onclick="window.print()"
            class="bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600">
            Cancel
        </button>

        <button
            type="button"
            onclick="window.print()"
            class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600">
            Save Report
        </button>
    </div>

</div>
@endsection
