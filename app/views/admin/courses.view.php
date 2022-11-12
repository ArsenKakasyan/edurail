<?php $this->view('admin/admin-header', $data) ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Мои курсы <button class="btn btn-primary float-end"><i class="fa fa-plus"></i> Новый курс</button></h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Основной предмет</th>
                    <th scope="col">Дата</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    <td>2016-05-25</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        <?php $this->view('admin/admin-footer', $data) ?>
