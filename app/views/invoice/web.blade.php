<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{ HTML::style('css/style_pdf.css') }}
<div class="pdf_wrapper pdf_web" style="page-break-after:always;">
    <div class="pdf_header_wrapper">

       <span class="header_logo">
            {{HTML::image('images/logo.png')}}
       </span>

       <span class="header_text">
            {{HTML::image('images/header_pdf.png')}}
       </span>
    </div>
    <div class="clear"></div>

    <div class="pdf_content_wrapper">

    <p class="title">INVOICE</p>

    <p class="contact_info">
        283 <br/>
        KELSO STREET <br/>
        GLASGOW <br/>
        G13 4PA <br/>
        MOB.07852266902
    </p>

    <div class="clear"></div>


    <div class="invoice_elements_header">

    <p class="invoice_info">
         INVOICE: #{{ $employeeInfo->name }}
         <br/>
         INVOICE NR: {{ $invoiceInfo->invoice_number }}
         <br/>
         INVOICE DATE:  {{ date('d/m/Y', strtotime($invoiceInfo->date))  }}
    </p>

    <p class="company_name">Bill to:
        {{ $invoiceInfo->bill_to }}
    </p>

    </div>

    <div class="clear"></div>

    <div class="invoice_elements">
    <table class="pdf_table">
        <tr class="thead">
            <th colspan=1 rowspan=1>QTY</th>
            <th colspan=1 rowspan=1>DESCRIPTION</th>
            <th colspan=1 rowspan=1>UNIT PRICE</th>
            <th colspan=1 rowspan=1>LINE TOTAL</th>
        </tr>
        <tbody>

        <?php $subtotal = $total = $vat = 0; ?>

         @foreach($invoiceElements as $element)
            @if($element->quantity > 1)
               <?php $carsStr = 'Cars'; ?>
            @else
                <?php $carsStr = 'Car'; ?>
            @endif

            <tr>
                <td>{{ $element->quantity }}</td>
                <td>{{ $element->quantity . ' ' . $carsStr . ' Valeted On ' . date('d/m/Y', strtotime($element->date)) . ' - ' . $elementData[$element->vehicle_fk]['type'] }}</td>
                <td>{{ '£' .  $elementData[$element->vehicle_fk]['price'] }}</td>
                <td>{{ '£' . $element->quantity *  $elementData[$element->vehicle_fk]['price'] }}</td>

            </tr>
            <?php $subtotal += $element->quantity *  $elementData[$element->vehicle_fk]['price']; ?>
        @endforeach
            <?php
                $total = $subtotal * 1.20;
                $vat = $subtotal * 0.20;
             ?>



        </tbody>

    </table>

    </div>

    <div class="clear"></div>

    </div>

        <div class="pdf_footer">
        <div class="footer_vat">
            Vat number: 162157815
        </div>

        <div class="footer_message">
            thank you for your business
        </div>

        <div class="footer_price">
            <table class="totals_table">
                <tr><td class="special">SUBTOTAL</td> <td>£{{ $subtotal }}</td></tr>
                <tr><td class="special">VAT: 20%</td> <td>£{{ $vat }} </td></tr>
                <tr><td class="special">TOTAL</td> <td>£{{ $total }} </td></tr>
            </table>
        </div>

        </div>

</div>