<?php
    require './src/views/layout/header.php';
?>

<div class="container mt-5">
    <form action="store" method="post" class="form form-create">
        <h3 class="mb-5">Create new todo item</h3>
        <div class="mb-3">
            <label for="work_name" class="form-label">Work name</label>
            <input type="text" name="work_name" class="form-control" id="work_name">
        </div>
        <div class="mb-3">
            <label for="start_at" class="form-label">Start date</label>
            <div class="input-group date date-picker">
                <input class="form-control" id="start_at" name="start_at"/>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="end_at" class="form-label">End date</label>
            <div class="input-group date date-picker">
                <input id="end_at" class="form-control" name="end_at"/>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
            </div>
        </div>
        <div class="mb-5">
            <label for="work_name" class="form-label">Status</label>
            <select class="custom-select custom-select-sm btn my-2 ms-2" name="status">
                <?php foreach ($config['status'] as $key => $value) : ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="button" class="btn btn-primary btn-create">Create</button>
        <button type="button" class="btn btn-warning btn-back">Back</button>
    </form>
</div>

<?php
    require './src/views/layout/footer.php';
?>