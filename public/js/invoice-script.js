$(document).ready(function(){
    console.log("file loaded");

    // Events

    $("#add_element").click(addElement);
    $(document).on('click', "#delete_element", function(){
        deleteElement($(this));
    });


    // Functions

    function addElement(){
        console.log('adding element');
        var date = $('#valeted_date').val();
        var quantity = $('#quantity').val();

        var vehicle_fk = $('#vehicle_fk').val();
        var vehicle_type  = $('#vehicle_fk option:selected').text();

        var employee_fk = $('#employee_fk').val();
        var employee_name = $('#employee_fk option:selected').text();


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
                                    + '<td>' + '<input type="button" value = "X" id="delete_element">' + '</td>'
                                    + '</tr>');

        //var element_obj = {};

        //element_obj[employee]
    }



    function deleteElement(thisObj){
        console.log('removing element');
        $(thisObj).closest("tr").remove();
    }



    function getVehiclePrice(){
        console.log('getting the price')

        var selectedVehicle = $('#vehicle_fk').val();
        // Get the price for the selected vehicle.
        $("#vehicles_pricelist").val(selectedVehicle);
        var price = $('#vehicles_pricelist option:selected').text();

        return price;
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