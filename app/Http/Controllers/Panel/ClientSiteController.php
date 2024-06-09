<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientSiteRequest;
use App\Http\Requests\StoreClientSiteRequest;
use App\Http\Requests\UpdateClientSiteRequest;
use App\Models\Client;
use App\Models\ClientSite;
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
            $query = ClientSite::with(['client'])->select(sprintf('%s.*', (new ClientSite)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_site_show';
                $editGate      = 'client_site_edit';
                $deleteGate    = 'client_site_delete';
                $crudRoutePart = 'client-sites';

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
            $table->editColumn('domain', function ($row) {
                return $row->domain ? $row->domain : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client']);

            return $table->make(true);
        }

        $clients = Client::get();

        return view('panel.clientSites.index', compact('clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('panel.clientSites.create', compact('clients'));
    }

    public function store(StoreClientSiteRequest $request)
    {

        if (!ClientSite::where("domain", $request->domain)->exists()) {
            $clientSite = ClientSite::create($request->all());
        }
        return redirect()->route('panel.clients.show', $request->client_id);

    }

    public function edit(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientSite->load('client');

        return view('panel.clientSites.edit', compact('clientSite', 'clients'));
    }

    public function update(UpdateClientSiteRequest $request, ClientSite $clientSite)
    {
        $clientSite->update($request->all());

        return redirect()->route('panel.client-sites.index');
    }

    public function show(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSite->load('client', 'clientSiteClientSiteTokens', 'clientSiteClientSitePaymentMethods');

        return view('panel.clientSites.show', compact('clientSite'));
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
