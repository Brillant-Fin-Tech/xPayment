<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionxRequest;
use App\Http\Requests\StoreTransactionxRequest;
use App\Http\Requests\UpdateTransactionxRequest;
use App\Models\Client;
use App\Models\ClientSite;
use App\Models\Payer;
use App\Models\PaymentMethod;
use App\Models\Transactionx;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionxController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transactionx_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transactionx::with(['payer', 'payment_method', 'site', 'client'])->select(sprintf('%s.*', (new Transactionx)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transactionx_show';
                $editGate      = 'transactionx_edit';
                $deleteGate    = 'transactionx_delete';
                $crudRoutePart = 'transactionxes';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? Transactionx::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('commission_rate', function ($row) {
                return $row->commission_rate ? $row->commission_rate : '';
            });
            $table->editColumn('commission', function ($row) {
                return $row->commission ? $row->commission : '';
            });
            $table->editColumn('amount_net', function ($row) {
                return $row->amount_net ? $row->amount_net : '';
            });

            $table->addColumn('payer_first_name', function ($row) {
                return $row->payer ? $row->payer->first_name : '';
            });

            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->addColumn('site_domain', function ($row) {
                return $row->site ? $row->site->domain : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'payer', 'payment_method', 'site', 'client']);

            return $table->make(true);
        }

        $payers          = Payer::get();
        $payment_methods = PaymentMethod::get();
        $client_sites    = ClientSite::get();
        $clients         = Client::get();

        return view('admin.transactionxes.index', compact('payers', 'payment_methods', 'client_sites', 'clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('transactionx_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionxes.create', compact('clients', 'payers', 'payment_methods', 'sites'));
    }

    public function store(StoreTransactionxRequest $request)
    {
        $transactionx = Transactionx::create($request->all());

        return redirect()->route('admin.transactionxes.index');
    }

    public function edit(Transactionx $transactionx)
    {
        abort_if(Gate::denies('transactionx_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payers = Payer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sites = ClientSite::pluck('domain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionx->load('payer', 'payment_method', 'site', 'client');

        return view('admin.transactionxes.edit', compact('clients', 'payers', 'payment_methods', 'sites', 'transactionx'));
    }

    public function update(UpdateTransactionxRequest $request, Transactionx $transactionx)
    {
        $transactionx->update($request->all());

        return redirect()->route('admin.transactionxes.index');
    }

    public function show(Transactionx $transactionx)
    {
        abort_if(Gate::denies('transactionx_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionx->load('payer', 'payment_method', 'site', 'client');

        return view('admin.transactionxes.show', compact('transactionx'));
    }

    public function destroy(Transactionx $transactionx)
    {
        abort_if(Gate::denies('transactionx_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionx->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionxRequest $request)
    {
        $transactionxes = Transactionx::find(request('ids'));

        foreach ($transactionxes as $transactionx) {
            $transactionx->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
