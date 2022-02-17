$(document).ready(function() {
    $.ajax({
        method: "GET",
        url: "http://localhost:8383/Api_Mcp_test/getAllTiers",
        dataType:'json',
        success: function (records){
            for (let i = 0; i < records.length ; i++) {
                $('#all').append(
                    "<tr id='user_"+ records[i].id +"'>" +

                    "<td><button onclick='getId("+records[i].id+")'>"+records[i].id +"</button></td>" +
                    "<td><button onclick='remove("+records[i].id+")'>"+records[i].username +"</button></td>" +
                    "<td>"+records[i].age +"</td>" +
                    "<td>"+records[i].email +"</td>" +

                    "</tr>"
                );
            }

        }
    });


});

function getId(id)
{
    $.ajax({
        method: "GET",
        url: "http://localhost:8383/Api_Mcp_test/tiers/"+id,
        dataType:'json',
        success: function (records){
            console.log(records);
        }
    });
}

function remove(id)
{
    $.ajax({
        method: "DELETE",
        url: "http://localhost:8383/Api_Mcp_test/delete/"+id,
        dataType:'json',
        success: function (records){
            console.log(records)
        }
    });
}

