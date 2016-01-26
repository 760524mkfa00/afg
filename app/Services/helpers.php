<?php

function sort_projects_by($column, $body)
{

    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
    return link_to_route('projects', $body, ['sortBy' => $column, 'direction' => $direction]);
}
