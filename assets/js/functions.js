$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $(document).on('click', '.paginasi', function (event) {
        event.preventDefault();
        $('.paginasi').removeClass('active');
        $(this).parent('.paginasi').addClass('active');
        page = $(this).attr('halaman').split('page=')[1];
        load_list(page);
    });

    const datatables = document.getElementById('datatables');
    if (datatables) {
        new simpleDatatables.DataTable(datatables);
    }
});

function main_content(obj) {
    $("#content_list").hide();
    $("#content_input").hide();
    $("#content_detail").hide();
    $("#" + obj).show();
}

function load_list(url) {
    $.get(url, function (data) {
        $('#list_result').html(data);
        main_content('content_list');
        new simpleDatatables.DataTable(datatables);
    }, "html");
}

function load_input(url) {
    $.get(url, {}, function (result) {
        $('#content_input').html(result);
        main_content('content_input');
    }, "html");
}

function load_detail(url) {
    $.get(url, {}, function (result) {
        $('#content_detail').html(result);
        main_content('content_detail');
    }, "html");
}

function handle_save(tombol, form, url) {
    $(document).one('submit', form, function (e) {
        let data = $(form).serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $(tombol).prop("disabled", true);
                $(tombol).html("Please wait");
            },
            success: function (response) {
                if (response.alert == "success") {
                    success_toastr(response.message);
                    $(form)[0].reset();
                    setTimeout(function () {
                        $(tombol).prop("disabled", false);
                        $(tombol).html('Simpan');
                        main_content('content_list');
                    }, 2000);
                } else {
                    error_toastr(response.message);
                    setTimeout(function () {
                        $(tombol).prop("disabled", false);
                        $(tombol).html('Simpan');
                    }, 2000);
                }
            },
        });
    });
}

function hapus(id, url) {
    var data = {
        'id': id,
        'action': 'hapus'
    }
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: function (response) {
                    Swal.fire(
                        'Terhapus!',
                        'Data anda telah terhapus.',
                        'success'
                    ).then(function () {
                        load_list(response.url);
                    });
                }
            });
        } else {
            Swal.fire(
                'Dibatalkan!',
                'Data anda tidak jadi dihapus.',
                'error'
            )
        }
    })
}

function handle_open_modal(url, modal, content) {
    $.ajax({
        type: "GET",
        url: url,
        success: function (html) {
            $(modal).modal('show');
            $(content).html(html);
        },
        error: function () {
            $(content).html('<h3>Ajax Bermasalah !!!</h3>')
        },
    });
}

function handle_save_modal(tombol, form, url, method, modal) {
    $(tombol).submit(function () {
        return false;
    });
    let data = $(form).serialize();
    $(tombol).prop("disabled", true);
    $(tombol).attr("data-kt-indicator", "on");
    loading();
    $.ajax({
        type: method,
        url: url,
        data: data,
        dataType: 'json',
        beforeSend: function () {},
        success: function (response) {
            loaded();
            if (response.status == "success") {
                success_toastr(response.message);
                $(form)[0].reset();
                load_list(response.url);
                setTimeout(function () {
                    $(modal).modal('hide');
                    $(tombol).prop("disabled", false);
                    $(tombol).removeAttr("data-kt-indicator");
                    main_content('content_list');
                }, 2000);
            } else {
                error_toastr(response.message);
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).removeAttr("data-kt-indicator");
                }, 2000);
            }
        },
    });
}

function back() {
    $('#content_list').show();
    $('#content_input').hide();
    $('#content_detail').hide();
}