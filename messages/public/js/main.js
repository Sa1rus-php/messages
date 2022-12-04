$(document).ready(function(){


        $(".comment-container").delegate(".reply","click",function(){

            var well = $(this).parent().parent();
            var cid = $(this).attr("cid");
            var name = $(this).attr('name_a');
            var token = $(this).attr('token');
            var form = '<form method="post" action="/child_create"><input type="hidden" name="_token" value="'+token+'"><input type="hidden" name="id_parent_message" value="'+ cid +'"><input type="hidden" name="name" value="'+name+'"><div class="form-group"><textarea class="form-control" name="text" placeholder="Enter your reply" > </textarea> </div> <div class="form-group"> <input class="btn btn-primary" type="submit"> </div></form>';

            well.find(".reply-form").append(form);



        });

        $(".comment-container").delegate(".like-comment","click",function(){

        	var cdid = $(this).attr("comment-id");
        	var token = $(this).attr("token");
        	$.ajax({
                    url : "/like_message",
                    method : "POST",
                    data : {_token: token, id_message: cdid},
                    success:function(response){
                        console.log('Success')
                }
            });
        });

        $(".comment-container").delegate(".dont-like-comment","click",function(){

        	var token = $(this).attr("token");
        	var well = $(this).parent().parent();
        	$.ajax({
                    url : "/delete_like_message",
                    method : "POST",
                    data : {_token: token},
                    success:function(response){
                        console.log('Success')
                }
            });
        });

        $(".comment-container").delegate(".delete-comment","click",function(){

        	var cdid = $(this).attr("comment-did");
        	var token = $(this).attr("token");
        	var well = $(this).parent().parent();
            if (confirm("Are you sure you want to delete this..!")) {
        	$.ajax({
                    url : "/parent_delete/"+cdid,
                    method : "POST",
                    data : {_token: token},
                    success:function(response){
                    if (response == 'Success delete reply and message') {
                        well.hide();
                    }
                }
            });
            }
        });

    $(".comment-container").delegate(".reply-to-reply","click",function(){
        var well = $(this).parent().parent();
        var cid = $(this).attr("rid");
        var rname = $(this).attr("rname");
        var token = $(this).attr("token")
        var form = '<form method="post" action="/child_create"><input type="hidden" name="_token" value="'+token+'"><input type="hidden" name="id_parent_message" value="'+ cid +'"><input type="hidden" name="name" value="'+rname+'"><div class="form-group"><textarea class="form-control" name="text" placeholder="Enter your reply" > </textarea> </div> <div class="form-group"> <input class="btn btn-primary" type="submit"> </div></form>';

        well.find(".reply-to-reply-form").append(form);

    });

        $(".comment-container").delegate(".delete-reply", "click", function(){

            var well = $(this).parent().parent();

            if (confirm("Are you sure you want to delete this..!")) {
                var did = $(this).attr("did");
                    var token = $(this).attr("token");
                    $.ajax({
                        url : "/child_delete/"+did,
                        method : "POST",
                        data : {_token: token},
                        success:function(response){
                            if (response == 'Success delete reply') {
                                well.hide();
                            }else if(response == 'Error delete'){
                                alert('Oh! You can not delete other people comment');
                            }else{
                                alert('Error delete ');
                            }
                        }
                    })
            }
        });

    });
