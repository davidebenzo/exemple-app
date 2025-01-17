<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    use SoftDeletes;

   

    protected $dates = ['deleted_at'];

   

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = ['user_id', 'commercial_activity_id', 'parent_id', 'body'];

   

    /**

     * The belongs to Relationship

     *

     * @var array

     */

    public function user()

    {

        return $this->belongsTo(User::class);

    }

   

    /**

     * The has Many Relationship

     *

     * @var array

     */

    public function replies()

    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function commercialActivity()
    {
        return $this->belongsTo(CommercialActivity::class);
    }


    public function reactions()

    {
        return $this->hasMany(ReactionComment::class, 'comment_id');
    }


}
