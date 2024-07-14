$(function () {
    $(document).ready(function () {
        const STATUS = {
            0: 'Planning',
            1: 'Doing',
            2: 'Completed'
        };

        $.popup = {
            confirm : function(message, callback) {
                callback(confirm(message));
            },
            error : function(message){
                alert(message);
            },
            success : function(message){
                alert(message);
            },
        }

        $("#start_at").datetimepicker({
            format: "Y/m/d H:i:s",
            onShow: function (ct) {
                this.setOptions({
                    maxDate: $("#end_at").val() ? $("#end_at").val() : false,
                });
            },
            timepicker: false,
        });

        $("#end_at").datetimepicker({
            format: "Y/m/d H:i:s",
            onShow: function (ct) {
                this.setOptions({
                    minDate: $("#start_at").val() ? $("#start_at").val() : false,
                });
            },
            timepicker: false,
        });

        $("#start_date").datetimepicker({
            format: "Y/m/d H:i:s",
            onShow: function (ct) {
                this.setOptions({
                    maxDate: $("#end_date").val() ? $("#end_date").val() : false,
                });
            },
            timepicker: false,
        });

        $("#end_date").datetimepicker({
            format: "Y/m/d H:i:s",
            onShow: function (ct) {
                this.setOptions({
                    minDate: $("#start_date").val() ? $("#start_date").val() : false,
                });
            },
            timepicker: false,
        });

        $(document).on("click", ".btn-back", function (e) {
            window.history.back();
        });

        // Click submit form create
        $(document).on("click", ".btn-create", function() {
            $.popup.confirm("Are you sure you want to create the item?", function(result){
                if(result){
                    $('.form-create').submit();
                }
            });
        });

        // Click submit form delete
        $(document).on("click", ".btn-delete", function() {
            let fromParent = $(this).closest('form');
            $.popup.confirm("Are you sure you want to delete the item?", function(result){
                if(result){
                    $(fromParent).submit();
                }
            });
        });

        // Click submit form edit
        $(document).on("click", ".btn-edit", function() {
            let fromParent = $(this).closest('form');
            $.popup.confirm("Are you sure you want to edit the item?", function(result){
                if(result){
                    $(fromParent).submit();
                }
            });
        });

        // Click submit form create
        $(document).on("click", ".btn-update", function() {
            $.popup.confirm("Are you sure you want to update the item?", function(result){
                if(result){
                    $('.form-update').submit();
                }
            });
        });

        // Click check box change status
        $(document).on("change", ".chk_status", function() {
            let checkbox = $(this);
            let id       = $(this).attr('id');
            let status   = checkbox.is(':checked') ? '2' : '0';
            $.popup.confirm("Are you sure you want to complete the item?", function(result) {
                if(result) {
                    $.ajax({
                        url: '/php_test_nals/check',
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id,
                            status,
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                $.popup.success(response.message);
                                location.reload();
                            } else {
                                $.popup.error(response.message);
                            }
                        },
                        error: function(error) {
                            $.popup.error(error.message)
                        }
                    });
                } else {
                    checkbox.prop('checked', !checkbox.is(':checked'))
                }
            });
        });

        // Click check box change status
        $(document).on("change", ".select-status", function() {
            let selected = $(this).find('option:selected').val();
            $.ajax({
                url: '/php_test_nals/search',
                type: "GET",
                dataType: 'json',
                data: {
                    status: selected,
                },
                success: function(response) {
                    if (response.status == '200') {
                        let html = '';
                        response.data.forEach((el, key) => {
                            html += renderHtml(el, key);
                        });
                        $('.table-home tbody').html(html)
                    } else {
                        $.popup.error(response.message);
                    }
                },
                error: function(error) {
                    $.popup.error(error.message)
                }
            });
        });

        // Click toggle icon type date
        $(document).on("click", ".icon-type", function() {
            let column = $('.select-date').find('option:selected').val();
            let type   = $(this).attr('type');
            $('.type-date').val(type);
            $('.icon-type').removeClass('d-none');
            $(this).addClass('d-none');

            searchDate(column, type);
        });

        // Click check box change status
        $(document).on("change", ".select-date", function() {
            let column = $(this).find('option:selected').val();
            let type   = $('.type-date').val();

            searchDate(column, type);
        });

        // Click check box change status
        $(document).on("click", ".btn-search-working", function() {
            let start_date = $('#start_date').val();
            let end_date   = $('#end_date').val();

            if (start_date && end_date) {
                $.ajax({
                    url: '/php_test_nals/date_working',
                    type: "GET",
                    dataType: 'json',
                    data: {
                        start_date,
                        end_date,
                    },
                    success: function(response) {
                        if (response.status == '200') {
                            let html = '';
                            response.data.forEach((el, key) => {
                                html += renderHtml(el, key);
                            });
                            $('.table-home tbody').html(html)
                        } else {
                            $.popup.error(response.message);
                        }
                    },
                    error: function(error) {
                        $.popup.error(error.message)
                    }
                });
            } else {
                $.popup.error('Validate date!')
            }
        });

        // Call ajax search data
        function searchDate(column, type) {
            $.ajax({
                url: '/php_test_nals/search_date',
                type: "GET",
                dataType: 'json',
                data: {
                    column,
                    type,
                },
                success: function(response) {
                    if (response.status == '200') {
                        let html = '';
                        response.data.forEach((el, key) => {
                            html += renderHtml(el, key);
                        });
                        $('.table-home tbody').html(html)
                    } else {
                        $.popup.error(response.message);
                    }
                },
                error: function(error) {
                    $.popup.error(error.message)
                }
            });
        }

        // Render tag html
        function renderHtml(el, key) {
            let start_at = moment(el.start_at).format("MMMM D, YYYY, h:mm a");
            let end_at   = moment(el.end_at).format("MMMM D, YYYY, h:mm a");
            return `
                <tr class="${el.status == '2' ? 'text-decoration' : ''}">
                    <th scope="row">
                        ${key+1}
                    </th>
                    <th scope="row" class="">
                        <input type="checkbox" name="chk_status" class="chk_status"
                            id="${el.id}" ${el.status == '2' ? 'checked' : ''}
                        >
                    </th>
                    <td>${el.work_name}</td>
                    <td>
                        ${start_at}
                    </td>
                    <td>
                        ${end_at}
                    </td>
                    <td>
                        ${STATUS[el.status]}
                    </td>
                    <td class="box-action">
                        <form action="delete" method="post" class="me-2">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="${el.id}">
                            <button type="button" class="btn btn-danger btn-delete">Delete</button>
                        </form>
                        <form action="edit" method="get">
                            <input type="hidden" name="id" value="${el.id}">
                            <button type="button" class="btn btn-warning btn-edit">Edit</button>
                        </form>
                    </td>
                </tr>
            `;
        }
    });
});
