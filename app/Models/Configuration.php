<?php


namespace App\Models;

use CodeIgniter\Model;

class Configuration extends Model
{
    protected $table = 'configurations';
    protected $primaryKey = 'id';
    protected $allowedFields    = ['name_app', 'register', 'background_image', 'background_img_vertical', 'primary_color', 'secundary_color', 'captcha'];

}