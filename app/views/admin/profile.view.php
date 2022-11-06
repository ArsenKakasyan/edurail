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
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Обзор</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Редактировать</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Настройки</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Изменить пароль</button>
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
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">

                  <div class="d-flex">
                    <img class="js-image-preview" src="<?=ROOT?>/<?=$row->image?>" alt="Profile" style="width:200px;max-width:200px;height:200px;object-fit: cover;">
                    <div class="js-filename m-2 ">Выбранный файл: </div>
                  </div>
                    <div class="pt-2">
                      <label class="btn btn-primary btn-sm" title="Загрузить новое фото">
                        <i class="text-white bi bi-upload"></i>
                        <input onchange="load_image(this.files[0])" type="file" name="image" style="display: none;">
                      </label>
                      <a href="#" class="btn btn-danger btn-sm" title="Удалить фото"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Имя</label>
                  <div class="col-md-8 col-lg-9">                                                         <!-- первый аргумент из post, второй - значение по умолчанию -->
                    <input name="firstname" type="text" class="form-control" id="firstname" value="<?=set_value('firstname', $row->firstname)?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Фамилия</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="lastname" type="text" class="form-control" id="lastname" value="<?=set_value('firstname', $row->lastname)?>">
                  </div>
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
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="<?=set_value('email', $row->email)?>">
                  </div>
                </div>
                <!-- Twitter -->
                <div class="row mb-3">
                  <label for="Vkontakte" class="col-md-4 col-lg-3 col-form-label">Профиль VK</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="vkontakte_link" type="text" class="form-control" id="Vkontakte" value="https://vk.com/#">
                  </div>

                  <?php if(!empty($errors['vkontakte_link'])):?>
                    <small class="text-danger"><?=$errors['vkontakte_link']?></small>
                  <?php endif;?>

                </div>
                      <!-- Facebook -->
                <div class="row mb-3">
                  <label for="Telegram" class="col-md-4 col-lg-3 col-form-label">Telegram</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="telegram_link" type="text" class="form-control" id="Telegram" value="https://t.me/#">
                  </div>
                </div>
                      <!-- Insta -->
                <div class="row mb-3">
                  <label for="Headhunter" class="col-md-4 col-lg-3 col-form-label">Headhunter</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="headhunter_link" type="text" class="form-control" id="Headhunter" value="https://hh.ru/#">
                  </div>
                </div>
                      <!-- Linkedin -->
                <div class="row mb-3">
                  <label for="Bigbluebutton" class="col-md-4 col-lg-3 col-form-label">BigBlueButton</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="bigbluebutton_link" type="text" class="form-control" id="Linkedin" value="https://bigbluebutton.ru/#">
                  </div>
                </div>

                <div class="text-center">
                  <a href="<?=ROOT?>/admin">
                    <button type="button" class="btn btn-primary float-start">Назад</button>
                  </a>
                  
                  <button type="submit" class="btn btn-danger float-end">Сохранить изменения</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

              <!-- Settings Form -->
              <form>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Changes made to your account
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Information on new products and services
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="proOffers">
                      <label class="form-check-label" for="proOffers">
                        Marketing and promo offers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Security alerts
                      </label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End settings Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form>

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
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
<!-- JS функция для отображения загружаемой картинки и ее имени -->
<script>

  function load_image(file)
  {
    document.querySelector(".js-filename").innerHTML = "Выбранный Файл: " + file.name;

    var mylink = window.URL.createObjectURL(file);
    
    document.querySelector(".js-image-preview").src = mylink;
  }
</script>
<?php $this->view('admin/admin-footer', $data) ?>