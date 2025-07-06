@extends('layouts.admin')

@section('content')
    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-50">
            {{ __("Subscriber List") }}
        </div>
    </div>
    <div class="container mx-auto">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex flex-row-reverse text-gray-900 dark:text-gray-50 justify-between items-center mb-6">
                    {{-- <h2 class="text-xl font-semibold">Blog Posts</h2> --}}
                    <a href="{{ route('subscribers.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">
                        <i class="fa-solid fa-plus mr-2"></i> Add New Subscriber
                    </a>
                </div>
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                        <!-- table header start -->
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        No
                                    </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Name
                                    </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Email
                                    </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Status
                                    </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Action
                                    </p>
                                    </div>
                                </th>
                                </tr>
                            </thead>
                            <!-- table header end -->

                            <!-- table body start -->
                            @forelse ($subscribers as $subscriber)
                                @include('admin.subscriber.partials.table', ['subscriber' => $subscriber])
                            @empty
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                <tr>
                                    <td colspan="5" class="px-5 py-4 sm:px-6 text-center">
                                        <i class="fa-solid fa-box-open text-4xl mb-4 text-amber-500"></i>
                                        <h3 class="text-lg font-semibold mb-2">No products found</h3>
                                        <p class="text-gray-600 dark:text-gray-50">
                                            Sorry, we couldn't find any products that match your search. Try using different keywords or browse other categories.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
                {{-- End of Product Table --}}

                {{-- Pagination Links --}}
                <div class="mt-8">
                    {{ $subscribers->links() }}
                </div>

                <x-alerts.custom />
            </div>
        </div>
    </div>
@endsection
