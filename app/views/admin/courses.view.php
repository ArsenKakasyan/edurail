<?php $this->view('admin/admin-header', $data) ?>

<?php if($action == 'add'):?>

<div class="card col-md-5 mx-auto">
    <div class="card-body">
        <h5 class="card-title">Новый курс</h5>

        <!--  No Labels Form   -->
        <form method="post" class="row g-3">
        <div class="col-md-12">
            <input value="<?=set_value('title')?>" name="title" type="text" class="form-control <?=!empty($errors['title']) ? 'border-danger':'';?>" placeholder="Название курса">

            <?php if(!empty($errors['title'])):?>
                <small class="text-danger"><?=$errors['title']?></small>
            <?php endif;?>

        </div>

        <div class="col-md-12">
            <input value="<?=set_value('primary_subject')?>" name="primary_subject" type="text" class="form-control <?=!empty($errors['primary_subject']) ? 'border-danger':'';?>" placeholder="Основной предмет e.g. Фотография">

            <?php if(!empty($errors['primary_subject'])):?>
                <small class="text-danger"><?=$errors['primary_subject']?></small>
            <?php endif;?>

        </div>
       

        <div class="col-md-12">
            <select name="category_id" id="inputState" class="form-select" <?=!empty($errors['category_id']) ? 'border-danger':'';?>">

                <option value="" selected="">Категория курса...</option>
                <?php if(!empty($categories)):?>
                    <?php foreach($categories as $cat):?>
                        <option <?=set_select('category_id', $cat->id)?> value="<?=$cat->id?>"><?=esc($cat->category)?></option> 
                    <?php endforeach;?>
                <?php endif;?>
                 
            </select>

            <?php if(!empty($errors['category_id'])):?>
                <small class="text-danger"><?=$errors['category_id']?></small>
            <?php endif;?>

        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="<?=ROOT?>/admin/courses">
            <button type="button" class="btn btn-secondary">Отмена</button>
            </a>
        </div>
        </form><!-- End No Labels Form   -->

    </div>
</div>

<?php elseif($action == 'edit'):?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Редактировать курс</h5>

        <?php if(!empty($row)):?>

            <div class="float-end">
                <button class="js-save-button btn btn-primary disabled">Сохранить</button>
                <a href="<?=ROOT?>/admin/courses">
                    <button class="btn btn-secondary">Назад</button>
                </a>
            </div>

            <h5 class=""><?=esc($row->title)?></h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100 active" id="intended-learners-tab" data-bs-toggle="tab" data-bs-target="#intended-learners" type="button" role="tab" aria-controls="home" aria-selected="true">Целевые учащиеся</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="profile" aria-selected="false">Учебный план</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="course-landing-page-tab" data-bs-toggle="tab" data-bs-target="#course-landing-page" type="button" role="tab" aria-controls="contact" aria-selected="false">Целевая страница курса</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="promotions-tab" data-bs-toggle="tab" data-bs-target="#promotions" type="button" role="tab" aria-controls="contact" aria-selected="false">Стимулирование продаж</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="course-messages-tab" data-bs-toggle="tab" data-bs-target="#course-messages" type="button" role="tab" aria-controls="contact" aria-selected="false">Сообщения курса</button>
                </li>
            </ul>
            <div oninput="something_changed(event)" class="tab-content pt-2" id="borderedTabJustifiedContent">

                <div class="tab-pane fade show active" id="intended-learners" role="tabpanel" aria-labelledby="intended-learners">
                    1Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
                    <input type="text" name="">
                </div>
                <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum">
                    2Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                    <input type="text" name="">
                </div>
                <div class="tab-pane fade" id="course-landing-page" role="tabpanel" aria-labelledby="course-landing-page">
                    3Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    <input type="text" name="">
                </div>
                <div class="tab-pane fade" id="promotions" role="tabpanel" aria-labelledby="promotions">
                    4Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    <input type="text" name="">
                </div>
                <div class="tab-pane fade" id="course-messages" role="tabpanel" aria-labelledby="course-messages">
                    5Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    <input type="text" name="">
                </div>
            </div><!-- End Bordered Tabs Justified -->

        <?php else:?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Ошибка!</h4>
                <p>Курс не найден.</p>
                <hr>
                <p class="mb-0">Пожалуйста, попробуйте еще раз.</p>
            </div>

        <?php endif;?>
    </div>
</div>

<?php else:?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            Мои курсы 
            <a href="<?=ROOT?>/admin/courses/add">
                <button class="btn btn-primary float-end"><i class="fa fa-plus"></i> Новый курс</button>
            </a>
        </h5>


        <!-- Table with stripped rows -->
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Преподаватель</th>
            <th scope="col">Категория</th>
            <th scope="col">Цена</th>
            <th scope="col">Основной предмет</th>
            <th scope="col">Дата</th>
            <th scope="col">Действие</th>
            </tr>
        </thead>

        <?php if(!empty($rows)):?>
            <tbody>

                <?php foreach($rows as $row):?>
                    <tr>
                    <th scope="row"><?=$row->id?></th>
                    <td><?=esc($row->title)?></td>
                    <td><?=esc($row->user_row->name ?? 'Неизвестный')?></td>
                    <td><?=esc($row->category_row->category ?? 'Неизвестный')?></td>
                    <td><?=esc($row->price_row->name ?? 'Неизвестный')?></td>
                    <td><?=esc($row->primary_subject)?></td>
                    <td><?=get_date($row->date)?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/courses/edit/<?=$row->id?>">
                            <i class="bi bi-pencil-square"></i> 
                        </a>
                        <a href="<?=ROOT?>/admin/courses/delete/<?=$row->id?>">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </a>
                    </td> 
                    </tr>
                <?php endforeach;?>

            </tbody>
        <?php else:?>
            <tr><td colspan="10">Данные отсутствуют!</td></tr>
        <?php endif;?>
        </table>
        <!-- End Table with stripped rows  -->

    </div>
</div>

<?php endif;?>

<script>
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#intended-learners";
    var dirty = false; // переменная для отслеживания изменений на вкладке редактирования курса

    // функция сохранения&загрузки страницы где находится пользователь
    function show_tab(tab_name)
    {
    var someTabTriggerEl = document.querySelector(tab_name +"-tab");
    var tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();
    disable_save_button(false);

    }
    function set_tab(tab_name)
    {
        tab = tab_name;
        sessionStorage.setItem("tab", tab_name);
        
        if(dirty)
        {
            //попросить пользователя сохранить изменения при переходе на другую вкладку
            if(!confirm("Вы не сохранили изменения. Продолжить?"))
            { 

                tab = dirty;
                sessionStorage.setItem("tab", dirty);
                setTimeout(function(){

                    show_tab(dirty);
                    disable_save_button(true);
                },10);
            }
            else
            {
                dirty = false;
                disable_save_button(false);
            }
        }
    }
    // функция отслеживания изменений на вкладке редактирования курса
    function something_changed(e)
    {
        dirty = tab;
        disable_save_button(true);
    }

    function disable_save_button(status = false)
    {
        if(status){
            document.querySelector(".js-save-button").classList.remove("disabled");
        }else{
            document.querySelector(".js-save-button").classList.add("disabled");
        }
    }
</script>

<?php $this->view('admin/admin-footer', $data) ?>
