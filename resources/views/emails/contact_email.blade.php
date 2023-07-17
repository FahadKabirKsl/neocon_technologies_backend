@component('mail::message')
<img src="{{ asset('assets/images/email/neocon_technologies_logo.svg') }}" class="logo" alt="Neocon Technologies Logo"
        style="margin-bottom: 20px;">

<div class="fs-6" style="text-align: left">
        <h3 class="my-4">Contact With Us</h3>
        <b>Name:</b> {{ $name }}<br>
        <b>Email:</b> {{ $email }}<br>
        <b>Phone Number:</b> {{ $phoneNumber }}<br>
        <b>Inquiry:</b> {{ $inquiry }}<br>
        <b>Reason:</b> {!! $reason !!}<br>
</div>

@component('mail::button', ['url' => 'https://www.neocongroup.com/'])
Visit our website
@endcomponent

Thanks,<br>
Neocon Technologies Limited

<!-- {{ config('app.name') }} -->

@endcomponent
