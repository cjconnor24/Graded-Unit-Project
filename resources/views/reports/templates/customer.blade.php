{{--<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>--}}
<style type="text/css">
    body, html {
        font-family:Montserrat, Tahoma, Helvetica, Arial;
        font-size:1em;
    }
table {
    width:100%;
}
    table tr td {
        border-bottom:1px solid #CCC;

    }
    .logo {
        width:25%;
    }
</style>
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
<div class="header">
    <h1>Spectrum Digital Print</h1>
</div>

<img class="logo" src="http://www.spectrumdubai.com/public/themes/spectrum/img/spectrum-mobile-logo@2x.png" alt="TEST"/>

<h1>Customer Report List</h1>

<p>Below are a list of customers</p>

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Registered</th>
            </tr>
        </thead>

    <tbody>
    @foreach($customers as $customer)
    <tr>
        <td>{{$customer->first_name}}</td>
        <td>{{$customer->last_name}}</td>
        <td>{{$customer->email}}</td>
        <td>{{$customer->telephone}}</td>
        <td>{{$customer->created_at}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

