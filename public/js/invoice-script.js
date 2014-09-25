$(document).ready(function(){

    console.log("file loaded");

    // Events

    $("#add_element").click(addElement);
    $(document).on('click', ".delete_element", function(){
        deleteElement($(this));
    });


    // Functions

    var counter = 1;
    function addElement(){
        console.log('adding element');

        var date = $('#valeted_date').val();
        var quantity = $('#quantity').val();

        var vehicle_fk = $('#vehicle_fk').val();
        var vehicle_type  = $('#vehicle_fk option:selected').text();

        var unit_price = getVehiclePrice();
        if(quantity > 0) {
            var line_total = quantity * unit_price;
        }
        else{
            var line_total = unit_price;
        }

        $("#invoice_elements").append('<tr><td>' + quantity + '</td>'
                                    + '<td>' + quantity  + ' cars valeted on ' + date + ' ' + vehicle_type + '</td>'
                                    + '<td>£' + unit_price + '</td>'
                                    + '<td>£' + line_total + '</td>'
                                    + '<td>' + '<input type="button" id="' + counter + '" class="delete_element" value="X">' + '</td>'
                                    + '</tr>');

        var invoice_element = {
                                'index' : counter,
                                'quantity' : quantity,
                                'vehicle_fk' : vehicle_fk,
                                'date' : date
                              };

        storeInvoiceElement(invoice_element);
        counter++;
    }


    function deleteElement(thisObj){
        console.log('removing element');

        // Remove the HTML element.
        $(thisObj).closest("tr").remove();

        var targetElement = thisObj.attr('id');
        var currentList = $.parseJSON($('#elements_list').val());
        var arrayLength = currentList.length;

        for (var i = 0; i < arrayLength; i++) {
            // If it's an actual object that contains the "index" element, proceed.
            if(currentList[i]['index']) {
                if (currentList[i]['index'] == targetElement) {
                    currentList.splice(i, 1);
                }
            }
        }

        $('#elements_list').val(JSON.stringify(currentList));
        console.log(currentList);
    }


    function getVehiclePrice(){
        console.log('getting the price')

        var selectedVehicle = $('#vehicle_fk').val();
        // Get the price for the selected vehicle.
        $("#vehicles_pricelist").val(selectedVehicle);
        var price = $('#vehicles_pricelist option:selected').text();

        return price;
    }


    function storeInvoiceElement(invoice_element){
        console.log('storing element..');

        // Add a trailing comma if there are more than one element. Remove trailing comma after adding, place brackets. Rinse, repeat.
        var jsonElement = JSON.stringify(invoice_element);

        var currentList = $('#elements_list').val();

        // If the array is JSONified, remove the brackets.
        if(currentList.substr(0, 1) == '['){
            // If the array is not empty, delete the brackets, add a comma at the end.
            if(currentList.substr(1, 1) != ']') {
                currentList = currentList.substr(1);
                currentList = currentList.slice(0, -1);
                currentList = currentList + ', ';
            }
            // If the array is empty, clear the field entirely.
            else{
                $('#elements_list').val('');
                currentList = $('#elements_list').val();
            }
        }

        $('#elements_list').val( currentList + jsonElement + ',');

        var newList = $('#elements_list').val();
        newList = newList.slice(0, -1);

        $('#elements_list').val('[' + newList + ']');

    }


// Client-side check if the quantity is a numeric value.
    $("#quantity").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});