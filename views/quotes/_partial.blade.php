<div class="well well-sm">
    <header class="row">
        <div class="col-md-12">
            <h4 class="row">
                <span class="col-md-9">Quote#{{{ array_get($quote, 'data.quote.quote_id', 0) }}} | {{{ array_get($quote, 'data.quote.channel.channel') }}}
                </span>
                <span class="col-md-3 text-right">
                    <a href="{{ URL::route('pxcms.qdb.view', ['channel' => urlencode(array_get($quote, 'data.quote.channel.channel')), 'quoteid' => array_get($quote, 'data.quote.quote_id', 0)])}}" title="Perma Link"><i class="fa fa-link"></i></a>
                </span>
            </h4>
        </div>
    </header>

    <blockquote>{{{ array_get($quote, 'data.quote.content') }}}</blockquote>

    <div class="well well-sm">
        <span class="col-md-6">Submitted {{{ array_get($quote, 'data.quote.created.fuzzy') }}}</span>
        <span class="col-md-6 text-right">- submitted by {{{ array_get($quote, 'data.quote.author') }}}</span>
        <span class="clearfix"></span>
    </div>
</div>
