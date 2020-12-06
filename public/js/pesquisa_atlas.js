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

// Pesquisa categoria no atlas
$(document).ready(function(){
    $("#pesquisa_categoria").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#categorias a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

// Pesquisa disciplina no atlas
$(document).ready(function(){
    $("#pesquisa_disciplina").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#disciplinas a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});