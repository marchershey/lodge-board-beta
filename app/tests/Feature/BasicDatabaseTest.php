<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('basic database test', function () {
    $user = User::factory()->create();

    $this->assertModelExists($user);
});
