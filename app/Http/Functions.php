<?php

function getModulesArray(){
    $a = [
        '0' => 'Products',
        '1' => 'Blog'
    ];

    return $a;
}

function getUserRole($mode, $role){
    $roles = [
        '0' => 'Guest',
        '1' => 'Administrator'
    ];

    if(!is_null($mode)){
        return $roles;
    }

    return $roles[$role];
}

function getUserStatus($mode, $id){
    $statues = [
        '0' => 'Registered',
        '1' => 'Verified',
        '100' => 'Banned',
    ];

    if(!is_null($mode)){
        return $statues;
    }
    return $statues[$id];
}
