$(function(){
    $(".item-tarea").on("click", function(ev){
        ev.preventDefault();
        $(".item-tarea").css("background-color", "#F4F6F9");
        $(this).css("background-color", "#fff");
    });
    
})