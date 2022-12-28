
<form>
    <div class="col-md-8 mx-auto">
        
        <div class="h5 my-4"><b>Целевая страница курса:</b></div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Заголовок курса</span>
            <input name="title" type="text" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Подзаголовок курса</span>
            <input name ="subtitle" type="text" class="form-control">
        </div>

        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label"><b>Описание курса</b></label>
            <div class="col-sm-10">
            <textarea name="description" class="form-control" style="height: 100px"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 my-3">
                <select name="language_id" class="form-select">
                    <option value="">--Выберите язык--</option>
                </select>
            </div>

            <div class="col-md-6 my-3">
                <select name="level_id" class="form-select">
                    <option value="">--Выберите уровень--</option>
                </select>
            </div>

            <div class="col-md-6 my-3">
                <select name="category_id" class="form-select">
                    <option value="">--Выберите категорию--</option>
                </select>
            </div>

            <div class="col-md-6 my-3">
                <select name="sub_category_id" class="form-select">
                    <option value="">--Выберите подкатегорию--</option>
                </select>
            </div>
            
                <label><b>Ценовая категория курса:</b></label>
                <div class="col-md-4 mb-4">
                    <select name="currency_id" class="form-select">
                        <option value="">--Выберите валюту--</option>
                    </select>
                </div>
                <div class="col-md-8 mb-4">  
                    <select name="price_id" class="form-select">
                        <option value="">--Выберите цену--</option>
                    </select>
                </div>
            
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Основной предмет</span>
            <input name="primary_subject" type="text" class="form-control">
        </div>

        <div class="my-4 row">
            <div class="col-sm-4">
                <img src="<?=ROOT?>/assets/images/placeholder.jpg" style="width: 100%;">
            </div>
            <div class="col-sm-8">
                <div class="h5"><b>Изображение курса:</b></div>
                Загрузите изображение своего курса здесь. Важные требования для успешной загрузки: 750x422 пикселей; jpg, jpeg, gif, png, без текста на изображении.

                <br><br>
                <input type="file" name="">
                <div class="progress my-4">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>

            </div>
        </div>

        <div class="my-4 row">
            <div class="col-sm-4">
                <img src="<?=ROOT?>/assets/images/placeholder.jpg" style="width: 100%;">
            </div>
            <div class="col-sm-8">
                <div class="h5"><b>Рекламное видео:</b></div>
                После просмотра качественного промовидео вероятность того, что студенты запишутся на ваш курс, может увеличиться в 5 раз. A при наличии исключительно хороших видео — даже в 10 раз.

                <br><br>
                <input type="file" name="">
                <div class="progress my-4">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>

            </div>
        </div>

    </div>
</form>