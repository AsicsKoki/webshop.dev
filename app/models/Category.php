<?php

class Category extends Eloquent {
    /**
     * Relationship: Category
     * - Many to one relationship with (self) model
     *
     */
    public function parent()
    {
        return $this->belongsToMany('Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Category', 'parent_id');
    }

    public function products(){
        return $this->belongsToMany('product', 'categorized_products');
    }

}