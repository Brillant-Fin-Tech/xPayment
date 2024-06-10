<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientSiteRequest;
use App\Http\Requests\StoreClientSiteRequest;
use App\Http\Requests\UpdateClientSiteRequest;
use App\Models\Client;
use App\Models\ClientSite;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientSiteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_site_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientSite::with(['client', 'payment_methods'])->select(sprintf('%s.*', (new ClientSite)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_site_show';
                $editGate      = 'client_site_edit';
                $deleteGate    = 'client_site_delete';
                $crudRoutePart = 'client-sites';

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
            $table->editColumn('domain', function ($row) {
                return $row->domain ? $row->domain : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('payment_method', function ($row) {
                $labels = [];
                foreach ($row->payment_methods as $payment_method) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $payment_method->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'payment_method']);

            return $table->make(true);
        }

        $clients         = Client::get();
        $payment_methods = PaymentMethod::get();

        return view('admin.clientSites.index', compact('clients', 'payment_methods'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id');

        return view('admin.clientSites.create', compact('clients', 'payment_methods'));
    }

    public function store(StoreClientSiteRequest $request)
    {
        $clientSite = ClientSite::create($request->all());
        $clientSite->payment_methods()->sync($request->input('payment_methods', []));

        return redirect()->route('admin.client-sites.index');
    }

    public function edit(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id');

        $clientSite->load('client', 'payment_methods');

        return view('admin.clientSites.edit', compact('clientSite', 'clients', 'payment_methods'));
    }

    public function update(UpdateClientSiteRequest $request, ClientSite $clientSite)
    {
        $clientSite->update($request->all());
        $clientSite->payment_methods()->sync($request->input('payment_methods', []));

        return redirect()->route('admin.client-sites.index');
    }

    public function show(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSite->load('client', 'payment_methods', 'clientSiteClientSiteTokens');

        return view('admin.clientSites.show', compact('clientSite'));
    }

    public function destroy(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSite->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientSiteRequest $request)
    {
        $clientSites = ClientSite::find(request('ids'));

        foreach ($clientSites as $clientSite) {
            $clientSite->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
