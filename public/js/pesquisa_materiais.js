// Pesquisa na sidebar de materiais
$(document).ready(function(){
    $("#pesquisa_atlas").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#paginasMateriais a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});


// Pesquisa em materiais
$(document).ready(function(){
    $("#pesquisa_materiais").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#materiais a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
