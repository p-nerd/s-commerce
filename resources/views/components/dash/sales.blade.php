<div class="w-full">
    <div class="mb-5 flex justify-between">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h5
                    class="mb-2 inline-flex items-center font-normal leading-none text-gray-500 dark:text-gray-400"
                >
                    Sales
                </h5>
                <p
                    id="total-sales"
                    class="text-2xl font-bold leading-none text-gray-900 dark:text-white"
                >
                    Loading...
                </p>
            </div>
        </div>
        <div>
            <button
                id="dropdownDefaultButton"
                data-dropdown-toggle="lastDaysdropdown"
                data-dropdown-placement="bottom"
                type="button"
                class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
            >
                Last 7 days
                <svg
                    class="ms-2.5 h-2.5 w-2.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 4 4 4-4"
                    />
                </svg>
            </button>
            <div
                id="lastDaysdropdown"
                class="z-50 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
            >
                @php
                    $periods = [
                        'yesterday' => 'Yesterday',
                        'today' => 'Today',
                        'last-7-days' => 'Last 7 days',
                        'last-30-days' => 'Last 30 days',
                        'this-year' => 'This Year',
                        'last-year' => 'Last Year',
                        'lifetime' => 'Lifetime',
                    ];
                @endphp

                <ul
                    class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownDefaultButton"
                >
                    @foreach ($periods as $period => $label)
                        <li>
                            <a
                                data-period="{{ $period }} "
                                class="block cursor-pointer px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div id="line-chart"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const options = {
            chart: {
                height: '100%',
                maxWidth: '100%',
                type: 'line',
                dropShadow: { enabled: false },
            },
            tooltip: { enabled: true, x: { show: false } },
            dataLabels: { enabled: false },
            stroke: { width: 6, curve: 'smooth' },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: { left: 20, right: 20, top: -26 },
            },
            series: [
                {
                    name: 'Sales',
                    data: [],
                    color: '#1A56DB',
                },
            ],
            legend: { show: false },
            xaxis: { categories: [] },
            yaxis: { show: false },
        };

        let chart;

        async function fetchSalesData(period = 'last-7-days') {
            const response = await fetch(
                `/admin/overview/sales?sales=${period}`,
            );
            return await response.json();
        }

        async function updateChart(period = 'last-7-days') {
            const data = await fetchSalesData(period);

            options.series[0].data = data.sales.map((s) =>
                Number(s).toFixed(2),
            );
            options.xaxis.categories = data.dates;

            // Update total sales
            const totalSales = data.sales.reduce((a, b) => a + b, 0);
            document.getElementById('total-sales').textContent =
                `৳${Number(totalSales).toFixed(2)}`;

            if (chart) {
                chart.updateOptions(options);
            } else if (
                document.getElementById('line-chart') &&
                typeof ApexCharts !== 'undefined'
            ) {
                chart = new ApexCharts(
                    document.getElementById('line-chart'),
                    options,
                );
                chart.render();
            }

            // Update dropdown button text
            document.getElementById(
                'dropdownDefaultButton',
            ).firstChild.textContent = document
                .querySelector(`[data-period="${period}"]`)
                .textContent.trim();
        }

        // Initial chart load
        updateChart();

        // Add event listeners to dropdown items
        document.querySelectorAll('#lastDaysdropdown a').forEach((link) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const period = e.target.getAttribute('data-period');
                updateChart(period);
            });
        });
    });
</script>
