<?php
class IAphp
{
    function regresionLineal($x, $y)
    {
        $n = count($x);
        if (count($y) != $n) {
            die("Los elementos en x no coinciden con los elementos en y");
        }
        $sumaX = array_sum($x);
        $mediaX = $sumaX / $n;
        $sumaY = array_sum($y);
        $mediaY = $sumaY / $n;

        $sumaXporX = 0;
        $sumaXporY = 0;

        for ($i = 0; $i < $n; $i++) {
            $xmenos = $x[$i] - $mediaX;
            $sumaXporX += $x[$i] * $xmenos;
            $ymenos = $y[$i] - $mediaY;
            $sumaXporY += $xmenos * $ymenos;
        }
        $w = $sumaXporY / $sumaXporX;
        $b = $mediaY - ($w * $mediaX);

        return array("w"=>$w,"b"=>$b);
    }
}
