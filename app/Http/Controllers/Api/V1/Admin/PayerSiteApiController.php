<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayerSiteRequest;
use App\Http\Requests\UpdatePayerSiteRequest;
use App\Http\Resources\Admin\PayerSiteResource;
use App\Models\PayerSite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PayerSiteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payer_site_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayerSiteResource(PayerSite::with(['payer', 'site', 'payment_method'])->get());
    }

    public function store(StorePayerSiteRequest $request)
    {
        $payerSite = PayerSite::create($request->all());

        return (new PayerSiteResource($payerSite))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayerSiteResource($payerSite->load(['payer', 'site', 'payment_method']));
    }

    public function update(UpdatePayerSiteRequest $request, PayerSite $payerSite)
    {
        $payerSite->update($request->all());

        return (new PayerSiteResource($payerSite))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payerSite->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
