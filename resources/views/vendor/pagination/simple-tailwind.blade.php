@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center justify-between">

    @if ($paginator->onFirstPage())
    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md light:text-gray-300 light:bg-gray-700 light:border-gray-600">
        {!! __('pagination.previous') !!}
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 light:bg-gray-800 light:border-gray-600 light:text-gray-200 light:focus:border-blue-700 light:active:bg-gray-700 light:active:text-gray-300 hover:bg-gray-100 light:hover:bg-gray-900 light:hover:text-gray-200">
        {!! __('pagination.previous') !!}
    </a>
    @endif

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 light:bg-gray-800 light:border-gray-600 light:text-gray-200 light:focus:border-blue-700 light:active:bg-gray-700 light:active:text-gray-300 hover:bg-gray-100 light:hover:bg-gray-900 light:hover:text-gray-200">
        {!! __('pagination.next') !!}
    </a>
    @else
    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md light:text-gray-300 light:bg-gray-700 light:border-gray-600">
        {!! __('pagination.next') !!}
    </span>
    @endif

</nav>
@endif