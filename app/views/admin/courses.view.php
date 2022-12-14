<?php $this->view('admin/admin-header', $data) ?>

<style>
    .tabs-holder{
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        justify-content: center;
        text-align: center;
    }

    .my-tab{
        flex:1;
        border-bottom: solid 2px #ccc;
        padding-bottom: 10px;
        cursor: pointer;
        user-select: none;
    }

    .my-tab:hover{
        color: #4154f1;
    }

    .active-tab{
        color: #4154f1;
        border-bottom: solid 2px #4154f1;
    }

    .hide{
        display: none;
    }

</style>

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
            <br>
            <!-- tabs -->
            <div class="tabs-holder">
                <div onclick="set_tab(this.id,this)" id="intended-learners" class="my-tab active-tab">Целевые учащиеся</div>
                <div onclick="set_tab(this.id,this)" id="curriculum" class="my-tab">Учебный план</div>
                <div onclick="set_tab(this.id,this)" id="course-landing-page" class="my-tab">Целевая страница курса</div>
                <div onclick="set_tab(this.id,this)" id="promotions" class="my-tab">Стимулирование продаж</div>
                <div onclick="set_tab(this.id,this)" id="course-messages" class="my-tab">Сообщения курса</div>
            </div>
            <!-- end tabs -->

            <!-- div-tabs -->
            <div oninput="something_changed(event)">
                <div id="tabs-content">
                    1
                </div>
            </div>
            <!-- end div-tabs -->

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
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "intended-learners";
    var dirty = false; // переменная для отслеживания изменений на вкладке редактирования курса

    // функция сохранения&загрузки страницы где находится пользователь
    function show_tab(tab_name)
    {
    var div = document.querySelector("#"+tab_name);
    var children = div.parentNode.children;
        for(var i = 0; i < children.length; i++)
        {
            children[i].classList.remove("active-tab");
        }

        div.classList.add("active-tab")

        var content = tab_name + "<input />";
        document.querySelector("#tabs-content").innerHTML = content;
        
        disable_save_button(false);

    } 
    // функция для переключения вкладок
    function set_tab(tab_name)
    {  
        if(dirty)
        {
            //попросить пользователя сохранить изменения при переходе на другую вкладку
            if(!confirm("Вы не сохранили изменения. Продолжить?"))
            { 
                return;
            }
        }  
        tab = tab_name;
        sessionStorage.setItem("tab", tab_name);

        dirty = false;
        show_tab(tab_name);
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
