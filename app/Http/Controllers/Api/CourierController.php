<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDelivery;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class CourierController extends Controller
{
    public function pendingShipment()
    {
        $user = Auth::user();

        $deliveries = DB::table('order_deliveries')
        ->join('transactions', 'order_deliveries.transaction_id', '=', 'transactions.id')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->join('addresses', 'order_deliveries.adress_id', '=', 'addresses.id')
        ->where('order_deliveries.courier_id', $user->id)
        ->where('order_deliveries.status', 'pending')
        ->select(
            'order_deliveries.id as delivery_id',
            'order_deliveries.status',
            'transactions.transaction_code',
            'transactions.total_qty',
            'transactions.delivery_fee',
            'transactions.grand_total',
            'transactions.date as transaction_date',
            'users.name as customer_name',
        )
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $deliveries
        ]);
    }

    public function shippiingDetail($id)
    {

        $transactionDeliverydata = DB::table('order_deliveries')
                                        ->join('addresses', 'order_deliveries.adress_id', '=', 'addresses.id')
                                        ->where('order_deliveries.transaction_id', '=', $id)
                                        ->select('order_deliveries.id', 'transaction_id', 'name', 'phone_number', 'address', 'latitude', 'longitude')
                                        ->first();

        if (!$transactionDeliverydata) {
            return response()->json([
                'status' => 'error',
                'message' => 'Delivery Id Not Found',
            ], 404);
        }

        $transactionData = Transaction::select('id', 'transaction_code', 'total_qty', 'total_main_cost', 'delivery_fee', 'grand_total', 'date', 'status')
                        ->where('id', $transactionDeliverydata->transaction_id)
                        ->first();


        $transactionDetailData = DB::table('transaction_details')
                                    ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
                                    ->select('transaction_details.id', 'menus.name', 'transaction_details.qty', 'transaction_details.main_cost', 'transaction_details.main_subtotal')
                                    ->where('transaction_details.transaction_id', '=', $transactionData->id)
                                    ->get();

        

        return response()->json([
            'status' => 'success',
            'data' => [
                    'shipping' => $transactionDeliverydata,
                    'transaction' => $transactionData,
                    'details' => $transactionDetailData->map(function ($detail) {
                                return (array) $detail;
                    })
            ],
        ]);
    }

    public function shippingAccept(Request $request)
    {
        OrderDelivery::where('id', '=', $request->id)->update([
            'status' => 'process'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status Pengiriman Berhasil Diubah'
        ], 200);
    }

    public function processShipment()
    {
        $user = Auth::user();

        $deliveries = DB::table('order_deliveries')
        ->join('transactions', 'order_deliveries.transaction_id', '=', 'transactions.id')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->join('addresses', 'order_deliveries.adress_id', '=', 'addresses.id')
        ->where('order_deliveries.courier_id', $user->id)
        ->where('order_deliveries.status', 'process')
        ->select(
            'order_deliveries.id as delivery_id',
            'order_deliveries.status',
            'transactions.transaction_code',
            'transactions.total_qty',
            'transactions.delivery_fee',
            'transactions.grand_total',
            'transactions.date as transaction_date',
            'users.name as customer_name',
        )
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $deliveries
        ]);
    }

    public function shippingDone(Request $request)
    {
        $data = Transaction::where('transaction_code', '=', $request->transaction_code)->select('id')->first();

        OrderDelivery::where('transaction_id', '=', $data->id)->update([
            'arrival_date' => now(),
            'status' => 'arrived'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status Pengiriman Berhasil Diubah'
        ], 200);
    }
}
