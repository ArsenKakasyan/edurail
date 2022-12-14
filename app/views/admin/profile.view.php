<?php $this->view('admin/admin-header', $data) ?>

<?php if(!empty($row)):?>
<div class="pagetitle">
  <h1>Аккаунт</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
      <li class="breadcrumb-item">Пользователи</li>
      <li class="breadcrumb-item active">Аккаунт</li>
      <li class="breadcrumb-item active"><?=esc($row->firstname)?> <?=esc($row->lastname)?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="<?=ROOT?>/<?=$row->image?>" alt="Profile" style="width:150px;max-width:150px;height:150px;object-fit: cover;" class="rounded-circle">
          <h2><?=esc($row->firstname)?> <?=esc($row->lastname)?></h2>
          <h3><?=esc($row->role)?></h3>
          <div class="social-links mt-2">
            <!-- Vkontakte, Telegram, HeadHunter,BigBlueButton -->
            <a href="#" class="vkontakte"><i class="fa fa-vk"></i></a>
            <a href="#" class="telegram"><i class="bi bi-telegram"></i></a>
            <a href="#" class="headhunter"><i class="fa fa-header"></i></a>
            <a href="#" class="bigbluebutton"><i class="fa fa-bold"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" id="profile-overview-tab">Обзор</button>
            </li>

            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" id="profile-edit-tab">Редактировать</button>
            </li>

            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" id="profile-settings-tab">Настройки</button>
            </li>

            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" id="profile-change-password-tab">Изменить пароль</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Обо мне</h5>
              <p class="small fst-italic"><?=esc($row->about)?></p>

              <h5 class="card-title">Детали аккаунта</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Полное имя</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->firstname)?> <?=esc($row->lastname)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Компания</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->company)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Должность</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->job)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Страна</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->country)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Адрес</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->address)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Телефон</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->phone)?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?=esc($row->email)?></div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form method="post" enctype="multipart/form-data">
                
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Фото</label>
                  <div class="col-md-8 col-lg-9">

                  <div class="d-flex">
                    <img class="js-image-preview" src="<?=ROOT?>/<?=$row->image?>" alt="Profile" style="width:200px;max-width:200px;height:200px;object-fit: cover;">
                    <div class="js-filename m-2 ">Выбранный файл: </div>
                  </div>
                    <div class="pt-2">
                      <label class="btn btn-primary btn-sm" title="Загрузить новое фото">
                        <i class="text-white bi bi-upload"></i>
                        <input class="js-profile-image-input" onchange="load_image(this.files[0])" type="file" name="image" style="display: none;">
                      </label>

                      <?php if(!empty($errors['image'])):?>
                        <small class="js-error-image text-danger"><?=$errors['image']?></small>
                      <?php endif;?>
                      <small class="js-error-image text-danger"></small>

                      <a href="#" class="btn btn-danger btn-sm" title="Удалить фото"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Имя</label>
                  <div class="col-md-8 col-lg-9">                                             <!-- первый аргумент из post, второй - значение по умолчанию -->
                    <input name="firstname" type="text" class="form-control" id="firstname" value="<?=set_value('firstname', $row->firstname)?>" required>
                  </div>

                  <?php if(!empty($errors['firstname'])):?>
                    <small class="js-error-firstname text-danger"><?=$errors['firstname']?></small>
                  <?php endif;?>
                  <small class="js-error-firstname text-danger"></small>

                </div>

                <div class="row mb-3">
                  <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Фамилия</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="lastname" type="text" class="form-control" id="lastname" value="<?=set_value('lastname', $row->lastname)?>" required>
                  </div>

                  <?php if(!empty($errors['lastname'])):?>
                    <small class="js-error-lastname text-danger"><?=$errors['lastname']?></small>
                  <?php endif;?>
                  <small class="js-error-lastname text-danger"></small>

                </div>

                <div class="row mb-3"> 
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">Обо мне</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="about" class="form-control" id="about" style="height: 100px"><?=set_value('about', $row->about)?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Компания</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="company" type="text" class="form-control" id="company" value="<?=set_value('company', $row->company)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Должность</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="job" type="text" class="form-control" id="Job" value="<?=set_value('job', $row->job)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">Страна</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="country" type="text" class="form-control" id="Country" value="<?=set_value('country', $row->country)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Адрес</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Address" value="<?=set_value('address', $row->address)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Телефон</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control" id="Phone" value="<?=set_value('phone', $row->phone)?>">
                  </div>

                  <?php if(!empty($errors['phone'])):?>
                    <small class="js-error-phone text-danger"><?=$errors['phone']?></small>
                  <?php endif;?>
                  <small class="js-error-phone text-danger"></small>

                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="<?=set_value('email', $row->email)?>" required>
                  </div>

                  <?php if(!empty($errors['email'])):?>
                    <small class="js-error-email text-danger"><?=$errors['email']?></small>
                  <?php endif;?>
                  <small class="js-error-email text-danger"></small>

                </div>

                      <!-- vk -->
                <div class="row mb-3">
                  <label for="Vkontakte" class="col-md-4 col-lg-3 col-form-label">Профиль VK</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="vkontakte_link" type="text" class="form-control" id="Vkontakte" value="<?=set_value('vkontakte_link', $row->vkontakte_link)?>">
                  </div>

                  <?php if(!empty($errors['vkontakte_link'])):?>
                    <small class="js-error-vkontakte_link text-danger"><?=$errors['vkontakte_link']?></small>
                  <?php endif;?>
                  <small class="js-error-vkontakte_link text-danger"></small>

                </div>
                      <!-- tg -->
                <div class="row mb-3">
                  <label for="Telegram" class="col-md-4 col-lg-3 col-form-label">Telegram</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="telegram_link" type="text" class="form-control" id="Telegram" value="<?=set_value('telegram_link', $row->telegram_link)?>">
                  </div>

                  <?php if(!empty($errors['telegram_link'])):?>
                    <small class="js-error-telegram_link text-danger"><?=$errors['telegram_link']?></small>
                  <?php endif;?>
                  <small class="js-error-telegram_link text-danger"></small>

                </div>
                      <!-- hh -->
                <div class="row mb-3">
                  <label for="Headhunter" class="col-md-4 col-lg-3 col-form-label">Headhunter</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="headhunter_link" type="text" class="form-control" id="Headhunter" value="<?=set_value('headhunter_link', $row->headhunter_link)?>">
                  </div>

                  <?php if(!empty($errors['headhunter_link'])):?>
                    <small class="js-error-headhunter_link text-danger"><?=$errors['headhunter_link']?></small>
                  <?php endif;?>
                  <small class="js-error-headhunter_link text-danger"></small>

                </div>
                      <!-- bbb -->
                <div class="row mb-3">
                  <label for="Bigbluebutton" class="col-md-4 col-lg-3 col-form-label">BigBlueButton</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="bigbluebutton_link" type="text" class="form-control" id="Linkedin" value="<?=set_value('bigbluebutton_link', $row->bigbluebutton_link)?>">
                  </div>

                  <?php if(!empty($errors['bigbluebutton_link'])):?>
                    <small class="js-error-bigbluebutton_link text-danger"><?=$errors['bigbluebutton_link']?></small>
                  <?php endif;?>
                  <small class="js-error-bigbluebutton_link text-danger"></small>

                </div>
                
                  <div class="js-prog progress my-4 hide">
                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Сохранение.. 50%</div>
                  </div>
                <div class="text-center">
                  <a href="<?=ROOT?>/admin">
                    <button type="button" class="btn btn-secondary float-start">Назад</button>
                  </a>
                  
                  <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-primary float-end">Сохранить изменения</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

              <!-- Settings Form -->
              <form>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email уведомления</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Изменения в профиле
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Информация о новых продуктах и услугах
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="proOffers">
                      <label class="form-check-label" for="proOffers">
                        Предложения от партнеров и спонсоров
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Уведомления безопасности
                      </label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
              </form><!-- End settings Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form method="post" enctype="multipart/form-data">

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Текущий пароль</label>
                  <div class="col-md-8 col-lg-9">
                    <input  type="password" name="current_password" class="form-control" <?=!empty($errors['password']) ? 'border-danger':'';?> id="yourPassword" required >
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Новый пароль</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="new_password" class="form-control" id="newPassword">
                  </div>
                    <?php if(!empty($errors['password'])):?>
                      <small class="text-danger"><?=$errors['password']?></small>
                    <?php endif;?>
                </div>

                <div class="row mb-3">
                  <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Подтвердите новый пароль</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                  </div>
                    <?php if(!empty($errors['password'])):?>
                      <small class="text-danger"><?=$errors['password']?></small>
                    <?php endif;?>
                </div>

                <div class="text-center">
                
                <button type="submit" name="changePasswordBtn" class="btn btn-primary">Сохранить изменения</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section> 

