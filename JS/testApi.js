$(document).ready(function() {
    /*$.ajax({
        method: "GET",
        url: "http://localhost:8383/Api_Mcp_test/tiers",
        dataType:'json',
        success: function (records){
            for (let i = 0; i < records.length ; i++) {
                console.log(records[i].id);

                $('#all').append(
                    "<tr id='"+ records[i].id +"'>" +
                    "<td><button onclick='getId("+records[i].id+")'>"+records[i].id +"</button></td>" +
                    "<td><button onclick='remove("+records[i].id+")'>"+records[i].username +"</button></td>" +
                    "<td>"+records[i].age +"</td>" +
                    "<td>"+records[i].email +"</td>" +

                    "</tr>"
                );
            }

        }
    });*/
    /*$('#formsId').submit(function (e){
        let username = $(this).find("input[name=username]").val();
        let password=  $(this).find("input[name=password]").val();
        let age =  $(this).find("input[name=age]").val();
        let email = $(this).find("input[name=email]").val();
        let data  = {username : username,password:password,age:age,email:email};

        $.post("localhost/Api_Mcp_test/tiers/create",data,function (result)
        {
            console.log(e);
        });


    });*/



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
               url: "http://localhost:8383/Api_Mcp_test/create",
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

