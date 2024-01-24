<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    // Get the list of timezones
    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');

    foreach ($timezones as $timezone) {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    arsort($timezone_offsets);

    foreach ($timezone_offsets as $timezone => $offset) {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate('H:i', abs($offset));
        $pretty_offset = $offset_prefix . $offset_formatted;
        $timezone_list[$timezone] = "(UTC" . $pretty_offset . ") " . $timezone;
    }

    return $timezone_list;
}

function state_list()
{
    return [
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AS' => 'American Samoa',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Delaware',
        'DC' => 'District Of Columbia',
        'FM' => 'Federated States Of Micronesia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'GU' => 'Guam Gu',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MH' => 'Marshall Islands',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'MP' => 'Northern Mariana Islands',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PW' => 'Palau',
        'PA' => 'Pennsylvania',
        'PR' => 'Puerto Rico',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VI' => 'Virgin Islands',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming',
        'AE' => 'Armed Forces Africa \ Canada \ Europe \ Middle East',
        'AA' => 'Armed Forces America (Except Canada)',
        'AP' => 'Armed Forces Pacific'
    ];
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
        $user = [
            auth()->user()->id;
        ];
        $backtrace = debug_backtrace();
        $comment = end($backtrace[0]['args']);
        $caller_file = $backtrace[0]['file'];
        $caller_line = $backtrace[0]['line'];

        Log::info('User Info', auth()->user()->toArray());
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
