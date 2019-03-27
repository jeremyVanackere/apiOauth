
select();
selectFamille();

function select()
{
    $.get("api.php", // Appel ajax en GET
	{

	},
	function(data, status){
        if(data != "erreur")
        {
            var json = jQuery.parseJSON(data);
            var table = "";
            json.forEach(elem => {
                table += "<tr>";
                table += "<td>"+elem.id+"</td>";
                table += "<td name='date' data='date' id='"+elem.id+"'>"+elem.date+"</td>";
                table += "<td name='nom' data='nom' id='"+elem.id+"'>"+elem.name+"</td>";
                table += "<td>"+elem.prenom+"</td>";
                table += "<td><input type='button' class='btn rouge' data='"+elem.id+"' value='remove' id='remove'/></td>";
                table += "</tr>";
            });
            $("#zone").html(table);
        }else{
            alert("il y a une erreur d'authenfication!");
        }
    });
}

function selectFamille()
{
    $.get("api.php", // Appel ajax en GET
	{
		action: "famille",
	},
	function(data, status){
       var json = jQuery.parseJSON(data);
       var table = "";
       json.forEach(elem => {
           table += "<option>"+elem.prenom+"</option>";
       });
       $("#famille").html(table);
    });
}

    /// click sur le button add
$("#add").click(function(){
    event.preventDefault();
    nom = $("#textName").val();
    date = $("#textDate").val();
    prenom = $('#famille').find(":selected").text();

    if(date != "")
    {
        $.get("api.php", // Appel ajax en GET
        {
            action: "add",
            name: nom,
            date: date,
            prenom: prenom,
        },
        function(data, status){
        select();
        });
    }else
        alert("il faut mettre une date");
});

$(document).on("click","[name=nom]",function(){

    // On recupére le td qui a deja un input et on le remet en mode normal
    otherTd = $("[name=change]");

    // on récupere le td actuel et on met un input text avec un button
    td = $(this);
    valeur = td.html();
    td.attr('name','change');
    input = "<input type='text' value='"+valeur+"' /><input type='button' data='nom' id='change' class='btn bleu' value='update'/>";
    td.html(input);

    if(otherTd.length > 0)
    {
        if(otherTd.attr('data') == 'nom') 
        {
            otherTd.attr('name','nom');
            valOther = otherTd.children('input').val();
            id = otherTd.attr('id');
            otherTd.html(valOther);
            
            event.preventDefault();
            $.get("api.php", // Appel ajax en GET
            {
                action: "updateName",
                id: id,
                name: valOther,
            },
            function(data, status){
                
            });
        }
        if(otherTd.attr('data') == 'date') 
        {
            otherTd.attr('name','date');
            valOther = otherTd.children('input').val();
            id = otherTd.attr('id');
            otherTd.html(valOther);
            
            event.preventDefault();
            $.get("api.php", // Appel ajax en GET
            {
                action: "updateDate",
                id: id,
                date: valOther,
            },
            function(data, status){
                
            });
        }
    }
});

$(document).on("click","[name=date]",function(){

    // On recupére le td qui a deja un input et on le remet en mode normal
    otherTd = $("[name=change]");

    // on récupere le td actuel et on met un input text avec un button
    td = $(this);
    valeur = td.html();
    td.attr('name','change');
    input = "<input type='date' value='"+valeur+"' /><input type='button' id='changeDate' class='btn bleu' value='update'/>";
    td.html(input);

    if(otherTd.length > 0)
    {
        if(otherTd.attr('data') == 'nom') 
        {
            otherTd.attr('name','nom');
            valOther = otherTd.children('input').val();
            id = otherTd.attr('id');
            otherTd.html(valOther);
            
            event.preventDefault();
            $.get("api.php", // Appel ajax en GET
            {
                action: "updateName",
                id: id,
                name: valOther,
            },
            function(data, status){
                
            });
        }
        if(otherTd.attr('data') == 'date') 
        {
            otherTd.attr('name','date');
            valOther = otherTd.children('input').val();
            id = otherTd.attr('id');
            otherTd.html(valOther);
            
            event.preventDefault();
            $.get("api.php", // Appel ajax en GET
            {
                action: "updateDate",
                id: id,
                date: valOther,
            },
            function(data, status){
                
            });
        }
        
    }
});
 
 $(document).on("click","#change",function(){
    td = $("[name=change]");
    input = td.children('input');
    td.html(input.val());

    id = td.attr('id');
    valeur = input.val();

    event.preventDefault();
    $.get("api.php", // Appel ajax en GET
    {
        action: "updateName",
        id: id,
        name: valeur,
    },
    function(data, status){
        td.attr('name','nom');
    });
});

$(document).on("click","#changeDate",function(){
    td = $("[name=change]");
    input = td.children('input');
    td.html(input.val());

    id = td.attr('id');
    valeur = input.val();

    event.preventDefault();
    $.get("api.php", // Appel ajax en GET
    {
        action: "updateDate",
        id: id,
        date: valeur,
    },
    function(data, status){
        td.attr('name','date');
    });
});

   /// click sur le button remove 
$(document).on("click","#remove",function(){
    event.preventDefault();
    elem = $(this);
    numero = elem.attr("data");
    $.get("api.php", // Appel ajax en GET
	{
        action: "remove",
        id: numero,
	},
	function(data, status){
       select();
    });
});


