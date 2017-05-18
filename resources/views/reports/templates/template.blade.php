
<html>
<head>
    <style>
        html, body, div, h1, h2, h3, p, blockquote, ul, ol, li, pre {
            margin: 0; padding: 0 }

        @page {size: A4; margin: 10mm }
        @media screen { body { margin: 5em }}

        address {
            margin:2em 0;
            white-space:pre-wrap;
            font-size:x-small!important;
        }

        body { font: 11pt helvetica , serif }


        .left {
            float:left;
            width:50%;
        }
        .right{
            float:right;
            width:35%;
        }
    .clear {
        clear:both;
    }
        .table {
            margin:100px 0!important;
            width:100%;
            border-collapse: collapse;
        }
        .table tr td {
            padding:0.5em!important;
        }
        .table tr:nth-child(even) {
            background: #CCC
        }

        .text-center {
            text-align:center;
        }
        .footer {
            position:absolute;
            bottom:5mm;
        }

    </style>
</head>
<body>

<!--SPECTRUM ADDRESS-->
<div class="right">
    <img src="http://www.spectrumdubai.com/public/themes/spectrum/img/spectrum-mobile-logo@2x.png" style="width:100%;">
    <address>
        DIFC
        Level B1
        Marble Walk
        Dubai
        PO Box 482043
    </address>
    www.spectrumdubai.com<br>
    hello@spectrumdubai.com
</div>
<!-- END ADDRESS -->

<div class="left">

    <h1>{{$title}}</h1>

</div>

<div class="clear"></div>

@if(isset($address))
<div>
    <!-- CUSTOMER ADDRESS -->
    <address>
      {!! str_replace(',',',<br />',$address) !!}
    </address>
    <!-- END CUSTOMER ADDRESS -->
</div>
@endif

<div class="clear"></div>

@if(isset($content))
    {!! $content !!}
@endif

@if(isset($table))
    {!! $table !!}
@endif


<div class="footer text-center">
<p><small>SME Top 100 Number 75 This is an e-mail from Spectrum. Its contents are confidential to the intended recipient. If you are not the intended recipient, be advised that you have received this e-mail in error and that any use, dissemination, forwarding, printing or copying of this e-mail is strictly prohibited. It may not be disclosed to or used by anyone other than its intended recipient, nor may it be copied in any way.</small>
<footer><a href="http://www.spectrumdubai.com">www.spectrumdubai.com</a></footer>
</div>

</body>
</html>