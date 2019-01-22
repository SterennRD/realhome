$(document).ready(function(){
    // $(".filter").click(function(el){
    //     el.preventDefault();
    //     console.log(this.href);
    //     var url = this.href;
    // console.log(this.href);
    //     fetch(url , {
    //         method: 'GET',
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //         }
    //     })
    //         .then(response => response.json())
    //         .then(data => console.log(data))
    //     ;
    // });

    $('.filter__link').on('click', function(el) {
        el.preventDefault();
        console.log("toto");
        $(this).siblings().removeClass('filter__link--active');
        if ($(this).hasClass("filter__link--active")) {

        } else {
            $(this).addClass('filter__link--active');
            $('.test').html("<b>Chargement...</b>");
            var slug = $(this).attr("data-id");
            jQuery.post(
                ajaxurl,
                {
                    'action': 'filter_city',
                    'param': slug
                },
                function(response){
                    $('.properties__wrapper').html(response);
                }
            );
        }

    });

    $('.header__trigger').click(function() {
        $(this).toggleClass("header__trigger--active");
        $(this).next('.header__menu--mobile').slideToggle();
    });

    $("#lightgallery").lightGallery();
});




// var filter = $('.filter');
// filter.addEventListener('click', function(e){
//     e.preventDefault();
//     var url = this.href;
//     console.log(this.href);
//
// });
//
// function filterVille(e) {
//     e.preventDefault();
//     var url = this.href;
//     console.log(this.href);
    // fetch($url , {
    //     method: 'GET',
    //     headers: {
    //         'X-Requested-With': 'XMLHttpRequest'
    //     }
    // })
    //     .then(response => response.json())
    //     .then(data => console.log(data))
    // ;
//}