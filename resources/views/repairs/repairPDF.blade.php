
<!doctype html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Remontas - #{{$repair->id}}</title>

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
                Užsakovas:<br><h3>{{$repair->klientas}}</h3>
                <pre>
Mob. {{$repair->mob_tel}}
Tel. {{$repair->tel}}
<br /><br />
Užregistruota: {{$repair->created_at}}
Registravo: {{$userOptions[$repair->registrator_id]}}
Remonto tipas: {{$repair->tipas}}
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
    <h3>Kompiuterinės įrangos remonto (testavimo) sutartis Nr. {{$repair->id}}</h3>
    <table width="100%" style="border: 1px solid #000;">
        <tr>
            <td>
                1. Užsakovas perduoda, o Vykdytojas priima remontui (testavimui) kompiuterinę įrangą, kasetę pildymui, kurios Specifikacija pateikta 2-me skyriuje. Už programinės įrangos, instaliuotos Užsakovo kompiuteryje, legalumą yra atsakingas Užsakovas. Kompiuterinė įranga vykdytojo patalpose saugoma ne ilgiau, kaip 6 mėn.
            </td>
        </tr>
        <tr>
            <td>
                2. Kompiuterinė įrangos specifikacija:<br>{{$repair->spec_komp}}
            </td>
        </tr>
        <tr>
            <td>
                3. <b>Gedimai:</b> <span style="text-decoration: underline;">{{$repair->gedimai}}</span><br><b>Pastabos:</b> {{$repair->pastabos}}
            </td>
        </tr>
        <tr>
            <td>
                <br>Vykdytojo atstovo parašas: __________________________________ Užsakovo atstovo parašas: ____________________________________
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="3" border="1" style="border-collapse: collapse; border-color:#000; margin-left: 8px;">
        <thead style="text-align:center;">
            <tr>
                <th width="40%">Atlikti darbai</th>
                <th width="10%">Kaina</th>
                <th width="40%">Sunaudotos medžiagos ir detalės</th>
                <th width="10%">Kaina</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>BIOS atnaujinimų įdiegimas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>OS atstatymas (perinstaliavimas)</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>OS atnaujinimų įdiegimas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tvarkyklių paieška ir įdiegimas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Informacijos perkėlimas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>El.pašto ir tinklo konfig.perkėlimas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Taikomųjų programų atstatymas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kompiuterinių virusų išvalymas</td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input disabled type="checkbox"> </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>Remonto kaina:</td>
                <td></td>
                <td>Dalių kaina:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4">Viso:</td>
            </tr>
        </tfoot>
    </table>
<hr>
    <table width="100%" cellspacing="0" cellpadding="3" border="1" style="border-collapse: collapse; border-color:#000; margin-left: 8px;">
        <tbody>
            <tr>
               <td colspan="3">
                    <b>UAB "Infociklas"</b><br>
                    S.Daukanto 35, LT-35224 Panevėžys. Telefonai: 845-571010, 845-596771, 845-571675
               </td>
               <td style="text-align:center;">
                    Sutarties nr. {{$repair->id}}
               </td>
            </tr>
            <tr>
                <td colspan="4">
                    Kompiuterinės įrangos specifikacija: <span style="text-decoration: underline;">{{$repair->spec_komp}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Priėmė: {{$userOptions[$repair->registrator_id]}}
                </td>
                <td>
                    Parašas: _______________________
                </td>
                <td>
                    Data: {{$now}}
                </td>
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
                Remonto būseną galite pasitikrinti: http://www.ciklas.lt/remontas
            </td>
        </tr>

    </table>
</div>
</body>
</html>