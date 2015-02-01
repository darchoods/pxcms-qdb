<div class="row">
    <div class="col-md-7">
    {{ Former::horizontal_open( URL::route('admin.config.store') ) }}
        {{ Form::Config('qdb::api.url')->label('Darchoods QDB Api URL') }}

        {{ Form::Config('qdb::api.key')->label('API Key') }}

        <button class="btn-labeled btn btn-success pull-right" type="submit">
            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span> Save
        </button>

    {{ Former::close() }}
    </div>
</div>
