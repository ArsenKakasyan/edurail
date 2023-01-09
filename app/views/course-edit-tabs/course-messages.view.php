
<form>
    <?php csrf() ?>
    <div class="col-md-8 mx-auto">
        
        <div class="my-4 h5 my-4"><b>Сообщения курса</b></div>

        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label"><b>Приветствие</b></label>
            <div class="col-sm-10">
            <textarea name="welcome_message" class="form-control" style="height: 100px"><?=$row->welcome_message?></textarea>
            </div>
            <small class="error error-welcome_message w-100 text-danger"></small>
        </div>

        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label"><b>Поздравление</b></label>
            <div class="col-sm-10">
            <textarea name="congratulations_message" class="form-control" style="height: 100px"><?=$row->congratulations_message?></textarea>
            </div>
            <small class="error error-congratulations_message w-100 text-danger"></small>
        </div>

    </div>
</form>