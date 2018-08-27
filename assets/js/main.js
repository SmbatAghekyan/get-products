$(document).ready(function(){
	
    //creating task
    $(".get-products-form").submit(function(e) {
        e.preventDefault();
        var market = $('.market-select').find(":selected").data('market');
        if(market === 'amazon') return false;
        var product = $('.search-text').val();
        $('.search-text').removeClass('border border-danger');
        if(!product){
            $('.search-text').addClass('border border-danger');
            return false;
        }
        $('.loader').show();
        var url = market;
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'text',
            data: {'product': product},
            success: function(data)
            {
                $("#search_box").remove();
                $(".container").append(data);
                $('.loader').hide();
            }
        });

    });


});