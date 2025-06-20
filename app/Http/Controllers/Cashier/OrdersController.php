<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        // Menga                                                            mbil data pesanan dengan detail produk yang terkait
        $orders = Order::with('orderDetails.product') // Eager loading relasi
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cashier.orders.index', compact('orders'));
    }

    public function checkout(Order $order)
    {
        if ($order->payment_status == 'paid') {
            return redirect()->route('cashier.orders.index')->with('message', 'Pesanan sudah dibayar.');
        }

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'completed',
        ]);

        return redirect()->route('cashier.orders.index')->with('message', 'Checkout berhasil.');
    }

    public function destroy(Order $order)
    {
        if ($order->payment_status == 'paid') {
            return redirect()->route('cashier.orders.index')->with('message', 'Tidak bisa hapus pesanan yang sudah dibayar.');
        }

        $order->delete();

        return redirect()->route('cashier.orders.index')->with('message', 'Pesanan berhasil dihapus.');
    }

    public function confirm(Order $order)
    {
        if ($order->order_status == 'pending') {
            $order->update([
                'order_status' => 'processing',
                'payment_status' => 'paid', // Tambahkan ini supaya setelah confirm langsung paid
            ]);

            return redirect()->route('cashier.orders.print', $order->id);
        }

        return redirect()->route('cashier.orders.processing')->with('message', 'Pesanan sudah diproses.');
    }

    public function processing()
    {
        $orders = Order::where('order_status', 'processing')->get();

        return view('cashier.orders.processing', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::where('order_status', 'completed')->get();

        return view('cashier.orders.completed', compact('orders'));
    }

    public function print(Order $order)
    {
        $order->load('orderDetails.product');

        return view('cashier.orders.invoice', compact('order'));
    }

    public function finish(Order $order)
    {
        if ($order->order_status == 'processing') {
            // Step 2: Processing -> Completed
            $order->update([
                'order_status' => 'completed',
            ]);

            return redirect()->route('cashier.orders.completed')->with('message', 'Pesanan telah diselesaikan.');
        } elseif ($order->order_status == 'completed') {
            // Step 3: Completed -> Finished (History)
            $order->update([
                'order_status' => 'finished',
            ]);

            return redirect()->route('cashier.orders.history')->with('message', 'Pesanan dipindahkan ke riwayat.');
        }

        return redirect()->back()->with('message', 'Status pesanan tidak dapat diselesaikan.');
    }

    public function history()
    {
        $histories = Order::where('order_status', 'finished')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Hitung total pesanan dan pendapatan
        $totalOrders = $histories->count();
        $totalRevenue = $histories->sum('total_amount');

        // Pindahkan ke view yang benar
        return view('cashier.history.index', compact('histories', 'totalOrders', 'totalRevenue'));
    }
}
