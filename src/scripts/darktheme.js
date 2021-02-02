/*$(function(){
    $("#switch").on("click", function(){
        $("#switch").toggleClass("active");

        $(".content-wrapper").css({
            backgroundColor: "#ff0000 !important" 
        });
    });
});*/

const btnswitch = document.querySelector('#switch');

btnswitch.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    btnswitch.classList.toggle('active');
})