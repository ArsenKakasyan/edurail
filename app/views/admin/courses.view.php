<?php $this->view('admin/admin-header', $data) ?>

<style>
    .tabs-holder{
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        justify-content: center;
        text-align: center;
        flex-wrap: wrap;
    }

    .my-tab{
        flex:1;
        border-bottom: solid 2px #ccc;
        padding-top: 10px;
        padding-bottom: 10px;
        cursor: pointer;
        user-select: none;
        min-width: 150px;
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

    .loader{
        position: relative;
        width: 200px;
        height: 200px;
        left: 50%;
        top: 50%;
        transform: translateX(-50%);
        opacity: 0.7;
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
                <button onclick="save_content()" class="js-save-button btn btn-primary disabled">Сохранить</button>
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
        <div style="overflow-x:auto;">
            <table class="table table-hover">
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
        </div>

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
        var contentDiv = document.querySelector("#tabs-content");
        show_loader(contentDiv);

        var div = document.querySelector("#"+tab_name);
        var children = div.parentNode.children;
        for(var i = 0; i < children.length; i++)
        {
            children[i].classList.remove("active-tab");
        }

        div.classList.add("active-tab");

        send_data({
            tab_name: tab,
            data_type: "read",
        });

        disable_save_button(false);

    } 

    function send_data(obj)
    {
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
            //ошибка от сервера
            alert("Возникла ошибка");
            }
        }
        });
        ajax.open('post', '', true);
        ajax.send(myform);
    }

    function handle_result(result)
    {
        //если объект (Json), то обработаем его
        if(result.substr(0,2) == '{"')
            {
                var obj = JSON.parse(result);
                if(typeof obj == 'object'){
            
                    if(obj.data_type == "save"){

                        alert(obj.data);
                    
                        //очистить все ошибки
                        var error_container = document.querySelectorAll(".error");
                        for (var i = 0; i < error_container.length; i++) {
                            error_container[i].innerHTML = "";
                        }
                        // показать какие ошибки есть
                        if(typeof obj.errors == 'object')
                        {
                            for(key in obj.errors)
                            {
                                var errorDiv = document.querySelector(".error-"+key).innerHTML = obj.errors[key];
                            }
                            
                        }else{
                            disable_save_button(false);
                            dirty = false;
                        }
                            
                    }
                }
        }else{ 
            // если не объект (Json), запишем в контентдив 
            var contentDiv = document.querySelector("#tabs-content");
            contentDiv.innerHTML = result;
        }
        
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

    function show_loader(item)
    {
        item.innerHTML = '<img class="loader" src="<?=ROOT?>/assets/images/loader.gif" alt="loader">';
    }

    show_tab(tab);

// для сохранения контента
    function save_content()
    {
        var content = document.querySelector("#tabs-content");
        var inputs = content.querySelectorAll("input, textarea, select");

        var obj = {};
        obj.data_type = "save";
        obj.tab_name = tab;

        for (var i = 0; i < inputs.length; i++) {

            var key = inputs[i].name;
            obj[key] = inputs[i].value;
        }
        send_data(obj);
    }

    var course_image_uploading = false;
    var ajax_course_image = null;

    function upload_course_image(file)
    {
        if (course_image_uploading)
        {
            alert("Идет загрузка файла");
            return;
        }

        // проверка типа файла
        var allowed_types = ['jpg', 'jpeg', 'png'];
        var ext = file.name.split('.').pop().toLowerCase();

        if(!allowed_types.includes(ext))
        {
            alert("Разрешенные типы файлов: "+allowed_types.join(", "));
            return;
        }
        // превью картинки
        var img = document.querySelector(".js-image-upload-preview");
        var link = URL.createObjectURL(file);
        img.src = link;

        // начало загрузки
        course_image_uploading = true;

        document.querySelector(".js-image-upload-info").innerHTML = file.name;
        document.querySelector(".js-image-upload-info").classList.remove("hide");
        document.querySelector(".js-image-upload-input").classList.add("hide");
        document.querySelector(".js-image-upload-cancel-button").classList.remove("hide");

        var myform = new FormData();
        ajax_course_image = new XMLHttpRequest();

        // обработчик для закачки
        ajax_course_image.addEventListener('readystatechange', function(){
        if(ajax_course_image.readyState == 4)
            {
                if(ajax_course_image.status == 200){
                    //все гуд
                    //alert("Загрузка завершена");
                    
                    //alert(ajax_course_image.responseText); 
                
                }
                    course_image_uploading = false;
                    document.querySelector(".js-image-upload-info").classList.add("hide");
                    document.querySelector(".js-image-upload-input").classList.remove("hide");
                    document.querySelector(".js-image-upload-cancel-button").classList.add("hide");
            }
        });

        // обработчик для ошибок
        ajax_course_image.addEventListener('error', function(){
            alert("Возникла ошибка");
        });
        // обработчик для отмены
        ajax_course_image.addEventListener('abort', function(){
            alert("Загрузка отменена");
        });

        // обработчик для прогресса загрузки файла
        ajax_course_image.upload.addEventListener('progress', function(e){

            var percent = Math.round((e.loaded / e.total) * 100);
            document.querySelector(".progress-bar-image").style.width = percent + "%";
            document.querySelector(".progress-bar-image").innerHTML = percent + "%";

        });

        myform.append('data_type', 'upload_course_image');
        myform.append('tab_name', tab);
        myform.append('image', file);
        myform.append('csrf_token', document.querySelector(".js-csrf_token").value);

        ajax_course_image.open('post', '', true);
        ajax_course_image.send(myform);
    }
    // отмена загрузки файла
    function ajax_course_image_cancel()
    {
        ajax_course_image.abort();
    }



    var course_video_uploading = false;
    var ajax_course_video = null;

    function upload_course_video(file)
    {
        if (course_video_uploading)
        {
            alert("Идет загрузка файла");
            return;
        }

        // проверка типа файла
        var allowed_types = ['mp4'];
        var ext = file.name.split('.').pop().toLowerCase();

        if(!allowed_types.includes(ext))
        {
            alert("Разрешенные типы файлов: "+allowed_types.join(", "));
            return;
        }
        // превью видео
        var vid = document.querySelector(".js-video-upload-preview");
        var link = URL.createObjectURL(file);
        vid.src = link;

        // начало загрузки
        course_video_uploading = true;

        document.querySelector(".js-video-upload-info").innerHTML = file.name;
        document.querySelector(".js-video-upload-info").classList.remove("hide");
        document.querySelector(".js-video-upload-input").classList.add("hide");
        document.querySelector(".js-video-upload-cancel-button").classList.remove("hide");

        var myform = new FormData();
        ajax_course_video = new XMLHttpRequest();

        // обработчик для закачки
        ajax_course_video.addEventListener('readystatechange', function(){
        if(ajax_course_video.readyState == 4)
            {
                if(ajax_course_video.status == 200){
                    //все гуд
                    //alert("Загрузка завершена");
                    
                    //alert(ajax_course_video.responseText); 
                
                }
                    course_video_uploading = false;
                    document.querySelector(".js-video-upload-info").classList.add("hide");
                    document.querySelector(".js-video-upload-input").classList.remove("hide");
                    document.querySelector(".js-video-upload-cancel-button").classList.add("hide");
            }
        });

        // обработчик для ошибок
        ajax_course_video.addEventListener('error', function(){
            alert("Возникла ошибка");
        });
        // обработчик для отмены
        ajax_course_video.addEventListener('abort', function(){
            alert("Загрузка отменена");
        });

        // обработчик для прогресса загрузки файла
        ajax_course_video.upload.addEventListener('progress', function(e){

            var percent = Math.round((e.loaded / e.total) * 100);
            document.querySelector(".progress-bar-video").style.width = percent + "%";
            document.querySelector(".progress-bar-video").innerHTML = percent + "%";

        });

        myform.append('data_type', 'upload_course_video');
        myform.append('tab_name', tab);
        myform.append('video', file);
        myform.append('csrf_token', document.querySelector(".js-csrf_token").value);

        ajax_course_video.open('post', '', true);
        ajax_course_video.send(myform);
    }
    // отмена загрузки файла
    function ajax_course_video_cancel()
    {
        ajax_course_video.abort();
    }
</script>

<?php $this->view('admin/admin-footer', $data) ?>
