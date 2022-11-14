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
                    <td><?=esc($row->price_id)?></td>
                    <td><?=esc($row->primary_subject)?></td>
                    <td><?=get_date($row->date)?></td>
                    <td>
                        <i class="bi bi-pencil-square"></i> 
                        <i class="bi bi-trash-fill"></i>
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

        <?php $this->view('admin/admin-footer', $data) ?>