<?php else:?>

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Аккаунт не найден!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

<?php endif;?>
<!-- JS скрипт  -->
<script>

  var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#profile-overview";
 
  // функция сохранения&загрузки страницы где находится пользователь
  function show_tab(tab_name)
  {
    var someTabTriggerEl = document.querySelector(tab_name +"-tab");
    var tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();

  }
  function set_tab(tab_name)
  {
    tab = tab_name;
    sessionStorage.setItem("tab", tab_name);
  }

  // функция для отображения загружаемой картинки
  function load_image(file)
  {
    document.querySelector(".js-filename").innerHTML = "Выбранный Файл: " + file.name;

    var mylink = window.URL.createObjectURL(file);
    
    document.querySelector(".js-image-preview").src = mylink;
  }

  window.onload = function()
  {
    show_tab(tab);
  }

  //upload functions
  function save_profile(e)
  {

    var form = e.currentTarget.form;
    var inputs = form.querySelectorAll("input,textarea");
    var obj = {};
    var image_added = false;

    for(var i = 0; i < inputs.length; i++){
      var key = inputs[i].name;

      if(key == 'image'){
        if(typeof inputs[i].files[0] == 'object'){
        obj[key] = inputs[i].files[0];
        image_added = true;

        }
      }else{
        obj[key] = inputs[i].value;
      }
    }

    // валидация картинки
    if(image_added){
      var allowed = ['jpg','jpeg','png'];
      if(typeof obj.image == 'object'){
        var ext = obj.image.name.split(".").pop();
      }  

      if(!allowed.includes(ext.toLowerCase())){
        alert("Разрешенные типы файлов для изображения профиля: "+ allowed.toString(","));
        return;
      }
    }
    send_data(obj);
  }

  // функция для progress бара
  function send_data(obj, progbar = 'js-prog')
  {
    var prog = document.querySelector("."+progbar);
    prog.children[0].style.width = "0%";
    prog.classList.remove("hide");

    var myform = new FormData();
    for(key in obj){
      myform.append(key,obj[key]);
    }
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){
      if(ajax.readyState == 4){
        if(ajax.status == 200){
          //все гуд
          //alert("Загрузка завершена");
          
          handle_result(ajax.responseText); 
        }else{
          //ошибкао от сервера
          alert("Возникла ошибка");
        }
      }
    });
    ajax.upload.addEventListener('progress', function(e){
      var percent = Math.round((e.loaded / e.total) * 100);
      prog.children[0].style.width = percent + "%";
      prog.children[0].innerHTML = "Сохранение.. " + percent + "%";

    });

    ajax.open('post', '', true);
    ajax.send(myform);

  }

  function handle_result(result)
  {
    var obj = JSON.parse(result);
    if(typeof obj == 'object'){
      //объект был создан
      if(typeof obj.errors == 'object')
      {
        //у нас ошибки
        display_errors(obj.errors);
        alert("Пожалуйста введите корректные данные");
      
      }else{
        //сохранено
        alert("Данные успешно сохранены!");
        window.location.reload();
      }
    }
  }
  
  function display_errors(errors){

    for(key in errors){
      
      document.querySelector(".js-error-"+key).innerHTML = errors[key];
    }
  }
</script>
<?php $this->view('admin/admin-footer', $data) ?>