@if(isset($qdbChannels) && count($qdbChannels))
    <div class="list-group">
        @foreach($qdbChannels as $channel)
            <a href="{{ URL::Route('pxcms.qdb.channel', urlencode($channel['channel'])) }}" class="list-group-item{{ Route::is('pxcms.qdb.channel') ? ' active' : '' }}" rel="nofollow">
                <span class="badge">{{ $channel['quote_count'] }}</span>
                {{ $channel['channel'] }}
            </a>
        @endforeach
    </div>
@endif
