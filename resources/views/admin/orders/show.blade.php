@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Transaction Details</h2>
                <p class="text-gray-600 dark:text-gray-300">Transaction Date: {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</p>
                <p class="text-gray-600 dark:text-gray-300">Payment Method: {{ $transaction->paymentMethod->type ?? '-' }}</p>
                <p class="text-gray-600 dark:text-gray-300">Transaction ID: {{ $transaction->id }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Items Purchased</h3>
                <div class="space-y-4">
                    @foreach ($transaction->items as $item)
                        <div class="flex justify-between border-b pb-2">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($item->item_price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Subtotal: Rp {{ number_format($item->item_price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                <p class="text-xl font-semibold text-gray-900 dark:text-white">
                    Total: Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                </p>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('transaction.index') }}" class="text-amber-600 hover:underline">
                    ← Back to Transactions
                </a>

                @if ($transaction->status !== 'completed')
                    @can('manage-transactions')
                        <form action="{{ route('transaction.updateStatus', $transaction->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Mark as Complete
                            </button>
                        </form>
                    @endcan
                @else
                    <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded text-sm font-semibold">
                        Completed
                    </span>
                @endif
            </div>


        </div>
    </div>
</div>
@endsection
