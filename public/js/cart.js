    $(document).ready(function() {
        //plus btn click
        $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $pizzaPrice = Number($parentNode.find('#pizzaPrice').html().replace("kyats", " ")); //text()
                $qty = Number($parentNode.find('#qty').val());

                $total = $pizzaPrice * $qty;

                $parentNode.find("#total").html($total + " kyats");

                //total summary
                //console.log($parentNode.find('#pizzaPrice').val());
                summaryCalculation();


            })
            //minus btn click
        $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#pizzaPrice').html().replace('kyats', ""));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;

                $parentNode.find("#total").html($total + " kyats");

                summaryCalculation();

            })
            //  $('.fa-plus').click(function(event) {
            //     console.log($(event.target))
            // })

        // remove btn click
        // $('.btnRemove').click(function() {
        //     $parentNode = $(this).parents('tr');
        //     $parentNode.remove();

        //     summaryCalculation();
        // })


        function summaryCalculation() {
            $totalPrice = 0;
            $('#dataTable tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));

            });
            $("#subTotalPrice").html(`${$totalPrice} kyats`);
            $('#finalPrice').html(`${$totalPrice +2000} kyats`);
        }


    })