<x-mail::message>
# Hai {{ ucwords($name) }}

Selamat Datang di {{ env('APP_NAME') }},

Silahkan Aktivasi akun anda melanjutkan menggunakan perangkat pintar dari Smart.Extension

<x-mail::button :url="$url" color="success">
Aktivasi Akun
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
