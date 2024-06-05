<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\Admin\TeamResource;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamResource(Team::with(['payment_methoods', 'owner'])->get());
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->all());
        $team->payment_methoods()->sync($request->input('payment_methoods', []));

        return (new TeamResource($team))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamResource($team->load(['payment_methoods', 'owner']));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());
        $team->payment_methoods()->sync($request->input('payment_methoods', []));

        return (new TeamResource($team))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Team $team)
    {
        abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
