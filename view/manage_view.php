<h3>Description</h3>
<p>WP Cron doesn't work until someone visits your site.  If your job is scheduled to run at 1pm but there are no visitors until 6pm, then your job actually runs at 6pm.  Improved Cron solves this by faking a visit to your site every minute.</p>

<ul>
<li style='float:left; width: 40%'><div><h3>Status</h3><table class="widefat">
<thead>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</thead>
<tbody>
<tr>
<td><strong>Current Time:</strong></td>
<td><?php echo date_i18n( $dformat, strtotime( current_time('mysql') ), true ); ?></td>
</tr>
<tr>
<td><strong>Started:</strong></td>
<td><?php echo ( !empty( $status['started'] ) ) ? date_i18n( $dformat, $status['started'] + ( get_option( 'gmt_offset' ) * 3600 ) ) : ''; ?></td>
</tr>
<tr>
<td><strong>Next 'Fake' Visit:</strong></td>
<td><?php echo ( !empty( $status['last_run'] ) ) ? date_i18n( $dformat, $status['last_run'] + 60 + ( get_option( 'gmt_offset' ) * 3600 ) ) : ''; ?></td>
</tr>
<tr>
<td><strong>State:</strong></td>
<td><?php echo ( $status['alive'] ) ? 'Running' : 'Stopped'; ?></td>
</tr>
</tbody>
</table>
<form method="POST" action="">
<p class="submit"><input type="hidden" name="imcron_nonce" value="<?php echo $imcron_nonce; ?>"/>
<input type="submit" name="start_bgp" value="Start"/>
<input type="submit" name="stop_bgp" value="Stop"/>
<input type="submit" name="check" value="Refresh"/><br/>
<strong>Note:</strong> If you don't see 'running' status after clicking start, please wait 1 minute and click refresh.</p>
</form>
</div></li>
<li style='float:left; width: 40%'><div style="margin-left: 10%"><h3>Possible Intervals</h3><table class="widefat">
<thead>
  <tr>
    <th>Display Name</th>
    <th>Identifier</th>
    <th>Interval (seconds)</th>
  </tr>
</thead>

<tbody>
<?php
	$html = '';
	foreach( $schedule_details as $real_name => $row ) {
		extract( $row );
		$html .= "<tr><td>$display</td><td>$real_name</td><td>$interval</td></tr>";
	}
	echo $html;
?>
</tbody>
</table></div></li>
</ul>
<br style='clear:both'/>
<h3>Scheduled</h3>
<table class="widefat">
<thead>
  <tr>
    <th>Hook</th>
    <th>Interval</th>
    <th>Next</th>
  </tr>
</thead>
<tfoot>
  <tr>
	  <th>Hook</th>
	  <th>Interval</th>
	  <th>Next</th>
  </tr>
</tfoot>
<tbody>

<?php
	$html = '';
	foreach( $hook_list as $row ) {
		$html .= '<tr>';
		foreach( $row as $cell ) {
			$html .= "<td>$cell</td>";
		}
		$html .= '</tr>';
	}
	echo $html;
?>
</tbody>
</table>
