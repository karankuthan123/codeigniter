<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamUsers extends BaseModel
{
    protected $table            = 'exam_users';
    protected $allowedFields    = ['id','user_id','exam_id','state','created_at'];

    public function setExamUsers($examUsersId,$state){
        return $this->where('id', $examUsersId)
        ->set(['state' => $state])
        ->update();
    }
}
