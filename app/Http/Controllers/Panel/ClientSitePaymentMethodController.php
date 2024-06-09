<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientSitePaymentMethodRequest;
use App\Http\Requests\StoreClientSitePaymentMethodRequest;
use App\Http\Requests\UpdateClientSitePaymentMethodRequest;
use App\Models\ClientPaymentMethod;
use App\Models\ClientSite;
use App\Models\ClientSitePaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientSitePaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_site_payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientSitePaymentMethod::with(['client_payment_method', 'client_site'])->select(sprintf('%s.*', (new ClientSitePaymentMethod)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_site_payment_method_show';
                $editGate      = 'client_site_payment_method_edit';
                $deleteGate    = 'client_site_payment_method_delete';
                $crudRoutePart = 'client-site-payment-methods';

                return view('panel.partials.datatablesActions', compact(
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
            $table->addColumn('client_payment_method_name', function ($row) {
                return $row->client_payment_method ? $row->client_payment_method->name : '';
            });

            $table->addColumn('client_site_domain', function ($row) {
                return $row->client_site ? $row->client_site->domain : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client_payment_method', 'client_site']);

            return $table->make(true);
        }

        $client_payment_methods = ClientPaymentMethod::get();
        $client_sites           = ClientSite::get();

        return view('panel.clientSitePaymentMethods.index', compact('client_payment_methods', 'client_sites'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_site_payment_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client_payment_methods = ClientPaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('panel.clientSitePaymentMethods.create', compact('client_payment_methods', 'client_sites'));
    }

    public function store(StoreClientSitePaymentMethodRequest $request)
    {
        $clientSitePaymentMethod = ClientSitePaymentMethod::create($request->all());

        return redirect()->route('panel.client-site-payment-methods.index');
    }

    public function edit(ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        abort_if(Gate::denies('client_site_payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client_payment_methods = ClientPaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientSitePaymentMethod->load('client_payment_method', 'client_site');

        return view('panel.clientSitePaymentMethods.edit', compact('clientSitePaymentMethod', 'client_payment_methods', 'client_sites'));
    }

    public function update(UpdateClientSitePaymentMethodRequest $request, ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        $clientSitePaymentMethod->update($request->all());

        return redirect()->route('panel.client-site-payment-methods.index');
    }

    public function show(ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        abort_if(Gate::denies('client_site_payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSitePaymentMethod->load('client_payment_method', 'client_site');

        return view('panel.clientSitePaymentMethods.show', compact('clientSitePaymentMethod'));
    }

    public function destroy(ClientSitePaymentMethod $clientSitePaymentMethod)
    {
        abort_if(Gate::denies('client_site_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSitePaymentMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientSitePaymentMethodRequest $request)
    {
        $clientSitePaymentMethods = ClientSitePaymentMethod::find(request('ids'));

        foreach ($clientSitePaymentMethods as $clientSitePaymentMethod) {
            $clientSitePaymentMethod->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
