{{--<div class="col-md-offset-4 col-md-4">--}}
    <div class="form-group">
        {!! Form::label('project_number', 'Project Number:') !!}
        {!! Form::text('project_number', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('region_id', 'Region:') !!}
        {!! Form::select('region_id', $regions, null, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', $categories, null, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('location_id', 'Location:') !!}
        {!! Form::select('location_id', $locations, null, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('project_description', 'Project Description:') !!}
        {!! Form::textarea('project_description', NULL, array('class' => 'form-control', 'rows' => '2', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('client_id', 'Client:') !!}
        {!! Form::select('client_id', $clients, null, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('priority_number', 'Priority Number:') !!}
        {!! Form::text('priority_number', NULL, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('priority_id', 'Priority:') !!}
        {!! Form::select('priority_id', $priorities, null, array('class' => 'form-control', 'required')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('year', 'Year:') !!}
        {!! Form::text('year', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('estimate', 'Estimate:') !!}
        {!! Form::text('estimate', NULL, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('manager_id', 'Manager:') !!}
        {!! Form::select('manager_id', $managers, null, array('class' => 'form-control')) !!}
    </div>

    <hr/>

    <div class="form-group">
        {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
    </div>
{{--</div>--}}