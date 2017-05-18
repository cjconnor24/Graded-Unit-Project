
<html>
<head>
    <style>
        html, body, div, h1, h2, h3, p, blockquote, ul, ol, li, pre {
            margin: 0; padding: 0 }
        li { margin-left: 1.5em }

        @page {size: A4; margin: 20mm }
        @media screen { body { margin: 5em }}

        body { font: 11pt helvetica , serif }
        q::before { content: "\201C"; }
        q::after { content: "\201D"; }
        q { font-style: italic }
        h1 { font-size: 3em; font-family: "Helvetica"; padding: 0 0 3em }
        h2, h3 { font-size: 1.1em; margin: 0.8em 0 0.4em }
        p, li { margin: 0.2em 0 0.4em }
        ul, ol { margin: 0.2em 0 0.4em 1.5em }
        a { text-decoration: none; color: inherit }

        table { width: 100%; margin: 1em 0; padding: 0; border: none; border-collapse: collapse }
        tr, td, th {
            padding: 0;
            text-align: left;
            border: none;
            vertical-align: top;
        }

        tr.total td { background: #ddd; padding: 0.2em 0 }
        tr.item td { background: #eee; padding: 0.2em 0 }
        tr.head td { font-weight: bold; padding: 1.5em 0 0.2em 0; border-bottom: thin solid black }

        table .amount { text-align: right }

        address { white-space: pre; padding: 0 0 1em; font-style: normal }
        aside { float: right; width: 10em }
        footer { float: bottom; text-align: center }

        body.usd td.currency:before { content: "USD\A0$" }
        body.eur td.currency:before { content: "EUR\A0\20AC\A0" }
        body.aud td.currency:before { content: "AUD\A0$" }

        body.eur tr.usd, body.eur tr.aud { display: none }
        body.usd tr.eur, body.usd tr.aud { display: none }
        body.aud tr.eur, body.aud tr.usd { display: none }

    </style>
</head>
<body class=aud>

<!--SPECTRUM ADDRESS-->
<aside>
    <img src="http://www.spectrumdubai.com/public/themes/spectrum/img/spectrum-mobile-logo@2x.png" style="width:100%;">
    <address class=from>
        DIFC
        Level B1
        Marble Walk
        Dubai
        PO Box 482043
    </address>
    www.spectrumdubai.com<br>
    hello@spectrumdubai.com
</aside>
<!-- END ADDRESS -->


<h1>Report Title</h1>

<!-- CUSTOMER ADDRESS -->
<address class=to>
    Customer Name
    Street
    Postcode City
    Country
</address>
<!-- END CUSTOMER ADDRESS -->

<table>
    <tr>
        <td>Invoice date:<td colspan=3>Nov 26, 2016
    <tr><td>Invoice number:<td colspan=3>161126

    <tr>
        <td>Payment due:
        <td colspan=3>30 days after invoice date
    <tr class=head><td>Description<td>From<td>Until<td class=amount>Amount
    <tr class=item><td>Prince Upgrades &amp; Support<td>Nov 26, 2016<td>Nov 26, 2017<td class="amount currency">950.00

    <tr class=total><td colspan=3>Total <td class="amount currency">950.00

</table>

<p><small>The BSB number identifies a branch of a financial institution in Australia. When transferring money to Australia, the BSB number is used together with the bank account number and the SWIFT code. Australian banks do not use IBAN numbers.</small>

    <footer><a href="http://www.spectrumdubai.com">www.spectrumdubai.com</a></footer>

</body>
</html>