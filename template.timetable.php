	<thead>
      <tr>
	    <th>Projekte <span id="filter">Ÿ</span></th>
	    <th>Zeiterfassung</th>
	    <th>Summe</th>
	  </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($Project); $i++): ?><tr class="<?php echo $i%2?"odd":"even"; ?>">
	    <td><?php echo $Project[$i]; ?></td>
	    <td>
          <?php for ($j=0; $j<count($Collegue); $j++): if ((key_exists($Collegue[$j], $Minutes[$Project[$i]])) && ($Minutes[$Project[$i]][$Collegue[$j]] > 0)):
          ?><input class="addTime" type="button" value="<?php echo $Collegue[$j] . ", " . MinutesToTime($Minutes[$Project[$i]][$Collegue[$j]]) ?>" />
          <?php endif; endfor; ?><input class="addTime newCollegue" type="button" value="+" />
        </td>
        <td><?php echo MinutesToTime(array_sum($Minutes[$Project[$i]])) ?></td>
	  </tr>
      <?php endfor; ?>
    </tbody>
    <tfoot>
	  <tr class="sum">
	    <td>Total</td>
	    <td></td>
        <td><?php if ($Minutes !== false) {echo MinutesToTime($Minutes[null][null]);} ?></td>
	  </tr>
    </tfoot>
