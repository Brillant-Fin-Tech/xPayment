<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientSiteRequest;
use App\Http\Requests\StoreClientSiteRequest;
use App\Http\Requests\UpdateClientSiteRequest;
use App\Models\Client;
use App\Models\ClientPaymentMethod;
use App\Models\ClientSite;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        return view('panel.clientSites.index', compact('clients', 'payment_methods'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('client_site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $client = Client::where("id",$request->client_id)->firstOrFail();
        $payment_methods = $client->clientClientPaymentMethods()->pluck('name', 'id');

        return view('panel.clientSites.create', compact('payment_methods'));
    }

    public function store(StoreClientSiteRequest $request)
    {

        if (!ClientSite::where("domain", $request->domain)->exists()) {

            $clientSite = ClientSite::create($request->all());

            $client_payment_methods =  $request->input('payment_methods', []);
            $clientSite->payment_methods()->sync([]);
            $clientSite->clientSiteClientSiteTokens()->create([
                'token'=>Str::random(60),
                'expires_at'=>"2030-01-01 00:00:00",
                'is_active'=>1
            ]);
            foreach ($client_payment_methods as $item){
                $payment_methods = ClientPaymentMethod::where("id",$item)->first();
                $clientSite->payment_methods()->attach($payment_methods->payment_method_id);
            }
        }

        return redirect()->route('panel.clients.show',$request->client_id);
    }

    public function edit(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id');

        $clientSite->load('client', 'payment_methods');

        return view('panel.clientSites.edit', compact('clientSite', 'clients', 'payment_methods'));
    }

    public function update(UpdateClientSiteRequest $request, ClientSite $clientSite)
    {
        $clientSite->update($request->all());
        $clientSite->payment_methods()->sync($request->input('payment_methods', []));

        return redirect()->route('panel.client-sites.index');
    }

    public function show(ClientSite $clientSite)
    {
        abort_if(Gate::denies('client_site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientSite->load('client', 'payment_methods', 'clientSiteClientSiteTokens');

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
