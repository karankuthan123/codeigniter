<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Exam;
use App\Models\ExamUsers;

class Admin extends BaseController
{
    public function login(): string
    {
        return view('admin/login');
    }
    public function index(): string
    {
        return view('admin/dashboard');
    }
    public function exam(): string
    {
        return view('admin/exam');
    }
    public function pending(): string
    {
        return view('admin/pending');
    }

    public function addExam()
    {
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('examName'))) {
                return  $this->getAjaxFail("sınav adı alanı boş bırakılamaz.");
            }
            if (empty($this->request->getPost('examRole'))) {
                return  $this->getAjaxFail("sınav rolu alanı boş bırakılamaz");
            }

            $examName = trim($this->request->getPost('examName') ?? "");
            $examRole = trim($this->request->getPost('examRole') ?? "");
            $data = [
                'examName' => $examName,
                'examRole' => $examRole,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $builder = (new Exam())->insert($data);
            return  $this->getAjaxSuccess("sınav başarıyla kayıt edildi.", [$examName, $examRole]);
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }

    public function getExam()
    {
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }

            $exams = (new Exam())->getExam();
            return  $this->getAjaxSuccess("sınavlar", [$exams]);
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }
    public function changeExamRole(){
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('examId'))) {
                return  $this->getAjaxFail("sınav id alanı boş bırakılamaz.");
            }
            if (empty($this->request->getPost('examRole'))) {
                return  $this->getAjaxFail("sınav rolu alanı boş bırakılamaz");
            }
            $examId = trim($this->request->getPost('examId') ?? "");
            $examRole = trim($this->request->getPost('examRole') ?? "");


            $exams = (new Exam())->setExam($examId,$examRole);
            if($exams){
                return  $this->getAjaxSuccess("sınav rolu değişti.");
            }else{
                return $this->getAjaxFail("sınav rolu değişemedi.");
            }
            
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }

    public function removeExam(){
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('examId'))) {
                return  $this->getAjaxFail("sınav id alanı boş bırakılamaz.");
            }
            $examId = trim($this->request->getPost('examId') ?? "");


            $exams = (new Exam())->removeExam($examId);
            if($exams){
                return  $this->getAjaxSuccess("sınav silindi.");
            }else{
                return $this->getAjaxFail("sınav silinemedi.");
            }
            
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }

    public function examDetail($examId){

        $exam = (new ExamUsers())->select("exam_users.id as examUsersId,exam_users.state,exam_users.created_at,users.username")
        ->join('users', 'users.id = exam_users.user_id', 'left')->where(['exam_users.exam_id' => $examId])->get()->getResult();
        if (is_null($exam)) {
            return $this->notFoundPage();
        }
        return view('admin/examDetail',["exam" => $exam]);
    }

    public function changeState(){
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('examUsersId'))) {
                return  $this->getAjaxFail("sınav id alanı boş bırakılamaz.");
            }
            if (empty($this->request->getPost('state'))) {
                return  $this->getAjaxFail("sınav rolu alanı boş bırakılamaz");
            }
            $examUsersId = trim($this->request->getPost('examUsersId') ?? "");
            $state = trim($this->request->getPost('state') ?? "");


            $examusers = (new ExamUsers())->setExamUsers($examUsersId,$state);
            if($examusers){
                return  $this->getAjaxSuccess("sınav rolu değişti.");
            }else{
                return $this->getAjaxFail("sınav rolu değişemedi.");
            }
            
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }
}
