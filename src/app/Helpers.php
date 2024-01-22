<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

function settings($type = 'general')
{
    switch ($type) {
        case 'general':
            return app(App\Settings\GeneralSettings::class);
        case 'setup':
            return app(App\Settings\SetupSettings::class);
    }
}

function timezone_list()
{
    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');

    $timezone_offsets = array();
    foreach ($timezones as $timezone) {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    arsort($timezone_offsets);

    $timezone_list = array();
    foreach ($timezone_offsets as $timezone => $offset) {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate('H:i', abs($offset));

        $pretty_offset = "UTC" . $offset_prefix . $offset_formatted;

        // $timezone_list[$timezone] = "(" . $pretty_offset . ") $timezone"; // "America/Kentucky/Louisville" => "(UTC-05:00) America/Kentucky/Louisville"
        $timezone_list[$timezone] = $timezone; // "America/Kentucky/Louisville" => "America/Kentucky/Louisville"
    }

    return $timezone_list;
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
function attempt($callback, string $action, bool $trace = false): mixed
{
    try {
        return $callback();
    } catch (Throwable $e) {

        // Idk if I want to use this or not. Let's come back to this.
        // report($e);

        // If running unit tests, throw the throwable
        if (app()->runningUnitTests()) {
            throw $e;
        }

        // Format and log the error
        Log::info('');
        Log::info('-------------------START-------------------');
        Log::info('');
        Log::error($action, ['error' => $e->getMessage()]);
        Log::info('--------------------END--------------------');
        Log::info('');


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
