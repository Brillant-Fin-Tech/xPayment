<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientSitePaymentMethodRequest;
use App\Http\Requests\UpdateClientSitePaymentMethodRequest;
use App\Http\Resources\Admin\ClientSitePaymentMethodResource;
use App\Models\ClientSitePaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientSitePaymentMethodApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_site_payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSitePaymentMethodResource(ClientSitePaymentMethod::with(['client_payment_method', 'client_site'])->get());
    }

    public function store(StoreClientSitePaymentMethodRequest $request)
    {
        $clientSitePaymentMethod = ClientSitePaymentMethod::create($request->all());

        return (new ClientSitePaymentMethodResource($clientSitePaymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        abort_if(Gate::denies('client_site_payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSitePaymentMethodResource($clientSitePaymentMethod->load(['client_payment_method', 'client_site']));
    }

    public function update(UpdateClientSitePaymentMethodRequest $request, ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        $clientSitePaymentMethod->update($request->all());

        return (new ClientSitePaymentMethodResource($clientSitePaymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        abort_if(Gate::denies('client_site_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSitePaymentMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
