/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("sideNavigation").style.width = "250px";
    //document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("sideNavigation").style.width = "0";
    //document.getElementById("main").style.marginLeft = "0";
}
/*  //Jquery example
$('.topnav a').click(function(){
  $('#sideNavigation').style.width = "250px";
  $("#main").style.marginLeft = "250px";
});
$('.closebtn').click(function(){
  $('#sideNavigation').style.width = "0";
  $("#main").style.marginLeft = "0";
});*/