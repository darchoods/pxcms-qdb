@foreach($quotes as $quote)
    @include(partial('qdb::quotes._partial'), ['quote' => $quote])
@endforeach
