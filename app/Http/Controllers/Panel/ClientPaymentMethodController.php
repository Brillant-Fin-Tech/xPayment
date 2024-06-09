<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientPaymentMethodRequest;
use App\Http\Requests\StoreClientPaymentMethodRequest;
use App\Http\Requests\UpdateClientPaymentMethodRequest;
use App\Models\Client;
use App\Models\ClientPaymentMethod;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientPaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientPaymentMethod::with(['client', 'payment_method'])->select(sprintf('%s.*', (new ClientPaymentMethod)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'client_payment_method_show';
                $editGate = 'client_payment_method_edit';
                $deleteGate = 'client_payment_method_delete';
                $crudRoutePart = 'client-payment-methods';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'payment_method']);

            return $table->make(true);
        }

        $clients = Client::get();
        $payment_methods = PaymentMethod::get();

        return view('panel.clientPaymentMethods.index', compact('clients', 'payment_methods'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_payment_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('panel.clientPaymentMethods.create', compact('clients', 'payment_methods'));
    }

    public function store(StoreClientPaymentMethodRequest $request)
    {
        if (!ClientPaymentMethod::where("client_id", $request->client_id)->where("payment_method_id", $request->payment_method_id)->exists()) {
            $clientPaymentMethod = ClientPaymentMethod::create($request->all());
        }
        return redirect()->route('panel.clients.show', $request->client_id);
    }

    public function edit(ClientPaymentMethod $clientPaymentMethod)
    {
        abort_if(Gate::denies('client_payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientPaymentMethod->load('client', 'payment_method');

        return view('panel.clientPaymentMethods.edit', compact('clientPaymentMethod', 'clients', 'payment_methods'));
    }

    public function update(UpdateClientPaymentMethodRequest $request, ClientPaymentMethod $clientPaymentMethod)
    {
        $clientPaymentMethod->update($request->all());

        return redirect()->route('panel.client-payment-methods.index');
    }

    public function show(ClientPaymentMethod $clientPaymentMethod)
    {
        abort_if(Gate::denies('client_payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPaymentMethod->load('client', 'payment_method');

        return view('panel.clientPaymentMethods.show', compact('clientPaymentMethod'));
    }

    public function destroy(ClientPaymentMethod $clientPaymentMethod)
    {
        abort_if(Gate::denies('client_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPaymentMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientPaymentMethodRequest $request)
    {
        $clientPaymentMethods = ClientPaymentMethod::find(request('ids'));

        foreach ($clientPaymentMethods as $clientPaymentMethod) {
            $clientPaymentMethod->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
