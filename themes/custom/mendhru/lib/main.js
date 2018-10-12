jQuery(document).ready(function($) {


     $('.topnav a').click(function(){
        $('#sideNavigation').css('width','250px');
        $("#main").css('marginLeft','250px');
      });
       
      $('.closebtn').click(function(){
        $('#sideNavigation').css('width' , '0');
        $("#main").css('marginLeft',"0");
      });  

});