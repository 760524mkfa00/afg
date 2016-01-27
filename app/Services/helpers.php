<?php

function sort_projects_by($column, $body)
{

    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
    $search = (Request::get('str')) ? Request::get('str') : '';
    $year = (Request::get('year')) ? Request::get('year') : '';
    return link_to_route('projects', $body, ['sortBy' => $column, 'direction' => $direction, 'str' => $search, 'year' => $year]);
}


