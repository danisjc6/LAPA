// Pesquisa no atlas
$(document).ready(function(){
    $("#pesquisa_atlas").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#paginasAtlas a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

// Pesquisa no atlas
$(document).ready(function(){
    $("#pesquisa_fotos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#fotosAtlas a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

