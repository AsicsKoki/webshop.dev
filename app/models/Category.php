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

    /**
     * Relationship: BusinessCategory
     * - One to many relationship with (self) model
     *
     */
    public function children()
    {
        return $this->hasMany('Category', 'parent_id');
    }

}