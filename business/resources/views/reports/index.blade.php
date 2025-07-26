<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pipeline Value by Stage</h3>
                    
                    @if($chartLabels->isNotEmpty())
                        <div class="max-w-2xl mx-auto">
                            <canvas id="dealsPieChart"></canvas>
                        </div>
                    @else
                        <p class="text-center text-gray-500">No deal data available to display a chart.</p>
                    @endif
                    <hr class="my-8">

    <livewire:deals-report-table />
                </div>
            </div>
        </div>
    </div>

    {{-- Add this script block at the very bottom --}}
    @if($chartLabels->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('dealsPieChart').getContext('2d');
            
            const chartData = @json($chartData);
            const chartLabels = @json($chartLabels);

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Value',
                        data: chartData,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                    }]
                },
            });
        });
    </script>
    @endif
</x-app-layout>