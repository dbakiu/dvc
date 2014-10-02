<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


{{ HTML::style('css/style_pdf.css') }}
<div class="pdf_wrapper">
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

    <div class="invoice_elements_pdf">
    <table class="pdf_table">
        <tr class="thead">
            <th colspan=1 rowspan=1>QTY</th>
            <th colspan=1 rowspan=1>DESCRIPTION</th>
            <th colspan=1 rowspan=1>UNIT PRICE</th>
            <th colspan=1 rowspan=1>LINE TOTAL</th>
        </tr>
        <tbody>
        <?php $total = $subtotal = $vat = 0; ?>
         @foreach($invoiceElements as $element)

                @if($element->quantity == 1)
                    <?php $carsStr = 'car' ?>
                @else
                    <?php $carsStr = 'cars' ?>
                @endif
            <tr>
                <td>{{ $element->quantity }}</td>
                <td>{{ $element->quantity . ' ' . $carsStr . ' valeted on ' . date('d/m/Y', strtotime($element->date)) . ' - ' .  $elementData[$element->vehicle_fk]['type'] }}</td>
                <td>{{ '£' . $elementData[$element->vehicle_fk]['price'] }}</td>
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

             <div class="pdf_footer_pdf">

              <div class="footer_vat pdf_vat">
                  Vat number: 162157815
              </div>

              <div class="footer_message pdf_message">
                  <p>thank you for your business</p>
              </div>

              <div class="footer_price pdf_price">
                  <table class="totals_table_pdf">
                      <tr><td class="first">SUBTOTAL</td> <td class="first right">£{{ $subtotal }}</td></tr>
                      <tr><td class="second">VAT: 20%</td> <td class="second right">£{{ $vat }} </td></tr>
                      <tr><td class="last">TOTAL</td> <td class="last right">£{{ $total }} </td></tr>
                  </table>
              </div>


             </div>

</div>
</div>
