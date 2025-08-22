<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                @foreach($data as $item)
                <div class="overflow-hidden shadow-sm sm:rounded-lg border border-blue-200" style="background: {{ $item['bg_color'] }};">
                    <div class="p-6 text-white">
                        <h3 class="text-lg font-semibold mb-2">{{ $item['title'] }}</h3>
                        <div class="text-4xl font-bold mb-2">{{ number_format($item['value']) }}</div>
                        <p class="text-sm">{{ $item['sub_title'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Weekly Transactions</h3>
                    <canvas id="weeklyTransactionChart" width="400" height="100"></canvas>
                </div>
            </div>
            <!-- Latest Transactions Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Latest Transactions</h3>
                        <div class="flex items-center space-x-4">
                            <input type="text" 
                                   id="searchInput" 
                                   placeholder="Search transactions..." 
                                   class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(0)">
                                        ID <span id="sort-0" class="ml-1">↕️</span>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(1)">
                                        Date <span id="sort-1" class="ml-1">↕️</span>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(2)">
                                        Customer <span id="sort-2" class="ml-1">↕️</span>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(3)">
                                        Amount <span id="sort-3" class="ml-1">↕️</span>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(4)">
                                        Status <span id="sort-4" class="ml-1">↕️</span>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Table rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Custom Pagination -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-4">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <button id="prevMobile" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
                            <button id="nextMobile" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-700">Show</p>
                                <select id="perPageSelect" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <p class="text-sm text-gray-700">entries</p>
                            </div>
                            <div>
                                <p id="paginationInfo" class="text-sm text-gray-700"></p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    <button id="prevBtn" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div id="pageNumbers" class="flex">
                                        <!-- Page numbers will be generated by JavaScript -->
                                    </div>
                                    <button id="nextBtn" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Static transaction data
                const transactionsData = [
                    { id: '#1001', date: 'Dec 15, 2023', customer: 'John Doe', amount: 125.99, status: 'completed' },
                    { id: '#1002', date: 'Dec 14, 2023', customer: 'Jane Smith', amount: 89.50, status: 'pending' },
                    { id: '#1003', date: 'Dec 14, 2023', customer: 'Mike Johnson', amount: 245.00, status: 'completed' },
                    { id: '#1004', date: 'Dec 13, 2023', customer: 'Sarah Wilson', amount: 67.25, status: 'failed' },
                    { id: '#1005', date: 'Dec 13, 2023', customer: 'David Brown', amount: 156.80, status: 'completed' },
                    { id: '#1006', date: 'Dec 12, 2023', customer: 'Emma Davis', amount: 199.99, status: 'completed' },
                    { id: '#1007', date: 'Dec 12, 2023', customer: 'Alex Chen', amount: 78.45, status: 'pending' },
                    { id: '#1008', date: 'Dec 11, 2023', customer: 'Lisa Wang', amount: 234.50, status: 'completed' },
                    { id: '#1009', date: 'Dec 11, 2023', customer: 'Tom Miller', amount: 45.25, status: 'failed' },
                    { id: '#1010', date: 'Dec 10, 2023', customer: 'Kate Johnson', amount: 187.60, status: 'completed' }
                ];

                let currentPage = 1;
                let perPage = 10;
                let sortColumn = 0;
                let sortDirection = 'asc';
                let filteredData = [...transactionsData];

                function getStatusBadge(status) {
                    const badges = {
                        completed: '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>',
                        pending: '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
                        failed: '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Failed</span>'
                    };
                    return badges[status];
                }

                function renderTable() {
                    const tableBody = document.getElementById('tableBody');
                    const start = (currentPage - 1) * perPage;
                    const end = start + perPage;
                    const paginatedData = filteredData.slice(start, end);

                    tableBody.innerHTML = paginatedData.map(item => `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.id}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.date}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.customer}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$${item.amount.toFixed(2)}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${getStatusBadge(item.status)}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td>
                        </tr>
                    `).join('');

                    updatePagination();
                }

                function updatePagination() {
                    const totalPages = Math.ceil(filteredData.length / perPage);
                    const start = (currentPage - 1) * perPage + 1;
                    const end = Math.min(currentPage * perPage, filteredData.length);
                    
                    document.getElementById('paginationInfo').textContent = 
                        `Showing ${start} to ${end} of ${filteredData.length} entries`;

                    // Update page numbers
                    const pageNumbers = document.getElementById('pageNumbers');
                    pageNumbers.innerHTML = '';
                    
                    for (let i = 1; i <= totalPages; i++) {
                        const pageButton = document.createElement('button');
                        pageButton.className = `relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ${
                            i === currentPage ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900'
                        }`;
                        pageButton.textContent = i;
                        pageButton.onclick = () => goToPage(i);
                        pageNumbers.appendChild(pageButton);
                    }

                    // Update navigation buttons
                    document.getElementById('prevBtn').disabled = currentPage === 1;
                    document.getElementById('nextBtn').disabled = currentPage === totalPages;
                    document.getElementById('prevMobile').disabled = currentPage === 1;
                    document.getElementById('nextMobile').disabled = currentPage === totalPages;
                }

                function goToPage(page) {
                    currentPage = page;
                    renderTable();
                }

                function sortTable(column) {
                    if (sortColumn === column) {
                        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        sortColumn = column;
                        sortDirection = 'asc';
                    }

                    const columns = ['id', 'date', 'customer', 'amount', 'status'];
                    const key = columns[column];

                    filteredData.sort((a, b) => {
                        let aVal = a[key];
                        let bVal = b[key];

                        if (key === 'amount') {
                            aVal = parseFloat(aVal);
                            bVal = parseFloat(bVal);
                        }

                        if (sortDirection === 'asc') {
                            return aVal > bVal ? 1 : -1;
                        } else {
                            return aVal < bVal ? 1 : -1;
                        }
                    });

                    // Update sort indicators
                    document.querySelectorAll('[id^="sort-"]').forEach(el => el.textContent = '↕️');
                    document.getElementById(`sort-${column}`).textContent = sortDirection === 'asc' ? '↑' : '↓';

                    currentPage = 1;
                    renderTable();
                }

                function filterTable() {
                    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                    const statusFilter = document.getElementById('statusFilter').value;

                    filteredData = transactionsData.filter(item => {
                        const matchesSearch = Object.values(item).some(val => 
                            val.toString().toLowerCase().includes(searchTerm)
                        );
                        const matchesStatus = !statusFilter || item.status === statusFilter;
                        return matchesSearch && matchesStatus;
                    });

                    currentPage = 1;
                    renderTable();
                }

                // Event listeners
                document.getElementById('searchInput').addEventListener('input', filterTable);
                document.getElementById('statusFilter').addEventListener('change', filterTable);
                document.getElementById('perPageSelect').addEventListener('change', function() {
                    perPage = parseInt(this.value);
                    currentPage = 1;
                    renderTable();
                });

                document.getElementById('prevBtn').addEventListener('click', () => {
                    if (currentPage > 1) goToPage(currentPage - 1);
                });

                document.getElementById('nextBtn').addEventListener('click', () => {
                    const totalPages = Math.ceil(filteredData.length / perPage);
                    if (currentPage < totalPages) goToPage(currentPage + 1);
                });

                document.getElementById('prevMobile').addEventListener('click', () => {
                    if (currentPage > 1) goToPage(currentPage - 1);
                });

                document.getElementById('nextMobile').addEventListener('click', () => {
                    const totalPages = Math.ceil(filteredData.length / perPage);
                    if (currentPage < totalPages) goToPage(currentPage + 1);
                });

                // Initialize table
                renderTable();
            </script>
            

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyTransactionChart').getContext('2d');
    const weeklyTransactionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                {
                    label: 'Transactions',
                    data: [12, 19, 3, 5, 20, 3, 10],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.1,
                    fill: true
                },
                {
                    label: 'Volume',
                    data: [1, 13, 6, 10, 1, 4, 1],
                    borderColor: 'red',
                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                    tension: 0.1,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</x-app-layout>
