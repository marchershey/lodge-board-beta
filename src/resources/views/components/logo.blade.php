<div class="flex items-center justify-center space-x-4">
    <div class="p-1.5 text-white rounded-full bg-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z"></path>
            <path d="M15 9h.01"></path>
        </svg>
    </div>
    <div class="flex flex-1">
        <div class="flex items-center space-x-1 items-">
            <h1 class="flex text-3xl font-black tracking-tight uppercase @if ($dark) !text-gray-800 @else text-white @endif">
                <span class=" text-primary dark:text-primary">Lodge</span>
                <span class="text-gray-700 dark:text-white">Board</span>
            </h1>
            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-white rounded-lg bg-primary ring-1 ring-inset">
                {{ config('app.build') }}
            </span>
        </div>
    </div>
</div>
