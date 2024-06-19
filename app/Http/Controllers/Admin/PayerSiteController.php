<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPayerSiteRequest;
use App\Http\Requests\StorePayerSiteRequest;
use App\Http\Requests\UpdatePayerSiteRequest;
use App\Models\ClientSite;
use App\Models\Payer;
use App\Models\PayerSite;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PayerSiteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('payer_site_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PayerSite::with(['payer', 'site', 'payment_method'])->select(sprintf('%s.*', (new PayerSite)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'payer_site_show';
                $editGate      = 'payer_site_edit';
                $deleteGate    = 'payer_site_delete';
                $crudRoutePart = 'payer-sites';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('currency_code', function ($row) {
                return $row->currency_code ? $row->currency_code : '';
            });
            $table->editColumn('wallet_address', function ($row) {
                return $row->wallet_address ? $row->wallet_address : '';
            });
            $table->editColumn('base_currency_code', function ($row) {
                return $row->base_currency_code ? $row->base_currency_code : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('customer_kyc', function ($row) {
                return $row->customer_kyc ? $row->customer_kyc : '';
            });
            $table->editColumn('external_customer', function ($row) {
                return $row->external_customer ? $row->external_customer : '';
            });
            $table->editColumn('response_url', function ($row) {
                return $row->response_url ? $row->response_url : '';
            });
            $table->addColumn('payer_first_name', function ($row) {
                return $row->payer ? $row->payer->first_name : '';
            });

            $table->addColumn('site_domain', function ($row) {
                return $row->site ? $row->site->domain : '';
            });

            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'payer', 'site', 'payment_method']);

            return $table->make(true);
        }

        $payers          = Payer::get();
        $client_sites    = ClientSite::get();
        $payment_methods = PaymentMethod::get();

        return view('admin.payerSites.index', compact('payers', 'client_sites', 'payment_methods'));
    }

    public function create()
    {
        abort_if(Gate::denies('payer_site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payerSites.create', compact('payers', 'payment_methods', 'sites'));
    }

    public function store(StorePayerSiteRequest $request)
    {
        $payerSite = PayerSite::create($request->all());

        return redirect()->route('admin.payer-sites.index');
    }

    public function edit(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payerSite->load('payer', 'site', 'payment_method');

        return view('admin.payerSites.edit', compact('payerSite', 'payers', 'payment_methods', 'sites'));
    }

    public function update(UpdatePayerSiteRequest $request, PayerSite $payerSite)
    {
        $payerSite->update($request->all());

        return redirect()->route('admin.payer-sites.index');
    }

    public function show(PayerSite $payerSite)
    {
        abort_if(Gate::denies('payer_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payerSite->load('payer', 'site', 'payment_method');

        return view('admin.payerSites.show', compact('payerSite'));
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
