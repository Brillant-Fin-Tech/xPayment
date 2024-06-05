<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayerRequest;
use App\Http\Requests\UpdatePayerRequest;
use App\Http\Resources\Admin\PayerResource;
use App\Models\Payer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PayerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayerResource(Payer::all());
    }

    public function store(StorePayerRequest $request)
    {
        $payer = Payer::create($request->all());

        return (new PayerResource($payer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Payer $payer)
    {
        abort_if(Gate::denies('payer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayerResource($payer);
    }

    public function update(UpdatePayerRequest $request, Payer $payer)
    {
        $payer->update($request->all());

        return (new PayerResource($payer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Payer $payer)
    {
        abort_if(Gate::denies('payer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
