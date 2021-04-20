<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
	/**
	 * Validate and create a new team for the given user.
	 *
	 * @param mixed $user
	 * @param array $input
	 * @return mixed
	 * @throws AuthorizationException
	 * @throws ValidationException
	 */
	public function create($user, array $input): Team
	{
		Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

		Validator::make($input, [
			'name' => ['required', 'string', 'max:255'],
		])->validateWithBag('createTeam');

		AddingTeam::dispatch($user);

		$team = $user->ownedTeams()->create([
			'name' => $input['name'],
			'personal_team' => false,
		]);

		$user->switchTeam($team);

		return $team;
	}
}
