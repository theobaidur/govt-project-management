<?php

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

function userHasRole($role){
    if(Auth::check() && Auth::user()->hasRole($role)){
        return true;
    }
    return false;
}

function _hasProject(){
    $id = (int)Request::query('project_id', -1);
    return $id != -1;
}

function _project($id = null){
    if(empty($id)){
        $id = Request::query('project_id');
    }
    return empty($id) ? null : Project::find($id);
}

function _url($url, $id=null){
    $id = Request::query('project_id', $id);
    if(!empty($id)){
        $url = "${url}?project_id=${id}";
    }
    return url($url);
}

function _project_home(){
    $id = Request::query('project_id');
    return _url("/admin/projects/${id}");
}

function _project_edit(){
    $id = Request::query('project_id');
    return _url("/admin/projects/${id}/edit");
}