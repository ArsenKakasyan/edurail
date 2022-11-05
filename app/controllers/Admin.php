<?php

/**
 * admin class
 */
class Admin extends Controller
{
	
	public function index()
	{# инициализация класса бд и вызов ее методов

		if(!Auth::logged_in())
		{
			message('Войдите для доступа к админ разделу');
			redirect('login');
		}

		$data['title'] = "Dashboard";

		$this->view('admin/dashboard', $data);
	}

	public function profile($id = null)
	{# функция для профиля адимн-панели

		if(!Auth::logged_in())
		{
			message('Пожалуйста, выполните вход для доступа к админ-панеле');
			redirect('login');
		}

		$id = $id ?? Auth::getId();

		$user = new User();
		$data['row'] = $row = $user->first(['id'=>$id]);

		// post & update для редактирования аккаунта
		if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
		{
			$folder = "uploads/images/";
			if(!file_exists($folder))
			{
				mkdir($folder, 0777, true);
				file_put_contents($folder."index.php", "<?php //silence");
				file_put_contents("uploads/index.php", "<?php //silence");
			}
			
			$allowed = ['image/jpeg', 'image/png'];
			if(!empty($_FILES['image']['name'])){
				if($_FILES['image']['error'] == 0){
					
					if(in_array($_FILES['image']['type'], $allowed))
					{
						//все гуд
						$destination = $folder.time().$_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'], $destination);

						$_POST['image'] = $destination;
					}else{ $user->errors['image'] = "этот тип изображений не поддерживается";}

				}else{ $user->errors['image'] = "ошибка загрузки изображения";}
				
			}
			$user->update($id, $_POST);

			redirect('admin/profile/'.$id);
		}
		$data['title'] = "Profile";

		$this->view('admin/profile', $data);
	}


}