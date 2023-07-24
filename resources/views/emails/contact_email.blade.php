<!DOCTYPE html>
<html>

<head>
    <title>Contact Confirmation</title>
</head>

<body>
    <img src='https://www.neocongroup.com/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fneocon-group.d5170fda.png&w=750&q=75&dpl=dpl_DVkvmnZ4PB7iFskCansCC1gQjTum'
        class="logo " alt="Neocon Technologies Logo" style="display: block;margin-left:auto;margin-right:auto"
        height="50" width="150">
    <h2>Hi {{ $name }},</h2>
    <p>Your inquiry has been received. Here are the details:</p>
    <ul style="list-style-type:none">
        <li><b>Name: </b>{{ $name }}</li>
        <li><b>Email:</b> {{ $email }}</li>
        <li><b>Phone Number:</b> {{ $phoneNumber }}</li>
        <li><b>Inquiry:</b> {{ $inquiry }}</li>
        <li><b>Reason:</b> {{ $reason }}</li>
    </ul>
    <p>Thank you for contacting us. We will get back to you soon.</p>

    <p>Thanks,<br>Neocon Technologies Limited</p>
    <a href="https://www.neocongroup.com/" style="color: #fe3b00,">Visit our website</a>
</body>

</html>
{{-- @component('mail::message')
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

@endcomponent --}}
