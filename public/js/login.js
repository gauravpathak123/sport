jQuery('#loginSubmit').click(function(){
    var loginId=jQuery('#loginId').val();
    var loginPass=jQuery('#loginPass').val();
    
    jQuery.ajax({
        url:"authentication.php",
        type:"POST",
        data: {loginId : loginId,loginPass:loginPass},
        success:function(data){
            var result=eval(data);
            if(result=='valid'){
                window.location="index.php";
				window.reload();
            }
			else if(result=='Your Password Contains Invalid Characters')
			{
				jQuery('#loginResult').html('Your Password Contains Invalid Characters!!');
			}
			else if(result=='Your User Id Contains Invalid Characters')
			{
				jQuery('#loginResult').html('Your User Id Contains Invalid Characters!!');
			}
			else{
                jQuery('#loginResult').html('UserId or Password is Incorrect!!');

            }

        }
    });
});
