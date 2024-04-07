<?php

namespace App\Models;

use CodeIgniter\Model;

class Exam extends BaseModel
{
    protected $table            = 'exams';
    protected $allowedFields    = ['id','examName','examRole','created_at'];

    public function getExam()
    {
        return $this->orderBy('id', 'DESC')->get()->getResult();
    }
    public function setExam($id,$examRole){
        return $this->where('id', $id)
        ->set(['examRole' => $examRole])
        ->update();
    }

    public function removeExam($id){
        return $this->where('id',$id)
        ->delete();
    }
}
