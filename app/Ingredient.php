<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ingredient
 *
 * @property $id
 * @property $name
 * @property $type
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property RecipeIngredient[] $recipeIngredients
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ingredient extends Model
{

    static $rules = [
		'name' => 'required',
		'type' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','type', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipeIngredients()
    {
        return $this->hasMany('App\RecipeIngredient', 'ingredient_id', 'id');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


}
