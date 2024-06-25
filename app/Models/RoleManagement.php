<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleManagement extends Model
{
    use HasFactory;
    protected $fillable = ["role", "browse_posts", "read_posts", "create_posts", "edit_posts", "delete_posts", "posted_by", "updated_by"];
}
