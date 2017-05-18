
<html>
<head>
    <style>
        html, body, div, h1, h2, h3, p, blockquote, ul, ol, li, pre {
            margin: 0; padding: 0 }

        @page {
            /*size: A4;*/
            margin: 10mm }
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
            font-size:x-small;
            border-radius:10px;
        }
        .table, .table td, .table th {
            border:1px solid #c9c9c9;
        }
        .table thead {
            background:#666!important;
            color:#FFF;
        }
        .table tr td, .table tr th {
            padding:0.5em!important;
        }
        .table tr:nth-child(even) {
            background: #e8e8e8;
        }

        .text-center {
            text-align:center;
        }
        .footer {
            position:absolute;
            bottom:0;
            font-size:xx-small;

        }
        .footer small {
            margin:1em 0;
        }
        .footer a {
            text-decoration:none;
            font-weight:bold;
            color:#333;
            margin:1em 0 0 0!important;
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

    <h1><span class="fi-"></span>{{$title}}</h1>

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
<p><small>The information contained in this document is private and confidential and is the sole property of Spectrum Digital Print Solutions Ltd.. You may not disclose this information to anyone unless you have prior, written consent.</small>
<p><a href="http://www.spectrumdubai.com">www.spectrumdubai.com</a></p>
</div>

</body>
</html>