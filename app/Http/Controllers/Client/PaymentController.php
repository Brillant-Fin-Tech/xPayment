<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPayerSiteRequest;
use App\Http\Requests\StorePayerSiteRequest;
use App\Http\Requests\UpdatePayerSiteRequest;
use App\Models\ClientSite;
use App\Models\ClientSiteToken;
use App\Models\Payer;
use App\Models\PayerSite;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = $request->apiKey;
        $externalCustomerId = $request->externalCustomerId;

        $clientSiteToken = ClientSiteToken::where('token', $apiKey)->first()->load('client_site');
        $request['clientSiteToken'] = $clientSiteToken;

        $payer =

        $payerSite = PayerSite::where("external_customer",$externalCustomerId)->first();

        if ($payerSite) {

        }else{
            $payerSite = PayerSite::create([
                'currency_code'=>$request['currency_code'] ?? "",
                'wallet_address'=>$request['wallet_address'] ?? "",
                'base_currency_code'=>$request['base_currency_code'],
                'email'=>$request['email'],
                'phone'=>$request['phone'],
                'customer_kyc'=>$request['customer_kyc'],
                'external_customer'=>$request['external_customer'],
                'response_url'=>$request['response_url'],
                'site_id'=>$clientSiteToken->client_site_id,
                'payment_method_id'=>1,
            ]);
        }
        $request["payerSite"] = $payerSite;


        return $request;
    }

    public function create()
    {
        abort_if(Gate::denies('payer_site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('panel.payerSites.create', compact('payers', 'payment_methods', 'sites'));
    }

    public function store(StorePayerSiteRequest $request)
    {
        $payerSite = PayerSite::create($request->all());

        return redirect()->route('panel.payer-sites.index');
    }

    public function edit(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payerSite->load('payer', 'site', 'payment_method');

        return view('panel.payerSites.edit', compact('payerSite', 'payers', 'payment_methods', 'sites'));
    }

    public function update(UpdatePayerSiteRequest $request, PayerSite $payerSite)
    {
        $payerSite->update($request->all());

        return redirect()->route('panel.payer-sites.index');
    }

    public function show(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payerSite->load('payer', 'site', 'payment_method');

        return view('panel.payerSites.show', compact('payerSite'));
    }

    public function destroy(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payerSite->delete();

        return back();
    }

    public function massDestroy(MassDestroyPayerSiteRequest $request)
    {
        $payerSites = PayerSite::find(request('ids'));

        foreach ($payerSites as $payerSite) {
            $payerSite->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
