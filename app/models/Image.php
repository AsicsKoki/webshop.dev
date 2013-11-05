<?php
class Image extends Eloquent {
		/**
    * Define which attributes can be filled
    * via MassAssignment
    */
    public $fillable = array('imageable_id', 'path', 'imageable_type');

    public function imageable()
    {
        return $this->morphTo();
    }

}