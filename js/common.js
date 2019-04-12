$(document).ready(function () {
    fixFooter();

    $(".form-ajax-btn").click(function(e){
        e.preventDefault();
        var btn=$(this);
        formAjaxSubmit(btn,commonSucHdl,commonErrHdl);
    });
});
//get the height of current browser, calculate current windows' component height
function fixFooter(){
    var windowHeight=$(window).height();
    var headHeight=$("#head").height();
    var footHeight=$("#foot").height();
    var bodyHeight=windowHeight-headHeight-footHeight;
    $("#body").css("min-height",bodyHeight);
}

function formAjaxSubmit(btn,success,error){
    var f=btn.closest("form.form-ajax-post");
    //var f=$(".form-ajax-post");
    var u=f.attr("data-action");
    var data=f.serialize();
    $.ajax({
        url:u,
        type:'post',
        data:data,
        success:function(result){
            var r=JSON.parse(result);
            if(r.success){
                success(r);
                headerPage(f.attr('data-url'));
            }
            else{
                error(r);
            }
        },
        error:function(r){
            alert("connection error");
        }
    })
}
function commonSucHdl(r){
    alert(r.info);
}
function commonErrHdl(r){
    $("#error").val(r.error);
}
function headerPage(url){
    window.location.href=url;
}


