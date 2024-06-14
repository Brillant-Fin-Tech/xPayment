<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientSiteTokenRequest;
use App\Http\Requests\StoreClientSiteTokenRequest;
use App\Http\Requests\UpdateClientSiteTokenRequest;
use App\Models\ClientSite;
use App\Models\ClientSiteToken;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientSiteTokenController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_site_token_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientSiteToken::with(['client_site'])->select(sprintf('%s.*', (new ClientSiteToken)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_site_token_show';
                $editGate      = 'client_site_token_edit';
                $deleteGate    = 'client_site_token_delete';
                $crudRoutePart = 'client-site-tokens';

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
            $table->editColumn('token', function ($row) {
                return $row->token ? $row->token : '';
            });

            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? ClientSiteToken::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->addColumn('client_site_domain', function ($row) {
                return $row->client_site ? $row->client_site->domain : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client_site']);

            return $table->make(true);
        }

        $client_sites = ClientSite::get();

        return view('panel.clientSiteTokens.index', compact('client_sites'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_site_token_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client_sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('panel.clientSiteTokens.create', compact('client_sites'));
    }

    public function store(StoreClientSiteTokenRequest $request)
    {
        $request["token"] =  Str::random(60);

        $clientSiteToken = ClientSiteToken::create($request->all());

        return redirect()->route('panel.client-sites.show',$request->client_site_id);
    }

    public function edit(ClientSiteToken $clientSiteToken)
    {
        abort_if(Gate::denies('client_site_token_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client_sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientSiteToken->load('client_site');

        return view('panel.clientSiteTokens.edit', compact('clientSiteToken', 'client_sites'));
    }

    public function update(UpdateClientSiteTokenRequest $request, ClientSiteToken $clientSiteToken)
    {
        $clientSiteToken->update($request->all());

        return redirect()->route('panel.client-site-tokens.index');
    }

    public function show(ClientSiteToken $clientSiteToken)
    {
        abort_if(Gate::denies('client_site_token_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSiteToken->load('client_site');

        return view('panel.clientSiteTokens.show', compact('clientSiteToken'));
    }

    public function destroy(ClientSiteToken $clientSiteToken)
    {
        abort_if(Gate::denies('client_site_token_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSiteToken->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientSiteTokenRequest $request)
    {
        $clientSiteTokens = ClientSiteToken::find(request('ids'));

        foreach ($clientSiteTokens as $clientSiteToken) {
            $clientSiteToken->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
