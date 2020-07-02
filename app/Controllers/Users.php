<?php namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
	
	public function index()
	{
		helper(['form']);
		$data = [];
		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required|validateUser[email,password]'
			];
			$error = [
				'password' => [
					'validateUser' => 'password not match!'
				]
			];
			if(!$this->validate($rules,$error)){
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				$user = $model->where('email',$this->request->getVar('email'))
							  ->first();

				$this->setUserSession($user);
			
				return redirect()->to('dashboard');
			}

		}
		return view('auths/login',$data);
	}

	public function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'email' => $user['email'],
			'password' => $user['password'],
			'address' => $user['address'],
			'role' => $user['role'],
		];

		session()->set($data);
		return true;
	}	

	public function register()
	{
		helper(['form']);

		$data = [];

		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required',
				'password' => 'required',
				'address' => 'required',
			];
			if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'address' => $this->request->getVar('address'),
					'role' => $this->request->getVar('role'),
				];

				$model->save($newData);
				$session = session();
				$session->setFlashdata('success','successful Register');
				return redirect()->to('/');
			}

		}
		
		return view('auths/register',$data);
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

}
