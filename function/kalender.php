<?php
date_default_timezone_set('Asia/jakarta');
$month= date("m");
$year=date("Y");
$day=date("d");
$enDate=date("t",mktime(0,0,0,$month,$day,$year));
echo '<font face="arial" size="2">';
echo '<table align="center" border="0" cellpadding=5 cellspacing=5 style=""><tr><td align=center>';
echo '</td></tr></table>';
echo '<table align="center" border="0" cellpadding=1 cellspacing=1 style="border:3px solid orange">
<tr bgcolor="#EFEFEF">
<td align=center><font color=red>&nbsp;Minggu&nbsp;</font></td>
<td align=center>&nbsp;Senin&nbsp;</td>
<td align=center>&nbsp;Selasa&nbsp;</td>
<td align=center>&nbsp;Rabu&nbsp;</td>
<td align=center>&nbsp;Kamis&nbsp;</td>
<td align=center>&nbsp;Jumat&nbsp;</td>
<td align=center>&nbsp;Sabtu&nbsp;</td>
</tr>';
$s=date ("w", mktime (0,0,0,$month,1,$year));
for ($ds=1;$ds<=$s;$ds++) {
echo "<td style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle>
</td>";}
for ($d=1;$d<=$enDate;$d++) {
if (date("w",mktime (0,0,0,$month,$d,$year)) == 0) { echo "<tr>"; }
$fontColor="#000000";
if (date("D",mktime (0,0,0,$month,$d,$year)) == "Sun") { $fontColor="red"; }
echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> <span style=\"color:$fontColor\">$d</span></td>";
if (date("w",mktime (0,0,0,$month,$d,$year)) == 6) { echo "</tr>"; }}
echo '</table>'; 

?>