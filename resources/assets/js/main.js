$(function () {
    // Инициализация
    $('.tags').select2({
        maximumSelectionLength: 5
    });
});

/*---Registration and Login--------*/
$(document).ready(function ($) {
    /*---Tabs---*/
    let storage = document.cookie.match(/nav-tabs=(.+?);/);
    if (storage && storage[1] !== "#") {
        $('.nav-tabs a[href="' + storage[1] + '"]').tab('show');
    }
    $('ul.nav li').on('click', function() {
        var id = $(this).find('a').attr('href');
        document.cookie = 'nav-tabs=' + id;
    });
    /*let tabTimeout = 250;
    $('.nav-item').on('click', '#tab-login', function (e) {
        e.preventDefault();
        $('#tab-content-register').fadeOut(tabTimeout);
        setTimeout(function () {
            $('#tab-content-login').fadeIn(tabTimeout);
        }, tabTimeout);
    }).on('click', '#tab-register', function (e) {
        e.preventDefault();
        $('#tab-content-login').fadeOut(tabTimeout);
        $('#tab-content-register').fadeIn(tabTimeout);
        let i = btn.index(this);
        window.localStorage.setItem('btn',i);
    });*/

    /*---Check Terms---*/
    $('input#agreeTerms').change(function () {
        if ($(this).is(':checked')) {
            $(this).addClass('checked').val('1');
            $('.btn-register').removeClass('disabled');
            $('.btn-create').removeClass('disabled');
        } else {
            $(this).removeClass('checked').val('0');
            $('.btn-register').addClass('disabled');
            $('.btn-create').addClass('disabled');
        }
    });

    /*---Flash alert---*/
    if ($('.alert-message').length > 0) {
        alert($('.alert-message').attr('data-message'));
    }
    $('#add-favorites').on('click', function() {
        if ($(this).hasClass('no-favorites')) {
            let request = $('#favorites').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/vacancies/favorites/add',
                data: request,
                success: function (data) {
                    /*console.log(data);*/
                },
                error: function (data) {
                    /*console.log(data);*/
                }
            });
            $(this).removeClass('no-favorites');
            $(this).addClass('in-favorites');
            $('#star-favorite').removeClass('fa-regular').addClass('fa-solid');
            alert('Вакансия добавлена в "Избранное"');
        } else {
            let request = $('#favorites').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/vacancies/favorites/delete',
                data: request,
                success: function (data) {
                    /*console.log(data);*/
                },
                error: function (data) {
                    /*console.log(data);*/
                }
            });
            $(this).removeClass('in-favorites');
            $(this).addClass('no-favorites');
            $('#star-favorite').removeClass('fa-solid').addClass('fa-regular');
            alert('Вакансия удалена из "Избранное"');
        }
    });

    $('#extend-filter').on('click', function() {
        $('.container-filter').fadeIn(500);
        $(this).fadeOut(250);
        setTimeout(function () {
            $('#compress-filter').fadeIn();
        }, 250);
    });
    $('#compress-filter').on('click', function() {
        $('.container-filter').fadeOut(500);
        $(this).fadeOut(250);
        setTimeout(function () {
            $('#extend-filter').fadeIn();
        }, 250);

    });

    //------------start Search autocomplete with prompt-------
    $('#input-primary-search').on('keyup', function () {
        let value = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/vacancies/search/prompt',
            data: {'search' : value},
            success: function (data) {
                $('.tbody-prompt').html(data);
            },
            error: function () {}
        });
    });
    $('.table-prompt').on('click', '.tr-prompt', function (e) {
        let val = $(this).find("td").html();
        $('#input-primary-search').val(val);
        /*setTimeout(function () {
            $('.tbody-prompt').html("");
        }, 10);*/
    });

    $("#input-primary-search").bind('focusout', function() {
        setTimeout(function () {
            $('.tbody-prompt').html("");
        }, 100);
    });
    //end Search autocomplete with prompt-------

    //------------start Reset filter-------
    $('#reset-filter').on('click', function () {
        let timeout = 200;
        $('input[name=salary]').animate({opacity: "0.2"}, timeout).animate({opacity: "1"}, timeout).val(null);
        $('select[name=experience]').animate({opacity: "0.2"}, timeout).animate({opacity: "1"}, timeout).val(null);
        $('select[name=schedule]').animate({opacity: "0.2"}, timeout).animate({opacity: "1"}, timeout).val(null);
    });

    //end Reset filter
});
