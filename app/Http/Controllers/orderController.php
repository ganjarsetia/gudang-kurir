<?php

namespace App\Http\Controllers;

use App\DataTables\orderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Repositories\orderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;
use App\Models\Order;

class orderController extends AppBaseController
{
    /** @var  orderRepository */
    private $orderRepository;

    public function __construct(orderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the order.
     *
     * @param orderDataTable $orderDataTable
     * @return Response
     */
    public function index(orderDataTable $orderDataTable)
    {
        return $orderDataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new order.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in storage.
     *
     * @param CreateorderRequest $request
     *
     * @return Response
     */
    public function store(CreateorderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified order in storage.
     *
     * @param  int              $id
     * @param UpdateorderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateorderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }

    public function list_new()
    {
        $order = '';
        $current_order = Order::where([
            ['user_id', auth()->user()->id],
            ['status', 'in progress']
        ])->first();
        
        if (!$current_order) {
            $order = Order::whereNull('user_id')->first();
        }

        return view('orders.list_new', compact('current_order', 'order'));
    }

    public function pick_order(Request $request)
    {
        $input = $request->all();

        $order_id = $input['order_id'];

        $order = Order::find($order_id);

        // if avalaible book it
        if ($order->status == 'new' && $order->user_id == null) {
            $order->status = 'in progress';
            $order->user_id = auth()->user()->id;
            $order->save();
            
            Flash::success('Order picked successfully.');

            return redirect(route('list_new'));
        } else {
            Flash::error('Order not available');

            return redirect(route('list_new'));
        }
    }

    public function finish_order($id, Request $request)
    {
        $input = $request->all();
        $order = Order::find($id);

        if (!isset($input['Cancel'])) {
            $order->status = 'received';
            $order->save();

            Flash::success('Order Finished');

            return redirect(route('list_new'));
        } else {
            $order->status = 'new';
            $order->user_id = null;
            $order->save();

            Flash::error('Order Canceled');

            return redirect(route('list_new'));
        }

    }
}
