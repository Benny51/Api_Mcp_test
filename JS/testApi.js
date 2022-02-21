$(document).ready(function() {

    $('#formsId').submit(function (ev) {
        ev.preventDefault();

        let username = $(this).find('input[name="username"]').val();
        let email = $(this).find('input[name="email"]').val();
        let age = $(this).find('input[name="age"]').val();
        let password = $(this).find('input[name="password"]').val();

        let formData = {username:username,email:email,age:age,password:password};

        $.ajax({
            method: "POST",
            url: "http://localhost:8383/Api_Mcp_test/tiers/create",
            dataType: "json",
            data : formData,
            beforeSend : function (){
                console.log(formData)
            },
            success: function (res) {
                console.log(res)
            },
            error:function(error){
                console.log(error);
            }
        });

    });


    $.ajax({
        method: "GET",
        url: "http://localhost:8383/Api_Mcp_test/tiers",
        dataType:'json',
        success: function (records){
            for (let i = 0; i < records.data.length ; i++) {
                $('#all').append(
                    "<tr id='"+ records.data[i].id +"'>" +
                    "<td><button onclick='getId("+records.data[i].id+")'>"+records.data[i].id +"</button></td>" +
                    "<td><button onclick='remove("+records.data[i].id+")'>"+records.data[i].username +"</button></td>" +
                    "<td>"+records.data[i].age +"</td>" +
                    "<td>"+records.data[i].email +"</td>" +

                    "</tr>"
                );
            }

        }
    });



});

/*
function getId(id)
{
    $.ajax({
        method: "GET",
        url: "http://localhost:8383/Api_Mcp_test/tiers/"+id,
        dataType:'json',
        success: function (records){
            console.log(records)
        },
        error:function (error){

            let obj = JSON.parse( error.responseText);
            console.log(obj);


        }
    });
}*/
/*
function remove(id)
{
    $.ajax({
        method: "DELETE",
        url: "http://localhost:8383/Api_Mcp_test/tiers/delete/"+id,
        dataType:'json',
        success: function (records){
            $('#'+id).fadeOut("slow");
        }
    });
}*/
/*
$(document).ready(function() {

       $('form').ajax(function (e){
           $.ajax({
               method: "POST",
               url: "http://localhost:8383/Api_Mcp_test/tiers/create",
               dataType:'json',
               success: function (records){
                console.log(records);
               }
           });

       });

   /*$('#submit').click(function (){

        let $form = $('#formsId');
        let url = $form.attr("action");
        let method = $form.attr("method");

       $.ajax({
           method: method,
           url: url,
           dataType:'json',
           success: function (records){
               console.log(records)
           }
       });
   });*/

