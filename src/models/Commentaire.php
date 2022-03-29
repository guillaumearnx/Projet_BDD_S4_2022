<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

/**
 * @method static create(array $array)
 */
class Commentaire extends Model
{

    protected $table = 'commentaire';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public function jeu() : belongsTo
    {
        return $this->belongsTo('gamepedia\models\Jeu', 'id_game');
    }
}