<?php $counter = 0; ?>
@foreach($quotes as $quote)
    @if ($counter++%2 === 0)
    <div class="row">
    @endif
        <div class="col-md-6">
            @include('qdb::quotes._partial', ['quote' => ['data' => ['quote' => $quote]]])
        </div>
    @if ($counter%2 === 0)
    </div>
    @endif
@endforeach
