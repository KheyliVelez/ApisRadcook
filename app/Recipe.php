<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 *
 * @property $id
 * @property $name
 * @property $category
 * @property $description
 * @property $user_id
 * @property $image
 * @property $created_at
 * @property $updated_at
 *
 * @property RecipeIngredient[] $recipeIngredients
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Recipe extends Model
{
    static $rules = [
		'name' => 'required',
		'category' => 'required',
		'description' => 'required',
        'detail' => 'required',
        'photo' => 'required'
		/*'user_id' => 'required',
		'image_id' => 'required',
        */
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','category','description','detail', 'user_id','image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipeIngredients()
    {
        return $this->hasMany('App\RecipeIngredient', 'recipe_id', 'id');
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


}
