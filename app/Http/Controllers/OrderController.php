<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Http\Requests\UploadOrderCSV;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Jobs\ImportOrderCSV;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(OrderResource::collection(Order::paginate()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_csv(UploadOrderCSV $request, OrderService $service,)
    {
        if ($request->hasfile('order_csv_file')) {
            $folder = null;
            $file = $request->file('order_csv_file');
            $filename = time() .'.' . $file->getClientOriginalExtension();
            $rst = $this->upload($file, $folder, 'local', $filename);
            if ($rst){
                $order = $service->create($request->order_number, $request->account_name, $request->account_number, $request->order_date);
                if ($order){
                    ImportOrderCSV::dispatch($order, $filename);
                }
            }
        }
    }

    public function upload(UploadedFile $uploadedFile, $folder = null, $disk = 'local', $name)
    {
        $uploadedFile->storeAs($folder, $name, $disk);
        return true;
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreorderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderService $service, StoreOrderRequest $request)
    {
        $order = $service->create($request);
        return response()->json(new OrderResource($order));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json(new OrderResource($order->loadMissing('ordered_products')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorderRequest  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateorderRequest $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
