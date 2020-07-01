<?php namespace App\Controllers;
use App\Models\PizzaModel;
class Pizza extends BaseController
{

	public function index()
	{
		$model = new PizzaModel();
		$data['dataPizza'] = $model->findAll();
		return view('index',$data);
	}


	public function addPizza()
	{	
		helper(['form']);
		$data = [];

		if($this->request->getMethod() == "post"){
			$rules = [
				'name' => 'required',
				'ingredients' => 'required',
				'prize' => 'required'
			];
			if(!$this->validate($rules)){
				$data['validate'] = $this->validator;
				
			}else{
				$model = new PizzaModel();
				$newData = [
					'name' => $this->request->getVar('name'),
					'ingredients' => $this->request->getVar('ingredients'),
					'prize' => $this->request->getVar('prize')
				];

				$model->save($newData);
				return redirect()->to('/dashboard');
			}

		}
		// return view('index',$data);
	}

	
	public function deletePizza($id)
	{
		$deleteModel = new PizzaModel();
		$deleteModel->find($id);
		$delete = $deleteModel->delete($id);
		return redirect()->to('/dashboard');
	}

	
	public function editPizza($id)
	{
		$modelEdit = new PizzaModel();
		$data['edit'] = $modelEdit->find($id);
		return view('edit',$data);
	}
	public function updatePeperoni()
	{
		$peperoniModel = new PizzaModel();
			$peperoniModel->update($_POST['id'], $_POST);
			return redirect()->to('/dashboard');
	}
}
