<div class="px-3 py-2 m-5 bg-white border border-gray-300 rounded-full shadow-2xl cursor-pointer dark:border-gray-700 dark:bg-gray-800 group">
    <div class="flex items-center space-x-2">
        <div class="mt-px">
            @include('tall-toasts::includes.icon')
        </div>
        <div class="w-full">
            {{-- Title --}}
            <div class="font-medium" x-html="toast.title" x-show="toast.title !== undefined" :class="{
                'text-blue-600 dark:text-blue-500': toast.type === 'info',
                'text-green-600 dark:text-green-500': toast.type === 'success',
                'text-yellow-600 dark:text-yellow-500': toast.type === 'warning',
            
                'text-red-500': toast.type === 'danger',
                '': toast.type === 'debug',
            }"></div>
            {{-- Message --}}
            <div class="text-sm leading-5" x-show="toast.message !== undefined" x-html="toast.message" :class="{
                '!leading-4 text-muted dark:text-muted-lighter mb-1': toast.title, // if toast has a title, make the text smaller, 
            }"></div>
        </div>

        <button class="block">
            {{-- Close button --}}
            <svg class="w-5 h-5 group-hover:text-muted-dark dark:group-hover:text-white text-muted-lighter dark:text-muted-dark" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</div>
