$(document).ready(function () {
    //Check Admin Password is correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
       $.ajax({
           type:'post',
           url:'/admin/check-current-pwd',
          data:{current_pwd:current_pwd},
          success:function (resp) {
               if(resp=="false"){
                   $("#chkCurrentPwd").html("<span style='color: #ff1706'>Current password is incorrect!</span>")
               }else if(resp=="true"){
                   $("#chkCurrentPwd").html("<span style='color: #15bc0d'>Current password is correct!</span>")
               }
          } ,error:function () {
               alert("Error");
           }
       });
    });
});
