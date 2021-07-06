<?php

namespace app\entities;

class User extends Entity
{
    public $id;
    public $name;
    public $login;
    public $password;
    public $is_admin;
    public $position;
    public $avatar;
}