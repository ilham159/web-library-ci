<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jam Digital</title>
<script type="text/javascript">
    window.setTimeout("waktu()",1000);
    function waktu() {
        var tanggal = new Date();
        setTimeout("waktu()",1000);
        document.getElementById("jam").innerHTML = tanggal.getHours();
        document.getElementById("menit").innerHTML = tanggal.getMinutes();
        document.getElementById("detik").innerHTML = tanggal.getSeconds();
    }
</script>
</head>

<style>
    #jam-digital{overflow:hidden; width:110px}
    #hours{float:left; width:30px; height:40.0px; margin-right:2px; margin-left:4px;}
    #minute{float:left; width:30px; height:25.8px; }
    #second{float:right; width:30px; height:25.8px; margin-right:14px}
    #jam-digital {color:#8824c6; font-size:25px; text-align:center; margin-top:2px}
</style>

<body onLoad="waktu()">
    <div id="jam-digital">
        <div id="hours"><p id="jam"></p></div>
        <div id="minute"><p id="menit"></p></div>
        <div id="second"><p id="detik"></p></div>
    </div>
</table>
</body>
</html>