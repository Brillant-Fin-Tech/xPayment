<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientPaymentMethodRequest;
use App\Http\Requests\UpdateClientPaymentMethodRequest;
use App\Http\Resources\Admin\ClientPaymentMethodResource;
use App\Models\ClientPaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientPaymentMethodApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPaymentMethodResource(ClientPaymentMethod::with(['client', 'payment_method'])->get());
    }

    public function store(StoreClientPaymentMethodRequest $request)
    {
        $clientPaymentMethod = ClientPaymentMethod::create($request->all());

        return (new ClientPaymentMethodResource($clientPaymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientPaymentMethod $clientPaymentMethod)
    {
        abort_if(Gate::denies('client_payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPaymentMethodResource($clientPaymentMethod->load(['client', 'payment_method']));
    }

    public function update(UpdateClientPaymentMethodRequest $request, ClientPaymentMethod $clientPaymentMethod)
    {
        $clientPaymentMethod->update($request->all());

        return (new ClientPaymentMethodResource($clientPaymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientPaymentMethod $clientPaymentMethod)
    {
        abort_if(Gate::denies('client_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPaymentMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
