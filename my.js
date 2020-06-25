$('form.ajax').on('submit', function(){
    var load = $(this),
        url = load.attr('action'),
        type = load.attr('method'),
        data = {};

    load.find('[name]').each(function(index, value){
        var load = $(this), 
            name = load.attr('name');
            value = load.val();

            data[name] = value;
    });

    $.ajax({
        url: url,
        type: type,
        data: data, 

        success: function(reponse){
            console.log(response);
        }
    });

    return false;
});