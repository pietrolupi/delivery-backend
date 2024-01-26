<div class="container">
    <p>
        Hai ricevuto un nuovo messaggio da: {{ $lead->name }} <br>
        Indirizzo email: {{ $lead->email }} <br>
        Messaggio: {{ $lead->message }} <br>
        Indirizzo di casa: {{ $lead->address }} <br>
        Telefono: {{ $lead->phone }} <br>
        Questa mail è destinata al venditore!!!!
    </p>
    {{-- <p>
        Ordine effettutato : {{ $order->name }} <br>
        Spesa totale: {{ $order->email }} <br>
        Nome del cliente {{ $order->message }} <br>
        Indirizzo del cliente {{ $order->address }} <br>
        Email del cliente: {{ $order->phone }} <br>
        Numero di telefono del cliente: {{ $order->phone }}
    </p> --}}
</div>
