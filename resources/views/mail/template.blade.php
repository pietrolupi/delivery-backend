<div class="container">
    @if($userType === 'owner')
        <p>
            Hai ricevuto un nuovo messaggio da: {{ $lead->name }} <br>
            Indirizzo email: {{ $lead->email }} <br>
            Messaggio: {{ $lead->message }} <br>
            Indirizzo di casa: {{ $lead->address }} <br>
            Telefono: {{ $lead->phone }} <br>
            Questa mail è destinata al venditore!!!!
        </p>
    @else
        <p>
            Hai ricevuto un nuovo messaggio da: {{ $lead->name }} <br>
            Indirizzo email: {{ $lead->email }} <br>
            Messaggio: {{ $lead->message }} <br>
            Indirizzo di casa: {{ $lead->address }} <br>
            Telefono: {{ $lead->phone }} <br>
            Questa mail è destinata al cliente.
        </p>
    @endif
</div>
