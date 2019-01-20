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

    $('.filter').on('click', function(el) {
        el.preventDefault();
        var slug = $(this).attr("data-id");
        jQuery.post(
            ajaxurl,
            {
                'action': 'filter_city',
                'param': slug
            },
            function(response){
                $('.test').html(response);
            }
        );
    });
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