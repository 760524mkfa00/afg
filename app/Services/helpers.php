<?php

function sort_projects_by($column, $body)
{
    return route('projects', $body, ['sortBy' => $column]);
}
