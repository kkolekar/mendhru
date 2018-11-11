jQuery(document).ready(function($) {


     $('.topnav a').click(function(){
        $('#sideNavigation').css('width','250px');
        $("#main").css('marginLeft','250px');
      });
       
      $('.closebtn').click(function(){
        $('#sideNavigation').css('width' , '0');
        $("#main").css('marginLeft',"0");
      });
      
      $('.like-button').on('click',function(){
          var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
        
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };
        $.ajax({
          type:'post',
          url:'profile-activity ',
          data:{
            memberid:getUrlParameter('memberId'),
            type:'profilelike'
          },
          success:function(responce){
            console.log(responce);
          }
        });


      });
});