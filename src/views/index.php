<?php
    require './src/views/layout/header.php';
?>

<!-- View options section -->
<div class="row m-1 p-3 px-5 justify-content-end">
    <div class="col-auto d-flex align-items-center">
        <label class="text-secondary my-2 pr-2 view-opt-label me-2">Start date</label>
        <input class="" id="start_date" name="start_date"/>
    </div>
    <div class="col-auto d-flex align-items-center">
        <label class="text-secondary my-2 pr-2 view-opt-label me-2">End date</label>
        <input class="" id="end_date" name="end_date"/>
    </div>
    <div class="col-auto d-flex align-items-center">
        <button type="button" class="btn btn-success btn-search-working">Search date</button>
    </div>
    <div class="col-auto d-flex align-items-center">
        <label class="text-secondary my-2 pr-2 view-opt-label">Filter</label>
        <select class="custom-select custom-select-sm btn my-2 ms-2 select-status">
            <option value="all" selected>All</option>
            <option value="0">Planning</option>
            <option value="1">Doing</option>
            <option value="2">Completed</option>
        </select>
    </div>
    <div class="col-auto d-flex align-items-center px-1 pr-3 ms-3 me-3">
        <label class="text-secondary my-2 pr-2 view-opt-label">Sort</label>
        <select class="custom-select custom-select-sm btn my-2 ms-2 me-2 select-date">
            <option value="start_at" selected>Start date</option>
            <option value="end_at">End date</option>
        </select>
        <input type="hidden" name="type_date" class="type-date" value="ASC">
        <i class="fa fa fa-sort-amount-asc text-info btn mx-0 px-0 pl-1 icon-type" type="DESC"></i>
        <i class="fa fa fa-sort-amount-desc text-info btn mx-0 px-0 pl-1 icon-type d-none" type="ASC"></i>
    </div>
    <div class="col-auto d-flex align-items-center px-1 pr-3">
        <form action="add" method="post">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>

<div class="container">
    <table class="table mb-4 table-home">
        <thead>
            <tr>
                <th scope="col" colspan="2">No</th>
                <th scope="col">Work name</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($works as $key => $work):
                $chk = false;
                if ($work->status == 2) {
                    $chk = true;
                }
            ?>
                <tr class="<?php echo $chk ? 'text-decoration' : '' ?>">
                    <th scope="row">
                        <?php echo $key+1 ?>
                    </th>
                    <th scope="row" class="">
                        <input type="checkbox" name="chk_status" class="chk_status"
                            id="<?php echo $work->id ?>" <?php echo $chk ? 'checked' : '' ?>
                        >
                    </th>
                    <td>
                        <?php echo $work->work_name ?>
                    </td>
                    <td>
                        <?php
                            $start_at = new DateTime($work->start_at);
                            echo $start_at->format('F j, Y, g:i a');
                        ?>
                    </td>
                    <td>
                        <?php
                            $end_at = new DateTime($work->end_at);
                            echo $end_at->format('F j, Y, g:i a');
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $config['status'][$work->status];
                        ?>
                    </td>
                    <td class="box-action">
                        <form action="delete" method="post" class="me-2">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="<?php echo $work->id ?>">
                            <button type="button" class="btn btn-danger btn-delete">Delete</button>
                        </form>
                        <form action="edit" method="get">
                            <input type="hidden" name="id" value="<?php echo $work->id ?>">
                            <button type="button" class="btn btn-warning btn-edit">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- <div class="pagination-main">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div> -->
</div>

<?php
    require './src/views/layout/footer.php';
?>