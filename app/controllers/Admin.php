<?php

/**
 * admin class
 */
class Admin extends Controller
{
	
	public function index()
	{# инициализация класса Admin для страницы views/admin

		if(!Auth::logged_in())
		{
			message('Войдите для доступа к админ разделу');
			redirect('login');
		}

		$data['title'] = "Dashboard";

		$this->view('admin/dashboard', $data);
	}

	public function courses($action = null,$id = null)
	{ #функция для взаимодействия с курсами
		if(!Auth::logged_in())
		{
			message('Пожалуйста, выполните вход для доступа к админ-панеле');
			redirect('login');
		}
		$user_id = Auth::getId();
		$course = new Course_model();
		$category = new Category_model();
		$language = new Language_model();
		$level = new Level_model();
		$price = new Price_model();
		$currency = new Currency_model();

		$data = [];
		$data['action'] = $action;
		$data['id'] = $id;

		if($action == 'add')
		{
			
			$data['categories'] = $category->findAll('asc');

			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				if($course->validate($_POST))
				{
					
					$_POST['date'] = date("Y-m-d H:i:s");
					$_POST['user_id'] = $user_id;
					$_POST['price_id'] = 1;

					$course->insert($_POST);
					
					$row = $course->first(['user_id'=>$user_id, 'published'=>0]);
					message("Ваш курс был успешно создан.");

					if($row){
						redirect('admin/courses/edit/'.$row->id);
					}else{
						redirect('admin/courses/');
					}
				}
				$data['errors'] = $course->errors;
			}
		}
		elseif($action == 'edit')
		{
			$categories = $category->findAll('asc');
			$languages = $language->findAll('asc');
			$levels = $level->findAll('asc');
			$prices = $price->findAll('asc');
			$currencies = $currency->findAll('asc');

			//get course info
			// возвращает результат если есть курс с таким id и user_id = $user_id сессии
			$data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

			if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
			{
				if(!empty($_POST['data_type']) && $_POST['data_type'] == "read")
				{
					if($_POST['tab_name'] == "course-landing-page")
					{ /*
						обращаемся к контроллеру ajax и упаковываем страницу из функции course_edit в массив $info 

						$info['data'] = file_get_contents(ROOT."/ajax/course_edit/".$user_id."/".$id);
						$info['data_type'] = "read";

						 преобразуем массив в json и отправляем его в браузер
						echo json_encode($info);

						 типа rest api, но он будет использоваться не при read, а при save и delete
						*/
						include views_path('course-edit-tabs/course-landing-page');

					}else
					if($_POST['tab_name'] == "course-messages")
					{
						include views_path('course-edit-tabs/course-messages');
					}
					
				}else
				if(!empty($_POST['data_type']) && $_POST['data_type'] == "save")
				{
					if($_POST['tab_name'] == "course-landing-page")
					{

						if($course->edit_validate($_POST)){
							
							$course->update($id, $_POST);

							$info['data'] = "Курс успешно сохранен";
							$info['data_type'] = "save";

						}else{

							$info['errors'] = $course->errors;
							$info['data'] = "Ошибка сохранения";
							$info['data_type'] = "save";

						}
						echo json_encode($info);
					}else
					if($_POST['tab_name'] == "course-messages")
					{

						if($course->edit_validate($_POST)){
							
							$course->update($id, $_POST);

							$info['data'] = "Курс успешно сохранен";
							$info['data_type'] = "save";

						}else{

							$info['errors'] = $course->errors;
							$info['data'] = "Ошибка сохранения";
							$info['data_type'] = "save";

						}
						echo json_encode($info);
					}

					
					
				} 
				die;
			}
		}else
		{
			//courses view
			$data['rows'] = $course->where(['user_id'=>$user_id]);

			//show($data['rows']);die;
		}

		$this->view('admin/courses', $data);

	}
	public function profile($id = null)
	{# функция для профиля адимн-панели

		if(!Auth::logged_in())
		{
			message('Пожалуйста, выполните вход для доступа к админ-панеле');
			redirect('login');
		}

		$id = $id ?? Auth::getId();
		#row представлят data из бд
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
			if($user->edit_validate($_POST, $id))
			{
				// создает папку при загрузке фото пользователя (если не создана) и сохраняте туда пикчу
				$allowed = ['image/jpeg', 'image/png'];
				if(!empty($_FILES['image']['name'])){
					if($_FILES['image']['error'] == 0){
						
						if(in_array($_FILES['image']['type'], $allowed))
						{
							//все гуд
							$destination = $folder.time().$_FILES['image']['name'];
							move_uploaded_file($_FILES['image']['tmp_name'], $destination);

							resize_image($destination);
							
							$_POST['image'] = $destination;
							if(file_exists($row->image))
							{	#проверка чтобы не забить images старыми картинками
								unlink($row->image);
							}
						}else{ 
							$user->errors['image'] = "Этот тип изображений не поддерживается";
						}

					}else{ 
						$user->errors['image'] = "Ошибка загрузки изображения";
					}	
				}
				$user->update($id, $_POST);
				//message("Профиль успешно сохранен");
				//redirect('admin/profile/'.$id);
			}
			
			if(empty($user->errors)){
				$arr['message'] = "Профиль успешно сохранен";
			}else{
				$arr['message'] = "Пожалуйста исправьте некорректные данные";
				$arr['errors'] = $user->errors;
			}
			echo json_encode($arr);
			die;
		}
		$data['title'] = "Profile";
		$data['errors'] = $user->errors;
		$this->view('admin/profile', $data);
	}


}