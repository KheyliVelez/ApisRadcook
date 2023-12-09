<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecipeIngredient
 *
 * @property $id
 * @property $recipe_id
 * @property $ingredient_id
 * @property $created_at
 * @property $updated_at
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RecipeIngredient extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['recipe_id','ingredient_id'];

    protected $table = 'recipe_ingredients';
}
