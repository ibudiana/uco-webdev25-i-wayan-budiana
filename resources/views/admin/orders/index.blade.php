@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="container mx-auto">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex text-gray-900 dark:text-gray-50 justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">My Transactions</h2>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Date</th>
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Items</th>
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Total</th>
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Payment</th>
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Status</th>
                                        <th class="px-5 py-3 sm:px-6 text-left text-gray-500 dark:text-gray-400">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6 text-gray-900 dark:text-gray-50">
                                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                            </td>
                                            <td class="px-5 py-4 sm:px-6 text-gray-900 dark:text-gray-50">
                                                {{ $transaction->items->sum('quantity') }} item(s)
                                            </td>
                                            <td class="px-5 py-4 sm:px-6 text-gray-900 dark:text-gray-50">
                                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-5 py-4 sm:px-6 text-gray-900 dark:text-gray-50">
                                                {{ $transaction->paymentMethod->type ?? '-' }}
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            <td class="px-5 py-4 sm:px-6">
                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="text-amber-600 hover:underline">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-5 py-4 sm:px-6 text-center">
                                                <i class="fa-solid fa-receipt text-4xl mb-4 text-amber-500"></i>
                                                <h3 class="text-lg font-semibold mb-2">No transactions found</h3>
                                                <p class="text-gray-600 dark:text-gray-50">
                                                    You haven't made any purchases yet.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination (optional if paginated) --}}
                    {{-- <div class="mt-8">
                        {{ $transactions->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
