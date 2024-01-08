@extends('layouts.main')

@section('content')
<div class="home-background-main">
<div class="contact-wrapper">
        <div class="contact-background" style="background-image: url('{{ asset('images/background3.jpg') }}')"> </div>
        <div class="contact-text">
        <h3>Susisiekime</h3>
        <p> <span style="font-weight: 600">Tel. nr.:</span> +370 12 345 678</p>
        <p> <span style="font-weight: 600">Adresas:</span> Didlaukio g. 47</p>
        </div>
        <div class="google-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2303.856536846852!2d25.260938877132915!3d54.72973827032245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd913fbe6a26fb%3A0x3b2074b236abf4e9!2sMIF%20fakulteto%20pastatas%2C%20Didlaukio%20g.%2047%2C%2008303%20Vilnius!5e0!3m2!1sen!2slt!4v1704720222458!5m2!1sen!2slt" style="border:0; height:300px; width:450px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
        </div>
    </div>
</div>
@endsection


