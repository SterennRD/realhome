$(document).ready(function () {
    // variables
    var left = 'home__team_control_left',
        right = 'home__team_control_right',
        control = $('.home__team_control'),
        item = $('.home__team_item'),
        nb_team = $('.home__team_item').length,
        i = 1;

    // On cache tous les items sauf le premier
    item.hide();
    $('.home__team_item--' + i).show();

    // Fonction au clic d'une flèche
    $(control).click(function () {
        // Flèche gauche
        if ($(this).hasClass(left)) {
            // On décrémente la variable i
            i--;
            // On cache les items
            item.fadeOut(500);
            // On fait apparaître l'item précédent
            $('.home__team_item--' + i).delay(500).fadeIn(500);
            // Si on arrive au bout, on applique à i la valeur nb_team
            if (i < 1) {
                item.fadeOut(500);
                i = nb_team;
                $('.home__team_item--' + i).delay(500).fadeIn(500);
            }
        // Flèche droite
            // Même fonctionnement, mais on incrémente i
        } else {
            i++;
            item.fadeOut(500);
            $('.home__team_item--' + i).delay(500).fadeIn(500);
            // Quand i dépasse la valeur nb_team, on revient à 1
            if (i > nb_team) {
                item.fadeOut(500);
                i = 1;
                $('.home__team_item--' + i).delay(500).fadeIn(500);
            }
        }
    });
});