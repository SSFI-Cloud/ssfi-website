<?php
include ("../admin/config/config.php");

$id=$_GET["id"] ?? 0;

$htmldata='
<div style="border:1px solid gray;min-height:295mm;">
<table style="width:100%;">
    <tr>
        <td>
            
            <table style="text-align: center;">
                        <tbody>
                            <tr>
                                <td><img src="https://ssfibharatskate.com/registers/image/ssfilogo.png" class="ssfi-logo" alt="SSFI" style="WIDTH: 70px;"></td>
                                <td><b style="font-size: 16px;color: #3e4095;">Speed Skating Federation of India</b><br>
                                    <b>Affiliated to Speed Skating Federation of India SSFI</b><br>
                                    <b>No. 12 Porkudil Nagar,Podumbu - 625018,Madurai</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
        </td>
        <td style="border-left:1px solid gray;padding-left:20px;">
            <img src="https://tnssa.in/icons/logo/clientlogo.png" style="max-width:70px;">
        </td>
        <td>
            <img src="https://tnssa.in/icons/logo/clientlogo1.png" style="max-width:70px;">
        </td>
        <td>
            <img src="https://ssfibharatskate.com/admin/assets/img/favicon/ssfi-logo-12.png" style="max-width:70px;">
        </td>
       
    </tr>
    <tr>
        <td colspan="4" style="text-align:center;">
            <b>24<sup>th</sup> NATIONAL SPEED SKATING CHAMPIONSHIP 2025-2026</b><br>
            INTERNATIONAL SELECTION MEET 2025 - NATIONAL MEET CONFIRMATION FORM
        </td>
    </tr>
</table>


</div>
<style>
@page { margin: 5mm; }
body { margin: 0px; }
</style>';
echo $htmldata;

?>