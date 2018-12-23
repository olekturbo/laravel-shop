<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the decoded images array.
     *
     * @return array
     */
    public function getDecodedImagesAttribute()
    {
        return json_decode($this->images);
    }

    /**
     * Get the decoded sizes array.
     *
     * @return array
     */
    public function GetDecodedSizesAttribute()
    {
        return json_decode($this->size);
    }

    /**
     * Get the front image from array.
     *
     * @return string
     */
    public function getFrontImageAttribute()
    {
        return json_decode($this->images)[0] ?? "";
    }

    /**
     * Get the back image from array.
     *
     * @return string
     */
    public function getBackImageAttribute()
    {
        return json_decode($this->images)[1] ?? "";
    }

    /**
     * Get the category of the product.
     */
    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }
}
