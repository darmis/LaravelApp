
<!doctype html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Iškvietimas - #{{$service->id}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: DejaVu Sans;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: 11px;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: 11px;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            text-align: center;
        }
        .information {
            background-color: #DCEFFE;
            color: #1C1469;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding-top: 10px;
            padding-right: 10px;
            padding-left: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                Užsakovas:<br><h3>{{$service->klientas}}</h3>
                <pre>
Adresas: {{$service->adresas}}
Tel. {{$service->tel}}
<br /><br />
Užregistruota: {{$service->created_at}}
Registravo: {{$userOptions[$service->registrator_id]}}
Meistras: {{$userOptions[$service->meistro_id]}}
</pre>


            </td>
            <td align="center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="120" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">

                Vykdytojas:<br><h3>UAB "Infociklas"</h3>
                <pre>
                    Įm. kodas: 147555675
                    www.infociklas.lt

                    S. Daukanto g. 35
                    Panevėžys
                </pre>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>Iškvietimo sutartis Nr. {{$service->id}}</h3>
    <table width="100%" cellspacing="0" cellpadding="3" border="1" style="border-collapse: collapse; border-color:#000; margin-left: 8px;">
        <tbody>
            <tr>
                <td width="50%">Būsena: {{$service->busena}}</td>
                <td width="50%">Dirbta val.: {{$service->dirbta_val}}</td>
            </tr>
            <tr>
                <td width="50%">Darbo laikas: {{$service->darbo_laikas}}</td>
                <td width="50%">Atstumas: {{$service->atstumas}}</td>
            </tr>
            <tr>
                <td colspan="2">Užduotis:</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;{{$service->uzduotis}}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Atlikti darbai:</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;{{$service->atlikta}}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Vykdytojo atstovo parašas: _______________________</td>
                <td>Užsakovo atstovo parašas: _______________________</td>
            </tr>
        </tbody>
    </table>
    
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 30%;">
                &copy;  UAB "Infociklas"
            </td>
            <td align="right" style="width: 70%;">
                {{$now}}
            </td>
        </tr>

    </table>
</div>
</body>
</html>