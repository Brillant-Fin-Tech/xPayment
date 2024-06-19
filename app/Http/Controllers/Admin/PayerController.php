<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPayerRequest;
use App\Http\Requests\StorePayerRequest;
use App\Http\Requests\UpdatePayerRequest;
use App\Models\Payer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PayerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('payer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Payer::query()->select(sprintf('%s.*', (new Payer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'payer_show';
                $editGate      = 'payer_edit';
                $deleteGate    = 'payer_delete';
                $crudRoutePart = 'payers';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('sumsub_token', function ($row) {
                return $row->sumsub_token ? $row->sumsub_token : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.payers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payers.create');
    }

    public function store(StorePayerRequest $request)
    {
        $payer = Payer::create($request->all());

        return redirect()->route('admin.payers.index');
    }

    public function edit(Payer $payer)
    {
        abort_if(Gate::denies('payer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payers.edit', compact('payer'));
    }

    public function update(UpdatePayerRequest $request, Payer $payer)
    {
        $payer->update($request->all());

        return redirect()->route('admin.payers.index');
    }

    public function show(Payer $payer)
    {
        abort_if(Gate::denies('payer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payer->load('payerTransactionxes', 'payerPayerSites');

        return view('admin.payers.show', compact('payer'));
    }

    public function destroy(Payer $payer)
    {
        abort_if(Gate::denies('payer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payer->delete();

        return back();
    }

    public function massDestroy(MassDestroyPayerRequest $request)
    {
        $payers = Payer::find(request('ids'));

        foreach ($payers as $payer) {
            $payer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
