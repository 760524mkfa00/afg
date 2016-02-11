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

    {!! Form::label('holdback', '10% Hold Back:') !!}
    <br/>
    {!! Form::checkbox('holdback', NULL, NULL, array('class' => '')) !!}
</div>

<div class="form-group">
    {!! Form::label('disbursements', 'Disbursements:') !!}
    {!! Form::text('disbursements', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('taxRate_id', 'Tax Rate:') !!}
    {!! Form::select('taxRate_id', $tax, NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
</div>
