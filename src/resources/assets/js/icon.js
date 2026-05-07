(function ($) {
    "use strict"

    $(document).ready(function () {

        var iconsLoaded = false;
        var iconsHtml = '';

        $(document).on('focusin', '.icon', function () {

            let url = $('#icon_url').val();
            let holder = $(this).data('show');
            $(holder).addClass('icon-showcase');
            $(holder).show(); 
            if (iconsLoaded) {
                $(holder).html(iconsHtml);
                return;
            }
            $.ajax({
                url: url,
                method: 'GET',
                success: function (res) {
                    let html = '';

                    res.forEach(function (icon) {
                        html += `<div data-icon="${icon.icon}" class="icon-select"><i class="${icon.icon}"></i></div>`;
                    });
                    iconsHtml = html;
                    iconsLoaded = true;
                    $(holder).html(html);
                }
            });
        });


       
        $(document).on('focusout', '.icon', function () {
            let holder = $(this).data('show');
            setTimeout(function () {
                $(holder).removeClass('icon-showcase');
                $(holder).html('');
            }, 200);
        });


        let timer;
        $(document).on('input', '.icon', function () {
           
            clearTimeout(timer);

            let url = $('#icon_url').val();
            let icon = $(this).val();
            let holder = $(this).data('show');
            timer = setTimeout(function () {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        icon: icon
                    },
                    success: function (res) {
                        let html = '';
                        res.forEach(function (icon) {
                            html += `<div data-icon="${icon.icon}" class="icon-select"><i class="${icon.icon}"></i></div>`;
                        });
                        iconsHtml = html;
                        iconsLoaded = true;
                        $(holder).html(html);
                    }
                });
            }, 300);
        });

        $(document).on('click', '.icon-select', function () {   
            let icon = $(this).data('icon');
            let input = $('.icon');
            console.log(input);
            $(input).val(icon);
            $(".icon-showcase").html("");
            $(".icon-showcase").removeClass('icon-showcase');   
        });
    });
})(jQuery);