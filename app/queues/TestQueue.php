<?php
class TestQueue {

    public function fire($job, $data)
    {
		DB::insert('insert into test (id, shit) values (?, ?)', array(3, 1));
    }

}