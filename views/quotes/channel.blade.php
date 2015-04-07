<div class="row">
    <div class="col-md-10">
        @include(partial('core::partials._pagination'), ['object' => $quotes])
    </div>
    <div class="col-md-2">
        <a href="{{ URL::route('pxcms.qdb.all', ['channel' => urlencode(array_get($channel, 'channel'))]) }}" class="btn btn-info pull-right" style="margin: 20px 0;">View All Quotes</a>
    </div>
    <div class="clearfix"></div>
</div>

@foreach($quotes as $quote)
    @include('qdb::quotes._partial', ['quote' => ['data' => ['quote' => $quote]]])
@endforeach

@include(partial('core::partials._pagination'), ['object' => $quotes])
