<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cim') ? 'has-error' : ''}}">
    {!! Form::label('cim', 'Cim', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cim', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cim', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tel') ? 'has-error' : ''}}">
    {!! Form::label('tel', 'Tel', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tel', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tel', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('birth') ? 'has-error' : ''}}">
    {!! Form::label('birth', 'Birth', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('birth', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('birth', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('statusz') ? 'has-error' : ''}}">
    {!! Form::label('statusz', 'Statusz', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('statusz', ['Állandó', 'alkalmi', 'diák'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('statusz', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>