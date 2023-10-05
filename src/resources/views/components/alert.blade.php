<div x-data="{
    alertType: {{ $type }}
}">
    <div class="alert-container alert-type-error">
        @if ($title)
            <h2 class="alert-title">{{ $title }}</h2>
        @endif
        <div class="alert-body">
            {{ $slot }}
        </div>
    </div>
</div>
