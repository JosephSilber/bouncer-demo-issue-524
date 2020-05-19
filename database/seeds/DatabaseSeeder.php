<?php

use App\Account;
use App\CcrEvent;
use App\CcrTeam;
use App\Member;
use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        /*
        * Admin role and permissions
        */
        Bouncer::role()->firstOrCreate(
            [
                'name'  => 'admin',
                'title' => 'Administrateur',
            ]
        );
        Bouncer::allow('admin')->everything();

        /*
        * Responsible role and permissions
        */
        Bouncer::role()->firstOrCreate(
            [
                'name'  => 'responsible',
                'title' => 'Responsable d\'association',
            ]
        );
        Bouncer::allow('responsible')->to('index', Account::class);
        Bouncer::allow('responsible')->to('index', CcrEvent::class);
        Bouncer::allow('responsible')->to('index', CcrTeam::class);
        Bouncer::allow('responsible')->to('index', Member::class);
        Bouncer::allow('responsible')->to('index', Team::class);

        /*
        * Coach role and permissions
        */
        Bouncer::role()->firstOrCreate(
            [
                'name'  => 'coach',
                'title' => 'Entraîneur en chef',
            ]
        );
        Bouncer::allow('coach')->to('index', Member::class);
        Bouncer::allow('coach')->to('index', Team::class);

        /*
        * Referee role
        */
        Bouncer::role()->firstOrCreate(
            [
                'name'  => 'referee',
                'title' => 'Arbitre',
            ]
        );
        Bouncer::allow('referee')->to('referee', CcrEvent::class);

        /*
        * Extra abilities
        */
        Bouncer::ability()->firstOrCreate(
            [
                'name'  => 'can-access-panel',
                'title' => 'Can access panel',
            ]
        );

        factory(User::class, 1000)->create();

        $users = User::where('is_superuser', 1)->get();

        foreach ($users as $user) {
            $user->allow('can-access-panel');
        }
    }
}
