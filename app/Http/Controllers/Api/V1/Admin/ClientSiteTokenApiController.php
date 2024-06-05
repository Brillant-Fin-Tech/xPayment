<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientSiteTokenRequest;
use App\Http\Requests\UpdateClientSiteTokenRequest;
use App\Http\Resources\Admin\ClientSiteTokenResource;
use App\Models\ClientSiteToken;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientSiteTokenApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_site_token_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSiteTokenResource(ClientSiteToken::with(['client_site'])->get());
    }

    public function store(StoreClientSiteTokenRequest $request)
    {
        $clientSiteToken = ClientSiteToken::create($request->all());

        return (new ClientSiteTokenResource($clientSiteToken))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientSiteToken $clientSiteToken)
    {
        abort_if(Gate::denies('client_site_token_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientSiteTokenResource($clientSiteToken->load(['client_site']));
    }

    public function update(UpdateClientSiteTokenRequest $request, ClientSiteToken $clientSiteToken)
    {
        $clientSiteToken->update($request->all());

        return (new ClientSiteTokenResource($clientSiteToken))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientSiteToken $clientSiteToken)
    {
        abort_if(Gate::denies('client_site_token_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSiteToken->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
