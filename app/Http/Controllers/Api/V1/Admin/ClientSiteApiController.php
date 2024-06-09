<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientSiteRequest;
use App\Http\Requests\UpdateClientSiteRequest;
use App\Http\Resources\Admin\ClientSiteResource;
use App\Models\ClientSite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientSiteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_site_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSiteResource(ClientSite::with(['client', 'payment_method'])->get());
    }

    public function store(StoreClientSiteRequest $request)
    {
        $clientSite = ClientSite::create($request->all());

        return (new ClientSiteResource($clientSite))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSiteResource($clientSite->load(['client', 'payment_method']));
    }

    public function update(UpdateClientSiteRequest $request, ClientSite $clientSite)
    {
        $clientSite->update($request->all());

        return (new ClientSiteResource($clientSite))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSite->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
