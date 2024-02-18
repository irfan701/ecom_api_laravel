<x-mail::message>

    Email Verification

    <x-mail::button :url="$url">
        Proceed Email Verify
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
