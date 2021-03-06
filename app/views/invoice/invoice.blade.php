<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{ HTML::style('css/style_invoice.css') }}
<div class="container">

    <div class="pdf_header_wrapper">

       <span class="header_logo">
            {{HTML::image('images/logo.png')}}
       </span>

       <span class="header_text">
            {{HTML::image('images/header_pdf.png')}}
       </span>
    </div>
    <div class="clear"></div>
<div class="pdf_wrapper pdf_web">
    <div class="pdf_content_wrapper">
    <div class="invoice_header">


    <p class="title">INVOICE</p>

    <p class="contact_info">
        283 <br/>
        KELSO STREET <br/>
        GLASGOW <br/>
        G13 4PA <br/>
        MOB.07852266902
    </p>

    </div>
    <div class="clear"></div>


    <div class="invoice_elements_header">
    <p class="invoice_info">
         INVOICE: #{{ $employeeInfo->name }}
         <br/>
         INVOICE NR: {{ $invoiceInfo->invoice_number }}
         <br/>
         INVOICE DATE:  {{ date('d/m/Y', strtotime($invoiceInfo->date))  }}
    </p>

    <p class="company_name">Bill To:
        {{ $invoiceInfo->bill_to }}
    </p>
<br/>
    </div>

    <div class="clear"></div>
    <br/>
    <div class="table_wrapper">
         <div class="table_header">
             <div class="header_element qty">QTY</div>
             <div class="header_element desc">DESCRIPTION</div>
             <div class="header_element uprice">UNIT PRICE</div>
             <div class="header_element ltotal">LINE TOTAL</div>
         </div>
         <div class="table_body">
           <?php $subtotal = $total = $vat = 0; ?>
           @foreach($invoiceElements as $element)
                     @if($element->quantity > 1)
                        <?php $carsStr = 'Cars'; ?>
                     @else
                         <?php $carsStr = 'Car'; ?>
                     @endif
                         <div class="element_wrapper">
                         <p class="body_element qty_elem">
                             <span class="element_content">{{ ' ' . $element->quantity }}</span>
                         </p>

                         <p class="body_element desc_elem">
                             <span class="element_content">{{ ' ' .  $element->quantity . ' ' . $carsStr . ' Valeted On ' . date('d/m/Y', strtotime($element->date)) . ' - ' . $elementData[$element->vehicle_fk]['type'] }}</span>
                         </p>

                         <p class="body_element uprice_elem">
                         @if($elementData[$element->vehicle_fk]['price'] % 1 == 0)
                            <span class="element_content">{{ ' ' .  '£' . round($elementData[$element->vehicle_fk]['price'], 1) }}</span>
                         @else
                            <span class="element_content">{{ ' ' .  '£' .  number_format($elementData[$element->vehicle_fk]['price'], 1) }}</span>
                         @endif
                         </p>

                         <p class="body_element ltotal_elem">
                         @if(($element->quantity * $elementData[$element->vehicle_fk]['price']) % 1 == 0)
                            <span class="element_content">{{ ' ' .  '£' .  $element->quantity *  $elementData[$element->vehicle_fk]['price'] }}</span>
                         @else
                            <span class="element_content">{{ ' ' .  '£' .  number_format($element->quantity *  $elementData[$element->vehicle_fk]['price'], 1) }}</span>
                         @endif
                         </p>
                         <br/>
                         </div>


            <?php $subtotal += $element->quantity *  $elementData[$element->vehicle_fk]['price']; ?>
        @endforeach
        </div>
            <?php
                $total = $subtotal * 1.20;
                $vat = $subtotal * 0.20;

                if($vat % 1 != 0){
                    $vat = number_format($vat, 1);
                }
                if($subtotal % 1 != 0){
                    $subtotal = number_format($subtotal, 1);
                }
                if($total % 1 != 0){
                    $total = number_format($total, 1);
                }
             ?>


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
                <tr><td>SUBTOTAL</td> <td class="special">£{{ $subtotal }}</td></tr>
                <tr><td>VAT: 20%</td> <td class="special">£{{ $vat }} </td></tr>
                <tr><td>TOTAL</td> <td class="special">£{{ $total }} </td></tr>
            </table>
        </div>

        </div>
          <div class="clear"></div>
    </div>
</div>