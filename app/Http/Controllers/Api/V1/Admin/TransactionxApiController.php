<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionxRequest;
use App\Http\Requests\UpdateTransactionxRequest;
use App\Http\Resources\Admin\TransactionxResource;
use App\Models\Transactionx;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionxApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transactionx_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionxResource(Transactionx::with(['payer', 'payment_method', 'site', 'client'])->get());
    }

    public function store(StoreTransactionxRequest $request)
    {
        $transactionx = Transactionx::create($request->all());

        return (new TransactionxResource($transactionx))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Transactionx $transactionx)
    {
        abort_if(Gate::denies('transactionx_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionxResource($transactionx->load(['payer', 'payment_method', 'site', 'client']));
    }

    public function update(UpdateTransactionxRequest $request, Transactionx $transactionx)
    {
        $transactionx->update($request->all());

        return (new TransactionxResource($transactionx))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Transactionx $transactionx)
    {
        abort_if(Gate::denies('transactionx_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionx->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
