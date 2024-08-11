<?php

use App\Filament\Resources\Shield\RoleResource;
use App\Filament\Resources\Shield\RoleResource\Pages\ListRoles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;


uses(RefreshDatabase::class);

it('can render list page', function () {
    $this->actingAs(User::findOrFail(1));
    $this->get(RoleResource::getUrl('index'))->assertSuccessful();
});

it('can list Role', function () {
    // $roles = Role::factory()->count(10)->create();
    $roles = Role::all();

    livewire(ListRoles::class)
        ->assertCanSeeTableRecords($roles);
});
