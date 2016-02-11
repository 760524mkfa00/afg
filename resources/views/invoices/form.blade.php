{!! Form::hidden('tracking_id', $team) !!}

<div class="form-group">
    {!! Form::label('scope', 'Scope of work:') !!}
    {!! Form::text('scope', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('invoice', 'Invoice #:') !!}
    {!! Form::text('invoice', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('fees', 'Fees:') !!}
    {!! Form::text('fees', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('holdback', 'Hold Back (will be a check box):') !!}
    {!! Form::text('holdback', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('disbursements', 'Disbursements:') !!}
    {!! Form::text('disbursements', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('taxRate_id', 'Tax Rate(will be a drop down):') !!}
    {!! Form::text('taxRate_id', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
</div>
