<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('rendering setup index', function () {
    $request = $this->get('/setup');
    $request->assertStatus(200);
})->group('setup');

/**
 * Setup Steps
 * Testing to ensure that each step of the setup can render
 */
test('setup steps can render', function () {
    // Setup welcome
    $component = Livewire::test(App\Http\Pages\Setup\SetupIndex::class);
    $component->set('current_step', 1);
    $component->assertSet('current_step', 1);
    $component->assertSee('Welcome to LodgeBoard');
    $component->call('nextStep');
    // Host Account
    $component->assertSet('current_step', 2);
    $component->assertDontSee('Welcome to LodgeBoard');
    $component->assertSee('What are Host accounts?'); // "What are host accounts" button
    $component->call('nextStep');
    // Site Config
    $component->assertSet('current_step', 3);
    $component->assertDontSee('What are Host accounts?');
    $component->assertSee('Welcome aboard'); // "What are host accounts" button
    $component->call('nextStep');
    // First Rental
    $component->assertSet('current_step', 4);
    $component->assertDontSee('Welcome aboard');
    $component->assertSee('First Rental'); // "What are host accounts" button
    $component->call('nextStep');
    // Rental Photos
    $component->assertSet('current_step', 5);
    $component->assertDontSee('first rental');
    $component->assertSee('Rental Photos'); // "What are host accounts" button
    $component->call('nextStep');
})->group('setup')->todo();

/**
 * Setup Step: Welcome
 * Testing to ensure that when the user presses the continue button, the setup continues
 */
test('setup step (welcome) can render and continue', function () {
    $setup = Livewire::test(\App\Http\Pages\Setup\SetupIndex::class);
    $setup->set('current_step', 1); // wire:init="load" sets the current step to 1

    $welcome = Livewire::test(App\Http\Pages\Setup\Steps\Welcome::class);
    $welcome->call('continue'); // User presses continue button
    $welcome->assertDispatched('next-step');

    // $setup->assertSet('current_step', 2);
    // $welcome->assertSee('Welcome to LodgeBoard'); // Do we see the welcome page?
    // $component->call('continue');
    // $component->set('current_step', 2);
})->group('setup');

test('setup step (host account) can render and continue', function () {
    $component = Livewire::test(App\Http\Pages\Setup\SetupIndex::class);
    $component->set('current_step', 1);
    $component->assertSee('Welcome to LodgeBoard');
    $component->call('nextStep');
    $component->set('current_step', 2);
})->group('setup');
