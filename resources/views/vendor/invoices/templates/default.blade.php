<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="stylesheet" href="{{ asset('/vendor/invoices/bootstrap.min.css') }}">

        <style type="text/css" media="screen">
            * {
                font-family: "DejaVu Sans";
            }
            html {
                margin: 0;
            }
            body {
                font-size: 10px;
                margin: 36pt;
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
        </style>
    </head>

    <body>
        {{-- Header --}}
        @if($invoice->logo)
        <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
    @endif
    <table class="table mt-5">
        <tbody>
            <tr>
                <td class="border-0 pl-0" width="40%">
                    <h4 class="text-uppercase">
                        <span style="font-family: monospace; font-weight: bold;">Status:</span>
                        <span style="font-style: italic;">{{ $invoice->notes }}</span>
                    </h4>
                </td>
                <td class="border-0 pl-0" width="40%">
                    <h4 class="text-uppercase">
                        <span style="font-family: monospace; font-weight: bold;">Amount: </span>
                        <span style="font-style: italic;">{{ $invoice->formatCurrency($invoice->total_amount) }}</span>
                    </h4>
                </td>
                <td class="border-0 pl-0">
                    <p>{{ ('Receipt serial number') }} <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                    <p>{{ ('Date ') }}: <strong>{{ $invoice->getDate() }}</strong></p>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- sponsor and student details --}}
     {{-- Seller - Buyer --}}
     <table class="table">
        <thead>
            <tr>
                <th class="border-0 pl-0 party-header text-uppercase" width="48.5%">
                    {{ ('waxaa bixiye') }}
                </th>
                <th class="border-0" width="3%"></th>
                <th class="border-0 pl-0 party-header text-uppercase">
                    {{ ('waxaa lasiiye') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-0">
                    
                    @if($invoice->seller->fullname)
                        <p class="seller-name text-uppercase">
                            <strong>{{ $invoice->seller->fullname }}</strong>
                        </p>
                    @endif

                    @if($invoice->seller->email)
                        <p class="seller-email">
                            {{('Email address') }}: {{ $invoice->seller->email }}
                        </p>
                    @endif

                    @if($invoice->seller->phone)
                        <p class="seller-phone">
                            {{ ('Phone number') }}: {{ $invoice->seller->phone }}
                        </p>
                    @endif

                </td>
                <td class="border-0"></td>
                <td class="px-0">
                    @if($invoice->buyer->fullname)
                        <p class="buyer-name text-uppercase">
                            <strong>{{ $invoice->buyer->fullname }}</strong>
                        </p>
                    @endif

                    @if($invoice->buyer->email)
                        <p class="buyer-email">
                            {{ ('Email address') }}: {{ $invoice->buyer->email }}
                        </p>
                    @endif

                    @if($invoice->buyer->phone)
                        <p class="buyer-phone">
                            {{ ('phone number') }}: {{ $invoice->buyer->phone }}
                        </p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
      <p>
        {{ ('Total Amount in Words') }}: {{ $invoice->getTotalAmountInWords() }}
     </p>
   
    </body>
</html>
