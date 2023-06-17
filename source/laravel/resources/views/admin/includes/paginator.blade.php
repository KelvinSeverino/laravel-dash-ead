<nav aria-label="Page navigation py-12">
    <ul class="inline-flex -space-x-px">
        @if ($data->currentPage() > 1)
            <li>
                <a href="?page={{ $data->currentPage() - 1 }}&status={{ request('status', 'P') }}"
                    class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Anterior
                </a>
            </li>
        @endif
        <li>
            <a href="#" aria-current="page"
                class="py-2 px-3 text-blue-600 bg-blue-50 border border-gray-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                {{ $data->currentPage() }}
            </a>
        </li>
        @if ($data->currentPage() < $data->lastPage())
            <li>
                <a href="?page={{ $data->currentPage() + 1 }}&status={{ request('status', 'P') }}"
                    class="py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Próxima
                </a>
            </li>
        @endif
    </ul>
</nav>
