<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

function addBannerNotification($id = null, $content = null, $type = "info", $expire = null,)
{
    session()->push('banners', [
        'id' => $id ?? rand(),
        'type' => $type,
        'content' => $content,
        'expiration' => $expire ?? now()->addDay(),
    ]);
}

function removeBannerNotification($id)
{
    session()->forget('banner.' . $id);
}

function settings($type = 'general')
{
    switch ($type) {
        case 'general':
            return app(App\Settings\GeneralSettings::class);
        case 'setup':
            return app(App\Settings\SetupSettings::class);
        case 'dev':
            return app(App\Settings\DevSettings::class);
    }
}

function notify($message, $type = "info", $title = "")
{
    toast()->$type($message, $title)->push();
}

function devlog($action)
{
    if (settings('dev')->notifications) {
        toast()->debug($action)->push();
    }

    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln("Hello from Terminal");
}



/**
 * I was researching a few new Laravel practices and came across this neat little "attempt()"
 * helper function that Koel was utilizing. I thought it would be very helpful keeping
 * my error handling uniform. So here's their credit on this idea.
 *
 * Credit: https://github.com/koel/koel/blob/master/app/Helpers.php
 *
 * P.S. The attempt(), attemptIf(), & attemptUnless().
 *
 * @throws Throwable
 * @return null;
 */
function attempt(callable $callback, ...$args): mixed
{
    // // Generate attemp ID:
    // $id = "(" . rand(1000, 9999) . ") ";

    // Log::info($id . 'Starting new attempt...');

    // // First, get the information of the user who is starting this attempt function.
    // $user = collect(Auth::user())->toArray(); // "collect()" to satifiy vscode.
    // Log::info($id . 'User information:');
    // Log::info($user);

    // // Second, get the caller of the attempt function (the backtrace info)
    // $backtrace = debug_backtrace();
    // $comment = end($backtrace[0]['args']);
    // $caller_file = $backtrace[0]['file'];
    // $caller_line = $backtrace[0]['line'];

    try {
        return $callback(...$args);
    } catch (Throwable $e) {
        // Build the report information
        // $user = [
        //     auth()->user()->id,
        // ];
        $backtrace = debug_backtrace();
        $comment = end($backtrace[0]['args']);
        $caller_file = $backtrace[0]['file'];
        $caller_line = $backtrace[0]['line'];

        // Log::info('User Info', auth()->user()->toArray());
        Log::info($comment);
        Log::info($caller_file);
        Log::info($caller_line);


        // Idk if I want to use this or not. Let's come back to this.
        // report($e);

        // If running unit tests, throw the throwable
        if (app()->runningUnitTests()) {
            throw $e;
        }

        // Format and log the error
        Log::emergency(['error' => collect($e->getMessage())->toArray()]);


        // Dispatch a notification for the user to see
        toast()->danger('Please refresh the page and try again.', 'Server Error')->sticky()->push();
        // Dispatch a toast for the developer to see, but only if the environment is local
        if (app()->isLocal()) {
            toast()->debug($e->getMessage())->sticky()->push();
        }

        return null;
    }
}

// function attemptIf(string $action, $condition, callable $callback, bool $log = true): mixed
// {
//     return value($condition) ? attempt($action, $callback) : null;
// }

// function attemptUnless(string $action, $condition, callable $callback, bool $log = true): mixed
// {
//     return !value($condition) ? attempt($callback) : null;
// }

/**
 * Global Validate Function
 *
 */
// function validate($that, bool $showError = false): mixed
// {
//     $that->withValidator(function (Validator $validator) {
//         $validator->after(function ($validator) {
//             if (count($validator->errors()) > 0) {
//                 $error = $validator->errors()->first();
//                 ($showError) ? toast()->danger($error, 'Validation Error')->push() : toast()->danger

//             }
//         });
//     })->validate();

//     return null;
// }
