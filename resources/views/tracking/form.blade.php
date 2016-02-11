<div class="form-group">
    {!! Form::label('description', 'Description of Commitments Against Budget:') !!}
    {!! Form::text('description', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('cvs', 'Contractor/Vendor/Supplier:') !!}
    {!! Form::text('cvs', NULL, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
</div>
