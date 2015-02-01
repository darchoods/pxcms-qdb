@foreach($quotes as $quote)
    @include('qdb::quotes._partial', ['quote' => ['data' => ['quote' => $quote]]])
@endforeach
