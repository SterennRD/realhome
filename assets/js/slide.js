$(document).ready(function () {
    var left = 'home__team_control_left',
        right = 'home__team_control_right',
        control = $('.home__team_control'),
        item = $('.home__team_item'),
        nb_team = $('.home__team_item').length,
        i = 1;
    var width = item.width();
    var container = $('.home__team_content');
    console.log(container);

    item.hide();
    $('.home__team_item--' + i).show();

    $(control).click(function () {


        if ($(this).hasClass(left)) {
            i--;            console.log(i);
            item.fadeOut();
            $('.home__team_item--' + i).fadeIn();
            if (i < 1) {

                i = 1;
                $('.home__team_item--' + i).fadeIn();
            }
        } else {
            i++;            console.log(i);
            item.fadeOut();
            $('.home__team_item--' + i).fadeIn();
            if (i > nb_team) {
                item.fadeOut();
                i = 1;
                $('.home__team_item--' + i).fadeIn();
            }
        }
    });
});