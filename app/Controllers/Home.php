<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Exam;

use App\Models\ExamUsers;

class Home extends BaseController
{
    public function basvur(){
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('examId'))) {
                return  $this->getAjaxFail("examId alanı boş bırakılamaz.");
            }
    
    
            $examId = trim($this->request->getPost('examId') ?? "");

            $exam = (new Exam())->where("id",$examId)->get()->getFirstRow();
            
            if($exam->examRole != $this->session->get("role")){
                return  $this->getAjaxFail("bu sınav için uygun rolde değilsiniz.");
            }

            $exam_user = (new ExamUsers())
            ->where(['user_id' => $this->session->get("id"),'exam_id' =>$examId])
            ->findAll();

            if($exam_user){
                return  $this->getAjaxFail("bu sınav için zaten başuruda bulundunuz.");
            }
            $data = [
                'exam_id' =>$examId, 
                'user_id' => $this->session->get("id"),
                'state' => "beklemede",
                'created_at' => date("Y-m-d H:i:s")
            ];
            $builder = (new ExamUsers())->insert($data);
            
                return  $this->getAjaxSuccess("başvuru başarılı");
            
           
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }
    public function index(): string
    {
        $exams = (new Exam())
        ->select("exams.id,exams.examName,exams.examRole,exams.created_at as created")
        ->get()->getResult();
        return view('home',["exams" =>  $exams]);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
    public function login(): string
    {
        return view('login');
    }
    public function register(): string
    {
        return view('register');
    }
    public function loginPost(){
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('email'))) {
                return  $this->getAjaxFail("email alanı boş bırakılamaz.");
            }
            if (empty($this->request->getPost('password'))) {
                return  $this->getAjaxFail("password alanı boş bırakılamaz");
            }
    
    
            $email = trim($this->request->getPost('email') ?? "");
            $password = trim($this->request->getPost('password') ?? "");
           
            
            $users = (new User())->where(['email' => $email])->findAll();
            if (!isset($users[0])) {
                return  $this->getAjaxFail("email adresine ait kullanıcı bulunamadı.");
            }

            if (!password_verify($password, $users[0]['password'])) {
                return  $this->getAjaxFail("password veya email hatalı");
            }

            $this->session->set([
                'id' => $users[0]['id'],
                'username' =>$users[0]['username'], 
                'email' => $users[0]['email'],
                'role' => $users[0]['role'],
            ]);
            if($users[0]['role'] == "admin"){
                return  $this->getAjaxSuccess("giriş başarılı","admin");
            }else{
                return  $this->getAjaxSuccess("giriş başarılı","user");
            }
           
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
    }

    public function registerPost()
    {
        try {
            if (!$this->request->isAJAX()) {
                return  $this->getAjaxFail("sadece ajax istekleri.");
            }
            if (empty($this->request->getPost('email'))) {
                return  $this->getAjaxFail("email alanı boş bırakılamaz.");
            }
            if (empty($this->request->getPost('password'))) {
                return  $this->getAjaxFail("password alanı boş bırakılamaz");
            }
            if (empty($this->request->getPost('username'))) {
                return  $this->getAjaxFail("username alanı boş bırakılamaz");
            }
    
            $roles = ['','admin','teknisyen','tekniker','mühendis','yüksek mühendis'];
    
            $email = trim($this->request->getPost('email') ?? "");
            $username = trim($this->request->getPost('username') ?? "");
            $password = trim($this->request->getPost('password') ?? "");
            $role = $this->request->getPost('role');
            
            if (strlen($password) < 8) {
                return $this->getAjaxFail("password 8 karakterden az olamaz");
            }
           
            
            $users = (new User())->where(['email' => $email])->findAll();
            if (isset($users[0])) {
                return  $this->getAjaxFail("email adresi kullanılmakta.");
            }
    
            $data = [
                'username' =>$username, 
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'role' => $roles[$role],
                'created_at' => date("Y-m-d H:i:s")
            ];
            $builder = (new User())->insert($data);

            $this->session->set([
                'id' => $builder,
                'username' =>$username, 
                'email' => $email,
                'role' => $roles[$role],
            ]);

            if($role == "admin"){
                return  $this->getAjaxSuccess("giriş başarılı","admin");
            }else{
                return  $this->getAjaxSuccess("giriş başarılı","user");
            }
        } catch (\Exception $e) {
            return $this->getAjaxFail($e->getMessage());
        }
       
    }
}
